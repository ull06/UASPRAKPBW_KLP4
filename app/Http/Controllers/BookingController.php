<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Kos;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function store(Request $request, Kos $kos)
    {
        if ($kos->status !== 'tersedia') {
            return back()->with('error', 'Maaf, kos ini sedang tidak tersedia.');
        }

        $alreadyPending = Booking::query()
            ->where('user_id', auth()->id())
            ->where('kos_id', $kos->id)
            ->where('status', 'pending')
            ->exists();

        if ($alreadyPending) {
            return back()->with('error', 'Kamu sudah pernah mengajukan sewa untuk kos ini.');
        }

        Booking::create([
            'user_id' => auth()->id(),
            'kos_id' => $kos->id,
            'catatan' => $request->input('catatan'),
        ]);

        return back()->with('success', 'Pengajuan sewa berhasil dikirim.');
    }

    public function pencariIndex()
    {
        $bookings = auth()->user()->bookings()
            ->with(['kos.photos', 'kos.user'])
            ->latest()
            ->get();

        return view('pencari.bookings', compact('bookings'));
    }

    public function ownerIndex()
    {
        $bookings = Booking::query()
            ->whereHas('kos', function ($query) {
                $query->where('user_id', auth()->id());
            })
            ->with(['user', 'kos.photos'])
            ->latest()
            ->get();

        return view('owner.bookings', compact('bookings'));
    }

    public function updateStatus(Request $request, Booking $booking)
    {
        if ($booking->kos->user_id !== auth()->id()) {
            abort(403, 'Akses ditolak.');
        }

        $request->validate([
            'status' => 'required|in:diterima,ditolak',
        ]);

        if ($booking->status !== 'pending') {
            return back()->with('error', 'Pengajuan ini sudah diproses sebelumnya.');
        }

        $booking->update(['status' => $request->status]);

        if ($request->status === 'diterima') {
            $booking->kos->update(['status' => 'penuh']);
        }

        return back()->with('success', 'Status pengajuan berhasil diperbarui.');
    }
}
