<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    public function get()
    {
        if (!Storage::exists('Banner.json')) {
            return response()->json(['error' => 'Archivo no encontrado'], 404);
        }

        $json = Storage::get('Banner.json');
        $data = json_decode($json, true);

        return response()->json($data);
    }

    public function update(Request $request)
    {
        $data = $request->all();

        Storage::put('Banner.json', json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

        return response()->json(['message' => 'Configuración actualizada correctamente']);
    }
}
