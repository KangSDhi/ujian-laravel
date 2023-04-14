<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Landing\LandingController as Landing;
use App\Http\Controllers\Auth\AuthController as Auth;
use App\Http\Controllers\Error\ErrorController as Error;
use App\Http\Controllers\Admin\DashboardController as DashboardAdmin;
use App\Http\Controllers\Admin\GuruController as GuruAdmin;
use App\Http\Controllers\Admin\SiswaController as SiswaAdmin;
use App\Http\Controllers\Admin\SoalController as SoalAdmin;
use App\Http\Controllers\Admin\PenggunaController as PenggunaAdmin;

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

Route::middleware(['guest'])->group(function(){
    Route::get('/', [Landing::class, 'index'])->name('get.landing');
    Route::get('/about', [Landing::class, 'about'])->name('get.about');

    Route::get('/login', [Auth::class, 'index'])->name('get.login');
    Route::post('/login', [Auth::class, 'login'])->name('post.login');

    Route::get('/accessDenied', [Error::class, 'accessDenied'])->name('get.accessDenied');
});

Route::middleware(['auth:api', 'cekrole.admin'])->prefix('admin')->name('admin.')->group(function(){
    Route::get('/dashboard', [DashboardAdmin::class, 'index'])->name('get.dashboard');
    Route::get('/siswa', [DashboardAdmin::class, 'siswa'])->name('get.datatable.siswa');
    Route::post('/siswa/data', [SiswaAdmin::class, 'getAllSiswa'])->name('post.data.siswa');
    Route::get('/soal', [DashboardAdmin::class, 'soal'])->name('get.datatable.soal');
    Route::post('/soal/data', [SoalAdmin::class, 'getAllSoal'])->name('post.data.soal');
    Route::get('/pengguna', [DashboardAdmin::class, 'pengguna'])->name('get.datatable.pengguna');
    Route::post('/pengguna/data', [PenggunaAdmin::class, 'getAllPengguna'])->name('post.data.pengguna');
});