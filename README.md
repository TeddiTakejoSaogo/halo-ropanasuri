# 🏥 Website Rumah Sakit Khusus Bedah Ropanasuri

Website Sistem Informasi Rumah Sakit berbasis **Laravel 10** dengan sistem manajemen konten lengkap untuk informasi rumah sakit, manajemen dokter, layanan, artikel kesehatan, galeri, sistem testimoni pasien, dan layanan homecare. Sistem ini juga dilengkapi **Admin Dashboard** untuk mengelola seluruh konten secara dinamis.

---

## ✨ Fitur Utama

### 🏥 Halaman Publik
- ✅ **Beranda** - Informasi utama rumah sakit dan layanan populer.
- ✅ **Tentang Kami** - Sejarah, visi, misi, dan struktur organisasi.
- ✅ **Layanan Rumah Sakit** - Informasi layanan seperti Bedah Umum, Bedah Tulang, Radiologi, dll.
- ✅ **Data Dokter** - Profil dokter beserta spesialisasi dan jadwal praktik.
- ✅ **Artikel & Berita Kesehatan** - Blog dan berita terkini.
- ✅ **Galeri Foto** - Dokumentasi fasilitas dan kegiatan.
- ✅ **Testimoni Pasien** - Ulasan dari pasien.
- ✅ **Kontak** - Informasi kontak dan lokasi.
- ✅ **Layanan Homecare** ✨ *(NEW)* - Detail paket homecare (Perawatan Luka, Lansia, Infus) dengan integrasi pemesanan via WhatsApp.

### 🛠️ Admin Dashboard
- 🔒 **Manajemen Profil Rumah Sakit**
- 🧑‍⚕️ **CRUD Data Dokter** (beserta upload foto dan jadwal praktik)
- 💉 **CRUD Layanan**
- 📰 **CRUD Artikel/Berita** (dengan WYSIWYG Editor - TinyMCE)
- 🖼️ **CRUD Galeri Foto**
- ⭐ **Manajemen Testimoni** (Sistem persetujuan/approval)
- 🏠 **Manajemen Paket Homecare** ✨ *(NEW)*

---

## 🛠️ Teknologi yang Digunakan

- **Framework:** Laravel 10
- **Database:** MySQL
- **Frontend:** Bootstrap 5, TailwindCSS, Blade Template, Font Awesome
- **Text Editor:** TinyMCE (untuk penulisan artikel)
- **Storage:** Local filesystem dengan symbolic link
- **Authentication:** Laravel UI (Bootstrap) / Spatie Permission

---

## ⚙️ Kebutuhan Sistem (Prerequisites)

Pastikan sistem Anda memenuhi persyaratan berikut sebelum melakukan instalasi:
- PHP >= 8.1
- Composer
- MySQL / MariaDB
- Node.js & NPM

---

## 🚀 Instalasi dan Setup

Ikuti langkah-langkah di bawah ini untuk menjalankan proyek di komputer lokal Anda:

### 1️⃣ Clone Repository
```bash
git clone https://github.com/username/ropanasuri-hospital.git
cd ropanasuri-hospital
```

### 2️⃣ Install Dependencies
```bash
composer install
npm install
npm run dev
```

### 3️⃣ Setup Environment Variables
Copy file `.env.example` menjadi `.env` dan atur konfigurasi database.
```bash
cp .env.example .env
php artisan key:generate
```
Edit file `.env` dan sesuaikan kredensial database Anda:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=hospital_db
DB_USERNAME=root
DB_PASSWORD=
```

### 4️⃣ Migrasi & Seeding Database
Jalankan migrasi untuk membuat tabel dan seeder untuk memasukkan data awal (termasuk akun admin).
```bash
php artisan migrate --seed
php artisan storage:link
```

### 5️⃣ Jalankan Server Development
```bash
php artisan serve
```
Akses website di browser: `http://localhost:8000`

---

## 🌐 Panduan Deployment

### Opsi 1: Shared Hosting (cPanel)

Jika Anda ingin mendeploy website ini ke cPanel / Shared Hosting, ikuti langkah berikut:

1. **Build Assets:**
   Sebelum memindahkan file, pastikan aset frontend sudah di-build.
   ```bash
   npm run build
   ```

2. **Zip File Proyek:**
   Compress (Zip) seluruh folder proyek Laravel Anda (kecuali folder `node_modules` untuk menghemat ukuran file).

3. **Upload ke cPanel:**
   - Login ke akun cPanel Anda.
   - Buka **File Manager**.
   - Upload file zip tersebut ke direktori di luar `public_html` (misal: di home directory).
   - Ekstrak file zip tersebut dan ganti nama foldernya jika perlu (misal: `ropanasuri-app`).

4. **Konfigurasi Folder Public:**
   - Pindahkan seluruh isi dari folder `public/` (dari dalam folder proyek) ke dalam folder `public_html/` (atau folder addon domain Anda).
   - Edit file `index.php` yang sekarang berada di `public_html/`. Sesuaikan path untuk memanggil file autoload dan aplikasi.
     ```php
     // Ubah baris berikut (sesuaikan 'ropanasuri-app' dengan nama folder Anda):
     require __DIR__.'/../ropanasuri-app/vendor/autoload.php';
     $app = require_once __DIR__.'/../ropanasuri-app/bootstrap/app.php';
     ```

5. **Setup Database:**
   - Buat database MySQL baru, user, dan berikan semua hak akses kepada user tersebut melalui menu **MySQL® Databases** di cPanel.
   - Export database lokal Anda (melalui phpMyAdmin lokal) menjadi file `.sql`.
   - Buka phpMyAdmin di cPanel dan import file `.sql` tersebut ke database yang baru dibuat.

6. **Konfigurasi Environment (.env):**
   - Edit file `.env` di folder proyek (`ropanasuri-app`).
   - Ubah `APP_ENV=production` dan `APP_DEBUG=false`.
   - Ubah `APP_URL` dengan domain Anda (misal: `https://rumahsakit.com`).
   - Sesuaikan konfigurasi database (`DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`).

7. **Storage Link:**
   - Gambar yang diupload tersimpan di `storage/app/public`. Karena di cPanel biasanya tidak ada akses SSH langsung untuk `php artisan storage:link`, Anda bisa membuat symlink dengan skrip PHP.
   - Buat file `symlink.php` di dalam `public_html/` dengan isi:
     ```php
     <?php
     $targetFolder = __DIR__.'/../ropanasuri-app/storage/app/public';
     $linkFolder = __DIR__.'/storage';
     symlink($targetFolder, $linkFolder);
     echo 'Symlink berhasil dibuat';
     ?>
     ```
   - Akses via browser: `https://domainanda.com/symlink.php`.
   - Jika berhasil, akan muncul folder `storage` di dalam `public_html`. Setelah itu, hapus file `symlink.php`.

### Opsi 2: VPS (Ubuntu / Nginx)

Untuk deployment menggunakan VPS, alur kerjanya lebih bersih:

1. Clone atau upload proyek ke server (misal: `/var/www/ropanasuri-hospital`).
2. Install dependencies (tanpa dev):
   ```bash
   composer install --optimize-autoloader --no-dev
   npm install && npm run build
   ```
3. Set perizinan folder (Storage & Cache):
   ```bash
   sudo chown -R www-data:www-data /var/www/ropanasuri-hospital
   sudo chmod -R 775 /var/www/ropanasuri-hospital/storage
   sudo chmod -R 775 /var/www/ropanasuri-hospital/bootstrap/cache
   ```
4. Buat symlink untuk storage:
   ```bash
   php artisan storage:link
   ```
5. Konfigurasi virtual host Nginx untuk mengarahkan direktori `root` ke `/var/www/ropanasuri-hospital/public`.

---

## 👨‍💼 Akun Default

Gunakan kredensial berikut untuk login ke dashboard admin (jika menggunakan seeder):

- **Admin Email:** `admin@rumahsakit.com` | **Password:** `password123`
- **User Email:** `user@example.com` | **Password:** `password123`

---

## 📂 Struktur Direktori Utama

```text
hospital-website/
├── app/
│   ├── Http/Controllers/
│   └── Models/
├── database/
│   ├── migrations/
│   └── seeders/
├── resources/views/
│   ├── layouts/
│   ├── admin/      # View untuk Dashboard Admin
│   ├── homecare/   # View untuk Layanan Homecare
│   └── ...
├── public/
├── routes/
│   └── web.php
└── ...
```

---

## 🚨 Troubleshooting

### Error 429 Too Many Requests
```bash
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

### Storage Link Error (Gambar tidak muncul)
```bash
php artisan storage:link
chmod -R 775 storage/
chmod -R 775 bootstrap/cache/
```

### Migration Error
```bash
php artisan migrate:fresh --seed
```

---

## 🔄 Changelog

### v1.1.0 - Homecare Feature
- ✅ Sistem paket homecare
- ✅ WhatsApp integration
- ✅ Enhanced UI/UX
- ✅ Responsive design

### v1.0.0 - Initial Release
- Basic website rumah sakit
- Admin dashboard
- CRUD semua fitur utama

---

## 📄 License

Proyek ini dikembangkan untuk keperluan rumah sakit dan komersial. Silakan sesuaikan dengan kebutuhan Anda.

<p align="center">Dikembangkan dengan ❤️ menggunakan Laravel 10</p>
