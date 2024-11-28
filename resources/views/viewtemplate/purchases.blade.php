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
        <h2>monto invertido en rifas: {{ $user->total_spent}}</h2>
        <h1>Compras</h1>
        @forelse($purchases as $purchase)
            <div>
                <h1>{{ $purchase->raffle->name }}</h1>
                <h4>Precio: </h4><p>{{ $purchase->raffle->price }}</p>
                <h4>Fecha de cierre: </h4><p>{{ $purchase->raffle->closing_date }}</p>
                <h4>Premio: </h4><p>{{ $purchase->raffle->award }}</p>
                <h4>Numero comprado: </h4><p>{{ $purchase->number }}</p>
                <a href="{{ route('purchase.show', $purchase->id ) }}">ver detalles</a>
            </div>
        @empty
            <h2>No hay datos que mostrar</h2>
        @endforelse
    </div>
</body>
</html>