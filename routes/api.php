<?php

use App\Http\Controllers\ResumeController;
use Illuminate\Support\Facades\Route;

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

// Rota de teste
Route::get('/test', function () {
    return response()->json(['message' => 'API is working!']);
});

Route::apiResource('resumes', ResumeController::class);

Route::get('/candidates', [ResumeController::class, 'index']);
