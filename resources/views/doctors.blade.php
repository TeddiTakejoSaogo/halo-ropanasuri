@extends('layouts.app')

@section('title', 'Dokter Spesialis')

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
    .doc-hero-section {
        position: relative;
        padding: 120px 0 140px 0;
        background: linear-gradient(135deg, var(--color-navy) 0%, #1a1a2e 100%);
        color: white;
        text-align: center;
        overflow: hidden;
    }
    
    .doc-hero-section::before {
        content: '';
        position: absolute;
        top: 0; left: 0; width: 100%; height: 100%;
        background: url('https://images.unsplash.com/photo-1551076805-e1869033e561?auto=format&fit=crop&w=1920&q=80') center/cover;
        opacity: 0.15;
        z-index: 1;
    }

    .doc-hero-content {
        position: relative;
        z-index: 2;
    }

    /* Floating Search Bar */
    .search-filter-wrapper {
        position: relative;
        z-index: 10;
        margin-top: -60px;
        margin-bottom: 50px;
    }

    .search-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.5);
        border-radius: 20px;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
    }

    .form-control, .form-select {
        border: 2px solid #e9ecef;
        border-radius: 12px;
        padding: 0.8rem 1.2rem;
        transition: all 0.3s ease;
    }

    .form-control:focus, .form-select:focus {
        border-color: var(--color-teal);
        box-shadow: 0 0 0 0.25rem rgba(22, 160, 133, 0.1);
    }

    .search-btn {
        background-color: var(--color-teal);
        color: white;
        border: none;
        border-radius: 12px;
        padding: 0.8rem 2rem;
        font-weight: 600;
        transition: all 0.3s;
    }
    .search-btn:hover {
        background-color: #12876f;
        transform: translateY(-2px);
    }

    /* Doctor Cards */
    .doctor-card {
        background: white;
        border-radius: 20px;
        border: 1px solid #f0f0f0;
        box-shadow: 0 10px 30px rgba(0,0,0,0.03);
        transition: all 0.4s ease;
        height: 100%;
        display: flex;
        flex-direction: column;
        overflow: hidden;
    }

    .doctor-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(15, 52, 96, 0.1);
        border-color: var(--color-teal-light);
    }

    .card-img-wrapper {
        position: relative;
        height: 280px;
        overflow: hidden;
        background: #f8f9fa;
    }

    .card-img-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.6s ease;
    }

    .doctor-card:hover .card-img-wrapper img {
        transform: scale(1.08);
    }

    .spec-badge {
        position: absolute;
        top: -15px;
        left: 20px;
        background: var(--color-teal);
        color: white;
        padding: 8px 20px;
        border-radius: 30px;
        font-size: 0.85rem;
        font-weight: 600;
        box-shadow: 0 5px 15px rgba(22, 160, 133, 0.3);
        z-index: 2;
    }

    .doc-body {
        position: relative;
        padding: 2.5rem 1.5rem 1.5rem;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }

    .doc-name {
        color: var(--color-navy);
        font-weight: 800;
        font-size: 1.3rem;
        margin-bottom: 0.5rem;
    }

    .doc-info {
        color: #6c757d;
        font-size: 0.9rem;
        margin-bottom: 8px;
        display: flex;
        align-items: flex-start;
    }
    
    .doc-info i {
        color: var(--color-teal);
        margin-top: 3px;
        margin-right: 10px;
        width: 16px;
        text-align: center;
    }

    .schedule-box {
        background: var(--color-teal-light);
        border-radius: 12px;
        padding: 15px;
        margin-top: auto;
    }
    
    .schedule-title {
        color: var(--color-navy);
        font-size: 0.85rem;
        font-weight: 700;
        margin-bottom: 8px;
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    
    .schedule-list li {
        font-size: 0.85rem;
        color: #555;
        margin-bottom: 4px;
        display: flex;
        justify-content: space-between;
        border-bottom: 1px dashed rgba(0,0,0,0.05);
        padding-bottom: 4px;
    }
    .schedule-list li:last-child {
        border-bottom: none; margin-bottom: 0; padding-bottom: 0;
    }

    /* Modal Styling */
    .modal-content {
        border-radius: 20px;
        border: none;
        overflow: hidden;
    }
    .modal-header {
        background: var(--color-navy);
        color: white;
        border-bottom: none;
        padding: 1.5rem 2rem;
    }
    .modal-header .btn-close {
        filter: invert(1) grayscale(100%) brightness(200%);
    }
    .modal-profile-img {
        width: 200px; height: 200px;
        object-fit: cover;
        border-radius: 50%;
        border: 5px solid white;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        margin-top: -80px;
        position: relative;
        z-index: 3;
    }
    .modal-detail-title {
        color: var(--color-navy);
        font-weight: 700;
        border-bottom: 2px solid var(--color-teal-light);
        padding-bottom: 8px;
        margin-bottom: 15px;
    }

    /* Empty State */
    .empty-state-icon {
        background: var(--color-teal-light);
        width: 100px; height: 100px;
        border-radius: 50%;
        display: inline-flex; align-items: center; justify-content: center;
        margin-bottom: 20px;
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
<section class="doc-hero-section">
    <div class="container doc-hero-content">
        <h6 class="text-uppercase fw-bold mb-3" style="color: var(--color-teal); letter-spacing: 3px;">Tim Medis Ahli</h6>
        <h1 class="display-4 fw-bold mb-3">Dokter Spesialis Kami</h1>
        <p class="lead opacity-75 mx-auto" style="max-width: 700px; line-height: 1.8;">
            Kami berkolaborasi dengan tenaga medis profesional berlisensi tinggi yang berdedikasi penuh untuk memulihkan dan merawat kesehatan Anda sepenuh hati.
        </p>
    </div>
</section>

<!-- Search and Filter Section (Floating) -->
<div class="container search-filter-wrapper reveal">
    <div class="row">
        <div class="col-lg-10 mx-auto">
            <div class="search-card p-4">
                <form action="{{ route('doctors') }}" method="GET" id="searchForm">
                    <div class="row g-3 align-items-center">
                        <div class="col-md-7">
                            <div class="position-relative">
                                <i class="fas fa-search position-absolute text-muted" style="left: 15px; top: 18px;"></i>
                                <input type="text" name="search" class="form-control" style="padding-left: 45px;"
                                       placeholder="Cari nama dokter, latar belakang..." 
                                       value="{{ request('search') }}"
                                       id="searchInput">
                                <button class="btn position-absolute" type="button" id="clearSearch" style="right: 5px; top: 7px; color: #aaa;">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <select name="specialization" class="form-select" id="specializationSelect">
                                <option value="">Semua Spesialisasi</option>
                                @foreach($specializations as $spec)
                                    <option value="{{ $spec }}" {{ request('specialization') == $spec ? 'selected' : '' }}>
                                        {{ $spec }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="search-btn w-100">
                                Cari <i class="fas fa-arrow-right ms-1"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="container py-2 mb-5">
    <!-- Search Results Info -->
    @if(request()->hasAny(['search', 'specialization']))
    <div class="row mb-5 reveal">
        <div class="col-lg-10 mx-auto">
            <div class="alert bg-light border-0 d-flex align-items-center shadow-sm" style="border-radius: 12px; border-left: 5px solid var(--color-teal) !important;">
                <i class="fas fa-info-circle fa-2x me-3" style="color: var(--color-teal);"></i>
                <div class="flex-grow-1">
                    <strong style="color: var(--color-navy);">Hasil Pencarian:</strong>
                    <span class="text-muted">Menemukan {{ $doctors->count() }} tenaga medis</span>
                    @if(request('search'))
                        untuk "<strong>{{ request('search') }}</strong>"
                    @endif
                    @if(request('specialization'))
                        kategori <strong>{{ request('specialization') }}</strong>
                    @endif
                </div>
                <a href="{{ route('doctors') }}" class="btn btn-sm btn-outline-secondary" style="border-radius: 8px;">
                    <i class="fas fa-times me-1"></i> Reset
                </a>
            </div>
        </div>
    </div>
    @endif

    <!-- Doctors Grid -->
    <div class="row g-4" id="doctorsGrid">
        @forelse($doctors as $doctor)
        <div class="col-lg-4 col-md-6 reveal" style="transition-delay: {{ $loop->index * 0.1 }}s;">
            <div class="doctor-card">
                <div class="card-img-wrapper">
                    <img src="{{ $doctor->photo ? asset('storage/' . $doctor->photo) : 'https://via.placeholder.com/300x300?text=No+Image' }}" 
                         alt="{{ $doctor->name }}">
                </div>
                
                <div class="doc-body">
                    <div class="spec-badge">
                        {{ $doctor->specialization }}
                    </div>
                    <h4 class="doc-name">{{ $doctor->name }}</h4>
                    
                    <div class="doc-info">
                        <i class="fas fa-graduation-cap"></i>
                        <span>{{ $doctor->education }}</span>
                    </div>
                    
                    @if($doctor->experience)
                    <div class="doc-info mb-3">
                        <i class="fas fa-briefcase"></i>
                        <span>{{ $doctor->experience }}</span>
                    </div>
                    @endif
                    
                    <div class="schedule-box mt-4 mb-4">
                        <div class="schedule-title"><i class="far fa-clock me-1"></i> Jadwal Praktik</div>
                        <ul class="schedule-list list-unstyled mb-0">
                            @foreach($doctor->getActiveSchedules()->take(3) as $schedule)
                            <li>
                                <strong>{{ $schedule->day_name }}</strong> 
                                <span>{{ $schedule->start_time }} - {{ $schedule->end_time }}</span>
                            </li>
                            @endforeach
                            @if($doctor->getActiveSchedules()->count() > 3)
                            <li class="text-center mt-2 border-0" style="color: var(--color-teal); font-weight: 600;">
                                + {{ $doctor->getActiveSchedules()->count() - 3 }} jadwal lainnya
                            </li>
                            @endif
                        </ul>
                    </div>
                    
                    <button class="btn btn-outline-secondary w-100" style="border-radius: 10px; border-width: 2px;" data-bs-toggle="modal" data-bs-target="#doctorModal{{ $doctor->id }}">
                        <i class="fas fa-id-badge me-2"></i> Profil Lengkap
                    </button>
                </div>
            </div>
        </div>

        <!-- Doctor Detail Modal -->
        <div class="modal fade" id="doctorModal{{ $doctor->id }}" tabindex="-1">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body px-4 px-md-5 pb-5">
                        <div class="text-center mb-5">
                            <img src="{{ $doctor->photo ? asset('storage/' . $doctor->photo) : 'https://via.placeholder.com/300x300?text=No+Image' }}" 
                                 alt="{{ $doctor->name }}" 
                                 class="modal-profile-img">
                            <h3 class="fw-bold mt-4 mb-1" style="color: var(--color-navy);">{{ $doctor->name }}</h3>
                            <span class="badge" style="background-color: var(--color-teal); padding: 8px 16px; font-size: 0.9rem; border-radius: 20px;">{{ $doctor->specialization }}</span>
                        </div>
                        
                        <div class="row g-4">
                            <div class="col-md-6">
                                <h5 class="modal-detail-title"><i class="fas fa-graduation-cap me-2 text-muted"></i>Riwayat Medis</h5>
                                <div class="mb-4">
                                    <p class="mb-0 text-muted"><strong class="text-dark d-block">Pendidikan</strong> {{ $doctor->education }}</p>
                                </div>
                                @if($doctor->experience)
                                <div class="mb-4">
                                    <p class="mb-0 text-muted"><strong class="text-dark d-block">Pengalaman</strong> {{ $doctor->experience }}</p>
                                </div>
                                @endif
                                @if($doctor->description)
                                <div class="mb-4">
                                    <p class="mb-0 text-muted" style="line-height: 1.6;"><strong class="text-dark d-block">Biografi</strong> {{ $doctor->description }}</p>
                                </div>
                                @endif
                            </div>
                            
                            <div class="col-md-6">
                                <h5 class="modal-detail-title"><i class="fas fa-calendar-alt me-2 text-muted"></i>Jadwal Praktik</h5>
                                <div class="bg-light rounded-4 p-3 border">
                                    @foreach($doctor->getActiveSchedules() as $schedule)
                                    <div class="d-flex justify-content-between border-bottom border-secondary-subtle py-2">
                                        <strong style="color: var(--color-navy);">{{ $schedule->day_name }}</strong>
                                        <span class="text-muted">{{ $schedule->start_time }} - {{ $schedule->end_time }}</span>
                                    </div>
                                    @endforeach
                                </div>
                                
                                <div class="mt-4 pt-3">
                                    <a href="{{ route('contact') }}" class="btn text-white w-100 py-3" style="background-color: var(--color-teal); border-radius: 12px; font-weight: 600;">
                                        <i class="fas fa-calendar-check me-2"></i> Buat Janji Temu
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <!-- Empty State -->
        <div class="col-12 reveal">
            <div class="text-center py-5">
                <div class="empty-state-icon">
                    <i class="fas fa-user-md fa-3x" style="color: var(--color-teal);"></i>
                </div>
                <h4 class="fw-bold mb-3" style="color: var(--color-navy);">
                    @if(request()->hasAny(['search', 'specialization']))
                        Pencarian Tidak Ditemukan
                    @else
                        Belum Ada Data Dokter
                    @endif
                </h4>
                <p class="text-muted mb-4 mx-auto" style="max-width: 500px;">
                    @if(request()->hasAny(['search', 'specialization']))
                        Mohon maaf, kami tidak dapat menemukan tenaga medis yang cocok dengan kata kunci atau spesialisasi yang Anda masukkan.
                    @else
                        Daftar tenaga medis kami saat ini sedang diperbarui oleh administrator.
                    @endif
                </p>
                @if(request()->hasAny(['search', 'specialization']))
                <a href="{{ route('doctors') }}" class="btn text-white px-4 py-2" style="background-color: var(--color-teal); border-radius: 10px;">
                    <i class="fas fa-undo me-2"></i> Tampilkan Semua
                </a>
                @endif
            </div>
        </div>
        @endforelse
    </div>
</div>

<!-- Scroll Animation & Search Script -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Reveal animation
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

    // Form logic
    const searchForm = document.getElementById('searchForm');
    const searchInput = document.getElementById('searchInput');
    const clearSearch = document.getElementById('clearSearch');
    const specializationSelect = document.getElementById('specializationSelect');

    clearSearch.addEventListener('click', function() {
        searchInput.value = '';
        searchInput.focus();
    });

    specializationSelect.addEventListener('change', function() {
        searchForm.submit();
    });

    let searchTimeout;
    searchInput.addEventListener('input', function() {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(() => {
            if (this.value.length === 0 || this.value.length >= 3) {
                searchForm.submit();
            }
        }, 500);
    });

    searchInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            searchForm.submit();
        }
    });

    searchForm.addEventListener('submit', function() {
        const submitBtn = this.querySelector('button[type="submit"]');
        const originalHtml = submitBtn.innerHTML;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
        submitBtn.disabled = true;
        setTimeout(() => {
            submitBtn.innerHTML = originalHtml;
            submitBtn.disabled = false;
        }, 2000);
    });
});
</script>
@endsection