<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Landing\LandingController as Landing;
use App\Http\Controllers\Auth\AuthController as Auth;
use App\Http\Controllers\Error\ErrorController as Error;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [Landing::class, 'index'])->name('get.landing');
Route::get('/about', [Landing::class, 'about'])->name('get.about');

Route::get('/login', [Auth::class, 'index'])->name('get.login');
Route::post('/login', [Auth::class, 'login'])->name('post.login');

Route::get('/accessDenied', [Error::class, 'accessDenied'])->name('get.accessDenied');

// Route::group(['prefix' => 'admin', 'middleware' => 'api'], function(){
//     Route::get('me', function(){
//         return response()->json(auth()->user());
//     });
// });

Route::middleware(['auth:api', 'cekrole.admin'])->group(function(){
    Route::get('me/we', function(){
        return response()->json(auth()->user());
    });
});