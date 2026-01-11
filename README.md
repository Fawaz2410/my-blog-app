# Sistem Informasi Blog Mahasiswa

**Nama    : Fawaz Muhammad Sabiq**
**NIM     : C2383207006**
**Kelas   : PTI5A**

Aplikasi web sederhana untuk manajemen artikel (blog) yang dibangun menggunakan Laravel 12. Aplikasi ini memiliki fitur Multi-Role (Super Admin & Penulis) serta editor teks kaya (Rich Text Editor).

## Fitur Utama
- **Autentikasi:** Login & Register.
- **Multi-Role:**
  - **Super Admin:** Bisa mengelola (edit/hapus) semua artikel user lain & melihat info penulis.
  - **Writer:** Hanya bisa mengelola artikel milik sendiri.
- **CRUD Artikel:** Create, Read, Update, Delete dengan validasi.
- **Rich Text Editor:** Menggunakan CKEditor 5 untuk penulisan konten.
- **Image Upload:** Fitur upload gambar sampul artikel.
- **Publish/Draft System:** Artikel bisa disimpan sebagai draft atau langsung diterbitkan.

## Persyaratan Sistem
- PHP >= 8.4
- Composer
- Database (MySQL/MariaDB)

## Cara Instalasi
## Cara Instalasi

1. **Clone Repository**
   ```bash
   git clone https://github.com/Fawaz/infotekno-laravel.git
   cd my-blog-app


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
