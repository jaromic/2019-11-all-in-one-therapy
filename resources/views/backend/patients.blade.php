@extends('backend.base')

@section('title')
    Patienten
@endsection
@section ('main')
    <a href="{{ route('newpatient') }}">Neuer Patient</a>
    <table>
        <tr>
            <th>Name</th>
            <th>SVNr</th>
            <th>Adresse</th>
            <th>Aktion</th>
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
            <td>
                <form method="post" action="/patient/{{$patient->id}}/delete">
                    @csrf
                    <button type="submit">Löschen</button>
                </form>
            </td>
        </tr>
    @endforeach
    </table>
    <a href="{{ route('newpatient') }}">Neuer Patient</a>
@endsection
