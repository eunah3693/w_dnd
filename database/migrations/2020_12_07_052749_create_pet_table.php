<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pet_tbl', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';

            $table->bigIncrements('idx');

            $table->unsignedBigInteger('user_idx')->comment('회원고유인덱스');
            $table->foreign('user_idx')->references('idx')->on('user_tbl')->comment('회원고유인덱스FK');

            $table->boolean('is_main')->default(true);

            $table->string('name', '64')->comment('이름');
            $table->string('breed', '128')->comment('종');

            $table->timestamps();
            $table->softDeletes('deleted_at', 0)->comment('임시삭제');

            $table->index(['name']);
            $table->index(['breed']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pet_tbl');
    }
}
