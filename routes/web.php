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

use Illuminate\Http\Request;

Route::get('/dropbox/auth', 'DropboxController@index');
Route::get('/dropbox/callback', 'DropboxController@store');

Route::get('/{vue_capture?}', function (Request $request) {
    if ($request->input('email_confirmed')) {
        return view('index')->with('email_confirmed', true);
    }
    return view('index');
})->where('vue_capture', '[\/\w\.-]*');
