<?php

use Hyperf\Database\Schema\Schema;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->index()->nullable()->comment('用户名');
            $table->string('email')->index()->nullable()->comment('邮箱');
            $table->tinyInteger('gender')->default(1)->comment('性别: 1-保密, 2-男, 3-女');
            $table->date('birthday')->nullable()->comment('生日');
            $table->integer('department_id')->default(0)->index()->comment('所属部门id');
            $table->timestamps();
            $table->softDeletes();

            $table->comment('用户表');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
}
