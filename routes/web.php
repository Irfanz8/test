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

Route::get('/', 'UserController@index');
Route::get('user/data', 'UserController@data');
Route::get('user/add', 'UserController@add_form');
Route::get('/companies', 'UserController@loadDataCompanies');
Route::get('/events', 'UserController@loadDataEvents');
Route::get('user/edit/{id}', 'UserController@edit');
Route::post('/add_process','UserController@add_process');
Route::put('/edit_process/{id}','UserController@edit_process');
