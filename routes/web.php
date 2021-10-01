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

Route::group(['middleware'=>'auth', 'namespace'=>'Admin', 'prefix'=>'admin'], function(){
    Route::get('/', ['as'=>'admin.home', 'uses'=>'AdminController@index']);
    Route::get('balance', ['as'=>'admin.balance', 'uses'=>'BalanceController@index']);
});


Route::get('/', ['as'=>'site.home', 'uses'=>'Site\SiteController@index']);

Auth::routes();
