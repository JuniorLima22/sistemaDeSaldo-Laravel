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
    Route::get('deposit', ['as'=>'balance.deposit', 'uses'=>'BalanceController@deposit']);
    Route::post('deposit', ['as'=>'deposit.store', 'uses'=>'BalanceController@depositStore']);
    Route::get('withdraw', ['as'=>'balance.withdraw', 'uses'=>'BalanceController@withdraw']);
    Route::post('withdraw', ['as'=>'withdraw.store', 'uses'=>'BalanceController@withdrawStore']);
    Route::get('transfer', ['as'=>'balance.transfer', 'uses'=>'BalanceController@transfer']);
    Route::post('confirm-transfer', ['as'=>'confirm.transfer', 'uses'=>'BalanceController@confirmTransfer']);
    Route::post('transfer', ['as'=>'transfer.store', 'uses'=>'BalanceController@transferStore']);
    Route::get('historic', ['as'=>'admin.historic', 'uses'=>'BalanceController@historic']);
});


Route::get('/', ['as'=>'site.home', 'uses'=>'Site\SiteController@index']);

Auth::routes();
