<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\SaranaController;
use App\Http\Controllers\PengaturanTemaFiturController;
use App\Http\Controllers\PrestasiController;
use App\Http\Controllers\KelolaUserController;
use App\Http\Controllers\PageController;

Route::get('/', [PageController::class, 'index'])->name('home');
Route::get('/profil', [PageController::class, 'profil'])->name('profil');
Route::get('/pendidikan', [PageController::class, 'pendidikan'])->name('pendidikan');

// Dashboard Menu
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');


Route::prefix('dashboard/pendaftaran')->name('dashboard.pendaftaran.')->group(function () {
    Route::get('/', [PendaftaranController::class, 'index'])->name('index');
    Route::patch('/{id}/status', [PendaftaranController::class, 'updateStatus'])->name('updateStatus');
});

Route::prefix('dashboard/berita')->name('dashboard.berita.')->group(function () {
    Route::get('/', [BeritaController::class, 'index'])->name('index');
    Route::post('/', [BeritaController::class, 'store'])->name('store');
    Route::put('/{id}', [BeritaController::class, 'update'])->name('update');
    Route::delete('/{id}', [BeritaController::class, 'destroy'])->name('destroy');
});

Route::prefix('dashboard/galeri')->name('dashboard.galeri.')->group(function () {
    Route::get('/', [GaleriController::class, 'index'])->name('index');
    Route::post('/', [GaleriController::class, 'store'])->name('store');
    Route::delete('/{id}', [GaleriController::class, 'destroy'])->name('destroy');
});

Route::prefix('dashboard')->name('dashboard.')->group(function () {
    Route::get('/sarana', [SaranaController::class, 'index'])->name('sarana.index');
    Route::post('/sarana', [SaranaController::class, 'store'])->name('sarana.store');
    Route::put('/sarana/{id}', [SaranaController::class, 'update'])->name('sarana.update');
    Route::delete('/sarana/{id}', [SaranaController::class, 'destroy'])->name('sarana.destroy');
});

Route::prefix('dashboard/pengaturan')->name('dashboard.pengaturan.')->group(function () {
    Route::get('/', [PengaturanTemaFiturController::class, 'index'])->name('index');
    Route::put('/', [PengaturanTemaFiturController::class, 'update'])->name('update'); // Rute Update
});

Route::prefix('dashboard/prestasi')->name('dashboard.prestasi.')->group(function () {
    Route::get('/', [PrestasiController::class, 'index'])->name('index');
    Route::post('/', [PrestasiController::class, 'store'])->name('store');
    Route::put('/{id}', [PrestasiController::class, 'update'])->name('update');
    Route::delete('/{id}', [PrestasiController::class, 'destroy'])->name('destroy');
});

Route::prefix('dashboard/kelola-user')->name('dashboard.kelolaUser.')->group(function () {
    Route::get('/', [KelolaUserController::class, 'index'])->name('index');
    Route::post('/', [KelolaUserController::class, 'store'])->name('store');
    Route::put('/{id}', [KelolaUserController::class, 'update'])->name('update');
    Route::delete('/{id}', [KelolaUserController::class, 'destroy'])->name('destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
