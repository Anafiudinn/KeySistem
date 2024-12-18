<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HotelController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



Route::post('/check-in', [HotelController::class, 'checkIn']);
Route::post('/authenticate-card', [HotelController::class, 'authenticateCard']);
Route::post('/control-power', [HotelController::class, 'controlPower']);
Route::post('/deactivate-power', [HotelController::class, 'deactivatePower']);
Route::get('/access-history', [HotelController::class, 'accessHistory']);
Route::post('/block-card', [HotelController::class, 'blockCard']);


