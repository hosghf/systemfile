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

Route::get('/home', 'HomeController@index')->name('home');
//Route::get('/test', 'testController@index');

//file
Route::get('/registerfile', 'file\fileController@registerIndex')->name('registerfile');
Route::post('/registerfile', 'file\fileController@registerStore');
Route::get('/showfile/{id}', 'file\fileController@show');
Route::get('/updatefile/{id}', 'file\fileController@updateShow');
Route::post('/updatefile/{id}', 'file\fileController@update');
Route::get('/arichivefile/{id}', 'file\fileController@archive');
Route::get('/deletefile/{id}', 'file\fileController@delete');
//list file
Route::get('/listfile', 'file\fileSearchController@filter')->name('listfile');
Route::post('/filterfile', 'file\fileSearchController@filter')->name('filterfile');
Route::post('/searchfile', 'file\fileSearchController@filter')->name('searchfile');

//moshtari
Route::get('/listmoshtari', 'customer\customerController@list')->name('listmoshtari');
Route::post('/searchmoshtari', 'customer\customerController@list')->name('searchmoshtari');
Route::post('/filtermoshtari', 'customer\customerController@list')->name('filtermoshtari');

Route::get('/showcustomer/{id}', 'customer\customerController@show')->name('');
Route::get('/registercustomer', 'customer\customerController@registerIndex')->name('registercustomer');
Route::post('/registercustomer', 'customer\customerController@store');
Route::get('/updatecustomer/{id}', 'customer\customerController@showUpdate');
Route::post('/updatecustomer/{id}', 'customer\customerController@update');
Route::get('/deletecustomer/{id}', 'customer\customerController@delete');

//users
Route::get('/registerpersonel', 'usermanagement\usersController@registerIndex');
Route::post('/registerpersonel', 'usermanagement\usersController@store');
Route::get('/listpersonel', 'usermanagement\usersController@list');
Route::get('/updatepersonel/{id}', 'usermanagement\usersController@showUpdate');
Route::post('/updatepersonel/{id}', 'usermanagement\usersController@update');
Route::get('/deletepersonel/{id}', 'usermanagement\usersController@delete');
Route::post('/changepassword/{id}', 'usermanagement\usersController@changepassword');



Route::get('/test', 'testController@test');
Route::post('/test', 'testController@test2');
Route::get('/test3', 'testController@test3');



