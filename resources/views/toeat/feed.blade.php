@extends('toeat.template')

@section('title', 'Feed')

@section('content')
    <div>
        <form method="post" action="/addtoit">
            @csrf
            <textarea name="toit" required maxlength="140"></textarea><br>
            <input type="submit">
        </form>
    </div>

    <div>
        <h2>Feed</h2>
        @foreach($toits as $toit)
            <div><b>{{$toit->user->name}}</b><br>
                {{$toit->content}}</div>
        @endforeach
    </div>
@endsection
