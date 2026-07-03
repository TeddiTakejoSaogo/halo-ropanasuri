@extends('layouts.app')

@section('title', $package->name . ' - Homecare')

@section('content')
<div class="homecare-detail-page bg-light pb-5">
    <!-- Package Detail Header -->
    <section class="package-header-section position-relative py-5">
        <div class="container position-relative z-2">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('homecare') }}">Homecare</a></li>
                    <li class="breadcrumb-item active text-white">{{ $package->name }}</li>
                </ol>
            </nav>
            
            <div class="row align-items-center">
                <div class="col-lg-7 mb-4 mb-lg-0">
                    <span class="badge bg-teal-light text-teal mb-3 fs-6 px-3 py-2 rounded-pill"><i class="fas fa-heartbeat me-2"></i>Layanan Homecare</span>
                    <h1 class="display-4 fw-bold text-white mb-3">{{ $package->name }}</h1>
                    <p class="lead text-white-50 mb-4">{{ $package->description }}</p>
                    <div class="d-flex align-items-center mb-4">
                        <div class="me-4 bg-white p-3 rounded-4 shadow-sm">
                            <h3 class="text-teal mb-0 fw-bold">{{ $package->formatted_price }}</h3>
                            <small class="text-muted fw-medium">per {{ $package->duration }}</small>
                        </div>
                    </div>
                    <div class="d-flex flex-wrap gap-3">
                        <a href="https://wa.me/6281234567890?text={{ urlencode($package->whatsapp_message) }}" 
                           target="_blank" 
                           class="btn btn-teal btn-lg px-4 rounded-pill shadow-sm hover-lift">
                            <i class="fab fa-whatsapp me-2"></i>Pesan Sekarang
                        </a>
                        <a href="{{ route('homecare') }}" class="btn btn-outline-light btn-lg px-4 rounded-pill hover-lift">
                            <i class="fas fa-arrow-left me-2"></i>Kembali
                        </a>
                    </div>
                </div>
                <div class="col-lg-5 text-center">
                    <div class="image-wrapper p-2 bg-white rounded-4 shadow-lg rotate-img">
                        <img src="{{ $package->image_url }}" 
                             alt="{{ $package->name }}" 
                             class="img-fluid rounded-4" style="max-height: 400px; object-fit: cover; width: 100%;">
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-shape"></div>
    </section>

    <!-- Package Details -->
    <section class="package-details-section py-5 mt-4">
        <div class="container">
            <div class="row g-4">
                <!-- Main Content -->
                <div class="col-lg-8">
                    <!-- Features -->
                    <div class="card border-0 shadow-sm rounded-4 mb-4 hover-lift-subtle overflow-hidden">
                        <div class="card-header bg-white border-0 pt-4 pb-0 px-4">
                            <h5 class="mb-0 text-navy fw-bold"><i class="fas fa-star text-teal me-2"></i>Fitur Layanan</h5>
                        </div>
                        <div class="card-body p-4">
                            <div class="row g-3">
                                @foreach($package->features_array as $feature)
                                <div class="col-md-6">
                                    <div class="d-flex align-items-start p-3 bg-light rounded-3 h-100">
                                        <i class="fas fa-check-circle text-teal mt-1 me-3 fs-5"></i>
                                        <span class="text-muted">{{ $feature }}</span>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Preparation -->
                    @if($package->preparation)
                    <div class="card border-0 shadow-sm rounded-4 mb-4 hover-lift-subtle overflow-hidden">
                        <div class="card-header bg-white border-0 pt-4 pb-0 px-4">
                            <h5 class="mb-0 text-navy fw-bold"><i class="fas fa-clipboard-check text-teal me-2"></i>Persiapan yang Diperlukan</h5>
                        </div>
                        <div class="card-body p-4">
                            <div class="preparation-content text-muted bg-light p-4 rounded-3">
                                {!! nl2br(e($package->preparation)) !!}
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Procedure -->
                    @if($package->procedure)
                    <div class="card border-0 shadow-sm rounded-4 mb-4 hover-lift-subtle overflow-hidden">
                        <div class="card-header bg-white border-0 pt-4 pb-0 px-4">
                            <h5 class="mb-0 text-navy fw-bold"><i class="fas fa-procedures text-teal me-2"></i>Prosedur Pelayanan</h5>
                        </div>
                        <div class="card-body p-4">
                            <div class="procedure-content text-muted bg-light p-4 rounded-3">
                                {!! nl2br(e($package->procedure)) !!}
                            </div>
                        </div>
                    </div>
                    @endif
                </div>

                <!-- Sidebar -->
                <div class="col-lg-4">
                    <!-- Order Card -->
                    <div class="card shadow-lg border-0 rounded-4 mb-4 position-sticky" style="top: 100px;">
                        <div class="card-header bg-navy text-white text-center py-4 border-0">
                            <h4 class="mb-0 fw-bold">Pesan Layanan</h4>
                        </div>
                        <div class="card-body text-center p-4">
                            <div class="price-display mb-4 p-4 bg-light rounded-4">
                                <h2 class="text-teal fw-bold mb-1">{{ $package->formatted_price }}</h2>
                                <p class="text-muted mb-0 fw-medium">Durasi: {{ $package->duration }}</p>
                            </div>
                            
                            <div class="whatsapp-button mb-4">
                                <a href="https://wa.me/6281234567890?text={{ urlencode($package->whatsapp_message) }}" 
                                   target="_blank" 
                                   class="btn btn-teal btn-lg w-100 py-3 rounded-pill shadow-sm hover-lift">
                                    <i class="fab fa-whatsapp fa-2x me-2 align-middle"></i>
                                    <span class="fw-bold align-middle">Chat via WhatsApp</span>
                                </a>
                                <div class="mt-3 d-flex justify-content-center align-items-center text-muted small">
                                    <i class="fas fa-bolt text-warning me-2"></i> Respon cepat dalam 5 menit
                                </div>
                            </div>
                            
                            <hr class="text-muted opacity-25">
                            
                            <div class="contact-info text-start mt-4">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="bg-teal-light p-3 rounded-circle me-3">
                                        <i class="fas fa-phone text-teal fs-5"></i>
                                    </div>
                                    <div>
                                        <small class="text-muted d-block">Telepon</small>
                                        <strong class="text-navy">(021) 123-4567</strong>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <div class="bg-teal-light p-3 rounded-circle me-3">
                                        <i class="fas fa-clock text-teal fs-5"></i>
                                    </div>
                                    <div>
                                        <small class="text-muted d-block">Jam Operasional</small>
                                        <strong class="text-navy">24/7 Tersedia</strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Other Packages -->
            @if($otherPackages->count() > 0)
            <div class="mt-5">
                <h3 class="text-navy fw-bold mb-4">Paket Lainnya</h3>
                <div class="row g-4">
                    @foreach($otherPackages as $other)
                    <div class="col-md-6 col-lg-4">
                        <div class="card border-0 shadow-sm rounded-4 h-100 hover-lift overflow-hidden">
                            <div class="card-body p-4 d-flex flex-column">
                                <div class="mb-3">
                                    <span class="badge bg-teal-light text-teal">{{ $other->duration }}</span>
                                </div>
                                <h5 class="fw-bold text-navy mb-3">{{ $other->name }}</h5>
                                <p class="text-muted small mb-4">{{ Str::limit($other->description, 80) }}</p>
                                <div class="d-flex justify-content-between align-items-center mt-auto pt-3 border-top">
                                    <span class="text-teal fw-bold">{{ $other->formatted_price }}</span>
                                    <a href="{{ route('homecare.detail', $other->slug) }}" class="btn btn-sm btn-outline-navy rounded-pill px-3 hover-lift">
                                        Detail
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
            
        </div>
    </section>
</div>

<style>
/* Theme Colors & Utilities */
.text-navy { color: var(--color-navy) !important; }
.text-teal { color: var(--color-teal) !important; }
.bg-navy { background-color: var(--color-navy) !important; }
.bg-teal-light { background-color: var(--color-teal-light) !important; }

/* Hero Section */
.package-header-section {
    background: linear-gradient(135deg, var(--color-navy) 0%, #1a4a82 100%);
    overflow: hidden;
}

.package-header-section .breadcrumb {
    background: transparent;
    padding: 0;
    margin-bottom: 2rem;
}

.package-header-section .breadcrumb-item a {
    color: rgba(255,255,255,0.7);
    text-decoration: none;
    transition: color 0.3s ease;
}

.package-header-section .breadcrumb-item a:hover {
    color: var(--color-teal);
}

.package-header-section .breadcrumb-item + .breadcrumb-item::before {
    color: rgba(255,255,255,0.4);
}

.bg-shape {
    position: absolute;
    top: -50%;
    right: -20%;
    width: 800px;
    height: 800px;
    border-radius: 50%;
    background: radial-gradient(circle, rgba(22,160,133,0.15) 0%, rgba(0,0,0,0) 70%);
    z-index: 1;
}

/* Animations & Effects */
.hover-lift {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.hover-lift:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(15, 52, 96, 0.15) !important;
}

.hover-lift-subtle {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.hover-lift-subtle:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(15, 52, 96, 0.08) !important;
}

.rotate-img {
    transition: transform 0.5s ease;
}
.rotate-img:hover {
    transform: rotate(2deg) scale(1.02);
}

/* Content Formatting */
.preparation-content, .procedure-content {
    line-height: 1.8;
}

/* Responsive */
@media (max-width: 991px) {
    .package-header-section {
        text-align: center;
        padding: 60px 0;
    }
    
    .package-header-section .d-flex {
        justify-content: center;
    }
    
    .display-4 {
        font-size: 2.5rem;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Format preparation and procedure content
    const preparationContent = document.querySelector('.preparation-content');
    const procedureContent = document.querySelector('.procedure-content');
    
    function formatListContent(element) {
        if (element) {
            const lines = element.innerHTML.split('\n');
            const formattedLines = lines.map(line => {
                const trimmed = line.trim();
                if (trimmed.match(/^\d+\./)) {
                    return `<div class="mb-2 text-navy"><strong>${trimmed}</strong></div>`;
                }
                if (trimmed.length > 0) {
                    return `<div class="mb-2 d-flex"><i class="fas fa-caret-right text-teal mt-1 me-2"></i><span>${trimmed}</span></div>`;
                }
                return '';
            });
            element.innerHTML = formattedLines.join('');
        }
    }
    
    formatListContent(preparationContent);
    formatListContent(procedureContent);
});
</script>
@endsection