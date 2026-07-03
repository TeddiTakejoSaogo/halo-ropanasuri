<div align="center">
  <h1 align="center">🏥 Halo Ropanasuri - AI Virtual Assistant</h1>

  <p align="center">
    Sistem Asisten Virtual Berbasis AI untuk Rumah Sakit Khusus Bedah (RSKB) Ropanasuri.
    <br />
    <br />
    <a href="#about-the-project">Tentang Sistem</a>
    ·
    <a href="#features">Fitur Utama</a>
    ·
    <a href="#getting-started">Mulai Cepat</a>
  </p>

  <p align="center">
    <img src="https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel" />
    <img src="https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white" alt="Tailwind" />
    <img src="https://img.shields.io/badge/Groq_API-000000?style=for-the-badge&logo=openai&logoColor=white" alt="Groq API" />
    <img src="https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white" alt="MySQL" />
  </p>
</div>

---

## 📖 Tentang Proyek

**Halo Ropanasuri** adalah aplikasi web modern berbasis *AI Virtual Assistant* yang dirancang khusus untuk menangani interaksi pelanggan/pasien di Rumah Sakit Khusus Bedah Ropanasuri. Sistem ini memadukan kemampuan Generative AI (menggunakan Groq Cloud Llama 3) dengan *knowledge base* (FAQ) lokal untuk memberikan jawaban yang cepat, ramah, dan sangat akurat.

Sistem ini didesain dengan menjunjung tinggi batasan hukum medis: **AI diprogram secara ketat untuk tidak memberikan diagnosa, tidak merekomendasikan resep obat, dan tidak menjanjikan rincian biaya medis spesifik yang di luar SOP rumah sakit. AI juga dibatasi hanya untuk informasi di dalam ruang lingkup RSKB Ropanasuri.**

### 🚀 Teknologi yang Digunakan

*   [Laravel 12](https://laravel.com) - Framework backend PHP.
*   [Tailwind CSS 4](https://tailwindcss.com/) - Framework CSS berbasis utilitas.
*   [Groq Cloud API](https://groq.com/) - Mesin pemroses LLM (Llama 3) yang sangat cepat.
*   [Alpine.js](https://alpinejs.dev/) - Framework JS minimalis untuk interaktivitas UI frontend.
*   [Laravel Breeze](https://laravel.com/docs/starter-kits#laravel-breeze) - Sistem autentikasi.

---

## ✨ Fitur Utama

1. **AI Chat Assistant (Pasien/User)**
   - Algoritma pencocokan kata kunci dan *scoring* berbasis FAQ untuk mencari konteks.
   - Pembangkitan bahasa alami (*natural language generation*) menggunakan Groq API.
   - **Medical Guardrails:** Sistem dapat mendeteksi kata kunci kondisi darurat medis dan segera menyarankan IGD. AI juga secara cerdas menolak pertanyaan seputar diagnosis atau resep obat.
   - Deteksi sentimen dasar (misalnya kata panik/cemas) akan memicu respon yang lebih empatik.
   - Pilihan pertanyaan rekomendasi (Follow-ups) yang dinamis.
   - Validasi ketat yang membatasi jawaban hanya di sekitar lingkup RSKB Ropanasuri, dan mengarahkan ke [website resmi](http://ropanasuri.com/) untuk info umum.

2. **Panel Admin (Manajemen)**
   - **Dashboard Statistik:** Ringkasan jumlah FAQ, log percakapan, dan metrik lainnya.
   - **Manajemen FAQ & Keywords:** Kelola basis pengetahuan AI. Setiap FAQ bisa diikat dengan beberapa kata kunci beserta *weight* (bobotnya) untuk mengoptimalkan pencarian AI.
   - **Riwayat Chat (Chat Logs):** Pemantauan seluruh pertanyaan yang diajukan oleh user beserta status kembalian (terjawab, darurat, di luar batas, dll) untuk evaluasi CS.
   - **Manajemen Artikel:** Pusat informasi pendukung atau berita edukasi kesehatan dari rumah sakit.

---

## 🛠️ Mulai Cepat (Getting Started)

Langkah-langkah untuk menjalankan proyek ini di *local environment* Anda.

### Prasyarat

Pastikan komputer Anda memiliki:
*   **PHP** >= 8.2
*   **Composer**
*   **Node.js & npm**
*   **Database** (MySQL, MariaDB, dll.)
*   **Akun Groq Cloud** (Untuk mendapatkan `GROQ_API_KEY`)

### Instalasi

1. **Clone repository ini**
   ```bash
   git clone <repository-url>
   cd halo-ropanasuri
   ```

2. **Install dependensi PHP**
   ```bash
   composer install
   ```

3. **Install dependensi Node**
   ```bash
   npm install
   ```

4. **Konfigurasi Environment**
   Duplikat file `.env.example` menjadi `.env`.
   ```bash
   cp .env.example .env
   ```
   Atur koneksi database Anda di file `.env`:
   ```env
   DB_DATABASE=db_halo_ropanasuri
   DB_USERNAME=root
   DB_PASSWORD=
   ```
   Tambahkan API Key Groq Anda:
   ```env
   GROQ_API_KEY=gsk_xxxxxxxxxxxxxxxxxxx
   ```

5. **Generate Application Key**
   ```bash
   php artisan key:generate
   ```

6. **Migrasi Database & Seeder**
   Jalankan perintah ini untuk membangun tabel database dan menyuntikkan data *dummy* (termasuk FAQ default dan Akun Admin).
   ```bash
   php artisan migrate --seed
   ```
   *Akun Admin Default (Cek `AdminUserSeeder.php`):*
   - Email: `admin@ropanasuri.id`
   - Password: `ropanasuri2025`

7. **Jalankan Development Server**
   Anda bisa menggunakan satu perintah ini:
   ```bash
   composer run dev
   ```
   Atau menjalankannya secara terpisah:
   ```bash
   php artisan serve
   npm run dev
   ```

8. Buka browser dan akses: `http://localhost:8000`

---
<p align="center">Dikembangkan untuk memberikan pelayanan prima bagi pasien RSKB Ropanasuri 🏥</p>
