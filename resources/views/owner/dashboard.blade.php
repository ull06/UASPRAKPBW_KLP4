@extends('layouts.app')

@section('title', 'Dashboard Owner')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 style="color: var(--biru); font-weight: 700;">Dashboard Owner</h4>
        <a href="{{ route('owner.kos.create') }}" class="btn px-4" 
           style="background: var(--merah); color: white;">
            <i class="fas fa-plus me-1"></i> Tambah Kos
        </a>
    </div>

    {{-- Stats --}}
    <div class="row mb-4">
        <div class="col-6 col-md-3 mb-3">
            <div class="card border-0 shadow-sm text-center p-3">
                <i class="fas fa-home fa-2x mb-2" style="color: var(--merah);"></i>
                <h3 style="color: var(--biru);">{{ $totalKos }}</h3>
                <small class="text-muted">Total Kos</small>
            </div>
        </div>
        <div class="col-6 col-md-3 mb-3">
            <div class="card border-0 shadow-sm text-center p-3">
                <i class="fas fa-door-open fa-2x mb-2" style="color: var(--merah);"></i>
                <h3 style="color: var(--biru);">{{ $totalKosTersedia }}</h3>
                <small class="text-muted">Tersedia</small>
            </div>
        </div>
        <div class="col-6 col-md-3 mb-3">
            <div class="card border-0 shadow-sm text-center p-3">
                <i class="fas fa-star fa-2x mb-2" style="color: var(--merah);"></i>
                <h3 style="color: var(--biru);">{{ $totalReview }}</h3>
                <small class="text-muted">Total Review</small>
            </div>
        </div>
        <div class="col-6 col-md-3 mb-3">
            <div class="card border-0 shadow-sm text-center p-3">
                <i class="fas fa-heart fa-2x mb-2" style="color: var(--merah);"></i>
                <h3 style="color: var(--biru);">{{ $totalFavorit }}</h3>
                <small class="text-muted">Difavoritkan</small>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Daftar Kos sebagai Cards --}}
    @if($kos->isEmpty())
        <div class="card border-0 shadow-sm text-center p-5">
            <i class="fas fa-home fa-3x mb-3 text-muted"></i>
            <h5 class="text-muted">Belum ada kos</h5>
            <p class="text-muted">Mulai tambahkan kos pertama kamu!</p>
            <a href="{{ route('owner.kos.create') }}" class="btn mx-auto px-4" 
               style="background: var(--merah); color: white; width: fit-content;">
                + Tambah Kos
            </a>
        </div>
    @else
        <div class="row">
            @foreach($kos as $k)
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card border-0 shadow-sm h-100">
                    {{-- Foto --}}
                    @if($k->photos->count())
                        <img src="{{ asset('images/'.$k->photos->first()->image_path) }}" 
                             class="card-img-top" style="height: 180px; object-fit: cover;">
                    @else
                        <div class="card-img-top d-flex align-items-center justify-content-center" 
                             style="height: 180px; background: #f0f0f0;">
                            <i class="fas fa-home fa-3x text-muted"></i>
                        </div>
                    @endif

                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <h6 class="fw-bold mb-0" style="color: var(--biru);">{{ $k->nama_kos }}</h6>
                            {{-- Badge Jenis --}}
                            <span class="badge" style="background: var(--biru); font-size: 0.7rem;">
                                {{ ucfirst($k->jenis_kos) }}
                            </span>
                        </div>

                        <p class="text-muted small mb-1">
                            <i class="fas fa-map-marker-alt me-1" style="color: var(--merah);"></i>
                            {{ Str::limit($k->alamat, 50) }}
                        </p>

                        <p class="fw-bold mb-2" style="color: var(--merah);">
                            Rp {{ number_format($k->harga, 0, ',', '.') }}<small class="text-muted fw-normal">/bulan</small>
                        </p>

                        <div class="d-flex justify-content-between align-items-center mb-3">
                            {{-- Toggle Status --}}
                            <form action="{{ route('owner.kos.status', $k) }}" method="POST">
                                @csrf @method('PATCH')
                                <button type="submit" class="btn btn-sm {{ $k->status == 'tersedia' ? 'btn-success' : 'btn-danger' }}">
                                    <i class="fas {{ $k->status == 'tersedia' ? 'fa-check-circle' : 'fa-times-circle' }} me-1"></i>
                                    {{ ucfirst($k->status) }}
                                </button>
                            </form>

                            <a href="{{ route('owner.kos.reviews', $k) }}" 
                               class="text-decoration-none small" style="color: var(--biru);">
                                <i class="fas fa-star" style="color: var(--merah);"></i>
                                {{ $k->reviews_count }} review
                            </a>
                        </div>

                        <div class="d-flex gap-2">
                            <a href="{{ route('owner.kos.edit', $k) }}" 
                               class="btn btn-sm btn-outline-primary flex-fill">
                                <i class="fas fa-edit me-1"></i>Edit
                            </a>
                            <form action="{{ route('owner.kos.destroy', $k) }}" method="POST" 
                                  class="flex-fill" onsubmit="return confirm('Hapus kos ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger w-100">
                                    <i class="fas fa-trash me-1"></i>Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @endif
@endsection