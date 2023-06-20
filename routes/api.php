<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\Auth\AuthController as Auth;
use App\Http\Controllers\API\Test\TestController as Test;

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

// Route::middleware(['throttle:100,1'])->group(function(){
Route::post('/login', [Auth::class, 'login']);
Route::get('/check_auth', [Auth::class, 'checkAuth']);

Route::get('/testdata', [Test::class, 'getDataSiswaTest']);
// });