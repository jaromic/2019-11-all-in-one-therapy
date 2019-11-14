@extends('backend.base')

@section('title')
    Neue Dokumentation
@endsection
@section ('main')
    <p>Autor: {{ $user->name }}</p>
    <p>Patient: {{ $patient->firstname }} {{ $patient->lastname }}</p>
    <form method="post" action="{{ route('documentation', $patientId) }}">
        @csrf
        <textarea name="text" placeholder="Text"></textarea>
        <button type="submit">Speichern</button>
    </form>
@endsection
