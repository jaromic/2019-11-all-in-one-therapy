<select name="status">
    @foreach($slotStati as $status)
        @if($slot->status == $status)
            <option selected="selected" value="{{ $status }}">{{ ucfirst($status) }}</option>
        @else
            <option value="{{ $status }}">{{ ucfirst($status) }}</option>
        @endif
    @endforeach
</select>


