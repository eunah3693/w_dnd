<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Banner extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'banner_tbl';

    protected $primaryKey = 'idx';

    protected $guarded = [];

    protected $casts = [
        'created_at' => 'datetime',
        'update_at' => 'datetime',
        'delete_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_idx');
    }

    public function file()
    {
        return $this->hasMany('App\Models\Files', 'board_idx');
    }
}
