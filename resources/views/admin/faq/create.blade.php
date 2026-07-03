@extends('layouts.admin')

@section('title', 'Tambah FAQ - Halo-Ropanasuri')
@section('page-title', 'Tambah FAQ Baru')
@section('page-badge', 'New')

@section('breadcrumbs')
    <i class="fas fa-home text-gray-400 mr-1"></i> Dashboard 
    <i class="fas fa-chevron-right text-gray-400 mx-2 text-xs"></i> 
    <a href="{{ route('admin.faq.index') }}" class="text-gray-600 hover:text-ropanasuri-700">FAQ</a>
    <i class="fas fa-chevron-right text-gray-400 mx-2 text-xs"></i> 
    Tambah Baru
@endsection

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-2xl shadow-md border border-gray-200 p-8">
        
        <!-- Form -->
        <form action="{{ route('admin.faq.store') }}" method="POST">
            @csrf
            
            <!-- Question -->
            <div class="mb-6">
                <label class="block text-sm font-semibold text-gray-800 mb-2">
                    <i class="fas fa-question-circle text-ropanasuri-600 mr-2"></i>
                    Pertanyaan <span class="text-red-500">*</span>
                </label>
                <textarea name="question" rows="2" 
                          class="block w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-ropanasuri-500 focus:border-ropanasuri-500 @error('question') border-red-500 @enderror"
                          placeholder="Contoh: Bagaimana cara daftar berobat di Ropanāsuri?" required>{{ old('question', $defaultQuestion ?? '') }}</textarea>
                @error('question')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- Answer -->
            <div class="mb-6">
                <label class="block text-sm font-semibold text-gray-800 mb-2">
                    <i class="fas fa-reply text-ropanasuri-600 mr-2"></i>
                    Jawaban <span class="text-red-500">*</span>
                </label>
                <textarea name="answer" rows="6" 
                          class="block w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-ropanasuri-500 focus:border-ropanasuri-500 @error('answer') border-red-500 @enderror"
                          placeholder="Tulis jawaban lengkap dan jelas..." required>{{ old('answer') }}</textarea>
                @error('answer')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
                <p class="mt-1 text-xs text-gray-500 flex items-center">
                    <i class="fas fa-info-circle mr-1"></i>
                    Gunakan Markdown: **tebal**, *miring*, [link](url)
                </p>
            </div>
            
            <!-- Category & Keywords Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                
                <!-- Category -->
                <div>
                    <label class="block text-sm font-semibold text-gray-800 mb-2">
                        <i class="fas fa-tag text-ropanasuri-600 mr-2"></i>
                        Kategori
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-folder text-gray-400"></i>
                        </div>
                        <input type="text" name="category" value="{{ old('category') }}" 
                               class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-ropanasuri-500 focus:border-ropanasuri-500"
                               placeholder="Contoh: Pendaftaran, BPJS, Layanan">
                    </div>
                    <p class="mt-1 text-xs text-gray-500">Kosongi jika tidak yakin</p>
                </div>
                
                <!-- Keywords -->
                <div>
                    <label class="block text-sm font-semibold text-gray-800 mb-2">
                        <i class="fas fa-key text-ropanasuri-600 mr-2"></i>
                        Keywords <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-hashtag text-gray-400"></i>
                        </div>
                        <input type="text" name="keywords" value="{{ old('keywords') }}" 
                               class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-ropanasuri-500 focus:border-ropanasuri-500 @error('keywords') border-red-500 @enderror"
                               placeholder="daftar, registrasi, berobat, pasien" required>
                    </div>
                    @error('keywords')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    <p class="mt-1 text-xs text-gray-500">Pisahkan dengan koma, gunakan kata dasar</p>
                </div>
            </div>
            
            <!-- Active Status -->
            <div class="mb-8">
                <label class="flex items-center p-4 bg-gray-50 rounded-xl border border-gray-200 cursor-pointer hover:bg-gray-100 transition">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }} 
                           class="h-5 w-5 text-ropanasuri-600 focus:ring-ropanasuri-500 border-gray-300 rounded">
                    <span class="ml-3">
                        <span class="text-sm font-semibold text-gray-800">Aktifkan FAQ ini</span>
                        <span class="text-xs text-gray-600 block">Jika tidak diaktifkan, FAQ tidak akan digunakan oleh AI</span>
                    </span>
                </label>
            </div>
            
            <!-- Form Actions -->
            <div class="flex justify-end gap-4 pt-4 border-t border-gray-200">
                <a href="{{ route('admin.faq.index') }}" 
                   class="px-6 py-3 border border-gray-300 rounded-xl text-gray-700 hover:bg-gray-50 transition font-medium">
                    <i class="fas fa-times mr-2"></i>
                    Batal
                </a>
                <button type="submit" 
                        class="px-6 py-3 bg-gradient-to-r from-ropanasuri-600 to-ropanasuri-700 text-white rounded-xl hover:from-ropanasuri-700 hover:to-ropanasuri-800 transition shadow-lg flex items-center font-medium">
                    <i class="fas fa-save mr-2"></i>
                    Simpan FAQ
                </button>
            </div>
        </form>
        
        <!-- Preview Card (Optional) -->
        <div class="mt-8 p-5 bg-blue-50 rounded-xl border border-blue-200">
            <div class="flex items-start">
                <div class="flex-shrink-0">
                    <i class="fas fa-eye text-blue-600 text-xl"></i>
                </div>
                <div class="ml-3">
                    <h4 class="text-sm font-semibold text-blue-800">Tips Menulis FAQ</h4>
                    <ul class="mt-2 text-sm text-blue-700 space-y-1 list-disc list-inside">
                        <li>Jawaban harus lengkap, informatif, dan mudah dipahami</li>
                        <li>Gunakan bahasa yang ramah dan tidak kaku</li>
                        <li>Sertakan informasi kontak jika diperlukan</li>
                        <li>Update jawaban jika ada kebijakan baru</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Auto-suggest keywords from question (optional enhancement)
    document.querySelector('input[name="question"]')?.addEventListener('input', function(e) {
        // Bisa ditambahkan fitur auto-generate keywords
    });
</script>
@endpush
@endsection