<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Tambahkan ini
use App\Models\Kos;
use App\Models\Review;
use App\Models\Favorite;

class Review extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'kos_id', 'rating', 'komentar'];

    // Relasi: Review ini ditulis oleh seorang User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relasi: Review ini ditujukan untuk suatu Kos tertentu
    public function kos()
    {
        return $this->belongsTo(Kos::class, 'kos_id');
    }
}