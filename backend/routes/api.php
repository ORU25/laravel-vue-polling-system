<?php

namespace App\Http\Controllers;
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

Route::post('/login', [Api\LoginController::class, 'login']);
Route::post('/register', [Api\LoginController::class, 'register']);
Route::get('/logout', [Api\LoginController::class, 'logout']);

Route::get('/polls', [Api\PollController::class, 'index'])->middleware('auth:sanctum');
Route::post('/vote', [Api\PollController::class, 'vote'])->middleware('auth:sanctum');
Route::get('/poll/{id}', [Api\PollController::class, 'poll'])->middleware('auth:sanctum');
Route::post('/poll/create', [Api\PollController::class, 'pollCreate'])->middleware('auth:sanctum');
Route::post('/poll/{id}/createOption', [Api\PollController::class, 'optionCreate'])->middleware('auth:sanctum');
Route::post('/poll/{id}/edit', [Api\PollController::class, 'pollEdit'])->middleware('auth:sanctum');
Route::post('/poll/option/{id}/edit', [Api\PollController::class, 'optionEdit'])->middleware('auth:sanctum');
Route::delete('/poll/{id}', [Api\PollController::class, 'pollDelete'])->middleware('auth:sanctum');
Route::delete('/poll/option/{id}', [Api\PollController::class, 'optionDelete'])->middleware('auth:sanctum');