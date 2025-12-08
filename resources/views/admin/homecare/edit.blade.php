@extends('admin.layouts.app')

@section('title', 'Edit Paket Homecare')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0">Edit Paket Homecare</h1>
            <a href="{{ route('admin.homecare.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card shadow">
            <div class="card-body">
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                <form action="{{ route('admin.homecare.update', $package->id) }}" method="POST" enctype="multipart/form-data" id="packageForm">
                    @csrf
                    @method('PUT')
                    
                    <div class="row">
                        <div class="col-md-8">
                            <div class="mb-3">
                                <label class="form-label">Nama Paket *</label>
                                <input type="text" name="name" class="form-control" 
                                       value="{{ old('name', $package->name) }}" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Status *</label>
                                <select name="status" class="form-select" required>
                                    <option value="active" {{ $package->status == 'active' ? 'selected' : '' }}>Aktif</option>
                                    <option value="inactive" {{ $package->status == 'inactive' ? 'selected' : '' }}>Non-Aktif</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Deskripsi *</label>
                        <textarea name="description" class="form-control" rows="4" required>{{ old('description', $package->description) }}</textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Harga (Rp)</label>
                                <input type="number" name="price" class="form-control" 
                                       value="{{ old('price', $package->price) }}" step="1000">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Durasi</label>
                                <input type="text" name="duration" class="form-control" 
                                       value="{{ old('duration', $package->duration) }}">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Urutan Tampilan</label>
                                <input type="number" name="order" class="form-control" 
                                       value="{{ old('order', $package->order) }}" min="0">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Gambar Paket</label>
                                
                                @if($package->image)
                                <div class="mb-2">
                                    <p class="text-muted mb-1">Gambar Saat Ini:</p>
                                    <img src="{{ asset('storage/' . $package->image) }}" 
                                         alt="{{ $package->name }}" 
                                         class="img-thumbnail" width="150">
                                    <br>
                                    <small class="text-muted">Biarkan kosong jika tidak ingin mengubah gambar</small>
                                </div>
                                @endif
                                
                                <input type="file" name="image" id="imageInput" class="form-control" accept="image/*">
                                <small class="text-muted">Format: JPG, PNG, GIF. Max: 2MB</small>
                                <div id="imagePreview" class="mt-2" style="display: none;">
                                    <img id="previewImage" class="img-thumbnail" width="150">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Fitur Layanan</label>
                        <textarea name="features" class="form-control" rows="4">{{ old('features', is_array($package->features) ? implode("\n", $package->features) : $package->features) }}</textarea>
                        <small class="text-muted">Gunakan enter untuk memisah fitur</small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Persiapan yang Diperlukan</label>
                        <textarea name="preparation" class="form-control" rows="4">{{ old('preparation', $package->preparation) }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Prosedur Pelayanan</label>
                        <textarea name="procedure" class="form-control" rows="4">{{ old('procedure', $package->procedure) }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Pesan WhatsApp Default</label>
                        <textarea name="whatsapp_message" class="form-control" rows="3">{{ old('whatsapp_message', $package->whatsapp_message) }}</textarea>
                    </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <button type="submit" class="btn btn-primary" id="submitBtn">
                            <i class="fas fa-save"></i> Update Paket
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const imageInput = document.getElementById('imageInput');
    const imagePreview = document.getElementById('imagePreview');
    const previewImage = document.getElementById('previewImage');
    const form = document.getElementById('packageForm');
    const submitBtn = document.getElementById('submitBtn');

    // Image preview
    imageInput.addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImage.src = e.target.result;
                imagePreview.style.display = 'block';
            }
            reader.readAsDataURL(file);
        } else {
            imagePreview.style.display = 'none';
        }
    });

    // Form submission
    form.addEventListener('submit', function(e) {
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Menyimpan...';
        submitBtn.disabled = true;
    });
});
</script>
@endsection