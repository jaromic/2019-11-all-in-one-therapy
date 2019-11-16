@extends('backend.base')

@section('title')
    Meine Termine
@endsection
@section ('main')
    @if($reservedSlots)
        <h1>Meine Terminreservierungen</h1>
        @include('backend.includes.slot-table', ['slots' => $reservedAndConfirmedSlots])
    @else
        <p>Keine Terminreservierungen vorhanden.</p>
    @endif
    @if($availableSlots)
        <h1>Meine Verfügbarkeiten</h1>
        @include('backend.includes.slot-table', ['slots' => $availableSlots])
    @else
        <p>Keine Verfügbarkeiten vorhanden.</p>
    @endif

@endsection
