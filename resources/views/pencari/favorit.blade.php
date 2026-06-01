@extends('layouts.app')

@section('title', 'Favorit Saya')

@section('styles')
<style>
    .card-kos { border:none; border-radius:12px; overflow:hidden; transition:transform .2s,box-shadow .2s; }
    .card-kos:hover { transform:translateY(-4px); box-shadow:0 8px 24px rgba(44,62,107,.15); }
    .card-kos .card-img-top { height:180px; object-fit:cover; }
    .img-placeholder { height:180px; background:linear-gradient(135deg,#dfe6e9,#b2bec3); display:flex; align-items:center; justify-content:center; color:#636e72; font-size:2.5rem; }
    .price-tag { color:var(--biru); font-weight:700; font-size:1.1rem; }
    .badge-putra { background-color:#2980b9; }
    .badge-putri { background-color:#e91e8c; }
    .badge-campur { background-color:#27ae60; }
    .favorit-header { background:linear-gradient(135deg,var(--merah),#922b21); color:white; padding:24px; border-radius:12px; margin-bottom:24px; }
</style>
@endsection

@section('content')
<div class="favorit-header">
    <h4 class="fw-bold mb-1"><i class="fas fa-heart me-2"></i>Kos Favorit Saya</h4>
    <p class="mb-0 opacity-75">{{ $favoritKos->count() }} kos tersimpan</p>
</div>

@if($favoritKos->isEmpty())
    <div class="text-center py-5">
        <i class="fas fa-heart-broken fa-4x text-muted mb-3"></i>
        <h5 class="text-muted">Belum ada kos favorit</h5>
        <a href="{{ route('pencari.kos.index') }}" class="btn btn-primary mt-2">
            <i class="fas fa-search me-2"></i>Cari Kos
        </a>
    </div>
@else
    <div class="row g-4">
        @foreach($favoritKos as $kos)
        <div class="col-md-6 col-lg-4">
            <div class="card card-kos shadow-sm h-100">
                @if($kos->photos->isNotEmpty())
                    <img src="{{ asset('storage/'.$kos->photos->first()->image_path) }}"
                         class="card-img-top" alt="{{ $kos->nama_kos }}"
                         onerror="this.style.display='none';this.nextElementSibling.style.display='flex'">
                    <div class="img-placeholder" style="display:none"><i class="fas fa-building"></i></div>
                @else
                    <div class="img-placeholder"><i class="fas fa-building"></i></div>
                @endif

                <div class="card-body d-flex flex-column">
                    <h6 class="fw-bold">{{ $kos->nama_kos }}</h6>
                    <div class="mb-2">
                        <span class="badge
                            @if($kos->jenis_kos==='putra') badge-putra
                            @elseif($kos->jenis_kos==='putri') badge-putri
                            @else badge-campur @endif me-1" style="font-size:.7rem">
                            {{ ucfirst($kos->jenis_kos) }}
                        </span>
                        <span class="badge {{ $kos->status==='tersedia'?'bg-success':'bg-danger' }}" style="font-size:.7rem">
                            {{ ucfirst($kos->status) }}
                        </span>
                    </div>
                    <p class="text-muted small mb-2">
                        <i class="fas fa-map-marker-alt me-1"></i>{{ Str::limit($kos->alamat,50) }}
                    </p>
                    @if($kos->reviews->count() > 0)
                    <div class="mb-2">
                        @for($i=1;$i<=5;$i++)
                            <i class="fas fa-star" style="{{ $i<=round($kos->reviews->avg('rating'))?'color:#f39c12':'color:#ddd' }}"></i>
                        @endfor
                        <small class="text-muted">({{ $kos->reviews->count() }})</small>
                    </div>
                    @endif
                    <div class="mt-auto">
                        <div class="price-tag mb-2">Rp {{ number_format($kos->harga,0,',','.') }}<small class="text-muted fw-normal">/bulan</small></div>
                        <div class="d-flex gap-2">
                            <a href="{{ route('pencari.kos.show',$kos) }}" class="btn btn-outline-primary btn-sm flex-fill">
                                <i class="fas fa-eye me-1"></i>Detail
                            </a>
                            <form method="POST" action="{{ route('pencari.favorit.remove',$kos) }}">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger btn-sm"
                                        onclick="return confirm('Hapus dari favorit?')">
                                    <i class="fas fa-heart-broken"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
@endif
@endsection
