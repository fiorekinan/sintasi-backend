<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PatientController;
use App\Http\Controllers\Api\VisitController;

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/patients', [PatientController::class, 'index']);
    Route::post('/patients', [PatientController::class, 'store']);
    Route::get('/patients/{medicalRecordNumber}', [PatientController::class, 'show']);
    Route::post('/visits', [VisitController::class, 'store']);
});

Route::post('/visits', [VisitController::class, 'store']);


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');