<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@if(isset($hospitalProfile)){{ $hospitalProfile->name }} - @endif @yield('title', 'Rumah Sakit')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    
    <!-- Favicon -->
    @if(isset($hospitalProfile) && $hospitalProfile->logo)
        <link rel="icon" type="image/png" href="{{ asset('storage/' . $hospitalProfile->logo) }}">
        <link rel="apple-touch-icon" href="{{ asset('storage/' . $hospitalProfile->logo) }}">
    @else
        <!-- Default favicon jika tidak ada logo -->
        <link rel="icon" type="image/x-icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90'>🏥</text></svg>">
    @endif
    <meta name="description" content="@if(isset($hospitalProfile)){{ Str::limit($hospitalProfile->description, 160) }}@else{Rumah Sakit terpercaya dengan pelayanan kesehatan berkualitas.@endif">
    <style>
        :root {
            --primary-color: #42a1db; /* Biru cerah yang lebih soft */
            --primary-light: #69cae8; /* Biru lebih terang */
            --secondary-color: #eef5fc;
            --success-color: #68b4e2; /* Hijau cerah */
            --warning-color: #FFC107; /* Kuning cerah */
            --danger-color: #DC3545; /* Merah cerah */
            --info-color: #b81717; /* Biru tosca cerah */
            --light-color: #F8F9FA;
            --dark-color: #343A40;
            --bg-light: #FFFFFF;
            --text-dark: #2C3E50;
            --text-light: #6C757D;
        }
        
        /* Navbar dengan gradient cerah */
        .navbar {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-light) 100%) !important;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
        }
        
        .navbar-brand {
            font-weight: bold;
            font-size: 1.5rem;
        }
        
        .navbar-nav .nav-link {
            color: white !important;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .navbar-nav .nav-link:hover,
        .navbar-nav .nav-link.active {
            color: #24e4f1 !important; /* menu navbar */
            transform: translateY(-2px);
        }
        
        /* Hero Section dengan background cerah BG di beranda */
        .hero-section {
            background: linear-gradient(135deg, rgba(50, 245, 109, 0.575) 0%, rgba(25, 190, 212, 0.815) 100%), 
                        url('{{ asset('storage/gallery/bgberandaa.jpeg') }}');
            background-size: cover;
            background-position: center;
            color: white;
            padding: 120px 0;
            position: relative;
        }
        
        /* Button styles yang lebih cerah */
        .btn-primary {
            background: linear-gradient(135deg, var(--primary-color), var(--primary-light));
            border: none;
            border-radius: 25px;
            padding: 12px 30px;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(74, 144, 226, 0.4);
        }
        
        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(74, 144, 226, 0.6);
            background: linear-gradient(135deg, var(--primary-light), var(--primary-color));
        }
        
        .btn-outline-primary {
            border: 2px solid var(--primary-color);
            color: var(--primary-color);
            border-radius: 25px;
            padding: 10px 28px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .btn-outline-primary:hover {
            background: var(--primary-color);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(74, 144, 226, 0.3);
        }
        
        /* Card styles yang lebih cerah */
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
            background: white;
        }
        
        .card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 35px rgba(0,0,0,0.15);
        }
        
        .card-header {
            background: linear-gradient(135deg, var(--primary-color), var(--primary-light));
            color: white;
            border-radius: 15px 15px 0 0 !important;
            border: none;
            padding: 20px;
        }
        
        /* Footer yang lebih cerah */
        .footer {
            background: linear-gradient(135deg, #2C3E50 0%, #4A6572 100%);
            color: white;
            padding: 50px 0 20px;
        }
        
        .footer h5 {
            color: #e1f1f1; /* Gold untuk judul footer */
            margin-bottom: 20px;
        }
        
        .footer a {
            color: #E0E0E0;
            text-decoration: none;
            transition: color 0.3s ease;
        }
        
        .footer a:hover {
            color: #FFD700;
        }
        
        /* Social media icons */
        .social-links a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            background: rgba(255,255,255,0.1);
            border-radius: 50%;
            transition: all 0.3s ease;
        }
        
        .social-links a:hover {
            background: var(--primary-color);
            transform: translateY(-3px);
        }
        
        /* Badge styles */
        .badge {
            border-radius: 12px;
            padding: 8px 15px;
            font-weight: 600;
        }
        
        .bg-primary {
            background: linear-gradient(135deg, var(--primary-color), var(--primary-light)) !important;
        }
        
        /* Section backgrounds */
        .bg-light {
            background-color: #F8F9FF !important; /* Light blue background */
        }
        
        /* Text colors */
        .text-primary {
            color: var(--primary-color) !important;
        }
        
        /* Alert styles */
        .alert {
            border: none;
            border-radius: 12px;
            border-left: 4px solid;
        }
        
        .alert-success {
            background: linear-gradient(135deg, #d4edda, #c3e6cb);
            border-left-color: var(--success-color);
        }
        
        .alert-info {
            background: linear-gradient(135deg, #d1ecf1, #bee5eb);
            border-left-color: var(--info-color);
        }
        
        /* Table styles */
        .table thead th {
            background: linear-gradient(135deg, var(--primary-color), var(--primary-light));
            color: white;
            border: none;
            padding: 15px;
        }
        
        .table tbody tr:hover {
            background-color: rgba(74, 144, 226, 0.05);
        }
        
        /* Custom utilities */
        .rounded-lg {
            border-radius: 15px !important;
        }
        
        .shadow-soft {
            box-shadow: 0 5px 20px rgba(0,0,0,0.08) !important;
        }
        
        .shadow-medium {
            box-shadow: 0 10px 30px rgba(0,0,0,0.12) !important;
        }
        
        /* Loading spinner */
        .spinner-border.text-primary {
            color: var(--primary-color) !important;
        }
        
        /* Responsive adjustments */
        @media (max-width: 768px) {
            .hero-section {
                padding: 80px 0;
            }
            
            .btn {
                padding: 10px 20px;
            }
        }
    </style>
    @stack('styles')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary sticky-top">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">
            @if(isset($hospitalProfile) && $hospitalProfile->logo)
                <img src="{{ asset('storage/' . $hospitalProfile->logo) }}" 
                     alt="{{ $hospitalProfile->name }}" 
                     height="40" 
                     class="me-2" 
                     style="object-fit: contain;">
            @endif
            @if(isset($hospitalProfile))
                {{ $hospitalProfile->name }}
            @else
                RS Sehat Sentosa
            @endif
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
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
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}" href="{{ route('contact') }}">Kontak</a>
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
            <div class="row">
                <div class="col-lg-4 col-md-6 mb-4">
                    <h5 class="mb-3">
                        @if(isset($hospitalProfile) && $hospitalProfile->logo)
                            <img src="{{ asset('storage/' . $hospitalProfile->logo) }}" 
                                 alt="{{ $hospitalProfile->name }}" 
                                 class="logo-img" style="height: 35px;">
                        @else
                            <i class="fas fa-heartbeat me-2"></i>
                        @endif
                        @if(isset($hospitalProfile))
                            {{ $hospitalProfile->name }}
                        @else
                            RSKB ROPANASURI
                        @endif
                    </h5>
                    <p>
                        @if(isset($hospitalProfile))
                            {{ Str::limit($hospitalProfile->description, 150) }}
                        @else
                            Memberikan pelayanan kesehatan terbaik dengan tim medis profesional dan fasilitas lengkap.
                        @endif
                    </p>
                    <div class="social-links">
                        @if(isset($hospitalProfile) && $hospitalProfile->facebook)
                            <a href="{{ $hospitalProfile->facebook }}" class="text-light me-3" target="_blank">
                                <i class="fab fa-facebook fa-lg"></i>
                            </a>
                        @endif
                        @if(isset($hospitalProfile) && $hospitalProfile->instagram)
                            <a href="{{ $hospitalProfile->instagram }}" class="text-light me-3" target="_blank">
                                <i class="fab fa-instagram fa-lg"></i>
                            </a>
                        @endif
                        @if(isset($hospitalProfile) && $hospitalProfile->tiktok)
                            <a href="{{ $hospitalProfile->tiktok }}" class="text-light me-3" target="blank">
                                <i class="fab fa-tiktok fa-lg"></i>
                            </a>
                        @endif
                        @if(isset($hospitalProfile) && $hospitalProfile->youtube)
                            <a href="{{ $hospitalProfile->youtube }}" class="text-light" target="_blank">
                                <i class="fab fa-youtube fa-lg"></i>
                            </a>
                        @endif
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 mb-4">
                    <h5>Quick Links</h5>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('home') }}" class="text-light text-decoration-none">Beranda</a></li>
                        <li><a href="{{ route('about') }}" class="text-light text-decoration-none">Tentang Kami</a></li>
                        <li><a href="{{ route('services') }}" class="text-light text-decoration-none">Layanan</a></li>
                        <li><a href="{{ route('doctors') }}" class="text-light text-decoration-none">Dokter</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <h5>Kontak</h5>
                    <ul class="list-unstyled">
                        @if(isset($hospitalProfile))
                            <li><i class="fas fa-map-marker-alt me-2"></i> {{ $hospitalProfile->address }}</li>
                            <li><i class="fas fa-phone me-2"></i> {{ $hospitalProfile->phone }}</li>
                            <li><i class="fas fa-envelope me-2"></i> {{ $hospitalProfile->email }}</li>
                        @else
                            <li><i class="fas fa-map-marker-alt me-2"></i> Jl. Kesehatan No. 123, Jakarta</li>
                            <li><i class="fas fa-phone me-2"></i> (021) 123-4567</li>
                            <li><i class="fas fa-envelope me-2"></i> info@rumahsakit.com</li>
                        @endif
                        <li><i class="fas fa-clock me-2"></i> 24 Jam</li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <h5>Jam Operasional</h5>
                    <ul class="list-unstyled">
                        <li>Senin - Jumat: 07:00 - 21:00</li>
                        <li>Sabtu: 07:00 - 18:00</li>
                        <li>Minggu: 08:00 - 16:00</li>
                        <li><strong>IGD: 24 Jam</strong></li>
                    </ul>
                </div>
            </div>
            <hr class="my-4">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <p class="mb-0">
                        &copy; {{ date('Y') }} 
                        @if(isset($hospitalProfile))
                            {{ $hospitalProfile->name }}
                        @else
                            RSKB ROPANASURI
                        @endif
                        . All rights reserved.
                    </p>
                </div>
                <div class="col-md-6 text-md-end">
                    <a href="#" class="text-light text-decoration-none me-3">Privacy Policy</a>
                    <a href="#" class="text-light text-decoration-none">Terms of Service</a>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>