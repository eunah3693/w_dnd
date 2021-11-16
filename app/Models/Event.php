<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'event_tbl';

    protected $primaryKey = 'idx';

    protected $guarded = [];

    protected $casts = [
        'created_at' => 'datetime',
        'update_at' => 'datetime',
        'delete_at' => 'datetime',
    ];

    function eventReview()
    {
        return $this->hasMany('App\Models\EventReview', 'event_idx')->with('user');
    }
    function user()
    {
        return $this->hasOne('App\Models\User', 'idx','user_idx');
    }

    function eventJoin()
    {
        return $this->hasMany('App\Models\EventJoin', 'event_idx')->orderBy('created_at','desc')->with('user');
    }

    function eventJoinCount()
    {
        return $this->hasMany('App\Models\EventJoin', 'event_idx')->where('status', 1);
    }

    function file()
    {
        return $this->hasMany('App\Models\Files', 'table_idx')->where('table_name','event_tbl');
    }


}
