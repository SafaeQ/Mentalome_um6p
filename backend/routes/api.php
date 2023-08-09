<?php

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

Route::get('/geneids', [App\Http\Controllers\DataController::class,'getGeneids']);
Route::get('/expriment', [App\Http\Controllers\DataController::class,'getExpriment']);
Route::get('/sra', [App\Http\Controllers\DataController::class,'getSra']);
Route::get('/disease', [App\Http\Controllers\DataController::class,'getDisease']);
Route::post('/get-chart-data', [App\Http\Controllers\DataController::class,'getChartData']);
