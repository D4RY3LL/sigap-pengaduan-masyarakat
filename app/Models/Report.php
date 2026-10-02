<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    // IBARATNYA: "Ini daftar kolom yang BOLEH diisi manual oleh user"
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'location',
        'latitude',
        'longitude',
        'image',
        'status'
    ];

    // Relasi Kebalikan: Laporan ini milik siapa?
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // --- TAMBAHKAN BAGIAN INI ---
    // Relasi ke Response (Tanggapan)
    // Satu laporan bisa memiliki banyak tanggapan
    public function responses()
    {
        return $this->hasMany(Response::class);
    }
}
