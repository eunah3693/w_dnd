<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class CreateUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_tbl', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';

            $table->bigIncrements('idx');

            $table->string('id', '64')->comment('아이디');
            $table->string('password')->comment('비밀번호');
            $table->string('name', '64')->comment('사용자 이름');
            $table->string('email','64')->unique()->comment('이메일 유니크');
            $table->string('nickname','64')->comment('닉네임');
            $table->date('birth')->comment('생일');
            $table->enum('sex', ['M', 'F'])->comment('성별');
            $table->string('interset', '255')->comment('흥미 |로 구분');
            $table->integer('level')->comment('회원레벨');
            $table->bigInteger('exp')->comment('도달경험치');
            $table->integer('point')->comment('포인트');

            $table->foreign('level')->references('level')->on('level_info_tbl')->comment('회원레벨FK');
            $table->text('memo')->comment('메모');
            $table->boolean('is_password_change')->default(false)->comment('패스워드 변경 여부 true일경우 변경');
            $table->dateTime('last_password_change', 0)->comment('마지막 패스워드 변경일');
            $table->dateTime('last_login_date', 0)->comment('마지막 로그인');

            $table->enum('sms_agree', ['Y', 'N']);
            $table->dateTime('sms_agree_date', 0)->comment('sms동의 수신동의 날짜');
            $table->enum('email_agree', ['Y', 'N']);
            $table->dateTime('email_agree_date', 0)->comment('이메일 수신동의 날짜');
            $table->enum('push_agree', ['Y', 'N']);
            $table->dateTime('push_agree_date', 0)->comment('앱푸쉬 수신동의 날짜');
            $table->enum('alimtalk_agree', ['Y', 'N']);
            $table->dateTime('alimtalk_agree_date', 0)->comment('알림톡 수신동의 날짜');
            $table->dateTime('privacy_agree_date', 0)->comment('개인정보처리방침 동의날짜');
            $table->dateTime('terms_agree_date', 0)->comment('이용약관 동의날짜');

            $table->smallInteger('login_fail')->comment('로그인 실패횟수');
            $table->text('out_reason')->comment('탈퇴사유');
            $table->string('login_ip','64')->comment('로그인 아이피');
            $table->string('login_device','64')->comment('로그인 디바이스');

            $table->boolean('is_sns')->default(false)->comment('sns 연동여부');
            $table->enum('sns_type', ['K', 'N', 'G', 'F'])->comment('K:카카오톡, N:네이버, G:구글, F:페이스북')->nullable();
            $table->boolean('sns_id')->comment('sns 고유 아이디');
            $table->rememberToken();

            $table->enum('status', ['Y', 'S', 'D'])->default('Y')->comment('Y: 정상회원 S:정지/블랙리스트 회원 , D:탈퇴회원');
            $table->timestamps();
            $table->softDeletes('deleted_at', 0)->comment('임시삭제');

            $table->index(['id']);
            $table->index(['level']);
            $table->index(['name']);
            $table->index(['nickname']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_tbl');
    }
}
