<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Faq;
use App\Models\Keyword;

class FaqSeeder extends Seeder
{
    public function run(): void
    {
        // 1. FAQ Jam Besuk
        $faq1 = Faq::create([
            'question' => 'Jam besuk pasien di Ropanasuri jam berapa?',
            'answer' => 'Jam besuk pasien di RS Ropanāsuri adalah pukul 14.00-16.00 WIB dan 18.30-20.00 WIB. Khusus ICU, jam besuk pukul 15.00-16.00 WIB dengan maksimal 2 orang.',
            'category' => 'Layanan',
            'hit_count' => 0,
            'is_active' => true
        ]);

        $keywords1 = ['besuk', 'jam', 'jenguk', 'visitor', 'pasien', 'icu'];
        foreach ($keywords1 as $keyword) {
            $faq1->keywords()->create([
                'keyword' => $keyword,
                'weight' => 1
            ]);
        }

        // 2. FAQ Pendaftaran
        $faq2 = Faq::create([
            'question' => 'Cara daftar berobat di Ropanasuri bagaimana?',
            'answer' => 'Pendaftaran dapat dilakukan melalui: 1) Aplikasi Mobile Ropanāsuri, 2) Website rs.ropanasuri.id, 3) Datang langsung ke loket pendaftaran, 4) Telepon di 021-5551234.',
            'category' => 'Pendaftaran',
            'hit_count' => 0,
            'is_active' => true
        ]);

        $keywords2 = ['daftar', 'registrasi', 'berobat', 'pendaftaran', 'antri', 'booking'];
        foreach ($keywords2 as $keyword) {
            $faq2->keywords()->create([
                'keyword' => $keyword,
                'weight' => 1
            ]);
        }

        // 3. FAQ Biaya
        $faq3 = Faq::create([
            'question' => 'Apakah Ropanāsuri menerima BPJS?',
            'answer' => 'Ya, RS Ropanasuri bekerja sama dengan BPJS Kesehatan untuk semua layanan rawat jalan, rawat inap, dan tindakan bedah. Silakan bawa kartu BPJS aktif saat pendaftaran.',
            'category' => 'BPJS',
            'hit_count' => 0,
            'is_active' => true
        ]);

        $keywords3 = ['bpjs', 'kis', 'jaminan', 'asuransi', 'kartu', 'premi'];
        foreach ($keywords3 as $keyword) {
            $faq3->keywords()->create([
                'keyword' => $keyword,
                'weight' => 1
            ]);
        }
    }
}