<!DOCTYPE html>
<html>
<head><title>Tambah Kos</title></head>
<body>
<h1>Tambah Kos Baru</h1>
<a href="{{ route('owner.dashboard') }}">← Kembali</a>

<form action="{{ route('owner.kos.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div>
        <label>Nama Kos</label><br>
        <input type="text" name="nama_kos" value="{{ old('nama_kos') }}" required>
    </div>
    <div>
        <label>Alamat</label><br>
        <textarea name="alamat" required>{{ old('alamat') }}</textarea>
    </div>
    <div>
        <label>Harga/Bulan (Rp)</label><br>
        <input type="number" name="harga" value="{{ old('harga') }}" required>
    </div>
    <div>
        <label>Jenis Kos</label><br>
        <select name="jenis_kos" required>
            <option value="putra">Putra</option>
            <option value="putri">Putri</option>
            <option value="campur">Campur</option>
        </select>
    </div>
    <div>
        <label>Deskripsi</label><br>
        <textarea name="deskripsi">{{ old('deskripsi') }}</textarea>
    </div>
    <div>
        <label>Foto Kos (boleh lebih dari satu)</label><br>
        <input type="file" name="photos[]" multiple accept="image/*">
    </div>
    <br>
    <button type="submit">Simpan Kos</button>
</form>
</body>
</html>