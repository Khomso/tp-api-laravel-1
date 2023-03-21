<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\JeuxController;
use App\Http\Controllers\API\JoueurController;
use App\Http\Controllers\API\ConsoleController;

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

Route::controller(JoueurController::class)->group(function () {
    Route::get('joueurs', 'index');
    Route::post('joueurs', 'store'); //->middleware('auth:api');
    Route::get('joueurs/{joueur}', 'show');
    Route::post('joueurs/{joueur}', 'update');
    Route::delete('joueurs/{joueur}', 'destroy');
});

Route::controller(JeuxController::class)->group(function () {
    Route::get('jeux', 'index');
    Route::post('jeux', 'store'); //->middleware('auth:api');
    Route::get('jeux/{jeux}', 'show');
    Route::post('jeux/{jeux}', 'update');
    Route::delete('jeux/{jeux}', 'destroy');
});