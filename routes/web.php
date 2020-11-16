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
//     return view('backend.Food.ds');
// })->name('danhsach');



// Route::get('/danhsach','FoodController@listFood')->name('list');
// Route::get('/getDS','FoodController@getDS')->name('getDS');



// Route::get('/ds','FoodController@index')->name('listFood');
// Route::post('/create','FoodController@addFood')->name('addFood');
// Route::get('/edit','FoodController@editFood')->name('editFood');
// Route::delete('/del','FoodController@delFood')->name('delFood');


Route::group(['prefix' => 'admin'], function () {
    // FOOD
    Route::group(['prefix' => 'food'], function () {
        Route::get('/list','FoodController@index')->name('listFood');
        Route::post('/create','FoodController@addFood')->name('addFood');
        Route::get('/edit','FoodController@editFood')->name('editFood');
        Route::delete('/del','FoodController@delFood')->name('delFood');
    });
    // CATEGORY
    Route::group(['prefix' => 'category'], function () {
        
    });
});