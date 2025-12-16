@extends('admin.layouts.app')

@section('title', 'Tambah Paket Layanan Individual')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0">Tambah Paket Layanan Individual</h1>
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

                <form action="{{ route('admin.individual-services.store') }}" method="POST" enctype="multipart/form-data" id="packageForm">
                    @csrf
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nama Paket *</label>
                            <input type="text" name="name" class="form-control" 
                                   value="{{ old('name') }}" placeholder="Contoh: Paket Medical Check Up Premium" required>
                            <small class="text-muted">Nama yang menarik untuk paket layanan</small>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Icon</label>
                            <select name="icon" class="form-select">
                                <option value="">Pilih Icon</option>
                                <option value="stethoscope" {{ old('icon') == 'stethoscope' ? 'selected' : '' }}>Stethoscope</option>
                                <option value="heart" {{ old('icon') == 'heart' ? 'selected' : '' }}>Heart</option>
                                <option value="brain" {{ old('icon') == 'brain' ? 'selected' : '' }}>Brain</option>
                                <option value="baby" {{ old('icon') == 'baby' ? 'selected' : '' }}>Baby</option>
                                <option value="user-md" {{ old('icon') == 'user-md' ? 'selected' : '' }}>User MD</option>
                                <option value="star" {{ old('icon') == 'star' ? 'selected' : '' }}>Star</option>
                                <option value="crown" {{ old('icon') == 'crown' ? 'selected' : '' }}>Crown</option>
                                <option value="shield-alt" {{ old('icon') == 'shield-alt' ? 'selected' : '' }}>Shield</option>
                            </select>
                            <small class="text-muted">Icon yang akan ditampilkan di paket</small>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Deskripsi Singkat *</label>
                        <textarea name="description" class="form-control" rows="3" 
                                  placeholder="Deskripsi singkat tentang paket ini..." required>{{ old('description') }}</textarea>
                        <small class="text-muted">Jelaskan secara singkat tentang paket ini</small>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Harga Normal *</label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="number" name="price" class="form-control" 
                                       value="{{ old('price') }}" placeholder="1000000" required min="0">
                            </div>
                            <small class="text-muted">Harga normal paket</small>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Harga Diskon (Optional)</label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="number" name="discount_price" class="form-control" 
                                       value="{{ old('discount_price') }}" placeholder="800000" min="0">
                            </div>
                            <small class="text-muted">Harga setelah diskon (jika ada)</small>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Durasi (Hari)</label>
                            <input type="number" name="duration_days" class="form-control" 
                                   value="{{ old('duration_days') }}" placeholder="30" min="1">
                            <small class="text-muted">Durasi paket dalam hari</small>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Urutan Tampil</label>
                            <input type="number" name="sort_order" class="form-control" 
                                   value="{{ old('sort_order', 0) }}" min="0">
                            <small class="text-muted">Angka lebih kecil akan tampil lebih awal</small>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Gambar Paket</label>
                        <input type="file" name="image" id="image" class="form-control" accept="image/*">
                        <small class="text-muted">Format: JPG, PNG, GIF. Max: 2MB</small>
                        <div id="imagePreview" class="mt-2" style="display: none;">
                            <img id="previewImage" class="img-thumbnail" width="200">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Fitur-Fitur (Setiap baris = 1 fitur)</label>
                        <textarea name="features" class="form-control" rows="4" 
                                  placeholder="Contoh:&#10;Konsultasi dokter spesialis&#10;Medical check up lengkap&#10;Pemeriksaan laboratorium">{{ old('features') }}</textarea>
                        <small class="text-muted">Gunakan Enter untuk memisahkan setiap fitur</small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Manfaat (Setiap baris = 1 manfaat)</label>
                        <textarea name="benefits" class="form-control" rows="4" 
                                  placeholder="Contoh:&#10;Deteksi dini penyakit&#10;Kesehatan optimal&#10;Perawatan pribadi">{{ old('benefits') }}</textarea>
                        <small class="text-muted">Gunakan Enter untuk memisahkan setiap manfaat</small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Template Pesan WhatsApp</label>
                        <textarea name="whatsapp_message" class="form-control" rows="4" 
                                  placeholder="Template pesan yang akan dikirim ke WhatsApp">{{ old('whatsapp_message') }}</textarea>
                        <small class="text-muted">Biarkan kosong untuk menggunakan template default</small>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select">
                                <option value="active" {{ old('status', 'active') == 'active' ? 'selected' : '' }}>Aktif</option>
                                <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Non-Aktif</option>
                            </select>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Paket Unggulan</label>
                            <div class="form-check mt-2">
                                <input type="checkbox" name="is_featured" id="is_featured" class="form-check-input" 
                                       value="1" {{ old('is_featured') ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_featured">Tandai sebagai paket unggulan</label>
                            </div>
                        </div>
                    </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <button type="submit" class="btn btn-primary" id="submitBtn">
                            <i class="fas fa-save"></i> Simpan Paket
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