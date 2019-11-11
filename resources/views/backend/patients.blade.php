@extends('backend.base')

@section('title')
    Patienten
@endsection
@section ('main')
    <table>
        <tr>
            <th>Name</th>
            <th>SVNr</th>
            <th>Adresse</th>
        </tr>
    @foreach ($patients as $patient)
        <tr>
            <td>
                <a href="{{ route('patient', $patient->id) }}">
                    {{$patient->firstname }} {{$patient->lastname}}
                </a>
            </td>
            <td>
                {{$patient->svnr}}
            </td>
            <td>
                {{$patient->address}},
                {{$patient->plz}} {{$patient->city}},
                {{$patient->country}}
            </td>
        </tr>
    @endforeach
    </table>
@endsection
