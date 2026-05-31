<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;
use App\Models\Review;

class PencariKosDashboardController extends Controller
{
    public function index()
    {
        $totalFavorit = 0;
        $totalReview = 0;

        return view('pencari.dashboard', compact(
            'totalFavorit',
            'totalReview'
        ));
    }
}