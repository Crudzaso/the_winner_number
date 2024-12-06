<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>The Winner Number</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    {{-- swet alert 2 --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Styles -->
    <style>
        .product-container {
            padding: 2rem;
            max-width: 1200px;
            margin: 0 auto;
        }

        .product-details {
            display: flex;
            flex-direction: column;
            gap: 2rem;
        }

        .product-image {
            flex: 1;
            position: relative;
            aspect-ratio: 16 / 9;
            overflow: hidden;
        }

        .product-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 1rem;
        }

        .product-info {
            flex: 1;
        }

        .product-name {
            font-size: 2rem;
            font-weight: bold;
            color: #1a202c;
            /* Gray-900 */
        }

        .product-price {
            font-size: 1.5rem;
            color: #1a202c;
            /* Gray-900 */
        }

        .product-specs {
            margin-top: 1rem;
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .spec-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .spec-label {
            font-weight: 600;
        }

        .color-box {
            display: inline-block;
            width: 1.5rem;
            height: 1.5rem;
            border: 1px solid #4a5568;
            /* Gray-600 */
            border-radius: 50%;
        }

        .order-form {
            margin-top: 2rem;
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        label {
            font-weight: 500;
            color: #4a5568;
            /* Gray-700 */
        }

        input {
            padding: 0.5rem;
            border: 1px solid #cbd5e0;
            /* Gray-300 */
            border-radius: 0.375rem;
        }

        .btn-submit {
            padding: 0.75rem;
            background-color: #00d1d8;
            /* Indigo-600 */
            color: white;
            border: none;
            border-radius: 0.375rem;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn-submit:hover {
            background-color: #4338ca;
            /* Indigo-700 */
        }

        .btn-pay {
            display: flex;
            align-items: center;
            padding: 0.75rem;
            background-color: #38a169;
            /* Green-400 */
            color: white;
            border: none;
            border-radius: 0.375rem;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-top: 1rem;
        }

        .btn-pay:hover {
            background-color: #2f855a;
            /* Green-700 */
        }

        .icon-credit-card {
            margin-right: 0.5rem;
        }
    </style>
</head>
<body>

<div class="d-flex justify-content-center align-items-center min-vh-100">
    <div class="card">
        <h2 class="text-center mb-4">Formulario de Pago con MercadoPago</h2>

        <form action="{{ route('mercadopago.createPayment') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Nombre:</label>
                <input type="text" class="form-control" name="name" id="name" required>
            </div>

            <div class="mb-3">
                <label for="surname" class="form-label">Apellido:</label>
                <input type="text" class="form-control" name="surname" id="surname" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Correo electrónico:</label>
                <input type="email" class="form-control" name="email" id="email" required>
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-primary">Pagar</button>
            </div>
        </form>
    </div>
</div>

    <!-- Para estilos de Bootstrap desde el CDN -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

</body>
</html>
