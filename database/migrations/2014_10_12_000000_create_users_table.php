<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id')->unsigned()->comment('id');
            $table->char('nickname',8)->default('')->comment('ニックネーム');
            $table->char('password',60)->default('')->comment('パスワード');
            $table->char('email',255)->unique()->comment('メールアドレス');
            $table->float('height')->comment('身長');
            $table->float('weight')->comment('体重');
            $table->integer('sex')->comment('性別');
            $table->date('birth')->comment('誕生日');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
