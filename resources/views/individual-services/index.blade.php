@extends('layouts.app')

@section('title', 'Paket Layanan Individual')

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
    .ind-hero-section {
        position: relative;
        padding: 120px 0 100px 0;
        background: linear-gradient(135deg, var(--color-navy) 0%, #1a1a2e 100%);
        color: white;
        overflow: hidden;
    }
    
    .ind-hero-section::before {
        content: '';
        position: absolute;
        top: 0; left: 0; width: 100%; height: 100%;
        background: url('{{ asset("storage/gallery/bgberanda.jpg") }}') center/cover;
        opacity: 0.2;
        z-index: 1;
    }
    
    .ind-hero-section::after {
        content: '';
        position: absolute;
        bottom: 0; left: 0; right: 0;
        height: 40px;
        background: #f8f9fa; /* matches Why Choose Us section bg */
        border-radius: 50% 50% 0 0 / 100% 100% 0 0;
        z-index: 2;
        transform: scaleX(1.1);
    }

    .hero-content {
        position: relative;
        z-index: 2;
    }

    /* Section Typography */
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

    /* Why Choose Us Cards */
    .feature-box {
        padding: 2.5rem 1.5rem;
        border-radius: 20px;
        background: white;
        box-shadow: 0 10px 30px rgba(0,0,0,0.03);
        transition: all 0.3s ease;
        height: 100%;
        border: 1px solid #f0f0f0;
    }

    .feature-box:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 35px rgba(15, 52, 96, 0.08);
        border-color: var(--color-teal);
    }

    .feature-icon-wrapper {
        width: 70px; height: 70px;
        background: var(--color-teal-light);
        border-radius: 18px;
        display: inline-flex;
        align-items: center; justify-content: center;
        margin-bottom: 1.5rem;
        transition: all 0.3s ease;
    }

    .feature-box:hover .feature-icon-wrapper {
        background: var(--color-teal);
        transform: scale(1.05) rotate(5deg);
    }

    .feature-icon-wrapper i {
        font-size: 1.8rem;
        color: var(--color-teal);
        transition: all 0.3s ease;
    }
    
    .feature-box:hover .feature-icon-wrapper i {
        color: white;
    }

    /* Featured & All Packages Cards */
    .package-card {
        background: white;
        border-radius: 20px;
        overflow: hidden;
        border: 1px solid #f0f0f0;
        box-shadow: 0 10px 30px rgba(0,0,0,0.04);
        transition: all 0.3s ease;
        height: 100%;
        position: relative;
    }

    .package-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 40px rgba(15, 52, 96, 0.1);
        border-color: var(--color-teal);
    }

    .badge-floating {
        position: absolute;
        top: 20px; right: 20px;
        z-index: 10;
        box-shadow: 0 4px 10px rgba(0,0,0,0.2);
        padding: 8px 15px;
        border-radius: 30px;
        font-weight: 600;
        font-size: 0.85rem;
    }

    .badge-discount-float {
        background-color: #e74c3c !important; /* Soft red for discount */
        color: white;
    }
    
    .badge-featured-float {
        position: absolute;
        top: 20px; left: 20px;
        z-index: 10;
        background: rgba(255, 193, 7, 0.95);
        color: #333;
        padding: 8px 15px;
        border-radius: 30px;
        font-weight: 600;
        font-size: 0.85rem;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }

    /* Featured Card Specifics */
    .featured-header {
        background: linear-gradient(135deg, var(--color-navy) 0%, #1a1a2e 100%);
        color: white;
        text-align: center;
        padding: 2.5rem 1rem;
        position: relative;
        overflow: hidden;
    }
    .featured-header::after {
        content: '';
        position: absolute;
        bottom: -20px; left: -10%; width: 120%; height: 40px;
        background: white;
        border-radius: 50%;
    }

    /* Image Wrapper for All Packages */
    .package-img-wrapper {
        position: relative;
        height: 220px;
        overflow: hidden;
    }
    
    .package-img-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.6s ease;
    }
    
    .package-card:hover .package-img-wrapper img {
        transform: scale(1.08);
    }
    
    .package-img-overlay {
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background: linear-gradient(to bottom, rgba(0,0,0,0.1) 0%, rgba(0,0,0,0.5) 100%);
    }

    /* Price Styling */
    .price-strike {
        color: #95a5a6;
        text-decoration: line-through;
        font-size: 1.1rem;
        margin-bottom: 5px;
    }
    .price-current {
        color: var(--color-teal);
        font-size: 2.2rem;
        font-weight: 800;
        line-height: 1;
        margin-bottom: 0;
    }

    /* Features List */
    .package-feature-list {
        padding: 0;
        list-style: none;
    }
    .package-feature-list li {
        margin-bottom: 12px;
        color: #555;
        display: flex;
        align-items: flex-start;
    }
    .package-feature-list li i {
        color: var(--color-teal);
        margin-right: 12px;
        margin-top: 4px;
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

<!-- Hero Section -->
<section class="ind-hero-section">
    <div class="container hero-content">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center">
                <h6 class="text-uppercase fw-bold mb-3" style="color: var(--color-teal); letter-spacing: 3px;">Perawatan Premium</h6>
                <h1 class="display-4 fw-bold mb-4">Paket Layanan Individual</h1>
                <p class="lead opacity-75 mb-5 mx-auto" style="line-height: 1.8; max-width: 700px;">
                    Layanan kesehatan eksklusif yang dirancang khusus untuk kebutuhan personal Anda. Dapatkan penanganan medis komprehensif bersama dokter spesialis berpengalaman.
                </p>
                <div class="d-flex justify-content-center gap-3 flex-wrap">
                    <a href="#packages" class="btn text-white px-4 py-2" style="background-color: var(--color-teal); border-radius: 8px; font-weight: 500;">
                        <i class="fas fa-gem me-2"></i> Lihat Paket
                    </a>
                    <a href="#why-choose" class="btn btn-outline-light px-4 py-2" style="border-radius: 8px; font-weight: 500;">
                        <i class="fas fa-info-circle me-2"></i> Mengapa Kami?
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Why Choose Us -->
<section id="why-choose" class="py-5 bg-light">
    <div class="container py-4">
        <div class="row mb-5 reveal">
            <div class="col-12 text-center">
                <h6 class="text-uppercase fw-bold mb-2" style="color: var(--color-teal); letter-spacing: 2px;">Keistimewaan Kami</h6>
                <h2 class="section-title">Mengapa Layanan Individual?</h2>
                <p class="section-subtitle">Menghadirkan standar baru dalam pengalaman perawatan medis personal.</p>
            </div>
        </div>
        <div class="row g-4">
            <div class="col-lg-3 col-sm-6 reveal" style="transition-delay: 0.1s;">
                <div class="feature-box text-center">
                    <div class="feature-icon-wrapper"><i class="fas fa-user-md"></i></div>
                    <h5 class="fw-bold" style="color: var(--color-navy);">Dokter Spesialis</h5>
                    <p class="text-muted mb-0 small">Sesi konsultasi intensif langsung dengan ahlinya secara eksklusif.</p>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 reveal" style="transition-delay: 0.2s;">
                <div class="feature-box text-center">
                    <div class="feature-icon-wrapper"><i class="fas fa-clock"></i></div>
                    <h5 class="fw-bold" style="color: var(--color-navy);">Waktu Fleksibel</h5>
                    <p class="text-muted mb-0 small">Penyesuaian jadwal konsultasi dan tindakan sesuai aktivitas Anda.</p>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 reveal" style="transition-delay: 0.3s;">
                <div class="feature-box text-center">
                    <div class="feature-icon-wrapper"><i class="fas fa-home"></i></div>
                    <h5 class="fw-bold" style="color: var(--color-navy);">Home Care</h5>
                    <p class="text-muted mb-0 small">Opsi kunjungan rawat di rumah untuk kenyamanan pasien dan keluarga.</p>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 reveal" style="transition-delay: 0.4s;">
                <div class="feature-box text-center">
                    <div class="feature-icon-wrapper"><i class="fas fa-headset"></i></div>
                    <h5 class="fw-bold" style="color: var(--color-navy);">Dukungan 24/7</h5>
                    <p class="text-muted mb-0 small">Asistensi darurat dan pemantauan terus-menerus selama masa terapi.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Featured Packages -->
@if($featuredServices->count() > 0)
<section class="py-5 bg-white">
    <div class="container py-4">
        <div class="row mb-5 reveal">
            <div class="col-12 text-center">
                <h6 class="text-uppercase fw-bold mb-2" style="color: var(--color-teal); letter-spacing: 2px;">Rekomendasi Utama</h6>
                <h2 class="section-title">Paket Unggulan</h2>
                <p class="section-subtitle">Pilihan layanan komprehensif yang paling banyak dipercaya oleh pasien kami.</p>
            </div>
        </div>
        <div class="row g-4 justify-content-center">
            @foreach($featuredServices as $service)
            <div class="col-lg-4 col-md-6 reveal" style="transition-delay: {{ $loop->index * 0.1 }}s;">
                <div class="package-card d-flex flex-column">
                    @if($service->discount_percentage > 0)
                    <div class="badge-floating badge-discount-float">
                        <i class="fas fa-tag me-1"></i> {{ $service->discount_percentage }}% OFF
                    </div>
                    @endif
                    @if($service->is_featured)
                    <div class="badge-featured-float">
                        <i class="fas fa-star text-dark me-1"></i> Pilihan
                    </div>
                    @endif
                    
                    <div class="featured-header">
                        <i class="{{ $service->icon_class }} fa-3x mb-3 text-white opacity-75"></i>
                        <h3 class="h4 mb-0 fw-bold">{{ $service->name }}</h3>
                    </div>
                    
                    <div class="card-body p-4 d-flex flex-column flex-grow-1">
                        <div class="text-center mb-4">
                            @if($service->discount_price)
                                <div class="price-strike">{{ $service->formatted_price }}</div>
                                <div class="price-current">{{ $service->formatted_discount_price }}</div>
                            @else
                                <div class="price-current mt-4">{{ $service->formatted_price }}</div>
                            @endif
                            
                            @if($service->duration_days)
                                <span class="badge bg-light text-dark border mt-3 px-3 py-2">
                                    <i class="far fa-calendar-alt me-1" style="color: var(--color-teal);"></i> {{ $service->duration_days }} Hari
                                </span>
                            @endif
                        </div>
                        
                        <ul class="package-feature-list flex-grow-1 border-top pt-4">
                            @foreach($service->features_array as $feature)
                            <li><i class="fas fa-check-circle"></i> {{ $feature }}</li>
                            @endforeach
                        </ul>
                        
                        <div class="mt-4 pt-4 border-top d-flex gap-2">
                            <a href="{{ route('individual-services.show', $service->slug) }}" class="btn btn-outline-secondary w-50" style="border-radius: 8px;">
                                <i class="fas fa-info-circle me-1"></i> Detail
                            </a>
                            <a href="https://wa.me/628116600013?text={{ urlencode($service->whatsapp_message ?? 'Halo RSKB Ropanasuri, saya tertarik dengan layanan ' . $service->name . '. Mohon informasi lebih lanjut.') }}" target="_blank" class="btn text-white w-50" style="background-color: var(--color-teal); border-radius: 8px;">
                                <i class="fab fa-whatsapp me-1"></i> Pesan
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- All Packages -->
<section id="packages" class="py-5 bg-light">
    <div class="container py-4">
        <div class="row mb-5 reveal">
            <div class="col-12 text-center">
                <h6 class="text-uppercase fw-bold mb-2" style="color: var(--color-teal); letter-spacing: 2px;">Eksplorasi Lengkap</h6>
                <h2 class="section-title">Semua Paket Layanan</h2>
                <p class="section-subtitle">Temukan modul perawatan yang dirancang sesuai dengan spesifikasi kondisi medis Anda.</p>
            </div>
        </div>
        
        @if($services->count() > 0)
        <div class="row g-4">
            @foreach($services as $service)
            <div class="col-lg-4 col-md-6 reveal" style="transition-delay: {{ $loop->index * 0.1 }}s;">
                <div class="package-card h-100 d-flex flex-column">
                    @if($service->discount_percentage > 0)
                    <div class="badge-floating badge-discount-float">
                        {{ $service->discount_percentage }}% OFF
                    </div>
                    @endif
                    
                    <div class="package-img-wrapper">
                        <img src="{{ $service->image_url }}" alt="{{ $service->name }}">
                        <div class="package-img-overlay d-flex align-items-end p-3">
                            <h3 class="h5 text-white mb-0 fw-bold">{{ $service->name }}</h3>
                        </div>
                    </div>
                    
                    <div class="card-body p-4 d-flex flex-column flex-grow-1">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            @if($service->duration_days)
                            <span class="badge bg-light text-secondary border px-2 py-1">
                                <i class="far fa-clock me-1"></i>{{ $service->duration_days }} Hari
                            </span>
                            @else
                            <span></span>
                            @endif
                            <i class="{{ $service->icon_class }} fs-4" style="color: var(--color-teal);"></i>
                        </div>
                        
                        <p class="text-muted mb-4 small flex-grow-1" style="line-height: 1.6;">{{ Str::limit($service->description, 100) }}</p>
                        
                        <div class="mb-4 bg-light p-3 rounded-3 text-center">
                            @if($service->discount_price)
                            <div class="text-muted text-decoration-line-through small">{{ $service->formatted_price }}</div>
                            <h4 class="mb-0 fw-bold" style="color: var(--color-navy);">{{ $service->formatted_discount_price }}</h4>
                            @else
                            <h4 class="mb-0 fw-bold" style="color: var(--color-navy);">{{ $service->formatted_price }}</h4>
                            @endif
                        </div>
                        
                        <a href="{{ route('individual-services.show', $service->slug) }}" class="btn btn-outline-secondary w-100" style="border-radius: 8px;">
                            Lihat Detail Lengkap <i class="fas fa-arrow-right ms-2 fs-6"></i>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="text-center py-5 reveal">
            <div class="d-inline-flex justify-content-center align-items-center mb-4" style="width: 100px; height: 100px; background: white; border-radius: 50%; box-shadow: 0 10px 30px rgba(0,0,0,0.05);">
                <i class="fas fa-box-open fa-3x" style="color: #dee2e6;"></i>
            </div>
            <h4 class="fw-bold" style="color: var(--color-navy);">Belum ada paket tersedia</h4>
            <p class="text-muted">Silakan hubungi administrator kami untuk informasi layanan kustom.</p>
        </div>
        @endif
    </div>
</section>

<!-- CTA Section -->
<section class="py-5 bg-white reveal">
    <div class="container">
        <div class="cta-wrapper shadow-lg">
            <div class="row align-items-center position-relative" style="z-index: 2;">
                <div class="col-lg-8 mb-4 mb-lg-0">
                    <h2 class="fw-bold mb-3">Butuh Konsultasi Khusus?</h2>
                    <p class="lead mb-0 opacity-75">Bicarakan keluhan dan kebutuhan Anda. Tim spesialis kami siap menyusun program perawatan yang paling optimal untuk Anda.</p>
                </div>
                <div class="col-lg-4 text-lg-end">
                    <a href="https://wa.me/628116600013" class="btn btn-light btn-lg px-4" target="_blank" style="border-radius: 8px; font-weight: 600; color: var(--color-navy);">
                        <i class="fab fa-whatsapp me-2" style="color: #25D366;"></i> Chat Sekarang
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="py-5 bg-light reveal">
    <div class="container py-4">
        <div class="row mb-5">
            <div class="col-lg-8 mx-auto text-center">
                <h6 class="text-uppercase fw-bold mb-2" style="color: var(--color-teal); letter-spacing: 2px;">Pusat Bantuan</h6>
                <h2 class="section-title">Pertanyaan Umum</h2>
                <p class="section-subtitle">Informasi penting dan jawaban cepat mengenai paket Layanan Individual kami.</p>
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="accordion" id="faqAccordion">
                    <div class="accordion-item border-0 shadow-sm mb-3">
                        <h2 class="accordion-header">
                            <button class="accordion-button rounded-3" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                                Bagaimana prosedur memesan paket layanan individual ini?
                            </button>
                        </h2>
                        <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                            <div class="accordion-body border-top">
                                Anda cukup memilih paket yang paling sesuai, lalu tekan tombol "Pesan via WhatsApp" atau "Pesan". Anda akan diarahkan untuk mengisi format pemesanan singkat sebelum terhubung dengan admin kami untuk konfirmasi ketersediaan jadwal.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item border-0 shadow-sm mb-3">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed rounded-3" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                                Apakah paket yang sudah dipesan bisa dibatalkan?
                            </button>
                        </h2>
                        <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body border-top">
                                Pembatalan jadwal dimungkinkan dan dapat dilakukan paling lambat 24 jam sebelum jadwal tindakan/kunjungan. Akan dikenakan pemotongan biaya administrasi sebesar 10% dari total tagihan paket.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item border-0 shadow-sm mb-3">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed rounded-3" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                                Metode pembayaran apa saja yang tersedia?
                            </button>
                        </h2>
                        <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body border-top">
                                Demi kenyamanan Anda, kami menerima berbagai saluran pembayaran yang aman, meliputi Transfer Bank (Virtual Account), E-Wallet terpilih, hingga pembayaran tunai atau debit langsung di lokasi (jika di Rumah Sakit).
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

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
                const targetId = this.getAttribute('href');
                if (targetId !== '#') {
                    e.preventDefault();
                    const targetElement = document.querySelector(targetId);
                    if (targetElement) {
                        targetElement.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                }
            });
        });
    });
</script>
@endsection