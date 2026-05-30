<?php

namespace App\Http\Controllers;

use App\Models\Kos;
use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KosController extends Controller
{
    public function index()
    {
    if (auth()->user()->role !== 'owner') {
        abort(403, 'Akses ditolak.');
    }
    $kos = auth()->user()->kos()->withCount('reviews')->latest()->get();
    $totalKos = $kos->count();
    $totalKosTersedia = $kos->where('status', 'tersedia')->count();
    $totalReview = $kos->sum('reviews_count');
    $totalFavorit = auth()->user()->kos()->withCount('favorites')->get()->sum('favorites_count');

    return view('owner.dashboard', compact('kos', 'totalKos', 'totalKosTersedia', 'totalReview', 'totalFavorit'));
    }
    
    public function create()
    {
        return view('owner.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kos'  => 'required|string|max:255',
            'alamat'    => 'required|string',
            'harga'     => 'required|numeric|min:0',
            'jenis_kos' => 'required|in:putra,putri,campur',
            'deskripsi' => 'nullable|string',
            'photos.*'  => 'nullable|image|max:2048',
        ]);

        $kos = auth()->user()->kos()->create($request->only([
            'nama_kos', 'alamat', 'harga', 'jenis_kos', 'deskripsi'
        ]));

        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $foto) {
                $path = $foto->store('kos_photos', 'public');
                $kos->photos()->create(['image_path' => $path]);
            }
        }

        return redirect()->route('owner.dashboard')->with('success', 'Kos berhasil ditambahkan!');
    }

    public function edit(Kos $kos)
    {
        $this->authorizeOwner($kos);
        return view('owner.edit', compact('kos'));
    }

    public function update(Request $request, Kos $kos)
    {
        $this->authorizeOwner($kos);

        $request->validate([
            'nama_kos'  => 'required|string|max:255',
            'alamat'    => 'required|string',
            'harga'     => 'required|numeric|min:0',
            'jenis_kos' => 'required|in:putra,putri,campur',
            'deskripsi' => 'nullable|string',
            'status'    => 'required|in:tersedia,penuh',
            'photos.*'  => 'nullable|image|max:2048',
        ]);

        $kos->update($request->only([
            'nama_kos', 'alamat', 'harga', 'jenis_kos', 'deskripsi', 'status'
        ]));

        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $foto) {
                $path = $foto->store('kos_photos', 'public');
                $kos->photos()->create(['image_path' => $path]);
            }
        }

        return redirect()->route('owner.dashboard')->with('success', 'Kos berhasil diperbarui!');
    }

    public function destroy(Kos $kos)
    {
        $this->authorizeOwner($kos);

        foreach ($kos->photos as $foto) {
            Storage::disk('public')->delete($foto->image_path);
        }

        $kos->delete();
        return redirect()->route('owner.dashboard')->with('success', 'Kos berhasil dihapus.');
    }

    public function toggleStatus(Kos $kos)
    {
        $this->authorizeOwner($kos);
        $kos->status = $kos->status === 'tersedia' ? 'penuh' : 'tersedia';
        $kos->save();
        return back()->with('success', 'Status kos diperbarui.');
    }

    public function deletePhoto(Photo $photo)
    {
        $kos = $photo->kos;
        $this->authorizeOwner($kos);
        Storage::disk('public')->delete($photo->image_path);
        $photo->delete();
        return back()->with('success', 'Foto berhasil dihapus.');
    }

    public function reviews(Kos $kos)
    {
        $this->authorizeOwner($kos);
        $reviews = $kos->reviews()->with('user')->latest()->get();
        return view('owner.reviews', compact('kos', 'reviews'));
    }

    private function authorizeOwner(Kos $kos)
    {
        if ($kos->user_id !== auth()->id()) {
            abort(403, 'Bukan kos milikmu.');
        }
    }
}