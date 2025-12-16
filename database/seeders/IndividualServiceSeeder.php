<?php

namespace Database\Seeders;

use App\Models\IndividualService;
use Illuminate\Database\Seeder;

class IndividualServiceSeeder extends Seeder
{
    public function run()
    {
        $services = [
            [
                'name' => 'Paket Medical Check Up Premium',
                'slug' => 'paket-medical-check-up-premium',
                'description' => 'Pemeriksaan kesehatan lengkap untuk deteksi dini penyakit dengan teknologi terbaru.',
                'benefits' => "Deteksi dini penyakit kronis\nKonsultasi dengan dokter spesialis\nLaporan kesehatan digital\nFollow up rutin",
                'features' => "Konsultasi dokter umum\nKonsultasi dokter spesialis\nPemeriksaan laboratorium lengkap\nRontgen thorax\nEKG\nUSG abdomen\nKonsultasi gizi",
                'price' => 2500000,
                'discount_price' => 2000000,
                'duration_days' => 1,
                'icon' => 'stethoscope',
                'status' => 'active',
                'is_featured' => true,
                'sort_order' => 1,
                'whatsapp_message' => "Halo, saya ingin memesan Paket Medical Check Up Premium\n\nNama: {nama}\nTelepon: {telepon}\nEmail: {email}\n\n{pesan_tambahan}",
            ],
            [
                'name' => 'Paket Perawatan Jantung',
                'slug' => 'paket-perawatan-jantung',
                'description' => 'Perawatan jantung komprehensif dengan tim kardiologis berpengalaman.',
                'benefits' => "Pemeriksaan jantung menyeluruh\nMonitoring 24 jam\nKonsultasi kardiologis rutin\nEmergency response",
                'features' => "Konsultasi dokter jantung\nEKG lengkap\nEcho jantung\nStress test\nMonitoring tekanan darah\nLaboratorium jantung\nKonsultasi pola hidup",
                'price' => 5000000,
                'discount_price' => 4500000,
                'duration_days' => 30,
                'icon' => 'heart',
                'status' => 'active',
                'is_featured' => true,
                'sort_order' => 2,
                'whatsapp_message' => null,
            ],
            [
                'name' => 'Paket Kebugaran Executive',
                'slug' => 'paket-kebugaran-executive',
                'description' => 'Program kebugaran khusus untuk eksekutif dengan waktu terbatas.',
                'benefits' => "Program personal training\nNutrition planning\nStress management\nHealth coaching",
                'features' => "Medical check up\nKonsultasi dokter olahraga\nProgram latihan personal\nKonsultasi gizi\nTherapy massage\nSauna & spa\nHealth monitoring",
                'price' => 3500000,
                'discount_price' => null,
                'duration_days' => 90,
                'icon' => 'user-md',
                'status' => 'active',
                'is_featured' => false,
                'sort_order' => 3,
                'whatsapp_message' => null,
            ],
            [
                'name' => 'Paket Kehamilan Premium',
                'slug' => 'paket-kehamilan-premium',
                'description' => 'Pendampingan kehamilan dari trimester pertama hingga persalinan.',
                'benefits' => "Pendampingan dokter kandungan\nUSG rutin\nKelas prenatal\nPersiapan persalinan",
                'features' => "Konsultasi dokter kandungan\nUSG 4D\nLaboratorium kehamilan\nKelas prenatal\nKonsultasi gizi ibu hamil\nPersiapan persalinan\nKunjungan postnatal",
                'price' => 8000000,
                'discount_price' => 7500000,
                'duration_days' => 270,
                'icon' => 'baby',
                'status' => 'active',
                'is_featured' => true,
                'sort_order' => 4,
                'whatsapp_message' => null,
            ],
            [
                'name' => 'Paket Deteksi Dini Kanker',
                'slug' => 'paket-deteksi-dini-kanker',
                'description' => 'Skrining kanker komprehensif untuk deteksi dini sel kanker.',
                'benefits' => "Skrining multi jenis kanker\nKonsultasi onkologis\nEarly detection\nTreatment planning",
                'features' => "Konsultasi dokter onkologi\nLaboratorium tumor marker\nCT Scan\nMammografi\nKolonskopi\nBiopsi jika diperlukan\nKonseling psikologi",
                'price' => 10000000,
                'discount_price' => 9000000,
                'duration_days' => 7,
                'icon' => 'shield-alt',
                'status' => 'active',
                'is_featured' => false,
                'sort_order' => 5,
                'whatsapp_message' => null,
            ],
        ];

        foreach ($services as $service) {
            IndividualService::create($service);
        }
    }
}