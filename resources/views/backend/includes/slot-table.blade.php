<table style="width:85%">
    <tr>
        <th>Von</th>
        <th>Bis</th>
        <th>Patient</th>
        <th>Status</th>
    </tr>
    @forelse($slots as $slot)
        <tr>
            <td>
                {{ $slot->start }}
            </td>
            <td>
                {{ $slot->end }}
            </td>
            <td>
                @include('backend.includes.slot-patient-chooser', ['slot'=>$slot])
            </td>
            <td>
                @include('backend.includes.slot-status-chooser', ['slot' => $slot, 'slotStati' => $slotStati])
            </td>
        </tr>
        @endforeach
</table>
{{ $slots->links() }}</p>
