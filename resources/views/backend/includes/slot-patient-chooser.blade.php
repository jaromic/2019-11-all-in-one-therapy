<form method="post" action="{{ "/slot/{$slot->id}/assignpatient" }}">
    @csrf
<select name="patient_id" onchange="this.form.submit()">
    @if($slot->patient)
        <option value="">(Kein Patient)</option>
    @else
        <option selected="selected" value="">(Kein Patient)</option>
    @endif
    @forelse($patients as $patient)
        @if($slot->patient && $slot->patient->id == $patient->id)
            <option selected="selected"
                     value="{{ $patient->id }}">{{ $patient->lastname }}, {{ $patient->firstname }}</option>
        @else
            <option value="{{ $patient->id }}">{{ $patient->lastname }}, {{ $patient->firstname }}</option>
        @endif
    @empty
        <option selected="selected" value="">(Keine Patienten gefunden)</option>
    @endforelse
</select>
</form>
