<?php

use App\Http\Controllers\Api\Auth\LoginRegisterController;
use App\Http\Controllers\Api\Posts\PostController;
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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::controller(LoginRegisterController::class)->group(function() {
    Route::post('/register', 'register')->name('register');
    Route::post('/login', 'login')->name('login');
    Route::post('/logout', 'logout')->name('logout')->middleware('auth:sanctum');
});



Route::apiResource('posts', PostController::class)
    ->except('show')
    ->withTrashed()
    ->middleware('auth:sanctum');
