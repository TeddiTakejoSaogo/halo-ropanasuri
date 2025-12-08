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

