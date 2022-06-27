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

//Category Route
Route::get('category/all', 'CategoryController@allCategory')->name('all.category');
Route::post('category/add', 'CategoryController@addCategory')->name('add.category');
Route::get('category/edit/{id}', 'CategoryController@editCategory');
Route::post('store/category/{id}', 'CategoryController@updateCategory');
Route::get('category/delete/{id}','CategoryController@softDelete' );
Route::get('category/restore/{id}', 'CategoryController@restoreCategory');
Route::get('delete/category/{id}', 'CategoryController@deleteCategory');
