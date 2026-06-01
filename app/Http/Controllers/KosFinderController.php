<?php

namespace App\Http\Controllers;

use App\Models\Kos;
use App\Models\Favorite;
use App\Models\Review;
use Illuminate\Http\Request;

class KosFinderController extends Controller
{
    // Lihat Daftar Kos + Cari + Filter Harga + Filter Jenis
    public function index(Request $request)
    {
        $query = Kos::with(['photos', 'reviews'])
            ->withCount('reviews')
            ->withAvg('reviews', 'rating');

        if ($request->filled('q')) {
            $search = $request->q;
            $query->where(function ($q) use ($search) {
                $q->where('nama_kos', 'like', "%{$search}%")
                  ->orWhere('alamat', 'like', "%{$search}%");
            });
        }

        if ($request->filled('harga_min')) {
            $query->where('harga', '>=', $request->harga_min);
        }
        if ($request->filled('harga_max')) {
            $query->where('harga', '<=', $request->harga_max);
        }

        if ($request->filled('jenis_kos') && in_array($request->jenis_kos, ['putra', 'putri', 'campur'])) {
            $query->where('jenis_kos', $request->jenis_kos);
        }

        $kosList = $query->latest()->paginate(9)->withQueryString();

        $favoriteIds = [];
        if (auth()->check()) {
            $favoriteIds = auth()->user()->favorites()->pluck('kos_id')->toArray();
        }

        return view('pencari.index', compact('kosList', 'favoriteIds'));
    }

    // Lihat Detail Kos
    public function show(Kos $kos)
    {
        $kos->load(['photos', 'reviews.user', 'user']);

        $isFavorit   = false;
        $sudahReview = false;

        if (auth()->check()) {
            $isFavorit   = auth()->user()->favorites()->where('kos_id', $kos->id)->exists();
            $sudahReview = auth()->user()->reviews()->where('kos_id', $kos->id)->exists();
        }

        $avgRating = $kos->reviews->avg('rating');

        return view('pencari.show', compact('kos', 'isFavorit', 'sudahReview', 'avgRating'));
    }

    // Tambah Favorit
    public function addFavorit(Kos $kos)
    {
        $exists = auth()->user()->favorites()->where('kos_id', $kos->id)->exists();
        if (!$exists) {
            auth()->user()->favorites()->create(['kos_id' => $kos->id]);
        }
        return back()->with('success', 'Kos berhasil ditambahkan ke favorit!');
    }

    // Hapus Favorit
    public function removeFavorit(Kos $kos)
    {
        auth()->user()->favorites()->where('kos_id', $kos->id)->delete();
        return back()->with('success', 'Kos dihapus dari favorit.');
    }

    // Lihat Favorit
    public function favorit()
    {
        $favoritKos = auth()->user()->favorites()
            ->with(['kos.photos', 'kos.reviews'])
            ->latest()
            ->get()
            ->pluck('kos')
            ->filter();

        return view('pencari.favorit', compact('favoritKos'));
    }

    // Tambah Review + Beri Rating
    public function storeReview(Request $request, Kos $kos)
    {
        $request->validate([
            'rating'   => 'required|integer|min:1|max:5',
            'komentar' => 'required|string|max:1000',
        ]);

        $sudahReview = auth()->user()->reviews()->where('kos_id', $kos->id)->exists();
        if ($sudahReview) {
            return back()->with('error', 'Kamu sudah pernah memberikan review untuk kos ini.');
        }

        auth()->user()->reviews()->create([
            'kos_id'   => $kos->id,
            'rating'   => $request->rating,
            'komentar' => $request->komentar,
        ]);

        return back()->with('success', 'Review berhasil ditambahkan!');
    }
}
