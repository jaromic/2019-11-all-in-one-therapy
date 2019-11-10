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

Route::get('/', function () {
    return view('frontend');
})->name('/');

Route::get('/backend', function () {
    return view('backend');
})->name('backend');

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::post('authenticate', 'Auth\LoginController@login')->name('authenticate');
