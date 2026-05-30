<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('kos', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                  ->constrained()
                  ->onDelete('cascade');

            $table->string('nama_kos');

            $table->text('alamat');

            $table->decimal('harga', 12, 2);

            $table->enum('jenis_kos', [
                'putra',
                'putri',
                'campur'
            ]);

            $table->text('deskripsi')->nullable();

            $table->enum('status', [
                'tersedia',
                'penuh'
            ])->default('tersedia');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kos');
    }
};