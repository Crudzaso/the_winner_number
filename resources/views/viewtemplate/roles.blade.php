<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Roles</title>
</head>
<body>
    <h1>Lista de Roles</h1>

    <a href="{{ route('roles.create') }}">Crear Nuevo Rol</a>

    <table>
        <thead>
            <tr>
                <th>Nombre del Rol</th>
                <th>Permisos</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($roles as $role)
                <tr>
                    <td>{{ $role->name }}</td>
                    <td>
                        @foreach($role->permissions as $permission)
                            {{ $permission->name }}
                            @if (!$loop->last), @endif
                            <form action="{{ route('permissions.destroy', $role->id, $permission->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Are you sure you want to delete this permission?')">Delete</button>
                            </form>
                        @endforeach
                    </td>
                    <td>
                        <a href="{{ route('roles.edit', $role->id) }}">Editar</a>
                        <form action="{{ route('roles.destroy', $role->id ) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
