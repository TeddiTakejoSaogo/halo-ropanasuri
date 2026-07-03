@extends('layouts.admin')

@section('title', 'Kelola FAQ & Keywords - Halo-Ropanasuri')
@section('page-title', 'FAQ & Keywords')
@section('page-badge', 'Database AI')

@section('header-actions')
    <div class="flex items-center gap-3">
        <!-- Bulk Delete Button (hidden by default) -->
        <button id="bulk-delete-btn" 
                class="px-4 py-2 bg-red-600 text-white rounded-xl hover:bg-red-700 transition flex items-center text-sm hidden"
                onclick="confirmBulkDelete()">
            <i class="fas fa-trash-alt mr-2"></i>
            Hapus Terpilih (<span id="selected-count">0</span>)
        </button>
        
        <a href="{{ route('admin.faq.create') }}" 
           class="px-4 py-2 bg-ropanasuri-600 text-white rounded-xl hover:bg-ropanasuri-700 transition flex items-center text-sm shadow-lg">
            <i class="fas fa-plus-circle mr-2"></i>
            Tambah FAQ Baru
        </a>
    </div>
@endsection

@section('breadcrumbs')
    <i class="fas fa-home text-gray-400 mr-1"></i> Dashboard 
    <i class="fas fa-chevron-right text-gray-400 mx-2 text-xs"></i> 
    Manajemen FAQ
@endsection

@section('content')
<div class="space-y-6">
    
    <!-- === FILTER & SEARCH CARD === -->
    <div class="bg-white rounded-2xl shadow-md p-6 border border-gray-200">
        <form method="GET" action="{{ route('admin.faq.index') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
            
            <!-- Search -->
            <div class="col-span-1 md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-2">Pencarian</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-search text-gray-400"></i>
                    </div>
                    <input type="text" name="search" value="{{ request('search') }}" 
                           class="block w-full pl-10 pr-3 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-ropanasuri-500 focus:border-ropanasuri-500"
                           placeholder="Cari pertanyaan, jawaban, atau keyword...">
                </div>
            </div>
            
            <!-- Filter Category -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
                <select name="category" class="block w-full px-3 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-ropanasuri-500 focus:border-ropanasuri-500">
                    <option value="">Semua Kategori</option>
                    @foreach($categories as $category)
                        <option value="{{ $category }}" {{ request('category') == $category ? 'selected' : '' }}>
                            {{ $category }}
                        </option>
                    @endforeach
                </select>
            </div>
            
            <!-- Filter Status -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                <select name="status" class="block w-full px-3 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-ropanasuri-500 focus:border-ropanasuri-500">
                    <option value="">Semua Status</option>
                    <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Aktif</option>
                    <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Nonaktif</option>
                </select>
            </div>
            
            <!-- Sort & Actions -->
            <div class="col-span-1 md:col-span-4 flex flex-wrap justify-between items-center gap-3 mt-2">
                <div class="flex items-center gap-3">
                    <label class="text-sm font-medium text-gray-700">Urutkan:</label>
                    <select name="sort" class="px-3 py-2 border border-gray-300 rounded-xl text-sm focus:ring-2 focus:ring-ropanasuri-500" onchange="this.form.submit()">
                        <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Terbaru</option>
                        <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Terlama</option>
                        <option value="popular" {{ request('sort') == 'popular' ? 'selected' : '' }}>Terpopuler</option>
                    </select>
                </div>
                
                <div class="flex gap-3">
                    <a href="{{ route('admin.faq.index') }}" class="px-4 py-2 border border-gray-300 rounded-xl text-gray-700 hover:bg-gray-50 transition text-sm">
                        <i class="fas fa-undo-alt mr-1"></i>
                        Reset
                    </a>
                    <button type="submit" class="px-4 py-2 bg-ropanasuri-600 text-white rounded-xl hover:bg-ropanasuri-700 transition text-sm">
                        <i class="fas fa-filter mr-1"></i>
                        Terapkan Filter
                    </button>
                </div>
            </div>
        </form>
    </div>
    
    <!-- === STATISTIK MINI === -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div class="bg-gradient-to-br from-blue-50 to-white rounded-xl p-4 border border-blue-200">
            <span class="text-xs font-semibold text-blue-800 uppercase">TOTAL FAQ</span>
            <p class="text-2xl font-bold text-gray-800 mt-1">{{ $faqs->total() }}</p>
        </div>
        <div class="bg-gradient-to-br from-green-50 to-white rounded-xl p-4 border border-green-200">
            <span class="text-xs font-semibold text-green-800 uppercase">AKTIF</span>
            <p class="text-2xl font-bold text-gray-800 mt-1">{{ \App\Models\Faq::where('is_active', true)->count() }}</p>
        </div>
        <div class="bg-gradient-to-br from-yellow-50 to-white rounded-xl p-4 border border-yellow-200">
            <span class="text-xs font-semibold text-yellow-800 uppercase">NONAKTIF</span>
            <p class="text-2xl font-bold text-gray-800 mt-1">{{ \App\Models\Faq::where('is_active', false)->count() }}</p>
        </div>
        <div class="bg-gradient-to-br from-purple-50 to-white rounded-xl p-4 border border-purple-200">
            <span class="text-xs font-semibold text-purple-800 uppercase">TOTAL KEYWORDS</span>
            <p class="text-2xl font-bold text-gray-800 mt-1">{{ \App\Models\Keyword::count() }}</p>
        </div>
    </div>
    
    <!-- === ALERT SUCCESS/ERROR === -->
    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-600 text-green-800 p-4 rounded-r-xl shadow-md" role="alert">
            <div class="flex items-center">
                <i class="fas fa-check-circle text-green-600 mr-3 text-lg"></i>
                <span>{{ session('success') }}</span>
            </div>
        </div>
    @endif
    
    @if(session('error'))
        <div class="bg-red-100 border-l-4 border-red-600 text-red-800 p-4 rounded-r-xl shadow-md" role="alert">
            <div class="flex items-center">
                <i class="fas fa-exclamation-circle text-red-600 mr-3 text-lg"></i>
                <span>{{ session('error') }}</span>
            </div>
        </div>
    @endif
    
    <!-- === TABLE FAQ === -->
    <div class="bg-white rounded-2xl shadow-md border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-6 py-4 w-10">
                            <input type="checkbox" id="select-all" class="rounded border-gray-300 text-ropanasuri-600 focus:ring-ropanasuri-500">
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Pertanyaan</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Keywords</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Kategori</th>
                        <th class="px-6 py-4 text-center text-xs font-semibold text-gray-700 uppercase tracking-wider">Ditanyakan</th>
                        <th class="px-6 py-4 text-center text-xs font-semibold text-gray-700 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 text-center text-xs font-semibold text-gray-700 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($faqs as $faq)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4">
                            <input type="checkbox" name="selected[]" value="{{ $faq->id }}" 
                                   class="select-item rounded border-gray-300 text-ropanasuri-600 focus:ring-ropanasuri-500">
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm font-medium text-gray-900 max-w-md break-words">
                                {{ $faq->question }}
                            </div>
                            <div class="text-xs text-gray-500 mt-1">
                                <i class="far fa-clock mr-1"></i> {{ $faq->created_at->format('d M Y') }}
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex flex-wrap gap-1 max-w-xs">
                                @foreach($faq->keywords->take(5) as $keyword)
                                    <span class="inline-flex items-center px-2 py-1 rounded-lg text-xs font-medium bg-blue-100 text-blue-800">
                                        {{ $keyword->keyword }}
                                    </span>
                                @endforeach
                                @if($faq->keywords_count > 5)
                                    <span class="text-xs text-gray-500">+{{ $faq->keywords_count - 5 }}</span>
                                @endif
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1.5 text-xs rounded-full bg-gray-100 text-gray-800 font-medium">
                                {{ $faq->category ?? 'Umum' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="text-sm font-semibold text-ropanasuri-700">{{ $faq->hit_count }}</span>
                            <span class="text-xs text-gray-500 block">kali</span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <form action="{{ route('admin.faq.toggle-status', $faq) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="relative inline-flex items-center">
                                    @if($faq->is_active)
                                        <span class="px-3 py-1.5 text-xs rounded-full bg-green-100 text-green-800 font-medium hover:bg-green-200 transition">
                                            <i class="fas fa-check-circle mr-1"></i> Aktif
                                        </span>
                                    @else
                                        <span class="px-3 py-1.5 text-xs rounded-full bg-gray-100 text-gray-800 font-medium hover:bg-gray-200 transition">
                                            <i class="fas fa-ban mr-1"></i> Nonaktif
                                        </span>
                                    @endif
                                </button>
                            </form>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center space-x-3">
                                <a href="{{ route('admin.faq.edit', $faq) }}" 
                                   class="text-blue-700 hover:text-blue-900 p-1.5 rounded-lg hover:bg-blue-50 transition"
                                   title="Edit">
                                    <i class="fas fa-edit text-lg"></i>
                                </a>
                                
                                <form action="{{ route('admin.faq.duplicate', $faq) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" 
                                            class="text-green-700 hover:text-green-900 p-1.5 rounded-lg hover:bg-green-50 transition"
                                            title="Duplikat">
                                        <i class="fas fa-copy text-lg"></i>
                                    </button>
                                </form>
                                
                                <form action="{{ route('admin.faq.destroy', $faq) }}" method="POST" class="inline"
                                      onsubmit="return confirm('Yakin ingin menghapus FAQ ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="text-red-700 hover:text-red-900 p-1.5 rounded-lg hover:bg-red-50 transition"
                                            title="Hapus">
                                        <i class="fas fa-trash-alt text-lg"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-16 text-center">
                            <div class="text-gray-400 text-6xl mb-4">
                                <i class="fas fa-question-circle"></i>
                            </div>
                            <p class="text-gray-600 font-medium text-lg">Belum ada data FAQ</p>
                            <p class="text-gray-400 text-sm mt-1">Klik tombol "Tambah FAQ Baru" untuk memulai</p>
                            <a href="{{ route('admin.faq.create') }}" 
                               class="inline-flex items-center mt-4 px-5 py-2.5 bg-ropanasuri-600 text-white rounded-xl hover:bg-ropanasuri-700 transition">
                                <i class="fas fa-plus-circle mr-2"></i>
                                Tambah FAQ Pertama
                            </a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
            {{ $faqs->links() }}
        </div>
    </div>
    
    <!-- === INFO KEYWORDS === -->
    <div class="bg-blue-50 border border-blue-200 rounded-2xl p-5">
        <div class="flex items-start">
            <div class="flex-shrink-0">
                <i class="fas fa-info-circle text-blue-600 text-xl"></i>
            </div>
            <div class="ml-3">
                <h3 class="text-sm font-semibold text-blue-800">Tips Pengelolaan Keywords</h3>
                <div class="mt-2 text-sm text-blue-700">
                    <p>• Keyword adalah kata kunci yang digunakan AI untuk mencocokkan pertanyaan user.</p>
                    <p>• Gunakan kata dasar (contoh: "daftar" bukan "mendaftar" atau "pendaftaran").</p>
                    <p>• Tambahkan 3-5 keyword relevan per FAQ untuk hasil terbaik.</p>
                    <p>• Keyword tidak perlu menggunakan huruf kapital (otomatis diubah ke huruf kecil).</p>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Select All Checkbox
    document.getElementById('select-all').addEventListener('change', function() {
        const checkboxes = document.querySelectorAll('.select-item');
        checkboxes.forEach(cb => cb.checked = this.checked);
        updateBulkDeleteButton();
    });
    
    // Individual checkbox
    document.querySelectorAll('.select-item').forEach(cb => {
        cb.addEventListener('change', updateBulkDeleteButton);
    });
    
    function updateBulkDeleteButton() {
        const selected = document.querySelectorAll('.select-item:checked');
        const btn = document.getElementById('bulk-delete-btn');
        const countSpan = document.getElementById('selected-count');
        
        if (selected.length > 0) {
            btn.classList.remove('hidden');
            countSpan.textContent = selected.length;
        } else {
            btn.classList.add('hidden');
        }
    }
    
    function confirmBulkDelete() {
        const selected = document.querySelectorAll('.select-item:checked');
        const ids = Array.from(selected).map(cb => cb.value);
        
        if (confirm(`Yakin ingin menghapus ${selected.length} FAQ terpilih?`)) {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '{{ route("admin.faq.bulk-destroy") }}';
            
            const csrf = document.createElement('input');
            csrf.name = '_token';
            csrf.value = '{{ csrf_token() }}';
            form.appendChild(csrf);
            
            const method = document.createElement('input');
            method.name = '_method';
            method.value = 'DELETE';
            form.appendChild(method);
            
            ids.forEach(id => {
                const input = document.createElement('input');
                input.name = 'ids[]';
                input.value = id;
                form.appendChild(input);
            });
            
            document.body.appendChild(form);
            form.submit();
        }
    }
</script>
@endpush
@endsection