<!DOCTYPE html>
<html>
<head><title>Edit Kos</title></head>
<body>
<h1>Edit: {{ $kos->nama_kos }}</h1>
<a href="{{ route('owner.dashboard') }}">← Kembali</a>

<form action="{{ route('owner.kos.update', $kos) }}" method="POST" enctype="multipart/form-data">
    @csrf @method('PUT')
    <div>
        <label>Nama Kos</label><br>
        <input type="text" name="nama_kos" value="{{ old('nama_kos', $kos->nama_kos) }}" required>
    </div>
    <div>
        <label>Alamat</label><br>
        <textarea name="alamat" required>{{ old('alamat', $kos->alamat) }}</textarea>
    </div>
    <div>
        <label>Harga/Bulan (Rp)</label><br>
        <input type="number" name="harga" value="{{ old('harga', $kos->harga) }}" required>
    </div>
    <div>
        <label>Jenis Kos</label><br>
        <select name="jenis_kos" required>
            @foreach(['putra','putri','campur'] as $j)
            <option value="{{ $j }}" {{ $kos->jenis_kos==$j?'selected':'' }}>{{ ucfirst($j) }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label>Status</label><br>
        <select name="status">
            <option value="tersedia" {{ $kos->status=='tersedia'?'selected':'' }}>Tersedia</option>
            <option value="penuh" {{ $kos->status=='penuh'?'selected':'' }}>Penuh</option>
        </select>
    </div>
    <div>
        <label>Deskripsi</label><br>
        <textarea name="deskripsi">{{ old('deskripsi', $kos->deskripsi) }}</textarea>
    </div>

    @if($kos->photos->count())
    <h3>Foto Saat Ini</h3>
    @foreach($kos->photos as $foto)
    <div>
        <img src="{{ asset('storage/'.$foto->image_path) }}" height="80">
        <form action="{{ route('owner.photo.delete', $foto) }}" method="POST" style="display:inline"
              onsubmit="return confirm('Hapus foto ini?')">
            @csrf @method('DELETE')
            <button type="submit">Hapus Foto</button>
        </form>
    </div>
    @endforeach
    @endif

    <div>
        <label>Tambah Foto Baru</label><br>
        <input type="file" name="photos[]" multiple accept="image/*">
    </div>
    <br>
    <button type="submit">Update Kos</button>
</form>
</body>
</html>