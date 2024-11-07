<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    @php
        // Asignar el método y la ruta de acuerdo con si estamos editando o creando
        if (isset($raffle)) {
            $method = 'PUT';
            $route = route('raffle.update', $raffle->id);
        } else {
            $method = 'POST'; 
            $route = route('raffle.store');
        }
    @endphp
    <a href="{{ route('raffle.index') }}">volver a home</a>
    <form action="{{ $route }}" method="POST">
        @csrf
        @if($method == 'PUT')
            @method('PUT')
        @endif
        <label for="name">nombre</label>
        <input type="text" name="name" value="{{ isset($raffle) ? $raffle->name : null }}">
        <label for="price">precio</label>
        <input type="text" name="price" value="{{ isset($raffle) ? $raffle->price : null}}">
        <label for="start_date">Fecha de inicio</label>
        <input type="date" name="start_date" value="{{ isset($raffle) ? \Carbon\Carbon::parse($raffle->start_date)->format('Y-m-d') : '' }}">
        <label for="closing_date">fecha de fin</label>
        <input type="date" name="closing_date" value="{{ isset($raffle) ? \Carbon\Carbon::parse($raffle->closing_date)->format('Y-m-d') : '' }}">
        <label for="award">premio</label>
        <input type="text" name="award" value="{{ isset($raffle) ? $raffle->award : null}}">
        <button type="submit">{{ isset($raffle) ? 'Actualizar' : 'Crear' }}</button>
    </form>
</body>
</html>