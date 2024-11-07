<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <a href="{{ route('raffle.index') }}">volver a casa</a>
    <div>
        <h1>{{ $raffle->id }}</h1>
        <p>{{ $raffle->name }}</p>
        <p>{{ $raffle->price }}</p>
        <p>{{ $raffle->start_date }}</p>
        <p>{{ $raffle->closing_date }}</p>
        <p>{{ $raffle->award }}</p>
    </div>
</body>
</html>