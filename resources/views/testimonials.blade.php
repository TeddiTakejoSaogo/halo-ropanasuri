@extends('layouts.app')

@section('title', 'Testimoni Pasien')

@section('content')
<style>
    :root {
        --color-navy: #0F3460;
        --color-teal: #16a085;
        --color-teal-light: #e8f6f3;
        --glass-bg: rgba(255, 255, 255, 0.9);
        --glass-border: rgba(255, 255, 255, 0.2);
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

    /* Hero Section */
    .hero-header {
        background: linear-gradient(135deg, #f8f9fa 0%, #eef0f3 100%);
        padding: 60px 0;
        border-bottom: 1px solid #e9ecef;
    }

    /* Testimonial Card */
    .testimonial-card {
        background: white;
        border-radius: 16px;
        border: none;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        height: 100%;
        position: relative;
        overflow: hidden;
    }
    .testimonial-card::after {
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
    .testimonial-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(15, 52, 96, 0.1);
    }
    .testimonial-card:hover::after {
        transform: scaleX(1);
    }
    .testimonial-text {
        font-style: italic;
        line-height: 1.7;
        color: #4a5568;
        font-size: 0.95rem;
    }
    .patient-avatar {
        width: 50px;
        height: 50px;
        font-size: 1.1rem;
        background: var(--color-teal-light);
        color: var(--color-teal);
        font-weight: 700;
        transition: all 0.3s ease;
    }
    .testimonial-card:hover .patient-avatar {
        background: var(--color-teal);
        color: white;
    }
    .quote-icon {
        position: absolute;
        top: 20px;
        right: 20px;
        font-size: 4rem;
        color: var(--color-teal);
        opacity: 0.05;
        transition: all 0.3s ease;
    }
    .testimonial-card:hover .quote-icon {
        opacity: 0.15;
        transform: scale(1.1) rotate(5deg);
    }
    .rating-stars {
        font-size: 1rem;
        color: #ffc107;
        margin-bottom: 15px;
    }
    .rating-stars i.text-light {
        color: #e2e8f0 !important;
    }

    /* CTA Card */
    .cta-card {
        background: linear-gradient(135deg, var(--color-navy) 0%, rgba(15,52,96,0.9) 100%);
        border-radius: 20px;
        border: 1px solid rgba(255,255,255,0.1);
        position: relative;
        overflow: hidden;
    }
    .cta-card::before {
        content: '';
        position: absolute;
        top: -50px;
        right: -50px;
        width: 150px;
        height: 150px;
        background: radial-gradient(circle, rgba(22,160,133,0.3) 0%, rgba(0,0,0,0) 70%);
        border-radius: 50%;
    }
    .btn-teal {
        background-color: var(--color-teal);
        color: white;
        border: none;
        transition: all 0.3s ease;
    }
    .btn-teal:hover {
        background-color: #12876f;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(22, 160, 133, 0.3);
    }

    /* Stats Box */
    .stat-box {
        background: white;
        border: 1px solid #edf2f7;
        border-radius: 16px;
        padding: 25px 15px;
        text-align: center;
        transition: all 0.3s ease;
        box-shadow: 0 5px 15px rgba(0,0,0,0.02);
    }
    .stat-box:hover {
        border-color: var(--color-teal);
        box-shadow: 0 10px 30px rgba(22, 160, 133, 0.1);
        transform: translateY(-5px);
    }
    .stat-number {
        font-size: 2.5rem;
        font-weight: 800;
        margin-bottom: 5px;
    }
    .stat-label {
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        font-weight: 600;
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

    /* Pagination */
    .pagination .page-link {
        border-radius: 8px;
        margin: 0 4px;
        border: 1px solid #edf2f7;
        color: var(--color-navy);
        font-weight: 500;
        transition: all 0.3s ease;
    }
    .pagination .page-item.active .page-link {
        background-color: var(--color-teal);
        border-color: var(--color-teal);
        color: white;
        box-shadow: 0 5px 15px rgba(22, 160, 133, 0.2);
    }
    .pagination .page-link:hover:not(.active) {
        background-color: var(--color-teal-light);
        color: var(--color-teal);
        border-color: var(--color-teal-light);
    }

    /* Modal Form */
    .modal-content {
        border-radius: 20px;
        border: none;
        overflow: hidden;
    }
    .modal-header {
        background: var(--color-navy);
        color: white;
        border-bottom: none;
    }
    .form-control, .form-select {
        border-radius: 10px;
        border: 1px solid #edf2f7;
        padding: 12px 15px;
        transition: all 0.3s ease;
    }
    .form-control:focus, .form-select:focus {
        border-color: var(--color-teal);
        box-shadow: 0 0 0 3px rgba(22, 160, 133, 0.1);
    }
</style>

<div class="hero-header text-center reveal">
    <div class="container">
        <h6 class="text-uppercase fw-bold mb-2" style="color: var(--color-teal); letter-spacing: 2px;">Testimoni Pasien</h6>
        <h2 class="section-title mb-4">Pengalaman Nyata</h2>
        <p class="lead text-muted mx-auto" style="max-width: 700px;">Kami bangga melayani Anda. Berikut adalah pengalaman dari pasien yang telah merasakan pelayanan terbaik di rumah sakit kami.</p>
        
        <div class="row justify-content-center mt-5">
            <div class="col-lg-10">
                <div class="cta-card shadow-lg">
                    <div class="card-body p-4 p-md-5">
                        <div class="row align-items-center">
                            <div class="col-md-8 text-md-start text-center mb-4 mb-md-0">
                                <h4 class="text-white fw-bold mb-2">Bagikan Pengalaman Anda</h4>
                                <p class="text-white-50 mb-0">Pendapat Anda sangat berarti bagi kami untuk terus meningkatkan kualitas pelayanan.</p>
                            </div>
                            <div class="col-md-4 text-md-end text-center">
                                <button class="btn btn-teal btn-lg px-4 rounded-pill fw-bold" data-bs-toggle="modal" data-bs-target="#testimonialModal">
                                    <i class="fas fa-edit me-2"></i>Tulis Testimoni
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container py-5">
    <!-- Success Alert -->
    @if(session('success'))
    <div class="row mb-5 reveal">
        <div class="col-md-8 mx-auto">
            <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert" style="border-radius: 12px; border-left: 5px solid #198754;">
                <div class="d-flex align-items-center">
                    <i class="fas fa-check-circle fa-2x me-3 text-success"></i>
                    <div>
                        <h5 class="alert-heading mb-1 fw-bold">Berhasil!</h5>
                        <p class="mb-0">{{ session('success') }}</p>
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        </div>
    </div>
    @endif

    <!-- Testimonials Grid -->
    <div class="row g-4 mb-5">
        @forelse($testimonials as $testimonial)
        <div class="col-lg-6 col-xl-4 reveal">
            <div class="testimonial-card">
                <div class="card-body p-4 d-flex flex-column">
                    <!-- Decorative Quote Icon -->
                    <div class="quote-icon">
                        <i class="fas fa-quote-right"></i>
                    </div>

                    <!-- Rating Stars -->
                    <div class="rating-stars">
                        @for($i = 1; $i <= 5; $i++)
                            <i class="fas fa-star {{ $i <= $testimonial->rating ? '' : 'text-light' }}"></i>
                        @endfor
                    </div>
                    
                    <!-- Testimonial Text -->
                    <p class="testimonial-text mb-4">"{{ Str::limit($testimonial->message, 150) }}"</p>
                    
                    <!-- Patient Info -->
                    <div class="d-flex align-items-center mt-auto border-top pt-3">
                        <div class="patient-avatar rounded-circle d-flex align-items-center justify-content-center me-3">
                            <span>{{ strtoupper(substr($testimonial->patient_name, 0, 2)) }}</span>
                        </div>
                        <div>
                            <h6 class="mb-0 fw-bold" style="color: var(--color-navy);">{{ $testimonial->patient_name }}</h6>
                            <small class="text-muted">{{ $testimonial->created_at->diffForHumans() }}</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <!-- Empty State -->
        <div class="col-12 reveal">
            <div class="text-center py-5">
                <div class="mb-4">
                    <div class="d-inline-flex align-items-center justify-content-center bg-light rounded-circle" style="width: 100px; height: 100px;">
                        <i class="fas fa-comments fa-3x text-muted opacity-50"></i>
                    </div>
                </div>
                <h4 class="fw-bold" style="color: var(--color-navy);">Belum Ada Testimoni</h4>
                <p class="text-muted mb-4">Jadilah yang pertama membagikan pengalaman Anda berobat di rumah sakit kami.</p>
            </div>
        </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($testimonials->hasPages())
    <div class="row mt-4 reveal">
        <div class="col-12">
            <nav aria-label="Testimoni pagination">
                <ul class="pagination justify-content-center">
                    {{-- Previous Page Link --}}
                    @if ($testimonials->onFirstPage())
                        <li class="page-item disabled">
                            <span class="page-link"><i class="fas fa-chevron-left"></i></span>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $testimonials->previousPageUrl() }}" rel="prev"><i class="fas fa-chevron-left"></i></a>
                        </li>
                    @endif

                    {{-- Pagination Elements --}}
                    @foreach ($testimonials->getUrlRange(1, $testimonials->lastPage()) as $page => $url)
                        @if ($page == $testimonials->currentPage())
                            <li class="page-item active">
                                <span class="page-link">{{ $page }}</span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if ($testimonials->hasMorePages())
                        <li class="page-item">
                            <a class="page-link" href="{{ $testimonials->nextPageUrl() }}" rel="next"><i class="fas fa-chevron-right"></i></a>
                        </li>
                    @else
                        <li class="page-item disabled">
                            <span class="page-link"><i class="fas fa-chevron-right"></i></span>
                        </li>
                    @endif
                </ul>
            </nav>
        </div>
    </div>
    @endif

    <!-- Stats Section -->
    <div class="row mt-5 pt-4 border-top reveal">
        <div class="col-12 text-center mb-4">
            <h4 class="fw-bold" style="color: var(--color-navy);">Kinerja Pelayanan Kami</h4>
        </div>
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="stat-box">
                <div class="stat-number" style="color: var(--color-navy);">{{ $testimonials->total() }}</div>
                <div class="stat-label text-muted">Total Testimoni</div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="stat-box">
                <div class="stat-number" style="color: var(--color-teal);">4.8</div>
                <div class="stat-label text-muted">Rating Rata-rata</div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="stat-box">
                <div class="stat-number" style="color: #f39c12;">98%</div>
                <div class="stat-label text-muted">Kepuasan Pasien</div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="stat-box">
                <div class="stat-number" style="color: #e74c3c;">24/7</div>
                <div class="stat-label text-muted">Pelayanan</div>
            </div>
        </div>
    </div>
</div>

<!-- Testimonial Modal -->
<div class="modal fade" id="testimonialModal" tabindex="-1" aria-labelledby="testimonialModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shadow-lg">
            <div class="modal-header p-4">
                <h5 class="modal-title fw-bold" id="testimonialModalLabel">
                    <i class="fas fa-edit me-2"></i>Bagikan Pengalaman Anda
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4 bg-light">
                <form action="{{ route('testimonials.store') }}" method="POST" id="testimonialForm" class="bg-white p-4 rounded-4 shadow-sm border border-light">
                    @csrf
                    <!-- Honeypot Field -->
                    <div style="display: none;">
                        <label for="website_url">Leave this field empty</label>
                        <input type="text" name="website_url" id="website_url" tabindex="-1" autocomplete="off">
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold text-muted small text-uppercase">Nama Lengkap *</label>
                        <input type="text" name="patient_name" class="form-control" value="{{ old('patient_name') }}" required placeholder="Masukkan nama Anda">
                        @error('patient_name')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold text-muted small text-uppercase">Email *</label>
                        <input type="email" name="patient_email" class="form-control" value="{{ old('patient_email') }}" required placeholder="Masukkan email aktif">
                        @error('patient_email')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-4 text-center">
                        <label class="form-label fw-bold text-muted small text-uppercase d-block mb-3">Penilaian Anda</label>
                        <div class="rating-input d-inline-flex bg-light p-3 rounded-pill border">
                            @for($i = 1; $i <= 5; $i++)
                                <input type="radio" id="star{{ $i }}" name="rating" value="{{ $i }}" {{ old('rating') == $i ? 'checked' : '' }} class="d-none">
                                <label for="star{{ $i }}" class="star-label mx-1 mb-0" style="cursor: pointer;">
                                    <i class="far fa-star fa-2x" style="color: #cbd5e1; transition: color 0.2s;"></i>
                                </label>
                            @endfor
                        </div>
                        @error('rating')
                            <div class="text-danger small mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold text-muted small text-uppercase">Pesan & Kesan *</label>
                        <textarea name="message" class="form-control" rows="4" placeholder="Ceritakan pengalaman Anda berobat di sini..." required>{{ old('message') }}</textarea>
                        <div class="d-flex justify-content-between mt-2">
                            <small class="text-muted"><i class="fas fa-info-circle me-1"></i>Min. 10 karakter</small>
                        </div>
                        @error('message')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" form="testimonialForm" class="btn btn-teal btn-lg rounded-3 fw-bold">
                            <i class="fas fa-paper-plane me-2"></i>Kirim Testimoni
                        </button>
                        <button type="button" class="btn btn-light rounded-3 fw-bold text-muted" data-bs-dismiss="modal">Batal</button>
                    </div>
                </form>
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

    // Rating star interaction
    const starInputs = document.querySelectorAll('.rating-input input');
    const starLabels = document.querySelectorAll('.star-label');
    
    starLabels.forEach((label, index) => {
        label.addEventListener('mouseenter', function() {
            highlightStars(index);
        });
        
        label.addEventListener('click', function() {
            starInputs.forEach(input => input.checked = false);
            for (let i = 0; i <= index; i++) {
                starInputs[i].checked = true;
            }
        });
    });
    
    document.querySelector('.rating-input').addEventListener('mouseleave', function() {
        const checkedInput = document.querySelector('.rating-input input:checked');
        if (checkedInput) {
            const checkedIndex = Array.from(starInputs).indexOf(checkedInput);
            highlightStars(checkedIndex);
        } else {
            highlightStars(-1);
        }
    });
    
    function highlightStars(upToIndex) {
        starLabels.forEach((label, index) => {
            const icon = label.querySelector('i');
            if (index <= upToIndex) {
                icon.className = 'fas fa-star fa-2x text-warning';
                icon.style.color = '#ffc107';
            } else {
                icon.className = 'far fa-star fa-2x';
                icon.style.color = '#cbd5e1';
            }
        });
    }
    
    // Auto-show modal if there are form errors
    @if($errors->any())
        const modal = new bootstrap.Modal(document.getElementById('testimonialModal'));
        modal.show();
    @endif
    
    // Character counter
    const messageTextarea = document.querySelector('textarea[name="message"]');
    if (messageTextarea) {
        const charCount = document.createElement('small');
        charCount.className = 'text-muted';
        messageTextarea.nextElementSibling.appendChild(charCount); // Append to the d-flex div
        
        messageTextarea.addEventListener('input', function() {
            const length = this.value.length;
            charCount.textContent = `${length}/500`;
            
            if (length > 500) {
                charCount.classList.add('text-danger');
                charCount.classList.remove('text-muted');
            } else {
                charCount.classList.remove('text-danger');
                charCount.classList.add('text-muted');
            }
        });
        messageTextarea.dispatchEvent(new Event('input'));
    }
});
</script>
@endsection