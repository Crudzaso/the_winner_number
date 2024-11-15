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
        <a href="{{ route('raffle.index') }}">home</a>
        @forelse($purchases as $purchase)
            <div>
                <p>{{ $purchase->raffle->name }}</p>
                <p>{{ $purchase->raffle->price }}</p>
                <p>{{ $purchase->raffle->closing_date }}</p>
                <p>{{ $purchase->raffle->award }}</p>
                <p>{{ $purchase->number }}</p>
                <a href="{{ route('purchase.show', $purchase->id ) }}">ver detalles</a>
            </div>
        @empty
            <h2>No hay datos que mostrar</h2>
        @endforelse
    </div>
</body>
</html>