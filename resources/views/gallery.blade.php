@extends('layouts.app')

@section('title', 'Galeri - Rumah Sakit Khusus Bedah Ropanasuri')

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
    .hero-section {
        position: relative;
        padding: 120px 0 80px 0;
        color: white;
        overflow: hidden;
    }
    
    .hero-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, rgba(15, 52, 96, 0.8) 0%, rgba(26, 26, 46, 0.9) 100%), 
                    url('{{ asset('storage/gallery/bgabout.jpg') }}');
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
        z-index: 1;
    }

    .hero-section::after {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(22,160,133,0.15) 0%, rgba(0,0,0,0) 70%);
        z-index: 1;
        animation: pulseBg 15s ease-in-out infinite alternate;
    }

    .hero-content {
        position: relative;
        z-index: 2;
    }

    /* Section Headings */
    .section-title {
        color: var(--color-navy);
        font-weight: 700;
        position: relative;
        display: inline-block;
        margin-bottom: 40px;
    }
    .section-title::after {
        content: '';
        position: absolute;
        bottom: -10px;
        left: 50%;
        transform: translateX(-50%);
        width: 50px;
        height: 3px;
        background: var(--color-teal);
        border-radius: 3px;
    }

    /* Filter Buttons */
    .filter-buttons .btn-filter {
        background: white;
        border: 2px solid #e9ecef;
        color: #6c757d;
        padding: 10px 25px;
        margin: 0 5px 10px;
        border-radius: 25px;
        transition: all 0.3s ease;
        font-weight: 500;
    }

    .filter-buttons .btn-filter:hover,
    .filter-buttons .btn-filter.active {
        background: var(--color-teal);
        border-color: var(--color-teal);
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(22, 160, 133, 0.3);
    }

    /* Gallery Cards */
    .gallery-card {
        background: white;
        border-radius: 16px;
        overflow: hidden;
        border: none;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        height: 100%;
        position: relative;
    }
    
    .gallery-card::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 4px;
        background: var(--color-teal);
        transform: scaleX(0);
        transform-origin: left;
        transition: transform 0.4s ease;
    }

    .gallery-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(15, 52, 96, 0.1);
    }
    
    .gallery-card:hover::after {
        transform: scaleX(1);
    }

    .gallery-image {
        position: relative;
        overflow: hidden;
        aspect-ratio: 4/3;
    }

    .gallery-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .gallery-card:hover .gallery-image img {
        transform: scale(1.1);
    }

    .gallery-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(to bottom, transparent 40%, rgba(15, 52, 96, 0.9));
        opacity: 0;
        transition: all 0.3s ease;
        display: flex;
        align-items: flex-end;
        padding: 20px;
    }

    .gallery-card:hover .gallery-overlay {
        opacity: 1;
    }

    .gallery-content {
        color: white;
        transform: translateY(20px);
        transition: transform 0.3s ease;
    }

    .gallery-card:hover .gallery-content {
        transform: translateY(0);
    }

    .gallery-title {
        font-size: 1.1rem;
        font-weight: 600;
        margin-bottom: 5px;
        color: white;
    }

    .gallery-badge {
        font-size: 0.75rem;
        padding: 5px 10px;
        margin-bottom: 8px;
        border-radius: 20px;
    }
    
    .badge-facility { background-color: var(--color-navy); color: white; border: none; }
    .badge-activity { background-color: var(--color-teal); color: white; border: none; }
    .badge-event { background-color: #f39c12; color: white; border: none; }

    .gallery-description {
        font-size: 0.85rem;
        opacity: 0.9;
        margin-bottom: 15px;
        line-height: 1.5;
    }

    /* Stats Box */
    .stat-box {
        background: white;
        border: 1px solid #edf2f7;
        border-radius: 16px;
        padding: 30px 20px;
        text-align: center;
        transition: all 0.3s ease;
        height: 100%;
        box-shadow: 0 5px 15px rgba(0,0,0,0.02);
    }
    .stat-box:hover {
        border-color: var(--color-teal);
        box-shadow: 0 10px 30px rgba(22, 160, 133, 0.1);
        transform: translateY(-5px);
    }
    .stat-box h3 {
        color: var(--color-navy);
        font-weight: 800;
        font-size: 2.5rem;
        margin-bottom: 5px;
    }
    .stat-box p {
        color: #6c757d;
        font-weight: 500;
        margin-bottom: 0;
        text-transform: uppercase;
        letter-spacing: 1px;
        font-size: 0.85rem;
    }
    .stat-icon {
        width: 70px;
        height: 70px;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 20px;
        background: var(--color-teal-light);
        color: var(--color-teal);
        transition: all 0.4s ease;
    }
    .stat-box:hover .stat-icon {
        background: var(--color-teal);
        color: white;
        transform: rotateY(180deg);
    }

    /* Lightbox Modal */
    #imageModal .modal-content {
        border-radius: 20px;
        overflow: hidden;
        border: none;
        box-shadow: 0 25px 50px rgba(0,0,0,0.2);
    }
    
    .modal-header-custom {
        background: var(--color-navy);
        color: white;
        border-bottom: none;
    }

    #modalImage {
        max-height: 70vh;
        width: auto;
        max-width: 100%;
        border-radius: 0 0 10px 10px;
    }

    /* Animations */
    @keyframes pulseBg { 0% { opacity: 0.5; transform: scale(1); } 100% { opacity: 1; transform: scale(1.1); } }
    
    .reveal {
        opacity: 0;
        transform: translateY(30px);
        transition: all 0.8s ease-out;
    }
    .reveal.active {
        opacity: 1;
        transform: translateY(0);
    }

    .gallery-item {
        animation: fadeInUp 0.6s ease;
    }

    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .gallery-item.loading {
        opacity: 0.5;
        pointer-events: none;
    }
</style>

<!-- Hero Section -->
<section class="hero-section text-center">
    <div class="container hero-content">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <h1 class="display-4 fw-bold mb-4" style="line-height: 1.2;">Galeri Kami</h1>
                <p class="lead mb-0 fs-5" style="color: rgba(255,255,255,0.85);">
                    Lihat momen-momen spesial dan fasilitas terbaik di Rumah Sakit Khusus Bedah Ropanasuri
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Filter Section -->
<section class="py-5 bg-light border-bottom">
    <div class="container py-4">
        <div class="text-center mb-5 reveal">
            <h6 class="text-uppercase fw-bold mb-2" style="color: var(--color-teal); letter-spacing: 2px;">Jelajahi Galeri</h6>
            <h2 class="section-title">Dokumentasi Kami</h2>
            <p class="text-muted mx-auto" style="max-width: 600px;">Temukan berbagai aktivitas, fasilitas, dan acara yang kami selenggarakan</p>
        </div>
        
        <div class="row justify-content-center reveal">
            <div class="col-12 text-center">
                <div class="filter-buttons">
                    <button class="btn btn-filter active" data-filter="all">Semua</button>
                    <button class="btn btn-filter" data-filter="facility">Fasilitas</button>
                    <button class="btn btn-filter" data-filter="activity">Kegiatan</button>
                    <button class="btn btn-filter" data-filter="event">Acara</button>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Gallery Grid -->
<section class="py-5 bg-white">
    <div class="container py-4">
        <div class="row g-4" id="gallery-grid">
            @foreach($galleries as $gallery)
            <div class="col-xl-3 col-lg-4 col-md-6 gallery-item" data-category="{{ $gallery->type }}">
                <div class="gallery-card">
                    <div class="gallery-image">
                        <img src="{{ asset('storage/' . $gallery->image) }}" 
                             alt="{{ $gallery->title }}"
                             class="img-fluid">
                        <div class="gallery-overlay">
                            <div class="gallery-content w-100">
                                <h5 class="gallery-title">{{ $gallery->title }}</h5>
                                <span class="gallery-badge badge {{ $gallery->type == 'facility' ? 'badge-facility' : ($gallery->type == 'activity' ? 'badge-activity' : 'badge-event') }}">
                                    {{ $gallery->type_name }}
                                </span>
                                @if($gallery->description)
                                <p class="gallery-description">{{ Str::limit($gallery->description, 60) }}</p>
                                @endif
                                <button class="btn btn-light btn-sm view-image w-100 rounded-pill fw-bold" 
                                        style="color: var(--color-navy);"
                                        data-image="{{ asset('storage/' . $gallery->image) }}"
                                        data-title="{{ $gallery->title }}"
                                        data-description="{{ $gallery->description }}"
                                        data-type="{{ $gallery->type_name }}"
                                        data-type-class="{{ $gallery->type == 'facility' ? 'badge-facility' : ($gallery->type == 'activity' ? 'badge-activity' : 'badge-event') }}">
                                    <i class="fas fa-expand me-1"></i> Lihat Foto
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        @if($galleries->isEmpty())
        <div class="text-center py-5 reveal">
            <div class="empty-state">
                <i class="fas fa-images fa-4x text-muted mb-3 opacity-50"></i>
                <h4 class="text-muted fw-bold" style="color: var(--color-navy);">Belum ada foto di galeri</h4>
                <p class="text-muted">Foto-foto akan segera ditambahkan ke dalam galeri kami.</p>
            </div>
        </div>
        @endif
    </div>
</section>

<!-- Statistics Section -->
<section class="py-5 bg-light border-top">
    <div class="container py-4">
        <div class="row g-4 reveal">
            <div class="col-lg-3 col-md-6">
                <div class="stat-box">
                    <div class="stat-icon">
                        <i class="fas fa-images fa-2x"></i>
                    </div>
                    <h3>{{ $galleries->count() }}+</h3>
                    <p>Total Foto</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="stat-box">
                    <div class="stat-icon">
                        <i class="fas fa-building fa-2x"></i>
                    </div>
                    <h3>{{ $galleries->where('type', 'facility')->count() }}+</h3>
                    <p>Fasilitas</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="stat-box">
                    <div class="stat-icon">
                        <i class="fas fa-users fa-2x"></i>
                    </div>
                    <h3>{{ $galleries->where('type', 'activity')->count() }}+</h3>
                    <p>Kegiatan</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="stat-box">
                    <div class="stat-icon">
                        <i class="fas fa-calendar-alt fa-2x"></i>
                    </div>
                    <h3>{{ $galleries->where('type', 'event')->count() }}+</h3>
                    <p>Acara</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Lightbox Modal -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header modal-header-custom p-3">
                <h5 class="modal-title fw-bold" id="imageModalTitle"></h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center p-0 bg-light">
                <img id="modalImage" src="" alt="" class="img-fluid w-100" style="object-fit: contain;">
                <div class="p-4 bg-white text-start">
                    <span id="modalType" class="badge mb-3 px-3 py-2 rounded-pill"></span>
                    <p id="modalDescription" class="text-muted mb-0 fs-5" style="line-height: 1.6;"></p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Scroll reveal
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
    revealOnScroll();

    // Filter functionality
    const filterButtons = document.querySelectorAll('.btn-filter');
    const galleryItems = document.querySelectorAll('.gallery-item');
    
    filterButtons.forEach(button => {
        button.addEventListener('click', function() {
            filterButtons.forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');
            
            const filterValue = this.getAttribute('data-filter');
            
            galleryItems.forEach(item => {
                if (filterValue === 'all' || item.getAttribute('data-category') === filterValue) {
                    item.style.display = 'block';
                    item.classList.add('loading');
                    setTimeout(() => {
                        item.classList.remove('loading');
                    }, 300);
                } else {
                    item.style.display = 'none';
                }
            });
        });
    });
    
    // Lightbox functionality
    const viewButtons = document.querySelectorAll('.view-image');
    const imageModal = new bootstrap.Modal(document.getElementById('imageModal'));
    const modalImage = document.getElementById('modalImage');
    const modalTitle = document.getElementById('imageModalTitle');
    const modalType = document.getElementById('modalType');
    const modalDescription = document.getElementById('modalDescription');
    
    viewButtons.forEach(button => {
        button.addEventListener('click', function() {
            const imageUrl = this.getAttribute('data-image');
            const title = this.getAttribute('data-title');
            const description = this.getAttribute('data-description');
            const type = this.getAttribute('data-type');
            const typeClass = this.getAttribute('data-type-class');
            
            modalImage.src = imageUrl;
            modalImage.alt = title;
            modalTitle.textContent = title;
            modalType.textContent = type;
            modalType.className = `badge px-3 py-2 rounded-pill ${typeClass}`;
            modalDescription.textContent = description || 'Tidak ada deskripsi';
            
            imageModal.show();
        });
    });
});
</script>
@endsection