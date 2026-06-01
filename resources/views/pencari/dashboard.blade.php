@extends('layouts.app')

@section('title', 'Dashboard Pencari Kos')

@section('content')
    <h4 class="mb-4" style="color: var(--biru); font-weight: 700;">Dashboard Pencari Kos</h4>

    <div class="row">
        <div class="col-md-6">
            <div class="card mb-3 border-0 shadow-sm">
                <div class="card-body">
                    <h6 class="text-muted">Favorit Saya</h6>
                    <h2 style="color: var(--biru);"><?php echo $totalFavorit; ?></h2>
                    <i class="fas fa-heart fa-2x" style="color: var(--merah);"></i>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card mb-3 border-0 shadow-sm">
                <div class="card-body">
                    <h6 class="text-muted">Review Saya</h6>
                    <h2 style="color: var(--biru);"><?php echo $totalReview; ?></h2>
                    <i class="fas fa-star fa-2x" style="color: var(--merah);"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm mt-3">
        <div class="card-body">
            <h5 style="color: var(--biru);">Selamat datang, {{ Auth::user()->name ?? 'Pencari Kos' }}!</h5>
            <p class="text-muted">Temukan kos impianmu di sini.</p>
        </div>
    </div>
@endsection