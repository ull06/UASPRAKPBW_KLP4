<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KosController;

Route::get('/', function () {
    return view('welcome');
});

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