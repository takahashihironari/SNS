<?php

use Illuminate\Support\Facades\Route;//Routeを使う
use App\Http\Controllers\PostsController; //PostsControllerクラスを呼び出す
use App\Http\Controllers\ProfileController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('/login');//URLにルートパス指定時は「/login」にリダイレクト
});
Auth::routes(); //authのルーティング
Route::get('/index', [App\Http\Controllers\Controller::class, 'index'])->name('index'); //homeページでHomeControllerクラスのindexメソッド処理を実行し、名前をhomeとする
Route::get('index',[PostsController::class,'index']); //indexページでPostControllerのindexメソッド処理を実行



// プロフィール関連
Route::prefix('user')->group(function () {

    Route::get('/profile/{id}', [ProfileController::class, 'profile'])   -> name('user.profile');  //プロフィール画面表示
    Route::get('/edit', [ProfileController::class, 'edit'])              -> name('user.edit'); //プロフィール編集
    Route::post('/update', [ProfileController::class, 'update'])         -> name('user.update');  //プロフィール更新処理

});
