<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; //use宣言文

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('posts')->insert([

        ['user_name' => 'aaa','contents' => '1つ目の投稿になります'], //user_name,contentsカラムに対して値を用意

        ['user_name' => 'bbb','contents' => '2つ目の投稿になります'],

        ['user_name' => 'ccc','contents' => '3つ目の投稿になります'],

        ['user_name' => 'ddd','contents' => '4つ目の投稿になります'],

        ['user_name' => 'eee','contents' => '5つ目の投稿になります']

        ]);
    }
}
