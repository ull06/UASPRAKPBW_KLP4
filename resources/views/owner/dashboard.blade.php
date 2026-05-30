<!DOCTYPE html>
<html>
<head><title>Dashboard Owner</title></head>
<body>
<h1>Kos Saya</h1>

@if(session('success'))
    <p style="color:green">{{ session('success') }}</p>
@endif

<a href="{{ route('owner.kos.create') }}">+ Tambah Kos</a>

<table border="1" cellpadding="8">
    <tr>
        <th>Nama Kos</th><th>Harga</th><th>Status</th>
        <th>Review</th><th>Aksi</th>
    </tr>
    @forelse($kos as $k)
    <tr>
        <td>{{ $k->nama_kos }}</td>
        <td>Rp {{ number_format($k->harga, 0, ',', '.') }}</td>
        <td>
            <form action="{{ route('owner.kos.status', $k) }}" method="POST">
                @csrf @method('PATCH')
                <button type="submit" style="background:{{ $k->status=='tersedia'?'green':'red' }};color:white">
                    {{ $k->status }}
                </button>
            </form>
        </td>
        <td>
            <a href="{{ route('owner.kos.reviews', $k) }}">
                {{ $k->reviews_count }} review
            </a>
        </td>
        <td>
            <a href="{{ route('owner.kos.edit', $k) }}">Edit</a> |
            <form action="{{ route('owner.kos.destroy', $k) }}" method="POST" style="display:inline"
                  onsubmit="return confirm('Hapus kos ini?')">
                @csrf @method('DELETE')
                <button type="submit">Hapus</button>
            </form>
        </td>
    </tr>
    @empty
    <tr><td colspan="5">Belum ada kos.</td></tr>
    @endforelse
</table>
</body>
</html>