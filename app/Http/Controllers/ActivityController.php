<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Http\Requests\StoreActivityRequest;
use App\Http\Requests\UpdateActivityRequest;
use App\Http\Resources\ActivityResource;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $activities = Activity::with('products')->get();
        return ActivityResource::collection($activities);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreActivityRequest $request)
    {
        $validatedData = $request->validated();

        $activity = Activity::create(Arr::except($validatedData, 'product_ids'));

        $activity->products()->attach($validatedData['product_ids']);

        return new ActivityResource($activity);
    }

    /**
     * Display the specified resource.
     */
    public function show(Activity $activity)
    {
        $activity->load('products');
        return new ActivityResource($activity);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateActivityRequest $request, Activity $activity)
    {

        $validatedData = $request->validated();

        $activity->update(Arr::except($validatedData, 'product_ids'));

        $activity->products()->syncWithoutDetaching($validatedData['product_ids']);

        return new ActivityResource($activity);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Activity $activity)
    {
        $activity->delete();
        return response()->json(['message' => 'Actividad eliminada correctamente'], 200);
    }
}
