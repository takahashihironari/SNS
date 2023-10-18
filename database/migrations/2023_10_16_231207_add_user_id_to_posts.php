<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserIdColumnToPosts extends Migration
{
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->bigInteger('user_id')->unsigned();
        });
    }

    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn('user_id');
        });
    }
}
