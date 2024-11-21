<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <a href="{{ route('raffle.index') }}">volver a home</a>
    <h2>{{ $raffle->name }}</h2>
    <p>{{ $raffle->priace }}</p>
    <p>{{ $raffle->start_date }}</p>
    <p>{{ $raffle->award }}</p>

    <form action="{{ route('purchase.store') }}" method="POST">
        @csrf
        <input type="hidden" name="raffle_id" value="{{ $raffle->id }}">
        <label for="numero">Selecciona un número:</label>

        <select name="number" id="numero">
            @for ($i = 0; $i <= 99; $i++) 
                @if (!in_array($i, $purchases)) 
                    <option value="{{ $i }}">{{ $i }}</option>
                @endif
            @endfor
        </select>

        @error('number')
            <p class='error'>escoge un numero de la lista</p>
        @enderror
        <button type="submit">comprar</button>
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