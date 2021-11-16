<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Breed extends Model
{
	use HasFactory, SoftDeletes;
	
	protected $table = 'dogs_breed_tbl';
	
	protected $primaryKey = 'idx';
	
	protected $guarded = [];
	
	protected $casts = [
			'created_at' => 'datetime',
			'updated_at' => 'datetime',
			'deleted_at' => 'datetime',
	];
}
