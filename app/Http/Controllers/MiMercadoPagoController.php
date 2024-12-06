<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\MercadoPagoService;

class MiMercadoPagoController extends Controller
{
    protected $mercadoPagoService;

    public function __construct(MercadoPagoService $mercadoPagoService)
    {
        $this->mercadoPagoService = $mercadoPagoService;
    }

        // Mostrar el formulario de pago
    public function showPaymentForm()
    {
        return view('mercadopago.payment');
        /*return view('mercadoPagoComponent');*/
    }

        //Crear la instancia de PaymentPreference
    public function createPayment(Request $request)
    {
        $items = [
            [
                "id" => "1234567890",
                "title" => "Rifa de doña Pepa",
                "description" => "Qué rifa tan chévere",
                "currency_id" => "COP",
                "quantity" => 10,
                "unit_price" => 2000.00
            ]
        ];

        $payer = [
            "name" => $request->input('name'),
            "surname" => $request->input('surname'),
            "email" => $request->input('email'),
        ];

        $preference = $this->mercadoPagoService->createPaymentPreference($items, $payer);

        if (isset($preference->init_point)) {
            return redirect($preference->init_point);
        } else {
            return redirect()->route('mercadopago.payment')->with('error', 'Error creando la preferencia de pago.');
        }
    }

        // En caso de éxito
    public function success()
    {
        return redirect()->route('mercadopago.success');
    }

        // En caso de fallo
    public function failure()
    {
        return redirect()->route('mercadopago.failed');
    }
}
