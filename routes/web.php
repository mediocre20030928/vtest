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

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('/login')->group(function(){
    Route::get('/reg','LoginController@reg');
    Route::any('/do_reg','LoginController@do_reg');
    Route::any('/go_reg','LoginController@go_reg');
    Route::any('/login','LoginController@login');
    Route::any('/do_login','LoginController@do_login');
});

Route::prefix('test')->group(function(){
    Route::get('/add','FastController@add');
    Route::any('/do_add','FastController@do_add');
    Route::any('/list','FastController@list');
    Route::any('/del','FastController@del');
    Route::any('/upd/{id}','FastController@upd');
    Route::any('/do_upd','FastController@do_upd');
    Route::any('/upd_check','FastController@upd_check');
});

