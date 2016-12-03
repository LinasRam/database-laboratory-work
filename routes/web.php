<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', 'DriversController@index')->name('drivers');
Route::post('/', 'DriversController@postIndex')->name('postDrivers');
Route::get('/driver/{id}/edit', 'DriversController@editDriver')->name('editDriver');
Route::post('/driver/{id}/edit', 'DriversController@postEditDriver')->name('postEditDriver');
Route::get('/driver', 'DriversController@newDriver')->name('newDriver');
Route::post('/driver', 'DriversController@postDriver')->name('postDriver');
Route::get('/driver/{id}/delete', 'DriversController@deleteDriver')->name('deleteDriver');
