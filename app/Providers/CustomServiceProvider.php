<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class CustomServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //全角スペースのみの場合エラー
        Validator::extend('space', function ($attribute, $value, $parameters, $validator) { //spaceというルール,$attribute=項目名 $value=入力値 $parameter=ルールに渡される引数 $validator=Validatorインスタンス
            if( mb_ereg_match("^(\s|　)+$", $value) ){//入力値が全角スペースのみだった場合
            }else{//そうでない場合
                return true;//値を返す
            }
        });
        //入力文字数が指定の桁数（バイト）より大きい場合エラー
        Validator::extend('max_length', function ($attribute, $value, $parameters, $validator) { //max_lengthというルール
            $validator->addReplacer('max_length', function ($message, $attribute, $rule, $parameters) { //addReplacerメソッドを使ってエラーメッセージ内の:maxを指定した文字数に置き換える
                return str_replace([':max'], $parameters, $message); //max=PostsController.phpで最大値指定
            });
            return mb_strwidth($value) <= $parameters[0]; //$parameters[0]と比較し、最大値以下であればtrueを、最大値を超えている場合はfalseを返す
        });
    }
}
