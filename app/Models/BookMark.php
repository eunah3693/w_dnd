<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BookMark extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'bookmark_tbl';

    protected $primaryKey = 'idx';

    protected $guarded = [];

    protected $casts = [
        'created_at' => 'datetime',
        'update_at' => 'datetime',
        'delete_at' => 'datetime',
    ];

    public function post()
    {
        return $this->belongsTo('App\Models\Post', 'post_idx');
    }

}
