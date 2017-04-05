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
Route::delete('/{book}', 'BookController@destroy')->name('book.destroy');

//Loan
Route::post('/loan', 'LoanController@store')->name('loan.store');

// Admin
Route::get('/admin', 'AdminController@index')->name('admin.index');
// User
Route::post('/user', 'UserController@store')->name('user.store');

// Route::get('/home', 'HomeController@index');
//
// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/site', function () {
//     return view('site');
// });
// Route::get('/admin', function () {
//     return view('admin');
// });
