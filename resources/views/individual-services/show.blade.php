@extends('layouts.app')

@section('title', $service->name)

@section('content')
<!-- Hero Section -->
<section class="py-5" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
    <div class="container py-5">
        <div class="row align-items-center">
            <div class="col-lg-6 text-white">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-light">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-white">Beranda</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('individual-services.index') }}" class="text-white">Paket Layanan</a></li>
                        <li class="breadcrumb-item active text-white" aria-current="page">{{ $service->name }}</li>
                    </ol>
                </nav>
                <h1 class="display-4 mb-3">{{ $service->name }}</h1>
                <p class="lead mb-4">{{ $service->description }}</p>
                <div class="d-flex align-items-center gap-3 mb-4">
                    <div>
                        @if($service->discount_price)
                        <div class="text-white-50 text-decoration-line-through h4 mb-0">
                            {{ $service->formatted_price }}
                        </div>
                        <h2 class="text-white mb-0">{{ $service->formatted_discount_price }}</h2>
                        @else
                        <h2 class="text-white mb-0">{{ $service->formatted_price }}</h2>
                        @endif
                    </div>
                    @if($service->discount_percentage > 0)
                    <span class="badge bg-warning py-2 px-3" style="font-size: 1.1rem;">
                        {{ $service->discount_percentage }}% OFF
                    </span>
                    @endif
                </div>
                <a href="#order-form" class="btn btn-success btn-lg me-3">
                    <i class="fab fa-whatsapp me-2"></i>Pesan Sekarang
                </a>
                <a href="{{ route('individual-services.index') }}" class="btn btn-outline-light btn-lg">
                    <i class="fas fa-arrow-left me-2"></i>Lihat Paket Lain
                </a>
            </div>
            <div class="col-lg-6">
                <div class="card border-0 shadow-lg">
                    <img src="{{ $service->image_url }}" class="card-img-top" alt="{{ $service->name }}" style="height: 300px; object-fit: cover;">
                    <div class="card-body text-center">
                        <i class="{{ $service->icon_class }} fa-3x text-primary mb-3"></i>
                        @if($service->duration_days)
                        <div class="d-flex justify-content-center gap-4 mb-3">
                            <div class="text-center">
                                <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center mb-2" style="width: 50px; height: 50px;">
                                    <i class="fas fa-calendar text-primary"></i>
                                </div>
                                <div class="small text-muted">Durasi</div>
                                <div class="fw-bold">{{ $service->duration_days }} hari</div>
                            </div>
                            <div class="text-center">
                                <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center mb-2" style="width: 50px; height: 50px;">
                                    <i class="fas fa-user-md text-primary"></i>
                                </div>
                                <div class="small text-muted">Dokter</div>
                                <div class="fw-bold">Spesialis</div>
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
<section class="py-5 bg-light">
    <div class="container">
        <div class="row mb-5">
            <div class="col-12 text-center">
                <h2 class="display-5 mb-3">Manfaat Paket</h2>
                <p class="lead text-muted">Apa yang Anda dapatkan dari paket ini</p>
            </div>
        </div>
        <div class="row g-4">
            @foreach($service->benefits_array as $index => $benefit)
            <div class="col-md-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body text-center p-4">
                        <div class="bg-primary rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                            <span class="text-white fw-bold h4 mb-0">{{ $index + 1 }}</span>
                        </div>
                        <p class="card-text">{{ $benefit }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Features Section -->
<section class="py-5 bg-white">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="text-center mb-5">
                    <h2 class="display-5 mb-3">Fitur Layanan</h2>
                    <p class="lead text-muted">Detail lengkap dari paket yang Anda pilih</p>
                </div>
                
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <ul class="list-unstyled">
                            @foreach($service->features_array as $feature)
                            <li class="mb-3">
                                <div class="d-flex">
                                    <div class="flex-shrink-0">
                                        <i class="fas fa-check-circle text-success fa-lg"></i>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h5 class="mb-1">{{ $feature }}</h5>
                                        <p class="text-muted mb-0">Termasuk dalam paket {{ $service->name }}</p>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Order Form Section -->
<section id="order-form" class="py-5 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 mx-auto">
                <div class="card border-0 shadow-lg">
                    <div class="card-header bg-primary text-white text-center py-4">
                        <h3 class="mb-0">
                            <i class="fab fa-whatsapp me-2"></i>Pesan {{ $service->name }}
                        </h3>
                        <p class="mb-0 mt-2">Isi form dan kami akan hubungi via WhatsApp</p>
                    </div>
                    <div class="card-body p-4">
                        <form action="{{ route('individual-services.order', $service->id) }}" method="POST" id="orderForm">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Nama Lengkap *</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">Nomor WhatsApp *</label>
                                    <input type="tel" name="phone" class="form-control" required placeholder="0812-3456-7890">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Email *</label>
                                    <input type="email" name="email" class="form-control" required>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Pesan Tambahan</label>
                                <textarea name="message" class="form-control" rows="4" placeholder="Kebutuhan khusus atau pertanyaan..."></textarea>
                            </div>
                            <div class="alert alert-info">
                                <i class="fas fa-info-circle me-2"></i>
                                Setelah mengisi form, Anda akan diarahkan ke WhatsApp untuk konfirmasi pemesanan.
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-success btn-lg">
                                    <i class="fab fa-whatsapp me-2"></i>Lanjutkan ke WhatsApp
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
<section class="py-5 bg-white">
    <div class="container">
        <div class="row mb-5">
            <div class="col-12 text-center">
                <h2 class="display-5 mb-3">Paket Lainnya</h2>
                <p class="lead text-muted">Mungkin Anda juga tertarik dengan paket ini</p>
            </div>
        </div>
        <div class="row g-4">
            @foreach($relatedServices as $related)
            <div class="col-md-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-img-top" style="height: 200px; overflow: hidden;">
                        <img src="{{ $related->image_url }}" class="w-100 h-100" style="object-fit: cover;" alt="{{ $related->name }}">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $related->name }}</h5>
                        <p class="card-text text-muted small">{{ Str::limit($related->description, 80) }}</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                @if($related->discount_price)
                                <div class="text-muted text-decoration-line-through small">
                                    {{ $related->formatted_price }}
                                </div>
                                <h5 class="text-primary mb-0">{{ $related->formatted_discount_price }}</h5>
                                @else
                                <h5 class="text-primary mb-0">{{ $related->formatted_price }}</h5>
                                @endif
                            </div>
                            <a href="{{ route('individual-services.show', $related->slug) }}" class="btn btn-outline-primary btn-sm">
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

<style>
.breadcrumb-light .breadcrumb-item + .breadcrumb-item::before {
    color: rgba(255,255,255,0.7);
}

.breadcrumb-light .breadcrumb-item a {
    color: rgba(255,255,255,0.9);
}

.breadcrumb-light .breadcrumb-item a:hover {
    color: white;
    text-decoration: none;
}

#order-form {
    scroll-margin-top: 100px;
}

.card {
    border-radius: 15px;
    overflow: hidden;
}

@media (max-width: 768px) {
    .display-4 {
        font-size: 2rem;
    }
    
    .lead {
        font-size: 1rem;
    }
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
                value = value.match(/.{1,4}/g).join('-');
            }
            e.target.value = value;
        });
    }

    // Form validation
    const form = document.getElementById('orderForm');
    const submitBtn = form.querySelector('button[type="submit"]');
    
    form.addEventListener('submit', function(e) {
        const originalText = submitBtn.innerHTML;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Memproses...';
        submitBtn.disabled = true;
    });
});
</script>
@endsection