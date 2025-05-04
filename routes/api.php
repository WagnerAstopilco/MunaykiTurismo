<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('/activities', ActivityController::class);
Route::apiResource('/categories', CategoryController::class);
Route::apiResource('/coupons', CouponController::class);
Route::apiResource('/images', ImageController::class);
Route::apiResource('/payments', PaymentController::class);
Route::apiResource('/products', ProductController::class);
Route::apiResource('/promotions', PromotionController::class);
Route::apiResource('/ratings', RatingController::class);
Route::apiResource('/reservations', ReservationController::class);
Route::apiResource('/users', UserController::class);
