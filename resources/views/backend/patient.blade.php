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
    @if ($errors->any())
        <div class="validation-errors">
            <ul class="validation-error">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="post" action="{{ $patient ? route('patient', $patient->id) : route('newpatient') }}">
        @csrf
        <div class="inputform">
            @error('firstname')
            <p class="validation-error">{{ $message }}</p>
            @enderror
            @error('lastname')
            <p class="validation-error">{{ $message }}</p>
            @enderror
            <p>
                <label>Name:</label>
                <input type="text" name="firstname" value="{{$patient ? $patient->firstname : old('firstname')}}"
                       placeholder="Vorname">
                <input type="text" name="lastname" value="{{$patient ? $patient->lastname : old('lastname')}}"
                       placeholder="Nachname">
            </p>
            @error('email')
            <p class="validation-error">{{ $message }}</p>
            @enderror
            <p>
                <label>E-Mail:</label>
                <input type="text" name="email" value="{{$patient ? $patient->email : old('email')}}"
                       placeholder="E-Mail">
            </p>
            @error('svnr')
            <p class="validation-error">{{ $message }}</p>
            @enderror
            <p>
                <label>SVNr:</label>
                <input type="text" name="svnr" value="{{$patient ? $patient->svnr : old('svnr')}}" placeholder="SVNr">
            </p>
            @error('address')
            <p class="validation-error">{{ $message }}</p>
            @enderror
            @error('plz')
            <p class="validation-error">{{ $message }}</p>
            @enderror
            @error('city')
            <p class="validation-error">{{ $message }}</p>
            @enderror
            @error('country')
            <p class="validation-error">{{ $message }}</p>
            @enderror<p>
                <label>Adresse:</label>
                <input type="text" name="address" value="{{$patient ? $patient->address : old('address')}}"
                       placeholder="Adresse">,<br/>
                <label></label>
                <input type="text" name="plz" value="{{$patient ? $patient->plz : old('plz')}}" placeholder="PLZ">
                <input type="text" name="city" value="{{$patient ? $patient->city : old('city')}}" placeholder="Stadt">,
                <input type="text" name="country" value="{{$patient ? $patient->country: old('country')}}"
                       placeholder="Land">
            </p>
            <p>
                <button type="submit">{{ $patient ? 'Anlegen' : 'Speichern' }}</button>
            </p>
        </div>
    </form>
    @if($user)
        <h2>Benutzer</h2>
        <p>Dieser Patient ist unter dem Benutzer {{ $user->name }} registriert.</p>
        @else
        <h2>Kein Benutzer</h2>
        <p>Dieser Patient hat kein Benutzerkonto.</p>
    @endif
    @if($patient)
        @if(!empty($patient->documentations))
            <h2>Dokumentationen</h2>
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
            <h2>Keine Dokumentationen</h2>
            <p>Keine Dokumentation vorhanden.</p>
        @endif

        <h2>Datenschutz</h2>
        <form method="post" action="/patient/{{$patient->id}}/delete">
            @csrf
            <p>Diesen Patienten löschen:
                <button type="submit">Löschen</button>
            </p>
        </form>

        <p><a href="{{ route('newdocumentation', $patient->id) }}">Neue Dokumentation</a></p>
    @endif
    <p><a href="{{ route('patients') }}">Alle Patienten anzeigen.</a></p>
@endsection
