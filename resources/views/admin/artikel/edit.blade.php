@extends('layouts.admin')

@section('title', 'Edit Artikel - Halo-Ropanasuri')
@section('page-title', 'Edit Artikel')
@section('page-badge', 'ID: ' . $artikel->id)

@section('breadcrumbs')
    <i class="fas fa-home text-gray-400 mr-1"></i> Dashboard 
    <i class="fas fa-chevron-right text-gray-400 mx-2 text-xs"></i> 
    <a href="{{ route('admin.artikel.index') }}" class="text-gray-600 hover:text-ropanasuri-700">Artikel</a>
    <i class="fas fa-chevron-right text-gray-400 mx-2 text-xs"></i> 
    Edit
@endsection

@section('content')
<div class="max-w-5xl mx-auto">
    
    <!-- Form Edit Artikel -->
    <div class="bg-white rounded-2xl shadow-md border border-gray-200 p-8">
        
        <!-- Alert Info -->
        <div class="mb-6 p-4 bg-blue-50 border-l-4 border-blue-500 rounded-r-xl">
            <div class="flex items-start">
                <div class="flex-shrink-0">
                    <i class="fas fa-info-circle text-blue-600 text-xl"></i>
                </div>
                <div class="ml-3">
                    <h4 class="text-sm font-semibold text-blue-800">Informasi Artikel</h4>
                    <p class="text-xs text-blue-700 mt-1">
                        <span class="inline-flex items-center mr-4">
                            <i class="far fa-calendar-alt mr-1"></i> Dibuat: {{ $artikel->created_at->format('d M Y H:i') }}
                        </span>
                        <span class="inline-flex items-center mr-4">
                            <i class="far fa-eye mr-1"></i> Dilihat: {{ $artikel->dilihat }}x
                        </span>
                        <span class="inline-flex items-center">
                            <i class="far fa-edit mr-1"></i> Terakhir update: {{ $artikel->updated_at->diffForHumans() }}
                        </span>
                    </p>
                </div>
            </div>
        </div>

        <form action="{{ route('admin.artikel.update', $artikel) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <!-- Judul Artikel -->
            <div class="mb-6">
                <label class="block text-sm font-semibold text-gray-800 mb-2">
                    <i class="fas fa-heading text-ropanasuri-600 mr-2"></i>
                    Judul Artikel <span class="text-red-500">*</span>
                </label>
                <input type="text" name="judul" value="{{ old('judul', $artikel->judul) }}" 
                       class="block w-full px-4 py-3 text-lg border border-gray-300 rounded-xl focus:ring-2 focus:ring-ropanasuri-500 focus:border-ropanasuri-500 @error('judul') border-red-500 @enderror"
                       placeholder="Contoh: 5 Cara Menjaga Kesehatan Jantung" required>
                @error('judul')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- Grid: Kategori & Gambar -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                
                <!-- Kategori -->
                <div>
                    <label class="block text-sm font-semibold text-gray-800 mb-2">
                        <i class="fas fa-tag text-ropanasuri-600 mr-2"></i>
                        Kategori
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-folder text-gray-400"></i>
                        </div>
                        <input type="text" name="kategori" value="{{ old('kategori', $artikel->kategori) }}" 
                               class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-ropanasuri-500 focus:border-ropanasuri-500"
                               placeholder="Contoh: Kesehatan, Layanan, Edukasi">
                    </div>
                    <p class="mt-1 text-xs text-gray-500">
                        <i class="fas fa-info-circle mr-1"></i>
                        Kosongi jika tidak yakin
                    </p>
                </div>
                
                <!-- Upload Gambar Cover -->
                <div>
                    <label class="block text-sm font-semibold text-gray-800 mb-2">
                        <i class="fas fa-image text-ropanasuri-600 mr-2"></i>
                        Gambar Cover
                    </label>
                    
                    @if($artikel->gambar)
                    <div class="mb-3">
                        <div class="relative inline-block">
                            <img src="{{ asset('storage/'.$artikel->gambar) }}" 
                                 alt="Current image" 
                                 class="h-32 w-full object-cover rounded-lg border border-gray-300">
                            <button type="button" 
                                    onclick="document.getElementById('delete-image-checkbox').checked = true; this.parentElement.style.display='none';"
                                    class="absolute top-2 right-2 bg-red-600 text-white p-1.5 rounded-full hover:bg-red-700 transition shadow-md"
                                    title="Hapus gambar ini">
                                <i class="fas fa-times text-xs"></i>
                            </button>
                        </div>
                        <div class="mt-2">
                            <label class="inline-flex items-center text-xs text-gray-600">
                                <input type="checkbox" name="delete_gambar" id="delete-image-checkbox" value="1" class="mr-2">
                                Hapus gambar saat menyimpan
                            </label>
                        </div>
                    </div>
                    @endif
                    
                    <div class="border-2 border-dashed border-gray-300 rounded-xl p-4 text-center hover:border-ropanasuri-500 transition cursor-pointer" 
                         onclick="document.getElementById('gambar').click()">
                        <i class="fas fa-cloud-upload-alt text-3xl text-gray-400 mb-2"></i>
                        <p class="text-sm text-gray-600">
                            @if($artikel->gambar)
                                Klik untuk ganti gambar
                            @else
                                Klik untuk upload gambar cover
                            @endif
                        </p>
                        <p class="text-xs text-gray-500 mt-1">PNG, JPG, WebP (Max 2MB)</p>
                        <input type="file" name="gambar" id="gambar" accept="image/*" class="hidden" onchange="previewImage(this)">
                    </div>
                    
                    <!-- Preview Gambar Baru -->
                    <div id="image-preview" class="mt-3 hidden">
                        <p class="text-xs text-gray-600 mb-1">Preview gambar baru:</p>
                        <img src="" alt="Preview" class="h-32 w-full object-cover rounded-lg border border-gray-300">
                    </div>
                </div>
            </div>
            
            <!-- Ringkasan (Excerpt) -->
            <div class="mb-6">
                <label class="block text-sm font-semibold text-gray-800 mb-2">
                    <i class="fas fa-align-left text-ropanasuri-600 mr-2"></i>
                    Ringkasan (Excerpt)
                </label>
                <textarea name="excerpt" rows="2" 
                          class="block w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-ropanasuri-500 focus:border-ropanasuri-500"
                          placeholder="Ringkasan singkat artikel (maks 300 karakter)">{{ old('excerpt', $artikel->excerpt) }}</textarea>
                <p class="mt-1 text-xs text-gray-500">
                    <i class="fas fa-info-circle mr-1"></i>
                    Akan ditampilkan di card artikel. Kosongi untuk menggunakan potongan otomatis dari konten.
                </p>
            </div>
            
            <!-- Konten Artikel dengan CKEditor -->
            <div class="mb-6">
                <label class="block text-sm font-semibold text-gray-800 mb-2">
                    <i class="fas fa-file-alt text-ropanasuri-600 mr-2"></i>
                    Konten Artikel <span class="text-red-500">*</span>
                </label>
                <textarea name="konten" id="konten" rows="15" 
                          class="block w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-ropanasuri-500 @error('konten') border-red-500 @enderror"
                          placeholder="Tulis konten artikel di sini...">{{ old('konten', $artikel->konten) }}</textarea>
                @error('konten')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- Status Publikasi -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                
                <!-- Publish Status -->
                <div>
                    <label class="flex items-center p-4 bg-gray-50 rounded-xl border border-gray-200 cursor-pointer hover:bg-gray-100 transition">
                        <input type="checkbox" name="is_published" value="1" 
                               {{ old('is_published', $artikel->is_published) ? 'checked' : '' }} 
                               class="h-5 w-5 text-ropanasuri-600 focus:ring-ropanasuri-500 border-gray-300 rounded">
                        <span class="ml-3">
                            <span class="text-sm font-semibold text-gray-800">
                                {{ $artikel->is_published ? 'Status: Publik' : 'Publikasikan sekarang' }}
                            </span>
                            <span class="text-xs text-gray-600 block">
                                @if($artikel->is_published)
                                    Artikel sudah publik sejak {{ $artikel->published_at ? $artikel->published_at->format('d M Y') : '-' }}
                                @else
                                    Jika tidak dicentang, artikel tetap sebagai draft
                                @endif
                            </span>
                        </span>
                    </label>
                </div>
                
                <!-- Slug URL (Readonly) -->
                <div>
                    <label class="block text-sm font-semibold text-gray-800 mb-2">
                        <i class="fas fa-link text-ropanasuri-600 mr-2"></i>
                        URL Artikel
                    </label>
                    <div class="flex items-center bg-gray-50 rounded-xl border border-gray-200 px-4 py-2">
                        <span class="text-xs text-gray-500 truncate">
                            {{ url('/artikel') }}/<span id="slug-text" class="font-mono">{{ $artikel->slug }}</span>
                        </span>
                        <button type="button" onclick="alert('Slug otomatis diperbarui saat judul diubah')" 
                                class="ml-2 text-ropanasuri-600 hover:text-ropanasuri-800">
                            <i class="fas fa-sync-alt text-xs"></i>
                        </button>
                    </div>
                    <p class="mt-1 text-xs text-gray-500">
                        <i class="fas fa-info-circle mr-1"></i>
                        URL otomatis dari judul
                    </p>
                </div>
            </div>
            
            <!-- Form Actions -->
            <div class="flex justify-end gap-4 pt-6 border-t border-gray-200">
                
                <!-- Preview Button -->
                <a href="{{ route('artikel.show', $artikel->slug) }}" 
                   target="_blank"
                   class="px-6 py-3 border border-gray-300 rounded-xl text-gray-700 hover:bg-gray-50 transition font-medium flex items-center">
                    <i class="fas fa-eye mr-2"></i>
                    Preview
                </a>
                
                <!-- Cancel Button -->
                <a href="{{ route('admin.artikel.index') }}" 
                   class="px-6 py-3 border border-gray-300 rounded-xl text-gray-700 hover:bg-gray-50 transition font-medium">
                    <i class="fas fa-times mr-2"></i>
                    Batal
                </a>
                
                <!-- Save Button -->
                <button type="submit" 
                        class="px-6 py-3 bg-gradient-to-r from-ropanasuri-600 to-ropanasuri-700 text-white rounded-xl hover:from-ropanasuri-700 hover:to-ropanasuri-800 transition shadow-lg flex items-center font-medium">
                    <i class="fas fa-save mr-2"></i>
                    Update Artikel
                </button>
            </div>
        </form>
    </div>
    
    <!-- Card: Tips Menulis -->
    <div class="mt-6 bg-gradient-to-r from-blue-50 to-indigo-50 rounded-2xl p-6 border border-blue-200">
        <div class="flex items-start">
            <div class="flex-shrink-0">
                <div class="bg-blue-600 p-2 rounded-xl">
                    <i class="fas fa-lightbulb text-white text-xl"></i>
                </div>
            </div>
            <div class="ml-4">
                <h4 class="text-sm font-bold text-blue-900">Tips Menulis Artikel Edukasi</h4>
                <ul class="mt-2 text-sm text-blue-800 space-y-1.5">
                    <li class="flex items-start">
                        <i class="fas fa-check-circle mr-2 mt-0.5 text-blue-600"></i>
                        Gunakan bahasa yang mudah dipahami pasien dan keluarga
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-check-circle mr-2 mt-0.5 text-blue-600"></i>
                        Sertakan sumber terpercaya jika mengutip data medis
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-check-circle mr-2 mt-0.5 text-blue-600"></i>
                        Tambahkan subjudul (H2, H3) untuk memudahkan membaca
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-check-circle mr-2 mt-0.5 text-blue-600"></i>
                        Hindari konten yang bersifat diagnosis atau resep obat
                    </li>
                </ul>
                <p class="mt-3 text-xs text-blue-700 bg-white/60 p-3 rounded-xl">
                    <i class="fas fa-shield-alt mr-1"></i>
                    Semua konten akan disaring untuk keamanan. Script berbahaya otomatis dihapus.
                </p>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<!-- CKEditor 4.25.1 LTS - Versi Aman -->
<script src="https://cdn.ckeditor.com/4.25.1-lts/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('konten', {
        height: 500,
        toolbar: [
            { name: 'document', items: ['Source'] },
            { name: 'basicstyles', items: ['Bold', 'Italic', 'Underline', 'Strike'] },
            { name: 'paragraph', items: ['NumberedList', 'BulletedList', 'Blockquote'] },
            { name: 'links', items: ['Link', 'Unlink'] },
            { name: 'insert', items: ['Image', 'Table'] },
            { name: 'styles', items: ['Format'] }
        ],
        removeButtons: 'About,Save,NewPage,Preview,Print,Templates,Flash,Iframe,Form,Checkbox,Radio,TextField,Textarea,Select,Button,ImageButton,HiddenField',
        format_tags: 'p;h2;h3;h4',
        language: 'id',
        allowedContent: true,
        protectedSource: [
            /<\?[\s\S]*?\?>/g,
            /<script[\s\S]*?>[\s\S]*?<\/script>/gi,
            /on\w+="[^"]*"/gi,
            /javascript:/gi
        ],
        // Enable upload image langsung
        filebrowserUploadUrl: "{{ route('admin.artikel.upload-image', ['_token' => csrf_token() ]) }}",
        filebrowserUploadMethod: 'form',
        width: '100%'
    });

    // Validasi konten sebelum submit
    document.querySelector('form').addEventListener('submit', function(e) {
        const konten = CKEDITOR.instances.konten.getData();
        if (konten.replace(/<[^>]*>/g, '').trim() === '') {
            e.preventDefault();
            alert('Konten artikel tidak boleh kosong!');
            return false;
        }
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

@push('styles')
<style>
    /* CKEditor Custom Styling */
    .ckeditor-content {
        font-family: 'Inter', sans-serif;
        line-height: 1.8;
    }
    
    /* Loading state */
    .btn-loading {
        position: relative;
        pointer-events: none;
        opacity: 0.8;
    }
    
    .btn-loading:after {
        content: '';
        position: absolute;
        width: 16px;
        height: 16px;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        margin: auto;
        border: 2px solid transparent;
        border-top-color: white;
        border-radius: 50%;
        animation: button-loading-spinner 0.6s linear infinite;
    }
    
    @keyframes button-loading-spinner {
        from { transform: rotate(0turn); }
        to { transform: rotate(1turn); }
    }
</style>
@endpush
@endsection