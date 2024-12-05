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
<div class="product-container px-36">
    <div class="product-details">
        <div class="product-image">
            <img src="" alt="Rifa de ejemplo" />
        </div>
        <div class="product-info">
            <h1 class="product-name">Rifa de doña Pepa</h1>
            <div class="product-price" id="product-price">$10000</div>
            <hr />
            <div class="product-specs">
                <div class="spec-item">
                    <span class="spec-label">Lotería:</span>
                    <span class="spec-value">Súper Astro Millonario</span>
                </div>
                {{--<div class="spec-item">
                    <span class="spec-label">Color:</span>
                    <span class="spec-value color-box" style="background-color: #00d1d8;"></span>
                </div>--}}
                <div class="spec-item">
                    {{--<span class="spec-label">Categoría:</span>--}}
                    <span class="spec-value">Juegos de azar</span>
                </div>
            </div>
            <form action="#" method="POST" class="order-form"> {{--Ponerle a qué ruta mandarlo || Debería ser el de crear preferencia--}}
                @csrf
                <div class="form-group">
                    <label for="name">Nombres*</label>
                    <input type="text" id="name" name="name" required />
                </div>
                <div class="form-group">
                    <label for="surname">Apellidos</label>
                    <input type="text" id="surname" name="surname" />
                </div>
                <div class="form-group">
                    <label for="phone">Teléfono*</label>
                    <input type="tel" id="phone" name="phone" required />
                </div>
                <div class="form-group">
                    <label for="quantity">Cantidad*</label>
                    <input type="number" id="quantity" name="quantity" min="10" value="10" required />
                </div>
                <input type="hidden" id="product_id" value="1234567890" />
                <input type="hidden" id="product_price" value="50" />

                <button class="btn-submit" id="checkout-btn" type="button">
                    <span class="icon-credit-card text-center">💳</span>Pagar con Mercado Pago
                </button>
            </form>
        </div>
    </div>
</div>

<script src="https://sdk.mercadopago.com/js/v2"></script>
<script>
    const mp = new MercadoPago("{{ env('MERCADO_PAGO_PUBLIC_KEY') }}");

    document.getElementById('checkout-btn').addEventListener('click', function() {
        const cantidad = parseInt(document.getElementById('quantity').value, 10);   //El 10 es para que lo trate como un número en base 10
        const nombre = document.getElementById('name').value;
        const apellidos = document.getElementById('surname').value;
        /*const direccion = document.getElementById('address').value;*/
        /*const nombre = document.getElementById('phone').value;*/
        const telefono = document.getElementById('phone').value;

        if (!cantidad || !nombre || !telefono) {
            Swal.fire({
                title: '¡Error!',
                text: 'Por favor, completa todos los campos del formulario.',
                icon: 'error',
                confirmButtonText: 'Aceptar'
            });
            return;
        }

        const orderData = {
            product: [{
                id: document.getElementById('product_id').value,
                title: document.querySelector('.product-name').innerText,
                description: 'Descripción del producto', // Puedes ajustar esto si tienes más información
                currency_id: "COP",
                /*currency_id: "USD",*/ //Esperamos que esta opción surja prontamente
                quantity: cantidad,
                unit_price: parseFloat(document.getElementById('product_price').value),
            }],
            name: nombre,
            surname: apellidos, // Si tienes un campo de apellido, añádelo aquí
            email: '', // Agrega el correo electrónico si es necesario
            phone: telefono,
            /*address: direccion,*/
        };

        console.log('Datos del pedido:', orderData);

        fetch('/create-preference', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
            },
            body: JSON.stringify(orderData)
        })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Error en la respuesta del servidor');
                }
                return response.json();
            })
            .then(preference => {
                if (preference.error) {
                    throw new Error(preference.error);
                }
                mp.checkout({
                    preference: {
                        id: preference.id // Asegúrate de que esta línea sea correcta
                    },
                    autoOpen: true
                });
                console.log('Respuesta de la preferencia:', preference);
            })
            .catch(error => console.error('Error al crear la preferencia:', error));
    });
</script>
</html>
