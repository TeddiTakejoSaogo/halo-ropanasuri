@extends('admin.layouts.app')

@section('title', 'Edit Paket Layanan Individual')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0">Edit Paket Layanan Individual</h1>
            <a href="{{ route('admin.individual-services.index') }}" class="btn btn-secondary">
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

                <form action="{{ route('admin.individual-services.update', $service->id) }}" method="POST" enctype="multipart/form-data" id="packageForm">
                    @csrf
                    @method('PUT')
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nama Paket *</label>
                            <input type="text" name="name" class="form-control" 
                                   value="{{ old('name', $service->name) }}" required>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Icon</label>
                            <select name="icon" class="form-select">
                                <option value="">Pilih Icon</option>
                                <option value="stethoscope" {{ old('icon', $service->icon) == 'stethoscope' ? 'selected' : '' }}>Stethoscope</option>
                                <option value="heart" {{ old('icon', $service->icon) == 'heart' ? 'selected' : '' }}>Heart</option>
                                <option value="brain" {{ old('icon', $service->icon) == 'brain' ? 'selected' : '' }}>Brain</option>
                                <option value="baby" {{ old('icon', $service->icon) == 'baby' ? 'selected' : '' }}>Baby</option>
                                <option value="user-md" {{ old('icon', $service->icon) == 'user-md' ? 'selected' : '' }}>User MD</option>
                                <option value="star" {{ old('icon', $service->icon) == 'star' ? 'selected' : '' }}>Star</option>
                                <option value="crown" {{ old('icon', $service->icon) == 'crown' ? 'selected' : '' }}>Crown</option>
                                <option value="shield-alt" {{ old('icon', $service->icon) == 'shield-alt' ? 'selected' : '' }}>Shield</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Deskripsi Singkat *</label>
                        <textarea name="description" class="form-control" rows="3" required>{{ old('description', $service->description) }}</textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Harga Normal *</label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="number" name="price" class="form-control" 
                                       value="{{ old('price', $service->price) }}" required min="0">
                            </div>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Harga Diskon (Optional)</label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="number" name="discount_price" class="form-control" 
                                       value="{{ old('discount_price', $service->discount_price) }}" min="0">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Durasi (Hari)</label>
                            <input type="number" name="duration_days" class="form-control" 
                                   value="{{ old('duration_days', $service->duration_days) }}" min="1">
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Urutan Tampil</label>
                            <input type="number" name="sort_order" class="form-control" 
                                   value="{{ old('sort_order', $service->sort_order) }}" min="0">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Gambar Paket</label>
                        
                        @if($service->image)
                        <div class="mb-3">
                            <p class="text-muted mb-1">Gambar Saat Ini:</p>
                            <img src="{{ $service->image_url }}" 
                                 alt="{{ $service->name }}" 
                                 class="img-thumbnail" width="200">
                            <br>
                            <small class="text-muted">Biarkan kosong jika tidak ingin mengubah gambar</small>
                        </div>
                        @endif
                        
                        <input type="file" name="image" id="image" class="form-control" accept="image/*">
                        <small class="text-muted">Format: JPG, PNG, GIF. Max: 2MB</small>
                        <div id="imagePreview" class="mt-2" style="display: none;">
                            <img id="previewImage" class="img-thumbnail" width="200">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Fitur-Fitur (Setiap baris = 1 fitur)</label>
                        <textarea name="features" class="form-control" rows="4">{{ old('features', $service->features) }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Manfaat (Setiap baris = 1 manfaat)</label>
                        <textarea name="benefits" class="form-control" rows="4">{{ old('benefits', $service->benefits) }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Template Pesan WhatsApp</label>
                        <textarea name="whatsapp_message" class="form-control" rows="4">{{ old('whatsapp_message', $service->whatsapp_message) }}</textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select">
                                <option value="active" {{ old('status', $service->status) == 'active' ? 'selected' : '' }}>Aktif</option>
                                <option value="inactive" {{ old('status', $service->status) == 'inactive' ? 'selected' : '' }}>Non-Aktif</option>
                            </select>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Paket Unggulan</label>
                            <div class="form-check mt-2">
                                <input type="checkbox" name="is_featured" id="is_featured" class="form-check-input" 
                                       value="1" {{ old('is_featured', $service->is_featured) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_featured">Tandai sebagai paket unggulan</label>
                            </div>
                        </div>
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
    const form = document.getElementById('packageForm');
    const submitBtn = document.getElementById('submitBtn');
    const imageInput = document.getElementById('image');
    const imagePreview = document.getElementById('imagePreview');
    const previewImage = document.getElementById('previewImage');

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

    // Format price input
    const priceInput = document.querySelector('input[name="price"]');
    const discountInput = document.querySelector('input[name="discount_price"]');
    
    [priceInput, discountInput].forEach(input => {
        if (input) {
            input.addEventListener('input', function() {
                let value = this.value.replace(/\D/g, '');
                this.value = value;
            });
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