<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Patient;
use App\User;
use \InvalidArgumentException;
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
        User::requirePermission('admin-patient');

        $request = request();

        $orderBy = $request->query('orderBy', 'lastname');
        $orderDirection = $request->query('orderDirection', 'asc');

        if (!in_array($orderBy, ['firstname', 'lastname', 'svnr', 'address'])) {
            throw new InvalidArgumentException("Invalid sort key.");
        } elseif (!in_array($orderDirection, ['asc', 'desc'])) {
            throw new InvalidArgumentException("Invalid sort direction.");
        }

        if ($request->has('query')) {
            $query = $request->get('query');
            $patients = Patient::where('firstname', 'like', "%{$query}%")
                ->orWhere('lastname', 'like', "%{$query}%")
                ->orWhere('svnr', 'like', "%{$query}%")
                ->orderBy($orderBy, $orderDirection)
                ->paginate(getenv('AIOT_PAGINATE_ROWS'));
        } else {
            $patients = Patient::orderBy($orderBy, $orderDirection)
                ->paginate(getenv('AIOT_PAGINATE_ROWS'));
        }
        return view('backend.patients', [
            'patients' => $patients,
            'orderBy' => $orderBy,
            'orderDirection' => $orderDirection,
            'orderDirectionIndicator' => ($orderDirection == 'asc') ? '&darr;' : '&uarr;',
            'inverseOrderDirection' => ($orderDirection == 'asc') ? 'desc' : 'asc',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        User::requirePermission('admin-patient');

        return view('backend.patient', ['patient' => null]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        User::requirePermission('admin-patient');

        $request->validate([
            'firstname' => 'required|alpha_dash|max:255',
            'lastname' => 'required|alpha_dash|max:255',
            'email' => 'email',
            'svnr' => 'required|numeric|digits:10|unique:patients',
            'address' => 'string|nullable|max:500',
            'plz' => 'required|numeric|digits_between:4,5',
            'city' => 'required|alpha_dash|max:255',
            'country' => 'required|alpha_dash|max:255',
        ]);

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
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        User::requirePermission('admin-patient');

        $patient = Patient::findOrFail($id);
        $user = $patient->user;
        return view('backend.patient', ['patient' => $patient, 'user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        User::requirePermission('admin-patient');

        $patient = Patient::findOrFail($id);
        $patient->firstname = $request->firstname;
        $patient->lastname = $request->lastname;
        $patient->email = $request->email;
        $patient->svnr = $request->svnr;
        $patient->address = $request->address;
        $patient->plz = $request->plz;
        $patient->city = $request->city;
        $patient->country = $request->country;
        $patient->save();
        session()->flash("message", "Patient {$patient->firstname} {$patient->lastname} wurde gespeichert.");
        return view('backend.patient', ['patient' => $patient]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::requirePermission('admin-patient');

        $patient = Patient::findOrFail($id);
        $message = "Patient {$patient->firstname} {$patient->lastname} wurde gelöscht.";
        $patient->delete();
        session()->flash("message", $message);
        return redirect(route('patients'));
    }
}
