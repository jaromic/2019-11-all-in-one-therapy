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
        @include('backend.includes.slot-table', ['slots' => $availableSlots, 'showDeleteAction'=>true])
    @else
        <p>Keine Verfügbarkeiten vorhanden.</p>
    @endif
    <h1>Neue Verfügbarkeiten</h1>
    <form method="post" action="/slots/create">
        @csrf
        <label for="day_date">Tag:</label>
        <select name="day_date">
            @foreach(App\Slot::getNextWorkingDays(14) as $date)
                <option @if($loop->first)selected="selected"@endif name="{{$date}}">{{ $date->format('D, d.m.') }}</option>
            @endforeach
        </select>
        <label for="start">Von:</label>
        <input type="text" name="start" value="10:00" style="width:60px">
        <label for="end">Bis:</label>
        <input type="text" name="end" value="16:00" style="width:60px">
        <button type="submit">Erzeugen</button>
    </form>

@endsection
