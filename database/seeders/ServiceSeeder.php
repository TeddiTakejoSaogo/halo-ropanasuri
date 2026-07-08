<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;

class ServiceSeeder extends Seeder
{
    public function run()
    {
        $services = [
            [
                'name' => 'Poli THT',
                'icon' => 'ear',
                'description' => 'Pelayanan kesehatan spesialis telinga, hidung, dan tenggorokan dengan peralatan medis yang lengkap.',
                'operational_hours' => 'Senin - Sabtu: 08:00 - 15:00',
                'status' => 'active'
            ],
            [
                'name' => 'Poli Orthopedi',
                'icon' => 'bone',
                'description' => 'Pelayanan khusus bedah tulang dan persendian dengan penanganan dari dokter spesialis orthopedi terbaik.',
                'operational_hours' => 'Senin - Jumat: 09:00 - 16:00',
                'status' => 'active'
            ],
            [
                'name' => 'Poli Onkologi',
                'icon' => 'ribbon',
                'description' => 'Pelayanan untuk deteksi dini, pencegahan, dan pengobatan penyakit kanker secara komprehensif.',
                'operational_hours' => 'Senin, Rabu, Jumat: 08:00 - 14:00',
                'status' => 'active'
            ],
            [
                'name' => 'Poli Urologi',
                'icon' => 'droplet',
                'description' => 'Penanganan masalah sistem saluran kemih dan sistem reproduksi pria dengan teknologi terkini.',
                'operational_hours' => 'Selasa & Kamis: 09:00 - 15:00',
                'status' => 'active'
            ],
            [
                'name' => 'Poli Bedah Umum',
                'icon' => 'syringe',
                'description' => 'Pelayanan bedah umum dengan fasilitas ruang operasi modern dan tim medis profesional.',
                'operational_hours' => 'Senin - Sabtu: 08:00 - 16:00',
                'status' => 'active'
            ],
            [
                'name' => 'Poli Penyakit Dalam',
                'icon' => 'stethoscope',
                'description' => 'Pelayanan diagnosis dan penanganan masalah kesehatan organ dalam tubuh orang dewasa.',
                'operational_hours' => 'Senin - Sabtu: 08:00 - 17:00',
                'status' => 'active'
            ],
            [
                'name' => 'Poli Jantung',
                'icon' => 'heart',
                'description' => 'Pelayanan spesialis jantung komprehensif dengan dukungan fasilitas rekam jantung (EKG).',
                'operational_hours' => 'Senin - Jumat: 08:00 - 15:00',
                'status' => 'active'
            ],
            [
                'name' => 'Farmasi',
                'icon' => 'pills',
                'description' => 'Instalasi farmasi yang menyediakan obat-obatan berkualitas untuk pasien rawat inap maupun rawat jalan.',
                'operational_hours' => '24 Jam',
                'status' => 'active'
            ],
            [
                'name' => 'Labor Klinik & Patologi Anatomi',
                'icon' => 'microscope',
                'description' => 'Pelayanan laboratorium modern untuk tes darah, urine, serta pemeriksaan jaringan tubuh (Patologi Anatomi).',
                'operational_hours' => 'Senin - Sabtu: 07:00 - 20:00',
                'status' => 'active'
            ],
            [
                'name' => 'Radiologi',
                'icon' => 'x-ray',
                'description' => 'Pelayanan penunjang diagnostik berupa Rontgen, USG, dan CT-Scan untuk mendiagnosis penyakit secara presisi.',
                'operational_hours' => '24 Jam',
                'status' => 'active'
            ],
            [
                'name' => 'IGD',
                'icon' => 'ambulance',
                'description' => 'Instalasi Gawat Darurat (IGD) yang siap melayani kasus kegawatdaruratan medis setiap saat.',
                'operational_hours' => '24 Jam Non-Stop',
                'status' => 'active'
            ],
            [
                'name' => 'Bedah Minor',
                'icon' => 'band-aid',
                'description' => 'Tindakan bedah ringan yang dapat dilakukan di ruang tindakan tanpa memerlukan rawat inap.',
                'operational_hours' => 'Senin - Sabtu: 08:00 - 16:00',
                'status' => 'active'
            ],
            [
                'name' => 'Pelayanan Rawat Inap',
                'icon' => 'bed',
                'description' => 'Fasilitas kamar perawatan inap yang nyaman dan bersih, didukung perawat yang ramah dan siaga.',
                'operational_hours' => '24 Jam',
                'status' => 'active'
            ]
        ];

        \Illuminate\Support\Facades\DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Service::truncate();
        \Illuminate\Support\Facades\DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        foreach ($services as $service) {
            Service::create($service);
        }
    }
}