<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Marketing extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'marketing_tbl';

    protected $primaryKey = 'idx';

    protected $guarded = [];

    protected $casts = [
        'created_at' => 'datetime',
        'update_at' => 'datetime',
        'delete_at' => 'datetime',
    ];

    function user()
    {
        return $this->hasOne('App\Models\User', 'idx','user_idx');
    }

    function appPush()
    {
        return $this->hasMany('App\Models\LogAppPush', 'mar_idx');
    }
    function file()
    {
        return $this->hasMany('App\Models\Files', 'table_idx')->where('table_name','marketing_tbl');
    }
    function mail()
    {
       // return $this->hasMany('App\Models\LogAppPush', 'mar_idx');
    }
    function alarmTalk()
    {
       // return $this->hasMany('App\Models\LogAppPush', 'mar_idx');
    }
    function sms()
    {
       // return $this->hasMany('App\Models\LogAppPush', 'mar_idx');
    }
}
