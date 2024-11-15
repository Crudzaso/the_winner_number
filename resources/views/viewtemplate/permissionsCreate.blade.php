<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New Permission</title>
</head>
<body>
    <h1>Create New Permission</h1>
    
    <form action="{{ route('permissions.store') }}" method="POST">
        @csrf
        <label for="name">Permission Name</label>
        <input type="text" id="name" name="name" required>
        <br><br>
        <button type="submit">Create</button>
    </form>

    <br>
    <a href="{{ route('permissions.index') }}">Back to Permissions List</a>
</body>
</html>
