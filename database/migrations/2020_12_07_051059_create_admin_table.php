<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_tbl', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';

            $table->bigIncrements('idx');

            $table->string('id','64')->comment('아이디');
            $table->string('password')->comment('비밀번호');
            $table->string('name', '64')->comment('사용자 이름');
            $table->string('company', '255')->comment('회사이름');
            $table->string('email','64')->unique()->comment('이메일');
            $table->string('nickname','64')->comment('닉네임');
            $table->date('birth')->comment('생일');
            $table->enum('sex', ['M', 'F'])->comment('성별');
            $table->integer('level')->comment('회원레벨');
            $table->foreign('level')->references('level')->on('level_info_tbl')->comment('회원레벨FK');
            $table->text('memo')->comment('메모');
            $table->boolean('is_password_change')->default(false)->comment('패스워드 변경 여부 true일경우 변경');
            $table->dateTime('last_password_change', 0)->comment('마지막 패스워드 변경일');
            $table->dateTime('last_login_date', 0)->comment('마지막 로그인');
            $table->smallInteger('login_fail')->comment('로그인 실패횟수');
            $table->text('out_reason')->comment('탈퇴사유');
            $table->string('login_ip','64')->comment('로그인 아이피');
            $table->string('login_device','64')->comment('로그인 디바이스');

            $table->rememberToken();

            $table->enum('status', ['W', 'Y', 'S', 'D'])->default('Y')->comment('W:미승인회원 Y: 정상(승인)회원 S:정지(승인취소)회원 , D:탈퇴회원');
            $table->timestamps();
            $table->softDeletes('deleted_at', 0)->comment('임시삭제');

            $table->index(['id']);
            $table->index(['level']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admin_tbl');
    }
}
