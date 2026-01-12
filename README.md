# Sistem Informasi Blog Mahasiswa

- **Nama** : Fawaz Muhammad Sabiq
- **NIM** : C2383207006
- **Kelas** : PTI5A
- **Matakuliah**: Pemrograman Internet

## Deskripsi Aplikasi

**Sistem Informasi Blog Mahasiswa** adalah sebuah platform Content Management System (CMS) modern yang dirancang untuk memfasilitasi publikasi artikel digital secara efisien. Aplikasi ini dibangun menggunakan framework **Laravel 12** dengan fokus pada keamanan, kemudahan penggunaan, dan manajemen konten yang terstruktur.

Aplikasi ini memisahkan hak akses secara tegas antara pengelola (Admin/Penulis) dan pembaca umum:
1.  **Area Manajemen (Secure Zone):** Area khusus yang dilindungi login untuk Super Admin dan Penulis mengelola konten.
2.  **Area Publik (Public Zone):** Halaman depan yang dapat diakses oleh siapa saja untuk mencari dan membaca artikel yang telah diterbitkan.

## Fitur Utama

### 1. Hak Akses (Multi-Role)
- **Super Admin:** Memiliki kontrol penuh. Bisa mengedit/menghapus artikel milik siapa saja, melihat daftar penulis aktif, dan memantau seluruh konten.
- **Penulis (Writer):** Memiliki dashboard pribadi. Hanya bisa membuat, mengedit, dan menghapus artikel miliknya sendiri.

### 2. Manajemen Artikel (CRUD)
- **Create:** Pembuatan artikel dengan judul, konten, dan upload gambar sampul (mimes:jpeg,png,jpg,gif,webp,svg).
- **Rich Text Editor:** Integrasi **CKEditor 5** yang memungkinkan penulisan dengan format tebal, miring, list, dll.
- **Publishing System:** Fitur *Toggle* untuk menyimpan artikel sebagai **Draft** (pribadi) atau **Publish** (tayang di publik).

### 3. Halaman Publik (Pengunjung Umum)
- **Katalog Artikel:** Menampilkan daftar artikel terbaru yang berstatus *Published*.
- **Detail Artikel:** Tampilan baca yang nyaman, responsif, dan mendukung format teks kaya.
- **Pagination:** Navigasi halaman untuk menelusuri arsip artikel lama.
- **Tanpa Login:** Pengunjung tidak perlu mendaftar untuk sekadar membaca artikel.

## Sistem
- PHP >= 8.2 +
- Composer
- Database (MySQL/MariaDB)


## Cara Instalasi

1. **Clone Repository**
   ```bash
   GitHub https:https://github.com/Fawaz2410/my-blog-app


2. **Install Dependencies**
```bash
composer install
npm install && npm run build

```


3. **Setup Environment**
Salin file `.env.example` menjadi `.env`:
```bash
cp .env.example .env

```


Sesuaikan konfigurasi `DB_DATABASE`, `DB_USERNAME`, dan `DB_PASSWORD` di file `.env` sesuai database lokal Anda.

4. **Generate Key**
```bash
php artisan key:generate

```


5. **Migrasi Database & Seeding**
Penting: Jalankan perintah ini untuk membuat tabel dan akun Super Admin otomatis.
```bash
php artisan migrate:fresh --seed

```


6. **Jalankan Aplikasi**
```bash
php artisan serve

```


Buka `http://localhost:8000` di browser.

## Akun Demo

**1. Super Admin**

* Email: `admin@gmail.com`
* Password: `password`

**2. Penulis Biasa**

* Email: `penulis@gmail.com`
* Password: `password`

## Versi Framework

* Laravel Framework 12

## Kontak

- Fawaz Muhammad Sabiq
- NIM: C2383207006
- Email: [fawazmsabiq@gmail.com](mailto:fawazmsabiq@gmail.com)
- GitHub: [github.com/Fawaz2410](https://github.com/Fawaz2410)

## Lisensi

Project untuk Ujian Akhir Semester - Pemrograman Internet
Fakultas Keguruan dan Ilmu Pendidikan
Universitas Muhammadiyah Tasikmalaya

Copyright 2026 Fawaz Muhammad Sabiq