<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            AdminUserSeeder::class,
            HospitalProfileSeeder::class,
            DoctorSeeder::class,
            ServiceSeeder::class,
            TestimonialSeeder::class,
            ArticleSeeder::class,
            HomecarePackageSeeder::class,
        ]);
    }
}