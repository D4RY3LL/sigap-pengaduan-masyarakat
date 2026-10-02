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
        Schema::create('reports', function (Blueprint $table) {

            $table->id();

            // Relasi: laporan ini milik User siapa?
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();

            $table->string('title');            // Judul Laporan
            $table->text('description');        // Isi Laporan (teks agar muat banyak)
            $table->string('location');         // Lokasi kejadian
            $table->string('image')->nullable();// foto bukti (boleh kosong/nullable)

            // status
            $table->enum('status', ['0', 'proses', 'selesai'])->default('0');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
