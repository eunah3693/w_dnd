<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files_tbl', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';

            $table->bigIncrements('idx');

            $table->foreignId('user_idx')->nullable()->index();
            $table->foreign('user_idx')->references('idx')->on('user_tbl')->comment('회원고유인덱스FK');

            $table->Integer('board_idx')->comment('게시판 인덱스')->nullable();
            $table->string('real_path', '255')->comment('저장경로');
            $table->string('orgin_name', '255')->comment('오리지널 이름');
            $table->Integer('size')->comment('파일사이즈');
            $table->string('mime_type', '128')->comment('파일타입');

            $table->boolean('is_public')->default(true)->comment('공개여부');

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
        Schema::dropIfExists('files_tbl');
    }
}
