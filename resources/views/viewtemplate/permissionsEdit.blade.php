<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Permission</title>
</head>
<body>
    <h1>Edit Permission</h1>
    
    <form action="{{ route('permissions.update', $permission->id) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="name">Permission Name</label>
        <input type="text" id="name" name="name" value="{{ $permission->name }}" required>
        <br><br>
        <button type="submit">Update</button>
    </form>

    <br>
    <a href="{{ route('permissions.index') }}">Back to Permissions List</a>
</body>
</html>
