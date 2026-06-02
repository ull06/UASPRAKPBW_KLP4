<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'user_id',
        'kos_id',
        'status',
        'catatan',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function kos()
    {
        return $this->belongsTo(Kos::class);
    }
}
