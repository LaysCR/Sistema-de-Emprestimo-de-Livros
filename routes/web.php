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
Auth::routes();
//Admin
Route::get('/', 'BookController@index')->name('book.index');
Route::post('/book', 'BookController@store')->name('book.store');
Route::delete('/{book}', 'BookController@destroy')->name('book.destroy');
//Other
Route::get('/admin', 'AdminController@index')->name('admin.index');
Route::post('/loan', 'AdminController@storeLoan')->name('admin.storeLoan');

//User


Route::get('/home', 'HomeController@index');
