@extends('layouts.app')

@section('title', $kos->nama_kos)

@section('styles')
<style>
    .main-img { height: 360px; object-fit: cover; border-radius: 12px; width: 100%; }
    .gallery-img { width:100%; height:90px; object-fit:cover; border-radius:8px; cursor:pointer; transition:opacity .2s; }
    .gallery-img:hover { opacity:.8; }
    .star-input { display:flex; gap:6px; flex-direction:row-reverse; justify-content:flex-end; }
    .star-input input { display:none; }
    .star-input label { font-size:2rem; color:#ccc; cursor:pointer; transition:color .2s; }
    .star-input input:checked ~ label,
    .star-input label:hover,
    .star-input label:hover ~ label { color:#f39c12; }
    .img-placeholder-main { height:360px; background:linear-gradient(135deg,#dfe6e9,#b2bec3); display:flex; align-items:center; justify-content:center; color:#636e72; font-size:4rem; border-radius:12px; }
    .badge-putra { background-color:#2980b9; }
    .badge-putri { background-color:#e91e8c; }
    .badge-campur { background-color:#27ae60; }
</style>
@endsection

@section('content')
<div class="mb-3">
    <a href="{{ route('pencari.kos.index') }}" class="btn btn-sm btn-outline-secondary">
        <i class="fas fa-arrow-left me-1"></i>Kembali ke Daftar Kos
    </a>
</div>

<div class="row g-4">
    {{-- Kiri: Foto & Ulasan --}}
    <div class="col-lg-7">
        @if($kos->photos->isNotEmpty())
            <img id="mainPhoto" src="{{ asset('storage/'.$kos->photos->first()->image_path) }}"
                 class="main-img mb-3 shadow-sm" alt="{{ $kos->nama_kos }}">
        @else
            <div class="img-placeholder-main mb-3"><i class="fas fa-building"></i></div>
        @endif

        @if($kos->photos->count() > 1)
        <div class="row g-2 mb-3">
            @foreach($kos->photos as $foto)
            <div class="col-3">
                <img src="{{ asset('storage/'.$foto->image_path) }}" class="gallery-img"
                     onclick="document.getElementById('mainPhoto').src=this.src">
            </div>
            @endforeach
        </div>
        @endif

        @if($kos->deskripsi)
        <div class="card border-0 shadow-sm mb-3">
            <div class="card-body">
                <h6 class="fw-bold mb-2"><i class="fas fa-info-circle me-2 text-primary"></i>Deskripsi</h6>
                <p class="mb-0 text-muted">{{ $kos->deskripsi }}</p>
            </div>
        </div>
        @endif

        {{-- Ulasan --}}
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h6 class="fw-bold mb-0"><i class="fas fa-star me-2 text-warning"></i>Ulasan ({{ $kos->reviews->count() }})</h6>
                    @if($avgRating)
                        <span class="badge bg-warning text-dark">⭐ {{ number_format($avgRating,1) }} / 5</span>
                    @endif
                </div>

                @forelse($kos->reviews as $review)
                <div class="border-bottom pb-3 mb-3">
                    <div class="d-flex justify-content-between mb-1">
                        <strong>{{ $review->user->name }}</strong>
                        <small class="text-muted">{{ $review->created_at->diffForHumans() }}</small>
                    </div>
                    <div class="mb-1">
                        @for($i=1;$i<=5;$i++)
                            <i class="fas fa-star" style="{{ $i<=$review->rating?'color:#f39c12':'color:#ddd' }}"></i>
                        @endfor
                    </div>
                    <p class="mb-0 text-muted">{{ $review->komentar }}</p>
                </div>
                @empty
                    <p class="text-muted fst-italic">Belum ada ulasan.</p>
                @endforelse

                {{-- Form Review --}}
                @if(!$sudahReview)
                <hr>
                <h6 class="fw-bold mb-3"><i class="fas fa-pen me-2"></i>Tulis Ulasan</h6>
                <form method="POST" action="{{ route('pencari.review.store',$kos) }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Rating</label>
                        <div class="star-input">
                            @for($i=5;$i>=1;$i--)
                            <input type="radio" id="star{{$i}}" name="rating" value="{{$i}}"
                                   {{ old('rating')==$i?'checked':'' }}>
                            <label for="star{{$i}}">&#9733;</label>
                            @endfor
                        </div>
                        @error('rating')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Komentar</label>
                        <textarea name="komentar" rows="3"
                                  class="form-control @error('komentar') is-invalid @enderror"
                                  placeholder="Bagikan pengalamanmu...">{{ old('komentar') }}</textarea>
                        @error('komentar')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-paper-plane me-1"></i>Kirim Ulasan
                    </button>
                </form>
                @else
                <hr>
                <div class="alert alert-info mb-0 py-2">
                    <i class="fas fa-check-circle me-2"></i>Kamu sudah memberikan ulasan untuk kos ini.
                </div>
                @endif
            </div>
        </div>
    </div>

    {{-- Kanan: Info & Aksi --}}
    <div class="col-lg-5">
        <div class="card border-0 shadow-sm sticky-top" style="top:20px">
            <div class="card-body">
                <h4 class="fw-bold mb-1">{{ $kos->nama_kos }}</h4>
                <div class="mb-3">
                    <span class="badge
                        @if($kos->jenis_kos==='putra') badge-putra
                        @elseif($kos->jenis_kos==='putri') badge-putri
                        @else badge-campur @endif me-2">
                        Kos {{ ucfirst($kos->jenis_kos) }}
                    </span>
                    <span class="badge {{ $kos->status==='tersedia'?'bg-success':'bg-danger' }}">
                        {{ ucfirst($kos->status) }}
                    </span>
                </div>
                <hr>
                <p class="mb-2"><i class="fas fa-map-marker-alt text-danger me-2"></i>{{ $kos->alamat }}</p>
                <p class="mb-2"><i class="fas fa-user text-primary me-2"></i>Pemilik: <strong>{{ $kos->user->name }}</strong></p>
                @if($avgRating)
                <p class="mb-2"><i class="fas fa-star text-warning me-2"></i>{{ number_format($avgRating,1) }} / 5 ({{ $kos->reviews->count() }} ulasan)</p>
                @endif
                <hr>
                <div class="text-center mb-3">
                    <div style="font-size:1.8rem; font-weight:800; color:var(--biru)">
                        Rp {{ number_format($kos->harga,0,',','.') }}
                    </div>
                    <div class="text-muted small">per bulan</div>
                </div>

                {{-- Tombol Favorit --}}
                <form method="POST"
                      action="{{ $isFavorit ? route('pencari.favorit.remove',$kos) : route('pencari.favorit.add',$kos) }}"
                      class="mb-2">
                    @csrf
                    @if($isFavorit) @method('DELETE') @endif
                    <button type="submit" class="btn w-100 {{ $isFavorit?'btn-danger':'btn-outline-danger' }}">
                        <i class="fas fa-heart me-2"></i>
                        {{ $isFavorit ? 'Hapus dari Favorit' : 'Tambah ke Favorit' }}
                    </button>
                </form>

                <a href="{{ route('pencari.kos.index') }}" class="btn btn-outline-secondary w-100">
                    <i class="fas fa-arrow-left me-2"></i>Kembali
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
