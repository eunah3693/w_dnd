<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class DeviceInfo extends Model
{
	use HasFactory, SoftDeletes;
	
	protected $table = 'device_tbl';
	
	protected $primaryKey = 'idx';
	
	protected $guarded = [];
	
	protected $casts = [
			'created_at' => 'datetime',
			'updated_at' => 'datetime',
			'deleted_at' => 'datetime',
	];
}
