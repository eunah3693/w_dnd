<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLevelInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('level_info_tbl', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';

            $table->bigIncrements('idx');

            $table->integer('level')->unique();
            $table->bigInteger('exp')->comment('도달경험치');
            $table->string('name','45');
            $table->boolean('is_admin')->default(false);

            $table->timestamps();
            $table->softDeletes('deleted_at', 0)->comment('임시삭제');

            $table->index(['is_admin']);
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
        Schema::dropIfExists('level_info_tbl');
    }
}
