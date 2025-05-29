<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Http\Requests\StoreReservationRequest;
use App\Http\Requests\UpdateReservationRequest;
use App\Http\Resources\ReservationResource;
use App\Models\Companion;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reservations = Reservation::with(['user', 'product', 'payments', 'companions'])->get();
        return ReservationResource::collection($reservations);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreReservationRequest $request)
    {
        $validatedData = $request->validated();
        $companions = $validatedData['companions'] ?? [];
        unset($validatedData['companions']);

        $reservation = Reservation::create($validatedData);
        foreach ($companions as $companionData) {
        $reservation->companions()->create($companionData);}
        return new ReservationResource($reservation);
    }

    /**
     * Display the specified resource.
     */
    public function show(Reservation $reservation)
    {
        $reservation->load(['user', 'product', 'payments', 'companions']);
        return new ReservationResource($reservation);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateReservationRequest $request, Reservation $reservation)
    {
        $validatedData = $request->validated();

    
    $companions = $validatedData['companions'] ?? [];
    unset($validatedData['companions']);

    
    $reservation->update($validatedData);

    
    $existingCompanionIds = $reservation->companions()->pluck('id')->toArray();

    
    $receivedCompanionIds = collect($companions)->pluck('id')->filter()->toArray();

    
    $companionsToDelete = array_diff($existingCompanionIds, $receivedCompanionIds);
    Companion::destroy($companionsToDelete);

    // 4. Crear o actualizar companions recibidos
    foreach ($companions as $companionData) {
        if (isset($companionData['id']) && in_array($companionData['id'], $existingCompanionIds)) {
            // Actualizar companion existente
            $companion = Companion::find($companionData['id']);
            $companion->update($companionData);
        } else {
            // Crear nuevo companion
            $reservation->companions()->create($companionData);
        }
    }

    // Cargar companions para devolver la respuesta actualizada
    $reservation->load('companions');

    return new ReservationResource($reservation);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reservation $reservation)
    {
        $reservation->delete();
        return response()->json(['message' => 'Reserva eliminada correctamente'], 200);
    }
}
