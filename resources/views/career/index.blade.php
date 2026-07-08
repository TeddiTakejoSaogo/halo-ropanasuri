@extends('layouts.app')

@section('title', 'Karir')

@section('content')
<style>
    :root {
        --color-teal: #16a085;
        --color-teal-light: #e8f6f3;
    }
    .text-teal { color: var(--color-teal) !important; }
    .bg-teal { background-color: var(--color-teal) !important; color: white; }
    .btn-teal { background-color: var(--color-teal); color: white; border-color: var(--color-teal); }
    .btn-teal:hover { background-color: #12876f; color: white; }
    .btn-outline-teal { color: var(--color-teal); border-color: var(--color-teal); }
    .btn-outline-teal:hover { background-color: var(--color-teal); color: white; }
    .career-hero {
        background: linear-gradient(135deg, #0F3460 0%, #1a1a2e 100%);
        color: white;
        padding: 80px 0;
        text-align: center;
        border-radius: 0 0 50px 50px;
        margin-bottom: -40px;
    }
</style>

<div class="career-hero mb-5 shadow">
    <div class="container">
        <h1 class="fw-bold mb-3">Karir Bersama Kami</h1>
        <p class="lead opacity-75">Bergabunglah dengan tim profesional Rumah Sakit Khusus Bedah Ropanasuri untuk memberikan layanan kesehatan terbaik.</p>
    </div>
</div>

<div class="container py-5">
    <div class="row">
        <div class="col-12">
            @if(session('success'))
                <div class="alert alert-success border-0 shadow-sm rounded-3"><i class="fas fa-check-circle me-2"></i>{{ session('success') }}</div>
            @endif

            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-body p-4">
                    <form action="{{ route('career.index') }}" method="GET" class="row g-3">
                        <div class="col-md-5">
                            <label class="form-label fw-bold text-secondary small">Departemen</label>
                            <select name="department_id" class="form-select border-0 bg-light">
                                <option value="">Semua Departemen</option>
                                @foreach(\App\Models\Department::all() as $dept)
                                    <option value="{{ $dept->id }}" {{ request('department_id') == $dept->id ? 'selected' : '' }}>{{ $dept->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-5">
                            <label class="form-label fw-bold text-secondary small">Tipe Pekerjaan</label>
                            <select name="job_type" class="form-select border-0 bg-light">
                                <option value="">Semua Tipe</option>
                                <option value="Full-time" {{ request('job_type') == 'Full-time' ? 'selected' : '' }}>Full-time</option>
                                <option value="Part-time" {{ request('job_type') == 'Part-time' ? 'selected' : '' }}>Part-time</option>
                                <option value="Contract" {{ request('job_type') == 'Contract' ? 'selected' : '' }}>Contract</option>
                            </select>
                        </div>
                        <div class="col-md-2 d-flex align-items-end">
                            <button type="submit" class="btn btn-teal w-100 rounded-3"><i class="fas fa-filter me-2"></i>Filter</button>
                        </div>
                    </form>
                </div>
            </div>

            @if($jobs->count() > 0)
                <div class="row g-4">
                    @foreach($jobs as $job)
                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100 shadow-sm border-0 rounded-4 transition-hover overflow-hidden">
                            @if($job->image_path)
                                <img src="{{ Storage::url($job->image_path) }}" class="card-img-top" alt="{{ $job->title }}" style="height: 200px; object-fit: cover;">
                            @endif
                            <div class="card-body p-4">
                                <span class="badge bg-teal text-white mb-3 px-3 py-2 rounded-pill">{{ $job->department->name ?? 'Umum' }}</span>
                                <h5 class="card-title fw-bold text-dark mb-2">{{ $job->title }}</h5>
                                <p class="text-muted small mb-3">
                                    <i class="fas fa-map-marker-alt text-teal me-1"></i> {{ $job->location }}
                                    <span class="mx-2 text-light">|</span>
                                    <i class="fas fa-briefcase text-teal me-1"></i> {{ $job->job_type }}
                                </p>
                                <p class="card-text text-secondary mb-4 small" style="display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;">{{ strip_tags($job->description) }}</p>
                            </div>
                            <div class="card-footer bg-white border-0 p-4 pt-0 mt-auto">
                                <a href="{{ route('career.show', $job->id) }}" class="btn btn-outline-teal w-100 rounded-pill">Lihat Detail & Lamar</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                
                <div class="d-flex justify-content-center mt-5">
                    {{ $jobs->links() }}
                </div>
            @else
                <div class="text-center py-5 my-5">
                    <i class="fas fa-search fa-4x text-muted opacity-25 mb-3"></i>
                    <h5 class="text-muted">Maaf, belum ada lowongan yang sesuai kriteria pencarian Anda.</h5>
                    <p class="text-secondary small">Silakan coba dengan filter lain atau kembali lagi nanti.</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
