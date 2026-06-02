<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Kos;
use App\Models\Photo;
use App\Models\Review;
use App\Models\Favorite;

class KosFinderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Buat Data User Pemilik (Owner)
        $owner = User::updateOrCreate([
            'email' => 'owner@kosfinder.com',
        ], [
            'name' => 'Cut Owner Kos',
            'phone' => '081234567890',
            'password' => bcrypt('password123'),
            'role' => 'owner',
        ]);

        // 2. Buat Data User Pencari Kos
        $pencari = User::updateOrCreate([
            'email' => 'pencari@kosfinder.com',
        ], [
            'name' => 'Rahmatul Pencari',
            'phone' => '081298765432',
            'password' => bcrypt('password123'),
            'role' => 'pencari',
        ]);

        // 3. Buat Data Kos yang terhubung ke si Owner (Menggunakan Relasi)
        $kos1 = $owner->kos()->create([
            'nama_kos' => 'Kos Bungong Jeumpa',
            'deskripsi' => 'Kos fasilitas lengkap dekat dengan area kampus, aman, dan bersih.',
            'alamat' => 'Jl. Syiah Kuala, Banda Aceh',
            'harga' => 600000,
            'jenis_kos' => 'putri',
        ]);

        $kos2 = $owner->kos()->create([
            'nama_kos' => 'Kos Meunasah Putra',
            'deskripsi' => 'Kos khusus putra, parkir luas, free Wi-Fi.',
            'alamat' => 'Kopelma Darussalam, Banda Aceh',
            'harga' => 500000,
            'jenis_kos' => 'putra',
        ]);

        // 4. Buat Data Foto untuk masing-masing Kos (Menggunakan Relasi)
        $kos1->photos()->create(['image_path' => 'kos1_depan.jpg']);
        $kos1->photos()->create(['image_path' => 'kos1_kamar.jpg']);

        $kos2->photos()->create(['image_path' => 'kos2_depan.jpg']);

        // 5. Buat Data Review dari si Pencari ke Kos 1
        Review::create([
            'user_id' => $pencari->id,
            'kos_id' => $kos1->id,
            'rating' => 5,
            'komentar' => 'Tempatnya bersih banget dan dekat kalau mau ke kampus!',
        ]);

        // 6. Buat Data Favorite (Pencari menandai Kos 1 sebagai favorit)
        Favorite::create([
            'user_id' => $pencari->id,
            'kos_id' => $kos1->id,
        ]);
    }
}