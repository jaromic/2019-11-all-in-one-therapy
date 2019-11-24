@extends('base')

@section('title')
    Meine Dokumentation


@endsection
@section ('main')
    @if(!empty($documentations))
        <table class="table" style="width:85%">
            <tr>
                <th>Datum</th>
                <th>Patient</th>
                <th>Text</th>
            </tr>
            @forelse($documentations as $documentation)
                <tr>
                    <td>
                        {{ $documentation->created_at->toDateString() }}
                    </td>
                    <td>
                        {{ $documentation->patient->firstname }} {{ $documentation->patient->lastname }}, {{ $documentation->patient->svnr }}
                    </td>
                    <td>
                        {{ $documentation->text }}
                    </td>
                </tr>
            @endforeach
        </table>
    @else
        <p>Keine Dokumentation vorhanden.</p>
    @endif
    <p>
    {{ $documentations->links() }}</p>
@endsection
