@extends('layouts.app')

@section('title', 'Layanan Homecare')

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
    .homecare-hero {
        position: relative;
        padding: 100px 0 80px 0;
        background: linear-gradient(135deg, var(--color-navy) 0%, #1a1a2e 100%);
        color: white;
        overflow: hidden;
    }
    
    .homecare-hero::before {
        content: '';
        position: absolute;
        top: 0; left: 0; width: 100%; height: 100%;
        background: url('https://images.unsplash.com/photo-1579684385127-1ef15d508118?auto=format&fit=crop&w=1920&q=80') center/cover;
        opacity: 0.15;
        z-index: 1;
    }
    
    .homecare-hero::after {
        content: '';
        position: absolute;
        bottom: 0; left: 0; right: 0;
        height: 40px;
        background: #f8f9fa; /* Matches the next section's bg */
        border-radius: 50% 50% 0 0 / 100% 100% 0 0;
        z-index: 2;
        transform: scaleX(1.1);
    }

    .hero-content {
        position: relative;
        z-index: 2;
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

    /* Benefits Section */
    .benefit-card {
        padding: 2.5rem 1.5rem;
        border-radius: 20px;
        background: white;
        box-shadow: 0 10px 30px rgba(0,0,0,0.03);
        transition: all 0.3s ease;
        height: 100%;
        border: 1px solid #f0f0f0;
    }

    .benefit-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 35px rgba(15, 52, 96, 0.08);
        border-color: var(--color-teal);
    }

    .benefit-icon {
        width: 80px; height: 80px;
        background: var(--color-teal-light);
        border-radius: 20px;
        display: inline-flex;
        align-items: center; justify-content: center;
        margin: 0 auto 1.5rem;
        transition: all 0.3s ease;
    }

    .benefit-card:hover .benefit-icon {
        background: var(--color-teal);
        transform: scale(1.05) rotate(5deg);
    }

    .benefit-icon i {
        font-size: 2rem;
        color: var(--color-teal);
        transition: all 0.3s ease;
    }
    
    .benefit-card:hover .benefit-icon i {
        color: white;
    }

    /* Packages Section */
    .package-card {
        background: white;
        border-radius: 20px;
        overflow: hidden;
        border: 1px solid #f0f0f0;
        box-shadow: 0 10px 30px rgba(0,0,0,0.03);
        transition: all 0.3s ease;
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .package-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 40px rgba(15, 52, 96, 0.1);
        border-color: var(--color-teal);
    }

    .package-header {
        position: relative;
        height: 220px;
        overflow: hidden;
    }

    .package-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }
    
    .package-card:hover .package-image img {
        transform: scale(1.05);
    }

    .package-badge {
        position: absolute;
        top: 20px; right: 20px;
    }
    
    .package-badge .badge {
        background: var(--color-navy) !important;
        padding: 8px 15px;
        font-weight: 500;
        border-radius: 30px;
        font-size: 0.85rem;
        box-shadow: 0 4px 10px rgba(0,0,0,0.2);
    }

    .package-body {
        padding: 2rem;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }

    .package-title {
        font-size: 1.4rem;
        font-weight: 700;
        color: var(--color-navy);
        margin-bottom: 1rem;
    }

    .package-description {
        color: #6c757d;
        margin-bottom: 1.5rem;
        font-size: 0.95rem;
        line-height: 1.6;
    }

    .package-features {
        border-top: 1px dashed #e9ecef;
        border-bottom: 1px dashed #e9ecef;
        padding: 1.25rem 0;
        margin-bottom: 1.5rem;
        flex-grow: 1;
    }

    .feature-item {
        margin-bottom: 0.75rem;
        font-size: 0.95rem;
        color: #495057;
        display: flex;
        align-items: flex-start;
    }
    .feature-item i {
        margin-top: 4px;
    }

    .package-price {
        text-align: left;
    }

    .package-price .price {
        font-size: 2rem;
        font-weight: 800;
        color: var(--color-teal);
        margin-bottom: 0;
        line-height: 1;
    }

    .package-footer {
        padding: 0 2rem 2rem;
        display: flex;
        gap: 10px;
    }

    /* CTA Section */
    .cta-wrapper {
        background: linear-gradient(135deg, var(--color-navy) 0%, #1a1a2e 100%);
        border-radius: 20px;
        padding: 3.5rem 3rem;
        color: white;
        position: relative;
        overflow: hidden;
    }
    
    .cta-wrapper::after {
        content: '';
        position: absolute;
        top: -50%; right: -20%; width: 50%; height: 200%;
        background: radial-gradient(circle, rgba(22, 160, 133, 0.3) 0%, rgba(0,0,0,0) 70%);
        z-index: 1;
    }
    
    .cta-content {
        position: relative;
        z-index: 2;
    }

    /* FAQ Section */
    .accordion-item {
        border: 1px solid #f0f0f0;
        border-radius: 12px !important;
        margin-bottom: 15px;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0,0,0,0.02);
    }
    
    .accordion-button {
        padding: 1.25rem 1.5rem;
        font-weight: 600;
        color: var(--color-navy);
        background: white;
    }
    
    .accordion-button:not(.collapsed) {
        color: var(--color-navy);
        background: var(--color-teal-light);
        box-shadow: inset 0 -1px 0 rgba(0,0,0,.125);
    }
    
    .accordion-button:focus {
        border-color: rgba(22, 160, 133, 0.2);
        box-shadow: 0 0 0 0.25rem rgba(22, 160, 133, 0.1);
    }
    
    .accordion-button::after {
        filter: grayscale(1);
    }
    
    .accordion-body {
        padding: 1.5rem;
        color: #6c757d;
        line-height: 1.7;
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

<div class="homecare-page">
    <!-- Hero Section -->
    <section class="homecare-hero">
        <div class="container hero-content">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-5 mb-lg-0">
                    <h6 class="text-uppercase fw-bold mb-3" style="color: var(--color-teal); letter-spacing: 3px;">Perawatan di Rumah</h6>
                    <h1 class="display-4 fw-bold mb-4">Layanan Homecare<br>Profesional</h1>
                    <p class="lead opacity-75 mb-4" style="line-height: 1.8;">
                        Perawatan medis komprehensif di rumah dengan standar rumah sakit. Tim medis profesional kami siap melayani Anda kapan pun Anda membutuhkannya.
                    </p>
                    <div class="d-flex flex-wrap gap-3">
                        <a href="#packages" class="btn btn-light px-4 py-2" style="border-radius: 8px;">
                            <i class="fas fa-stethoscope me-2 text-primary"></i> Lihat Paket
                        </a>
                        <a href="https://wa.me/628116600013" target="_blank" class="btn text-white px-4 py-2" style="background-color: var(--color-teal); border-radius: 8px;">
                            <i class="fab fa-whatsapp me-2"></i> Konsultasi Gratis
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 text-center text-lg-end d-none d-lg-block">
                    <img src="{{ asset('storage/gallery/homecarebg.jpg') }}" alt="Homecare" class="img-fluid rounded-4 shadow-lg" style="max-height: 400px; object-fit: cover; border: 4px solid rgba(255,255,255,0.1);">
                </div>
            </div>
        </div>
    </section>

    <!-- Benefits Section -->
    <section class="py-5 bg-light">
        <div class="container py-4">
            <div class="row mb-5 reveal">
                <div class="col-12 text-center">
                    <h6 class="text-uppercase fw-bold mb-2" style="color: var(--color-teal); letter-spacing: 2px;">Nilai Tambah Kami</h6>
                    <h2 class="section-title">Mengapa Memilih Homecare Kami?</h2>
                    <p class="section-subtitle">Kami mendedikasikan diri untuk memberikan pelayanan perawatan terbaik demi kenyamanan Anda.</p>
                </div>
            </div>
            <div class="row g-4">
                <div class="col-lg-3 col-md-6 reveal" style="transition-delay: 0.1s;">
                    <div class="benefit-card text-center">
                        <div class="benefit-icon"><i class="fas fa-user-md"></i></div>
                        <h5 class="fw-bold" style="color: var(--color-navy);">Tim Profesional</h5>
                        <p class="text-muted mb-0 small">Perawat dan terapis berpengalaman tinggi dengan sertifikasi resmi keperawatan.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 reveal" style="transition-delay: 0.2s;">
                    <div class="benefit-card text-center">
                        <div class="benefit-icon"><i class="fas fa-home"></i></div>
                        <h5 class="fw-bold" style="color: var(--color-navy);">Nyaman di Rumah</h5>
                        <p class="text-muted mb-0 small">Menghadirkan rasa aman dan suasana damai di lingkungan keluarga Anda sendiri.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 reveal" style="transition-delay: 0.3s;">
                    <div class="benefit-card text-center">
                        <div class="benefit-icon"><i class="fas fa-clock"></i></div>
                        <h5 class="fw-bold" style="color: var(--color-navy);">Fleksibel 24/7</h5>
                        <p class="text-muted mb-0 small">Penjadwalan layanan tersedia kapan saja sesuai kebutuhan pasien dan keluarga.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 reveal" style="transition-delay: 0.4s;">
                    <div class="benefit-card text-center">
                        <div class="benefit-icon"><i class="fas fa-hand-holding-heart"></i></div>
                        <h5 class="fw-bold" style="color: var(--color-navy);">Rawat Holistik</h5>
                        <p class="text-muted mb-0 small">Perhatian komprehensif pada pemulihan fisik, kesejahteraan mental, dan emosional pasien.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Packages Section -->
    <section id="packages" class="py-5 bg-white">
        <div class="container py-4">
            <div class="row mb-5 reveal">
                <div class="col-12 text-center">
                    <h6 class="text-uppercase fw-bold mb-2" style="color: var(--color-teal); letter-spacing: 2px;">Daftar Layanan</h6>
                    <h2 class="section-title">Paket Layanan Homecare</h2>
                    <p class="section-subtitle">Tentukan dan pilih paket perawatan yang paling sesuai dengan kondisi kebutuhan Anda.</p>
                </div>
            </div>
            
            <div class="row g-4">
                @foreach($packages as $package)
                <div class="col-lg-4 col-md-6 reveal" style="transition-delay: {{ $loop->index * 0.1 }}s;">
                    <div class="package-card">
                        <div class="package-header">
                            <div class="package-image">
                                <img src="{{ $package->image_url }}" alt="{{ $package->name }}">
                            </div>
                            <div class="package-badge">
                                <span class="badge">{{ $package->duration }}</span>
                            </div>
                        </div>
                        <div class="package-body">
                            <h3 class="package-title">{{ $package->name }}</h3>
                            <p class="package-description">{{ Str::limit($package->description, 100) }}</p>
                            
                            <div class="package-features">
                                @foreach($package->features_array as $feature)
                                    @if($loop->index < 3)
                                    <div class="feature-item">
                                        <i class="fas fa-check-circle" style="color: var(--color-teal); margin-right: 12px; margin-top: 3px;"></i>
                                        <span>{{ $feature }}</span>
                                    </div>
                                    @endif
                                @endforeach
                            </div>
                            
                            <div class="package-price">
                                <h4 class="price">{{ $package->formatted_price }}</h4>
                                <small class="text-muted fw-semibold">per sesi</small>
                            </div>
                        </div>
                        <div class="package-footer">
                            <a href="{{ route('homecare.detail', $package->slug) }}" class="btn btn-outline-secondary w-50" style="border-radius: 8px;">
                                <i class="fas fa-info-circle me-1"></i> Detail
                            </a>
                            <a href="https://wa.me/628116600013?text={{ urlencode($package->whatsapp_message) }}" 
                               target="_blank" 
                               class="btn text-white w-50" style="background-color: var(--color-teal); border-radius: 8px;">
                                <i class="fab fa-whatsapp me-1"></i> Pesan
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-5 bg-white reveal">
        <div class="container">
            <div class="cta-wrapper shadow-lg">
                <div class="row align-items-center cta-content">
                    <div class="col-lg-8 mb-4 mb-lg-0">
                        <h2 class="fw-bold mb-3">Butuh Konsultasi Gratis?</h2>
                        <p class="mb-0 opacity-75 fs-5">Tim konsultan dan dokter pendamping kami siap membantu Anda memilih layanan homecare yang paling tepat dan efektif secara medis.</p>
                    </div>
                    <div class="col-lg-4 text-lg-end">
                        <a href="https://wa.me/6281234567890" target="_blank" class="btn btn-light btn-lg px-4" style="border-radius: 8px; color: var(--color-navy); font-weight: 600;">
                            <i class="fab fa-whatsapp me-2" style="color: #25D366;"></i> Chat WhatsApp
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="py-5 bg-light">
        <div class="container py-4">
            <div class="row mb-5 reveal">
                <div class="col-12 text-center">
                    <h6 class="text-uppercase fw-bold mb-2" style="color: var(--color-teal); letter-spacing: 2px;">Pusat Bantuan</h6>
                    <h2 class="section-title">Pertanyaan Umum</h2>
                    <p class="section-subtitle">Jawaban untuk pertanyaan yang sering diajukan terkait layanan Homecare kami.</p>
                </div>
            </div>
            <div class="row reveal">
                <div class="col-lg-8 mx-auto">
                    <div class="accordion" id="faqAccordion">
                        <div class="accordion-item border-0 shadow-sm mb-3">
                            <h2 class="accordion-header">
                                <button class="accordion-button rounded-3" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                                    Bagaimana cara memesan layanan homecare?
                                </button>
                            </h2>
                            <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                                <div class="accordion-body border-top">
                                    Anda bisa langsung menghubungi kami via WhatsApp atau telepon. Tim admin representatif kami akan membantu proses pendaftaran, pencatatan keluhan, dan penjadwalan kunjungan secara cepat.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item border-0 shadow-sm mb-3">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed rounded-3" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                                    Apakah perawat homecare berpengalaman?
                                </button>
                            </h2>
                            <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body border-top">
                                    Tentu saja. Semua perawat homecare kami memiliki pengalaman minimal 3 tahun bertugas, serta memiliki lisensi STR/SIP dan sertifikasi resmi. Mereka juga mendapatkan pelatihan kompetensi berkala.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item border-0 shadow-sm mb-3">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed rounded-3" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                                    Apa saja yang perlu disiapkan sebelum kunjungan?
                                </button>
                            </h2>
                            <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body border-top">
                                    Mohon untuk menyiapkan ruangan istirahat yang bersih, data riwayat medis pasien, resep atau obat-obatan yang sedang dikonsumsi, serta pastikan ada minimal satu pendamping keluarga saat sesi perawatan berlangsung.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
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

        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const targetId = this.getAttribute('href');
                if (targetId !== '#') {
                    const targetElement = document.querySelector(targetId);
                    if (targetElement) {
                        window.scrollTo({
                            top: targetElement.offsetTop - 80,
                            behavior: 'smooth'
                        });
                    }
                }
            });
        });
    });
</script>
@endsection