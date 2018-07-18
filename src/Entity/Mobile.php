<?php

namespace OkamiChen\TmsMobile\Entity;

use Illuminate\Database\Eloquent\Model;

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

}
