@extends('toeat.template')

@section('title', 'Profile')

@section('content')
    <div>
        <h1>&commat;{{ $user->name }}</h1>
    </div>
    <div>
        <button>Follow</button>
    </div>

    <div>
        @foreach($toits as $toit)
            <p>
                <b>{{ $toit->created_at }}</b><br>
                {{ $toit->content }}
            </p>
        @endforeach
    </div>
@endsection


