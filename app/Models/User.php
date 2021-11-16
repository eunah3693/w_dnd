<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $table = 'user_tbl';

    protected $primaryKey = 'idx';

    /**
     * 관계 정의하기
     * hasMany() 1:N <=> belongsTo() N:1 / hasOne() 1:1
     */
    public function pets()
    {
        return $this->hasMany('App\Models\Pets');
    }

    public function storyPet()
    {
        return $this->hasOne('App\Models\Pets','idx','story_mission_pet');
    }

    public function file()
    {
        return $this->hasOne('App\Models\Files', 'table_idx', 'idx')->where('table_name', 'user_tbl')->latest();
    }

    public function getTableColumns() {
        return $this->getConnection()->getSchemaBuilder()->getColumnListing($this->getTable());
    }

    /**
     * 허용해서는 안되는 항목을 적어두는 $guarded
     * 빈배열[] 사용시 모두 허용
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     * 숨겨야하는 데이터
     * @var array
     */
    protected $hidden = [
        'password',
        'token',
    ];

    /**
     * The attributes that should be cast to native types.
     * 기본 유형으로 캐스트 되어야하는 데이터 '필드네임' => '데이터타입'
     * JSON을 포함한 필드가 있는경우 array
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime',
        'update_at' => 'datetime',
        'delete_at' => 'datetime',
    ];

    /**
     * The model's default values for attributes.
     *모델의 속성에 대한 기본값을 정의하
     * @var array
     */
    protected $attributes = [
        'level' => 1 ,
        'status' => 'Y' ,
        'login_fail' => 0
    ];
}
