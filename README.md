# JatriCarShop

Website showroom mobil sederhana berbasis **PHP Native 8+** dengan arsitektur bersih (*clean architecture* sederhana), ramah pemula, dan siap dideploy menggunakan Docker.

## Fitur Utama

- **Website Customer**:
  - Halaman Beranda (Hero, Rekomendasi Mobil, Tentang, Kontak)
  - Katalog Mobil dengan visual modern
  - Detail spesifikasi mobil lengkap
  - Formulir pemesanan mobil langsung terintegrasi ke database
- **Dashboard Admin**:
  - Sistem Login Keamanan Sesi
  - Halaman Dashboard ringkasan total mobil dan pesanan masuk
  - Data pesanan terbaru pelanggan secara dinamis
- **Developer Tools**:
  - Sistem Migrasi Mandiri (`migrate.php`) untuk struktur database
  - Sistem Pengisian Data Awal (`seed.php`) untuk menyuntikkan data akun admin & mobil tiruan
  - Dukungan database MySQL dengan koneksi PDO & Prepared Statements
  - Autoloading kustom berbasis standar PSR-4 tanpa Composer

---

## Struktur Folder Project

```text
/public               # Document Root (Aset Publik & Entry Point)
  /assets
    /css/style.css    # Desain modern berbasis SaaS/Stripe style
    /js/main.js       # Logika interaksi frontend
  .htaccess           # Konfigurasi Apache mod_rewrite
  index.php           # Front Controller (Entry point utama aplikasi)

/app                  # Logika Aplikasi Inti
  /Controllers        # Controller penampung request & action
  /Models             # Model interaksi database (untuk tahap pengembangan lanjut)
  /views              # File template visual HTML/PHP
    /layouts          # Header & Footer reusable components
    /admin            # Tampilan halaman admin

/config               # Pengaturan konfigurasi aplikasi
  database.php        # Konfigurasi pemuatan database

/database             # Migrasi & Seeder Database
  /migrations         # SQL pembentuk tabel (admins, cars, orders)
  /seeders            # Seeder data awal
  migrate.php         # CLI Script untuk membuat database & tabel
  seed.php            # CLI Script untuk menyuntikkan data dummy

/.env                 # Variabel Lingkungan / Kredensial Database
```

---

## Langkah Instalasi & Penggunaan

### 1. Prasyarat (Prerequisites)
Pastikan Anda sudah menjalankan server lokal dengan dukungan PHP 8+ dan MySQL (seperti **Laragon**, **XAMPP**, atau Docker).

### 2. Duplikasi Pengaturan Environment
Konfigurasikan database pada berkas `.env` di root folder:
```env
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=jatricarshop
DB_USERNAME=root
DB_PASSWORD=
```

### 3. Migrasi & Seeder Database
Jalankan perintah berikut pada terminal di root folder project untuk membuat database, tabel, dan menyuntikkan data dummy:

```bash
# Membuat Database dan Tabel
php database/migrate.php

# Menyuntikkan Data Awal (1 Admin & 8 Mobil Pilihan)
php database/seed.php
```

*Kredensial Default Login Admin:*
- **Username**: `admin`
- **Password**: `admin123`

### 4. Menjalankan Web Server Lokal
Jika Anda menggunakan bawaan PHP built-in server, jalankan perintah ini dari root folder:
```bash
php -S localhost:8000 -t public
```
Akses web melalui peramban di alamat [http://localhost:8000](http://localhost:8000).

---

## Pengujian / Uji Fungsional (Doc Test)

Aplikasi ini dilengkapi mode tangguh (*robust fallback*). Jika koneksi database belum tersedia atau belum termigrasi, sistem tetap dapat diuji secara offline menggunakan *mockup data* interaktif bawaan Controller.

### Skenario Uji Coba:
1. **Navigasi Utama**: Buka beranda, klik menu *Daftar Mobil*, *Tentang Kami*, atau *Kontak* untuk menguji navigasi.
2. **Detail Mobil**: Klik tombol *Detail* pada salah satu mobil di katalog untuk melihat deskripsi lengkap.
3. **Form Pemesanan**: Klik *Pesan Sekarang*, isi formulir pemesanan, dan kirimkan. Pesan sukses akan muncul setelah terkirim.
4. **Login Admin**: Masuk ke panel admin lewat tombol *Admin Panel* di kanan atas navbar. Masukkan user `admin` dan password `admin123`.
5. **Dashboard**: Periksa ringkasan statistik dan daftar pesanan terbaru yang masuk di panel dashboard.
