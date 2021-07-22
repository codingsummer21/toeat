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
@endsection
