# JatriCarShop - Docker Deployment Guide

Website showroom mobil sederhana berbasis **PHP Native 8+** dengan Apache, MySQL 8, dan Bootstrap 5. Repositori ini telah dikonfigurasi untuk siap dideploy menggunakan Docker pada environment production (misalnya di Ubuntu 24.04 menggunakan Nginx Proxy Manager).

---

## 1. Prasyarat (Prerequisites)
- Docker dan Docker Compose telah terinstal di server/lokal.
- Jaringan docker external bernama `proxy` sudah dibuat (untuk integrasi dengan Nginx Proxy Manager):
  ```bash
  docker network create proxy
  ```

---

## 2. Langkah Instalasi & Penggunaan dengan Docker

### A. Duplikasi Pengaturan Environment
Buat file `.env` di root folder dengan menduplikasi `.env.example`:
```bash
cp .env.example .env
```
Sesuaikan konfigurasi di dalam file `.env` jika diperlukan.

### B. Menjalankan Container (Build & Run)
Jalankan perintah berikut untuk mem-build dan menjalankan service aplikasi dan database di background:
```bash
docker compose up -d --build
```

### C. Menghentikan Container
Untuk menghentikan dan menghapus container yang sedang berjalan (data database tetap aman di volume `mysql_data`):
```bash
docker compose down
```

### D. Melihat Logs
Untuk memantau log dari container secara real-time:
```bash
docker compose logs -f
```

### E. Masuk ke dalam Container Aplikasi
Jika ingin masuk ke terminal container aplikasi PHP:
```bash
docker exec -it jatricarshop-app bash
```

---

## 3. Database Migrasi & Seed di dalam Docker

Jalankan perintah ini dari host untuk melakukan migrasi dan pengisian data awal secara langsung pada container aplikasi:

### Migrasi Database (Membuat Tabel)
```bash
docker exec -it jatricarshop-app php database/migrate.php
```

### Seed Database (Mengisi Data Awal Admin & Mobil)
```bash
docker exec -it jatricarshop-app php database/seed.php
```

*Kredensial Default Login Admin:*
- **Username**: `admin`
- **Password**: `admin123`

---

## 4. Integrasi dengan Nginx Proxy Manager (NPM)

Untuk mempublikasikan aplikasi menggunakan Nginx Proxy Manager:
1. Hubungkan domain/subdomain Anda ke alamat IP Server.
2. Pada Nginx Proxy Manager, tambahkan **Proxy Host** baru:
   - **Domain Names**: `domainanda.com` (atau subdomain)
   - **Scheme**: `http`
   - **Forward HostName / IP**: `jatricarshop-app`
   - **Forward Port**: `80`
   - Aktifkan opsi **Block Common Exploits** dan konfigurasikan SSL jika diperlukan.
