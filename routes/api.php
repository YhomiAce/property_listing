<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BrokerController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\TaskController;
use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Public route
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::get("/brokers", [BrokerController::class, "index"]);
Route::get("/brokers/{broker}", [BrokerController::class, "show"]);
Route::get("/property", [PropertyController::class, "index"]);
Route::get("/property/{property}", [PropertyController::class, "show"]);

// Protected Route
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::resource('/tasks', TaskController::class);
    Route::apiResource('/brokers', BrokerController::class)->only(["store", "update", "destroy"]);
    Route::apiResource('property', PropertyController::class)->only(["store", "update", "destroy"]);
});


