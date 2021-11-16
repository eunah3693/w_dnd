<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MissionPoolTemp extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'mission_pool_temp_tbl';

    protected $primaryKey = 'idx';

    protected $guarded = [];

    protected $casts = [
        'created_at' => 'datetime',
        'update_at' => 'datetime',
        'delete_at' => 'datetime',
    ];

    function precede()
    {
        return $this->hasMany('App\Models\MissionPool', 'idx', 'precede_idx');
    }

    function mission()
    {
        return $this->hasMany('App\Models\Mission', 'mission_pool_idx');
    }
}
