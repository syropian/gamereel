<?php

use Illuminate\Http\Request;

Route::get('/auth', 'AuthController@show');
Route::post('/auth', 'AuthController@store');

Route::post('/users', 'UserController@store');
Route::get('/users/confirm', 'UserConfirmationController@index');

Route::get('/clips', 'ClipsController@index');
Route::post('/clips/save', 'ClipsController@update');
Route::put('/clip/tags', 'ClipTagsController@update');

Route::get('/xbox-clips', 'XboxClipsController@index');

Route::get('/tags', 'TagController@index');
