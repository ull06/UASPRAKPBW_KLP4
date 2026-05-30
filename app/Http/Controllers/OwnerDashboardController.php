<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kos;
use App\Models\Review;
use App\Models\Favorite;

class OwnerDashboardController extends Controller
{
    public function index()
    {
        $kos = auth()->user()->kos()->withCount('reviews')->latest()->get();
        $totalKos = $kos->count();
        $totalKosTersedia = $kos->where('status', 'tersedia')->count();
        $totalReview = $kos->sum('reviews_count');
        $totalFavorit = auth()->user()->kos()->withCount('favorites')->get()->sum('favorites_count');

        return view('owner.dashboard', compact(
            'kos',
            'totalKos',
            'totalKosTersedia',
            'totalReview',
            'totalFavorit'
        ));
    }
}