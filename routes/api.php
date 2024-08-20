<?php

use App\Http\Controllers\API\CityController;
use App\Http\Controllers\API\JalurController;
use App\Http\Controllers\API\KecamatanController;
use App\Http\Controllers\API\ProvinsiController;
use App\Http\Controllers\API\VillageController;
use App\Models\Jalur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::prefix('provinsi')->group(function () {
    Route::post('/auto-generate', [ProvinsiController::class, 'autoGenerateProvinsi']);
});

Route::prefix('auto-generate')->group(function () {
    Route::post('/provinsi', [ProvinsiController::class, 'autoGenerateProvinsi']);
    Route::post('/city', [CityController::class, 'autoGenerateCity']);
    Route::post('/kecamatan', [KecamatanController::class, 'autoGenerateKecamatan']);
    Route::post('/village', [VillageController::class, 'autoGenerateVillage']);
});

Route::prefix('jalur')->group(function () {
    Route::get('/', [JalurController::class, 'fetchJalur']);
    Route::get('/{jalur}', [JalurController::class, 'fetchById']);
    Route::post('/', [JalurController::class, 'createJalur']);
    Route::post('/{jalur}', [JalurController::class, 'updateJalur']);
    Route::delete('/{jalur}', [JalurController::class, 'deleteJalur']);
});