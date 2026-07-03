@extends('layouts.app')

@section('title', 'Berita & Artikel Kesehatan')

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
    .news-hero {
        position: relative;
        padding: 120px 0 100px 0;
        background: linear-gradient(135deg, var(--color-navy) 0%, #1a1a2e 100%);
        color: white;
        overflow: hidden;
    }
    
    .news-hero::before {
        content: '';
        position: absolute;
        top: 0; left: 0; width: 100%; height: 100%;
        background: url('https://images.unsplash.com/photo-1504439468489-c8920d796a29?auto=format&fit=crop&w=1920&q=80') center/cover;
        opacity: 0.15;
        z-index: 1;
    }

    .news-hero::after {
        content: '';
        position: absolute;
        bottom: 0; left: 0; right: 0;
        height: 40px;
        background: #f8f9fa; /* Matches bg-light */
        border-radius: 50% 50% 0 0 / 100% 100% 0 0;
        z-index: 2;
        transform: scaleX(1.1);
    }

    .hero-content {
        position: relative;
        z-index: 2;
    }

    .hero-icon {
        color: rgba(255, 255, 255, 0.1);
        transform: rotate(15deg);
        transition: transform 0.5s ease;
    }
    .news-hero:hover .hero-icon {
        transform: rotate(0deg) scale(1.1);
    }

    /* Featured Article */
    .card-hover-wrapper {
        height: 100%;
        display: block;
        text-decoration: none;
    }

    .card-hover-wrapper:hover .featured-article,
    .card-hover-wrapper:hover .article-card {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px rgba(15, 52, 96, 0.1);
        border-color: var(--color-teal-light);
    }

    .card-hover-wrapper:hover .category-card {
        background: var(--color-teal-light);
        transform: translateY(-5px);
        border-color: var(--color-teal);
    }

    .featured-article {
        border-radius: 20px;
        background: white;
        border: 1px solid #f0f0f0;
        box-shadow: 0 15px 35px rgba(0,0,0,0.04);
        transition: all 0.4s ease;
    }

    .featured-article img {
        border-radius: 20px 0 0 20px;
        transition: transform 0.6s ease;
    }

    .featured-article .img-container {
        overflow: hidden;
        border-radius: 20px 0 0 20px;
        background-color: #f8f9fa;
        min-height: 350px;
        position: relative;
    }

    .card-hover-wrapper:hover .featured-article img {
        transform: scale(1.05);
    }

    @media (max-width: 991px) {
        .featured-article img, .featured-article .img-container {
            border-radius: 20px 20px 0 0;
        }
    }

    .badge-category {
        background-color: var(--color-teal);
        color: white;
        padding: 6px 15px;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.8rem;
        box-shadow: 0 4px 10px rgba(22, 160, 133, 0.2);
    }

    /* Article Cards Grid */
    .article-card {
        background: white;
        border-radius: 18px;
        border: 1px solid #f0f0f0;
        box-shadow: 0 10px 30px rgba(0,0,0,0.03);
        transition: all 0.4s ease;
    }

    .card-img-wrapper {
        position: relative;
        overflow: hidden;
        border-radius: 18px 18px 0 0;
        height: 220px;
        background-color: #f8f9fa;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .card-img-wrapper img {
        transition: transform 0.6s ease;
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .card-hover-wrapper:hover .card-img-wrapper img {
        transform: scale(1.08);
    }

    .card-overlay {
        background: linear-gradient(to top, rgba(0,0,0,0.5), transparent);
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .card-hover-wrapper:hover .card-overlay {
        opacity: 1;
    }

    .card-meta small {
        color: #888;
        font-size: 0.85rem;
    }
    .card-meta i {
        color: var(--color-teal);
    }

    .article-title-link {
        color: var(--color-navy);
        text-decoration: none;
        font-weight: 700;
        transition: color 0.3s ease;
    }
    
    .card-hover-wrapper:hover .article-title-link {
        color: var(--color-teal);
    }

    /* Category Cards */
    .category-card {
        border-radius: 16px;
        border: 1px solid #f0f0f0;
        background: white;
        box-shadow: 0 8px 25px rgba(0,0,0,0.02);
        transition: all 0.3s ease;
    }

    .category-icon {
        width: 60px; height: 60px;
        background: white;
        border-radius: 50%;
        display: inline-flex;
        align-items: center; justify-content: center;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        transition: transform 0.3s ease;
    }

    .card-hover-wrapper:hover .category-icon {
        transform: scale(1.1) rotate(5deg);
    }

    .category-card .card-title {
        color: var(--color-navy);
        font-weight: 700;
    }

    /* Newsletter Section */
    .newsletter-box {
        background: linear-gradient(135deg, var(--color-navy) 0%, #1a1a2e 100%);
        border-radius: 20px;
        position: relative;
        overflow: hidden;
    }
    
    .newsletter-box::after {
        content: '';
        position: absolute;
        top: -50%; left: -20%; width: 50%; height: 200%;
        background: radial-gradient(circle, rgba(22, 160, 133, 0.2) 0%, rgba(0,0,0,0) 70%);
        z-index: 1;
    }

    /* Empty State */
    .empty-state-icon {
        background: var(--color-teal-light);
        width: 100px; height: 100px;
        border-radius: 50%;
        display: inline-flex; align-items: center; justify-content: center;
        margin: 0 auto 20px;
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
<section class="news-hero py-5">
    <div class="container hero-content">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb" style="--bs-breadcrumb-divider-color: rgba(255,255,255,0.5);">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-white text-decoration-none opacity-75">Beranda</a></li>
                        <li class="breadcrumb-item active text-white fw-bold" aria-current="page">Berita & Artikel</li>
                    </ol>
                </nav>
                <h1 class="display-4 fw-bold mb-3">Pusat Informasi Kesehatan</h1>
                <p class="lead mb-4 opacity-75" style="max-width: 600px; line-height: 1.8;">Kumpulan artikel medis terkini, tips pola hidup sehat, dan pembaruan informasi dari para pakar kesehatan kami.</p>
                <div class="d-flex flex-wrap gap-2">
                    <span class="badge bg-white text-dark py-2 px-3 rounded-pill shadow-sm">Kesehatan Umum</span>
                    <span class="badge bg-white text-dark py-2 px-3 rounded-pill shadow-sm">Tips Sehat</span>
                    <span class="badge bg-white text-dark py-2 px-3 rounded-pill shadow-sm">Pengetahuan Medis</span>
                    <span class="badge bg-white text-dark py-2 px-3 rounded-pill shadow-sm">Update RS</span>
                </div>
            </div>
            <div class="col-lg-4 text-lg-end d-none d-lg-block">
                <div class="hero-icon">
                    <i class="fas fa-book-medical fa-8x"></i>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Content Section -->
<section class="py-5 bg-light">
    <div class="container">
        <!-- Section Header -->
        <div class="row mb-5 reveal">
            <div class="col-12 text-center text-md-start">
                <h6 class="text-uppercase fw-bold mb-2" style="color: var(--color-teal); letter-spacing: 2px;">Terbaru dari Kami</h6>
                <h2 class="h2 fw-bold text-dark">Artikel Terkini</h2>
            </div>
        </div>

        @if($articles->count() > 0)
        <!-- Featured Article (Large) -->
        @php $featured = $articles->first(); @endphp
        @if($featured)
        <div class="row mb-5 reveal">
            <div class="col-12">
                <div class="card-hover-wrapper">
                    <div class="featured-article h-100">
                        <div class="row g-0 h-100">
                        <div class="col-lg-6 img-container">
                            <img src="{{ $featured->image_url }}" 
                                 class="img-fluid h-100 w-100" 
                                 alt="{{ $featured->title }}"
                                 style="object-fit: cover; min-height: 350px;">
                        </div>
                        <div class="col-lg-6">
                            <div class="card-body p-4 p-lg-5 d-flex flex-column h-100 justify-content-center">
                                <div class="mb-3 d-flex align-items-center">
                                    <span class="badge-category me-3">{{ $featured->category }}</span>
                                    <small class="text-muted fw-medium">
                                        <i class="fas fa-calendar-alt me-1" style="color: var(--color-teal);"></i>
                                        {{ $featured->created_at->translatedFormat('d F Y') }}
                                    </small>
                                </div>
                                <h3 class="card-title h2 fw-bold mb-3" style="color: var(--color-navy);">{{ $featured->title }}</h3>
                                <p class="card-text text-muted mb-4" style="line-height: 1.7; font-size: 1.05rem;">
                                    {{ Str::limit(strip_tags($featured->content), 200) }}
                                </p>
                                <div class="d-flex align-items-center justify-content-between mt-auto pt-3 border-top">
                                    <div class="reading-time">
                                        <small class="text-muted fw-medium">
                                            <i class="far fa-clock me-1" style="color: var(--color-teal);"></i>
                                            {{ ceil(str_word_count(strip_tags($featured->content)) / 200) }} menit baca
                                        </small>
                                    </div>
                                    <a href="{{ route('news.detail', $featured->slug) }}" 
                                       class="btn text-white px-4" style="background-color: var(--color-teal); border-radius: 8px;">
                                        Baca Lengkap <i class="fas fa-arrow-right ms-2"></i>
                                    </a>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <!-- Articles Grid -->
        <div class="row g-4">
            @foreach($articles->skip(1) as $article)
            <div class="col-xl-4 col-md-6 reveal" style="transition-delay: {{ $loop->index * 0.1 }}s;">
                <div class="card-hover-wrapper">
                    <article class="article-card d-flex flex-column h-100">
                        <div class="card-img-wrapper">
                            <img src="{{ $article->image_url }}" 
                                 class="card-img-top w-100" 
                                 alt="{{ $article->title }}"
                                 style="height: 220px; object-fit: cover;">
                            <div class="card-overlay position-absolute top-0 start-0 w-100 h-100 d-flex align-items-start p-3">
                                <span class="badge-category shadow-sm">{{ $article->category }}</span>
                            </div>
                        </div>
                        
                        <div class="card-body p-4 d-flex flex-column flex-grow-1">
                            <div class="card-meta mb-3 d-flex justify-content-between">
                                <small class="fw-medium">
                                    <i class="far fa-calendar-alt"></i> {{ $article->created_at->translatedFormat('d M Y') }}
                                </small>
                                <small class="fw-medium">
                                    <i class="far fa-clock"></i> {{ ceil(str_word_count(strip_tags($article->content)) / 200) }} mnt
                                </small>
                            </div>
                            
                            <h5 class="card-title mb-3 lh-base">
                                <a href="{{ route('news.detail', $article->slug) }}" class="article-title-link stretched-link">
                                    {{ $article->title }}
                                </a>
                            </h5>
                            
                            <p class="card-text text-muted small flex-grow-1" style="line-height: 1.6;">
                                {{ Str::limit(strip_tags($article->content), 120) }}
                            </p>
                            
                            <div class="mt-4 pt-3 border-top d-flex align-items-center justify-content-between position-relative" style="z-index: 2;">
                                <small class="text-muted"><i class="far fa-eye me-1"></i> Populer</small>
                                <a href="{{ route('news.detail', $article->slug) }}" class="text-decoration-none fw-bold" style="color: var(--color-teal);">
                                    Baca <i class="fas fa-arrow-right ms-1"></i>
                                </a>
                            </div>
                        </div>
                    </article>
                </div>
            </div>
            @endforeach
        </div>

        @else
        <!-- Empty State -->
        <div class="row reveal">
            <div class="col-12">
                <div class="text-center py-5 bg-white shadow-sm" style="border-radius: 20px;">
                    <div class="empty-state-icon">
                        <i class="far fa-newspaper fa-3x" style="color: var(--color-teal);"></i>
                    </div>
                    <h3 class="h4 fw-bold mb-3" style="color: var(--color-navy);">Belum Ada Artikel</h3>
                    <p class="text-muted mb-4 mx-auto" style="max-width: 500px;">Tim redaksi kami sedang menyusun konten-konten kesehatan terbaik untuk Anda. Silakan kembali lagi nanti.</p>
                    <a href="{{ route('home') }}" class="btn text-white px-4 py-2" style="background-color: var(--color-navy); border-radius: 8px;">
                        <i class="fas fa-home me-2"></i> Kembali ke Beranda
                    </a>
                </div>
            </div>
        </div>
        @endif

        <!-- Categories Section -->
        <div class="row mt-5 pt-4 reveal">
            <div class="col-12 text-center mb-4">
                <h6 class="text-uppercase fw-bold mb-2" style="color: var(--color-teal); letter-spacing: 2px;">Eksplorasi Topik</h6>
                <h3 class="fw-bold" style="color: var(--color-navy);">Kategori Artikel</h3>
            </div>
            
            <div class="col-md-3 col-6 mb-4">
                <div class="card-hover-wrapper">
                    <a href="#" class="category-card card text-center text-decoration-none h-100 p-2">
                        <div class="card-body">
                            <div class="category-icon mb-3">
                                <i class="fas fa-heartbeat fa-2x" style="color: #e74c3c;"></i>
                            </div>
                            <h5 class="card-title mb-1 fs-6">Kesehatan Jantung</h5>
                            <small class="text-muted">Tips kardiovaskular</small>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-md-3 col-6 mb-4">
                <div class="card-hover-wrapper">
                    <a href="#" class="category-card card text-center text-decoration-none h-100 p-2">
                        <div class="card-body">
                            <div class="category-icon mb-3">
                                <i class="fas fa-baby fa-2x" style="color: #3498db;"></i>
                            </div>
                            <h5 class="card-title mb-1 fs-6">Kesehatan Anak</h5>
                            <small class="text-muted">Tumbuh kembang</small>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-md-3 col-6 mb-4">
                <div class="card-hover-wrapper">
                    <a href="#" class="category-card card text-center text-decoration-none h-100 p-2">
                        <div class="card-body">
                            <div class="category-icon mb-3">
                                <i class="fas fa-apple-alt fa-2x" style="color: #2ecc71;"></i>
                            </div>
                            <h5 class="card-title mb-1 fs-6">Gizi & Diet</h5>
                            <small class="text-muted">Pola makan sehat</small>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-md-3 col-6 mb-4">
                <div class="card-hover-wrapper">
                    <a href="#" class="category-card card text-center text-decoration-none h-100 p-2">
                        <div class="card-body">
                            <div class="category-icon mb-3">
                                <i class="fas fa-brain fa-2x" style="color: #9b59b6;"></i>
                            </div>
                            <h5 class="card-title mb-1 fs-6">Kesehatan Mental</h5>
                            <small class="text-muted">Ketenangan jiwa</small>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <!-- Newsletter Subscription -->
        <div class="row mt-5 pb-4 reveal">
            <div class="col-12">
                <div class="newsletter-box text-white p-4 p-lg-5 shadow-lg">
                    <div class="row align-items-center position-relative" style="z-index: 2;">
                        <div class="col-lg-8 mb-4 mb-lg-0">
                            <h3 class="fw-bold mb-2">Selalu Update dengan Info Kesehatan</h3>
                            <p class="mb-0 opacity-75">Berlangganan buletin gratis kami untuk menerima artikel, tips, dan penawaran eksklusif langsung ke email Anda.</p>
                        </div>
                        <div class="col-lg-4 text-lg-end">
                            <button class="btn btn-light btn-lg px-4" data-bs-toggle="modal" data-bs-target="#newsletterModal" style="border-radius: 10px; font-weight: 600; color: var(--color-navy);">
                                <i class="fas fa-envelope-open-text me-2" style="color: var(--color-teal);"></i> Mulai Berlangganan
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Newsletter Modal -->
<div class="modal fade" id="newsletterModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius: 20px; border: none; overflow: hidden;">
            <div class="modal-header text-white px-4 py-3" style="background-color: var(--color-navy); border-bottom: none;">
                <h5 class="modal-title fw-bold"><i class="fas fa-paper-plane me-2" style="color: var(--color-teal);"></i> Berlangganan Newsletter</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4 p-md-5">
                <p class="text-muted mb-4 text-center">Bergabunglah dengan ribuan pembaca setia lainnya untuk wawasan medis terpercaya.</p>
                <form id="newsletterForm">
                    <div class="mb-3">
                        <label class="form-label fw-medium text-dark small">Nama Lengkap</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0 text-muted"><i class="far fa-user"></i></span>
                            <input type="text" class="form-control border-start-0 ps-0 bg-light" placeholder="Masukkan nama Anda">
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-medium text-dark small">Alamat Email</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0 text-muted"><i class="far fa-envelope"></i></span>
                            <input type="email" class="form-control border-start-0 ps-0 bg-light" placeholder="nama@email.com">
                        </div>
                    </div>
                    <div class="form-check mb-4">
                        <input class="form-check-input" type="checkbox" id="newsletterConsent">
                        <label class="form-check-label text-muted small" for="newsletterConsent" style="line-height: 1.5;">
                            Saya setuju untuk menerima pembaruan artikel dan informasi promosi kesehatan.
                        </label>
                    </div>
                    <button type="button" class="btn text-white w-100 py-3" onclick="subscribeNewsletter()" style="background-color: var(--color-teal); border-radius: 12px; font-weight: 600;">
                        Berlangganan Sekarang
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
// Newsletter Function
function subscribeNewsletter() {
    const form = document.getElementById('newsletterForm');
    const consent = document.getElementById('newsletterConsent');
    
    if (!consent.checked) {
        alert('Harap centang kotak persetujuan newsletter terlebih dahulu.');
        return;
    }
    
    const modal = bootstrap.Modal.getInstance(document.getElementById('newsletterModal'));
    modal.hide();
    
    const alertBox = document.createElement('div');
    alertBox.className = 'alert bg-white shadow-sm border-0 d-flex align-items-center fade show mt-4 reveal active';
    alertBox.style.borderRadius = '12px';
    alertBox.style.borderLeft = '5px solid var(--color-teal) !important';
    alertBox.innerHTML = `
        <i class="fas fa-check-circle fa-2x me-3" style="color: var(--color-teal);"></i>
        <div class="flex-grow-1">
            <strong style="color: var(--color-navy);">Pendaftaran Berhasil!</strong><br>
            <span class="text-muted small">Terima kasih telah berlangganan newsletter kesehatan kami.</span>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    `;
    
    const container = document.querySelector('.container');
    container.insertBefore(alertBox, document.querySelector('.row.mb-5.reveal').nextSibling);
    
    form.reset();
}

// Scroll Reveal Animation
document.addEventListener('DOMContentLoaded', function() {
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
    revealOnScroll(); // Trigger on load
});
</script>
@endsection