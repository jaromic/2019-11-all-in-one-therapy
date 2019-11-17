@extends('backend.base')

@section('title')
    Home
@endsection
@section ('main')
    <div style="width:400px; margin-left: auto; margin-right: auto">
        <h1>Willkommen, {{ $user->name }}!</h1>

        <p>
        Sie haben aufgrund Ihrer Rolle(n) {{ implode(", ", $user->getRoleNames()) }} die folgenden
        Berechtigungen: {{ implode(", ", $user->getPermissionNames()) }}
        </p>

        @if(App\User::hasPermission('view-own-data') && $patient)
            <p>Sie sind Patient.</p>

            <h2>Meine Stammdaten</h2>
            <p>{{ $patient->firstname }} {{ $patient->lastname }} &lt;{{$patient->email}}&gt;, {{ $patient->svnr }}</p>
            <p>{{ $patient->address }}, {{ $patient->plz }} {{ $patient->city }}, {{ $patient->country }}</p>

            <h2>Meine Termine</h2>

            @include('backend.includes.patient-slot-table', ['slots' => $mySlots])

            <h2>Termin buchen</h2>
            <form method="post" action="/slot/reserve">
                @csrf
                <select name="slot_id">
                    @forelse($availableSlots as $slot)
                        <option value="{{ $slot->id }}">{{ $slot->user->name }}: {{$slot->start->format('d.m. H:i')}}</option>
                    @empty
                        <option value="">(Leider sind keine Termine verfuegbar)</option>
                    @endforelse
                </select>
                <p>Buchungen sind erst nach Bestätigung durch den Behandler verbindlich.</p>
                <button type="submit">Buchen</button>
            </form>

            <h2>Meine Rechnungen</h2>
            <p>Nicht implementiert.</p>

            @else
            Sie sind kein Patient.
        @endif

    </div>
@endsection
