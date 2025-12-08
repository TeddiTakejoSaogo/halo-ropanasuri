@extends('admin.layouts.app')

@section('title', 'Kelola Paket Homecare')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0">Kelola Paket Homecare</h1>
            <a href="{{ route('admin.homecare.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Tambah Paket
            </a>
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
                    <table class="table table-hover">
                        <thead class="table-primary">
                            <tr>
                                <th width="50">#</th>
                                <th width="80">Gambar</th>
                                <th>Nama Paket</th>
                                <th>Harga</th>
                                <th>Durasi</th>
                                <th>Status</th>
                                <th>Urutan</th>
                                <th width="120">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($packages as $package)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <img src="{{ $package->image_url }}" 
                                         alt="{{ $package->name }}" 
                                         class="img-thumbnail" width="60" style="object-fit: cover;">
                                </td>
                                <td>
                                    <strong>{{ $package->name }}</strong>
                                    <br>
                                    <small class="text-muted">{{ Str::limit($package->description, 50) }}</small>
                                </td>
                                <td>
                                    {{ $package->formatted_price }}
                                </td>
                                <td>{{ $package->duration }}</td>
                                <td>
                                    <span class="badge bg-{{ $package->status === 'active' ? 'success' : 'secondary' }}">
                                        {{ $package->status === 'active' ? 'Aktif' : 'Non-Aktif' }}
                                    </span>
                                </td>
                                <td>{{ $package->order }}</td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <a href="{{ route('admin.homecare.edit', $package->id) }}" 
                                           class="btn btn-warning" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="{{ route('homecare.detail', $package->slug) }}" 
                                           target="_blank" class="btn btn-info" title="Preview">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <form action="{{ route('admin.homecare.destroy', $package->id) }}" 
                                              method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" 
                                                    onclick="return confirm('Hapus paket {{ $package->name }}?')"
                                                    title="Hapus">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="text-center py-4">
                                    <i class="fas fa-home fa-2x text-muted mb-3"></i>
                                    <p class="text-muted">Belum ada paket homecare.</p>
                                    <a href="{{ route('admin.homecare.create') }}" class="btn btn-primary">
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