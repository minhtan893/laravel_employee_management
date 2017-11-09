<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'HomeController@index')->name('home');

//User
Route::group(['prefix' => 'user', 'as' => 'user.'], function(){
    Route::get('/', 'UserController@index')->name('index');
    Route::get('/create', 'UserController@create')->name('create');
    Route::post('/save', 'UserController@save')->name('save');
    Route::get('/{id}', 'UserController@detail')->name('detail');
    Route::get('/delete/{id}', 'UserController@delete')->name('delete');
});

//Schedule
Route::get('/schedule', 'ScheduleController@generate')->name('schedule.generate');