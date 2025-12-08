<?php

namespace Database\Seeders;

use App\Models\HomecarePackage;
use Illuminate\Database\Seeder;

class HomecarePackageSeeder extends Seeder
{
    public function run()
    {
        $packages = [
            [
                'name' => 'Homecare Basic',
                'description' => 'Layanan perawatan dasar di rumah untuk pasien dengan kondisi stabil. Termasuk pemantauan rutin dan konsultasi.',
                'preparation' => '1. Siapkan ruangan yang bersih dan nyaman
2. Sediakan data medis pasien
3. Pastikan ada pendamping keluarga
4. Siapkan obat-obatan yang sedang dikonsumsi',
                'procedure' => '1. Assessment awal oleh perawat
2. Pemeriksaan tanda vital
3. Pemberian obat sesuai resep
4. Edukasi perawatan mandiri
5. Laporan perkembangan harian',
                'price' => 250000,
                'duration' => '2-3 jam per kunjungan',
                'features' => ['Perawat berpengalaman', 'Pemeriksaan tanda vital', 'Konsultasi kesehatan', 'Laporan harian'],
                'whatsapp_message' => 'Halo, saya ingin informasi lebih lanjut tentang paket Homecare Basic',
                'order' => 1,
                'status' => 'active'
            ],
            [
                'name' => 'Homecare Premium',
                'description' => 'Layanan perawatan komprehensif termasuk fisioterapi dan terapi khusus. Cocok untuk pasien pasca operasi.',
                'preparation' => '1. Ruangan khusus dengan tempat tidur pasien
2. Peralatan medis dasar
3. Riwayat medis lengkap
4. Surat rujukan dokter',
                'procedure' => '1. Assessment komprehensif
2. Perawatan luka
3. Fisioterapi ringan
4. Monitoring intensif
5. Konsultasi dengan dokter spesialis',
                'price' => 500000,
                'duration' => '4-6 jam per kunjungan',
                'features' => ['Perawat spesialis', 'Fisioterapi', 'Perawatan luka', 'Konsultasi dokter', 'Emergency call'],
                'whatsapp_message' => 'Halo, saya ingin informasi lebih lanjut tentang paket Homecare Premium',
                'order' => 2,
                'status' => 'active'
            ],
            [
                'name' => 'Homecare 24 Jam',
                'description' => 'Layanan perawatan intensif 24 jam dengan tim medis bergantian. Untuk pasien dengan kondisi kritis.',
                'preparation' => '1. Ruangan ICU mini
2. Peralatan monitoring lengkap
3. Dokumen medis lengkap
4. Persetujuan keluarga',
                'procedure' => '1. Monitoring 24 jam
2. Perawatan intensif
3. Terapi khusus
4. Koordinasi dengan dokter
5. Laporan real-time',
                'price' => 1500000,
                'duration' => '24 jam non-stop',
                'features' => ['Tim medis 24 jam', 'Monitoring intensif', 'Emergency response', 'Konsultasi video call', 'Laporan real-time'],
                'whatsapp_message' => 'Halo, saya ingin informasi lebih lanjut tentang paket Homecare 24 Jam',
                'order' => 3,
                'status' => 'active'
            ],
            [
                'name' => 'Homecare Lansia',
                'description' => 'Perawatan khusus untuk lansia dengan pendekatan holistik. Fokus pada kenyamanan dan kualitas hidup.',
                'preparation' => '1. Lingkungan yang aman untuk lansia
2. Data kondisi kronis
3. Daftar obat rutin
4. Preferensi pasien',
                'procedure' => '1. Assessment kebutuhan lansia
2. Perawatan kegiatan sehari-hari
3. Aktivitas fisik ringan
4. Monitoring kesehatan mental
5. Pendampingan sosial',
                'price' => 350000,
                'duration' => '3-4 jam per kunjungan',
                'features' => ['Perawat geriatri', 'Aktivitas fisik', 'Pendampingan sosial', 'Monitoring mental', 'Konsultasi gizi'],
                'whatsapp_message' => 'Halo, saya ingin informasi lebih lanjut tentang paket Homecare Lansia',
                'order' => 4,
                'status' => 'active'
            ]
        ];

        foreach ($packages as $package) {
            HomecarePackage::create($package);
        }
    }
}