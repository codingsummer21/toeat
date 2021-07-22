@extends('toeat.template')

@section('title', 'Reported Toits')

@section('content')

    <h1>Reported Toits</h1>

    @foreach($reported_toits as $toit)
        <div>
            {{ $toit->id }} {{ $toit->content }}
            @foreach($toit->reportedBy as $report)
                <br> - {{ $report->pivot->violation }}
            @endforeach
            <br>
            <a href="/moderate/accept/report/{{ $toit->id }}"><button>Accept</button></a>
            <a href="/moderate/reject/report/{{ $toit->id }}"><button>Reject</button></a>
            <hr>
        </div>
    @endforeach

@endsection
