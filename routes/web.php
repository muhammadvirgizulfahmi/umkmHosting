<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\KabkotaController;
use App\Http\Controllers\ProvinsiController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PembinaController;
use App\Http\Controllers\UmkmController;

// middleware('administrator')->

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::prefix('/dashboard')->group(function () {
        Route::get('/', [AdminController::class, 'index']);

        // Kabupaten Kota
        Route::middleware('admin')->prefix('/kabkota')->group(function () {
            Route::get('/', [KabkotaController::class, 'index']);
            Route::get('/create', [KabkotaController::class, 'create']);
            Route::get('/show/{id}', [KabkotaController::class, 'show']);
            Route::post('/store', [KabkotaController::class, 'store']);
            Route::get('/edit/{id}', [KabkotaController::class, 'edit']);
            Route::put('/update/{id}', [KabkotaController::class, 'update']);
            Route::delete('/destroy/{id}', [KabkotaController::class, 'destroy']);
        });
        
        // Provinsi
        Route::middleware('admin')->prefix('/provinsi')->group(function () {
            Route::get('/', [ProvinsiController::class, 'index']);
            Route::get('/create', [ProvinsiController::class, 'create']);
            Route::get('/show/{id}', [ProvinsiController::class, 'show']);
            Route::post('/store', [ProvinsiController::class, 'store']);
            Route::get('/edit/{id}', [ProvinsiController::class, 'edit']);
            Route::put('/update/{id}', [ProvinsiController::class, 'update']);
            Route::delete('/destroy/{id}', [ProvinsiController::class, 'destroy']);
        });

        // Kategori
        Route::middleware('admin')->prefix('/kategori')->group(function () {
            Route::get('/', [KategoriController::class, 'index']);
            Route::get('/create', [KategoriController::class, 'create']);
            Route::get('/show/{id}', [KategoriController::class, 'show']);
            Route::post('/store', [KategoriController::class, 'store']);
            Route::get('/edit/{id}', [KategoriController::class, 'edit']);
            Route::put('/update/{id}', [KategoriController::class, 'update']);
            Route::delete('/destroy/{id}', [KategoriController::class, 'destroy']);
        });

        // Pembina
        Route::middleware('admin')->prefix('/pembina')->group(function () {
            Route::get('/', [PembinaController::class, 'index']);
            Route::get('/create', [PembinaController::class, 'create']);
            Route::get('/show/{id}', [PembinaController::class, 'show']);
            Route::post('/store', [PembinaController::class, 'store']);
            Route::get('/edit/{id}', [PembinaController::class, 'edit']);
            Route::put('/update/{id}', [PembinaController::class, 'update']);
            Route::delete('/destroy/{id}', [PembinaController::class, 'destroy']);
        });

        // Umkm
        Route::prefix('/umkm')->group(function () {
            Route::get('/', [UmkmController::class, 'index']);
            Route::get('/create', [UmkmController::class, 'create']);
            Route::get('/show/{id}', [UmkmController::class, 'show']);
            Route::post('/store', [UmkmController::class, 'store']);
            Route::middleware('admin')->get('/edit/{id}', [UmkmController::class, 'edit']);
            Route::middleware('admin')->put('/update/{id}', [UmkmController::class, 'update']);
            Route::middleware('admin')->delete('/destroy/{id}', [UmkmController::class, 'destroy']);
        });
    });
});



