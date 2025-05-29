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
                    "success" => "https:// https://e76b-2800-4b0-9202-cbbe-2d6f-216c-84c3-4f5f.ngrok-free.app/pago-exitoso",
                    "failure" => "https:// https://e76b-2800-4b0-9202-cbbe-2d6f-216c-84c3-4f5f.ngrok-free.app/pago-fallido",
                    "pending" => "https:// https://e76b-2800-4b0-9202-cbbe-2d6f-216c-84c3-4f5f.ngrok-free.app/pago-pendiente"
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
