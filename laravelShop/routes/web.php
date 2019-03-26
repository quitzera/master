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

Route::any('/','Index\\IndexController@Index');
Route::any('detail/{id}','Index\\IndexController@detail');
Route::any('all','Index\\IndexController@all');
Route::any('login','Index\\IndexController@login');
Route::any('register','Index\\IndexController@register');
Route::any('getCode','Index\\IndexController@getCode');
Route::any('test','Index\\IndexController@test');
Route::any('mobileCode','Index\\IndexController@mobileCode');
Route::any('view',function(){
    return view('regauth',['type'=>5]);
});
Route::get('user','Index\\IndexController@user');
Route::post('telUnique','Index\\IndexController@telUnique');
Route::post('registerDo','Index\\IndexController@registerDo');
Route::post('loginDo','Index\\IndexController@loginDo');
Route::post('getGoods','Index\\IndexController@getGoods');
Route::post('savePage','Index\\IndexController@savePage');

Route::group(['middleware'=>'check'],function(){
    Route::get('share','Index\\IndexController@share');
    Route::get('cart','Index\\IndexController@cart');
    Route::get('set','Index\\IndexController@set');
    Route::post('calculate','Index\\IndexController@calculate');
    Route::post('intoCart','Index\\IndexController@intoCart');
    Route::post('getPrice','Index\\IndexController@getPrice');
    Route::post('cartDel','Index\\IndexController@cartDel');
    Route::get('payment','Index\\IndexController@payment');
    Route::get('address','Index\\IndexController@address');
    Route::get('writeaddr','Index\\IndexController@writeaddr');
    Route::any('unity','Index\\IndexController@unity');
    Route::any('createAddr','Index\\IndexController@createAddr');
    Route::any('defaultThis','Index\\IndexController@defaultThis');
    Route::any('delAddr','Index\\IndexController@delAddr');
    Route::any('success','Index\\IndexController@success');
    Route::any('theFinal','Index\\IndexController@theFinal');
    Route::any('buyRecord','Index\\IndexController@buyRecord');
});
