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

//Route::get('/', function () {
//    return view('welcome');
//});

Auth::routes();

Route::get('/', 'CategoryController@treeview')->name('treeview');
Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['auth']], function() {
    Route::get('/category', 'CategoryController@create')->name('category.create');
    Route::post('/store', 'CategoryController@store')->name('category.store');

    Route::get('/updateName', 'CategoryController@updateName')->name('category.updateName');
    Route::post('/updateNameStore', 'CategoryController@updateNameStore')->name('category.updateNameStore');

    Route::get('/moveNode', 'CategoryController@moveNode')->name('category.moveNode');
    Route::post('/moveNodeStorage', 'CategoryController@moveNodeStorage')->name('category.moveNodeStorage');

    Route::get('/deleteNode', 'CategoryController@delete')->name('category.delete');
    Route::post('/deleteNodeStorage', 'CategoryController@deleteNode')->name('category.deleteNode');
});








