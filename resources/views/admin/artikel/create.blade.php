@extends('layouts.admin')

@section('title', 'Tulis Artikel - Halo-Ropanasuri')
@section('page-title', 'Tulis Artikel Baru')
@section('page-badge', 'Draft')

@section('content')
<div class="max-w-5xl mx-auto">
    <div class="bg-white rounded-2xl shadow-md border border-gray-200 p-8">
        
        <form action="{{ route('admin.artikel.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <!-- Title -->
            <div class="mb-6">
                <label class="block text-sm font-semibold text-gray-800 mb-2">
                    <i class="fas fa-heading text-ropanasuri-600 mr-2"></i>
                    Judul Artikel <span class="text-red-500">*</span>
                </label>
                <input type="text" name="judul" value="{{ old('judul') }}" 
                       class="block w-full px-4 py-3 text-lg border border-gray-300 rounded-xl focus:ring-2 focus:ring-ropanasuri-500 @error('judul') border-red-500 @enderror"
                       placeholder="Contoh: 5 Cara Menjaga Kesehatan Jantung" required>
                @error('judul')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- Category & Image -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label class="block text-sm font-semibold text-gray-800 mb-2">
                        <i class="fas fa-tag text-ropanasuri-600 mr-2"></i>
                        Kategori
                    </label>
                    <input type="text" name="kategori" value="{{ old('kategori') }}" 
                           class="block w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-ropanasuri-500"
                           placeholder="Contoh: Kesehatan, Layanan, Edukasi">
                    <p class="mt-1 text-xs text-gray-500">Kosongi jika tidak yakin</p>
                </div>
                
                <div>
                    <label class="block text-sm font-semibold text-gray-800 mb-2">
                        <i class="fas fa-image text-ropanasuri-600 mr-2"></i>
                        Gambar Cover
                    </label>
                    <div class="border-2 border-dashed border-gray-300 rounded-xl p-4 text-center hover:border-ropanasuri-500 transition cursor-pointer" 
                         onclick="document.getElementById('gambar').click()">
                        <i class="fas fa-cloud-upload-alt text-3xl text-gray-400 mb-2"></i>
                        <p class="text-sm text-gray-600">Klik untuk upload gambar</p>
                        <p class="text-xs text-gray-500 mt-1">PNG, JPG, WebP (Max 2MB)</p>
                        <input type="file" name="gambar" id="gambar" accept="image/*" class="hidden" onchange="previewImage(this)">
                    </div>
                    <div id="image-preview" class="mt-3 hidden">
                        <img src="" alt="Preview" class="h-32 w-full object-cover rounded-lg">
                    </div>
                </div>
            </div>
            
            <!-- Excerpt -->
            <div class="mb-6">
                <label class="block text-sm font-semibold text-gray-800 mb-2">
                    <i class="fas fa-align-left text-ropanasuri-600 mr-2"></i>
                    Ringkasan (Excerpt)
                </label>
                <textarea name="excerpt" rows="2" 
                          class="block w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-ropanasuri-500"
                          placeholder="Ringkasan singkat artikel (maks 300 karakter)">{{ old('excerpt') }}</textarea>
                <p class="mt-1 text-xs text-gray-500">Akan ditampilkan di card artikel</p>
            </div>
            
            <!-- Content -->
            <div class="mb-6">
                <label class="block text-sm font-semibold text-gray-800 mb-2">
                    <i class="fas fa-file-alt text-ropanasuri-600 mr-2"></i>
                    Konten Artikel <span class="text-red-500">*</span>
                </label>
                <textarea name="konten" id="konten" rows="15" 
                          class="block w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-ropanasuri-500 @error('konten') border-red-500 @enderror"
                          placeholder="Tulis konten artikel di sini...">{{ old('konten') }}</textarea>
                @error('konten')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- Publish Status -->
            <div class="mb-8">
                <label class="flex items-center p-4 bg-gray-50 rounded-xl border border-gray-200 cursor-pointer hover:bg-gray-100 transition">
                    <input type="checkbox" name="is_published" value="1" {{ old('is_published') ? 'checked' : '' }} 
                           class="h-5 w-5 text-ropanasuri-600 focus:ring-ropanasuri-500 border-gray-300 rounded">
                    <span class="ml-3">
                        <span class="text-sm font-semibold text-gray-800">Publikasikan sekarang</span>
                        <span class="text-xs text-gray-600 block">Jika tidak dicentang, artikel akan disimpan sebagai draft</span>
                    </span>
                </label>
            </div>
            
            <!-- Actions -->
            <div class="flex justify-end gap-4 pt-4 border-t border-gray-200">
                <a href="{{ route('admin.artikel.index') }}" 
                   class="px-6 py-3 border border-gray-300 rounded-xl text-gray-700 hover:bg-gray-50 transition font-medium">
                    <i class="fas fa-times mr-2"></i>
                    Batal
                </a>
                <button type="submit" 
                        class="px-6 py-3 bg-gradient-to-r from-ropanasuri-600 to-ropanasuri-700 text-white rounded-xl hover:from-ropanasuri-700 hover:to-ropanasuri-800 transition shadow-lg flex items-center font-medium">
                    <i class="fas fa-save mr-2"></i>
                    Simpan Artikel
                </button>
            </div>
        </form>
    </div>
</div>
@push('scripts')
<!-- CKEditor 4.25.1 LTS - Versi Aman -->
<script src="https://cdn.ckeditor.com/4.25.1-lts/standard/ckeditor.js"></script>
<script>
    // Konfigurasi CKEditor dengan keamanan tinggi
    CKEDITOR.replace('konten', {
        height: 500,
        
        // Toolbar yang diperlukan saja
        toolbar: [
            { name: 'document', items: ['Source'] },
            { name: 'clipboard', items: ['Cut', 'Copy', 'Paste', 'Undo', 'Redo'] },
            { name: 'basicstyles', items: ['Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript'] },
            { name: 'paragraph', items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote'] },
            { name: 'links', items: ['Link', 'Unlink'] },
            { name: 'insert', items: ['Image', 'Table', 'HorizontalRule'] },
            { name: 'styles', items: ['Format', 'Font', 'FontSize'] },
            { name: 'colors', items: ['TextColor', 'BGColor'] },
            { name: 'tools', items: ['Maximize'] }
        ],
        
        // Keamanan: disable dangerous features
        removeButtons: 'About,Save,NewPage,Preview,Print,Templates,Flash,Iframe,Form,Checkbox,Radio,TextField,Textarea,Select,Button,ImageButton,HiddenField',
        
        // Format heading yang diizinkan
        format_tags: 'p;h2;h3;h4;h5;pre',
        
        // Bahasa Indonesia
        language: 'id',
        
        // Disable content filtering (biarkan default)
        allowedContent: true,
        
        // Proteksi XSS
        protectedSource: [
            /<\?[\s\S]*?\?>/g,  // Protect PHP code
            /<script[\s\S]*?>[\s\S]*?<\/script>/gi,  // Protect script tags
            /on\w+="[^"]*"/gi,  // Protect inline event handlers
            /javascript:/gi      // Protect javascript: protocol
        ],
        
        // Enable upload image langsung
        filebrowserUploadUrl: "{{ route('admin.artikel.upload-image', ['_token' => csrf_token() ]) }}",
        filebrowserUploadMethod: 'form',
        
        // Minimal width
        width: '100%'
    });

    // Validasi konten sebelum submit
    document.querySelector('form').addEventListener('submit', function(e) {
        const konten = CKEDITOR.instances.konten.getData();
        
        // Cek apakah konten kosong
        if (konten.replace(/<[^>]*>/g, '').trim() === '') {
            e.preventDefault();
            alert('Konten artikel tidak boleh kosong!');
            return false;
        }
        
        // Bersihkan script jahat
        const cleanContent = konten.replace(/<script[\s\S]*?>[\s\S]*?<\/script>/gi, '');
        CKEDITOR.instances.konten.setData(cleanContent);
    });
    
    function previewImage(input) {
        const preview = document.getElementById('image-preview');
        const img = preview.querySelector('img');
        
        if (input.files && input.files[0]) {
            // Validasi tipe file
            const fileType = input.files[0].type;
            if (!fileType.match(/image\/(jpeg|png|jpg|webp)/)) {
                alert('Hanya file gambar (JPEG, PNG, WebP) yang diizinkan!');
                input.value = '';
                return;
            }
            
            // Validasi ukuran file (max 2MB)
            if (input.files[0].size > 2 * 1024 * 1024) {
                alert('Ukuran gambar maksimal 2MB!');
                input.value = '';
                return;
            }
            
            const reader = new FileReader();
            reader.onload = function(e) {
                img.src = e.target.result;
                preview.classList.remove('hidden');
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endpush
@endsection