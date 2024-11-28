<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <a href="{{ route('purchase.index') }}">volver</a>

    <h1>Detalles de la compra</h1>
    <div>
        <h1>{{ $purchase->raffle->name }}</h1>
        <h4>Creador: </h4><p>{{ $purchase->user->name }}</p>
        <h4>Precio: </h4><p>{{ $purchase->raffle->price }}</p>
        <h4>Fecha de inicio: </h4><p>{{ $purchase->raffle->start_date }}</p>
        <h4>Fecha de cierre: </h4><p>{{ $purchase->raffle->closing_date }}</p>
        <h4>Premio: </h4><p>{{ $purchase->raffle->award }}</p>
    </div>
</body>
</html>