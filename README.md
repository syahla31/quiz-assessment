# Monolithic Quiz & Assessment Management System

Aplikasi web monolitik berbasis **Laravel 11**, **Livewire 3**, dan **Tailwind CSS** untuk platform manajemen kuis dan asesmen psikologis (DASS-21 Stress Test, MBTI Personality Test, dll.). Dibangun dengan arsitektur bersih (*Clean Architecture / Service Layer Pattern*) untuk memisahkan logika bisnis dari UI.

---

## 📌 Daftar Fitur

### 1. Public Frontend (Akses Pengguna Publik)
* **Katalog Asesmen**: Menampilkan daftar instrumen asesmen dan kuis yang tersedia tanpa perlu login.
* **Pengerjaan Kuis Interaktif**: Antarmuka responsif berbasis Livewire untuk menjawab butir instrumen secara *real-time*.
* **Kalkulasi Skor & Interpretasi Hasil**: Menghitung skor akumulasi dan menghasilkan interpretasi kondisi mental/kepribadian beserta saran tindak lanjut.
* **Export PDF Laporan Hasil**: Unduh lembar hasil asesmen beserta ringkasan skor dan rekap jawaban dalam format file PDF (`barryvdh/laravel-dompdf`).

### 2. Admin CMS (Panel Pengelola)
* **Autentikasi Aman**: Login & Session Management khusus Administrator menggunakan Laravel Fortify.
* **Quiz Management (CRUD)**: Tambah, edit, dan hapus kuis/asesmen (judul, deskripsi, durasi, jenis asesmen).
* **Question & Option Management**: Kelola butir pertanyaan dinamis beserta opsi pilihan jawaban dan bobot skornya masing-masing.

### 3. Arsitektur & Best Practices
* **Service Layer Pattern**: Logika pemrosesan jawaban, transaksi database, dan interpretasi skor diisolasi ke dalam `App\Services\QuizService`.
* **Automated Testing**: Dilengkapi Feature & Unit Test (PHPUnit) untuk menguji rute publik, otorisasi CMS, dan akurasi scoring service.

---

## 🛠️ Tech Stack & Dependencies

* **Framework**: Laravel 11.x
* **Language**: PHP 8.2+
* **Interactivity**: Livewire 3.x
* **CSS Framework**: Tailwind CSS (Vite)
* **Database**: MySQL / MariaDB
* **Auth**: Laravel Fortify
* **PDF Engine**: Barryvdh DomPDF

---

## ⚙️ Panduan Instalasi Lokal

Ikuti langkah-langkah berikut untuk menjalankan proyek di environment lokal Anda:

### 1. Clone Repository
```bash
git clone <URL_REPOSITORY_GITLAB>
cd quiz-assessment
```
### 2. Install Dependensi (Composer & NPM)
```
composer install
npm install
```

### 3. Konfigurasi Environment File
Salin file .env.example ke .env dan generate application key:
```
cp .env.example .env
php artisan key:generate
```
Sesuaikan konfigurasi database pada file .env:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=quiz_assessment
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Migrasi & Seeding Database
Jalankan migrasi tabel beserta seed data awal (Akun Admin Demo, Kuis DASS-21, dan MBTI):
```
php artisan migrate:fresh --seed
```

### 5. Menjalankan Server Development
Jalankan server Vite dan Laravel:
```
# Terminal 1 (Asset Compilation)
npm run dev

# Terminal 2 (Laravel Server)
php artisan serve
```
Akses aplikasi melalui browser di http://127.0.0.1:8000.


### 🔑 Kredensial Akun Demo Admin
Gunakan akun berikut untuk mengakses panel CMS Admin:
URL Login: http://127.0.0.1:8000/login
Email: admin@ibunda.id
Password: password123

### 🧪 Menjalankan Automated Testing
Untuk memverifikasi fungsionalitas dan kebenaran kalkulasi skor:
```
php artisan test
```

### 🌐 Live URL & Repository
Live Demo URL: 

GitLab Repository: 
