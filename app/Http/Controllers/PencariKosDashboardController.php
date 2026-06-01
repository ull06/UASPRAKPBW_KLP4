<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;
use App\Models\Review;

class PencariKosDashboardController extends Controller
{
    public function index()
    {
        $totalFavorit = auth()->user()->favorites()->count();
        $totalReview  = auth()->user()->reviews()->count();

        return view('pencari.dashboard', compact(
            'totalFavorit',
            'totalReview'
        ));
    }
}
