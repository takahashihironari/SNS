<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;//DBクラスを使う

class Posts extends Migration //Migrationを拡張するPostsクラス
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {/*postsテーブル作成*/
        $table->increments('id'); //テーブルにidカラムを入れる
        $table->string('user_name', 12); //テーブルにuser_nameカラムを入れる
        $table->string('contents'); //テーブルにcontentsカラムを入れる
        $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
        $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');//postsテーブルを削除する
    }
}
