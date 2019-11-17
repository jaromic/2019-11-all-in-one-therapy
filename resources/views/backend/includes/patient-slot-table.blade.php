<table style="width:85%">
    <tr>
        <th>Slot</th>
        <th>Behandler</th>
        <th>Status</th>
        <th>Aktion</th>
    </tr>

    @foreach($slots as $slot)
        <tr>
            <td>
                {{ $slot->start->format('D d.m. H:i') }} &ndash; {{ $slot->end->format('H:i') }}
            </td>
            <td>
                {{$slot->user->name ?? 'Kein Behandler' }}
            </td>
            <td>
                {{$slot->status}}
            </td>
                <td>
                    <form method="post" action=" {{ "/slot/{$slot->id}/cancel" }}">
                        @csrf
                        <button type="submit">Stornieren</button>
                    </form>
                </td>
        </tr>
    @endforeach
</table>
