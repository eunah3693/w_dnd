<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLikeTbl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('like_tbl', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
            $table->bigIncrements('idx');

            $table->unsignedBigInteger('user_idx')->comment('유저 인덱스');
            $table->Integer('board_idx')->comment('게시판 인덱스')->nullable();

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
        Schema::dropIfExists('like_tbl');
    }
}
