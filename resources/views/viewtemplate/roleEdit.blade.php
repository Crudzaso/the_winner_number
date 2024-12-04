<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Rol</title>
</head>
<body>
    <h1>Editar Rol</h1>

    <form action="{{ route('roles.update', $role->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label for="name">Nombre del Rol:</label>
            <input type="text" name="name" id="name" value="{{ $role->name }}" required>
        </div>

        <div>
            <label for="permissions">Permisos:</label>
            <select name="permissions[]" id="permissions" multiple>
                @foreach($permissions as $permission)
                    <option value="{{ $permission->name }}" 
                            @if($role->permissions->contains($permission)) selected @endif>
                        {{ $permission->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <button type="submit">Actualizar Rol</button>
        </div>
    </form>

    <a href="{{ route('roles.index') }}">Volver a la lista de roles</a>
</body>
</html>
