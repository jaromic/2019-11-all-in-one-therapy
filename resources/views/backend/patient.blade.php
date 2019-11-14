@extends('backend.base')

@section('title')
    @if($patient)
        Patient bearbeiten
    @else
        Neuer Patient
    @endif
@endsection
@section ('main')
    @if($patient)
        <h1 xmlns="http://www.w3.org/1999/html">{{$patient->firstname}} {{$patient->lastname}}</h1>
    @endif
    <a href="{{ route('patients') }}">Alle Patienten anzeigen.</a>
    <h2>Stammdaten</h2>
    <form method="post" action="{{ $patient ? route('patient', $patient->id) : route('newpatient') }}">
        <table>
            <tr>
                <th>Name</th>
                <th>E-Mail</th>
                <th>SVNr</th>
                <th>Adresse</th>
            </tr>
            @csrf
            <tr>
                <td>

                    <input type="text" name="firstname" value="{{$patient ? $patient->firstname : ''}}"
                           placeholder="Vorname">
                    <input type="text" name="lastname" value="{{$patient ? $patient->lastname : ''}}"
                           placeholder="Nachname">
                </td>
                <td>
                    <input type="text" name="email" value="{{$patient ? $patient->email : ''}}" placeholder="E-Mail">
                </td>
                <td>
                    <input type="text" name="svnr" value="{{$patient ? $patient->svnr : ''}}" placeholder="SVNr">
                </td>
                <td>
                    <input type="text" name="address" value="{{$patient ? $patient->address : ''}}"
                           placeholder="Adresse">,
                    <input type="text" name="plz" value="{{$patient ? $patient->plz : ''}}" placeholder="PLZ">
                    <input type="text" name="city" value="{{$patient ? $patient->city : ''}}" placeholder="Stadt">,
                    <input type="text" name="country" value="{{$patient ? $patient->country: ''}}" placeholder="Land">

                    <button type="submit">{{ $patient ? 'Anlegen' : 'Speichern' }}</button>
                </td>

            </tr>
        </table>
    </form>
    @if($patient)
        <form method="post" action="/patient/{{$patient->id}}/delete">
            @csrf
            <p>Diesen Patienten löschen:
                <button type="submit">Löschen</button>
            </p>
        </form>

        <h2>Dokumentationen</h2>
        @if(!empty($patient->documentations))
            <table style="max-width: 80%">
                <tr>
                    <th>Datum</th>
                    <th>Autor</th>
                    <th>Beschreibung</th>
                </tr>
                @foreach($patient->documentations as $documentation)
                    <tr>
                        <td>{{ $documentation->created_at->toDateString() }}</td>
                        <td>{{ $documentation->user->name }}</td>
                        <td>{{ $documentation->text }}</td>
                        <td></td>
                    </tr>
                @endforeach
            </table>
        @else
            <p>Keine Dokumentation vorhanden.</p>
        @endif


    @endif
    @if($patient)
        <p><a href="{{ route('newdocumentation', $patient->id) }}">Neue Dokumentation</a></p>
    @endif
    <p><a href="{{ route('patients') }}">Alle Patienten anzeigen.</a></p>
@endsection
