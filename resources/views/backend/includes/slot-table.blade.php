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
                @if($slot->patient)
                    {{ $slot->patient->firstname }} {{ $slot->patient->lastname }}, {{ $slot->patient->svnr }}
                @else
                    @include('backend.includes.slot-patient-chooser')
                @endif
            </td>
            <td>
                {{ ucfirst($slot->status) }}
            </td>
        </tr>
        @endforeach
</table>
{{ $slots->links() }}</p>
