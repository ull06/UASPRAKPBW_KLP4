@extends('layouts.app')

@section('title', 'Kos Saya')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 style="color: var(--biru); font-weight: 700;">Daftar Kos yang Dipesan</h4>
    <a href="{{ route('pencari.kos.index') }}" class="btn btn-outline-primary btn-sm">
        <i class="fas fa-search me-1"></i>Cari Kos Lagi
    </a>
</div>

@if($bookings->isEmpty())
    <div class="card border-0 shadow-sm text-center p-5">
        <i class="fas fa-bed fa-3x mb-3 text-muted"></i>
        <h5 class="text-muted">Belum ada pengajuan sewa</h5>
        <p class="text-muted">Ayo cari kos lalu klik tombol "Pesan Kamar".</p>
    </div>
@else
    <div class="row g-3">
        @foreach($bookings as $booking)
            <div class="col-md-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <h5 class="mb-0">{{ $booking->kos->nama_kos }}</h5>
                            <span class="badge
                                @if($booking->status === 'pending') bg-warning text-dark
                                @elseif($booking->status === 'diterima') bg-success
                                @else bg-danger @endif">
                                {{ ucfirst($booking->status) }}
                            </span>
                        </div>
                        <p class="text-muted mb-1">
                            <i class="fas fa-map-marker-alt me-1"></i>{{ $booking->kos->alamat }}
                        </p>
                        <p class="mb-1">
                            <strong>Harga:</strong> Rp {{ number_format($booking->kos->harga, 0, ',', '.') }}/bulan
                        </p>
                        <p class="mb-0">
                            <strong>Diajukan:</strong> {{ $booking->created_at->format('d M Y H:i') }}
                        </p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endif
@endsection
