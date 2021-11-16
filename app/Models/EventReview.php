<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EventReview extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'event_review_tbl';

    protected $primaryKey = 'idx';

    protected $guarded = [];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    function event()
    {
        return $this->belongsTo('App\Models\Event', 'event_idx');
    }

    function user()
    {
        return $this->belongsTo('App\Models\User', 'user_idx');
    }
}
