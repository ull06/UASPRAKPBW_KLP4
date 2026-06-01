@extends('layouts.app')

@section('title', 'Edit Kos')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 style="color: var(--biru); font-weight: 700;">Edit: {{ $kos->nama_kos }}</h4>
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

            {{-- FORM EDIT KOS (tanpa foto) --}}
            <form action="{{ route('owner.kos.update', $kos) }}" method="POST" enctype="multipart/form-data">
                @csrf @method('PUT')

                <h6 class="fw-bold mb-3" style="color: var(--biru);">
                    <i class="fas fa-home me-2"></i>Informasi Dasar
                </h6>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Nama Kos <span class="text-danger">*</span></label>
                    <input type="text" name="nama_kos" class="form-control"
                           value="{{ old('nama_kos', $kos->nama_kos) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Alamat Lengkap <span class="text-danger">*</span></label>
                    <textarea name="alamat" class="form-control" rows="3" required>{{ old('alamat', $kos->alamat) }}</textarea>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Harga per Bulan (Rp) <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="number" name="harga" class="form-control"
                                   value="{{ old('harga', $kos->harga) }}" required>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label fw-semibold">Jenis Kos <span class="text-danger">*</span></label>
                        <select name="jenis_kos" class="form-select" required>
                            @foreach(['putra','putri','campur'] as $j)
                            <option value="{{ $j }}" {{ old('jenis_kos', $kos->jenis_kos)==$j?'selected':'' }}>
                                {{ ucfirst($j) }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label fw-semibold">Status</label>
                        <select name="status" class="form-select">
                            <option value="tersedia" {{ old('status', $kos->status)=='tersedia'?'selected':'' }}>Tersedia</option>
                            <option value="penuh" {{ old('status', $kos->status)=='penuh'?'selected':'' }}>Penuh</option>
                        </select>
                    </div>
                </div>

                <hr class="my-4">

                <h6 class="fw-bold mb-3" style="color: var(--biru);">
                    <i class="fas fa-align-left me-2"></i>Deskripsi & Fasilitas
                </h6>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Deskripsi Kos</label>
                    <textarea name="deskripsi" class="form-control" rows="5">{{ old('deskripsi', $kos->deskripsi) }}</textarea>
                </div>

                <hr class="my-4">

                <h6 class="fw-bold mb-3" style="color: var(--biru);">
                    <i class="fas fa-camera me-2"></i>Tambah Foto Baru
                </h6>

                <div class="mb-4">
                    <input type="file" name="photos[]" class="form-control" multiple accept="image/*">
                    <div class="form-text">Format: JPG, PNG. Maks 2MB per foto.</div>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn px-4"
                            style="background: var(--merah); color: white;">
                        <i class="fas fa-save me-1"></i> Update Kos
                    </button>
                    <a href="{{ route('owner.dashboard') }}" class="btn btn-outline-secondary px-4">
                        Batal
                    </a>
                </div>
            </form>

            {{-- KELOLA FOTO (di luar form edit) --}}
            @if($kos->photos->count())
            <hr class="my-4">
            <h6 class="fw-bold mb-3" style="color: var(--biru);">
                <i class="fas fa-images me-2"></i>Kelola Foto Saat Ini
            </h6>
            <p class="text-muted small mb-3">Klik "Hapus Foto" untuk menghapus foto satu per satu.</p>
            <div class="row">
                @foreach($kos->photos as $foto)
                <div class="col-4 col-md-3 mb-3">
                    <div class="rounded-3 overflow-hidden mb-2" style="height:100px;">
                        <img src="{{ asset('storage/'.$foto->image_path) }}"
                             class="w-100 h-100" style="object-fit:cover;">
                    </div>
                    <form action="{{ route('owner.photo.delete', $foto) }}" method="POST"
                          onsubmit="return confirm('Hapus foto ini saja? Kos tidak akan terhapus.')">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-outline-danger w-100"
                                style="font-size:0.75rem;">
                            <i class="fas fa-times me-1"></i>Hapus Foto
                        </button>
                    </form>
                </div>
                @endforeach
            </div>
            @endif

        </div>
    </div>
@endsection