@extends('backend.base')

@section('title')
    Meine Termine
@endsection
@section ('main')
    @if($reservedSlots)
        <h1>Meine Terminreservierungen</h1>
        @include('backend.includes.slot-table', ['slots' => $reservedSlots])
        <p>
        <input type="text" class="typeahead" data-provide="typeahead" name="patient_query" autocomplete="off">
        </p>
        <script>
            $(document).ready(function () {
                var bloodhoundSource = function() { return [1,2,3];/*{'value':25, 'label':'Hans Mueller (1234)'}*/ };
                //var cars = ['Audi', 'BMW', 'Bugatti', 'Ferrari', 'Ford', 'Lamborghini', 'Mercedes Benz', 'Porsche', 'Rolls-Royce', 'Volkswagen'];

                // Constructing the suggestion engine
                var patients = new Bloodhound({
                    datumTokenizer: Bloodhound.tokenizers.whitespace,
                    //datumTokenizer: function (datum) { return [datum.label]; },
                    queryTokenizer: Bloodhound.tokenizers.whitespace,
                    prefetch: "/patients.json",
                    remote: {
                        url: "/patients.json?query=%QUERY",
                        wildcard: "%QUERY"
                    }
                });
                /*new Bloodhound({
                datumTokenizer: function (datum) { return [datum.firstname, datum.lastname, datum.svnr]; },
                queryTokenizer: Bloodhound.tokenizers.whitespace,
                identify: function (datum) { return datum.id; },
            });*/
                console.log(bloodhoundSource);
                $('.typeahead').typeahead(null,
                    {
                        name: 'patients',
                        source: patients,
                        displayKey: 'label',
                    });
                console.log('done.');
            });
            //$('.typeahead').typeahead('open');
        </script>
    @else
        <p>Keine Terminreservierungen vorhanden.</p>
    @endif
    @if($availableSlots)
        <h1>Meine Verfügbarkeiten</h1>
        @include('backend.includes.slot-table', ['slots' => $availableSlots])
    @else
        <p>Keine Verfügbarkeiten vorhanden.</p>
    @endif

@endsection
