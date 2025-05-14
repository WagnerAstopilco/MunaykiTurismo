<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DestinoController;
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

Route::apiResource('/productos', ProductController::class);
Route::post('/productos/{id}/imagenes', [ProductController::class, 'uploadImagenes']);
Route::post('/productos/{id}/file', [ProductController::class, 'uploadFile']);



Route::apiResource('/promotions', PromotionController::class);
Route::apiResource('/ratings', RatingController::class);
Route::apiResource('/reservations', ReservationController::class);
Route::apiResource('/users', UserController::class);
Route::apiResource('/destinos', DestinoController::class);

Route::get('/banner', [BannerController::class, 'get']); // cliente y admin
Route::put('/banner', [BannerController::class, 'update']); // solo admin