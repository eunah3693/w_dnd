<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMissionUserTbl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mission_user_tbl', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
            $table->bigIncrements('idx');
            $table->Integer('board_idx')->comment('게시판 인덱스')->nullable();

            $table->unsignedBigInteger('pet_idx')->comment('펫인덱스');
            $table->foreign('pet_idx')->references('idx')->on('pet_tbl');

            $table->unsignedBigInteger('mission_idx')->comment('미션인덱스');
            $table->foreign('mission_idx')->references('idx')->on('mission_tbl');

            $table->longText('content', '255')->comment('내용');
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
        Schema::dropIfExists('mission_user_tbl');
    }
}
