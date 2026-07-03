@extends('layouts.admin')

@section('title', 'Kelola Artikel Edukasi - Halo-Ropanasuri')
@section('page-title', 'Artikel Edukasi')
@section('page-badge', 'Konten Medis')

@section('header-actions')
    <div class="flex items-center gap-3">
        <a href="{{ route('admin.artikel.create') }}" 
           class="px-4 py-2 bg-ropanasuri-600 text-white rounded-xl hover:bg-ropanasuri-700 transition flex items-center text-sm shadow-lg">
            <i class="fas fa-plus-circle mr-2"></i>
            Tulis Artikel Baru
        </a>
    </div>
@endsection

@section('content')
<div class="space-y-6">
    
    <!-- Filter Card -->
    <div class="bg-white rounded-2xl shadow-md p-6 border border-gray-200">
        <form method="GET" action="{{ route('admin.artikel.index') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div class="col-span-1 md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-2">Cari Artikel</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center">
                        <i class="fas fa-search text-gray-400"></i>
                    </div>
                    <input type="text" name="search" value="{{ request('search') }}" 
                           class="block w-full pl-10 pr-3 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-ropanasuri-500"
                           placeholder="Cari judul atau konten...">
                </div>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
                <select name="category" class="block w-full px-3 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-ropanasuri-500">
                    <option value="">Semua Kategori</option>
                    @foreach($categories as $category)
                        <option value="{{ $category }}" {{ request('category') == $category ? 'selected' : '' }}>
                            {{ $category }}
                        </option>
                    @endforeach
                </select>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                <select name="status" class="block w-full px-3 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-ropanasuri-500">
                    <option value="">Semua</option>
                    <option value="published" {{ request('status') == 'published' ? 'selected' : '' }}>Publik</option>
                    <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                </select>
            </div>
            
            <div class="col-span-1 md:col-span-4 flex justify-end gap-3">
                <a href="{{ route('admin.artikel.index') }}" class="px-4 py-2 border border-gray-300 rounded-xl text-gray-700 hover:bg-gray-50">
                    <i class="fas fa-undo-alt mr-1"></i>
                    Reset
                </a>
                <button type="submit" class="px-4 py-2 bg-ropanasuri-600 text-white rounded-xl hover:bg-ropanasuri-700">
                    <i class="fas fa-filter mr-1"></i>
                    Terapkan
                </button>
            </div>
        </form>
    </div>
    
    <!-- Statistik -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div class="bg-gradient-to-br from-blue-50 to-white rounded-xl p-4 border border-blue-200">
            <span class="text-xs font-semibold text-blue-800">TOTAL ARTIKEL</span>
            <p class="text-2xl font-bold text-gray-800 mt-1">{{ $artikels->total() }}</p>
        </div>
        <div class="bg-gradient-to-br from-green-50 to-white rounded-xl p-4 border border-green-200">
            <span class="text-xs font-semibold text-green-800">PUBLIK</span>
            <p class="text-2xl font-bold text-gray-800 mt-1">{{ \App\Models\Artikel::where('is_published', true)->count() }}</p>
        </div>
        <div class="bg-gradient-to-br from-yellow-50 to-white rounded-xl p-4 border border-yellow-200">
            <span class="text-xs font-semibold text-yellow-800">DRAFT</span>
            <p class="text-2xl font-bold text-gray-800 mt-1">{{ \App\Models\Artikel::where('is_published', false)->count() }}</p>
        </div>
        <div class="bg-gradient-to-br from-purple-50 to-white rounded-xl p-4 border border-purple-200">
            <span class="text-xs font-semibold text-purple-800">KATEGORI</span>
            <p class="text-2xl font-bold text-gray-800 mt-1">{{ $categories->count() }}</p>
        </div>
    </div>
    
    <!-- Alert -->
    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-600 text-green-800 p-4 rounded-r-xl">
            <i class="fas fa-check-circle mr-2"></i>
            {{ session('success') }}
        </div>
    @endif
    
    @if(session('error'))
        <div class="bg-red-100 border-l-4 border-red-600 text-red-800 p-4 rounded-r-xl">
            <i class="fas fa-exclamation-circle mr-2"></i>
            {{ session('error') }}
        </div>
    @endif
    
    <!-- Grid Artikel -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($artikels as $artikel)
        <div class="bg-white rounded-2xl shadow-md border border-gray-200 overflow-hidden hover:shadow-lg transition">
            
            <!-- Image -->
            @if($artikel->gambar)
                <div class="h-48 bg-gray-100 overflow-hidden">
                    <img src="{{ asset('storage/'.$artikel->gambar) }}" alt="{{ $artikel->judul }}" 
                         class="w-full h-full object-cover hover:scale-105 transition duration-500">
                </div>
            @else
                <div class="h-48 bg-gradient-to-br from-ropanasuri-100 to-ropanasuri-200 flex items-center justify-center">
                    <i class="fas fa-newspaper text-ropanasuri-600 text-5xl"></i>
                </div>
            @endif
            
            <!-- Content -->
            <div class="p-6">
                <div class="flex items-center justify-between mb-2">
                    <span class="px-3 py-1 text-xs rounded-full bg-ropanasuri-100 text-ropanasuri-800 font-medium">
                        {{ $artikel->kategori ?? 'Umum' }}
                    </span>
                    @if($artikel->is_published)
                        <span class="text-xs text-green-600 bg-green-50 px-2 py-1 rounded-full">
                            <i class="fas fa-globe mr-1"></i> Publik
                        </span>
                    @else
                        <span class="text-xs text-gray-600 bg-gray-100 px-2 py-1 rounded-full">
                            <i class="fas fa-pencil-alt mr-1"></i> Draft
                        </span>
                    @endif
                </div>
                
                <h3 class="font-bold text-gray-800 mb-2 line-clamp-2 h-14">
                    <a href="{{ route('admin.artikel.edit', $artikel) }}" class="hover:text-ropanasuri-700">
                        {{ $artikel->judul }}
                    </a>
                </h3>
                
                <p class="text-sm text-gray-600 mb-4 line-clamp-2 h-10">
                    {{ Str::limit($artikel->excerpt ?? strip_tags($artikel->konten), 80) }}
                </p>
                
                <div class="flex items-center justify-between text-xs text-gray-500 mb-4">
                    <span>
                        <i class="far fa-calendar mr-1"></i>
                        {{ $artikel->created_at->format('d M Y') }}
                    </span>
                    <span>
                        <i class="far fa-eye mr-1"></i>
                        {{ $artikel->dilihat }} dibaca
                    </span>
                </div>
                
                <!-- Actions -->
                <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                    <div class="flex items-center space-x-2">
                        <a href="{{ route('admin.artikel.edit', $artikel) }}" 
                           class="p-2 text-blue-700 hover:bg-blue-50 rounded-lg transition"
                           title="Edit">
                            <i class="fas fa-edit"></i>
                        </a>
                        
                        <form action="{{ route('admin.artikel.duplicate', $artikel) }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="p-2 text-green-700 hover:bg-green-50 rounded-lg transition" title="Duplikat">
                                <i class="fas fa-copy"></i>
                            </button>
                        </form>
                        
                        <form action="{{ route('admin.artikel.destroy', $artikel) }}" method="POST" class="inline"
                              onsubmit="return confirm('Yakin ingin menghapus artikel ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="p-2 text-red-700 hover:bg-red-50 rounded-lg transition" title="Hapus">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </form>
                    </div>
                    
                    <form action="{{ route('admin.artikel.toggle-publish', $artikel) }}" method="POST">
                        @csrf
                        <button type="submit" class="text-sm {{ $artikel->is_published ? 'text-yellow-600 hover:text-yellow-800' : 'text-green-600 hover:text-green-800' }}">
                            @if($artikel->is_published)
                                <i class="fas fa-ban mr-1"></i> Arsipkan
                            @else
                                <i class="fas fa-check-circle mr-1"></i> Publikasikan
                            @endif
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-3">
            <div class="bg-white rounded-2xl shadow-md p-12 text-center">
                <div class="text-gray-400 text-6xl mb-4">
                    <i class="fas fa-newspaper"></i>
                </div>
                <p class="text-gray-600 font-medium text-lg">Belum ada artikel edukasi</p>
                <p class="text-gray-400 text-sm mt-1">Mulai tulis artikel pertama untuk pasien Ropanāsuri</p>
                <a href="{{ route('admin.artikel.create') }}" 
                   class="inline-flex items-center mt-4 px-5 py-2.5 bg-ropanasuri-600 text-white rounded-xl hover:bg-ropanasuri-700 transition">
                    <i class="fas fa-plus-circle mr-2"></i>
                    Tulis Artikel Sekarang
                </a>
            </div>
        </div>
        @endforelse
    </div>
    
    <!-- Pagination -->
    <div class="mt-6">
        {{ $artikels->links() }}
    </div>
</div>
@endsection