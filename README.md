Website rumah sakit lengkap dengan admin panel untuk mengelola data rumah sakit, dokter, layanan, berita, galeri, testimoni, dan homecare.

📋 Fitur Utama
🏠 Halaman Publik
✅ Beranda dengan slider dan informasi cepat

✅ Tentang Kami (sejarah, visi misi, struktur)

✅ Layanan Rumah Sakit (poli-poli)

✅ Data Dokter dengan jadwal praktik

✅ Berita & Artikel kesehatan

✅ Galeri foto kegiatan

✅ Testimoni pasien dengan sistem approval

✅ Halaman kontak dengan Google Maps

✅ Homecare - Paket layanan perawatan di rumah

🛠️ Admin Panel
✅ Dashboard admin dengan statistik

✅ CRUD Data Dokter dengan upload foto

✅ CRUD Layanan Rumah Sakit

✅ CRUD Berita/Artikel dengan WYSIWYG editor

✅ CRUD Galeri dengan multiple image upload

✅ Sistem persetujuan testimoni pasien

✅ Kelola profil rumah sakit

✅ CRUD Paket Homecare

🚀 Teknologi yang Digunakan
Framework: Laravel 10

Database: MySQL

Frontend: Bootstrap 5, Font Awesome

Text Editor: TinyMCE

Storage: Laravel Storage dengan symbolic link

Authentication: Laravel UI dengan role-based (admin/user)

hospital-website/
├── app/
│   ├── Http/Controllers/
│   │   ├── AdminController.php
│   │   ├── ArticleController.php
│   │   ├── DoctorController.php
│   │   ├── GalleryController.php
│   │   ├── HomeController.php
│   │   ├── HomecareController.php   
│   │   ├── ServiceController.php
│   │   └── TestimonialController.php
│   ├── Models/
│   │   ├── Article.php
│   │   ├── Doctor.php
│   │   ├── Gallery.php
│   │   ├── HomecarePackage.php       
│   │   ├── HospitalProfile.php       
│   │   ├── Service.php
│   │   └── Testimonial.php
├── database/
│   ├── migrations/
│   │   ├── 2014_10_12_000000_create_users_table.php
│   │   ├── 2024_01_01_create_doctors_table.php
│   │   ├── 2024_01_02_create_services_table.php
│   │   ├── 2024_01_03_create_articles_table.php
│   │   ├── 2024_01_04_create_galleries_table.php
│   │   ├── 2024_01_05_create_testimonials_table.php
│   │   ├── 2024_01_06_create_homecare_packages_table.php 
│   │   └── 2024_01_07_create_hospital_profiles_table.php 
│   └── seeders/
│       ├── AdminUserSeeder.php
│       ├── ArticleSeeder.php
│       ├── DoctorSeeder.php
│       ├── HomecarePackageSeeder.php 
│       ├── HospitalProfileSeeder.php 
│       ├── ServiceSeeder.php
│       └── TestimonialSeeder.php
├── resources/views/
│   ├── layouts/
│   │   └── app.blade.php
│   ├── admin/
│   │   ├── dashboard.blade.php
│   │   ├── doctors.blade.php
│   │   ├── homecare/              
│   │   │   ├── index.blade.php
│   │   │   ├── create.blade.php
│   │   │   └── edit.blade.php
│   │   ├── profile.blade.php
│   │   ├── testimonials.blade.php
│   │   └── ...
│   ├── homecare/                  
│   │   ├── index.blade.php
│   │   └── show.blade.php
│   ├── home.blade.php
│   ├── about.blade.php
│   ├── services.blade.php
│   ├── doctors.blade.php
│   ├── news.blade.php
│   ├── gallery.blade.php
│   ├── testimonials.blade.php
│   └── contact.blade.php
└── routes/
    └── web.php
