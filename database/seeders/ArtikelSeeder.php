<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Artikel;
use Illuminate\Support\Str;

class ArtikelSeeder extends Seeder
{
    public function run(): void
    {
        $artikels = [
            [
                'judul' => 'Cara Mencuci Tangan yang Benar',
                'slug' => 'cara-mencuci-tangan-yang-benar',
                'konten' => 'Cuci tangan dengan sabun dan air mengalir selama 20 detik. Pastikan membersihkan sela-sela jari dan punggung tangan.',
                'excerpt' => 'Panduan lengkap mencuci tangan untuk cegah infeksi',
                'kategori' => 'Hidup Sehat',
                'is_published' => true,
                'published_at' => now()
            ],
            [
                'judul' => 'Jadwal Dokter Spesialis Jantung',
                'slug' => 'jadwal-dokter-spesialis-jantung',
                'konten' => 'Dokter Spesialis Jantung Ropanāsuri praktek setiap Senin-Kamis pukul 09.00-15.00 WIB.',
                'excerpt' => 'Informasi jadwal praktik dr. Budi, Sp.JP',
                'kategori' => 'Layanan',
                'is_published' => true,
                'published_at' => now()
            ],
            [
                'judul' => 'Persiapan Operasi Katarak',
                'slug' => 'persiapan-operasi-katarak',
                'konten' => 'Pasien diharapkan puasa 6 jam sebelum operasi dan membawa hasil laboratorium.',
                'excerpt' => 'Tips sebelum menjalani operasi katarak',
                'kategori' => 'Edukasi',
                'is_published' => true,
                'published_at' => now()
            ]
        ];

        foreach ($artikels as $artikel) {
            Artikel::create($artikel);
        }
    }
}