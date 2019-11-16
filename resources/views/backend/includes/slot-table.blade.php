<table style="width:85%">
    <tr>
        <th>Slot</th>
        <th>Patient</th>
        <th>Status</th>
        @if(isset($showDeleteAction) && $showDeleteAction)
            <th>Aktion</th>
        @endif
    </tr>
    @foreach($slots as $slot)
        <tr>
            <td>
                {{ $slot->start->format('D d.m. H:i') }} &ndash; {{ $slot->end->format('H:i') }}
            </td>
            <td>
                @include('backend.includes.slot-patient-chooser', ['slot'=>$slot])
            </td>
            <td>
                @include('backend.includes.slot-status-chooser', ['slot' => $slot, 'slotStati' => $slotStati])
            </td>
            @if(isset($showDeleteAction) && $showDeleteAction)
                <td>
                    <form method="post" action=" {{ "/slot/{$slot->id}/destroy" }}">
                        @csrf
                        <button type="submit">X</button>
                    </form>
                </td>
            @endif
        </tr>
    @endforeach
</table>
{{ $slots->links() }}</p>
