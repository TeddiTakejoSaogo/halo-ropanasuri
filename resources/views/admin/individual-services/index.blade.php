@extends('admin.layouts.app')

@section('title', 'Kelola Paket Layanan Individual')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0">Kelola Paket Layanan Individual</h1>
            <a href="{{ route('admin.individual-services.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Tambah Paket
            </a>
        </div>
    </div>
</div>

<div class="row mb-4">
    <div class="col-12">
        <div class="card shadow">
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-4">
                        <div class="card bg-primary text-white">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="text-white-50 mb-1">Total Paket</h6>
                                        <h3 class="mb-0">{{ $services->count() }}</h3>
                                    </div>
                                    <i class="fas fa-gem fa-2x opacity-50"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card bg-success text-white">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="text-white-50 mb-1">Aktif</h6>
                                        <h3 class="mb-0">{{ $services->where('status', 'active')->count() }}</h3>
                                    </div>
                                    <i class="fas fa-check-circle fa-2x opacity-50"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card bg-warning text-white">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="text-white-50 mb-1">Unggulan</h6>
                                        <h3 class="mb-0">{{ $services->where('is_featured', true)->count() }}</h3>
                                    </div>
                                    <i class="fas fa-star fa-2x opacity-50"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card shadow">
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="table-primary">
                            <tr>
                                <th width="60">#</th>
                                <th width="80">Gambar</th>
                                <th>Nama Paket</th>
                                <th width="150">Harga</th>
                                <th width="100">Status</th>
                                <th width="80">Urutan</th>
                                <th width="200">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($services as $service)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <img src="{{ $service->image_url }}" 
                                         alt="{{ $service->name }}"
                                         class="img-thumbnail" width="60" height="60" style="object-fit: cover;">
                                </td>
                                <td>
                                    <strong>{{ $service->name }}</strong>
                                    @if($service->is_featured)
                                    <span class="badge bg-warning ms-2">Unggulan</span>
                                    @endif
                                    @if($service->discount_percentage > 0)
                                    <span class="badge bg-danger ms-2">{{ $service->discount_percentage }}% OFF</span>
                                    @endif
                                    <br>
                                    <small class="text-muted">{{ Str::limit($service->description, 80) }}</small>
                                </td>
                                <td>
                                    @if($service->discount_price)
                                    <div class="text-muted text-decoration-line-through small">
                                        {{ $service->formatted_price }}
                                    </div>
                                    <strong class="text-primary">{{ $service->formatted_discount_price }}</strong>
                                    @else
                                    <strong class="text-primary">{{ $service->formatted_price }}</strong>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge bg-{{ $service->status === 'active' ? 'success' : 'danger' }}">
                                        {{ $service->status === 'active' ? 'Aktif' : 'Non-Aktif' }}
                                    </span>
                                </td>
                                <td>{{ $service->sort_order }}</td>
                                <td>
                                    <div class="btn-group btn-group-sm" role="group">
                                        <a href="{{ route('individual-services.show', $service->slug) }}" 
                                           class="btn btn-info" target="_blank" title="Lihat">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.individual-services.edit', $service->id) }}" 
                                           class="btn btn-warning" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.individual-services.toggle-status', $service->id) }}" 
                                              method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-{{ $service->status === 'active' ? 'secondary' : 'success' }}" 
                                                    title="{{ $service->status === 'active' ? 'Nonaktifkan' : 'Aktifkan' }}">
                                                <i class="fas fa-{{ $service->status === 'active' ? 'pause' : 'play' }}"></i>
                                            </button>
                                        </form>
                                        <form action="{{ route('admin.individual-services.destroy', $service->id) }}" 
                                              method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" 
                                                    onclick="return confirm('Hapus paket {{ $service->name }}?')"
                                                    title="Hapus">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center py-4">
                                    <i class="fas fa-gem fa-2x text-muted mb-3"></i>
                                    <p class="text-muted">Belum ada paket layanan individual.</p>
                                    <a href="{{ route('admin.individual-services.create') }}" class="btn btn-primary">
                                        <i class="fas fa-plus"></i> Tambah Paket Pertama
                                    </a>
                                </td>
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