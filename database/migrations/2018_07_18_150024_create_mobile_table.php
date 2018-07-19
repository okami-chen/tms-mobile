<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMobileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mobile', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 20)->comment('姓名');
            $table->string('mobile', 11)->comment('手机号');
            $table->string('provider', 20)->comment('运营商');
            $table->string('flag', 4)->comment('标识');
            $table->string('remark', 50)->comment('备注')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mobile');
    }
}
