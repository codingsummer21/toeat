@extends('toeat.template')

@section('title', 'Profile')

@section('content')
    <div>
        <h1>&commat;{{ $user->name }}</h1>
    </div>
    <div>
        Followers:<br>
        @foreach($followers as $follower)
            {{ $follower->name }}<br>
        @endforeach
    </div>
    <div>
        Following:<br>
        @foreach($following as $following)
            {{ $following->name }}<br>
        @endforeach
    </div>
    <div>
        @if(!$is_current_user)
            @if($unfollow)
                <a href="/unfollow/{{$user->id}}"><button>Unfollow</button></a>
            @else
                <a href="/follow/{{$user->id}}"><button>Follow</button></a>
            @endif
        @endif
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


