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
        Route::get('/list','CategoryController@index')->name('listCate');
        Route::post('/create','CategoryController@store')->name('addCate');
        Route::get('/edit','CategoryController@edit')->name('editCate');
        Route::delete('/del','CategoryController@destroy')->name('delCate');
    });


    Route::group(['prefix' => 'discount'], function () {
        Route::get('/list','DiscountController@index')->name('listDis');
        Route::post('/create','DiscountController@store')->name('addDis');
        Route::get('/edit','DiscountController@edit')->name('editDis');
        Route::delete('/del', 'DiscountController@destroy')->name('delDis');
    });


    Route::group(['prefix' => 'store'], function () {
        Route::get('/list','StoreController@index')->name('listSto');
        Route::post('/create','StoreController@store')->name('addSto');
        Route::get('/edit','StoreController@edit')->name('editSto');
        Route::delete('/del', 'StoreController@destroy')->name('delSto');
    });
    Route::group(['prefix' => 'address'], function () {
        Route::get('/list','AddressController@index')->name('listAddress');
        Route::post('/create','DiscountController@store')->name('addDis');
        Route::get('/edit','DiscountController@edit')->name('editDis');
        Route::delete('/del', 'DiscountController@destroy')->name('delDis');
    });

});