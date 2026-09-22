<div align="center">
  <img src="https://img.shields.io/badge/Sistem_Informasi-Rumah_Sakit-blue?style=for-the-badge" alt="Sistem Informasi" />
  
  <h1>🏥 Sistem Halo Ropanasuri</h1>
  <h3>AI Virtual Assistant & Portal Edukasi Kesehatan</h3>

  <p>
    Sebuah platform digital modern yang dikembangkan secara khusus untuk <b>Rumah Sakit Khusus Bedah (RSKB) Ropanasuri</b>.
  </p>
</div>

---

## 📑 Pendahuluan

Di era digitalisasi informasi saat ini, aksesibilitas terhadap informasi kesehatan dan kemudahan komunikasi menjadi sangat penting. **Halo Ropanasuri** hadir sebagai solusi terpadu yang menjembatani komunikasi antara pihak rumah sakit dan pasien/masyarakat umum. 

Sistem ini bukan sekadar portal berita, melainkan sebuah **Asisten Virtual Berbasis Kecerdasan Buatan (AI)** yang dirancang untuk memberikan pelayanan publik yang responsif, akurat, dan sangat manusiawi, selama 24 jam penuh.

---

## 🎯 Tujuan & Solusi Utama

Platform ini dirancang untuk menyelesaikan dua kebutuhan utama:
1. **Penyebaran Informasi:** Memudahkan masyarakat mendapatkan informasi kesehatan yang valid dan terkurasi melalui sistem manajemen artikel yang baik.
2. **Layanan Bantuan Cerdas:** Menyediakan layanan *Customer Service* otomatis berbasis AI yang mampu menjawab pertanyaan umum, menangani keluhan, dan memberikan panduan layanan rumah sakit secara *real-time*.

> [!IMPORTANT]
> **Protokol Keselamatan Medis (Guardrails)**
> Sistem AI ini didesain dengan menjunjung tinggi etika dan batasan hukum medis. AI diprogram secara ketat untuk **tidak memberikan diagnosa**, **tidak merekomendasikan resep obat**, dan akan segera menyarankan tindakan IGD apabila mendeteksi kata kunci kondisi darurat medis.

---

## ✨ Fungsionalitas Sistem

Sistem ini dibagi menjadi dua antarmuka utama yang disesuaikan dengan kebutuhan penggunanya:

### 👤 Untuk Pengguna (Pasien / Masyarakat)
* **🤖 AI Live Chat (Asisten Virtual):** Fasilitas obrolan interaktif. Pengguna dapat bertanya seputar jadwal dokter, layanan poli, hingga prosedur pendaftaran. AI akan menjawab secara natural berkat integrasi **Groq Cloud Llama 3**.
* **📰 Portal Artikel Edukatif:** Halaman publikasi untuk membaca berbagai artikel, tips kesehatan, dan berita terbaru yang dirilis resmi oleh tim medis Ropanasuri.
* **📱 Antarmuka Responsif:** Desain modern yang nyaman diakses melalui *smartphone* (mobile-friendly) maupun komputer *desktop*.

### 👨‍💻 Untuk Administrator (Staf RS)
* **📊 Dashboard Analitik:** Panel ringkasan yang menyajikan statistik penggunaan aplikasi, jumlah interaksi chat, dan performa AI.
* **🧠 Manajemen Knowledge Base (FAQ):** Modul untuk melatih AI. Admin dapat menambahkan pertanyaan dan jawaban (FAQ) beserta *keywords* dan pembobotannya (*weight*), yang akan langsung dipelajari oleh AI.
* **📝 Content Management System (CMS):** Sistem untuk menulis, mengedit, dan mempublikasikan artikel edukasi kesehatan.
* **🕵️‍♂️ Monitoring Riwayat Chat:** Akses penuh untuk meninjau seluruh percakapan antara pasien dan AI guna mengevaluasi kualitas layanan dan mengidentifikasi tren kebutuhan pasien.

---

## 🛠️ Arsitektur Teknologi

Sistem dibangun menggunakan *stack* teknologi modern tingkat *Enterprise* untuk memastikan keamanan, kecepatan, dan skalabilitas jangka panjang:

- **Core Framework:** [Laravel 12](https://laravel.com) (PHP 8.2) - Menjamin keamanan data pasien dan ketangguhan sistem backend.
- **AI Processing:** [Groq API](https://groq.com/) - Mesin inferensi LLM (Large Language Model) tercepat di dunia saat ini.
- **Frontend & UI/UX:** [Tailwind CSS 4](https://tailwindcss.com/) & Alpine.js - Menghasilkan antarmuka yang sangat dinamis, ringan, dan elegan.
- **Database:** MySQL/MariaDB yang dioptimalkan untuk pencarian relasional berbasis konteks.

---

## 🚀 Panduan Instalasi (Untuk Developer)

Bagi tim IT yang ingin melakukan *deployment* atau pengembangan lanjutan, ikuti langkah berikut:

1. **Persiapan:** Pastikan PHP 8.2+, Composer, Node.js, dan MySQL telah terinstal.
2. **Kloning Repositori:**
   ```bash
   git clone https://github.com/TeddiTakejoSaogo/halo-ropanasuri.git
   cd halo-ropanasuri
   ```
3. **Instalasi Dependensi:**
   ```bash
   composer install
   npm install
   ```
4. **Konfigurasi Environment:**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
   *Atur koneksi database Anda di file `.env`, dan jangan lupa masukkan `GROQ_API_KEY` Anda.*
5. **Migrasi Data Dasar:**
   ```bash
   php artisan migrate --seed
   ```
6. **Jalankan Server:**
   ```bash
   composer run dev
   ```

---
<div align="center">
  <p><b>Halo Ropanasuri</b></p>
  <p>© 2026 Rumah Sakit Khusus Bedah Ropanasuri</p>
</div>
