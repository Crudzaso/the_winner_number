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
        <h1>{{ $raffle->name }}</h1>
        <h4>Creador: </h4><p>{{ $raffle->user->name }}</p>
        <h4>Precio: </h4><p>{{ $raffle->price }}</p>
        <h4>Fecha de inicio: </h4><p>{{ $raffle->start_date }}</p>
        <h4>Fecha de cierre: </h4><p>{{ $raffle->closing_date }}</p>
        <h4>Premio: </h4><p>{{ $raffle->award }}</p>
    </div>
</body>
</html>