<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'ContentController@home')->name('home');

Route::get('/top', 'HomeController@index')->name('top');
Route::get('/top/favorite', 'HomeController@favorite')->name('favorite');

//詳細ページ------------------------------------------------------------------
Route::get('/detail/{job_id}', 'DetailController@click')->name('detail');
Route::post('/detail/{job_id}', 'DetailController@chat')->name('chat');

//応募完了ページ--------------------------------------------------------------
Route::get('/finish/{job_id}', 'FinishController@finish')->name('finish');
Route::post('/top/like', 'HomeController@like')->name('like');

// イベント管理ページ---------------------------------------------------------
Route::get('/tool', 'ToolController@index')->name('tool');
Route::get('/tool/create', 'ToolController@create')->name('tool.create');
Route::post('/tool/store', 'ToolController@store')->name('tool.store');

Route::post('/tool/city', 'Toolcontroller@city')->name('tool.city');

Route::post('/tool/update/{job_id}', 'ToolController@update')->name('tool.update');
Route::post('/tool/date/{job_id}', 'ToolController@date')->name('tool.date');
Route::post('/tool/status/{job_id}', 'ToolController@status')->name('tool.status');
Route::post('/tool/delete/{job_id}', 'ToolController@delete')->name('tool.delete');

// ユーザー登録画面------------------------------------------------------------

Route::get('/user', 'UserController@index')->name('event.user');
Route::get('/user/attend', 'UserController@attend')->name('attend.user');
Route::post('/user/delete', 'UserController@delete')->name('delete.user');
