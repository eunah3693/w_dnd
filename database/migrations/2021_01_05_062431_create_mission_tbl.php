<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMissionTbl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mission_tbl', function (Blueprint $table) {

            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';

            $table->bigIncrements('idx');
            $table->Integer('board_idx')->comment('게시판 인덱스')->nullable();

            $table->boolean('is_single')->comment('1: 단일미션, 0: 단계별미션')->default(true);
            $table->boolean('is_public')->comment('1: 공개, 0: 비공개')->default(false);
            $table->longText('user_idx_list')->comment('비공개 미션일때 공유할수있는 유저. 인덱스 | 로구분');
            $table->bigInteger('mission_idx')->comment('단계별미션일때, 상위미션 인덱스');

            $table->unsignedBigInteger('category1_idx')->comment('미션분류1')->nullable();
            $table->foreign('category1_idx')->references('idx')->on('category_tbl');
            $table->unsignedBigInteger('category2_idx')->comment('미션분류2')->nullable();
            $table->foreign('category2_idx')->references('idx')->on('category_tbl');
            $table->unsignedBigInteger('category3_idx')->comment('미션분류3')->nullable();
            $table->foreign('category3_idx')->references('idx')->on('category_tbl');

            $table->string('title', '255')->comment('제목');
            $table->string('sub_title', '255')->comment('서브제목');
            $table->longText('content')->comment('내용');

            $table->unsignedBigInteger('reward_idx')->comment('보상 방법');
            $table->foreign('reward_idx')->references('idx')->on('reward_tbl');

            $table->integer('point')->comment('지급포인트')->default(0);
            $table->string('reward_url');
            $table->boolean('is_reward_auto')->comment('1: 보상자동지급, 0:보상수동지급')->default(false);
            $table->integer('exp')->comment('경험치')->default(0);

            $table->timestamps();
            $table->softDeletes('deleted_at', 0)->comment('임시삭제');

            $table->index(['is_single']);
            $table->index(['is_public']);
            $table->index(['category1_idx']);
            $table->index(['category2_idx']);
            $table->index(['category3_idx']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mission_tbl');
    }
}
