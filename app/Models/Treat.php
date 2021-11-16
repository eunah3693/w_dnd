<?php

namespace App\Models;

use App\Casts\Treat as CastsTreat;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Treat extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'treat_tbl';

    protected $primaryKey = 'idx';

    protected $guarded = [];

    protected $casts = [
        'created_at' => 'datetime',
        'update_at' => 'datetime',
        'delete_at' => 'datetime',
        'treat' => CastsTreat::class,
    ];

    function user()
    {
        return $this->hasOne('App\Models\User', 'idx','user_idx');
    }
}
