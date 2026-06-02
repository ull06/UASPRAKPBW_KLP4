# KosFinder
### Sistem Pencarian Kos Berbasis Web

Aplikasi web untuk memudahkan pencarian dan pengelolaan kos, dibangun menggunakan Laravel 12.

---

## Anggota Kelompok 4

| Nama | NPM |
|------|-----|
| Rahmatul Uliya | 2408107010012 |
| Nayla Nabila Syahel | 2408107010005 |
| Raisa Salsa Nabila | 2408107010007 |
| Thary Nabila Jannatul Rizki | 2408107010009 |
| Fawwaz Ziyadi Ilmi | 2408107010021 |

---

## Fitur

### Authentication
- Register dengan pilihan role Owner / Pencari Kos
- Login & Logout
- Middleware berdasarkan role

### Fitur Owner
- Tambah, Edit, Hapus Kos
- Upload Foto Kos
- Ubah Status Kos
- Lihat Review Kos

### Fitur Pencari Kos
- Lihat & Cari Daftar Kos
- Filter Harga & Jenis Kos
- Lihat Detail Kos
- Tambah Favorit & Review

### Dashboard
- Dashboard Owner (Total Kos, Total Review, Total Favorit, Total Kos Tersedia)
- Dashboard Pencari Kos (Favorit Saya, Review Saya)

### Pemesanan & Profil
- Pemesanan Kos
- Profil Akun

---

## Teknologi

- Framework: Laravel 12
- Database: MySQL
- Frontend: Bootstrap 5
- Tools: Git, GitHub, Laragon

---

## Cara Instalasi

```bash
git clone https://github.com/ull06/UASPRAKPBW_KLP4.git
cd UASPRAKPBW_KLP4
composer install
npm install
cp .env.example .env
php artisan key:generate
php artisan migrate
npm run dev
php artisan serve
```

---

## Struktur Branch

- main - branch utama
- featur/auth
- feature/dashboard-owner 
- feature/dashboard-pencari-kos 
- feature/owner
- feature/pencari-kos