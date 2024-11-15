<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <a href="{{ url()->previous() }}">Volver</a>

    <h2>Usuario: {{ $user->name }}</h2>
    <p>Email: {{ $user->email }}</p>
    <p>Rol: {{ $user->getRoleNames()->implode(', ') }}</p>
    <p>Fecha de nacimiento: {{ $user->date_of_birth }}</p>
    <p>Identificacion: {{ $user->identification_number }}</p>
    <p>teléfono: {{ $user->phone_number }}</p>
    <p>Nequi: {{ $user->nequi_account }}</p>
    <p>Rifas creadas: {{ $user->raffles_created_count }}</p>
    <p>Monto gastado en la aplicacion: {{ $user->total_spent }}</p>
    <p>Fecha de registro: {{ $user->created_at }}</p>
    <p>Ultima modificación: {{ $user->updated_at }}</p>

    <h1>Rifas Creadas</h1>
    
    @forelse ($user->raffles as $raffle)
        <div>
            <h3>Rifa: {{ $raffle->name }}</h3>
            <p>Precio: {{ $raffle->price }}</p>
            <p>Fecha de inicio: {{ $raffle->start_date }}</p>
            <p>Fecha de cierre: {{ $raffle->closing_date }}</p>
            <p>Premio: {{ $raffle->award }}</p>
            <a href="{{ route('raffle.show', $raffle->id) }}">Ver detalles</a>
        </div>
    @empty
        <h2>El Usuario no tiene Rifas creadas</h2>
    @endforelse

    <h1>Rifas Compradas</h1>
    
    @forelse ($user->purchases as $purchase)
        <div>
            <h3>Rifa: {{ $purchase->raffle->name }}</h3>
            <p>Precio: {{ $purchase->raffle->price }}</p>
            <p>Numero: {{ $purchase->number }}</p>
            <p>Premio: {{ $purchase->raffle->award }}</p>
            <a href="{{ route('purchase.show', $purchase->id) }}">Ver detalles</a>
        </div>
    @empty
        <h2>El Usuario no tiene Rifas compradas</h2>
    @endforelse
</body>
</html>