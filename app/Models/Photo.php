<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Kos;


class Photo extends Model
{
    protected $fillable = [
        'kos_id',
        'image_path',
    ];

    // Photo dimiliki oleh satu kos
    public function kos()
    {
        return $this->belongsTo(Kos::class, 'kos_id');
    }
}