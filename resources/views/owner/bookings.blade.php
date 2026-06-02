@extends('layouts.app')

@section('title', 'Pengajuan Sewa')

@section('content')
<div class="mb-4">
    <h4 style="color: var(--biru); font-weight: 700;">Daftar Pengajuan Sewa</h4>
    <p class="text-muted mb-0">Kelola pengajuan masuk dari pencari kos.</p>
</div>

@if($bookings->isEmpty())
    <div class="card border-0 shadow-sm text-center p-5">
        <i class="fas fa-inbox fa-3x mb-3 text-muted"></i>
        <h5 class="text-muted">Belum ada pengajuan sewa</h5>
    </div>
@else
    <div class="table-responsive">
        <table class="table table-bordered bg-white align-middle">
            <thead class="table-light">
                <tr>
                    <th>Nama Pencari</th>
                    <th>Email</th>
                    <th>Kos</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                    <th style="width: 190px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bookings as $booking)
                    <tr>
                        <td>{{ $booking->user->name }}</td>
                        <td>{{ $booking->user->email }}</td>
                        <td>{{ $booking->kos->nama_kos }}</td>
                        <td>{{ $booking->created_at->format('d M Y H:i') }}</td>
                        <td>
                            <span class="badge
                                @if($booking->status === 'pending') bg-warning text-dark
                                @elseif($booking->status === 'diterima') bg-success
                                @else bg-danger @endif">
                                {{ ucfirst($booking->status) }}
                            </span>
                        </td>
                        <td>
                            @if($booking->status === 'pending')
                                <div class="d-flex gap-2">
                                    <form method="POST" action="{{ route('owner.bookings.status', $booking) }}">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="status" value="diterima">
                                        <button type="submit" class="btn btn-success btn-sm">
                                            <i class="fas fa-check me-1"></i>Terima
                                        </button>
                                    </form>
                                    <form method="POST" action="{{ route('owner.bookings.status', $booking) }}">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="status" value="ditolak">
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fas fa-times me-1"></i>Tolak
                                        </button>
                                    </form>
                                </div>
                            @else
                                <span class="text-muted small">Sudah diproses</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endif
@endsection
