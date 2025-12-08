@extends('layouts.app')

@section('title', $package->name . ' - Homecare')

@section('content')
<div class="homecare-detail-page">
    <!-- Package Detail Header -->
    <section class="package-header-section py-5" style="background: linear-gradient(135deg, #0ec4fc 0%, #5db7c9 100%);">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('homecare') }}">Homecare</a></li>
                    <li class="breadcrumb-item active text-white">{{ $package->name }}</li>
                </ol>
            </nav>
            
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h1 class="display-4 fw-bold text-white mb-3">{{ $package->name }}</h1>
                    <p class="lead text-white mb-4">{{ $package->description }}</p>
                    <div class="d-flex align-items-center mb-4">
                        <div class="me-4">
                            <h3 class="text-white mb-0">{{ $package->formatted_price }}</h3>
                            <small class="text-light">per {{ $package->duration }}</small>
                        </div>
                        <span class="badge bg-light text-primary fs-6">{{ $package->duration }}</span>
                    </div>
                    <a href="https://wa.me/6281234567890?text={{ urlencode($package->whatsapp_message) }}" 
                       target="_blank" 
                       class="btn btn-success btn-lg me-3">
                        <i class="fab fa-whatsapp me-2"></i>Pesan Sekarang
                    </a>
                    <a href="{{ route('homecare') }}" class="btn btn-outline-light btn-lg">
                        <i class="fas fa-arrow-left me-2"></i>Kembali
                    </a>
                </div>
                <div class="col-lg-6 text-center">
                    <img src="{{ $package->image_url }}" 
                         alt="{{ $package->name }}" 
                         class="img-fluid rounded-3 shadow-lg">
                </div>
            </div>
        </div>
    </section>

    <!-- Package Details -->
    <section class="package-details-section py-5">
        <div class="container">
            <div class="row">
                <!-- Main Content -->
                <div class="col-lg-8">
                    <!-- Features -->
                    <div class="card shadow-sm mb-4">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0"><i class="fas fa-star me-2"></i>Fitur Layanan</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                @foreach($package->features_array as $feature)
                                <div class="col-md-6 mb-2">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-check-circle text-success me-3"></i>
                                        <span>{{ $feature }}</span>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Preparation -->
                    @if($package->preparation)
                    <div class="card shadow-sm mb-4">
                        <div class="card-header bg-success text-white">
                            <h5 class="mb-0"><i class="fas fa-clipboard-check me-2"></i>Persiapan yang Diperlukan</h5>
                        </div>
                        <div class="card-body">
                            <div class="preparation-content">
                                {!! nl2br(e($package->preparation)) !!}
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Procedure -->
                    @if($package->procedure)
                    <div class="card shadow-sm mb-4">
                        <div class="card-header bg-info text-white">
                            <h5 class="mb-0"><i class="fas fa-procedures me-2"></i>Prosedur Pelayanan</h5>
                        </div>
                        <div class="card-body">
                            <div class="procedure-content">
                                {!! nl2br(e($package->procedure)) !!}
                            </div>
                        </div>
                    </div>
                    @endif
                </div>

                <!-- Sidebar -->
                <div class="col-lg-4">
                    <!-- Order Card -->
                    <div class="card shadow-lg border-0 mb-4">
                        <div class="card-header bg-gradient-primary text-white text-center py-4">
                            <h4 class="mb-0">Pesan Layanan</h4>
                        </div>
                        <div class="card-body text-center p-4">
                            <div class="price-display mb-4">
                                <h2 class="text-primary">{{ $package->formatted_price }}</h2>
                                <p class="text-muted">{{ $package->duration }}</p>
                            </div>
                            
                            <div class="whatsapp-button mb-4">
                                <a href="https://wa.me/6281234567890?text={{ urlencode($package->whatsapp_message) }}" 
                                   target="_blank" 
                                   class="btn btn-success btn-lg w-100 py-3">
                                    <i class="fab fa-whatsapp fa-2x me-2"></i>
                                    <span class="fw-bold">Chat via WhatsApp</span>
                                </a>
                                <small class="text-muted mt-2 d-block">Respon cepat dalam 5 menit</small>
                            </div>
                            
                            <div class="contact-info">
                                <div class="d-flex align-items-center mb-3">
                                    <i class="fas fa-phone text-primary me-3"></i>
                                    <div>
                                        <small class="text-muted d-block">Telepon</small>
                                        <strong>(021) 123-4567</strong>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-clock text-primary me-3"></i>
                                    <div>
                                        <small class="text-muted d-block">Jam Operasional</small>
                                        <strong>24/7</strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Other Packages -->
                    @if($otherPackages->count() > 0)
                    <div class="card shadow-sm">
                        <div class="card-header">
                            <h5 class="mb-0">Paket Lainnya</h5>
                        </div>
                        <div class="card-body">
                            @foreach($otherPackages as $other)
                            <div class="other-package mb-3 pb-3 border-bottom">
                                <h6 class="fw-bold">{{ $other->name }}</h6>
                                <p class="text-muted small mb-2">{{ Str::limit($other->description, 60) }}</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="badge bg-primary">{{ $other->duration }}</span>
                                    <a href="{{ route('homecare.detail', $other->slug) }}" class="btn btn-sm btn-outline-primary">
                                        Detail
                                    </a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section py-5 bg-dark text-white">
        <div class="container text-center">
            <h2 class="mb-4">Masih Ragu Memilih Paket?</h2>
            <p class="lead mb-4">Konsultasikan kebutuhan Anda dengan tim spesialis kami</p>
            <a href="https://wa.me/6281234567890" target="_blank" class="btn btn-success btn-lg me-3">
                <i class="fab fa-whatsapp me-2"></i>Konsultasi Gratis
            </a>
            <a href="tel:+62211234567" class="btn btn-outline-light btn-lg">
                <i class="fas fa-phone me-2"></i>Telepon Sekarang
            </a>
        </div>
    </section>
</div>

<style>
.package-header-section {
    color: white;
}

.package-header-section .breadcrumb {
    background: transparent;
    margin-bottom: 2rem;
}

.package-header-section .breadcrumb-item a {
    color: rgba(255,255,255,0.8);
    text-decoration: none;
}

.package-header-section .breadcrumb-item.active {
    color: white;
}

.package-header-section .breadcrumb-item + .breadcrumb-item::before {
    color: rgba(255,255,255,0.5);
}

.preparation-content, .procedure-content {
    line-height: 1.8;
    white-space: pre-line;
}

.bg-gradient-primary {
    background: linear-gradient(135deg, #667eea 0%, #2ee7ff 100%) !important;
}

.whatsapp-button .btn {
    border-radius: 10px;
    font-size: 1.1rem;
}

.other-package:last-child {
    border-bottom: none !important;
    margin-bottom: 0 !important;
    padding-bottom: 0 !important;
}

@media (max-width: 768px) {
    .package-header-section {
        text-align: center;
        padding: 40px 0;
    }
    
    .display-4 {
        font-size: 2rem;
    }
    
    .whatsapp-button .btn {
        font-size: 1rem;
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
                    return `<div class="mb-2"><strong>${trimmed}</strong></div>`;
                }
                return `<div class="mb-1">${trimmed}</div>`;
            });
            element.innerHTML = formattedLines.join('');
        }
    }
    
    formatListContent(preparationContent);
    formatListContent(procedureContent);
});
</script>
@endsection