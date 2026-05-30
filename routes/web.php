<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KosController;

// Halaman Utama
Route::get('/', function () {
    return view('welcome');
});

// Route Dashboard Umum Bawaan Breeze
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

//Kelola Owner
Route::middleware('auth')->prefix('owner')->name('owner.')->group(function () {
    Route::get('/dashboard',          [KosController::class, 'index'])->name('dashboard');
    Route::get('/kos/create',         [KosController::class, 'create'])->name('kos.create');
    Route::post('/kos',               [KosController::class, 'store'])->name('kos.store');
    Route::get('/kos/{kos}/edit',     [KosController::class, 'edit'])->name('kos.edit');
    Route::put('/kos/{kos}',          [KosController::class, 'update'])->name('kos.update');
    Route::delete('/kos/{kos}',       [KosController::class, 'destroy'])->name('kos.destroy');
    Route::patch('/kos/{kos}/status', [KosController::class, 'toggleStatus'])->name('kos.status');
    Route::delete('/photo/{photo}',   [KosController::class, 'deletePhoto'])->name('photo.delete');
    Route::get('/kos/{kos}/reviews',  [KosController::class, 'reviews'])->name('kos.reviews');
});

// Kelola Profil user
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';