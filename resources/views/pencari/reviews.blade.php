@extends('layouts.app')

@section('title', 'Review Saya')

@section('content')
    <h4 class="mb-4" style="color: var(--biru); font-weight: 700;">
        <i class="fas fa-star me-2"></i>Review Saya
    </h4>

    @if($reviews->isEmpty())
        <div class="card border-0 shadow-sm">
            <div class="card-body text-center py-5">
                <i class="fas fa-star fa-3x mb-3" style="color: var(--merah); opacity:.3;"></i>
                <p class="text-muted">Kamu belum memberikan review apapun.</p>
                <a href="{{ route('pencari.kos.index') }}" class="btn btn-primary">
                    <i class="fas fa-search me-1"></i>Cari Kos
                </a>
            </div>
        </div>
    @else
        <div class="row">
            @foreach($reviews as $review)
                <div class="col-md-6 mb-3">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body">
                            <h6 style="color: var(--biru);">{{ $review->kos->nama_kos }}</h6>
                            <p class="text-muted small mb-1">{{ $review->kos->alamat }}</p>
                            <div class="mb-2">
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="fas fa-star" style="color: {{ $i <= $review->rating ? '#ffc107' : '#e0e0e0' }};"></i>
                                @endfor
                                <span class="ms-1 small text-muted">({{ $review->rating }}/5)</span>
                            </div>
                            <p class="mb-2">{{ $review->komentar }}</p>
                            <small class="text-muted">{{ $review->created_at->diffForHumans() }}</small>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
@endsection