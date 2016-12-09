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
Route::post('/driver/report', 'DriversController@getReport')->name('driverReport');
Route::get('/driver/report/form', 'DriversController@getReportForm')->name('driverReportForm');

Route::get('/trolleybuses', 'TrolleybusController@index')->name('trolleybuses');
Route::get('/trolleybus', 'TrolleybusController@newTrolleybus')->name('newTrolleybus');
Route::post('/trolleybus', 'TrolleybusController@postTrolleybus')->name('postTrolleybus');
Route::get('/trolleybus/{id}/delete', 'TrolleybusController@deleteTrolleybus')->name('deleteTrolleybus');
Route::get('/trolleybus/{id}/edit', 'TrolleybusController@editTrolleybus')->name('editTrolleybus');
Route::post('/trolleybus/{id}/edit', 'TrolleybusController@postEditTrolleybus')->name('postEditTrolleybus');
Route::get('/trolleybus/{id}/available-drivers', 'TrolleybusController@getTrolleybusAvailableDrivers')->name('getTrolleybusAvailableDrivers');
Route::post('/trolleybus/{id}/attach-driver', 'TrolleybusController@attachDriver')->name('attachDriver');
Route::get('/trolleybus/{id}/detach-driver/{driverId}', 'TrolleybusController@detachDriver')->name('detachDriver');
Route::get('/trolleybus/report/form', 'TrolleybusController@getReportForm')->name('trolleybusReportForm');
Route::post('/trolleybus/report', 'TrolleybusController@getReport')->name('trolleybusReport');

Route::post('route/report', 'RouteController@getReport')->name('routeReport');
Route::get('route/report/form', 'RouteController@getReportForm')->name('routeReportForm');
