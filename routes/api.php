<?php

use Illuminate\Http\Request;

Route::get('/data', 'DataController@index')->name('path.index');
Route::post('/data', 'DataController@store')->name('path.store');
Route::get('/data/{data}', 'DataController@show')->name('path.show');
Route::put('/data/{data}', 'DataController@update')->name('path.update');
Route::delete('/data/{data}', 'DataController@destroy')->name('path.destroy');