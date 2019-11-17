<table style="width:85%">
    <tr>
        <th>Slot</th>
        <th>Patient</th>
        <th>Status</th>
        @if(isset($showDeleteAction) && $showDeleteAction)
            <th>Aktion</th>
        @endif
    </tr>

    @foreach($slots->all() as $slot)
        <tr>
            <td>
                {{ $slot->start->format('D d.m. H:i') }} &ndash; {{ $slot->end->format('H:i') }}
            </td>
            <td>
                @if(App\User::hasPermission('admin-calendar'))
                    @include('backend.includes.slot-patient-chooser', ['slot'=>$slot])
                @else
                    {{$slot->patient ?? 'Kein Patient' }}
                @endif
            </td>
            <td>
                @if(App\User::hasPermission('admin-calendar'))
                    @include('backend.includes.slot-status-chooser', ['slot' => $slot, 'slotStati' => $slotStati])
                @else
                    {{$slot->status}}
                @endif
            </td>
            @if(isset($showDeleteAction) && $showDeleteAction && App\User::hasPermission('admin-calendar'))
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
<p>{{ $slots->links() }}</p>
