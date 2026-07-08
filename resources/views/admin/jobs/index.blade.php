@extends('admin.layouts.app')

@section('title', 'Kelola Lowongan Pekerjaan')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0 text-gray-800">Kelola Lowongan Pekerjaan</h1>
            <a href="{{ route('admin.jobs.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-1"></i> Tambah Lowongan
            </a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Daftar Lowongan</h6>
            </div>
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success border-left-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                        <thead class="bg-light">
                            <tr>
                                <th width="5%">No</th>
                                <th>Posisi</th>
                                <th>Departemen</th>
                                <th>Tipe & Lokasi</th>
                                <th>Status</th>
                                <th>Pelamar</th>
                                <th width="20%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($jobs as $index => $job)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td class="fw-bold">{{ $job->title }}</td>
                                <td>{{ $job->department->name ?? '-' }}</td>
                                <td>
                                    <span class="badge bg-info text-white mb-1">{{ $job->job_type }}</span><br>
                                    <small class="text-muted"><i class="fas fa-map-marker-alt me-1"></i>{{ $job->location }}</small>
                                </td>
                                <td>
                                    @if($job->status == 'Published')
                                        <span class="badge bg-success">Published</span>
                                    @elseif($job->status == 'Draft')
                                        <span class="badge bg-secondary">Draft</span>
                                    @else
                                        <span class="badge bg-danger">Closed</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.jobs.applications.index', $job->id) }}" class="btn btn-sm btn-info text-white">
                                        <i class="fas fa-users me-1"></i> {{ $job->applications()->count() }} Pelamar
                                    </a>
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('career.show', $job->id) }}" target="_blank" class="btn btn-sm btn-outline-secondary" title="Lihat di Web">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.jobs.edit', $job->id) }}" class="btn btn-sm btn-outline-primary" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.jobs.destroy', $job->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus lowongan ini? Data pelamar terkait juga akan terhapus.')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center py-4 text-muted">Belum ada data lowongan pekerjaan.</td>
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
