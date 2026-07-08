@extends('layouts.app')

@section('title', $job->title . ' - Karir')

@section('content')
<style>
    :root {
        --color-teal: #16a085;
    }
    .text-teal { color: var(--color-teal) !important; }
    .bg-teal { background-color: var(--color-teal) !important; color: white; }
    .btn-teal { background-color: var(--color-teal); color: white; border-color: var(--color-teal); }
    .btn-teal:hover { background-color: #12876f; color: white; }
    .list-teal li::marker { color: var(--color-teal); }
    
    .job-header {
        background-color: #f8f9fa;
        border-bottom: 1px solid #eaeaea;
        padding: 60px 0 40px;
    }
</style>

<div class="job-header mb-5">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none text-teal">Beranda</a></li>
                <li class="breadcrumb-item"><a href="{{ route('career.index') }}" class="text-decoration-none text-teal">Karir</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $job->title }}</li>
            </ol>
        </nav>
        
        <div class="row align-items-center mt-4">
            <div class="col-lg-8">
                <span class="badge bg-teal mb-2">{{ $job->department->name ?? 'Umum' }}</span>
                <h1 class="fw-bold mb-3">{{ $job->title }}</h1>
                <div class="d-flex flex-wrap gap-4 text-secondary">
                    <div><i class="fas fa-briefcase text-teal me-2"></i>{{ $job->job_type }}</div>
                    <div><i class="fas fa-map-marker-alt text-teal me-2"></i>{{ $job->location }}</div>
                    <div><i class="far fa-calendar-alt text-teal me-2"></i>Dipublikasi {{ $job->created_at->diffForHumans() }}</div>
                </div>
            </div>
            <div class="col-lg-4 text-lg-end mt-4 mt-lg-0">
                <a href="#apply-section" class="btn btn-teal btn-lg rounded-pill px-5 shadow-sm"><i class="fas fa-paper-plane me-2"></i>Lamar Sekarang</a>
            </div>
        </div>
    </div>
</div>

<div class="container pb-5">
    <div class="row">
        <div class="col-lg-8 mb-5 mb-lg-0">
            @if(session('success'))
                <div class="alert alert-success shadow-sm border-0 mb-4"><i class="fas fa-check-circle me-2"></i>{{ session('success') }}</div>
            @endif
            
            <div class="card border-0 shadow-sm rounded-4 mb-4 overflow-hidden">
                @if($job->image_path)
                    <img src="{{ Storage::url($job->image_path) }}" class="img-fluid w-100" style="max-height: 400px; object-fit: cover;" alt="Banner">
                @endif
                <div class="card-body p-4 p-md-5">
                    <h4 class="fw-bold text-dark border-bottom pb-3 mb-4">Deskripsi Pekerjaan</h4>
                    <div class="text-secondary mb-5" style="line-height: 1.8;">
                        {!! nl2br(e($job->description)) !!}
                    </div>

                    <h4 class="fw-bold text-dark border-bottom pb-3 mb-4">Tanggung Jawab</h4>
                    <div class="text-secondary mb-5 list-teal" style="line-height: 1.8;">
                        {!! nl2br(e($job->responsibilities)) !!}
                    </div>

                    <h4 class="fw-bold text-dark border-bottom pb-3 mb-4">Kualifikasi</h4>
                    <div class="text-secondary list-teal" style="line-height: 1.8;">
                        {!! nl2br(e($job->qualifications)) !!}
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-lg-4" id="apply-section">
            <div class="card border-0 shadow rounded-4 sticky-top" style="top: 100px;">
                <div class="card-header bg-white border-bottom-0 pt-4 pb-0 px-4">
                    <h5 class="fw-bold text-teal mb-0">Form Lamaran Pekerjaan</h5>
                    <p class="text-muted small mt-2">Pastikan data yang Anda isi valid dan CV dalam format PDF (Max 2MB).</p>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('career.apply', $job->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label text-secondary small fw-bold">Nama Depan *</label>
                            <input type="text" name="first_name" class="form-control bg-light border-0 @error('first_name') is-invalid @enderror" value="{{ old('first_name') }}" required>
                            @error('first_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label text-secondary small fw-bold">Nama Belakang *</label>
                            <input type="text" name="last_name" class="form-control bg-light border-0 @error('last_name') is-invalid @enderror" value="{{ old('last_name') }}" required>
                            @error('last_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label text-secondary small fw-bold">Email *</label>
                            <input type="email" name="email" class="form-control bg-light border-0 @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
                            @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label text-secondary small fw-bold">No WhatsApp / Telepon *</label>
                            <input type="text" name="phone" class="form-control bg-light border-0 @error('phone') is-invalid @enderror" value="{{ old('phone') }}" required>
                            @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label text-secondary small fw-bold">Link Portofolio (Opsional)</label>
                            <input type="url" name="portfolio_url" class="form-control bg-light border-0 @error('portfolio_url') is-invalid @enderror" value="{{ old('portfolio_url') }}" placeholder="https://...">
                            @error('portfolio_url') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        
                        <div class="mb-4">
                            <label class="form-label text-secondary small fw-bold">Upload CV/Resume (PDF) *</label>
                            <input type="file" name="resume" class="form-control border bg-light @error('resume') is-invalid @enderror" accept=".pdf" required>
                            @error('resume') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        
                        <button type="submit" class="btn btn-teal w-100 rounded-3 py-2 fw-bold">Kirim Lamaran</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
