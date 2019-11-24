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

use App\Patient;

Route::get('/', function () {
    return view('frontend');
})->name('/');

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::post('authenticate', 'Auth\LoginController@login')->name('authenticate');

Route::group(["middleware" => ['auth']], function () {

    Route::get('/backend', function () {
        return view('backend');
    })->name('backend');

    Route::get('/documentation/{patientId}', 'DocumentationController@create')->name('newdocumentation');
    Route::post('/documentation/{patientId}', 'DocumentationController@store')->name('documentation');
    Route::get('/documentations', 'DocumentationController@index')->name('documentations');

    Route::get('/patients', 'PatientController@index')->name('patients');
    Route::get('/patient/{id}', 'PatientController@edit')->name('patient');
    Route::get('/patient/', 'PatientController@create')->name('newpatient');
    Route::post('/patient/', 'PatientController@store')->name('newpatient');
    Route::post('/patient/{id}', 'PatientController@update')->name('patient');
    Route::post('/patient/{id}/delete', 'PatientController@destroy');

    Route::get('/bills', function() {
        session()->flash('message','Not implemented.');
        return redirect('/backend');
    })->name('bills');
    Route::get('/slots', function() {
        session()->flash('message','Not implemented.');
        return redirect('/backend');
    })->name('slots');

    Route::get('logout', 'Auth\LoginController@logout')->name('logout');

});
