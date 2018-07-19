<?php

namespace OkamiChen\TmsMobile;

use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

class MobileServiceProvider extends ServiceProvider
{
    /**
     * @var array
     */
    protected $commands = [
        \OkamiChen\TmsMobile\Console\Command\ImportCommand::class,
    ];
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        
        if ($this->app->runningInConsole()) {
            $this->publishes([__DIR__.'/../config' => config_path()], 'tms-mobile-config');
            $this->publishes([__DIR__.'/../database/migrations' => database_path('migrations')], 'tms-mobile-migrations');
        }
        
        $this->registerRoute();
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->commands($this->commands);
    }
    
    protected function registerRoute(){
        
        $attributes = [
            'prefix'     => config('admin.route.prefix'),
            'namespace'  => 'OkamiChen\TmsMobile\Controller',
            'middleware' => config('admin.route.middleware'),
        ];

        Route::group($attributes, function (Router $router) {
            $router->resource('mobile', 'MobileController',['as'=>'tms']);
        });
    }
}
