<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OwnerDashboardController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/owner/dashboard', [OwnerDashboardController::class, 'index'])->name('owner.dashboard');