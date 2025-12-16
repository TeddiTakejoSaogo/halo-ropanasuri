@extends('layouts.app')

@section('title', 'Galeri - Rumah Sakit Khusus Bedah Ropanasuri')

@section('content')
<!-- Hero Section -->
<section class="hero-section-gallery">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="display-4 text-white mb-3">Galeri Kami</h1>
                <p class="lead text-white mb-4">Lihat momen-momen spesial dan fasilitas terbaik di Rumah Sakit Khusus Bedah Ropanasuri</p>
            </div>
        </div>
    </div>
</section>

<!-- Filter Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="text-center mb-5">
                    <h2 class="h1 mb-3">Jelajahi Galeri</h2>
                    <p class="text-muted">Temukan berbagai aktivitas, fasilitas, dan acara yang kami selenggarakan</p>
                </div>
                
                <!-- Filter Buttons -->
                <div class="filter-buttons text-center mb-5">
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
<section class="py-5">
    <div class="container">
        <div class="row g-4" id="gallery-grid">
            @foreach($galleries as $gallery)
            <div class="col-xl-3 col-lg-4 col-md-6 gallery-item" data-category="{{ $gallery->type }}">
                <div class="gallery-card">
                    <div class="gallery-image">
                        <img src="{{ asset('storage/' . $gallery->image) }}" 
                             alt="{{ $gallery->title }}"
                             class="img-fluid">
                        <div class="gallery-overlay">
                            <div class="gallery-content">
                                <h5 class="gallery-title">{{ $gallery->title }}</h5>
                                <span class="gallery-badge badge bg-{{ $gallery->type == 'facility' ? 'primary' : ($gallery->type == 'activity' ? 'success' : 'warning') }}">
                                    {{ $gallery->type_name }}
                                </span>
                                @if($gallery->description)
                                <p class="gallery-description">{{ Str::limit($gallery->description, 80) }}</p>
                                @endif
                                <button class="btn btn-light btn-sm view-image" 
                                        data-image="{{ asset('storage/' . $gallery->image) }}"
                                        data-title="{{ $gallery->title }}"
                                        data-description="{{ $gallery->description }}"
                                        data-type="{{ $gallery->type_name }}">
                                    <i class="fas fa-expand me-1"></i> Lihat
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        @if($galleries->isEmpty())
        <div class="text-center py-5">
            <div class="empty-state">
                <i class="fas fa-images fa-4x text-muted mb-3"></i>
                <h4 class="text-muted">Belum ada foto di galeri</h4>
                <p class="text-muted">Foto-foto akan segera ditambahkan</p>
            </div>
        </div>
        @endif
    </div>
</section>

<!-- Statistics Section -->
<section class="py-5 bg-primary text-white">
    <div class="container">
        <div class="row text-center">
            <div class="col-md-3 mb-4">
                <div class="stat-item">
                    <i class="fas fa-images fa-3x mb-3"></i>
                    <h3 class="mb-1">{{ $galleries->count() }}+</h3>
                    <p class="mb-0">Total Foto</p>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="stat-item">
                    <i class="fas fa-building fa-3x mb-3"></i>
                    <h3 class="mb-1">{{ $galleries->where('type', 'facility')->count() }}+</h3>
                    <p class="mb-0">Fasilitas</p>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="stat-item">
                    <i class="fas fa-users fa-3x mb-3"></i>
                    <h3 class="mb-1">{{ $galleries->where('type', 'activity')->count() }}+</h3>
                    <p class="mb-0">Kegiatan</p>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="stat-item">
                    <i class="fas fa-calendar-alt fa-3x mb-3"></i>
                    <h3 class="mb-1">{{ $galleries->where('type', 'event')->count() }}+</h3>
                    <p class="mb-0">Acara</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Lightbox Modal -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title" id="imageModalTitle"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center p-0">
                <img id="modalImage" src="" alt="" class="img-fluid">
                <div class="p-3">
                    <span id="modalType" class="badge mb-2"></span>
                    <p id="modalDescription" class="text-muted mb-0"></p>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Hero Section */
.hero-section-gallery {
    background: linear-gradient(135deg, rgba(66, 195, 235, 0.8), rgba(93, 218, 250, 0.8)), 
                url('{{ asset('storage/gallery/bgabout.jpg') }}');
    background-size: cover;
    background-position: center;
    background-attachment: fixed;
    padding: 120px 0;
    position: relative;
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
    background: var(--primary-color);
    border-color: var(--primary-color);
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(4, 160, 152, 0.3);
}

/* Gallery Cards */
.gallery-card {
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
    background: white;
    height: 100%;
}

.gallery-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
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
    transition: transform 0.3s ease;
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
    background: linear-gradient(to bottom, transparent 40%, rgba(0, 0, 0, 0.8));
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
    font-size: 0.7rem;
    padding: 4px 8px;
    margin-bottom: 8px;
}

.gallery-description {
    font-size: 0.85rem;
    opacity: 0.9;
    margin-bottom: 10px;
    line-height: 1.4;
}

/* Statistics */
.stat-item {
    padding: 20px;
}

.stat-item i {
    opacity: 0.8;
}

.stat-item h3 {
    font-weight: 700;
    font-size: 2.5rem;
}

/* Empty State */
.empty-state {
    padding: 60px 20px;
}

/* Lightbox Modal */
#imageModal .modal-content {
    border-radius: 15px;
    overflow: hidden;
}

#modalImage {
    max-height: 70vh;
    width: auto;
    max-width: 100%;
}

/* Responsive */
@media (max-width: 768px) {
    .hero-section-gallery {
        padding: 80px 0;
        background-attachment: scroll;
    }
    
    .filter-buttons .btn-filter {
        padding: 8px 15px;
        margin: 0 2px 5px;
        font-size: 0.9rem;
    }
    
    .gallery-card {
        margin-bottom: 20px;
    }
}

/* Animation */
.gallery-item {
    animation: fadeInUp 0.6s ease;
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Loading State */
.gallery-item.loading {
    opacity: 0.5;
    pointer-events: none;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Filter functionality
    const filterButtons = document.querySelectorAll('.btn-filter');
    const galleryItems = document.querySelectorAll('.gallery-item');
    
    filterButtons.forEach(button => {
        button.addEventListener('click', function() {
            // Remove active class from all buttons
            filterButtons.forEach(btn => btn.classList.remove('active'));
            
            // Add active class to clicked button
            this.classList.add('active');
            
            const filterValue = this.getAttribute('data-filter');
            
            // Filter gallery items
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
            
            modalImage.src = imageUrl;
            modalImage.alt = title;
            modalTitle.textContent = title;
            modalType.textContent = type;
            modalType.className = `badge bg-${type === 'Fasilitas' ? 'primary' : (type === 'Kegiatan' ? 'success' : 'warning')}`;
            modalDescription.textContent = description || 'Tidak ada deskripsi';
            
            imageModal.show();
        });
    });
    
    // Lazy loading images
    if ('IntersectionObserver' in window) {
        const imageObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    img.src = img.getAttribute('data-src');
                    img.classList.remove('lazy');
                    imageObserver.unobserve(img);
                }
            });
        });
        
        document.querySelectorAll('img[data-src]').forEach(img => {
            imageObserver.observe(img);
        });
    }
    
    // Smooth scroll to gallery section
    document.querySelectorAll('a[href="#gallery"]').forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            document.querySelector('#gallery').scrollIntoView({
                behavior: 'smooth'
            });
        });
    });
});
</script>
@endsection