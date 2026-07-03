@extends('layouts.admin')

@section('title', 'Edit FAQ - Halo-Ropanasuri')
@section('page-title', 'Edit FAQ')
@section('page-badge', 'ID: ' . $faq->id)

@section('breadcrumbs')
    <i class="fas fa-home text-gray-400 mr-1"></i> Dashboard 
    <i class="fas fa-chevron-right text-gray-400 mx-2 text-xs"></i> 
    <a href="{{ route('admin.faq.index') }}" class="text-gray-600 hover:text-ropanasuri-700">FAQ</a>
    <i class="fas fa-chevron-right text-gray-400 mx-2 text-xs"></i> 
    Edit
@endsection

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-2xl shadow-md border border-gray-200 p-8">
        
        <!-- Form -->
        <form action="{{ route('admin.faq.update', $faq) }}" method="POST">
            @csrf
            @method('PUT')
            
            <!-- Question -->
            <div class="mb-6">
                <label class="block text-sm font-semibold text-gray-800 mb-2">
                    <i class="fas fa-question-circle text-ropanasuri-600 mr-2"></i>
                    Pertanyaan <span class="text-red-500">*</span>
                </label>
                <textarea name="question" rows="2" 
                          class="block w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-ropanasuri-500 focus:border-ropanasuri-500 @error('question') border-red-500 @enderror"
                          required>{{ old('question', $faq->question) }}</textarea>
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
                          required>{{ old('answer', $faq->answer) }}</textarea>
                @error('answer')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
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
                        <input type="text" name="category" value="{{ old('category', $faq->category) }}" 
                               class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-ropanasuri-500 focus:border-ropanasuri-500"
                               placeholder="Contoh: Pendaftaran, BPJS, Layanan">
                    </div>
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
                        <input type="text" name="keywords" value="{{ old('keywords', $keywordsString) }}" 
                               class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-ropanasuri-500 focus:border-ropanasuri-500 @error('keywords') border-red-500 @enderror"
                               required>
                    </div>
                    @error('keywords')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            
            <!-- Active Status -->
            <div class="mb-8">
                <label class="flex items-center p-4 bg-gray-50 rounded-xl border border-gray-200 cursor-pointer hover:bg-gray-100 transition">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', $faq->is_active) ? 'checked' : '' }} 
                           class="h-5 w-5 text-ropanasuri-600 focus:ring-ropanasuri-500 border-gray-300 rounded">
                    <span class="ml-3">
                        <span class="text-sm font-semibold text-gray-800">Aktifkan FAQ ini</span>
                        <span class="text-xs text-gray-600 block">Saat ini: {{ $faq->is_active ? 'Aktif' : 'Nonaktif' }}</span>
                    </span>
                </label>
            </div>
            
            <!-- Stats Info -->
            <div class="mb-8 p-4 bg-gray-50 rounded-xl border border-gray-200">
                <div class="grid grid-cols-3 gap-4 text-center">
                    <div>
                        <span class="text-xs text-gray-500 uppercase">Ditanyakan</span>
                        <p class="text-xl font-bold text-ropanasuri-700">{{ $faq->hit_count }}x</p>
                    </div>
                    <div>
                        <span class="text-xs text-gray-500 uppercase">Keywords</span>
                        <p class="text-xl font-bold text-ropanasuri-700">{{ $faq->keywords_count }}</p>
                    </div>
                    <div>
                        <span class="text-xs text-gray-500 uppercase">Dibuat</span>
                        <p class="text-sm font-semibold text-gray-700">{{ $faq->created_at->format('d/m/Y') }}</p>
                    </div>
                </div>
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
                    Update FAQ
                </button>
            </div>
        </form>
    </div>
</div>
@endsection