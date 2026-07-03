<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@if(isset($hospitalProfile)){{ $hospitalProfile->name }} - @endif @yield('title', 'Rumah Sakit')</title>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    
    <!-- Favicon -->
    @if(isset($hospitalProfile) && $hospitalProfile->logo)
        <link rel="icon" type="image/png" href="{{ asset('storage/' . $hospitalProfile->logo) }}">
        <link rel="apple-touch-icon" href="{{ asset('storage/' . $hospitalProfile->logo) }}">
    @else
        <link rel="icon" type="image/x-icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90'>🏥</text></svg>">
    @endif
    
    <meta name="description" content="@if(isset($hospitalProfile)){{ Str::limit($hospitalProfile->description, 160) }}@else{Rumah Sakit terpercaya dengan pelayanan kesehatan berkualitas.@endif">
    
    <style>
        :root {
            /* Core Theme Colors */
            --color-navy: #0F3460;
            --color-teal: #16a085;
            --color-teal-light: #e8f6f3;
            --color-light: #f8f9fa;
            --color-dark: #2c3e50;
            
            /* Legacy root colors for compatibility */
            --primary-color: #0F3460;
            --primary-light: #16a085;
            --secondary-color: #e8f6f3;
            --success-color: #198754;
            --warning-color: #ffc107;
            --danger-color: #dc3545;
            --info-color: #0dcaf0;
            
            /* Glassmorphism */
            --glass-bg: rgba(255, 255, 255, 0.95);
            --glass-border: rgba(255, 255, 255, 0.2);
            --glass-shadow: 0 8px 32px 0 rgba(15, 52, 96, 0.05);
        }
        
        body {
            font-family: 'Inter', sans-serif;
            color: var(--color-dark);
            background-color: #fcfcfc;
            -webkit-font-smoothing: antialiased;
        }
        
        /* Navbar Modern Glassmorphism */
        .navbar-custom {
            background: var(--glass-bg);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border-bottom: 1px solid var(--glass-border);
            box-shadow: var(--glass-shadow);
            padding: 12px 0;
            transition: all 0.3s ease;
        }
        
        .navbar-brand {
            font-weight: 700;
            font-size: 1.4rem;
            color: var(--color-navy) !important;
            letter-spacing: -0.5px;
        }
        
        .navbar-nav .nav-link {
            color: var(--color-navy) !important;
            font-weight: 500;
            font-size: 0.9rem;
            padding: 8px 12px !important;
            margin: 0 1px;
            border-radius: 8px;
            transition: all 0.3s ease;
            white-space: nowrap;
        }
        
        .navbar-nav .nav-link:hover,
        .navbar-nav .nav-link.active {
            color: var(--color-teal) !important;
            background-color: var(--color-teal-light);
        }
        
        .navbar-toggler {
            border: none;
            color: var(--color-navy);
            padding: 8px;
        }
        
        .navbar-toggler:focus {
            box-shadow: none;
        }
        
        /* Buttons */
        .btn-teal {
            background-color: var(--color-teal);
            color: white;
            border: none;
            border-radius: 8px;
            padding: 10px 24px;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(22, 160, 133, 0.2);
        }
        
        .btn-teal:hover {
            background-color: #12876f;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(22, 160, 133, 0.3);
        }
        
        .btn-outline-navy {
            border: 2px solid var(--color-navy);
            color: var(--color-navy);
            border-radius: 8px;
            padding: 8px 22px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .btn-outline-navy:hover {
            background-color: var(--color-navy);
            color: white;
        }

        /* Footer Modern */
        .footer {
            background: linear-gradient(135deg, #0a2542 0%, var(--color-navy) 100%);
            color: rgba(255, 255, 255, 0.8);
            padding: 70px 0 30px;
            position: relative;
            overflow: hidden;
        }
        
        .footer::before {
            content: '';
            position: absolute;
            top: -50px;
            right: -50px;
            width: 250px;
            height: 250px;
            background: radial-gradient(circle, rgba(22,160,133,0.15) 0%, rgba(0,0,0,0) 70%);
            border-radius: 50%;
        }

        .footer h5 {
            color: white;
            font-weight: 700;
            margin-bottom: 25px;
            letter-spacing: 0.5px;
            position: relative;
            display: inline-block;
        }
        
        .footer h5::after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 0;
            width: 30px;
            height: 2px;
            background: var(--color-teal);
        }
        
        .footer a {
            color: rgba(255, 255, 255, 0.7);
            text-decoration: none;
            transition: all 0.3s ease;
            display: inline-block;
        }
        
        .footer a:hover {
            color: var(--color-teal);
            transform: translateX(5px);
        }
        
        .footer .social-links a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            background: rgba(255, 255, 255, 0.1);
            color: white;
            border-radius: 50%;
            margin-right: 10px;
            transition: all 0.3s ease;
            border: 1px solid rgba(255, 255, 255, 0.05);
        }
        
        .footer .social-links a:hover {
            background: var(--color-teal);
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(22, 160, 133, 0.3);
            border-color: var(--color-teal);
        }
        
        .footer-bottom {
            margin-top: 50px;
            padding-top: 25px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            font-size: 0.9rem;
        }
        
        /* Utils */
        .text-teal { color: var(--color-teal) !important; }
        .text-navy { color: var(--color-navy) !important; }
        .bg-teal-light { background-color: var(--color-teal-light) !important; }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #f1f1f1; 
        }
        ::-webkit-scrollbar-thumb {
            background: var(--color-teal); 
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #12876f; 
        }
        
        /* Alert styles for consistency */
        .alert {
            border: none;
            border-radius: 12px;
            border-left: 4px solid;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        }
        .alert-success {
            background-color: #d1e7dd;
            border-left-color: #198754;
            color: #0f5132;
        }
    </style>
    @stack('styles')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-custom sticky-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}">
                @if(isset($hospitalProfile) && $hospitalProfile->logo)
                    <img src="{{ asset('storage/' . $hospitalProfile->logo) }}" 
                         alt="Logo" 
                         height="45" 
                         class="me-2" 
                         style="object-fit: contain;"
                         onerror="this.style.display='none'">
                @else
                    <div class="bg-teal-light rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 45px; height: 45px;">
                        <i class="fas fa-hospital text-teal fa-lg"></i>
                    </div>
                @endif
                <span class="d-none d-sm-block">
                    @if(isset($hospitalProfile))
                        {{ $hospitalProfile->name }}
                    @else
                        RSKB Ropanasuri
                    @endif
                </span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <i class="fas fa-bars fa-lg"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-lg-center">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">Tentang Kami</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('services') ? 'active' : '' }}" href="{{ route('services') }}">Layanan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('homecare*') ? 'active' : '' }}" href="{{ route('homecare') }}">
                            Homecare
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('individual-services*') ? 'active' : '' }}" 
                        href="{{ route('individual-services.index') }}">
                            Paket Layanan
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('doctors') ? 'active' : '' }}" href="{{ route('doctors') }}">Dokter</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('news*') ? 'active' : '' }}" href="{{ route('news') }}">Berita</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('gallery') ? 'active' : '' }}" href="{{ route('gallery') }}">Galeri</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('testimonials') ? 'active' : '' }}" href="{{ route('testimonials') }}">Testimoni</a>
                    </li>
                    <li class="nav-item ms-lg-2 mt-2 mt-lg-0">
                        <a class="btn btn-teal w-100 text-nowrap" href="{{ route('contact') }}">Hubungi Kami</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-4 col-md-6">
                    <div class="d-flex align-items-center mb-4">
                        @if(isset($hospitalProfile) && $hospitalProfile->logo)
                            <img src="{{ asset('storage/' . $hospitalProfile->logo) }}" 
                                 alt="{{ $hospitalProfile->name }}" 
                                 class="bg-white p-2 rounded-3 me-3" style="height: 55px; object-fit: contain;"
                                 onerror="this.style.display='none'">
                        @else
                            <div class="bg-white rounded-3 d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
                                <i class="fas fa-hospital text-navy fa-2x"></i>
                            </div>
                        @endif
                        <h4 class="mb-0 text-white fw-bold">
                            @if(isset($hospitalProfile))
                                {{ $hospitalProfile->name }}
                            @else
                                RSKB ROPANASURI
                            @endif
                        </h4>
                    </div>
                    <p class="mb-4 pe-lg-4 text-white-50" style="line-height: 1.8;">
                        @if(isset($hospitalProfile))
                            {{ Str::limit($hospitalProfile->description, 150) }}
                        @else
                            Memberikan pelayanan kesehatan terbaik dengan fasilitas modern dan tenaga medis profesional demi kesembuhan dan kenyamanan pasien.
                        @endif
                    </p>
                    <div class="social-links">
                        @if(isset($hospitalProfile) && $hospitalProfile->facebook)
                            <a href="{{ $hospitalProfile->facebook }}" target="_blank" aria-label="Facebook">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                        @endif
                        @if(isset($hospitalProfile) && $hospitalProfile->instagram)
                            <a href="{{ $hospitalProfile->instagram }}" target="_blank" aria-label="Instagram">
                                <i class="fab fa-instagram"></i>
                            </a>
                        @endif
                        @if(isset($hospitalProfile) && $hospitalProfile->tiktok)
                            <a href="{{ $hospitalProfile->tiktok }}" target="blank" aria-label="TikTok">
                                <i class="fab fa-tiktok"></i>
                            </a>
                        @endif
                        @if(isset($hospitalProfile) && $hospitalProfile->youtube)
                            <a href="{{ $hospitalProfile->youtube }}" target="_blank" aria-label="YouTube">
                                <i class="fab fa-youtube"></i>
                            </a>
                        @endif
                    </div>
                </div>
                
                <div class="col-lg-2 col-md-6">
                    <h5>Tautan Cepat</h5>
                    <ul class="list-unstyled mt-4">
                        <li class="mb-2"><a href="{{ route('home') }}"><i class="fas fa-chevron-right me-2 small text-teal"></i>Beranda</a></li>
                        <li class="mb-2"><a href="{{ route('about') }}"><i class="fas fa-chevron-right me-2 small text-teal"></i>Tentang Kami</a></li>
                        <li class="mb-2"><a href="{{ route('services') }}"><i class="fas fa-chevron-right me-2 small text-teal"></i>Layanan</a></li>
                        <li class="mb-2"><a href="{{ route('doctors') }}"><i class="fas fa-chevron-right me-2 small text-teal"></i>Jadwal Dokter</a></li>
                        <li class="mb-2"><a href="{{ route('contact') }}"><i class="fas fa-chevron-right me-2 small text-teal"></i>Kontak</a></li>
                    </ul>
                </div>
                
                <div class="col-lg-3 col-md-6">
                    <h5>Informasi Kontak</h5>
                    <ul class="list-unstyled mt-4">
                        <li class="mb-3 d-flex align-items-start">
                            <i class="fas fa-map-marker-alt mt-1 me-3 text-teal"></i> 
                            <span class="text-white-50">
                                @if(isset($hospitalProfile))
                                    {{ $hospitalProfile->address }}
                                @else
                                    Jl. Aur No.8 Ujung Gurun, Kota Padang
                                @endif
                            </span>
                        </li>
                        <li class="mb-3 d-flex align-items-center">
                            <i class="fas fa-phone-alt me-3 text-teal"></i> 
                            <span class="text-white-50">
                                @if(isset($hospitalProfile))
                                    {{ $hospitalProfile->phone }}
                                @else
                                    (0751) 31938
                                @endif
                            </span>
                        </li>
                        <li class="mb-3 d-flex align-items-center">
                            <i class="fas fa-envelope me-3 text-teal"></i> 
                            <span class="text-white-50">
                                @if(isset($hospitalProfile))
                                    {{ $hospitalProfile->email }}
                                @else
                                    rskbropanasuri@gmail.com
                                @endif
                            </span>
                        </li>
                    </ul>
                </div>
                
                <div class="col-lg-3 col-md-6">
                    <h5>Jam Operasional</h5>
                    <ul class="list-unstyled mt-4">
                        <li class="mb-2 d-flex justify-content-between border-bottom border-secondary pb-2">
                            <span class="text-white-50">Senin - Jumat</span>
                            <span class="text-white fw-medium">07:00 - 21:00</span>
                        </li>
                        <li class="mb-2 d-flex justify-content-between border-bottom border-secondary pb-2">
                            <span class="text-white-50">Sabtu</span>
                            <span class="text-white fw-medium">07:00 - 18:00</span>
                        </li>
                        <!-- <li class="mb-2 d-flex justify-content-between border-bottom border-secondary pb-2">
                            <span class="text-white-50">Minggu</span>
                            <span class="text-white fw-medium">08:00 - 16:00</span>
                        </li> -->
                        <li class="mt-4">
                            <div class="d-inline-flex align-items-center justify-content-center px-4 py-2 bg-danger text-white rounded-3 fw-bold w-100 shadow-sm">
                                <i class="fas fa-ambulance me-2"></i> IGD 24 Jam
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            
            <div class="footer-bottom">
                <div class="row align-items-center">
                    <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                        <p class="mb-0 text-white-50">
                            &copy; {{ date('Y') }} 
                            <span class="text-white fw-bold">
                                @if(isset($hospitalProfile))
                                    {{ $hospitalProfile->name }}
                                @else
                                    RSKB Ropanasuri
                                @endif
                            </span>. Hak Cipta Dilindungi.
                        </p>
                    </div>
                    <div class="col-md-6 text-center text-md-end">
                        <a href="{{ route('privacy') }}" class="me-3 small text-white-50 text-decoration-none hover-teal transition-all">Kebijakan Privasi</a>
                        <a href="{{ route('terms') }}" class="small text-white-50 text-decoration-none hover-teal transition-all">Syarat & Ketentuan</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Cookie Consent & Basic Bot Protection Banner -->
    <div id="cookieConsentBanner" class="cookie-banner bg-navy text-white shadow-lg">
        <div class="container py-3 py-md-4">
            <div class="row align-items-center">
                <div class="col-md-9 mb-3 mb-md-0">
                    <div class="d-flex align-items-start">
                        <i class="fas fa-shield-alt fs-2 text-teal me-3 mt-1"></i>
                        <div>
                            <h6 class="fw-bold mb-1 text-white">Verifikasi Keamanan & Penggunaan Cookie</h6>
                            <p class="mb-0 small text-white-50 lh-base">
                                Kami menggunakan sistem perlindungan terhadap bot otomatis dan *cookies* untuk memastikan keamanan data Anda serta mengoptimalkan layanan kami. Dengan melanjutkan penelusuran, Anda memverifikasi bahwa Anda adalah manusia dan menyetujui <a href="{{ route('privacy') }}" class="text-teal hover-teal text-decoration-none fw-bold">Kebijakan Privasi</a> kami.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 text-md-end text-center">
                    <button id="acceptCookies" class="btn btn-teal rounded-pill px-4 py-2 fw-bold hover-lift w-100">
                        <i class="fas fa-check-circle me-2"></i> Saya Setuju
                    </button>
                </div>
            </div>
        </div>
    </div>

    <style>
        .cookie-banner {
            position: fixed;
            bottom: -150px;
            left: 0;
            width: 100%;
            background-color: #0F3460; /* Explicit Navy Background */
            color: #ffffff; /* Explicit White Text */
            z-index: 9999;
            transition: bottom 0.6s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            border-top: 4px solid #16a085; /* Teal border */
            visibility: hidden;
            box-shadow: 0 -5px 20px rgba(0,0,0,0.15);
        }
        .cookie-banner.show {
            bottom: 0;
            visibility: visible;
        }
        .cookie-banner h6 {
            color: #ffffff !important;
        }
        .cookie-banner p {
            color: rgba(255, 255, 255, 0.7) !important;
        }
        .cookie-banner .text-teal {
            color: #16a085 !important;
        }
        .cookie-banner .btn-teal {
            background-color: #16a085;
            color: #fff;
            border: none;
            box-shadow: 0 4px 6px rgba(22, 160, 133, 0.2);
        }
        .cookie-banner .btn-teal:hover {
            background-color: #12876f;
            color: #fff;
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(22, 160, 133, 0.3);
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Basic Anti-Bot Detection (Headless Browsers)
            const isBot = navigator.webdriver || 
                          window.navigator.userAgent.indexOf("bot") !== -1 || 
                          window.navigator.userAgent.indexOf("spider") !== -1;
            
            if (isBot) {
                console.warn('Peringatan: Sistem mendeteksi kemungkinan bot. Beberapa fitur mungkin dinonaktifkan demi keamanan.');
            }

            // Check if user has already accepted cookies/security check
            if (!localStorage.getItem('security_cookies_accepted')) {
                // Show banner after a slight delay
                setTimeout(function() {
                    document.getElementById('cookieConsentBanner').classList.add('show');
                }, 1500);
            }

            // Accept button handler
            document.getElementById('acceptCookies').addEventListener('click', function() {
                // Save to localStorage
                localStorage.setItem('security_cookies_accepted', 'true');
                
                // Hide banner
                document.getElementById('cookieConsentBanner').style.bottom = '-150px';
                setTimeout(function() {
                    document.getElementById('cookieConsentBanner').classList.remove('show');
                }, 600);
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>