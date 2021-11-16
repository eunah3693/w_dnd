<?php

namespace App\Models;

use App\Scopes\DeleteUserScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'post_tbl';

    protected $primaryKey = 'idx';

    protected $guarded = [];

    protected $casts = [
        'created_at' => 'datetime',
        'update_at' => 'datetime',
        'delete_at' => 'datetime',
    ];

    protected static function booted()
    {
        parent::boot();

        static::addGlobalScope(new DeleteUserScope);
    }


    function like()
    {
        return $this->hasMany('App\Models\Like', 'post_idx');
    }

    function bookMark()
    {
        return $this->hasMany('App\Models\bookMark', 'post_idx');
    }

    function reply()
    {
        return $this->hasMany('App\Models\Post', 'parent_idx', 'idx')->where('is_public','1')->with('like')->with('user')->orderBy('created_at','asc')->withCount('reply2');
    }

    function reply2()
    {
        return $this->hasMany('App\Models\Post', 'parent_idx', 'idx')->where('is_public','1')->orderBy('created_at','asc');
    }

    function files()
    {
        return $this->hasMany('App\Models\Files', 'table_idx', 'idx')->where('table_name', 'post_tbl')->orderBy('created_at','asc');
    }

    function user()
    {
        return $this->belongsTo('App\Models\User', 'user_idx');
    }

    function tag()
    {
        return $this->hasMany('App\Models\Tag', 'post_idx');
    }

    function mission()
    {
        return $this->hasOne('App\Models\Mission', 'idx', 'mission_idx')->with('missionPool');
    }
}
