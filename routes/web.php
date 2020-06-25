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

Route::get('/','HomeController@index')->name('home');

Auth::routes(['register' => false]);

//reservation
Route::post('/reservation','ReservationController@store')->name('reservation.store');

//contact
Route::post('/contact','ContactController@store')->name('contact.store');

Route::group(['prefix'=>'admin', 'namespace'=>'Admin', 'middleware'=>'auth'],function (){
   Route::get('/dashboard', 'DashboardController@index')->name('admin.dashboard');

   //slider
    Route::get('/slider','SliderController@index')->name('admin.slider');
    Route::get('/slider/create','SliderController@create')->name('admin.slider.create');
    Route::post('/slider/store','SliderController@store')->name('admin.slider.store');
    Route::get('/slider/edit/{id}','SliderController@edit')->name('admin.slider.edit');
    Route::put('/slider/update/{id}','SliderController@update')->name('admin.slider.update');
    Route::delete('/slider/destroy/{id}','SliderController@destroy')->name('admin.slider.destroy');

    Route::get('/slider/publish/{id}','SliderController@publish')->name('admin.slider.publish');
    Route::get('/slider/pending/{id}','SliderController@pending')->name('admin.slider.pending');


    //category
    Route::get('/category','CategoryController@index')->name('admin.category');
    Route::get('/category/create','CategoryController@create')->name('admin.category.create');
    Route::post('/category/store','CategoryController@store')->name('admin.category.store');
    Route::get('/category/edit/{id}','CategoryController@edit')->name('admin.category.edit');
    Route::put('/category/update/{id}','CategoryController@update')->name('admin.category.update');
    Route::delete('/category/destroy/{id}','CategoryController@destroy')->name('admin.category.destroy');

    Route::get('/category/publish/{id}','CategoryController@publish')->name('admin.category.publish');
    Route::get('/category/pending/{id}','CategoryController@pending')->name('admin.category.pending');

    //item
    Route::get('/item','ItemController@index')->name('admin.item');
    Route::get('/item/create','ItemController@create')->name('admin.item.create');
    Route::post('/item/store','ItemController@store')->name('admin.item.store');
    Route::get('/item/edit/{id}','ItemController@edit')->name('admin.item.edit');
    Route::put('/item/update/{id}','ItemController@update')->name('admin.item.update');
    Route::delete('/item/destroy/{id}','ItemController@destroy')->name('admin.item.destroy');

    Route::get('/item/publish/{id}','ItemController@publish')->name('admin.item.publish');
    Route::get('/item/pending/{id}','ItemController@pending')->name('admin.item.pending');

    //reservation
    Route::get('/reservation','ReservationController@index')->name('admin.reservation');
    Route::delete('/reservation/destroy/{id}','ReservationController@destroy')->name('admin.reservation.destroy');
    Route::get('/reservation/publish/{id}','ReservationController@publish')->name('admin.reservation.publish');
    Route::get('/reservation/pending/{id}','ReservationController@pending')->name('admin.reservation.pending');

    //contact
    Route::get('/contact','ContactController@index')->name('admin.contact');
    Route::get('/contact/show/{id}','ContactController@details')->name('admin.contact.show');
    Route::delete('/contact/destroy/{id}','ContactController@destroy')->name('admin.contact.destroy');

});
