<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DaftarSampahController;
use App\Models\DaftarSampah;

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

    Route::get('/daftar_sampah', [DaftarSampahController::class, 'index']);
    Route::delete('/daftar_sampah/{id}', [ApiPendidikanController::class, 'destroy']);
    Route::put('/daftar_sampah/{id}', [ApiPendidikanController::class, 'update']);
});
