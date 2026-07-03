<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Hapus admin lama jika ada (optional)
        User::where('email', 'admin@ropanasuri.id')->delete();
        
        // Buat admin utama
        User::create([
            'name' => 'Administrator Ropanāsuri',
            'email' => 'admin@ropanasuri.id',
            'password' => Hash::make('ropanasuri2025'),
            'email_verified_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
        // Buat admin kedua (untuk tim IT/Helpdesk)
        User::where('email', 'it@ropanasuri.id')->delete();
        User::create([
            'name' => 'IT Support Ropanāsuri',
            'email' => 'it@ropanasuri.id',
            'password' => Hash::make('itropanasuri2025'),
            'email_verified_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
        // Buat admin ketiga (untuk tim konten/edukasi)
        User::where('email', 'konten@ropanasuri.id')->delete();
        User::create([
            'name' => 'Tim Konten Ropanāsuri',
            'email' => 'konten@ropanasuri.id',
            'password' => Hash::make('kontenropanasuri2025'),
            'email_verified_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
        $this->command->info('✅ Akun admin berhasil dibuat!');
        $this->command->info('📧 admin@ropanasuri.id');
        $this->command->info('🔑 ropanasuri2025');
    }
}