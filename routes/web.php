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
use App\Http\Controllers\Admin\BankSoalController as BankSoalAdmin;
use App\Http\Controllers\Siswa\DashboardController as DashboardSiswa;
use App\Http\Controllers\Siswa\SoalController as SoalSiswa;
use App\Http\Controllers\Siswa\UjianController as UjianSiswa;
use App\Http\Controllers\Siswa\ResultUjianController as ResultUjianSiswa;

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

Route::middleware(['auth:jwt'])->group(function(){
    Route::get('/checkLogin', [Auth::class, 'checkLogin']);
});

Route::middleware(['auth:jwt', 'cekrole.admin'])->prefix('admin')->name('admin.')->group(function(){
    Route::get('/dashboard', [DashboardAdmin::class, 'index'])->name('get.dashboard');
    Route::get('/siswa', [DashboardAdmin::class, 'siswa'])->name('get.datatable.siswa');
    Route::post('/siswa/data', [SiswaAdmin::class, 'getAllSiswa'])->name('post.data.siswa');
    Route::get('/soal', [DashboardAdmin::class, 'soal'])->name('get.datatable.soal');
    Route::post('/soal/data', [SoalAdmin::class, 'getAllSoal'])->name('post.data.soal');
    Route::get('/pengguna', [DashboardAdmin::class, 'pengguna'])->name('get.datatable.pengguna');
    Route::post('/pengguna/data', [PenggunaAdmin::class, 'getAllPengguna'])->name('post.data.pengguna');
    Route::post('/pengguna/store', [PenggunaAdmin::class, 'store'])->name('post.store.pengguna');
    Route::get('/pengguna/get/{email}', [PenggunaAdmin::class, 'getPengguna'])->name('get.pengguna');
    Route::post('/pengguna/update', [PenggunaAdmin::class, 'update'])->name('post.update.pengguna');
    Route::get('/pengguna/delete/{email}', [PenggunaAdmin::class, 'delete'])->name('get.delete.pengguna');
    Route::get('/soal/bank/{id_soal}', [BankSoalAdmin::class, 'index'])->name('get.soal.banksoal');
    Route::post('/soal/soalin/bank', [BankSoalAdmin::class, 'getSoalInBankSoal'])->name('post.soal.in.banksoal');
    Route::post('/soal/bank/upload/gambar/pertanyaan', [BankSoalAdmin::class, 'uploadGambarPertanyaan'])->name('post.soal.bank.upload.gambar.pertanyaan');
    Route::post('/soal/bank/upload/gambar/pilihan', [BankSoalAdmin::class, 'uploadGambarPilihan'])->name('post.soal.bank.upload.gambar.pilihan');
    Route::post('/soal/bank/update', [BankSoalAdmin::class, 'update'])->name('post.soal.bank.update');
    Route::post('/soal/bank/store', [BankSoalAdmin::class, 'store'])->name('post.soal.bank.store');
    Route::get('/logout', [Auth::class, 'logout'])->name('get.logout');
});

Route::middleware(['auth:jwt', 'cekrole.siswa'])->prefix('siswa')->name('siswa.')->group(function(){
    Route::get('/dashboard', [DashboardSiswa::class, 'index'])->name('get.dashboard');
    Route::get('/soal', [DashboardSiswa::class, 'soal'])->name('get.soal');
    Route::post('/soal/data', [SoalSiswa::class, 'getDataSoal'])->name('post.data.soal');
    Route::get('/ujian', [UjianSiswa::class, 'index'])->name('get.ujian');
    Route::post('/ujian', [UjianSiswa::class, 'getSoal'])->name('post.getSoal.ujian');
    Route::post('/ujian/update', [UjianSiswa::class, 'update'])->name('post.update.ujian');
    Route::get('/ujian/result', [ResultUjianSiswa::class, 'index'])->name('get.index.result.ujian');
    Route::post('/ujian/result', [ResultUjianSiswa::class, 'getResultUjian'])->name('post.getResultUjian');
    Route::get('/logout', [Auth::class, 'logout'], 'logout')->name('get.logout');
});