@extends('layouts.app')

@section('title', $article->title . ' - Berita')

@section('content')
<div class="news-detail-page bg-light pb-5">
    <!-- Breadcrumb Section -->
    <div class="bg-navy py-4 border-bottom border-teal">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-white-50 text-decoration-none hover-teal">Beranda</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('news') }}" class="text-white-50 text-decoration-none hover-teal">Berita</a></li>
                    <li class="breadcrumb-item active text-white" aria-current="page">{{ Str::limit($article->title, 40) }}</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="container py-5">
        <div class="row g-5">
            <!-- Main Content -->
            <div class="col-lg-8">
                <!-- Article Content -->
                <article class="card border-0 rounded-4 shadow-sm overflow-hidden mb-5">
                    @if($article->image)
                    <div class="position-relative">
                        <img src="{{ $article->image_url }}" class="w-100" 
                             alt="{{ $article->title }}" style="max-height: 500px; object-fit: cover;">
                        <div class="position-absolute bottom-0 start-0 w-100 p-4" style="background: linear-gradient(to top, rgba(15, 52, 96, 0.9), transparent);">
                            <span class="badge bg-teal px-3 py-2 rounded-pill fs-6 mb-2">{{ $article->category }}</span>
                        </div>
                    </div>
                    @endif
                    
                    <div class="card-body p-4 p-md-5 bg-white">
                        <div class="d-flex flex-wrap gap-4 align-items-center mb-4 text-muted small fw-medium pb-4 border-bottom">
                            <div class="d-flex align-items-center">
                                <div class="bg-teal-light rounded-circle p-2 me-2">
                                    <i class="fas fa-calendar-alt text-teal"></i>
                                </div>
                                {{ $article->created_at->translatedFormat('d F Y') }}
                            </div>
                            <div class="d-flex align-items-center">
                                <div class="bg-teal-light rounded-circle p-2 me-2">
                                    <i class="fas fa-user-edit text-teal"></i>
                                </div>
                                Oleh Admin RS
                            </div>
                            <div class="d-flex align-items-center">
                                <div class="bg-teal-light rounded-circle p-2 me-2">
                                    <i class="fas fa-eye text-teal"></i>
                                </div>
                                1.2k Kali Dibaca
                            </div>
                        </div>
                        
                        <h1 class="card-title fw-bold text-navy mb-4 lh-base">{{ $article->title }}</h1>
                        
                        <div class="article-content text-muted">
                            {!! $article->content !!}
                        </div>
                    </div>
                </article>

                <!-- Share Buttons -->
                <div class="card border-0 rounded-4 shadow-sm mb-4 bg-white">
                    <div class="card-body p-4 text-center">
                        <h5 class="fw-bold text-navy mb-4">Bagikan Artikel Ini</h5>
                        <div class="d-flex justify-content-center flex-wrap gap-3 share-buttons">
                            <a href="#" class="btn btn-outline-primary rounded-pill px-4 hover-lift">
                                <i class="fab fa-facebook-f me-2"></i> Facebook
                            </a>
                            <a href="#" class="btn btn-outline-info rounded-pill px-4 hover-lift">
                                <i class="fab fa-twitter me-2"></i> Twitter
                            </a>
                            <a href="#" class="btn btn-outline-success rounded-pill px-4 hover-lift">
                                <i class="fab fa-whatsapp me-2"></i> WhatsApp
                            </a>
                            <a href="#" class="btn btn-outline-navy rounded-pill px-4 hover-lift" id="copyLinkBtn">
                                <i class="fas fa-link me-2"></i> Salin Link
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <!-- Recent Articles -->
                <div class="card border-0 rounded-4 shadow-sm mb-5 position-sticky" style="top: 100px;">
                    <div class="card-header bg-navy text-white p-4 border-0 rounded-top-4">
                        <h5 class="mb-0 fw-bold"><i class="fas fa-newspaper text-teal me-2"></i>Artikel Terbaru</h5>
                    </div>
                    <div class="card-body p-0 bg-white">
                        <div class="list-group list-group-flush rounded-bottom-4">
                            @forelse($recentArticles as $recent)
                            <a href="{{ route('news.detail', $recent->slug) }}" class="list-group-item list-group-item-action p-4 border-bottom hover-bg-light transition-all">
                                <h6 class="fw-bold text-navy mb-2 lh-base">{{ $recent->title }}</h6>
                                <small class="text-teal fw-medium">
                                    <i class="far fa-clock me-1"></i> {{ $recent->created_at->diffForHumans() }}
                                </small>
                            </a>
                            @empty
                            <div class="p-4 text-center text-muted">
                                Belum ada artikel lainnya.
                            </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- Categories -->
                <div class="card border-0 rounded-4 shadow-sm mb-4">
                    <div class="card-header bg-white p-4 border-0 border-bottom">
                        <h5 class="mb-0 fw-bold text-navy"><i class="fas fa-tags text-teal me-2"></i>Kategori Populer</h5>
                    </div>
                    <div class="card-body p-4 bg-white rounded-bottom-4">
                        <div class="d-flex flex-wrap gap-2">
                            <span class="badge bg-teal-light text-navy border hover-lift-subtle px-3 py-2 rounded-pill cursor-pointer">Kesehatan Umum</span>
                            <span class="badge bg-teal-light text-navy border hover-lift-subtle px-3 py-2 rounded-pill cursor-pointer">Kesehatan Anak</span>
                            <span class="badge bg-teal-light text-navy border hover-lift-subtle px-3 py-2 rounded-pill cursor-pointer">Kesehatan Jantung</span>
                            <span class="badge bg-teal-light text-navy border hover-lift-subtle px-3 py-2 rounded-pill cursor-pointer">Penyakit Dalam</span>
                            <span class="badge bg-teal-light text-navy border hover-lift-subtle px-3 py-2 rounded-pill cursor-pointer">Gizi & Diet</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
.border-teal { border-color: var(--color-teal) !important; border-width: 4px !important; }

/* Utilities */
.hover-teal:hover { color: var(--color-teal) !important; }
.transition-all { transition: all 0.3s ease; }
.hover-bg-light:hover { background-color: #f8f9fa; }
.cursor-pointer { cursor: pointer; }

/* Hover Effects */
.hover-lift {
    transition: transform 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275), box-shadow 0.3s ease;
}
.hover-lift:hover {
    transform: translateY(-3px);
    box-shadow: 0 5px 15px rgba(15, 52, 96, 0.1) !important;
}

.hover-lift-subtle {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.hover-lift-subtle:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 10px rgba(15, 52, 96, 0.08) !important;
}

/* Article Content Formatting */
.article-content {
    line-height: 1.9;
    font-size: 1.05rem;
    color: #4a5568 !important;
}

.article-content h2, .article-content h3, .article-content h4 {
    color: var(--color-navy);
    margin-top: 2.5rem;
    margin-bottom: 1.2rem;
    font-weight: 700;
}

.article-content h2 { font-size: 1.8rem; }
.article-content h3 { font-size: 1.5rem; }

.article-content p {
    margin-bottom: 1.5rem;
    text-align: justify;
}

.article-content ul, .article-content ol {
    margin-bottom: 1.5rem;
    padding-left: 1.5rem;
}

.article-content li {
    margin-bottom: 0.75rem;
}

.article-content li::marker {
    color: var(--color-teal);
    font-weight: bold;
}

.article-content blockquote {
    background-color: var(--color-teal-light);
    border-left: 4px solid var(--color-teal);
    border-radius: 0 8px 8px 0;
    padding: 1.5rem;
    margin: 2rem 0;
    font-style: italic;
    color: var(--color-navy);
    font-weight: 500;
}

.article-content img {
    max-width: 100%;
    height: auto;
    border-radius: 12px;
    margin: 2rem 0;
    box-shadow: 0 5px 15px rgba(0,0,0,0.08);
}

/* Share Buttons Override */
.btn-outline-navy {
    color: var(--color-navy);
    border-color: var(--color-navy);
}
.btn-outline-navy:hover {
    color: #fff;
    background-color: var(--color-navy);
    border-color: var(--color-navy);
}

@media (max-width: 768px) {
    .article-content {
        font-size: 1rem;
    }
    .share-buttons .btn {
        width: 100%;
        margin-bottom: 0.5rem;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Copy link functionality
    const copyLinkBtn = document.getElementById('copyLinkBtn');
    if (copyLinkBtn) {
        copyLinkBtn.addEventListener('click', function(e) {
            e.preventDefault();
            const url = window.location.href;
            
            navigator.clipboard.writeText(url).then(function() {
                const originalText = copyLinkBtn.innerHTML;
                copyLinkBtn.innerHTML = '<i class="fas fa-check me-2"></i> Tersalin!';
                copyLinkBtn.classList.remove('btn-outline-navy');
                copyLinkBtn.classList.add('btn-success', 'text-white');
                
                setTimeout(function() {
                    copyLinkBtn.innerHTML = originalText;
                    copyLinkBtn.classList.remove('btn-success', 'text-white');
                    copyLinkBtn.classList.add('btn-outline-navy');
                }, 2000);
            });
        });
    }
});
</script>
@endsection