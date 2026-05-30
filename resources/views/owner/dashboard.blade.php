@extends('layouts.app')

@section('title', 'Dashboard Owner')

@section('content')
    <h4 class="mb-4" style="color: var(--biru); font-weight: 700;">Dashboard Owner</h4>

    <div class="row">
        <div class="col-md-3">
            <div class="card mb-3 border-0 shadow-sm">
                <div class="card-body">
                    <h6 class="text-muted">Total Kos Saya</h6>
                    <h2 style="color: var(--biru);">{{ $totalKos }}</h2>
                    <i class="fas fa-home fa-2x" style="color: var(--merah);"></i>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card mb-3 border-0 shadow-sm">
                <div class="card-body">
                    <h6 class="text-muted">Total Kos Tersedia</h6>
                    <h2 style="color: var(--biru);">{{ $totalKosTersedia }}</h2>
                    <i class="fas fa-door-open fa-2x" style="color: var(--merah);"></i>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card mb-3 border-0 shadow-sm">
                <div class="card-body">
                    <h6 class="text-muted">Total Review</h6>
                    <h2 style="color: var(--biru);">{{ $totalReview }}</h2>
                    <i class="fas fa-star fa-2x" style="color: var(--merah);"></i>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card mb-3 border-0 shadow-sm">
                <div class="card-body">
                    <h6 class="text-muted">Total Favorit</h6>
                    <h2 style="color: var(--biru);">{{ $totalFavorit }}</h2>
                    <i class="fas fa-heart fa-2x" style="color: var(--merah);"></i>
                </div>
            </div>
        </div>
    </div>

    {{-- Daftar Kos --}}
    <div class="card border-0 shadow-sm mt-3">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 style="color: var(--biru);">Daftar Kos Saya</h5>
                <a href="{{ route('owner.kos.create') }}" class="btn btn-sm" 
                   style="background: var(--merah); color: white;">
                    <i class="fas fa-plus"></i> Tambah Kos
                </a>
            </div>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if($kos->isEmpty())
                <p class="text-muted">Belum ada kos. Tambahkan kos pertama kamu!</p>
            @else
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr style="color: var(--biru);">
                            <th>Nama Kos</th>
                            <th>Harga</th>
                            <th>Jenis</th>
                            <th>Status</th>
                            <th>Review</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($kos as $k)
                        <tr>
                            <td>{{ $k->nama_kos }}</td>
                            <td>Rp {{ number_format($k->harga, 0, ',', '.') }}</td>
                            <td>{{ ucfirst($k->jenis_kos) }}</td>
                            <td>
                                <form action="{{ route('owner.kos.status', $k) }}" method="POST" class="d-inline">
                                    @csrf @method('PATCH')
                                    <button type="submit" class="btn btn-sm {{ $k->status == 'tersedia' ? 'btn-success' : 'btn-danger' }}">
                                        {{ ucfirst($k->status) }}
                                    </button>
                                </form>
                            </td>
                            <td>
                                <a href="{{ route('owner.kos.reviews', $k) }}" class="text-decoration-none">
                                    <i class="fas fa-star" style="color: var(--merah);"></i>
                                    {{ $k->reviews_count }} review
                                </a>
                            </td>
                            <td>
                                <a href="{{ route('owner.kos.edit', $k) }}" class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form action="{{ route('owner.kos.destroy', $k) }}" method="POST" class="d-inline"
                                      onsubmit="return confirm('Hapus kos ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @endif
        </div>
    </div>
@endsection