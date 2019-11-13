@extends('backend.base')

@section('title')
    Neue Dokumentation
@endsection
@section ('main')
    <p>Autor: {{ auth()->user()->name }}</p>
    <form method="post" action="{{ route('documentation', $patientId) }}">
        @csrf
        <textarea name="text" placeholder="Text"></textarea>
        <button type="submit">Speichern</button>
    </form>
@endsection
