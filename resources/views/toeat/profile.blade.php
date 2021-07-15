<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Profile</title>
</head>
<body>
    <div>
        <h1>&commat;{{ $user->name }}</h1>
    </div>

    <div>
        @foreach($toits as $toit)
            <p>
                <b>{{ $toit->created_at }}</b><br>
                {{ $toit->content }}
            </p>
        @endforeach
    </div>


</body>
</html>
