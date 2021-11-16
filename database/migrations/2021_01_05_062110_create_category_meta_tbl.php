<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryMetaTbl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_tbl', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
            $table->bigIncrements('idx');
            $table->string('name', '255')->comment('이름');
            $table->string('depth1', '255')->comment('카테고리 대분류');
            $table->string('depth2', '255')->comment('카테고리 중분류');
            $table->string('depth3', '255')->comment('카테고리 소분류');
            $table->integer('category_idx')->comment('부모 인덱스');
            $table->timestamps();
            $table->softDeletes('deleted_at', 0)->comment('임시삭제');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('category_tbl');
    }
}
