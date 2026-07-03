@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-8 max-w-4xl">
    <div class="bg-white rounded-xl shadow-lg p-6">
        <div class="flex items-center mb-6">
            <a href="{{ route('admin.artikel.index') }}" class="text-gray-600 hover:text-gray-900 mr-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
            <h1 class="text-2xl font-bold text-gray-800">Tulis Artikel Baru</h1>
        </div>

        <form action="{{ route('admin.artikel.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Judul Artikel</label>
                <input type="text" name="judul" value="{{ old('judul') }}" 
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-ropanasuri-500 @error('judul') border-red-500 @enderror">
                @error('judul')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2">Kategori</label>
                    <input type="text" name="kategori" value="{{ old('kategori') }}" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-ropanasuri-500"
                           placeholder="Contoh: Kesehatan, Layanan, Edukasi">
                </div>
                
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2">Gambar (Opsional)</label>
                    <input type="file" name="gambar" accept="image/*"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-ropanasuri-500">
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Ringkasan (Excerpt)</label>
                <textarea name="excerpt" rows="2" 
                          class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-ropanasuri-500"
                          placeholder="Ringkasan singkat artikel (maks 300 karakter)">{{ old('excerpt') }}</textarea>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Konten Artikel</label>
                <textarea name="konten" id="konten" rows="12"
                          class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-ropanasuri-500 @error('konten') border-red-500 @enderror">{{ old('konten') }}</textarea>
                @error('konten')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label class="flex items-center">
                    <input type="checkbox" name="is_published" value="1" {{ old('is_published') ? 'checked' : '' }}
                           class="rounded border-gray-300 text-ropanasuri-600 shadow-sm focus:border-ropanasuri-300 focus:ring focus:ring-ropanasuri-200 focus:ring-opacity-50">
                    <span class="ml-2 text-sm text-gray-600">Publikasikan sekarang</span>
                </label>
            </div>

            <div class="flex justify-end gap-3">
                <a href="{{ route('admin.artikel.index') }}" 
                   class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                    Batal
                </a>
                <button type="submit" 
                        class="px-6 py-2 bg-ropanasuri-600 text-white rounded-lg hover:bg-ropanasuri-700">
                    Simpan Artikel
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('konten', {
        height: 400,
        toolbar: [
            { name: 'document', items: ['Source'] },
            { name: 'basicstyles', items: ['Bold', 'Italic', 'Underline'] },
            { name: 'paragraph', items: ['NumberedList', 'BulletedList', '-', 'Blockquote'] },
            { name: 'links', items: ['Link', 'Unlink'] },
            { name: 'styles', items: ['Format', 'Font', 'FontSize'] },
            { name: 'colors', items: ['TextColor', 'BGColor'] }
        ]
    });
</script>
@endpush
@endsection