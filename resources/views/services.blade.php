@extends('layouts.app')

@section('title', 'Layanan Rumah Sakit')

@section('content')
<style>
    :root {
        --color-navy: #0F3460;
        --color-teal: #16a085;
        --color-teal-light: #e8f6f3;
        --glass-bg: rgba(255, 255, 255, 0.9);
        --glass-border: rgba(255, 255, 255, 0.2);
    }

    /* Hero Banner */
    .services-hero {
        position: relative;
        padding: 100px 0 80px 0;
        background: linear-gradient(135deg, var(--color-navy) 0%, #1a1a2e 100%);
        color: white;
        text-align: center;
        overflow: hidden;
    }
    
    .services-hero::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: url('{{ asset('storage/gallery/PK1.jpg') }}') center/cover;
        opacity: 0.15;
        z-index: 1;
    }
    
    .services-hero::after {
        content: '';
        position: absolute;
        bottom: 0; left: 0; right: 0;
        height: 40px;
        background: white;
        border-radius: 50% 50% 0 0 / 100% 100% 0 0;
        z-index: 2;
        transform: scaleX(1.1);
    }

    .hero-content-wrapper {
        position: relative;
        z-index: 2;
    }

    .hero-badge-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 15px;
        margin-top: 2rem;
    }

    .hero-badge {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        color: white;
        font-weight: 500;
        padding: 10px 20px;
        border-radius: 30px;
        font-size: 0.95rem;
    }

    /* Section Titles */
    .section-title {
        color: var(--color-navy);
        font-weight: 700;
        font-size: 2.2rem;
        margin-bottom: 0.5rem;
    }

    .section-subtitle {
        color: #6c757d;
        font-size: 1.1rem;
        max-width: 600px;
        margin: 0 auto;
    }

    /* Service Cards */
    .service-card {
        background: white;
        border-radius: 20px;
        border: 1px solid #f0f0f0;
        box-shadow: 0 10px 30px rgba(0,0,0,0.03);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .service-card::after {
        content: '';
        position: absolute;
        bottom: 0; left: 0; width: 100%; height: 3px;
        background: var(--color-teal);
        transform: scaleX(0);
        transition: transform 0.3s ease;
    }

    .service-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 35px rgba(15, 52, 96, 0.08);
        border-color: var(--color-teal);
    }
    
    .service-card:hover::after {
        transform: scaleX(1);
    }

    .service-icon-wrapper {
        background: var(--color-teal-light);
        width: 80px; height: 80px;
        border-radius: 16px;
        display: inline-flex;
        align-items: center; justify-content: center;
        margin-bottom: 20px;
        transition: all 0.3s ease;
    }

    .service-card:hover .service-icon-wrapper {
        background: var(--color-teal);
        transform: scale(1.05) rotate(5deg);
    }

    .service-card:hover .icon-emoji {
        filter: brightness(0) invert(1);
    }

    .icon-emoji {
        font-size: 2rem;
        transition: all 0.3s ease;
    }

    .service-title {
        color: var(--color-navy);
        font-weight: 700;
        font-size: 1.25rem;
        margin-bottom: 1rem;
    }

    .service-description {
        color: #6c757d;
        line-height: 1.6;
        flex-grow: 1;
    }

    .service-meta {
        border-top: 1px dashed #e9ecef;
        padding-top: 1rem;
        margin-top: 1rem;
    }

    /* Emergency Section */
    .emergency-wrapper {
        background: linear-gradient(135deg, #1a1a2e 0%, var(--color-navy) 100%);
        border-radius: 20px;
        position: relative;
        overflow: hidden;
        padding: 3rem;
        color: white;
    }

    .emergency-wrapper::before {
        content: '';
        position: absolute;
        top: -50%; right: -20%; width: 50%; height: 200%;
        background: radial-gradient(circle, rgba(22, 160, 133, 0.4) 0%, rgba(0,0,0,0) 70%);
        z-index: 1;
    }

    .emergency-content {
        position: relative;
        z-index: 2;
    }

    .emergency-badge {
        background: rgba(220, 53, 69, 0.9); /* Red */
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255,255,255,0.2);
        border-radius: 20px;
        padding: 2rem;
        box-shadow: 0 10px 30px rgba(220, 53, 69, 0.3);
        text-align: center;
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .contact-bubble {
        background: rgba(255,255,255,0.1);
        border-radius: 30px;
        padding: 10px 25px;
        display: inline-flex;
        align-items: center;
        gap: 15px;
        margin-right: 15px;
        margin-bottom: 15px;
        border: 1px solid rgba(255,255,255,0.1);
    }
    
    .contact-bubble i {
        color: #ff6b6b;
    }

    /* Features Section */
    .feature-card {
        padding: 2.5rem 1.5rem;
        border-radius: 20px;
        background: #f8f9fa;
        height: 100%;
        transition: all 0.3s;
    }
    .feature-card:hover {
        background: white;
        box-shadow: 0 10px 25px rgba(0,0,0,0.05);
    }

    .feature-icon-box {
        width: 70px; height: 70px;
        background: white;
        color: var(--color-teal);
        border-radius: 15px;
        display: inline-flex; align-items: center; justify-content: center;
        margin-bottom: 20px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        font-size: 1.75rem;
        transition: all 0.3s;
    }
    
    .feature-card:hover .feature-icon-box {
        background: var(--color-teal);
        color: white;
        transform: translateY(-5px);
    }

    /* Modal Styles */
    .custom-modal .modal-content {
        border-radius: 20px;
        border: none;
        overflow: hidden;
    }
    .custom-modal .modal-header {
        background: var(--color-navy);
        color: white;
        border-bottom: none;
        padding: 1.5rem;
    }
    .custom-modal .btn-close {
        filter: invert(1) grayscale(100%) brightness(200%);
    }
    .custom-modal .modal-title-wrapper {
        display: flex;
        align-items: center;
    }
    .custom-modal .modal-icon {
        font-size: 2.5rem;
        margin-right: 15px;
        background: rgba(255,255,255,0.1);
        width: 60px; height: 60px;
        border-radius: 12px;
        display: flex; align-items: center; justify-content: center;
    }
    .modal-check-list li {
        padding: 10px 0;
        border-bottom: 1px dashed #eee;
    }
    .modal-check-list li:last-child { border-bottom: none; }

    /* Animations */
    .reveal {
        opacity: 0;
        transform: translateY(30px);
        transition: all 0.8s ease-out;
    }
    .reveal.active {
        opacity: 1;
        transform: translateY(0);
    }

</style>

<!-- Hero Section -->
<section class="services-hero">
    <div class="container hero-content-wrapper">
        <h6 class="text-uppercase fw-bold mb-3" style="color: var(--color-teal); letter-spacing: 3px;">Fasilitas Medis</h6>
        <h1 class="display-4 fw-bold mb-4">Layanan Kesehatan<br>Terpadu</h1>
        <p class="lead opacity-75 mx-auto" style="max-width: 600px;">
            Kami menyediakan berbagai layanan kesehatan dengan teknologi terkini dan tim medis profesional untuk memberikan perawatan terbaik.
        </p>
        <div class="hero-badge-container">
            <div class="hero-badge"><i class="fas fa-user-md text-info me-2"></i> Dokter Spesialis</div>
            <div class="hero-badge"><i class="fas fa-pills text-info me-2"></i> Farmasi 24 Jam</div>
            <div class="hero-badge"><i class="fas fa-ambulance text-danger me-2"></i> IGD 24 Jam</div>
        </div>
    </div>
</section>

<!-- Services Grid -->
<section class="py-5 bg-white">
    <div class="container py-4">
        <div class="text-center mb-5 reveal">
            <h2 class="section-title">Layanan Unggulan Kami</h2>
            <p class="section-subtitle">Berbagai layanan kesehatan komprehensif untuk menjawab kebutuhan medis Anda dan keluarga.</p>
        </div>

        <div class="row g-4">
            @foreach($services as $service)
            <div class="col-xl-4 col-md-6 reveal" style="transition-delay: {{ $loop->index * 0.1 }}s;">
                <div class="service-card p-4">
                    <div class="service-icon-wrapper">
                        <span class="icon-emoji">{{ $service->modern_icon }}</span>
                    </div>
                    <h4 class="service-title">{{ $service->name }}</h4>
                    <p class="service-description">{{ $service->description }}</p>
                    
                    <div class="service-meta d-flex justify-content-between align-items-center">
                        <div class="operational-hours small">
                            <i class="fas fa-clock" style="color: var(--color-teal);"></i>
                            <span class="text-muted ms-1">{{ $service->operational_hours }}</span>
                        </div>
                    </div>
                    
                    <div class="service-actions mt-3 d-flex gap-2">
                        <button class="btn btn-outline-secondary btn-sm flex-grow-1" data-bs-toggle="modal" data-bs-target="#serviceModal{{ $loop->index }}" style="border-radius: 8px;">
                            <i class="fas fa-info-circle me-1"></i> Detail
                        </button>
                        <a href="{{ route('contact') }}" class="btn btn-sm flex-grow-1 text-white" style="background-color: var(--color-teal); border: none; border-radius: 8px;">
                            <i class="fas fa-calendar-check me-1"></i> Daftar
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Emergency Section -->
<section class="py-5 bg-white reveal">
    <div class="container">
        <div class="emergency-wrapper shadow-lg">
            <div class="row align-items-center">
                <div class="col-lg-8 emergency-content mb-4 mb-lg-0">
                    <h6 class="text-uppercase fw-bold text-danger mb-2" style="letter-spacing: 2px;">Tindakan Kritis</h6>
                    <h3 class="fw-bold mb-3">Layanan Gawat Darurat 24 Jam</h3>
                    <p class="mb-4 opacity-75 fs-5">Tim tanggap darurat kami siap sedia melayani Anda kapan saja dengan respon cepat dan peralatan penunjang hidup yang lengkap.</p>
                    
                    <div>
                        <div class="contact-bubble">
                            <i class="fas fa-phone-alt fa-lg"></i>
                            <span class="fw-bold fs-5">(021) 123-4567</span>
                        </div>
                        <div class="contact-bubble">
                            <i class="fas fa-ambulance fa-lg"></i>
                            <span class="fw-bold fs-5">119 (Emergency)</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 emergency-content">
                    <div class="emergency-badge">
                        <i class="fas fa-heartbeat fa-4x text-white mb-3"></i>
                        <h2 class="text-white fw-bold mb-0">24/7</h2>
                        <p class="text-white mb-0 opacity-75 text-uppercase" style="letter-spacing: 2px;">Siap Siaga</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="py-5 bg-white mb-4 reveal">
    <div class="container">
        <div class="row g-4 text-center">
            <div class="col-md-4">
                <div class="feature-card">
                    <div class="feature-icon-box">
                        <i class="fas fa-user-md"></i>
                    </div>
                    <h5 class="fw-bold" style="color: var(--color-navy);">Dokter Ahli</h5>
                    <p class="text-muted mb-0">Tim dokter spesialis berlisensi dengan jam terbang tinggi di disiplin ilmunya masing-masing.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card">
                    <div class="feature-icon-box">
                        <i class="fas fa-microscope"></i>
                    </div>
                    <h5 class="fw-bold" style="color: var(--color-navy);">Teknologi Modern</h5>
                    <p class="text-muted mb-0">Dilengkapi dengan instrumen diagnostik terkini untuk memastikan akurasi perawatan klinis.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card">
                    <div class="feature-icon-box">
                        <i class="fas fa-hand-holding-heart"></i>
                    </div>
                    <h5 class="fw-bold" style="color: var(--color-navy);">Pelayanan Hangat</h5>
                    <p class="text-muted mb-0">Perawat dan staf medis kami melayani dengan senyum dan empati bagaikan keluarga sendiri.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Service Modals -->
@foreach($services as $service)
<div class="modal fade custom-modal" id="serviceModal{{ $loop->index }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title-wrapper">
                    <span class="modal-icon">{{ $service->modern_icon }}</span>
                    <div>
                        <h4 class="modal-title fw-bold mb-1">{{ $service->name }}</h4>
                        <p class="mb-0 opacity-75"><i class="fas fa-clock me-2"></i>{{ $service->operational_hours }}</p>
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4 p-md-5">
                <h6 class="fw-bold text-uppercase mb-3" style="color: var(--color-navy);">Deskripsi Layanan</h6>
                <p class="text-muted fs-5 mb-4" style="line-height: 1.8;">{{ $service->description }}</p>
                
                <div class="bg-light p-4 rounded-4">
                    <h6 class="fw-bold text-uppercase mb-3" style="color: var(--color-navy);">Fasilitas yang Tersedia</h6>
                    <ul class="list-unstyled modal-check-list text-muted mb-0">
                        <li><i class="fas fa-check-circle me-3" style="color: var(--color-teal);"></i>Konsultasi eksklusif dengan dokter spesialis</li>
                        <li><i class="fas fa-check-circle me-3" style="color: var(--color-teal);"></i>Pemeriksaan fisik dan diagnostik komprehensif</li>
                        <li><i class="fas fa-check-circle me-3" style="color: var(--color-teal);"></i>Perawatan intensif dan observasi berkala</li>
                        <li><i class="fas fa-check-circle me-3" style="color: var(--color-teal);"></i>Fasilitas resep obat (Farmasi) terpadu</li>
                    </ul>
                </div>
            </div>
            <div class="modal-footer border-0 p-4 pt-0 justify-content-between bg-white">
                <button type="button" class="btn btn-light px-4" data-bs-dismiss="modal" style="border-radius: 8px;">Kembali</button>
                <a href="{{ route('contact') }}" class="btn text-white px-4" style="background-color: var(--color-teal); border-radius: 8px;">
                    <i class="fas fa-calendar-check me-2"></i> Buat Janji Temu
                </a>
            </div>
        </div>
    </div>
</div>
@endforeach

<!-- Scroll Animation Script -->
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
        revealOnScroll(); // Trigger immediately on load
    });
</script>
@endsection