<?php

namespace OkamiChen\TmsMobile\Entity;

use Illuminate\Database\Eloquent\Model;
use OkamiChen\TmsWechat\Entity\Wechat;

class Mobile extends Model
{
    protected $table    = 'mobile';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'mobile', 'mobile','provider','monthly','remark','flag'
    ];
    
    
    public function items(){
        return $this->hasMany(Wechat::class, 'mobile_id');
    }

}
