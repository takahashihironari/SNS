<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB; //DBクラスを使う

class CreateUsersTable extends Migration //Migrationを拡張するCreateUsersTableクラス
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) { /*usersテーブル作成*/
            $table->increments('id'); //テーブルにidカラムを入れる
            $table->string('name',12);  //テーブルにnameカラムを入れる
            $table->string('email',12)->unique();  //テーブルにemailカラムを入れる
            $table->string('password')->nullable();  //テーブルにpasswordカラムを入れる
            $table->timestamps(); //テーブルに作成日時、更新日時カラムを入れる
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
