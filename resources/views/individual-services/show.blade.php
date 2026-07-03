@extends('layouts.app')

@section('title', $service->name . ' - Paket Layanan')

@section('content')
<div class="individual-services-detail pb-5 bg-light">
    <!-- Hero Section -->
    <section class="package-hero position-relative py-5 overflow-hidden">
        <div class="bg-shape"></div>
        <div class="container py-5 position-relative z-2">
            <div class="row align-items-center g-5">
                <div class="col-lg-6 text-white">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb breadcrumb-light mb-4">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-white-50 text-decoration-none">Beranda</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('individual-services.index') }}" class="text-white-50 text-decoration-none">Paket Layanan</a></li>
                            <li class="breadcrumb-item active text-white" aria-current="page">{{ $service->name }}</li>
                        </ol>
                    </nav>
                    <span class="badge bg-teal-light text-teal mb-3 fs-6 px-3 py-2 rounded-pill"><i class="fas fa-stethoscope me-2"></i>Layanan Medis</span>
                    <h1 class="display-4 fw-bold mb-3">{{ $service->name }}</h1>
                    <p class="lead text-white-50 mb-4">{{ $service->description }}</p>
                    
                    <div class="d-flex align-items-center flex-wrap gap-3 mb-4">
                        <div class="bg-white p-3 rounded-4 shadow-sm text-navy">
                            @if($service->discount_price)
                            <div class="text-muted text-decoration-line-through small fw-medium mb-1">
                                {{ $service->formatted_price }}
                            </div>
                            <h2 class="text-teal mb-0 fw-bold">{{ $service->formatted_discount_price }}</h2>
                            @else
                            <h2 class="text-teal mb-0 fw-bold">{{ $service->formatted_price }}</h2>
                            @endif
                        </div>
                        
                        @if($service->discount_percentage > 0)
                        <span class="badge bg-danger py-2 px-3 rounded-pill fw-bold" style="font-size: 1.1rem; box-shadow: 0 4px 15px rgba(220, 53, 69, 0.4);">
                            Diskon {{ $service->discount_percentage }}%
                        </span>
                        @endif
                    </div>
                    
                    <div class="d-flex flex-wrap gap-3 mt-4">
                        <a href="#order-form" class="btn btn-teal btn-lg px-4 rounded-pill shadow-sm hover-lift">
                            <i class="fab fa-whatsapp me-2"></i>Pesan Sekarang
                        </a>
                        <a href="{{ route('individual-services.index') }}" class="btn btn-outline-light btn-lg px-4 rounded-pill hover-lift">
                            <i class="fas fa-arrow-left me-2"></i>Lihat Paket Lain
                        </a>
                    </div>
                </div>
                
                <div class="col-lg-6">
                    <div class="card border-0 rounded-4 shadow-lg overflow-hidden rotate-img">
                        <img src="{{ $service->image_url }}" class="card-img-top" alt="{{ $service->name }}" style="height: 350px; object-fit: cover;">
                        <div class="card-body text-center p-4 bg-white">
                            <i class="{{ $service->icon_class ?? 'fas fa-heartbeat' }} fa-3x text-teal mb-3"></i>
                            @if($service->duration_days)
                            <div class="d-flex justify-content-center gap-4 mt-2">
                                <div class="text-center px-3 border-end">
                                    <div class="bg-teal-light rounded-circle d-inline-flex align-items-center justify-content-center mb-2" style="width: 50px; height: 50px;">
                                        <i class="fas fa-calendar text-teal fs-5"></i>
                                    </div>
                                    <div class="small text-muted mb-1">Durasi Layanan</div>
                                    <div class="fw-bold text-navy">{{ $service->duration_days }} hari</div>
                                </div>
                                <div class="text-center px-3">
                                    <div class="bg-teal-light rounded-circle d-inline-flex align-items-center justify-content-center mb-2" style="width: 50px; height: 50px;">
                                        <i class="fas fa-user-md text-teal fs-5"></i>
                                    </div>
                                    <div class="small text-muted mb-1">Tenaga Medis</div>
                                    <div class="fw-bold text-navy">Dokter Spesialis</div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Benefits Section -->
    @if(count($service->benefits_array) > 0)
    <section class="py-5 position-relative">
        <div class="container py-4">
            <div class="row mb-5 justify-content-center">
                <div class="col-lg-8 text-center">
                    <span class="text-teal fw-bold tracking-wider text-uppercase small mb-2 d-block">Keuntungan</span>
                    <h2 class="display-6 fw-bold text-navy mb-3">Manfaat Layanan Ini</h2>
                    <div class="heading-line mx-auto"></div>
                </div>
            </div>
            <div class="row g-4 justify-content-center">
                @foreach($service->benefits_array as $index => $benefit)
                <div class="col-md-6 col-lg-4">
                    <div class="card border-0 rounded-4 shadow-sm h-100 hover-lift-subtle text-center p-4 bg-white">
                        <div class="bg-teal-light rounded-circle d-inline-flex align-items-center justify-content-center mb-4 mx-auto" style="width: 70px; height: 70px;">
                            <span class="text-teal fw-bold h3 mb-0">{{ $index + 1 }}</span>
                        </div>
                        <h5 class="card-title fw-bold text-navy mb-3">Manfaat Utama</h5>
                        <p class="card-text text-muted">{{ $benefit }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- Features Section -->
    <section class="py-5 bg-white">
        <div class="container py-4">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center mb-5">
                    <span class="text-teal fw-bold tracking-wider text-uppercase small mb-2 d-block">Detail Fasilitas</span>
                    <h2 class="display-6 fw-bold text-navy mb-3">Fitur Layanan</h2>
                    <div class="heading-line mx-auto"></div>
                </div>
            </div>
            
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="card border-0 rounded-4 shadow-sm overflow-hidden">
                        <div class="card-body p-0">
                            <div class="row g-0">
                                @foreach($service->features_array as $index => $feature)
                                <div class="col-md-6 border-bottom {{ $index % 2 == 0 ? 'border-end-md' : '' }}">
                                    <div class="d-flex p-4 align-items-start hover-bg-light transition-all h-100">
                                        <div class="flex-shrink-0 mt-1">
                                            <i class="fas fa-check-circle text-teal fa-lg"></i>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h5 class="mb-1 text-navy fw-bold">{{ $feature }}</h5>
                                            <p class="text-muted small mb-0">Fasilitas termasuk dalam paket ini</p>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Order Form Section -->
    <section id="order-form" class="py-5 position-relative">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center mb-5">
                    <span class="text-teal fw-bold tracking-wider text-uppercase small mb-2 d-block">Registrasi</span>
                    <h2 class="display-6 fw-bold text-navy mb-3">Pesan Layanan Sekarang</h2>
                    <p class="text-muted">Isi formulir di bawah ini dan tim kami akan segera menghubungi Anda melalui WhatsApp.</p>
                </div>
            </div>
            
            <div class="row justify-content-center">
                <div class="col-lg-7">
                    <div class="card border-0 rounded-4 shadow-lg overflow-hidden form-card position-relative z-2">
                        <div class="card-header bg-navy text-white text-center py-4 border-0">
                            <h4 class="mb-0 fw-bold"><i class="fab fa-whatsapp me-2 text-teal"></i>Form Pemesanan</h4>
                        </div>
                        <div class="card-body p-4 p-md-5 bg-white">
                            <form action="{{ route('individual-services.order', $service->id) }}" method="POST" id="orderForm">
                                @csrf
                                <div class="form-floating mb-4">
                                    <input type="text" name="name" class="form-control form-control-lg custom-input" id="nameInput" placeholder="Nama Lengkap" required>
                                    <label for="nameInput">Nama Lengkap *</label>
                                </div>
                                <div class="row g-4 mb-4">
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="tel" name="phone" class="form-control form-control-lg custom-input" id="phoneInput" placeholder="0812-3456-7890" required>
                                            <label for="phoneInput">Nomor WhatsApp *</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="email" name="email" class="form-control form-control-lg custom-input" id="emailInput" placeholder="name@example.com" required>
                                            <label for="emailInput">Email Valid *</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-floating mb-4">
                                    <textarea name="message" class="form-control custom-input" id="messageInput" placeholder="Kebutuhan khusus atau pertanyaan..." style="height: 120px"></textarea>
                                    <label for="messageInput">Pesan Tambahan (Opsional)</label>
                                </div>
                                
                                <div class="alert bg-teal-light text-navy border-0 rounded-3 mb-4 d-flex align-items-center p-3">
                                    <i class="fas fa-info-circle text-teal fs-4 me-3"></i>
                                    <div class="small">
                                        Data Anda aman. Setelah klik tombol, Anda akan otomatis diarahkan ke chat WhatsApp untuk konfirmasi detail jadwal.
                                    </div>
                                </div>
                                
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-teal btn-lg rounded-pill py-3 fw-bold shadow-sm hover-lift">
                                        <i class="fab fa-whatsapp me-2"></i>Kirim & Lanjutkan ke WhatsApp
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Related Packages -->
    @if($relatedServices->count() > 0)
    <section class="py-5 bg-white border-top">
        <div class="container py-4">
            <div class="row mb-5 align-items-end">
                <div class="col-md-8">
                    <h3 class="display-6 fw-bold text-navy mb-2">Paket Lainnya</h3>
                    <p class="text-muted mb-0">Rekomendasi layanan kesehatan yang mungkin sesuai untuk Anda.</p>
                </div>
                <div class="col-md-4 text-md-end mt-3 mt-md-0">
                    <a href="{{ route('individual-services.index') }}" class="btn btn-outline-navy rounded-pill px-4 hover-lift">Lihat Semua</a>
                </div>
            </div>
            
            <div class="row g-4">
                @foreach($relatedServices as $related)
                <div class="col-md-6 col-lg-4">
                    <div class="card border-0 rounded-4 shadow-sm h-100 hover-lift overflow-hidden">
                        <div class="card-img-top position-relative" style="height: 200px;">
                            <img src="{{ $related->image_url }}" class="w-100 h-100" style="object-fit: cover;" alt="{{ $related->name }}">
                            @if($related->discount_percentage > 0)
                            <div class="position-absolute top-0 end-0 m-3">
                                <span class="badge bg-danger rounded-pill px-2 py-1 shadow-sm">
                                    -{{ $related->discount_percentage }}%
                                </span>
                            </div>
                            @endif
                        </div>
                        <div class="card-body p-4 d-flex flex-column bg-white">
                            <h5 class="card-title fw-bold text-navy mb-2">{{ $related->name }}</h5>
                            <p class="card-text text-muted small mb-4 flex-grow-1">{{ Str::limit($related->description, 80) }}</p>
                            
                            <div class="d-flex justify-content-between align-items-end mt-auto pt-3 border-top">
                                <div>
                                    @if($related->discount_price)
                                    <div class="text-muted text-decoration-line-through small" style="font-size: 0.8rem;">
                                        {{ $related->formatted_price }}
                                    </div>
                                    <h5 class="text-teal fw-bold mb-0">{{ $related->formatted_discount_price }}</h5>
                                    @else
                                    <h5 class="text-teal fw-bold mb-0">{{ $related->formatted_price }}</h5>
                                    @endif
                                </div>
                                <a href="{{ route('individual-services.show', $related->slug) }}" class="btn btn-outline-navy btn-sm rounded-pill px-3 hover-lift">
                                    Detail
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
</div>

<style>
/* Theme Variables */
:root {
    --color-navy: #0F3460;
    --color-teal: #16a085;
    --color-teal-light: #e8f6f3;
}

.text-navy { color: var(--color-navy) !important; }
.text-teal { color: var(--color-teal) !important; }
.bg-navy { background-color: var(--color-navy) !important; }
.bg-teal-light { background-color: var(--color-teal-light) !important; }
.bg-teal { background-color: var(--color-teal) !important; }

/* Utilities */
.tracking-wider { letter-spacing: 0.1em; }
.transition-all { transition: all 0.3s ease; }
.hover-bg-light:hover { background-color: #f8f9fa; }

/* Hover Effects */
.hover-lift {
    transition: transform 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275), box-shadow 0.3s ease;
}
.hover-lift:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 30px rgba(15, 52, 96, 0.15) !important;
}

.hover-lift-subtle {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.hover-lift-subtle:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 25px rgba(15, 52, 96, 0.1) !important;
}

.rotate-img {
    transition: transform 0.5s ease;
}
.rotate-img:hover {
    transform: scale(1.02) rotate(1deg);
}

/* Sections */
.package-hero {
    background: linear-gradient(135deg, var(--color-navy) 0%, #1a4a82 100%);
    color: white;
}
.bg-shape {
    position: absolute;
    top: -30%;
    right: -10%;
    width: 600px;
    height: 600px;
    border-radius: 50%;
    background: radial-gradient(circle, rgba(22,160,133,0.2) 0%, rgba(0,0,0,0) 70%);
    z-index: 1;
}

.heading-line {
    width: 60px;
    height: 4px;
    background-color: var(--color-teal);
    border-radius: 2px;
}

/* Form Styles */
#order-form {
    scroll-margin-top: 100px;
}

.custom-input {
    border: 1px solid #e0e0e0;
    border-radius: 10px;
    background-color: #fcfcfc;
    transition: all 0.3s ease;
}
.custom-input:focus {
    background-color: #ffffff;
    border-color: var(--color-teal);
    box-shadow: 0 0 0 4px rgba(22, 160, 133, 0.1);
}
.form-floating > label {
    color: #6c757d;
}

@media (min-width: 768px) {
    .border-end-md {
        border-right: 1px solid #dee2e6;
    }
}

@media (max-width: 768px) {
    .package-hero {
        text-align: center;
    }
    .package-hero .d-flex {
        justify-content: center;
    }
    .display-4 { font-size: 2.2rem; }
    .display-6 { font-size: 1.8rem; }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Format nomor telepon
    const phoneInput = document.querySelector('input[name="phone"]');
    if (phoneInput) {
        phoneInput.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length > 0) {
                value = value.match(/.{1,4}/g)?.join('-') || value;
            }
            e.target.value = value;
        });
    }

    // Form validation loading state
    const form = document.getElementById('orderForm');
    if(form) {
        const submitBtn = form.querySelector('button[type="submit"]');
        form.addEventListener('submit', function(e) {
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Memproses...';
            submitBtn.disabled = true;
            // The form will submit normally to the server/whatsapp route
        });
    }
});
</script>
@endsection