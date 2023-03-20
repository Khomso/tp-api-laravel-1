<?php

use App\Http\Controllers\API\ConsoleController;
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

Route::controller(ConsoleController::class)->group(function () {
    Route::get('consoles', 'index');
    Route::post('consoles', 'store'); //->middleware('auth:api');
    Route::get('consoles/{console}', 'show');
    Route::post('consoles/{console}', 'update');
    Route::delete('consoles/{console}', 'destroy');
});
