@extends('admin.layouts.app')

@section('title', 'Tambah Paket Homecare')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0">Tambah Paket Homecare Baru</h1>
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

                <form action="{{ route('admin.homecare.store') }}" method="POST" enctype="multipart/form-data" id="packageForm">
                    @csrf
                    
                    <div class="row">
                        <div class="col-md-8">
                            <div class="mb-3">
                                <label class="form-label">Nama Paket *</label>
                                <input type="text" name="name" class="form-control" 
                                       value="{{ old('name') }}" placeholder="Contoh: Homecare Basic" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Status *</label>
                                <select name="status" class="form-select" required>
                                    <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Aktif</option>
                                    <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Non-Aktif</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Deskripsi *</label>
                        <textarea name="description" class="form-control" rows="4" 
                                  placeholder="Deskripsi lengkap tentang paket homecare..." required>{{ old('description') }}</textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Harga (Rp)</label>
                                <input type="number" name="price" class="form-control" 
                                       value="{{ old('price') }}" placeholder="Contoh: 250000" step="1000">
                                <small class="text-muted">Kosongkan jika harga negotiable</small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Durasi</label>
                                <input type="text" name="duration" class="form-control" 
                                       value="{{ old('duration') }}" placeholder="Contoh: 2-3 jam per kunjungan">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Urutan Tampilan</label>
                                <input type="number" name="order" class="form-control" 
                                       value="{{ old('order', 0) }}" min="0">
                                <small class="text-muted">Angka lebih kecil tampil lebih awal</small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Gambar Paket</label>
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
                        <textarea name="features" class="form-control" rows="4" 
                                  placeholder="Tulis fitur-fitur paket (satu fitur per baris)&#10;Contoh:&#10;Perawat berpengalaman&#10;Pemeriksaan tanda vital&#10;Konsultasi kesehatan">{{ old('features') }}</textarea>
                        <small class="text-muted">Gunakan enter untuk memisah fitur</small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Persiapan yang Diperlukan</label>
                        <textarea name="preparation" class="form-control" rows="4" 
                                  placeholder="Tulis persiapan yang perlu dilakukan pasien...">{{ old('preparation') }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Prosedur Pelayanan</label>
                        <textarea name="procedure" class="form-control" rows="4" 
                                  placeholder="Tulis prosedur pelayanan...">{{ old('procedure') }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Pesan WhatsApp Default</label>
                        <textarea name="whatsapp_message" class="form-control" rows="3" 
                                  placeholder="Pesan yang akan dikirim saat klik tombol WhatsApp">{{ old('whatsapp_message', 'Halo, saya ingin informasi lebih lanjut tentang paket homecare') }}</textarea>
                        <small class="text-muted">Pesan otomatis yang dikirim ke WhatsApp admin</small>
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

    // Character counter for description
    const descriptionTextarea = form.querySelector('textarea[name="description"]');
    if (descriptionTextarea) {
        const charCount = document.createElement('div');
        charCount.className = 'text-muted small mt-1 text-end';
        descriptionTextarea.parentNode.appendChild(charCount);
        
        descriptionTextarea.addEventListener('input', function() {
            const length = this.value.length;
            charCount.textContent = `${length} karakter`;
        });
        
        descriptionTextarea.dispatchEvent(new Event('input'));
    }
});
</script>
@endsection