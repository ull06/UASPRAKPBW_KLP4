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
        $totalKos = 0;
        $totalKosTersedia = 0;
        $totalReview = 0;
        $totalFavorit = 0;

        return view('owner.dashboard', compact(
            'totalKos',
            'totalKosTersedia',
            'totalReview',
            'totalFavorit'
        ));
    }
}