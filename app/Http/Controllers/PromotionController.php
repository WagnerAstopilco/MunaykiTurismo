<?php

namespace App\Http\Controllers;

use App\Models\Promotion;
use App\Http\Requests\StorePromotionRequest;
use App\Http\Requests\UpdatePromotionRequest;
use App\Http\Resources\PromotionResource;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;

class PromotionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $promotions=Promotion::with('products')->get();
        return PromotionResource::collection($promotions);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePromotionRequest $request)
    {
        $validatedData = $request->validated();

        $promotion = Promotion::create(Arr::except($validatedData, 'product_ids'));

        $promotion->products()->attach($validatedData['product_ids']);

        return new PromotionResource($promotion);
    }

    /**
     * Display the specified resource.
     */
    public function show(Promotion $promotion)
    {
        $promotion->load('products');
        return new PromotionResource($promotion);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePromotionRequest $request, Promotion $promotion)
    {
        $validatedData = $request->validated();

        $promotion->update(Arr::except($validatedData, 'product_ids'));

        $promotion->products()->syncWithoutDetaching($validatedData['product_ids']);

        return new PromotionResource($promotion);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Promotion $promotion)
    {
        $promotion->delete();
        return response()->json(['message' => 'Promoción eliminada correctamente'], 200);
    }
}
