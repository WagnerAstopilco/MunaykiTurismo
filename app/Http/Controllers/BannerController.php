<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class BannerController extends Controller
{

    protected $jsonPath = 'data/Banner.json';

    public function get()
    {
        $path = public_path($this->jsonPath);

        if (!File::exists($path)) {
            return response()->json(['error' => 'Archivo no encontrado'], 404);
        }

        $json = File::get($path);
        $data = json_decode($json, true);

        return response()->json($data);
    }

    public function update(Request $request)
    {
        $data = $request->all();
        $path = public_path($this->jsonPath);

        File::put($path, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

        return response()->json(['message' => 'Configuración actualizada correctamente']);
    }
}
