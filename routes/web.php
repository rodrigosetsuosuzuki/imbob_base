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


Route::group(['prefix'=>'admin','namespace'=>'Admin','as'=>'admin.'],function(){

    // formulario de login
    Route::get('/','AuthController@showLoginForm')->name('login');
    Route::post('login','AuthController@login')->name('login.do');

    // rotas protegidas 
    Route::group(['middleware' => ['auth']], function () {
        Route::get('home','AuthController@home')->name('home');
        Route::resource('users', 'UserController');

    });

    // rota logout 
    Route::get('logout','AuthController@logout')->name('logout');
});



