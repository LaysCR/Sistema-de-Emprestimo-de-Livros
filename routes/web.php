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
//Book
Route::get('/', 'BookController@index')->name('book.index');
Route::post('/book', 'BookController@store')->name('book.store');
//Loan
Route::post('/loan', 'LoanController@store')->name('loan.store');

// Admin
Route::get('/admin1', 'AdminController@index')->name('admin1.index');
// User
Route::post('/user', 'UserController@store')->name('user.store');


// INDEX
Route::get('/admin/user', 'UserController@index')->name('admin.user');
Route::get('/admin/book', 'BookController@index')->name('admin.book');
Route::get('/admin/loan', 'LoanController@index')->name('admin.loan');

// DELETE 
Route::delete('/book/{book}', 'BookController@destroy')->name('book.destroy');
Route::delete('/loan/{loan}', 'LoanController@destroy')->name('loan.destroy');
Route::delete('/user/{user}', 'UserController@destroy')->name('user.destroy');
