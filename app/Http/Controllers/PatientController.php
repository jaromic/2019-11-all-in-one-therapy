<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.patients', ['patients' => Patient::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.patient', ['patient' => null]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $patient = new Patient();
        $patient->firstname = $request->firstname;
        $patient->lastname = $request->lastname;
        $patient->email = $request->email;
        $patient->svnr = $request->svnr;
        $patient->address = $request->address;
        $patient->plz = $request->plz;
        $patient->city = $request->city;
        $patient->country = $request->country;
        $patient->save();
        session()->flash("message", "Patient {$patient->firstname} {$patient->lastname} wurde angelegt.");
        return view('backend.patient', ['patient' => Patient::find($patient->id)]);
    }

//    /**
//     * Display the specified resource.
//     *
//     * @param  int  $id
//     * @return \Illuminate\Http\Response
//     */
//    public function show($id)
//    {
//    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('backend.patient', ['patient' => Patient::find($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $patient = Patient::find($id);
        $patient->firstname=$request->firstname;
        $patient->lastname=$request->lastname;
        $patient->email = $request->email;
        $patient->svnr=$request->svnr;
        $patient->address=$request->address;
        $patient->plz=$request->plz;
        $patient->city=$request->city;
        $patient->country=$request->country;
        $patient->save();
        session()->flash("message", "Patient {$patient->firstname} {$patient->lastname} wurde gespeichert.");
        return view('backend.patient', ['patient' => Patient::find($id)]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $patient = Patient::find($id);
        $message = "Patient {$patient->firstname} {$patient->lastname} wurde gelöscht.";
        $patient->delete();
        session()->flash("message", $message);
        return redirect(route('patients'));
    }
}
