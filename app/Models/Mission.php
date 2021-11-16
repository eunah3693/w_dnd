<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\MissionPool;
class Mission extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'mission_tbl';

    protected $primaryKey = 'idx';

    protected $guarded = [];

    protected $casts = [
        'created_at' => 'datetime',
        'update_at' => 'datetime',
        'delete_at' => 'datetime',
    ];

    function missionPool()
    {
        return $this->belongsTo(MissionPool::class, 'mission_pool_idx');
    }
}
