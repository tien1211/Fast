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


// Route::get('/indexx',function(){
//     return view('backend.layout.master');
// });

// Route::get('/list',function(){
//     return view('backend.Food.list');
// });

Route::get('/danhsach','FoodController@listFood')->name('listFood');
Route::get('/getDS','FoodController@getDS')->name('getDS');