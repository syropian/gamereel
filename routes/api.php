<?php

use Illuminate\Http\Request;

Route::get('/auth', 'AuthController@show');
Route::post('/auth', 'AuthController@store');

Route::post('/users', 'UserController@store');
