<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $subject ?? 'Notificación' }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .email-container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .email-header {
            background-color: #4caf50;
            color: #ffffff;
            padding: 20px;
            text-align: center;
        }
        .email-header h1 {
            margin: 0;
            font-size: 24px;
        }
        .email-body {
            padding: 20px;
            color: #333333;
        }
        .email-body p {
            margin: 0 0 10px;
            line-height: 1.6;
        }
        .email-footer {
            background-color: #f4f4f4;
            padding: 10px;
            text-align: center;
            font-size: 12px;
            color: #777777;
        }
        .email-footer a {
            color: #4caf50;
            text-decoration: none;
        }
        .button {
            display: inline-block;
            background-color: #4caf50;
            color: #ffffff;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 16px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="email-header">
            <h1>{{ $subject ?? 'Notificación de nuestra aplicación' }}</h1>
        </div>

        <div class="email-body">
            <p>Hola {{ $userName ?? 'Usuario' }},</p>

            <p>{{ $messageContent ?? 'Este es un mensaje genérico. Puedes personalizarlo con el contenido que desees.' }}</p>

            <p>Gracias,</p>
            <p>El equipo de {{ config('app.name') }}</p>
        </div>

        <div class="email-footer">
            <p>Este mensaje ha sido enviodo automaticamente no responder</p>
        </div>
    </div>
</body>
</html>
