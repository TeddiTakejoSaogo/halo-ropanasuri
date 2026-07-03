@extends('layouts.admin')

@section('title', 'Riwayat Chat - Halo-Ropanasuri')
@section('page-title', 'Riwayat Percakapan')
@section('page-badge', 'Live')

@section('header-actions')
    <a href="{{ route('admin.chat.export') }}" class="px-4 py-2 bg-white border border-gray-300 text-gray-700 rounded-xl hover:bg-gray-50 transition flex items-center text-sm">
        <i class="fas fa-download mr-2"></i>
        Export CSV
    </a>
@endsection

@section('breadcrumbs')
    <i class="fas fa-home text-gray-400 mr-1"></i> Dashboard 
    <i class="fas fa-chevron-right text-gray-400 mx-2 text-xs"></i> 
    Riwayat Chat
@endsection

@section('content')
<div class="space-y-6">
    
    <!-- Filter & Search Card -->
    <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100">
        <form method="GET" action="{{ route('admin.chat.logs') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
            
            <!-- Search -->
            <div class="col-span-1 md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-1">Pencarian</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-search text-gray-400"></i>
                    </div>
                    <input type="text" name="search" value="{{ request('search') }}" 
                           class="block w-full pl-10 pr-3 py-2.5 border border-gray-300 rounded-xl focus:ring-ropanasuri-500 focus:border-ropanasuri-500"
                           placeholder="Cari pertanyaan atau jawaban...">
                </div>
            </div>
            
            <!-- Filter Tanggal -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal</label>
                <input type="date" name="date" value="{{ request('date') }}" 
                       class="block w-full px-3 py-2.5 border border-gray-300 rounded-xl focus:ring-ropanasuri-500 focus:border-ropanasuri-500">
            </div>
            
            <!-- Filter Status -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                <select name="status" class="block w-full px-3 py-2.5 border border-gray-300 rounded-xl focus:ring-ropanasuri-500 focus:border-ropanasuri-500">
                    <option value="">Semua Status</option>
                    <option value="found" {{ request('status') == 'found' ? 'selected' : '' }}>Terjawab</option>
                    <option value="not_found" {{ request('status') == 'not_found' ? 'selected' : '' }}>Tidak Ditemukan</option>
                    <option value="empty" {{ request('status') == 'empty' ? 'selected' : '' }}>Kosong</option>
                </select>
            </div>
            
            <!-- Tombol Filter -->
            <div class="col-span-1 md:col-span-4 flex justify-end gap-3 mt-2">
                <a href="{{ route('admin.chat.logs') }}" class="px-5 py-2.5 border border-gray-300 rounded-xl text-gray-700 hover:bg-gray-50 transition">
                    <i class="fas fa-undo-alt mr-2"></i>
                    Reset
                </a>
                <button type="submit" class="px-5 py-2.5 bg-ropanasuri-600 text-white rounded-xl hover:bg-ropanasuri-700 transition flex items-center">
                    <i class="fas fa-filter mr-2"></i>
                    Terapkan Filter
                </button>
            </div>
        </form>
    </div>
    
    <!-- Statistik Mini -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div class="bg-gradient-to-br from-blue-50 to-white rounded-xl p-4 border border-blue-100">
            <span class="text-xs text-blue-600 font-medium">TOTAL PERCAKAPAN</span>
            <p class="text-2xl font-bold text-gray-800 mt-1">{{ $logs->total() }}</p>
        </div>
        <div class="bg-gradient-to-br from-green-50 to-white rounded-xl p-4 border border-green-100">
            <span class="text-xs text-green-600 font-medium">TERJAWAB</span>
            <p class="text-2xl font-bold text-gray-800 mt-1">
                {{ \App\Models\ChatLog::where('status', 'found')->count() }}
            </p>
        </div>
        <div class="bg-gradient-to-br from-yellow-50 to-white rounded-xl p-4 border border-yellow-100">
            <span class="text-xs text-yellow-600 font-medium">BELUM TERJAWAB</span>
            <p class="text-2xl font-bold text-gray-800 mt-1">
                {{ \App\Models\ChatLog::where('status', 'not_found')->count() }}
            </p>
        </div>
        <div class="bg-gradient-to-br from-purple-50 to-white rounded-xl p-4 border border-purple-100">
            <span class="text-xs text-purple-600 font-medium">HARI INI</span>
            <p class="text-2xl font-bold text-gray-800 mt-1">
                {{ \App\Models\ChatLog::whereDate('created_at', today())->count() }}
            </p>
        </div>
    </div>
    
    <!-- Tabel Riwayat Chat -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Waktu</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pertanyaan</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jawaban</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($logs as $log)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">{{ $log->created_at->format('H:i:s') }}</div>
                            <div class="text-xs text-gray-500">{{ $log->created_at->format('d M Y') }}</div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm text-gray-900 max-w-xs break-words">
                                "{{ $log->question }}"
                            </div>
                            @if($log->faq_id)
                                <span class="inline-flex items-center mt-1 px-2 py-0.5 rounded text-xs bg-blue-50 text-blue-700">
                                    <i class="fas fa-link mr-1"></i>
                                    FAQ #{{ $log->faq_id }}
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm text-gray-700 max-w-sm break-words">
                                {{ Str::limit($log->answer, 80) }}
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($log->status == 'found')
                                <span class="px-2.5 py-1.5 text-xs rounded-full bg-green-100 text-green-800 font-medium">
                                    <i class="fas fa-check-circle mr-1"></i>
                                    Terjawab
                                </span>
                            @elseif($log->status == 'not_found')
                                <span class="px-2.5 py-1.5 text-xs rounded-full bg-yellow-100 text-yellow-800 font-medium">
                                    <i class="fas fa-question-circle mr-1"></i>
                                    Tidak ditemukan
                                </span>
                            @else
                                <span class="px-2.5 py-1.5 text-xs rounded-full bg-gray-100 text-gray-800 font-medium">
                                    <i class="fas fa-ban mr-1"></i>
                                    Kosong
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            <div class="flex items-center space-x-3">
                                <a href="{{ route('admin.chat.show', $log) }}" class="text-blue-600 hover:text-blue-800" title="Detail">
                                    <i class="fas fa-eye"></i>
                                </a>
                                
                                @if($log->status == 'not_found')
                                <a href="{{ route('admin.faq.create') }}?question={{ urlencode($log->question) }}" 
                                   class="text-green-600 hover:text-green-800" title="Tambah ke FAQ">
                                    <i class="fas fa-plus-circle"></i>
                                </a>
                                @endif
                                
                                <form action="{{ route('admin.chat.destroy', $log) }}" method="POST" class="inline" 
                                      onsubmit="return confirm('Hapus riwayat chat ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800" title="Hapus">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center">
                            <div class="text-gray-400 text-6xl mb-4">
                                <i class="fas fa-comment-slash"></i>
                            </div>
                            <p class="text-gray-500 font-medium">Belum ada riwayat chat</p>
                            <p class="text-gray-400 text-sm mt-1">User akan muncul di sini setelah mulai chat</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        <div class="px-6 py-4 border-t border-gray-200">
            {{ $logs->links() }}
        </div>
    </div>
</div>
@endsection