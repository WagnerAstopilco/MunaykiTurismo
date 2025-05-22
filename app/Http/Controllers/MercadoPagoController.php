<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use MercadoPago\MercadoPagoConfig;
use MercadoPago\Client\Preference\PreferenceClient;
use MercadoPago\Resources\PreferenceRequest;
use Illuminate\Support\Facades\Log;

class MercadoPagoController extends Controller
{


    public function createPreference(Request $request)
    {
        $token = config('services.mercadopago.access_token');

        Log::info('🔐 MercadoPago Access Token usado:', ['token' => $token]);
        try {
            \MercadoPago\MercadoPagoConfig::setAccessToken(config('services.mercadopago.access_token'));

            $client = new \MercadoPago\Client\Preference\PreferenceClient();

            $preference = $client->create([
                "items" => [[
                    "title" => $request->title ?? 'Tour Genérico',
                    "quantity" => 1,
                    "unit_price" => (float) $request->price ?? 1.0,
                    "currency_id" => "PEN"
                ]],
                "back_urls" => [
                    "success" => "https://tusitio.com/pago-exitoso",
                    "failure" => "https://tusitio.com/pago-fallido",
                    "pending" => "https://tusitio.com/pago-pendiente"
                ],
                "auto_return" => "approved"
            ]);

            return response()->json([
                "id" => $preference->id
            ]);
        } catch (\MercadoPago\Exceptions\MPApiException $e) {
            Log::error('MercadoPago API error', [
                'status' => $e->getApiResponse()->getStatusCode(),
                'body' => $e->getApiResponse()->getContent()
            ]);

            return response()->json([
                'message' => 'Error al generar preferencia',
                'error' => $e->getApiResponse()->getContent()
            ], 500);
        }
    }
}
