@extends('layouts.app')

@section('title', 'Paket Layanan Individual')

@section('content')
<!-- Hero Section -->
<section class="hero-section" style="background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?ixlib=rb-4.0.3&auto=format&fit=crop&w=1350&q=80'); background-size: cover; background-position: center; padding: 100px 0;">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center text-white">
                <h1 class="display-4 mb-3">Paket Layanan Individual</h1>
                <p class="lead mb-4">Layanan kesehatan premium yang dirancang khusus untuk kebutuhan pribadi Anda. Dapatkan perawatan terbaik dengan dokter spesialis berpengalaman.</p>
                <div class="d-flex justify-content-center gap-3 flex-wrap">
                    <a href="#packages" class="btn btn-primary btn-lg">
                        <i class="fas fa-gem me-2"></i>Lihat Paket
                    </a>
                    <a href="#why-choose" class="btn btn-outline-light btn-lg">
                        <i class="fas fa-question-circle me-2"></i>Mengapa Memilih Kami?
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Why Choose Us -->
<section id="why-choose" class="py-5 bg-light">
    <div class="container">
        <div class="row mb-5">
            <div class="col-12 text-center">
                <h2 class="display-5 mb-3">Mengapa Memilih Layanan Individual?</h2>
                <p class="lead text-muted">Kami memberikan pengalaman perawatan kesehatan yang berbeda</p>
            </div>
        </div>
        <div class="row g-4">
            <div class="col-md-3 col-sm-6">
                <div class="card border-0 shadow-sm h-100 text-center">
                    <div class="card-body p-4">
                        <div class="bg-primary rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 70px; height: 70px;">
                            <i class="fas fa-user-md fa-2x text-white"></i>
                        </div>
                        <h5 class="card-title">Dokter Spesialis</h5>
                        <p class="card-text text-muted">Konsultasi langsung dengan dokter spesialis berpengalaman</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="card border-0 shadow-sm h-100 text-center">
                    <div class="card-body p-4">
                        <div class="bg-success rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 70px; height: 70px;">
                            <i class="fas fa-clock fa-2x text-white"></i>
                        </div>
                        <h5 class="card-title">Fleksibel</h5>
                        <p class="card-text text-muted">Jadwal konsultasi sesuai kebutuhan Anda</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="card border-0 shadow-sm h-100 text-center">
                    <div class="card-body p-4">
                        <div class="bg-warning rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 70px; height: 70px;">
                            <i class="fas fa-home fa-2x text-white"></i>
                        </div>
                        <h5 class="card-title">Home Care</h5>
                        <p class="card-text text-muted">Layanan home visit untuk kenyamanan Anda</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="card border-0 shadow-sm h-100 text-center">
                    <div class="card-body p-4">
                        <div class="bg-info rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 70px; height: 70px;">
                            <i class="fas fa-headset fa-2x text-white"></i>
                        </div>
                        <h5 class="card-title">24/7 Support</h5>
                        <p class="card-text text-muted">Dukungan penuh selama masa perawatan</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Featured Packages -->
@if($featuredServices->count() > 0)
<section class="py-5 bg-white">
    <div class="container">
        <div class="row mb-5">
            <div class="col-12 text-center">
                <h2 class="display-5 mb-3">Paket Unggulan</h2>
                <p class="lead text-muted">Paket terbaik yang paling banyak dipilih</p>
            </div>
        </div>
        <div class="row g-4">
            @foreach($featuredServices as $service)
            <div class="col-lg-4">
                <div class="card package-card border-0 shadow-lg h-100">
                    @if($service->discount_percentage > 0)
                    <div class="badge-discount">
                        <span class="badge bg-danger">{{ $service->discount_percentage }}% OFF</span>
                    </div>
                    @endif
                    @if($service->is_featured)
                    <div class="badge-featured">
                        <span class="badge bg-warning">🔥 Unggulan</span>
                    </div>
                    @endif
                    <div class="card-header bg-primary text-white text-center py-4">
                        <i class="{{ $service->icon_class }} fa-3x mb-3"></i>
                        <h3 class="h4 mb-0">{{ $service->name }}</h3>
                    </div>
                    <div class="card-body p-4">
                        <div class="text-center mb-4">
                            @if($service->discount_price)
                            <div class="text-muted text-decoration-line-through">
                                {{ $service->formatted_price }}
                            </div>
                            <h2 class="text-primary">{{ $service->formatted_discount_price }}</h2>
                            @else
                            <h2 class="text-primary">{{ $service->formatted_price }}</h2>
                            @endif
                            @if($service->duration_days)
                            <p class="text-muted mb-0">{{ $service->duration_days }} hari perawatan</p>
                            @endif
                        </div>
                        
                        <ul class="list-unstyled mb-4">
                            @foreach($service->features_array as $feature)
                            <li class="mb-2">
                                <i class="fas fa-check text-success me-2"></i>
                                {{ $feature }}
                            </li>
                            @endforeach
                        </ul>
                        
                        <div class="text-center mt-4">
                            <a href="{{ route('individual-services.show', $service->slug) }}" class="btn btn-outline-primary w-100 mb-2">
                                <i class="fas fa-info-circle me-2"></i>Detail
                            </a>
                            <a href="{{ route('individual-services.order', $service->id) }}" class="btn btn-primary w-100">
                                <i class="fab fa-whatsapp me-2"></i>Pesan via WhatsApp
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
    <div class="container">
        <div class="row mb-5">
            <div class="col-12 text-center">
                <h2 class="display-5 mb-3">Semua Paket Layanan</h2>
                <p class="lead text-muted">Pilih paket yang sesuai dengan kebutuhan Anda</p>
            </div>
        </div>
        
        @if($services->count() > 0)
        <div class="row g-4">
            @foreach($services as $service)
            <div class="col-lg-4 col-md-6">
                <div class="card package-card border-0 shadow-sm h-100">
                    @if($service->discount_percentage > 0)
                    <div class="badge-discount">
                        <span class="badge bg-danger">{{ $service->discount_percentage }}% OFF</span>
                    </div>
                    @endif
                    
                    <div class="card-img-top position-relative" style="height: 200px; overflow: hidden;">
                        <img src="{{ $service->image_url }}" class="w-100 h-100" style="object-fit: cover;" alt="{{ $service->name }}">
                        <div class="package-overlay"></div>
                    </div>
                    
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div>
                                <h3 class="h5 mb-1">{{ $service->name }}</h3>
                                @if($service->duration_days)
                                <small class="text-muted">
                                    <i class="fas fa-calendar me-1"></i>{{ $service->duration_days }} hari
                                </small>
                                @endif
                            </div>
                            <i class="{{ $service->icon_class }} fa-2x text-primary"></i>
                        </div>
                        
                        <p class="card-text text-muted mb-3">{{ Str::limit($service->description, 100) }}</p>
                        
                        <div class="mb-3">
                            @if($service->discount_price)
                            <div class="text-muted text-decoration-line-through small">
                                {{ $service->formatted_price }}
                            </div>
                            <h4 class="text-primary mb-0">{{ $service->formatted_discount_price }}</h4>
                            @else
                            <h4 class="text-primary mb-0">{{ $service->formatted_price }}</h4>
                            @endif
                        </div>
                        
                        <div class="d-grid gap-2">
                            <a href="{{ route('individual-services.show', $service->slug) }}" class="btn btn-outline-primary">
                                <i class="fas fa-eye me-2"></i>Lihat Detail
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="text-center py-5">
            <i class="fas fa-gem fa-3x text-muted mb-3"></i>
            <h4 class="text-muted">Belum ada paket layanan tersedia</h4>
            <p class="text-muted">Silakan hubungi kami untuk informasi lebih lanjut</p>
        </div>
        @endif
    </div>
</section>

<!-- FAQ Section -->
<section class="py-5 bg-white">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="text-center mb-5">
                    <h2 class="display-5 mb-3">Pertanyaan Umum</h2>
                    <p class="lead text-muted">Informasi penting tentang paket layanan individual</p>
                </div>
                
                <div class="accordion" id="faqAccordion">
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                                Bagaimana cara memesan paket layanan?
                            </button>
                        </h2>
                        <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Pilih paket yang diinginkan, klik tombol "Pesan via WhatsApp", isi formulir pemesanan, dan Anda akan diarahkan ke WhatsApp untuk konfirmasi lebih lanjut.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                                Apakah ada pembatalan paket?
                            </button>
                        </h2>
                        <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Pembatalan dapat dilakukan maksimal 24 jam sebelum jadwal layanan dengan biaya administrasi 10% dari harga paket.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                                Bagaimana metode pembayaran?
                            </button>
                        </h2>
                        <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Pembayaran dapat dilakukan via transfer bank, e-wallet, atau cash di tempat. Detail pembayaran akan dikirim via WhatsApp.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-5 bg-primary text-white">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <h2 class="h1 mb-3">Butuh Konsultasi Khusus?</h2>
                <p class="lead mb-0">Hubungi kami untuk informasi lebih lanjut tentang paket layanan individual.</p>
            </div>
            <div class="col-lg-4 text-lg-end mt-4 mt-lg-0">
                <a href="https://wa.me/628116600013" class="btn btn-success btn-lg" target="_blank">
                    <i class="fab fa-whatsapp me-2"></i>Chat via WhatsApp
                </a>
            </div>
        </div>
    </div>
</section>

<style>
.package-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    border-radius: 15px;
    overflow: hidden;
}

.package-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 35px rgba(0,0,0,0.1) !important;
}

.badge-discount {
    position: absolute;
    top: 15px;
    right: 15px;
    z-index: 2;
}

.badge-featured {
    position: absolute;
    top: 15px;
    left: 15px;
    z-index: 2;
}

.badge-discount .badge,
.badge-featured .badge {
    font-size: 0.9rem;
    padding: 0.5rem 1rem;
    border-radius: 25px;
}

.package-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(to bottom, transparent 50%, rgba(0,0,0,0.3));
}

.accordion-button:not(.collapsed) {
    background-color: #e7f1ff;
    color: var(--primary-color);
}

.hero-section {
    background-attachment: fixed;
}

@media (max-width: 768px) {
    .hero-section {
        padding: 80px 0;
        background-attachment: scroll;
    }
    
    .display-4 {
        font-size: 2.5rem;
    }
}

@media (max-width: 576px) {
    .hero-section {
        padding: 60px 0;
    }
    
    .display-4 {
        font-size: 2rem;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Smooth scroll untuk anchor links
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