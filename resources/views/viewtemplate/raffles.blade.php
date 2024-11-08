<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div>
        <a href="{{ route('raffle.create') }}">crear rifa</a>
        @foreach($raffles as $raffle)
            <div>
                <h1>{{ $raffle->name }}</h1>
                <p>{{ $raffle->price }}</p>
                <p>{{ $raffle->start_date }}</p>
                <p>{{ $raffle->closing_date }}</p>
                <p>{{ $raffle->award }}</p>
                <a href="{{ route('raffle.show', $raffle->id) }}">ver detalles</a>
                <a href="{{ route('raffle.edit', $raffle->id) }}">editar</a>
                <form action="{{ route('raffle.destroy', $raffle->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <button type="submit">eliminar</button>
                </form>
            </div>
        @endforeach
    </div>
</body>
</html>