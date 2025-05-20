<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use MercadoPago\MercadoPagoConfig;
use MercadoPago\Client\Preference\PreferenceClient;
use MercadoPago\Exceptions\MPApiException;

class MercadoPagoController extends Controller
{
    public function crearPreferencia(Request $request)
    {
        try {
            MercadoPagoConfig::setAccessToken(config('services.mercadopago.access_token'));
            // Configura el token

            // Instancia el cliente de preferencias
            $client = new PreferenceClient();

            // Define los ítems como array
            $items = [
                [
                    "title" => $request->title,
                    "quantity" => (int) $request->quantity,
                    "unit_price" => (float) $request->price
                ]
            ];

            // Crea la preferencia
            $preference = $client->create([
                "items" => $items,
                "back_urls" => [
                    "success" => "https://d7af-190-43-17-16.ngrok-free.app/success",
                    // "failure" => "https://d7af-190-43-17-16.ngrok-free.app/failure",
                    "failure" => "https://localhost:8080/",
                    "pending" => "https://d7af-190-43-17-16.ngrok-free.app/pending"
                ],
                "auto_return" => "approved"
            ]);

            // Devuelve el link para pagar
            return response()->json(['init_point' => $preference->init_point]);
        } catch (MPApiException $e) {
            // Mostrar mensaje detallado
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
                'response' => $e->getResponseBody(),  // aquí está la respuesta detallada de la API
            ], 400);
        }
    }
}
