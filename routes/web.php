<?php

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
//topページのルート情報
Route::get('/', function () {
    return view('welcome');
});
//ルーティングにRoute::resouceを指定することで、CRUDルーティングを一度に行うことができる。
//一覧画面が開かれると、TodoControllerを実行する。
Route::resource('todo', 'TodoController');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
