# SIGAP — Sistem Informasi Pengaduan Masyarakat

SIGAP adalah aplikasi web berbasis Laravel yang dikembangkan untuk membantu proses penyampaian dan pengelolaan pengaduan masyarakat secara terstruktur.

Aplikasi memiliki dua jenis pengguna, yaitu **Masyarakat** dan **Admin**. Masyarakat dapat membuat laporan pengaduan lengkap dengan deskripsi, foto, dan lokasi kejadian, sedangkan admin dapat mengelola laporan, memberikan tanggapan, memperbarui status, serta menghasilkan laporan dalam format PDF.

## Features

- Authentication dan registrasi pengguna
- Role-based access untuk Admin dan Masyarakat
- Form pengaduan masyarakat
- Upload gambar laporan
- Integrasi lokasi menggunakan Leaflet
- Reverse geocoding lokasi
- Riwayat laporan pengguna
- Status laporan: Menunggu, Diproses, dan Selesai
- Dashboard administrator
- Pengelolaan laporan masuk
- Tanggapan admin terhadap laporan
- Status dan timeline response
- Export laporan ke PDF
- Progressive Web App (PWA)

## Tech Stack

- Laravel
- PHP
- MySQL
- Blade
- HTML
- CSS
- JavaScript
- Leaflet

## Screenshots

### Landing Page

![SIGAP Landing Page](docs/screenshots/sigap-home.png)

### Authentication

![SIGAP Login](docs/screenshots/sigap-login.png)

### Form Pengaduan & Location

![SIGAP Report Form](docs/screenshots/sigap-report.png)

### Admin Dashboard

![SIGAP Admin Dashboard](docs/screenshots/sigap-admin.png)

### Database Structure

![SIGAP Database](docs/screenshots/sigap-database.png)

## Database

Database utama aplikasi menggunakan beberapa tabel yang saling berelasi:

- `users` — menyimpan data pengguna dan role
- `reports` — menyimpan laporan pengaduan
- `responses` — menyimpan tanggapan terhadap laporan

Relasi utama:

- User dapat membuat banyak laporan
- Setiap laporan dimiliki oleh satu user
- Setiap laporan dapat memiliki tanggapan
- Response terhubung dengan report dan user yang memberikan tanggapan

## Installation

Clone repository:

```bash
git clone https://github.com/D4RY3LL/sigap-pengaduan-masyarakat.git
cd sigap-pengaduan-masyarakat