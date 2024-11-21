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
            <p id='message'>
                {{ Session::get('error') }}
            </p>
        </div>  
    @endif

    <a href="{{ route('user.index', 'activos') }}">Usuarios activos</a>
    <a href="{{ route('user.index', 'inactivos') }}">Usuarios inactivos</a>
    <a href="{{ route('user.create') }}">Crear un nuevo Usuarios</a>


    <div>
        @forelse($users as $user)
            <div>
                <h1>Nombre: {{ $user->name }}</h1>
                <p>Correo: {{ $user->email }}</p>
                <p>Total invertido: {{ $user->total_spent }}</p>
                <p>Rifas creadas: {{ $user->raffles_created_count }}</p>
                <p>Rol: {{ $user->getRoleNames()->implode(', ') }}</p>
                <a href="{{ route('user.show', $user->id) }}">ver detalles</a>
                <a href="{{ route('user.edit', $user->id) }}">editar</a>
                <form action="{{ route('user.destroy', $user->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    @if ($user->status == true)
                        <button type="submit">eliminar</button>   
                    @else
                        <button type="submit">Restablecer</button>
                    @endif
                </form>
            </div>
        @empty
            <h2>No hay datos que mostrar</h2>
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