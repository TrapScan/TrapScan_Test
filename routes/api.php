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


Route::get('/qr/print/{qr_code}',[\App\Http\Controllers\ProjectsController::class, 'generateQr'])->name('api.print_code');

Route::get('get_qr',[\App\Http\Controllers\ProjectsController::class, 'qr']);
Route::get('get_qr_free',[\App\Http\Controllers\ProjectsController::class, 'qr_free']);
Route::get('get_traps',[\App\Http\Controllers\ProjectsController::class, 'traps']);
