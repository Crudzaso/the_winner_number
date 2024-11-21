<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Permissions List</title>
</head>
<body>
    <h1>Permissions</h1>
    <a href="{{ route('permissions.create') }}">Create New Permission</a>

    @if(session('success'))
        <div>{{ session('success') }}</div>
    @endif

    @foreach($permissions as $permission)
        <p>{{ $permission->id }}</p>
        <p>{{ $permission->name }}</p>
        <a href="{{ route('permissions.edit', $permission->id) }}">Edit</a>
    @endforeach
</body>
</html>
