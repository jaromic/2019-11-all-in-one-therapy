@extends('backend.base')

@section('title')
    Patient
@endsection
@section ('main')
    <form method="post" action="{{ route('patient', $patient->id) }}">
        <table>
            <tr>
                <th>Name</th>
                <th>SVNr</th>
                <th>Adresse</th>
            </tr>
            @csrf
            <tr>
                <td>

                    <input type="text" name="firstname" value="{{$patient->firstname}}" placeholder="Vorname">
                    <input type="text" name="lastname" value="{{$patient->lastname}}" placeholder="Nachname">

                </td>
                <td>
                    <input type="text" name="svnr" value="{{$patient->svnr}}" placeholder="SVNr">
                </td>
                <td>
                    <input type="text" name="address" value="{{$patient->address}}" placeholder="Adresse">,
                    <input type="text" name="plz" value="{{$patient->plz}}" placeholder="PLZ"> <input type="text"
                                                                                                      name="city"
                                                                                                      value="{{$patient->city}}"
                                                                                                      placeholder="Stadt">,
                    <input type="text" name="country" value="{{$patient->country}}" placeholder="Land">

                    <button type="submit">Speichern</button>
                </td>

            </tr>
        </table>
    </form>
    <form method="post" action="/patient/{{$patient->id}}/delete">
        @csrf
        <p>Diesen Patienten löschen:
            <button type="submit">Löschen</button>
        </p>
    </form>
@endsection
