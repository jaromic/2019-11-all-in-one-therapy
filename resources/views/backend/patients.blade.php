@extends('backend.base')

@section('title')
    Patienten
@endsection
@section ('main')
    <p><a href="{{ route('newpatient') }}">Neuer Patient</a></p>
    <p>
        <form method="get" action="{{ route('patients') }}">
            @csrf
            &#x1F50D;<input type="text" name="query" placeholder="Name oder SVNr" value="{{ request()->get('query') }}">
            <button type="submit">Suchen</button>
        </form>
    </p>
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
    {{ $patients->links() }}
    <a href="{{ route('newpatient') }}">Neuer Patient</a>
@endsection
