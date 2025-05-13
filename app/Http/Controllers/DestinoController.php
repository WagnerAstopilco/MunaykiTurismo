<?php

namespace App\Http\Controllers;

use App\Models\Destino;
use App\Http\Requests\StoreDestinoRequest;
use App\Http\Requests\UpdateDestinoRequest;
use App\Http\Resources\DestinoResource;
use Illuminate\Http\Request;

class DestinoController extends Controller
{
    public function index()
    {
        $destinos = Destino::with('image')->get();
        return DestinoResource::collection($destinos);
    }

    public function store(StoreDestinoRequest $request)
    {
        $destino = Destino::create($request->validated());
        return new DestinoResource($destino);
    }

    public function show(Destino $destino)
    {
        $destino->load('image');
        return new DestinoResource($destino);
    }

    public function update(UpdateDestinoRequest $request, Destino $destino)
    {
        $destino->update($request->validated());
        return new DestinoResource($destino);
    }

    
    public function destroy(Destino $destino)
    {
        $destino->delete();
        return response()->json(['message' => 'Destio eliminada correctamente'], 200);
    }
}
