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
        <form action="{{ route('user.completeregistration') }}" method="POST">
            @csrf

            <div>
                <label for="name">Nombre</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}">
                @error('name')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div >
                <label for="nequi_account">Cuenta Nequi</label>
                <input type="text" name="nequi_account" value="{{ old('nequi_account') }}">
                @error('nequi_account')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div >
                <label for="phone_number">Número de Teléfono</label>
                <input type="text" name="phone_number" value="{{ old('phone_number') }}">
                @error('phone_number')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label for="date_of_birth">Fecha de Nacimiento</label>
                <input type="date" name="date_of_birth" value="{{ old('date_of_birth') }}">
                @error('date_of_birth')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            
            <div >
                <label for="identification_number">Número de Identificación</label>
                <input type="text" name="identification_number" value="{{ old('identification_number') }}">
                @error('identification_number')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            
            <div>
                <input type="checkbox" name="agreement_terms" value="1" {{ old('agreement_terms') ? 'checked' : '' }}>
                <label  for="agreement_terms"><a href="{{ route('termsAndConditions') }}">los términos y condiciones</a> </label>
                @error('agreement_terms')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            
            <div >
                <input type="checkbox" name="accepted_privacy_policy" value="1" {{ old('accepted_privacy_policy') ? 'checked' : '' }}>
                <label for="accepted_privacy_policy"><a href="{{ route('privacyPolicy') }}">Acepto la política de privacidad</a></label>
                @error('accepted_privacy_policy')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit">Registrar</button>
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