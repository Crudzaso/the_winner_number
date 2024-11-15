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
        <a href="{{ route('user.index', 'users') }}">atras</a>
        <h2>Editar Usuario</h2>
        <form action="{{ route('user.update', ['user' => $user->id]) }}" method="POST">
            @csrf
            @method('PUT')

            <div>
                <label for="name">Nombre</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}">
                @error('name')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div >
                <label for="nequi_account">Cuenta Nequi</label>
                <input type="text" name="nequi_account" value="{{ old('nequi_account', $user->nequi_account) }}">
                @error('nequi_account')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div >
                <label for="phone_number">Número de Teléfono</label>
                <input type="text" name="phone_number" value="{{ old('phone_number', $user->phone_number) }}">
                @error('phone_number')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label for="date_of_birth">Fecha de Nacimiento</label>
                <input type="date" name="date_of_birth" value="{{ old('date_of_birth', $user->date_of_birth->toDateString()) }}">
                @error('date_of_birth')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            
            <div >
                <label for="identification_number">Número de Identificación</label>
                <input type="text" name="identification_number" value="{{ old('identification_number', $user->identification_number) }}">
                @error('identification_number')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label for="roles">Rol:</label>
                <select name="role" id="roles">
                    @foreach ($roles as $role)
                        <option value="{{ $role->name }}" 
                            @if ($user->hasRole($role->name)) selected @endif>
                            {{ $role->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            
            <button type="submit">Actualizar</button>
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