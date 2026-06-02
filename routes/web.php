<?php
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KosController;
use App\Http\Controllers\OwnerDashboardController;
use App\Http\Controllers\PencariKosDashboardController;
use App\Http\Controllers\KosFinderController;

// Halaman Utama
Route::get('/', function () {
    return view('welcome');
});

// Redirect setelah login berdasarkan role
Route::get('/dashboard', function () {
    if (auth()->user()->role === 'owner') {
        return redirect()->route('owner.dashboard');
    }
    return redirect()->route('pencari.dashboard');
})->middleware('auth')->name('dashboard');

// Routes Owner
Route::middleware(['auth', 'owner'])->prefix('owner')->name('owner.')->group(function () {
    Route::get('/dashboard',          [OwnerDashboardController::class, 'index'])->name('dashboard');
    Route::get('/kos/create',         [KosController::class, 'create'])->name('kos.create');
    Route::post('/kos',               [KosController::class, 'store'])->name('kos.store');
    Route::get('/kos/{kos}/edit',     [KosController::class, 'edit'])->name('kos.edit');
    Route::put('/kos/{kos}',          [KosController::class, 'update'])->name('kos.update');
    Route::delete('/kos/{kos}',       [KosController::class, 'destroy'])->name('kos.destroy');
    Route::patch('/kos/{kos}/status', [KosController::class, 'toggleStatus'])->name('kos.status');
    Route::delete('/photo/{photo}',   [KosController::class, 'deletePhoto'])->name('photo.delete');
    Route::get('/kos/{kos}/reviews',  [KosController::class, 'reviews'])->name('kos.reviews');
});

// Routes Pencari
Route::middleware(['auth', 'pencari'])->prefix('pencari')->name('pencari.')->group(function () {
    Route::get('/dashboard',              [PencariKosDashboardController::class, 'index'])->name('dashboard');
    Route::get('/kos',                    [KosFinderController::class, 'index'])->name('kos.index');
    Route::get('/kos/{kos}',             [KosFinderController::class, 'show'])->name('kos.show');
    Route::post('/kos/{kos}/favorit',    [KosFinderController::class, 'addFavorit'])->name('favorit.add');
    Route::delete('/kos/{kos}/favorit',  [KosFinderController::class, 'removeFavorit'])->name('favorit.remove');
    Route::get('/favorit',               [KosFinderController::class, 'favorit'])->name('favorit');
    Route::post('/kos/{kos}/review',     [KosFinderController::class, 'storeReview'])->name('review.store');
    Route::get('/review',                [KosFinderController::class, 'myReviews'])->name('review.index');
});

// Kelola Profil User
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';