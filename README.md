<<<<<<< HEAD
Website Rumah Sakit dengan Laravel 10
📋 Deskripsi Proyek
Website Rumah Sakit berbasis Laravel 10 dengan sistem manajemen konten lengkap untuk informasi rumah sakit, manajemen dokter, layanan, artikel kesehatan, galeri, dan sistem testimoni pasien.

🚀 Fitur Utama
🏥 Halaman Publik
✅ Beranda dengan informasi utama

✅ Tentang Kami (sejarah, visi, misi, struktur)

✅ Layanan Rumah Sakit

✅ Data Dokter dengan jadwal praktik

✅ Berita & Artikel Kesehatan

✅ Galeri Foto

✅ Sistem Testimoni Pasien

✅ Halaman Kontak

✅ NEW Layanan Homecare dengan paket-paket

🛠️ Admin Dashboard
✅ Manajemen Profil Rumah Sakit

✅ CRUD Data Dokter (dengan upload foto)

✅ CRUD Layanan

✅ CRUD Artikel/Berita

✅ CRUD Galeri Foto

✅ Manajemen Testimoni (approval system)

✅ NEW Manajemen Paket Homecare

📁 Struktur Proyek
text
hospital-website/
├── app/
│   ├── Http/Controllers/
│   │   ├── AdminController.php
│   │   ├── ArticleController.php
│   │   ├── DoctorController.php
│   │   ├── GalleryController.php
│   │   ├── HomecareController.php      # NEW
│   │   ├── HomeController.php
│   │   ├── HospitalProfileController.php
│   │   ├── ServiceController.php
│   │   └── TestimonialController.php
│   ├── Models/
│   │   ├── Article.php
│   │   ├── Doctor.php
│   │   ├── DoctorSchedule.php
│   │   ├── Gallery.php
│   │   ├── HomecarePackage.php         # NEW
│   │   ├── HospitalProfile.php
│   │   ├── Service.php
│   │   └── Testimonial.php
│   └── ...
├── database/
│   ├── migrations/
│   │   ├── 2014_10_12_000000_create_users_table.php
│   │   ├── 2025_11_20_xxxxxx_create_hospital_profiles_table.php
│   │   ├── 2025_11_20_xxxxxx_create_doctors_table.php
│   │   ├── 2025_11_20_xxxxxx_create_doctor_schedules_table.php
│   │   ├── 2025_11_20_xxxxxx_create_services_table.php
│   │   ├── 2025_11_20_xxxxxx_create_testimonials_table.php
│   │   ├── 2025_11_20_xxxxxx_create_articles_table.php
│   │   ├── 2025_11_20_xxxxxx_create_galleries_table.php
│   │   └── 2025_11_20_xxxxxx_create_homecare_packages_table.php  # NEW
│   └── seeders/
│       ├── AdminUserSeeder.php
│       ├── DoctorSeeder.php
│       ├── ServiceSeeder.php
│       ├── TestimonialSeeder.php
│       ├── ArticleSeeder.php
│       ├── HospitalProfileSeeder.php
│       └── HomecarePackageSeeder.php    # NEW
├── resources/views/
│   ├── layouts/
│   │   └── app.blade.php
│   ├── admin/
│   │   ├── layouts/
│   │   │   └── app.blade.php
│   │   ├── dashboard.blade.php
│   │   ├── doctors/
│   │   │   ├── index.blade.php
│   │   │   ├── create.blade.php
│   │   │   └── edit.blade.php
│   │   ├── homecare/                    # NEW
│   │   │   ├── index.blade.php
│   │   │   ├── create.blade.php
│   │   │   └── edit.blade.php
│   │   ├── services/
│   │   ├── news/
│   │   ├── gallery/
│   │   ├── testimonials/
│   │   └── profile/
│   └── homecare/                        # NEW
│       ├── index.blade.php
│       └── show.blade.php
├── public/
├── routes/
│   └── web.php
└── ...
🛠️ Teknologi yang Digunakan
Framework: Laravel 10

Database: MySQL

Frontend: Bootstrap 5, Font Awesome

Text Editor: TinyMCE (untuk artikel)

Storage: Local filesystem dengan symbolic link

Authentication: Laravel UI (Bootstrap)

⚙️ Instalasi dan Setup
Prerequisites
PHP >= 8.1

Composer

MySQL

Node.js & NPM

Langkah Instalasi
Clone Repository

bash
git clone [repository-url]
cd hospital-website
Install Dependencies

bash
composer install
npm install
npm run dev
Setup Environment

bash
cp .env.example .env
php artisan key:generate
Konfigurasi Database
Edit file .env:

env
=======
# 📘 Dokumentasi Proyek

# **Website Rumah Sakit Khusus Bedah Ropanasuri**

---

# 1. **Overview Proyek**

Website Rumah Sakit Khusus Bedah Ropanasuri adalah sistem informasi berbasis **Laravel 10** yang dirancang untuk menyajikan informasi lengkap mengenai rumah sakit, termasuk manajemen dokter, layanan, artikel kesehatan, galeri, testimoni pasien, dan layanan homecare. Sistem ini juga dilengkapi **Admin Dashboard** untuk mengelola seluruh konten secara dinamis.

## 🎯 **Tujuan Proyek**

* Mempermudah masyarakat mendapatkan informasi rumah sakit secara online.
* Mempercepat proses pembaruan informasi melalui dashboard admin.
* Memberikan layanan tambahan berupa homecare dengan paket layanan.

## 🏗️ **Teknologi yang Digunakan**

* **Laravel 10** (Backend)
* **Blade Template / TailwindCSS / Bootstrap** (Frontend)
* **MySQL** (Database)
* **Laravel Storage** (Upload gambar)
* **Spatie Permission** (opsional untuk manajemen role admin)

---

# 2. **Fitur Utama**

## 🏥 **Halaman Publik**

* Beranda
* Tentang Kami
* Layanan Rumah Sakit
* Data Dokter + Jadwal Praktik
* Artikel / Berita
* Galeri Foto
* Testimoni Pasien
* Kontak
* Layanan Homecare

## 🛠️ **Admin Dashboard**

* Manajemen Profil Rumah Sakit
* CRUD Dokter
* CRUD Layanan
* CRUD Artikel / Berita
* CRUD Galeri Foto
* Approval Testimoni
* CRUD Paket Homecare

---

# 3. **Arsitektur Sistem**

## 📂 Struktur Direktori Utama

```
hospital-website/
├── app/
│   ├── Http/Controllers/
│   │   ├── AdminController.php
│   │   ├── ArticleController.php
│   │   ├── DoctorController.php
│   │   ├── GalleryController.php
│   │   ├── HomecareController.php      
│   │   ├── HomeController.php
│   │   ├── HospitalProfileController.php
│   │   ├── ServiceController.php
│   │   └── TestimonialController.php
│   ├── Models/
│   │   ├── Article.php
│   │   ├── Doctor.php
│   │   ├── DoctorSchedule.php
│   │   ├── Gallery.php
│   │   ├── HomecarePackage.php        
│   │   ├── HospitalProfile.php
│   │   ├── Service.php
│   │   └── Testimonial.php
│   └── ...
├── database/
│   ├── migrations/
│   │   ├── 2014_10_12_000000_create_users_table.php
│   │   ├── 2025_11_20_xxxxxx_create_hospital_profiles_table.php
│   │   ├── 2025_11_20_xxxxxx_create_doctors_table.php
│   │   ├── 2025_11_20_xxxxxx_create_doctor_schedules_table.php
│   │   ├── 2025_11_20_xxxxxx_create_services_table.php
│   │   ├── 2025_11_20_xxxxxx_create_testimonials_table.php
│   │   ├── 2025_11_20_xxxxxx_create_articles_table.php
│   │   ├── 2025_11_20_xxxxxx_create_galleries_table.php
│   │   └── 2025_11_20_xxxxxx_create_homecare_packages_table.php 
│   └── seeders/
│       ├── AdminUserSeeder.php
│       ├── DoctorSeeder.php
│       ├── ServiceSeeder.php
│       ├── TestimonialSeeder.php
│       ├── ArticleSeeder.php
│       ├── HospitalProfileSeeder.php
│       └── HomecarePackageSeeder.php    
├── resources/views/
│   ├── layouts/
│   │   └── app.blade.php
│   ├── admin/
│   │   ├── layouts/
│   │   │   └── app.blade.php
│   │   ├── dashboard.blade.php
│   │   ├── doctors/
│   │   │   ├── index.blade.php
│   │   │   ├── create.blade.php
│   │   │   └── edit.blade.php
│   │   ├── homecare/                 
│   │   │   ├── index.blade.php
│   │   │   ├── create.blade.php
│   │   │   └── edit.blade.php
│   │   ├── services/
│   │   ├── news/
│   │   ├── gallery/
│   │   ├── testimonials/
│   │   └── profile/
│   └── homecare/                      
│       ├── index.blade.php
│       └── show.blade.php
├── public/
├── routes/
│   └── web.php
└── ...
```

## 🧩 Diagram Alur Sederhana

* User → Website Publik → Database
* Admin → Dashboard → Kelola Konten → Database → Website Publik

---

# 4. **Setup & Instalasi Proyek**

## 1️⃣ Clone Repository

```
git clone https://github.com/username/ropanasuri-hospital.git
cd ropanasuri-hospital
```

## 2️⃣ Install Dependensi Composer

```
composer install
```

## 3️⃣ Copy Environment

```
cp .env.example .env
php artisan key:generate
```

Atur database & storage:

```
>>>>>>> 6e15cd0a0441c7d9ed8d252be843e24fd66be85a
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=hospital_db
DB_USERNAME=root
DB_PASSWORD=
<<<<<<< HEAD
Jalankan Migrasi dan Seeder

bash
php artisan migrate --seed
php artisan storage:link
Jalankan Development Server

bash
php artisan serve
👨‍💼 Akun Default
Admin
Email: admin@rumahsakit.com

Password: password123

User Biasa
Email: user@example.com

Password: password123

🔧 Fitur CRUD Detail
1. Manajemen Dokter
Tambah dokter dengan upload foto

Edit data dokter

Hapus dokter

Toggle status aktif/non-aktif

Kelola jadwal praktik

2. Sistem Testimoni
Form testimoni publik

Approval system oleh admin

Pagination (10 testimoni per halaman)

Rating stars interaktif

3. Layanan Homecare ✨
Multiple package system

Detail paket dengan informasi lengkap

WhatsApp integration untuk pemesanan

Admin management untuk paket

4. Artikel/Berita
WYSIWYG editor (TinyMCE)

Kategori artikel

Status draft/published

Upload gambar artikel

5. Galeri Foto
Multiple image upload

Kategori foto (fasilitas, kegiatan, acara)

Responsive gallery layout

📱 Fitur Responsif
Mobile-friendly design

Bootstrap 5 responsive grid

Touch-friendly interface

Adaptive images

🔒 Security Features
Authentication system

Admin middleware protection

CSRF protection

Form validation

Rate limiting

Secure file upload

🚨 Troubleshooting
Common Issues
Error 429 Too Many Requests

bash
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
Storage Link Error

bash
php artisan storage:link
chmod -R 775 storage/
chmod -R 775 bootstrap/cache/
Migration Error

bash
php artisan migrate:fresh --seed
📊 Database Schema
Tabel Utama
users - Tabel user untuk authentication

hospital_profiles - Profil rumah sakit

doctors - Data dokter

doctor_schedules - Jadwal praktik dokter

services - Layanan rumah sakit

testimonials - Testimoni pasien

articles - Artikel berita

galleries - Galeri foto

homecare_packages - Paket homecare

📞 Kontak & Support
Untuk masalah atau pertanyaan:

Check documentation terlebih dahulu

Cek logs di storage/logs/laravel.log

Gunakan debugging routes yang tersedia

📄 License
Proyek ini dikembangkan untuk keperluan pendidikan dan komersial. Silakan sesuaikan dengan kebutuhan Anda.

🔄 Update Log
v1.0.0 - Initial Release
Basic website rumah sakit

Admin dashboard

CRUD semua fitur utama

v1.1.0 - Homecare Feature
✅ Sistem paket homecare

✅ WhatsApp integration

✅ Enhanced UI/UX

✅ Responsive design

Dikembangkan dengan ❤️ menggunakan Laravel 10

Documentation terakhir diperbarui: November 2024
=======
```

## 4️⃣ Generate Key

```
php artisan key:generate
```

## 5️⃣ Migrasi Database

```
php artisan migrate --seed
php artisan storage:link
```

## 6️⃣ Jalankan Server

```
php artisan serve
```

---

# 5. **Dokumentasi Fitur (User Guide)**

## 🌐 Halaman Publik

### 1. Beranda

Menampilkan hero banner, informasi utama rumah sakit, layanan populer, dan artikel terbaru.

### 2. Tentang Kami

Meliputi:

* Sejarah rumah sakit
* Visi dan misi
* Struktur organisasi (opsional)

### 3. Layanan

List layanan:

* Bedah Umum
* Bedah Tulang
* Radiologi
* Homecare

### 4. Data Dokter

* Nama dokter
* Spesialis
* Jadwal praktik
* Foto profil

### 5. Artikel / Berita

Artikel kesehatan, edukasi medis, update terbaru.

### 6. Galeri

Foto kegiatan, fasilitas, ruangan rumah sakit.

### 7. Testimoni Pasien

Testimoni yang sudah disetujui oleh admin.

### 8. Layanan Homecare

Berisi paket homecare seperti:

* Paket Perawatan Luka
* Paket Perawatan Lansia
* Paket Infus

---

# 6. **Admin Dashboard Guide**

## 🔐 Login Admin

Masukkan email & password admin (dibuat melalui seeder).

## 1️⃣ Manajemen Profil Rumah Sakit

* Ubah nama rumah sakit, alamat, kontak, jam operasional.

## 2️⃣ CRUD Dokter

* Tambah dokter baru
* Upload foto dokter
* Atur jadwal praktik
* Edit / hapus dokter

## 3️⃣ CRUD Layanan

* Tambah layanan lengkap dengan deskripsi dan gambar

## 4️⃣ CRUD Artikel

* Menulis artikel kesehatan
* Upload thumbnail
* Kategori opsional

## 5️⃣ CRUD Galeri Foto

Upload foto kegiatan atau fasilitas.

## 6️⃣ Manajemen Testimoni

* Setujui / tolak testimoni
* Hapus jika perlu

## 7️⃣ Manajemen Homecare

* Tambah paket homecare
* Nama paket
* Deskripsi
* Fasilitas yang didapat
* Harga paket

---

# 7. **Skema Database**

## 🧱 Tabel Utama

* doctors
* services
* articles
* galleries
* testimonials
* homecare_packages
* hospital_profiles
* users (admin)
* migrations

## 📊 ERD Sederhana

```
users ───< articles
users ───< services
users ───< homecare_packages
services ───< galleries
```

---

# 8. **API / Route Dokumentasi**

## 🛣️ Routes Publik

```
GET /
GET /tentang
GET /layanan
GET /dokter
GET /artikel
GET /galeri
GET /testimoni
GET /homecare
```

## 🛡️ Routes Admin

```
/admin
/admin/dokter
/admin/layanan
/admin/artikel
/admin/galeri
/admin/testimoni
/admin/homecare
```

---

# 9. **Deployment Guide**

## 🚀 Langkah Deploy ke Hosting / VPS

1. Upload semua file
2. Jalankan `composer install --no-dev`
3. Atur `.env` server produksi
4. Jalankan migrasi database
5. Atur permission folder storage & bootstrap
6. Konfigurasi domain & SSL

---

# 10. **Testing & QA**

Checklist:

* [ ] Layanan tampil dengan benar
* [ ] Jadwal dokter tampil lengkap
* [ ] Artikel bisa dibaca
* [ ] Galeri muncul
* [ ] Testimoni dapat ditambah dan di-approve
* [ ] Homecare paket tampil

---

# 11. **Changelog**

## v1.0

* Rilis awal
* Website publik lengkap
* Dashboard admin

## v1.1

* Penambahan fitur Homecare
* Manajemen Paket Homecare di Dashboard

---

# 12. **Catatan Maintenance**

* Backup database setiap minggu
* Update Laravel setiap 6 bulan
* Kompres gambar untuk optimasi
>>>>>>> 6e15cd0a0441c7d9ed8d252be843e24fd66be85a
