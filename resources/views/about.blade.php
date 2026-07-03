@extends('layouts.app')

@section('title', 'Tentang Kami')

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
    .about-hero {
        position: relative;
        padding: 100px 0 80px 0;
        background: linear-gradient(135deg, var(--color-navy) 0%, #1a1a2e 100%);
        color: white;
        text-align: center;
        overflow: hidden;
    }
    
    .about-hero::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: url('{{ asset('storage/gallery/bgabout.jpg') }}') center/cover;
        opacity: 0.15;
        z-index: 1;
    }
    
    .about-hero::after {
        content: '';
        position: absolute;
        bottom: 0; left: 0; right: 0;
        height: 40px;
        background: white;
        border-radius: 50% 50% 0 0 / 100% 100% 0 0;
        z-index: 2;
        transform: scaleX(1.1);
    }

    .about-hero-content {
        position: relative;
        z-index: 2;
    }

    /* History Section */
    .history-card {
        background: white;
        border-radius: 20px;
        border: none;
        box-shadow: 0 20px 40px rgba(0,0,0,0.05);
        overflow: hidden;
    }
    
    .history-icon-box {
        background: var(--color-teal-light);
        color: var(--color-teal);
        width: 120px; height: 120px;
        border-radius: 50%;
        display: inline-flex;
        align-items: center; justify-content: center;
        margin-bottom: 15px;
        transition: all 0.4s ease;
    }
    
    .history-card:hover .history-icon-box {
        transform: scale(1.1);
        box-shadow: 0 10px 20px rgba(22, 160, 133, 0.2);
    }

    /* Stats Cards */
    .stat-card {
        background: white;
        border-radius: 16px;
        padding: 30px 20px;
        border: 1px solid #f0f0f0;
        box-shadow: 0 10px 30px rgba(0,0,0,0.03);
        transition: all 0.3s ease;
        text-align: center;
        height: 100%;
    }
    
    .stat-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 35px rgba(15, 52, 96, 0.08);
        border-color: var(--color-teal);
    }

    .stat-icon {
        width: 70px; height: 70px;
        border-radius: 50%;
        display: inline-flex;
        align-items: center; justify-content: center;
        margin-bottom: 20px;
        font-size: 1.5rem;
    }
    
    /* Services Grid */
    .service-box {
        background: #fcfcfc;
        border-radius: 16px;
        padding: 25px;
        border: 1px solid #f0f0f0;
        transition: all 0.3s ease;
        height: 100%;
    }
    
    .service-box:hover {
        background: white;
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.08);
        border-color: var(--color-teal);
    }
    
    .service-box .icon-circle {
        width: 60px; height: 60px;
        border-radius: 12px;
        display: inline-flex;
        align-items: center; justify-content: center;
        margin-right: 20px;
        font-size: 1.5rem;
        transition: all 0.3s;
    }
    
    .service-box:hover .icon-circle {
        background: var(--color-teal) !important;
        color: white !important;
    }

    /* Vision Mission */
    .vm-card {
        border-radius: 20px;
        border: none;
        overflow: hidden;
        height: 100%;
        box-shadow: 0 15px 35px rgba(0,0,0,0.05);
        transition: transform 0.3s ease;
    }
    
    .vm-card:hover {
        transform: translateY(-5px);
    }
    
    .vm-header {
        padding: 25px;
        color: white;
        position: relative;
        overflow: hidden;
    }
    
    .vm-header::after {
        content: '';
        position: absolute;
        top: 0; left: 0; width: 100%; height: 100%;
        background: linear-gradient(45deg, rgba(255,255,255,0.1), transparent);
    }

    .mission-list li {
        position: relative;
        padding-left: 35px;
        margin-bottom: 15px;
        line-height: 1.6;
    }
    
    .mission-list li i {
        position: absolute;
        left: 0; top: 3px;
        color: var(--color-teal);
        background: var(--color-teal-light);
        width: 24px; height: 24px;
        border-radius: 50%;
        display: flex;
        align-items: center; justify-content: center;
        font-size: 0.7rem;
    }

    /* Contact & Location */
    .contact-item {
        display: flex;
        align-items: flex-start;
        margin-bottom: 25px;
        padding-bottom: 20px;
        border-bottom: 1px dashed #e9ecef;
    }
    .contact-item:last-child {
        border-bottom: none;
        margin-bottom: 0; padding-bottom: 0;
    }
    
    .contact-item .icon {
        width: 50px; height: 50px;
        background: var(--color-teal-light);
        color: var(--color-teal);
        border-radius: 12px;
        display: flex; align-items: center; justify-content: center;
        margin-right: 20px;
        font-size: 1.25rem;
        flex-shrink: 0;
    }

    .hours-list li {
        padding: 12px 15px;
        border-radius: 8px;
        margin-bottom: 10px;
        background: #f8f9fa;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .hours-list li.highlight {
        background: rgba(22, 160, 133, 0.1);
        border: 1px solid rgba(22, 160, 133, 0.2);
    }

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

<!-- Hero Banner -->
<section class="about-hero">
    <div class="container about-hero-content">
        <h6 class="text-uppercase fw-bold mb-3" style="color: var(--color-teal); letter-spacing: 3px;">Profil Kami</h6>
        <h1 class="display-4 fw-bold mb-4">Mengenal Lebih Dekat<br>Layanan Kami</h1>
        <p class="lead opacity-75 mx-auto" style="max-width: 600px;">
            Menjadi pelopor pelayanan kesehatan bermutu yang berorientasi penuh pada kenyamanan dan keselamatan Anda.
        </p>
    </div>
</section>

<div class="container py-5">
    
    <!-- Sejarah -->
    <div class="row mb-5 reveal">
        <div class="col-12">
            <div class="history-card">
                <div class="card-body p-5">
                    <div class="row align-items-center">
                        <div class="col-lg-8 mb-4 mb-lg-0 pe-lg-5">
                            <h3 class="fw-bold mb-4" style="color: var(--color-navy);">
                                <i class="fas fa-history text-muted opacity-50 me-2"></i>Sejarah Perjalanan Kami
                            </h3>
                            <p class="text-muted fs-5" style="line-height: 1.8; text-align: justify;">
                                @if(isset($hospitalProfile))
                                    {{ $hospitalProfile->history }}
                                @else
                                    Rumah Sakit Kami didirikan pada tahun 1990 dengan misi memberikan pelayanan kesehatan 
                                    yang berkualitas kepada masyarakat. Selama lebih dari 30 tahun, kami telah berkembang 
                                    menjadi rumah sakit terpercaya dengan fasilitas modern dan tim medis yang profesional.
                                    Dari awal yang sederhana, kami terus berinovasi dan berkembang untuk memenuhi kebutuhan
                                    kesehatan masyarakat dengan standar pelayanan tertinggi.
                                @endif
                            </p>
                        </div>
                        <div class="col-lg-4 text-center border-start border-light d-none d-lg-block">
                            <div class="history-icon-box">
                                <i class="fas fa-hospital fa-3x"></i>
                            </div>
                            <h4 class="fw-bold" style="color: var(--color-navy);">30+ Tahun</h4>
                            <p class="text-muted mb-0">Melayani Masyarakat dengan Sepenuh Hati</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pencapaian & Statistik -->
    <div class="row mb-5 py-4 reveal">
        <div class="col-12 text-center mb-5">
            <h6 class="text-uppercase fw-bold mb-2" style="color: var(--color-teal); letter-spacing: 2px;">Jejak Langkah</h6>
            <h3 class="fw-bold" style="color: var(--color-navy);">Pencapaian Kami</h3>
            <p class="text-muted mx-auto" style="max-width: 500px;">Bukti nyata dari dedikasi dan komitmen kami dalam memberikan pelayanan klinis terbaik.</p>
        </div>
        
        <div class="col-md-3 col-6 mb-4">
            <div class="stat-card">
                <div class="stat-icon bg-primary bg-opacity-10 text-primary mx-auto">
                    <i class="fas fa-user-md"></i>
                </div>
                <h2 class="fw-bold text-primary mb-1">20+</h2>
                <p class="text-muted mb-0 fw-semibold">Dokter Spesialis</p>
            </div>
        </div>
        
        <div class="col-md-3 col-6 mb-4">
            <div class="stat-card">
                <div class="stat-icon bg-success bg-opacity-10 text-success mx-auto">
                    <i class="fas fa-procedures"></i>
                </div>
                <h2 class="fw-bold text-success mb-1">100+</h2>
                <p class="text-muted mb-0 fw-semibold">Bedah Sukses</p>
            </div>
        </div>
        
        <div class="col-md-3 col-6 mb-4">
            <div class="stat-card">
                <div class="stat-icon" style="background: rgba(243, 156, 18, 0.1); color: #f39c12; margin: 0 auto 20px auto;">
                    <i class="fas fa-smile"></i>
                </div>
                <h2 class="fw-bold mb-1" style="color: #f39c12;">10K+</h2>
                <p class="text-muted mb-0 fw-semibold">Pasien Puas</p>
            </div>
        </div>
        
        <div class="col-md-3 col-6 mb-4">
            <div class="stat-card">
                <div class="stat-icon bg-info bg-opacity-10 text-info mx-auto">
                    <i class="fas fa-award"></i>
                </div>
                <h2 class="fw-bold text-info mb-1">15+</h2>
                <p class="text-muted mb-0 fw-semibold">Penghargaan</p>
            </div>
        </div>
    </div>

    <!-- Fasilitas Unggulan / Pelayanan -->
    <div class="row mb-5 reveal">
        <div class="col-12 text-center mb-5">
            <h6 class="text-uppercase fw-bold mb-2" style="color: var(--color-teal); letter-spacing: 2px;">Fasilitas Medis</h6>
            <h3 class="fw-bold" style="color: var(--color-navy);">Pelayanan Kami</h3>
            <p class="text-muted mx-auto" style="max-width: 600px;">Lingkup kegiatan dan fasilitas medis unggulan yang tersedia di RSK Bedah Ropanasuri.</p>
        </div>
        
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="service-box d-flex flex-column h-100">
                <div class="d-flex align-items-center mb-3">
                    <div class="icon-circle bg-danger bg-opacity-10 text-danger">
                        <i class="fas fa-ambulance"></i>
                    </div>
                    <h5 class="fw-bold mb-0" style="color: var(--color-navy);">IGD 24 JAM</h5>
                </div>
                <p class="text-muted mb-0 mt-auto">Instalasi Gawat Darurat RSK Bedah Ropanasuri melayani 24 jam kasus kegawatdaruratan yang mengancam jiwa secara responsif.</p>
            </div>
        </div>

        <div class="col-lg-4 col-md-6 mb-4">
            <div class="service-box d-flex flex-column h-100">
                <div class="d-flex align-items-center mb-3">
                    <div class="icon-circle bg-success bg-opacity-10 text-success">
                        <i class="fa-solid fa-hand-holding-medical"></i>
                    </div>
                    <h5 class="fw-bold mb-0" style="color: var(--color-navy);">POLIKLINIK</h5>
                </div>
                <p class="text-muted mb-0 mt-auto">Pelayanan rawat jalan paripurna yang didukung langsung oleh dokter-dokter spesialis berpengalaman di bidangnya masing-masing.</p>
            </div>
        </div>

        <div class="col-lg-4 col-md-6 mb-4">
            <div class="service-box d-flex flex-column h-100">
                <div class="d-flex align-items-center mb-3">
                    <div class="icon-circle bg-info bg-opacity-10 text-info">
                        <i class="fa-solid fa-head-side-virus"></i>
                    </div>
                    <h5 class="fw-bold mb-0" style="color: var(--color-navy);">BEDAH ANESTESI</h5>
                </div>
                <p class="text-muted mb-0 mt-auto">Fasilitas Kamar Operasi standar akreditasi tinggi dengan peralatan medis mutakhir dan tim medis kompeten.</p>
            </div>
        </div>

        <div class="col-lg-4 col-md-6 mb-4">
            <div class="service-box d-flex flex-column h-100">
                <div class="d-flex align-items-center mb-3">
                    <div class="icon-circle bg-primary bg-opacity-10 text-primary">
                        <i class="fas fa-heartbeat"></i>
                    </div>
                    <h5 class="fw-bold mb-0" style="color: var(--color-navy);">BEDAH MINOR</h5>
                </div>
                <p class="text-muted mb-0 mt-auto">Fasilitas pembedahan ringan dengan sistem <em>"One Day Care"</em> untuk kepulangan pasien yang lebih cepat dan nyaman.</p>
            </div>
        </div>

        <div class="col-lg-4 col-md-6 mb-4">
            <div class="service-box d-flex flex-column h-100">
                <div class="d-flex align-items-center mb-3">
                    <div class="icon-circle" style="background: rgba(243, 156, 18, 0.1); color: #f39c12;">
                        <i class="fas fa-baby"></i>
                    </div>
                    <h5 class="fw-bold mb-0" style="color: var(--color-navy);">KEMOTERAPI</h5>
                </div>
                <p class="text-muted mb-0 mt-auto">Pelayanan modalitas penanganan kanker/tumor dengan sistem pengobatan terpadu sebagai pendukung pasca pembedahan.</p>
            </div>
        </div>

        <div class="col-lg-4 col-md-6 mb-4">
            <div class="service-box d-flex flex-column h-100">
                <div class="d-flex align-items-center mb-3">
                    <div class="icon-circle text-white" style="background: var(--color-navy);">
                        <i class="fa-solid fa-laptop-medical"></i>
                    </div>
                    <h5 class="fw-bold mb-0" style="color: var(--color-navy);">INTENSIVE CARE (ICU)</h5>
                </div>
                <p class="text-muted mb-0 mt-auto">Ruang perawatan intensif berteknologi tinggi untuk pengawasan ketat terhadap pasien kritis atau pasca operasi besar.</p>
            </div>
        </div>

        <div class="col-lg-4 col-md-6 mb-4">
            <div class="service-box d-flex flex-column h-100">
                <div class="d-flex align-items-center mb-3">
                    <div class="icon-circle bg-secondary bg-opacity-10 text-secondary">
                        <i class="fa-solid fa-stethoscope"></i>
                    </div>
                    <h5 class="fw-bold mb-0" style="color: var(--color-navy);">PENUNJANG MEDIS</h5>
                </div>
                <p class="text-muted mb-0 mt-auto">Layanan laboratorium, radiologi, dan farmasi komprehensif guna memastikan diagnosa klinis yang akurat.</p>
            </div>
        </div>

        <div class="col-lg-4 col-md-6 mb-4">
            <div class="service-box d-flex flex-column h-100">
                <div class="d-flex align-items-center mb-3">
                    <div class="icon-circle bg-warning bg-opacity-10 text-warning">
                        <i class="fa-solid fa-user-doctor"></i>
                    </div>
                    <h5 class="fw-bold mb-0" style="color: var(--color-navy);">DOKTER SPESIALIS</h5>
                </div>
                <p class="text-muted mb-0 mt-auto">Konsultasi pakar bersama dokter spesialis, subspesialis, dan terapis berlisensi resmi.</p>
            </div>
        </div>

        <div class="col-lg-4 col-md-6 mb-4">
            <div class="service-box d-flex flex-column h-100">
                <div class="d-flex align-items-center mb-3">
                    <div class="icon-circle" style="background: rgba(111, 66, 193, 0.1); color: #6f42c1;">
                        <i class="fa-solid fa-bed-pulse"></i>
                    </div>
                    <h5 class="fw-bold mb-0" style="color: var(--color-navy);">RAWAT INAP</h5>
                </div>
                <p class="text-muted mb-0 mt-auto">Fasilitas akomodasi medis yang nyaman dan tenang, dirancang khusus untuk mempercepat masa pemulihan.</p>
            </div>
        </div>
    </div>

    <!-- Visi & Misi -->
    <div class="row mb-5 py-4 reveal">
        <div class="col-md-6 mb-4 mb-md-0">
            <div class="vm-card bg-white">
                <div class="vm-header" style="background: var(--color-navy);">
                    <h3 class="mb-0 fw-bold"><i class="fas fa-eye me-3 opacity-75"></i>Visi Kami</h3>
                </div>
                <div class="card-body p-4 p-lg-5">
                    <p class="fs-5 text-muted" style="line-height: 1.8;">
                        @if(isset($hospitalProfile))
                            {{ $hospitalProfile->vision }}
                        @else
                            Menjadi rumah sakit pilihan utama masyarakat dengan pelayanan kesehatan 
                            berkualitas internasional yang terjangkau dan berkelanjutan.
                        @endif
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="vm-card bg-white">
                <div class="vm-header" style="background: var(--color-teal);">
                    <h3 class="mb-0 fw-bold"><i class="fas fa-bullseye me-3 opacity-75"></i>Misi Kami</h3>
                </div>
                <div class="card-body p-4 p-lg-5">
                    <ul class="list-unstyled mission-list text-muted mb-0">
                        @if(isset($hospitalProfile))
                            @php
                                $missions = is_array($hospitalProfile->mission) 
                                    ? $hospitalProfile->mission 
                                    : explode("\n", $hospitalProfile->mission);
                            @endphp
                            @foreach(array_filter($missions) as $mission)
                                <li>
                                    <i class="fas fa-check"></i>
                                    {{ trim($mission) }}
                                </li>
                            @endforeach
                        @else
                            <li><i class="fas fa-check"></i> Memberikan pelayanan kesehatan yang bermutu</li>
                            <li><i class="fas fa-check"></i> Mengutamakan kepuasan pasien</li>
                            <li><i class="fas fa-check"></i> Mengembangkan sumber daya manusia yang profesional</li>
                            <li><i class="fas fa-check"></i> Memiliki teknologi medis yang terkini</li>
                            <li><i class="fas fa-check"></i> Berperan aktif dalam penelitian kesehatan</li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Lokasi & Kontak -->
    <div class="row reveal">
        <div class="col-12">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                <div class="row g-0">
                    <div class="col-lg-7 p-4 p-lg-5">
                        <h3 class="fw-bold mb-4" style="color: var(--color-navy);">Informasi Kontak</h3>
                        <div class="pe-lg-4">
                            <div class="contact-item">
                                <div class="icon"><i class="fas fa-map-marker-alt"></i></div>
                                <div>
                                    <h6 class="fw-bold mb-1">Alamat</h6>
                                    <p class="text-muted mb-0">
                                        @if(isset($hospitalProfile))
                                            {{ $hospitalProfile->address }}
                                        @else
                                            Jl. Kesehatan No. 123, Jakarta Pusat 10110
                                        @endif
                                    </p>
                                </div>
                            </div>
                            
                            <div class="contact-item">
                                <div class="icon"><i class="fas fa-phone"></i></div>
                                <div>
                                    <h6 class="fw-bold mb-1">Telepon</h6>
                                    <p class="text-muted mb-0">
                                        @if(isset($hospitalProfile))
                                            {{ $hospitalProfile->phone }}
                                        @else
                                            (021) 123-4567
                                        @endif
                                    </p>
                                </div>
                            </div>
                            
                            <div class="contact-item border-0 pb-0">
                                <div class="icon"><i class="fas fa-envelope"></i></div>
                                <div>
                                    <h6 class="fw-bold mb-1">Email</h6>
                                    <p class="text-muted mb-0">
                                        @if(isset($hospitalProfile))
                                            {{ $hospitalProfile->email }}
                                        @else
                                            info@rumahsakit.com
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5 p-4 p-lg-5 bg-light border-start">
                        <h3 class="fw-bold mb-4" style="color: var(--color-navy);">Jam Operasional</h3>
                        <ul class="list-unstyled hours-list mb-0">
                            <li>
                                <span class="text-muted fw-semibold">Senin - Jumat</span>
                                <strong style="color: var(--color-navy);">07:00 - 21:00</strong>
                            </li>
                            <li>
                                <span class="text-muted fw-semibold">Sabtu</span>
                                <strong style="color: var(--color-navy);">07:00 - 18:00</strong>
                            </li>
                            <li>
                                <span class="text-muted fw-semibold">Minggu</span>
                                <strong style="color: var(--color-navy);">08:00 - 16:00</strong>
                            </li>
                            <li class="highlight mt-3">
                                <span class="fw-bold text-dark"><i class="fas fa-ambulance me-2" style="color: var(--color-teal);"></i>IGD & Apotek</span>
                                <strong class="text-danger">24 Jam</strong>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div>

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