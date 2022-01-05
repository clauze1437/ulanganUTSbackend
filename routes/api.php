<?php

use App\Http\Controllers\PatientsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route PatientController => method api resource
Route::apiResource('patients', PatientsController::class);

// Route untuk menampilkan data berdasarkan status positive, recovered dan dead
Route::get('/patients/status/positive', [PatientController::class, 'positive']);
Route::get('/patients/status/recovered', [PatientController::class, 'recovered']);
Route::get('/patients/status/dead', [PatientController::class, 'dead']);

// Route untuk mencari data berdasarkan name
Route::get('/patients/search/{name}', [PatientsController::class, 'search']);
