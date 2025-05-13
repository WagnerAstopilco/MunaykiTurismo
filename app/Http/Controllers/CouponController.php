<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Http\Requests\StoreCouponRequest;
use App\Http\Requests\UpdateCouponRequest;
use App\Http\Resources\CouponResource;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $coupons=Coupon::with('payments')->get();
        return CouponResource::collection($coupons);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCouponRequest $request)
    {

        $coupon = Coupon::create($request->validated());
        return new CouponResource($coupon);
    }

    /**
     * Display the specified resource.
     */
    public function show(Coupon $coupon)
    {
        $coupon->load('payments');
        return new CouponResource($coupon);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCouponRequest $request, Coupon $coupon)
    {
        Log::info('Datos crudos recibidos en update:', $request->all());
        $coupon->update($request->validated());
        return new CouponResource($coupon);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Coupon $coupon)
    {
        $coupon->delete();
        return response()->json(['message' => 'Cupón eliminado correctamente'], 200);
    }
}
