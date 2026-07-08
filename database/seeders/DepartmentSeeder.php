<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Department;

class DepartmentSeeder extends Seeder
{
    public function run(): void
    {
        $departments = [
            ['name' => 'IT Support & Sistem Informasi', 'description' => 'Mengelola jaringan, hardware, dan software RS.'],
            ['name' => 'Medis & Keperawatan', 'description' => 'Dokter, perawat, dan tenaga medis utama.'],
            ['name' => 'Administrasi & Rekam Medis', 'description' => 'Pendaftaran, kasir, dan pengelola data rekam medis.'],
            ['name' => 'Farmasi', 'description' => 'Apoteker dan asisten apoteker.'],
            ['name' => 'HRD / Personalia', 'description' => 'Manajemen SDM rumah sakit.'],
            ['name' => 'Keuangan & Akuntansi', 'description' => 'Mengurus arus kas dan laporan keuangan.'],
            ['name' => 'Fasilitas & Umum', 'description' => 'Security, kebersihan, dan pemeliharaan gedung.'],
        ];

        foreach ($departments as $dept) {
            Department::firstOrCreate(['name' => $dept['name']], $dept);
        }
    }
}
