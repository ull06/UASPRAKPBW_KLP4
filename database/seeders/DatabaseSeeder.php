<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // MASUKKAN INI BIAR KOSFINDER SEEDER KAMU JALAN!!!
        $this->call([
            KosFinderSeeder::class,
        ]);
    }
}