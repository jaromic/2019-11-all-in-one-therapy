<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource, optionally filtered
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $request = request();

        if($request->has('query')) {
            $query=$request->get('query');
            $patients = Patient::where('firstname','like',"%{$query}%")
                ->orWhere('lastname','like',"%{$query}%")
                ->orWhere('svnr','like',"%{$query}%")
                ->orderBy('lastname')
                ->paginate(15);
        } else {
            $patients = Patient::paginate(15);
        }
        return view('backend.patients', ['patients' => $patients]);
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
        return view('backend.patient', ['patient' => $patient]);
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
        $patient = Patient::findOrFail($id);
        return view('backend.patient', ['patient' => $patient]);
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
        $patient = Patient::findOrFail($id);
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
        return view('backend.patient', ['patient' => $patient]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $patient = Patient::findOrFail($id);
        $message = "Patient {$patient->firstname} {$patient->lastname} wurde gelöscht.";
        $patient->delete();
        session()->flash("message", $message);
        return redirect(route('patients'));
    }
}
