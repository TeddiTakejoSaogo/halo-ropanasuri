<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Admin Secret Configuration
    |--------------------------------------------------------------------------
    |
    | Konfigurasi untuk keamanan URL login admin.
    | Ubah nilai ini di file .env untuk keamanan maksimal.
    |
    */
    
    'secret' => env('ADMIN_SECRET', 'ropanasuri-admin-default'),
    
    'login_path' => env('ADMIN_LOGIN_PATH', 'admin-login'),
    
    /*
    |--------------------------------------------------------------------------
    | Admin Emails
    |--------------------------------------------------------------------------
    |
    | Daftar email yang diizinkan untuk login.
    |
    */
    'allowed_emails' => [
        'admin@ropanasuri.id',
        'it@ropanasuri.id',
        'konten@ropanasuri.id',
    ],
];