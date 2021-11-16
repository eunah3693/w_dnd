<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Board extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'board_tbl';

    protected $primaryKey = 'idx';

    protected $guarded = [];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    public function file()
    {
        return $this->hasMany('App\Models\Files', 'board_idx');
    }

    public function user()
    {
        return $this->hasOne('App\Models\User', 'idx', 'user_idx');
    }
    
    public function admin()
    {
        return $this->hasOne('App\Models\User', 'idx', 'user_idx2');
    }

    function reply()
    {
        return $this->hasMany('App\Models\Board', 'parent_idx', 'idx');
    }
}
