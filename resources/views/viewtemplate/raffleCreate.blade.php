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
        @error('name')
            <p class="error">{{ $message }}</p>
        @enderror
        <label for="price">precio</label>
        <input type="text" name="price" value="{{ isset($raffle) ? $raffle->price : null}}">
        @error('price')
            <p class="error">{{ $message }}</p>
        @enderror
        <label for="closing_date">fecha de fin</label>
        <input type="date" name="closing_date" value="{{ isset($raffle) ? \Carbon\Carbon::parse($raffle->closing_date)->format('Y-m-d') : '' }}">
        @error('closing_date')
            <p class="error">{{ $message }}</p>
        @enderror
        <label for="award">premio</label>
        <input type="text" name="award" value="{{ isset($raffle) ? $raffle->award : null}}">
        @error('award')
            <p class="error">{{ $message }}</p>
        @enderror
        <button type="submit">{{ isset($raffle) ? 'Actualizar' : 'Crear' }}</button>
    </form>

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