<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    @if (Session::get('success'))
        <div>
            <p id='message'>
                {{ Session::get('success') }}
            </p>
        </div>
    @endif

    @if (Session::get('error'))
        <div>
            <h4 id='message'>
                {{ Session::get('error') }}
            </h4>
        </div>  
    @endif


    <div>
        @can('raffles.store')
            <a href="{{ route('raffle.create') }}"><strong> crear rifa </strong></a>
        @endcan
        @forelse($raffles as $raffle)
            <div>
                <h1>{{ $raffle->name }}</h1>
                <h4>Organizador: </h4><p>{{ $raffle->user->name }}</p>
                <h4>Precio: </h4><p>{{ $raffle->price }}</p>
                <h4>Fecha de cierre: </h4><p>{{ $raffle->closing_date }}</p>
                <h4>Premio: </h4><p>{{ $raffle->award }}</p>

                @can('raffles.show')
                    <a href="{{ route('raffle.show', $raffle->id) }}">ver detalles</a><br>
                @endcan
                @if($raffle->user->id == auth()->user()->id)
                    @can('raffles.edit')
                        <a href="{{ route('raffle.edit', $raffle->id) }}">editar</a><br>
                    @endcan
                    @can('raffles.destroy')
                        <form action="{{ route('raffle.destroy', $raffle->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit">eliminar</button><br>
                        </form>
                    @endcan
                @endif
                @can('purchases.store')
                    <a href="{{ route('purchase.create', $raffle->id) }}">comprar</a><br>
                @endcan

            </div>
        @empty
            <h4>No hay datos que mostrar</h4>
        @endforelse
    </div>

    <script>
        setTimeout(() => {
            const message = document.getElementById('message');
            if (message) {
                message.style.display = 'none';
            }
        }, 3000);
    </script>
</body>
</html>