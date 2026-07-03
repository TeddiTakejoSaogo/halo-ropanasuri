@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
<style>
    :root {
        --color-navy: #0F3460;
        --color-teal: #16a085;
        --color-teal-light: #e8f6f3;
        --glass-bg: rgba(255, 255, 255, 0.9);
        --glass-border: rgba(255, 255, 255, 0.2);
    }

    /* Hero Section */
    .hero-section {
        position: relative;
        padding: 120px 0 80px 0;
        color: white;
        overflow: hidden;
        background: url('{{ asset('storage/gallery/bgberandaa.jpeg') }}') center/cover no-repeat;
    }
    
    .hero-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, rgba(15, 52, 96, 0.6) 0%, rgba(26, 26, 46, 0.7) 100%);
        z-index: 1;
    }

    .hero-section::after {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(22,160,133,0.15) 0%, rgba(0,0,0,0) 70%);
        z-index: 1;
        animation: pulseBg 15s ease-in-out infinite alternate;
    }

    .hero-content {
        position: relative;
        z-index: 2;
    }

    .hero-stats {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 20px;
        padding: 30px;
        margin-top: 50px;
        box-shadow: 0 15px 35px rgba(0,0,0,0.2);
        animation: fadeUp 1.2s ease forwards;
    }

    .btn-teal {
        background-color: var(--color-teal);
        color: white;
        border: none;
        transition: all 0.3s ease;
    }
    .btn-teal:hover {
        background-color: #12876f;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(22, 160, 133, 0.3);
    }

    .btn-outline-glass {
        background: rgba(255, 255, 255, 0.1);
        color: white;
        border: 1px solid rgba(255, 255, 255, 0.3);
        backdrop-filter: blur(5px);
        transition: all 0.3s ease;
    }
    .btn-outline-glass:hover {
        background: white;
        color: var(--color-navy);
        transform: translateY(-2px);
    }

    /* Custom Cards */
    .feature-card {
        background: white;
        border-radius: 16px;
        padding: 30px 20px;
        text-align: center;
        border: none;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        height: 100%;
        position: relative;
        overflow: hidden;
    }
    
    .feature-card::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 4px;
        background: var(--color-teal);
        transform: scaleX(0);
        transform-origin: left;
        transition: transform 0.4s ease;
    }

    .feature-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(15, 52, 96, 0.1);
    }
    
    .feature-card:hover::after {
        transform: scaleX(1);
    }

    .icon-wrapper {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 20px;
        background: var(--color-teal-light);
        color: var(--color-teal);
        transition: all 0.4s ease;
    }

    .feature-card:hover .icon-wrapper {
        background: var(--color-teal);
        color: white;
        transform: rotateY(180deg);
    }

    /* About Section */
    .about-image-wrapper {
        position: relative;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 20px 40px rgba(0,0,0,0.1);
    }
    .about-image-wrapper::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        box-shadow: inset 0 0 0 1px rgba(255,255,255,0.2);
        z-index: 2;
        border-radius: 20px;
    }

    .badge-float {
        position: absolute;
        bottom: 20px;
        left: -20px;
        background: var(--glass-bg);
        backdrop-filter: blur(10px);
        padding: 15px 25px;
        border-radius: 12px;
        box-shadow: 0 15px 35px rgba(0,0,0,0.1);
        border: 1px solid var(--glass-border);
        z-index: 3;
        animation: floatY 4s ease-in-out infinite;
    }

    /* Partners Marquee Styles */
    .partners-marquee {
        overflow: hidden;
        position: relative;
        background: #ffffff;
        padding: 40px 0;
    }
    
    .partners-marquee::before,
    .partners-marquee::after {
        content: '';
        position: absolute;
        top: 0;
        width: 150px;
        height: 100%;
        z-index: 2;
    }
    .partners-marquee::before {
        left: 0;
        background: linear-gradient(to right, rgba(255,255,255,1) 0%, rgba(255,255,255,0) 100%);
    }
    .partners-marquee::after {
        right: 0;
        background: linear-gradient(to left, rgba(255,255,255,1) 0%, rgba(255,255,255,0) 100%);
    }

    .marquee-content {
        display: flex;
        animation: marquee 30s linear infinite;
        align-items: center;
    }

    .partner-item {
        flex: 0 0 auto;
        margin: 0 30px;
        padding: 15px 25px;
        background: white;
        border-radius: 12px;
        border: 1px solid #f0f0f0;
        transition: all 0.3s ease;
    }
    .partner-item:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.05);
        border-color: var(--color-teal);
    }
    .partner-item img {
        height: 50px;
        width: auto;
        object-fit: contain;
        filter: grayscale(100%) opacity(0.7);
        transition: all 0.3s ease;
    }
    .partner-item:hover img {
        filter: grayscale(0%) opacity(1);
    }

    /* Section Headings */
    .section-title {
        color: var(--color-navy);
        font-weight: 700;
        position: relative;
        display: inline-block;
        margin-bottom: 40px;
    }
    .section-title::after {
        content: '';
        position: absolute;
        bottom: -10px;
        left: 50%;
        transform: translateX(-50%);
        width: 50px;
        height: 3px;
        background: var(--color-teal);
        border-radius: 3px;
    }

    /* Animations */
    @keyframes marquee { 0% { transform: translateX(0); } 100% { transform: translateX(-50%); } }
    @keyframes fadeUp { from { opacity: 0; transform: translateY(30px); } to { opacity: 1; transform: translateY(0); } }
    @keyframes floatY { 0%, 100% { transform: translateY(0); } 50% { transform: translateY(-10px); } }
    @keyframes pulseBg { 0% { opacity: 0.5; transform: scale(1); } 100% { opacity: 1; transform: scale(1.1); } }

    .reveal {
        opacity: 0;
        transform: translateY(30px);
        transition: all 0.8s ease-out;
    }
    .reveal.active {
        opacity: 1;
        transform: translateY(0);
    }
    
    /* Stats Box in About */
    .stat-box {
        background: white;
        border: 1px solid #edf2f7;
        border-radius: 12px;
        padding: 20px 10px;
        text-align: center;
        transition: all 0.3s ease;
    }
    .stat-box:hover {
        border-color: var(--color-teal);
        box-shadow: 0 10px 20px rgba(22, 160, 133, 0.1);
        transform: translateY(-5px);
    }
    .stat-box h5 {
        color: var(--color-navy);
        font-weight: 800;
        font-size: 1.5rem;
    }

    /* Certificate Box */
    .certificate-box {
        background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
        border: 1px solid #e9ecef;
        border-radius: 20px;
        padding: 30px;
        text-align: center;
        position: relative;
        overflow: hidden;
    }
    .certificate-box::before {
        content: '\f0a3';
        font-family: "Font Awesome 5 Free";
        font-weight: 900;
        position: absolute;
        font-size: 150px;
        color: rgba(22, 160, 133, 0.03);
        top: -20px;
        right: -20px;
        transform: rotate(15deg);
    }
</style>

<!-- Hero Section -->
<section class="hero-section text-center">
    <div class="container hero-content">
        <div class="row justify-content-center">
            <div class="col-lg-9">
                <h1 class="display-4 fw-bold mb-4" style="line-height: 1.2;">
                    Selamat Datang di<br> 
                    <span style="color: var(--color-teal);">
                        @if(isset($hospitalProfile))
                            {{ $hospitalProfile->name }}
                        @else
                            Rumah Sakit Kami
                        @endif
                    </span>
                </h1>
                <p class="lead mb-5 fs-5" style="color: rgba(255,255,255,0.85);">
                    "Profesional, Berintegritas, Responsif, dan Fokus Pada Keselamatan Pasien"
                </p>
                <div class="d-flex flex-wrap justify-content-center gap-3">
                    <a href="{{ route('services') }}" class="btn btn-teal btn-lg px-5 py-3 rounded-pill fw-bold">
                        <i class="fas fa-procedures me-2"></i>Lihat Layanan
                    </a>
                    <a href="{{ route('doctors') }}" class="btn btn-outline-glass btn-lg px-5 py-3 rounded-pill fw-bold">
                        <i class="fas fa-user-md me-2"></i>Dokter Kami
                    </a>
                    <a href="https://wa.me/628116600013?text=DAFTAR" target="_blank" class="btn btn-lg px-5 py-3 rounded-pill fw-bold text-white shadow" style="background-color: #25D366; border: none; transition: all 0.3s ease;" onmouseover="this.style.transform='translateY(-3px)'; this.style.boxShadow='0 10px 20px rgba(37, 211, 102, 0.3)';" onmouseout="this.style.transform='none'; this.style.boxShadow='var(--bs-box-shadow)';">
                        <i class="fab fa-whatsapp me-2"></i>Daftar
                    </a>
                </div>
                
                <!-- Quick Stats Glassmorphism -->
                <div class="hero-stats">
                    <div class="row">
                        <div class="col-md-3 col-6 mb-3 mb-md-0 border-end border-light border-opacity-25">
                            <h2 class="fw-bold mb-0 text-white">20+</h2>
                            <span class="text-light opacity-75 small text-uppercase letter-spacing-1">Dokter Spesialis</span>
                        </div>
                        <div class="col-md-3 col-6 mb-3 mb-md-0 border-end border-light border-opacity-25">
                            <h2 class="fw-bold mb-0 text-white">24/7</h2>
                            <span class="text-light opacity-75 small text-uppercase letter-spacing-1">Layanan IGD</span>
                        </div>
                        <div class="col-md-3 col-6 border-end border-light border-opacity-25">
                            <h2 class="fw-bold mb-0 text-white">12+</h2>
                            <span class="text-light opacity-75 small text-uppercase letter-spacing-1">Kamar Rawat</span>
                        </div>
                        <div class="col-md-3 col-6">
                            <h2 class="fw-bold mb-0 text-white">35+</h2>
                            <span class="text-light opacity-75 small text-uppercase letter-spacing-1">Thn Pengalaman</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- About Preview -->
<section class="py-5 bg-light position-relative" style="overflow-x: hidden;">
    <div class="container py-4">
        <div class="row align-items-center reveal">
            <div class="col-lg-6 mb-5 mb-lg-0 pe-lg-5">
                <h6 class="text-uppercase fw-bold mb-2" style="color: var(--color-teal); letter-spacing: 2px;">Tentang Kami</h6>
                <h2 class="display-6 fw-bold mb-4" style="color: var(--color-navy);">
                    @if(isset($hospitalProfile))
                        {{ $hospitalProfile->name }}
                    @else
                        Rumah Sakit Kami
                    @endif
                </h2>
                <p class="text-muted mb-4 fs-5 lh-lg">
                    @if(isset($hospitalProfile) && $hospitalProfile->description)
                        {{ $hospitalProfile->description }}
                    @else
                        Rumah Sakit kami telah melayani masyarakat dengan dedikasi tinggi dalam memberikan pelayanan kesehatan yang berkualitas. Dengan tim medis yang profesional dan fasilitas yang lengkap, kami berkomitmen untuk memberikan perawatan terbaik bagi pasien.
                    @endif
                </p>
                <div class="row text-center mb-4 g-3">
                    <div class="col-4">
                        <div class="stat-box">
                            <i class="fas fa-user-md fa-2x mb-2" style="color: var(--color-teal);"></i>
                            <h5 class="mb-0">20+</h5>
                            <small class="text-muted">Spesialis</small>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="stat-box">
                            <i class="fas fa-procedures fa-2x mb-2" style="color: var(--color-navy);"></i>
                            <h5 class="mb-0">12+</h5>
                            <small class="text-muted">Kamar</small>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="stat-box">
                            <i class="fas fa-users fa-2x mb-2" style="color: #f39c12;"></i>
                            <h5 class="mb-0">10K+</h5>
                            <small class="text-muted">Pasien/Thn</small>
                        </div>
                    </div>
                </div>
                <div class="mt-2">
                    <a href="{{ route('about') }}" class="btn btn-teal px-4 py-2 me-2 rounded-pill">Selengkapnya</a>
                    <a href="{{ route('contact') }}" class="btn btn-outline-dark px-4 py-2 rounded-pill">Hubungi Kami</a>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="about-image-wrapper position-relative">
                    @if(isset($hospitalProfile) && $hospitalProfile->logo)
                        <div class="text-center bg-white rounded-4 p-4 h-100 d-flex align-items-center justify-content-center">
                            <img src="{{ asset('storage/' . $hospitalProfile->logo) }}" 
                                alt="{{ $hospitalProfile->name }}" 
                                class="img-fluid" 
                                style="max-height: 400px; object-fit: contain;"
                                onerror="this.style.display='none'">
                        </div>
                    @else
                        <img src="https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?auto=format&fit=crop&w=800&q=80" 
                            alt="Rumah Sakit" 
                            class="img-fluid w-100"
                            style="height: 400px; object-fit: cover;">
                    @endif
                    
                    <div class="badge-float d-flex align-items-center">
                        <div class="me-3 bg-white rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px; color: var(--color-teal);">
                            <i class="fas fa-award fa-lg"></i>
                        </div>
                        <div>
                            <h6 class="mb-0 fw-bold" style="color: var(--color-navy);">Terpercaya</h6>
                            <small class="text-muted">Sejak 1988</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Specialists Section -->
<section class="py-5 bg-white">
    <div class="container py-4">
        <div class="text-center mb-5 reveal">
            <h6 class="text-uppercase fw-bold mb-2" style="color: var(--color-teal); letter-spacing: 2px;">Layanan Medis</h6>
            <h2 class="section-title">Dokter Spesialis</h2>
            <p class="text-muted mx-auto" style="max-width: 600px;">Tim dokter ahli kami yang berdedikasi tinggi siap memberikan penanganan medis komprehensif di berbagai bidang spesialisasi.</p>
        </div>
        
        <div class="row g-4 reveal">
            <div class="col-lg-3 col-md-4 col-6 mb-4">
                <div class="feature-card">
                    <div class="icon-wrapper">
                        <i class="fas fa-lungs fa-2x"></i>
                    </div>
                    <h5 class="fw-bold" style="color: var(--color-navy);">Jantung</h5>
                    <p class="text-muted small mb-0">Spesialis Jantung</p>
                </div>
            </div>

            <div class="col-lg-3 col-md-4 col-6 mb-4">
                <div class="feature-card">
                    <div class="icon-wrapper">
                        <i class="fas fa-heart fa-2x"></i>
                    </div>
                    <h5 class="fw-bold" style="color: var(--color-navy);">Bedah</h5>
                    <p class="text-muted small mb-0">Spesialis Bedah</p>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-4 col-6 mb-4">
                <div class="feature-card">
                    <div class="icon-wrapper">
                        <i class="fa-solid fa-person-dots-from-line fa-2x"></i>
                    </div>
                    <h5 class="fw-bold" style="color: var(--color-navy);">Penyakit Dalam</h5>
                    <p class="text-muted small mb-0">Spesialis Penyakit Dalam</p>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-4 col-6 mb-4">
                <div class="feature-card">
                    <div class="icon-wrapper">
                        <i class="fa-solid fa-head-side-mask fa-2x"></i>
                    </div>
                    <h5 class="fw-bold" style="color: var(--color-navy);">THT</h5>
                    <p class="text-muted small mb-0">Spesialis THT</p>
                </div>
            </div>

            <div class="col-lg-3 col-md-4 col-6 mb-4">
                <div class="feature-card">
                    <div class="icon-wrapper">
                        <i class="fa-solid fa-brain fa-2x"></i>
                    </div>
                    <h5 class="fw-bold" style="color: var(--color-navy);">Onkologi</h5>
                    <p class="text-muted small mb-0">Spesialis Onkologi</p>
                </div>
            </div>

            <div class="col-lg-3 col-md-4 col-6 mb-4">
                <div class="feature-card">
                    <div class="icon-wrapper">
                        <i class="fas fa-baby fa-2x"></i>
                    </div>
                    <h5 class="fw-bold" style="color: var(--color-navy);">Urologi</h5>
                    <p class="text-muted small mb-0">Spesialis Urologi</p>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-4 col-6 mb-4">
                <div class="feature-card">
                    <div class="icon-wrapper">
                        <i class="fa-solid fa-pills fa-2x"></i>
                    </div>
                    <h5 class="fw-bold" style="color: var(--color-navy);">Orthopedi</h5>
                    <p class="text-muted small mb-0">Spesialis Orthopedi</p>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-4 col-6 mb-4 d-flex align-items-center justify-content-center">
                <a href="{{ route('doctors') }}" class="text-decoration-none" style="color: var(--color-teal); font-weight: 600;">
                    Lihat Semua <i class="fas fa-arrow-right ms-2"></i>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Accreditation Section -->
<section class="py-5 bg-light border-top border-bottom">
    <div class="container py-4">
        <div class="text-center mb-5 reveal">
            <h6 class="text-uppercase fw-bold mb-2" style="color: var(--color-teal); letter-spacing: 2px;">Kualitas Teruji</h6>
            <h2 class="section-title">Akreditasi & Sertifikasi</h2>
            <p class="text-muted mx-auto" style="max-width: 700px;">Bukti nyata komitmen kami dalam memberikan standar pelayanan kesehatan bermutu tinggi dan berorientasi pada keselamatan pasien sepenuhnya.</p>
        </div>

        <div class="row align-items-center reveal">
            <div class="col-lg-6 mb-5 mb-lg-0 pe-lg-5">
                <h3 class="fw-bold mb-4" style="color: var(--color-navy);">Standar Mutu Pelayanan</h3>
                
                <div class="d-flex mb-4">
                    <div class="me-3 mt-1">
                        <div class="bg-white shadow-sm rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; color: var(--color-teal);">
                            <i class="fas fa-user-shield"></i>
                        </div>
                    </div>
                    <div>
                        <h5 class="fw-bold mb-1">Patient-Centered Care</h5>
                        <p class="text-muted">Pelayanan berfokus pada kebutuhan personal, nilai, dan standar keselamatan prioritas pasien.</p>
                    </div>
                </div>

                <div class="d-flex mb-4">
                    <div class="me-3 mt-1">
                        <div class="bg-white shadow-sm rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; color: var(--color-teal);">
                            <i class="fas fa-stethoscope"></i>
                        </div>
                    </div>
                    <div>
                        <h5 class="fw-bold mb-1">Clinical Excellence</h5>
                        <p class="text-muted">Penerapan standar klinis tertinggi yang didukung oleh sumber daya medis dan keperawatan handal.</p>
                    </div>
                </div>

                <div class="d-flex mb-4">
                    <div class="me-3 mt-1">
                        <div class="bg-white shadow-sm rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; color: var(--color-teal);">
                            <i class="fas fa-sync-alt"></i>
                        </div>
                    </div>
                    <div>
                        <h5 class="fw-bold mb-1">Continuous Improvement</h5>
                        <p class="text-muted">Komitmen penuh pada peningkatan mutu berkelanjutan secara sistematis dan komprehensif.</p>
                    </div>
                </div>

                <div class="d-flex mb-4">
                    <div class="me-3 mt-1">
                        <div class="bg-white shadow-sm rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; color: var(--color-teal);">
                            <i class="fas fa-award"></i>
                        </div>
                    </div>
                    <div>
                        <h5 class="fw-bold mb-1">Penghargaan Bintang 5 BPJS</h5>
                        <p class="text-muted">Komitmen FKRTL dalam Implementasi Integrasi Sistem Antrean Online, Sistem Klaim, E-SEP, Farmasi, dan Bridging RME.</p>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-6 text-center">
                <div class="certificate-box shadow-sm">
                    <div class="row align-items-center mb-4">
                        <div class="col-6 border-end px-md-4">
                            <div class="mb-3 d-flex justify-content-center" style="height: 260px; align-items: center;">
                                <img src="{{ asset('storage/gallery/logokars.png') }}" alt="Logo KARS" class="img-fluid" style="max-height: 100%; object-fit: contain;">
                            </div>
                            <h5 class="fw-bold" style="color: var(--color-navy);">PARIPURNA</h5>
                            <p class="text-muted small mb-0">Akreditasi KARS</p>
                        </div>
                        <div class="col-6 px-md-4">
                            <div class="mb-3 d-flex justify-content-center" style="height: 260px; align-items: center;">
                                <img src="{{ asset('storage/gallery/piagam-bpjs.png') }}" alt="Piagam BPJS" class="img-fluid shadow-sm rounded" style="max-height: 100%; object-fit: contain; border: 1px solid #eaebed;">
                            </div>
                            <h5 class="fw-bold" style="color: var(--color-navy);">BINTANG 5</h5>
                            <p class="text-muted small mb-0">Penghargaan BPJS</p>
                        </div>
                    </div>
                    
                    <div class="row border-top pt-4 mt-2">
                        <div class="col-4 border-end">
                            <h4 class="fw-bold mb-0" style="color: var(--color-teal);">99%</h4>
                            <small class="text-muted fw-semibold">Kepuasan</small>
                        </div>
                        <div class="col-4 border-end">
                            <h4 class="fw-bold mb-0" style="color: var(--color-teal);">24/7</h4>
                            <small class="text-muted fw-semibold">Pelayanan</small>
                        </div>
                        <div class="col-4">
                            <h4 class="fw-bold mb-0" style="color: var(--color-teal);">A</h4>
                            <small class="text-muted fw-semibold">Fasilitas</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Partners & Insurance Section -->
<section class="py-5 bg-white">
    <div class="container py-4">
        <div class="text-center mb-5 reveal">
            <h6 class="text-uppercase fw-bold mb-2" style="color: var(--color-teal); letter-spacing: 2px;">Kemitraan</h6>
            <h2 class="section-title">Mitra & Asuransi</h2>
            <p class="text-muted mx-auto" style="max-width: 600px;">Kami bekerja sama dengan berbagai perusahaan asuransi dan korporasi terkemuka untuk memastikan kemudahan akses kesehatan Anda.</p>
        </div>
        
        <!-- Logo Marquee -->
        <div class="partners-marquee mb-5 reveal">
            <div class="marquee-content">
                @for ($i = 1; $i <= 24; $i++)
                    <div class="partner-item">
                        <img src="{{ asset('storage/gallery/logo1 (' . $i . ').jpg') }}" alt="Asuransi {{ $i }}" onerror="this.style.display='none'">
                    </div>
                @endfor
                <!-- Duplicate for seamless scrolling -->
                @for ($i = 1; $i <= 24; $i++)
                    <div class="partner-item" aria-hidden="true">
                        <img src="{{ asset('storage/gallery/logo1 (' . $i . ').jpg') }}" alt="Asuransi {{ $i }}" onerror="this.style.display='none'">
                    </div>
                @endfor
            </div>
        </div>

        <!-- Insurance Features -->
        <div class="row g-4 reveal">
            <div class="col-md-4">
                <div class="card border-0 bg-light rounded-4 p-4 h-100 text-center transition-hover">
                    <div class="bg-white rounded-circle d-inline-flex align-items-center justify-content-center mx-auto mb-4 shadow-sm" style="width: 70px; height: 70px; color: var(--color-navy);">
                        <i class="fas fa-shield-alt fa-2x"></i>
                    </div>
                    <h5 class="fw-bold" style="color: var(--color-navy);">Jaringan Luas</h5>
                    <p class="text-muted mb-0">Menerima puluhan jenis asuransi swasta maupun BPJS Kesehatan untuk rawat jalan & inap.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 bg-light rounded-4 p-4 h-100 text-center transition-hover">
                    <div class="bg-white rounded-circle d-inline-flex align-items-center justify-content-center mx-auto mb-4 shadow-sm" style="width: 70px; height: 70px; color: var(--color-teal);">
                        <i class="fas fa-file-invoice-dollar fa-2x"></i>
                    </div>
                    <h5 class="fw-bold" style="color: var(--color-navy);">Klaim Mudah</h5>
                    <p class="text-muted mb-0">Proses administrasi klaim asuransi yang terpadu, cepat, dan transparan bagi pasien.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 bg-light rounded-4 p-4 h-100 text-center transition-hover">
                    <div class="bg-white rounded-circle d-inline-flex align-items-center justify-content-center mx-auto mb-4 shadow-sm" style="width: 70px; height: 70px; color: #f39c12;">
                        <i class="fas fa-headset fa-2x"></i>
                    </div>
                    <h5 class="fw-bold" style="color: var(--color-navy);">Layanan Terpadu</h5>
                    <p class="text-muted mb-0">Tim khusus melayani pendaftaran dan informasi pertanggungan asuransi Anda.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Script for Scroll Animation -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const reveals = document.querySelectorAll(".reveal");
        
        function revealOnScroll() {
            for (let i = 0; i < reveals.length; i++) {
                const windowHeight = window.innerHeight;
                const elementTop = reveals[i].getBoundingClientRect().top;
                const elementVisible = 100;
                
                if (elementTop < windowHeight - elementVisible) {
                    reveals[i].classList.add("active");
                }
            }
        }
        
        window.addEventListener("scroll", revealOnScroll);
        revealOnScroll(); // Trigger on load
    });
</script>

<style>
    .transition-hover {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .transition-hover:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.08) !important;
    }
</style>
@endsection