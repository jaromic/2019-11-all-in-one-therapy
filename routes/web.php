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

Route::get('/backend', function () {
    return view('backend');
})->name('backend')
->middleware('auth');

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::get('/patients', function() {
    return view('backend.patients', ['patients' => Patient::all()]);
})->name('patients');

Route::get('/patient/{id}', function($id) {
    return view('backend.patient', ['patient' => Patient::find($id)]);
})->name('patient');

Route::post('/patient/{id}', function($id) {
    $patient = Patient::find($id);
    $request=request();
    $patient->firstname=$request->firstname;
    $patient->lastname=$request->lastname;
    $patient->svnr=$request->svnr;
    $patient->address=$request->address;
    $patient->plz=$request->plz;
    $patient->city=$request->city;
    $patient->country=$request->country;
    $patient->save();
    return view('backend.patient', ['patient' => Patient::find($id)]);
});

Route::post('/patient/{id}/delete', function($id) {
    $patient = Patient::find($id);
    $patient->delete();
    session()->flash("message", "Patient {$patient->vorname} {$patient->nachname} wurde gelöscht.");
    return redirect(route('patients'));
});

Route::post('authenticate', 'Auth\LoginController@login')->name('authenticate');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');
