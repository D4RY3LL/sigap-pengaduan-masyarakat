<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Response; // Panggil Model Response
use Illuminate\Support\Facades\Auth;

class ResponseController extends Controller
{
    public function store(Request $request)
    {
        // 1. Validasi (termasuk validasi gambar)
        $request->validate([
            'report_id' => 'required',
            'response_text' => 'required',
            'image' => 'nullable|image|max:2048', // Validasi: Harus Gambar,Maks 2MB
        ]);

        // 2. Cek apakah ada file gambar yang diupload
        $imagePath = null;
        if ($request->hasFile('image')) {
            // UPLOAD: Simpan file fisik ke folder 'public/responses'
            // Fungsi store() otomatis membuat nama file unik agar tidak bentrok
            $imagePath = $request->file('image')->store('responses','public');
        }

        // 3. Simpan ke tabel responses
        Response::create([
            'report_id' => $request->report_id,
            'user_id' => Auth::id(),
            'response_text' => $request->response_text,
            'image' => $imagePath, // Simpan hanya alamatnya di DB
        ]);

        return back()->with('success', 'Tanggapan & Bukti terkirim!');
    }
}
