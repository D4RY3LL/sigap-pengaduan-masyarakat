<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    // 1. Menampilkan Form Lapor + Riwayat
    public function index()
    {
        // Ambil laporan DIMANA (Where) id pemiliknya == ID saya yang edang login
        $reports = Report::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        // Kirim data '$myReports' ke view agar bisa ditampilkan di tabel
        return view('user.lapor', compact('reports'));
    }

    // 2. Memproses Data & Foto (Jantung Materi Hari Ini)
    public function store(Request $request)
    {
        // A. Validasi (Cek Kelengkapan)
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Maks2MB
        ]);

        // B. Logika Upload Foto (Anti-Error)
        $imagePath = null;
        if ($request->hasFile('image')) {
            // Simpan foto ke folder 'storage/app/public/reports'
            $imagePath = $request->file('image')->store('reports', 'public');
        }

        // C. Simpan ke Database
        Report::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
            'location' => $request->location, // Nama Lokasi (Opsional)
            'latitude' => $request->latitude, // [BARU] Koordinat Lat
            'longitude' => $request->longitude, // [BARU] Koordinat Long
            'image' => $imagePath,
            'status' => '0',
        ]);

        return redirect()->back()->with('success', 'Laporan berhasil dikirim!');
    }

    // 3. Menampilkan Detail Laporan (Langkah 2)
    public function show(Report $report)
    {
        // Mengambil data detail laporan beserta User (pelapor)
        // dan Responses (tanggapan) jika ada.
        // Konsep: Route Model Binding (Otomatis cari ID)
        $report->load(['user', 'responses.user']);

        return view('admin.detail', compact('report'));
    }

    // 4. Update Status Laporan (Langkah 4 - Kita masukkan sekarang biar aman)
    public function update(Request $request, Report $report)
    {
        // Validasi: Status hanya boleh berisi 0, proses, atau selesai
        $data = $request->validate([
            'status' => 'required|in:0,proses,selesai',
        ]);

        // Simpan perubahan ke database
        $report->update($data);

        // Kembali ke halaman sebelumnya dengan pesan sukses
        return back()->with('success', 'Status laporan berhasil diperbarui!');
    }

    // 5 Fungsi Cetak PDF
    public function exportPdf()
    {
        // Ambil semua data laporan
        $reports = Report::all();
        // Load View khusus PDF (nanti kita buat)
        $pdf = Pdf::loadView('admin.print', ['reports' => $reports]);
        // Download file
        return $pdf->download('laporan-pengaduan.pdf');
    }
}
