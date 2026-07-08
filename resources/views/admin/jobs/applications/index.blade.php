@extends('admin.layouts.app')

@section('title', 'Daftar Pelamar: ' . $job->title)

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h1 class="h3 mb-1 text-gray-800">Pelamar: {{ $job->title }}</h1>
                <p class="text-muted mb-0"><i class="fas fa-building me-1"></i> {{ $job->department->name ?? 'Umum' }} &bull; <i class="fas fa-map-marker-alt me-1"></i> {{ $job->location }}</p>
            </div>
            <a href="{{ route('admin.jobs.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-1"></i> Kembali ke Lowongan
            </a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Total: {{ $applications->count() }} Pelamar</h6>
            </div>
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success border-left-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                
                @if(session('error'))
                    <div class="alert alert-danger border-left-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                        <thead class="bg-light">
                            <tr>
                                <th width="5%">No</th>
                                <th>Nama Pelamar</th>
                                <th>Kontak</th>
                                <th>Tanggal Melamar</th>
                                <th>Status</th>
                                <th width="25%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($applications as $index => $app)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td class="fw-bold">{{ $app->first_name }} {{ $app->last_name }}</td>
                                <td>
                                    <small><i class="fas fa-envelope text-muted me-1"></i> {{ $app->email }}</small><br>
                                    <small><i class="fas fa-phone text-muted me-1"></i> {{ $app->phone }}</small>
                                </td>
                                <td>{{ $app->created_at->format('d M Y, H:i') }}</td>
                                <td>
                                    @php
                                        $badge = [
                                            'Pending' => 'bg-warning text-dark',
                                            'Reviewed' => 'bg-info text-white',
                                            'Interview' => 'bg-primary',
                                            'Hired' => 'bg-success',
                                            'Rejected' => 'bg-danger'
                                        ][$app->status] ?? 'bg-secondary';
                                    @endphp
                                    <span class="badge {{ $badge }} p-2">{{ $app->status }}</span>
                                </td>
                                <td>
                                    <div class="d-flex flex-column gap-2">
                                        <div class="btn-group w-100" role="group">
                                            <a href="{{ route('admin.applications.download_cv', $app->id) }}" class="btn btn-sm btn-outline-primary" title="Download CV">
                                                <i class="fas fa-file-pdf me-1"></i> Unduh CV
                                            </a>
                                            @if($app->portfolio_url)
                                            <a href="{{ $app->portfolio_url }}" target="_blank" class="btn btn-sm btn-outline-info" title="Lihat Portofolio">
                                                <i class="fas fa-link me-1"></i> Portofolio
                                            </a>
                                            @endif
                                        </div>
                                        
                                        <form action="{{ route('admin.applications.update_status', $app->id) }}" method="POST" class="d-flex gap-1">
                                            @csrf
                                            @method('PATCH')
                                            <select name="status" class="form-select form-select-sm" required>
                                                <option value="Pending" {{ $app->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                                <option value="Reviewed" {{ $app->status == 'Reviewed' ? 'selected' : '' }}>Reviewed</option>
                                                <option value="Interview" {{ $app->status == 'Interview' ? 'selected' : '' }}>Interview</option>
                                                <option value="Hired" {{ $app->status == 'Hired' ? 'selected' : '' }}>Hired</option>
                                                <option value="Rejected" {{ $app->status == 'Rejected' ? 'selected' : '' }}>Rejected</option>
                                            </select>
                                            <button type="submit" class="btn btn-sm btn-success px-2" title="Update Status">
                                                <i class="fas fa-check"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center py-4 text-muted">Belum ada yang melamar untuk posisi ini.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
