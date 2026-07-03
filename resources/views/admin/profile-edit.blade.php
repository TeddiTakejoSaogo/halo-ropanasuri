@extends('admin.layouts.app')

@section('title', 'Edit Profil Rumah Sakit')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0">Edit Profil Rumah Sakit</h1>
            <a href="{{ route('admin.profile') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali
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

                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data" id="profileForm">
                    @csrf
                    @method('PUT')
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nama Rumah Sakit *</label>
                            <input type="text" name="name" class="form-control" 
                                   value="{{ old('name', $profile->name) }}" required>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Telepon *</label>
                            <input type="text" name="phone" class="form-control" 
                                   value="{{ old('phone', $profile->phone) }}" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Alamat *</label>
                        <textarea name="address" class="form-control" rows="3" required>{{ old('address', $profile->address) }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email *</label>
                        <input type="email" name="email" class="form-control" 
                               value="{{ old('email', $profile->email) }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Deskripsi Singkat *</label>
                        <textarea name="description" class="form-control" rows="4" required>{{ old('description', $profile->description) }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Visi *</label>
                        <textarea name="vision" class="form-control" rows="3" required>{{ old('vision', $profile->vision) }}</textarea>
                        <small class="text-muted">Tulis visi rumah sakit</small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Misi *</label>
                        <textarea name="mission" class="form-control" rows="4" required>{{ old('mission', $profile->mission) }}</textarea>
                        <small class="text-muted">Tulis misi rumah sakit (gunakan enter untuk pemisah poin)</small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Sejarah *</label>
                        <textarea name="history" class="form-control" rows="4" required>{{ old('history', $profile->history) }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Logo</label>
                        
                        @if($profile->logo)
                        <div class="mb-3">
                            <p class="text-muted mb-1">Logo Saat Ini:</p>
                            <img src="{{ asset('storage/' . $profile->logo) }}" 
                                 alt="Logo" 
                                 class="img-thumbnail" width="150" onerror="this.style.display='none'">
                            <br>
                            <small class="text-muted">Biarkan kosong jika tidak ingin mengubah logo</small>
                        </div>
                        @endif
                        
                        <input type="file" name="logo" id="logo" class="form-control" accept="image/*">
                        <small class="text-muted">Format: JPG, PNG, GIF. Max: 2MB</small>
                        <div id="logoPreview" class="mt-2" style="display: none;">
                            <img id="previewLogo" class="img-thumbnail" width="150">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Facebook</label>
                            <input type="url" name="facebook" class="form-control" 
                                   value="{{ old('facebook', $profile->facebook) }}" 
                                   placeholder="https://facebook.com/username">
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Instagram</label>
                            <input type="url" name="instagram" class="form-control" 
                                   value="{{ old('instagram', $profile->instagram) }}"
                                   placeholder="https://instagram.com/username">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Tiktok</label>
                            <input type="url" name="tiktok" class="form-control" 
                                   value="{{ old('tiktok', $profile->tiktok) }}"
                                   placeholder="https://tiktok.com/username">
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label class="form-label">YouTube</label>
                            <input type="url" name="youtube" class="form-control" 
                                   value="{{ old('youtube', $profile->youtube) }}"
                                   placeholder="https://youtube.com/username">
                        </div>
                    </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <button type="submit" class="btn btn-primary" id="submitBtn">
                            <i class="fas fa-save"></i> Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('profileForm');
    const submitBtn = document.getElementById('submitBtn');
    const logoInput = document.getElementById('logo');
    const logoPreview = document.getElementById('logoPreview');
    const previewLogo = document.getElementById('previewLogo');

    // Logo preview
    logoInput.addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewLogo.src = e.target.result;
                logoPreview.style.display = 'block';
            }
            reader.readAsDataURL(file);
        } else {
            logoPreview.style.display = 'none';
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