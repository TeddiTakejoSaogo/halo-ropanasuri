<?php

namespace Database\Seeders;

use App\Models\HospitalProfile;
use Illuminate\Database\Seeder;

class HospitalProfileSeeder extends Seeder
{
    public function run()
    {
        HospitalProfile::create([
            'name' => 'Rumah Sakit Khusu Bedah Ropanasuri',
            'address' => 'Jl. Aur No.8, Ujung Gurun, Kec. Padang Bar., Kota Padang, Sumatera Barat 25142',
            'phone' => '(021) 123-4567',
            'email' => 'info@rumahsakit.com',
            'description' => 'Rumah Sakit kami telah melayani masyarakat dengan dedikasi tinggi dalam memberikan pelayanan kesehatan yang berkualitas. Dengan tim medis yang profesional dan fasilitas yang lengkap, kami berkomitmen untuk memberikan perawatan terbaik bagi pasien.',
            'vision' => 'Menjadi rumah sakit pilihan utama masyarakat dengan pelayanan kesehatan berkualitas internasional yang terjangkau.',
            'mission' => "Memberikan pelayanan kesehatan yang bermutu\nMengutamakan kepuasan pasien\nMengembangkan sumber daya manusia yang profesional\nMemiliki teknologi medis yang terkini",
            'history' => 'Rumah Sakit Kami didirikan pada tahun 1990 dengan misi memberikan pelayanan kesehatan yang berkualitas kepada masyarakat. Selama lebih dari 30 tahun, kami telah berkembang menjadi rumah sakit terpercaya dengan fasilitas modern dan tim medis yang profesional.',
            'facebook' => 'https://facebook.com/rumahsakit',
            'instagram' => 'https://instagram.com/rumahsakit',
            'tiktok' => 'https://tiktok.com/rumahsakit',
            'youtube' => 'https://youtube.com/rumahsakit',
        ]);
    }
}