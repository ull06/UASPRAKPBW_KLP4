<!DOCTYPE html>
<html>
<head><title>Review - {{ $kos->nama_kos }}</title></head>
<body>
<h1>Review: {{ $kos->nama_kos }}</h1>
<a href="{{ route('owner.dashboard') }}">← Kembali</a>

@forelse($reviews as $r)
<div style="border:1px solid #ccc;padding:10px;margin:10px 0">
    <strong>{{ $r->user->name }}</strong> — ⭐ {{ $r->rating }}/5<br>
    <p>{{ $r->komentar }}</p>
    <small>{{ $r->created_at->diffForHumans() }}</small>
</div>
@empty
<p>Belum ada review untuk kos ini.</p>
@endforelse
</body>
</html>