@extends('layouts.app')

@section('title', 'Layanan Homecare')

@section('content')
<div class="homecare-page">
    <!-- Hero Section -->
    <section class="hero-section homecare-hero">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h1 class="display-4 fw-bold text-white mb-4">Layanan Homecare Profesional</h1>
                    <p class="lead text-white mb-4">Perawatan medis di rumah dengan standar rumah sakit. Tim medis profesional kami siap melayani Anda.</p>
                    <div class="d-flex flex-wrap gap-3">
                        <a href="#packages" class="btn btn-light btn-lg">
                            <i class="fas fa-stethoscope me-2"></i>Lihat Paket
                        </a>
                        <a href="https://wa.me/6281234567890" target="_blank" class="btn btn-success btn-lg">
                            <i class="fab fa-whatsapp me-2"></i>Konsultasi Gratis
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 text-center">
                    <img src="{{ asset('storage/gallery/homecare.jpg') }}" alt="Homecare" class="img-fluid rounded-3 shadow-lg">
                </div>
            </div>
        </div>
    </section>

    <!-- Benefits Section -->
    <section class="benefits-section py-5">
        <div class="container">
            <div class="row mb-5">
                <div class="col-12 text-center">
                    <h2 class="section-title">Mengapa Memilih Homecare Kami?</h2>
                    <p class="section-subtitle">Kami memberikan pelayanan terbaik untuk kenyamanan Anda</p>
                </div>
            </div>
            <div class="row g-4">
                <div class="col-md-3">
                    <div class="benefit-card text-center">
                        <div class="benefit-icon">
                            <i class="fas fa-user-md"></i>
                        </div>
                        <h5>Tim Medis Profesional</h5>
                        <p class="text-muted">Perawat dan terapis berpengalaman dengan sertifikasi resmi</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="benefit-card text-center">
                        <div class="benefit-icon">
                            <i class="fas fa-home"></i>
                        </div>
                        <h5>Perawatan di Rumah</h5>
                        <p class="text-muted">Rasa aman dan nyaman di lingkungan keluarga sendiri</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="benefit-card text-center">
                        <div class="benefit-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <h5>Fleksibel 24/7</h5>
                        <p class="text-muted">Layanan tersedia kapan saja sesuai kebutuhan Anda</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="benefit-card text-center">
                        <div class="benefit-icon">
                            <i class="fas fa-hand-holding-heart"></i>
                        </div>
                        <h5>Perawatan Holistik</h5>
                        <p class="text-muted">Perhatian penuh pada fisik, mental, dan emosional pasien</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Packages Section -->
    <section id="packages" class="packages-section py-5 bg-light">
        <div class="container">
            <div class="row mb-5">
                <div class="col-12 text-center">
                    <h2 class="section-title">Paket Layanan Homecare</h2>
                    <p class="section-subtitle">Pilih paket yang sesuai dengan kebutuhan Anda</p>
                </div>
            </div>
            <div class="row g-4">
                @foreach($packages as $package)
                <div class="col-lg-3 col-md-6">
                    <div class="package-card">
                        <div class="package-header">
                            <div class="package-image">
                                <img src="{{ $package->image_url }}" alt="{{ $package->name }}">
                            </div>
                            <div class="package-badge">
                                <span class="badge bg-primary">{{ $package->duration }}</span>
                            </div>
                        </div>
                        <div class="package-body">
                            <h3 class="package-title">{{ $package->name }}</h3>
                            <p class="package-description">{{ Str::limit($package->description, 100) }}</p>
                            
                            <div class="package-features mb-3">
                                @foreach($package->features_array as $feature)
                                    @if($loop->index < 3)
                                    <div class="feature-item">
                                        <i class="fas fa-check text-success me-2"></i>
                                        <span>{{ $feature }}</span>
                                    </div>
                                    @endif
                                @endforeach
                            </div>
                            
                            <div class="package-price">
                                <h4 class="price">{{ $package->formatted_price }}</h4>
                                <small class="text-muted">per sesi</small>
                            </div>
                        </div>
                        <div class="package-footer">
                            <a href="{{ route('homecare.detail', $package->slug) }}" class="btn btn-outline-primary btn-sm w-100 mb-2">
                                <i class="fas fa-info-circle me-2"></i>Detail
                            </a>
                            <a href="https://wa.me/6281234567890?text={{ urlencode($package->whatsapp_message) }}" 
                               target="_blank" 
                               class="btn btn-success btn-sm w-100">
                                <i class="fab fa-whatsapp me-2"></i>Pesan via WhatsApp
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section py-5 bg-primary text-white">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <h3 class="mb-3">Butuh Konsultasi Gratis?</h3>
                    <p class="mb-0">Tim konsultan kami siap membantu Anda memilih layanan homecare yang tepat</p>
                </div>
                <div class="col-lg-4 text-lg-end">
                    <a href="https://wa.me/6281234567890" target="_blank" class="btn btn-light btn-lg">
                        <i class="fab fa-whatsapp me-2"></i>Chat Sekarang
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="faq-section py-5">
        <div class="container">
            <div class="row mb-5">
                <div class="col-12 text-center">
                    <h2 class="section-title">Pertanyaan Umum</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <div class="accordion" id="faqAccordion">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                                    Bagaimana cara memesan layanan homecare?
                                </button>
                            </h2>
                            <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Anda bisa langsung menghubungi kami via WhatsApp atau telepon. Tim kami akan membantu proses pendaftaran dan penjadwalan.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                                    Apakah perawat homecare berpengalaman?
                                </button>
                            </h2>
                            <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Ya, semua perawat homecare kami memiliki pengalaman minimal 3 tahun dan sertifikasi resmi. Mereka juga mendapatkan pelatihan berkala.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                                    Apa saja yang perlu disiapkan?
                                </button>
                            </h2>
                            <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Siapkan ruangan yang bersih, data medis pasien, obat-obatan yang sedang dikonsumsi, dan ada pendamping keluarga.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<style>
.homecare-hero {
    background: linear-gradient(135deg, #0ec4fc 0%, #5db7c9 100%);
    padding: 100px 0;
    color: white;
}

.section-title {
    font-size: 2.5rem;
    font-weight: 700;
    color: #2c3e50;
    margin-bottom: 1rem;
}

.section-subtitle {
    color: #7f8c8d;
    font-size: 1.1rem;
    margin-bottom: 3rem;
}

.benefit-card {
    padding: 2rem;
    border-radius: 15px;
    background: white;
    box-shadow: 0 5px 20px rgba(0,0,0,0.1);
    transition: transform 0.3s ease;
    height: 100%;
}

.benefit-card:hover {
    transform: translateY(-10px);
}

.benefit-icon {
    width: 80px;
    height: 80px;
    background: linear-gradient(135deg, #0ec4fc 0%, #5db7c9 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1.5rem;
}

.benefit-icon i {
    font-size: 2rem;
    color: white;
}

.package-card {
    background: white;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 5px 20px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
    height: 100%;
}

.package-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 30px rgba(0,0,0,0.15);
}

.package-header {
    position: relative;
    height: 200px;
    overflow: hidden;
}

.package-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.package-badge {
    position: absolute;
    top: 15px;
    right: 15px;
}

.package-body {
    padding: 2rem;
}

.package-title {
    font-size: 1.5rem;
    font-weight: 700;
    color: #2c3e50;
    margin-bottom: 1rem;
}

.package-description {
    color: #7f8c8d;
    margin-bottom: 1.5rem;
}

.package-features {
    border-top: 1px solid #eee;
    border-bottom: 1px solid #eee;
    padding: 1rem 0;
}

.feature-item {
    margin-bottom: 0.5rem;
    font-size: 0.9rem;
}

.package-price {
    text-align: center;
    margin: 1.5rem 0;
}

.package-price .price {
    font-size: 2rem;
    font-weight: 700;
    color: #667eea;
    margin-bottom: 0.25rem;
}

.package-footer {
    padding: 0 2rem 2rem;
}

.cta-section {
    background: linear-gradient(135deg, #2c3e50 0%, #3498db 100%);
}

@media (max-width: 768px) {
    .homecare-hero {
        padding: 60px 0;
        text-align: center;
    }
    
    .display-4 {
        font-size: 2rem;
    }
    
    .section-title {
        font-size: 2rem;
    }
    
    .benefit-card {
        margin-bottom: 1.5rem;
    }
    
    .package-card {
        margin-bottom: 1.5rem;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
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