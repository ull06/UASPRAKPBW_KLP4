@extends('layouts.app')

@section('title', 'Tambah Kos')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 style="color: var(--biru); font-weight: 700;">Tambah Kos Baru</h4>
        <a href="{{ route('owner.dashboard') }}" class="btn btn-sm btn-outline-secondary">
            ← Kembali
        </a>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('owner.kos.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label class="form-label fw-semibold">Nama Kos</label>
                    <input type="text" name="nama_kos" class="form-control" 
                           value="{{ old('nama_kos') }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Alamat</label>
                    <textarea name="alamat" class="form-control" rows="3" required>{{ old('alamat') }}</textarea>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Harga/Bulan (Rp)</label>
                        <input type="number" name="harga" class="form-control" 
                               value="{{ old('harga') }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Jenis Kos</label>
                        <select name="jenis_kos" class="form-select" required>
                            <option value="putra" {{ old('jenis_kos')=='putra'?'selected':'' }}>Putra</option>
                            <option value="putri" {{ old('jenis_kos')=='putri'?'selected':'' }}>Putri</option>
                            <option value="campur" {{ old('jenis_kos')=='campur'?'selected':'' }}>Campur</option>
                        </select>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Deskripsi</label>
                    <textarea name="deskripsi" class="form-control" rows="4">{{ old('deskripsi') }}</textarea>
                </div>
                <div class="mb-4">
                    <label class="form-label fw-semibold">Foto Kos (boleh lebih dari satu)</label>
                    <input type="file" name="photos[]" class="form-control" multiple accept="image/*">
                </div>
                <button type="submit" class="btn px-4" 
                        style="background: var(--merah); color: white;">
                    <i class="fas fa-save"></i> Simpan Kos
                </button>
            </form>
        </div>
    </div>
@endsection