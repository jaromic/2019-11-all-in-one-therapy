@extends('backend.base')

@section('title')
    Meine Dokumentation


@endsection
@section ('main')
    @if(!empty($dokumentationen))
        <table style="width:85%">
            <tr>
                <th>Datum</th>
                <th>Patient</th>
                <th>Text</th>
            </tr>
            @forelse($dokumentationen as $dokumentation)
                <tr>
                    <td>
                        {{ $dokumentation->created_at->toDateString() }}
                    </td>
                    <td>
                        {{ $dokumentation->patient->firstname }} {{ $dokumentation->patient->lastname }}, {{ $dokumentation->patient->svnr }}
                    </td>
                    <td>
                        {{ $dokumentation->text }}
                    </td>
                </tr>
            @endforeach
        </table>
    @else
        <p>Keine Dokumentation vorhanden.</p>
    @endif
    <p>
    {{ $dokumentationen->links() }}</p>
@endsection
