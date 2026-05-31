<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// Tambahkan import model
use App\Models\User;
use App\Models\Photo;
use App\Models\Review;
use App\Models\Favorite;

class Kos extends Model
{
    protected $table = 'kos';

    protected $fillable = [
        'user_id',
        'nama_kos',
        'alamat',
        'harga',
        'jenis_kos',
        'deskripsi',
        'status',
    ];

    // Kos dimiliki oleh satu user (owner)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Satu kos punya banyak foto
    public function photos()
    {
        return $this->hasMany(Photo::class, 'kos_id');
    }

    // Satu kos punya banyak review
    public function reviews()
    {
        return $this->hasMany(Review::class, 'kos_id');
    }

    // Satu kos punya banyak favorit
    public function favorites()
    {
        return $this->hasMany(Favorite::class, 'kos_id');
    }
}