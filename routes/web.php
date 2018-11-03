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
//user的路由
//注册
//Route::post('user/index','User\UserController@index')->name('index');
Route::get('user/register','User\UserController@create')->name('register');
Route::post('user/store','User\UserController@store')->name('store');

Route::get('user/index','User\UserController@index')->name('user.index');
//登录
Route::get('login','User\SessionController@create')->name('login');
Route::post('login','User\SessionController@store')->name('login');
//注销
Route::get('logout','User\SessionController@destroy')->name('logout');
//商户管理
//修改密码
Route::get('user/{users}/editpass','User\SessionController@edit')->name('editpass');
Route::post('user/updatepass','User\SessionController@updatepass')->name('updatepass');
//菜品分类
Route::resource('menucategory','MenuCategoryController');
//菜品
Route::resource('menu','MenuController');

//活动
Route::resource('activity','ActivityController');
//订单
Route::resource('order','OrderController');
//日统计订单
Route::get('order.indexd','OrderController@indexd')->name('order.indexd');
//月统计订单
Route::get('order.indexm','OrderController@indexm')->name('order.indexm');
