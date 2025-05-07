<?php
namespace App\Http\Controllers;

use App\Models\Destino;
use Illuminate\Http\Request;

class DestinoController extends Controller
{
    public function index()
    {
        return Destino::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $destino = Destino::create($request->only('name', 'description'));

        return response()->json($destino, 201);
    }

    public function show(Destino $destino)
    {
        return $destino;
    }

    public function update(Request $request, Destino $destino)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $destino->update($request->only('name', 'description'));

        return response()->json($destino);
    }

    public function destroy(Destino $destino)
    {
        $destino->delete();

        return response()->json(null, 204);
    }
}
