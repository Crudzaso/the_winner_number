<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Todas mis Ventas</h1>

    @foreach($raffles as $raffle)
        <div>
            <p>{{ $raffle->name }}</p>
            <p>{{ $raffle->user->name }}</p>

            @foreach ($raffle->purchases as $purchase)
                <p>{{ $purchase->user->name }}</p>
                <p>{{ $raffle->price }}</p>
                <p>{{ $purchase->number }}</p>
                <a href="{{ route('purchase.show', $purchase->id ) }}">ver detalles</a>
            @endforeach
            
        </div>
    @endforeach
</body>
</html>