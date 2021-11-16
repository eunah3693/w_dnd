<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlarmTbl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alarm_tbl', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
            $table->bigIncrements('idx');

            $table->unsignedBigInteger('user_idx')->comment('유저 인덱스');
            $table->unsignedBigInteger('sender_idx')->comment('보낸 회원 인덱스');
            $table->Integer('board_idx')->comment('게시판 인덱스')->nullable();

            $table->string('content', '255')->comment('내용');
            $table->string('related_url', '255')->comment('url');
            $table->boolean('is_check')->comment('1: 확인, 0: 비확인')->default(true);

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
        Schema::dropIfExists('alarm_tbl');
    }
}
