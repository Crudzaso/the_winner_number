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
        <h2>Registro de Usuario</h2>
        <form action="{{ route('user.store') }}" method="POST">
            @csrf

            <div>
                <label for="name">Nombre</label>
                <input type="text" name="name" value="{{ old('name') }}">
                @error('name')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label for="name">Email</label>
                <input type="text" name="email" value="{{ old('email') }}">
                @error('name')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label for="password">Contraseña</label>
                <input type="password" name="password" placeholder="Contraseña">
                <label for="password">Confirmar Contraseña</label>
                <input type="password" name="password_confirmation" placeholder="Confirmar Contraseña">
                @error('name')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label for="roles">Rol:</label>
                <select name="role" id="roles">
                    @foreach ($roles as $role)
                        <option>
                            {{ $role->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit">Crear</button>

        </form>
    </div>
    <script>
        setTimeout(() => {
            const messages = document.getElementsByClassName('error');
            for (let i = 0; i < messages.length; i++) {
                messages[i].style.display = 'none';
            }
        }, 3000);
    </script>
</body>
</html>