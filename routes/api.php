<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
// CONTROLLERS
use App\Http\Controllers\BookingController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


// BOOKING
Route::get('booking', [BookingController::class, 'show']);
Route::get('booking/{id}', [BookingController::class, 'find']);
Route::post('booking/store', [BookingController::class, 'store']);
Route::put('booking/update/{id}', [BookingController::class, 'update']);
Route::delete('booking/delete/{id}', [BookingController::class, 'delete']);

