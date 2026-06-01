@extends('layouts.app')

@section('title', 'Cari Kos')

@section('styles')
<style>
    .card-kos { border: none; border-radius: 12px; overflow: hidden; transition: transform .2s, box-shadow .2s; }
    .card-kos:hover { transform: translateY(-4px); box-shadow: 0 8px 24px rgba(44,62,107,.15); }
    .card-kos .card-img-top { height: 180px; object-fit: cover; }
    .img-placeholder { height: 180px; background: linear-gradient(135deg,#dfe6e9,#b2bec3); display:flex; align-items:center; justify-content:center; color:#636e72; font-size:2.5rem; }
    .price-tag { color: var(--biru); font-weight: 700; font-size: 1.1rem; }
    .btn-favorit { border:none; background:none; padding:0; line-height:1; }
    .badge-putra { background-color: #2980b9; }
    .badge-putri { background-color: #e91e8c; }
    .badge-campur { background-color: #27ae60; }
    .hero-search { background: linear-gradient(135deg, var(--biru), #1a2547); padding: 30px 0 24px; margin: -1.5rem -12px 24px; border-radius: 0 0 16px 16px; }
    .search-card { background: white; border-radius: 12px; padding: 20px; box-shadow: 0 4px 20px rgba(0,0,0,.1); }
</style>
@endsection

@section('content')
<div class="hero-search px-3">
    <h4 class="text-white fw-bold mb-1"><i class="fas fa-search me-2"></i>Cari Kos</h4>
    <p class="text-white-50 mb-3 small">{{ $kosList->total() }} kos tersedia</p>
    <div class="search-card">
        <form method="GET" action="{{ route('pencari.kos.index') }}">
            <div class="row g-2">
                <div class="col-md-4">
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0"><i class="fas fa-search text-muted"></i></span>
                        <input type="text" name="q" class="form-control border-start-0"
                               placeholder="Nama / alamat kos..." value="{{ request('q') }}">
                    </div>
                </div>
                <div class="col-md-2">
                    <input type="number" name="harga_min" class="form-control"
                           placeholder="Harga Min (Rp)" value="{{ request('harga_min') }}" min="0">
                </div>
                <div class="col-md-2">
                    <input type="number" name="harga_max" class="form-control"
                           placeholder="Harga Max (Rp)" value="{{ request('harga_max') }}" min="0">
                </div>
                <div class="col-md-2">
                    <select name="jenis_kos" class="form-select">
                        <option value="">Semua Jenis</option>
                        <option value="putra"  {{ request('jenis_kos')==='putra'  ? 'selected':'' }}>Putra</option>
                        <option value="putri"  {{ request('jenis_kos')==='putri'  ? 'selected':'' }}>Putri</option>
                        <option value="campur" {{ request('jenis_kos')==='campur' ? 'selected':'' }}>Campur</option>
                    </select>
                </div>
                <div class="col-md-2 d-flex gap-2">
                    <button type="submit" class="btn btn-primary flex-fill">
                        <i class="fas fa-filter me-1"></i>Filter
                    </button>
                    @if(request()->anyFilled(['q','harga_min','harga_max','jenis_kos']))
                    <a href="{{ route('pencari.kos.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-times"></i>
                    </a>
                    @endif
                </div>
            </div>
        </form>
    </div>
</div>

@if($kosList->isEmpty())
    <div class="text-center py-5">
        <i class="fas fa-search fa-4x text-muted mb-3"></i>
        <h5 class="text-muted">Tidak ada kos ditemukan</h5>
        <a href="{{ route('pencari.kos.index') }}" class="btn btn-primary mt-2">Reset Filter</a>
    </div>
@else
    <div class="row g-4">
        @foreach($kosList as $kos)
        <div class="col-md-6 col-lg-4">
            <div class="card card-kos shadow-sm h-100">
                @if($kos->photos->isNotEmpty())
                    <img src="{{ asset('storage/' . $kos->photos->first()->image_path) }}"
                         class="card-img-top" alt="{{ $kos->nama_kos }}"
                         onerror="this.style.display='none';this.nextElementSibling.style.display='flex'">
                    <div class="img-placeholder" style="display:none"><i class="fas fa-building"></i></div>
                @else
                    <div class="img-placeholder"><i class="fas fa-building"></i></div>
                @endif

                <div class="card-body d-flex flex-column">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <h6 class="card-title fw-bold mb-0">{{ $kos->nama_kos }}</h6>
                        <form method="POST"
                              action="{{ in_array($kos->id,$favoriteIds) ? route('pencari.favorit.remove',$kos) : route('pencari.favorit.add',$kos) }}">
                            @csrf
                            @if(in_array($kos->id,$favoriteIds)) @method('DELETE') @endif
                            <button type="submit" class="btn-favorit ms-2" title="{{ in_array($kos->id,$favoriteIds) ? 'Hapus Favorit':'Tambah Favorit' }}">
                                <i class="fas fa-heart {{ in_array($kos->id,$favoriteIds) ? 'text-danger':'text-muted' }}" style="font-size:1.2rem"></i>
                            </button>
                        </form>
                    </div>

                    <div class="mb-2">
                        <span class="badge badge-jenis
                            @if($kos->jenis_kos==='putra') badge-putra
                            @elseif($kos->jenis_kos==='putri') badge-putri
                            @else badge-campur @endif" style="font-size:.7rem">
                            {{ ucfirst($kos->jenis_kos) }}
                        </span>
                        <span class="ms-2 badge {{ $kos->status==='tersedia'?'bg-success':'bg-danger' }}" style="font-size:.7rem">
                            {{ ucfirst($kos->status) }}
                        </span>
                    </div>

                    <p class="text-muted small mb-2">
                        <i class="fas fa-map-marker-alt me-1"></i>{{ Str::limit($kos->alamat,50) }}
                    </p>

                    @if($kos->reviews_count > 0)
                    <div class="mb-2">
                        @for($i=1;$i<=5;$i++)
                            <i class="fas fa-star" style="{{ $i<=round($kos->reviews_avg_rating)?'color:#f39c12':'color:#ddd' }}"></i>
                        @endfor
                        <small class="text-muted ms-1">{{ number_format($kos->reviews_avg_rating,1) }} ({{ $kos->reviews_count }})</small>
                    </div>
                    @else
                        <p class="text-muted small mb-2">Belum ada ulasan</p>
                    @endif

                    <div class="mt-auto">
                        <div class="price-tag mb-2">Rp {{ number_format($kos->harga,0,',','.') }}<small class="text-muted fw-normal">/bulan</small></div>
                        <a href="{{ route('pencari.kos.show',$kos) }}" class="btn btn-outline-primary w-100 btn-sm">
                            <i class="fas fa-eye me-1"></i>Lihat Detail
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div class="d-flex justify-content-center mt-4">
        {{ $kosList->links() }}
    </div>
@endif
@endsection
