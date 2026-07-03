@extends('layouts.admin')

@section('title', 'Pertanyaan Baru - Halo-Ropanasuri')
@section('page-title', 'Pertanyaan Perlu Ditangani')
@section('page-badge', 'Action Required')

@section('header-actions')
    <button onclick="window.location.reload()" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-xl hover:bg-gray-200 transition flex items-center text-sm">
        <i class="fas fa-sync-alt mr-2"></i>
        Refresh
    </button>
@endsection

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    
    <!-- Kolom Kiri: Daftar Pertanyaan -->
    <div class="lg:col-span-2 space-y-6">
        
        <!-- Alert Penting -->
        <div class="bg-amber-50 border-l-4 border-amber-500 p-4 rounded-r-xl">
            <div class="flex">
                <div class="flex-shrink-0">
                    <i class="fas fa-exclamation-triangle text-amber-500 text-xl"></i>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-amber-700">
                        <span class="font-bold">Pertanyaan-pertanyaan ini tidak ditemukan di database FAQ.</span>
                        Segera tambahkan jawaban agar AI bisa merespon dengan tepat.
                    </p>
                </div>
            </div>
        </div>
        
        <!-- Card: Quick Add FAQ -->
        <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100">
            <h3 class="font-bold text-gray-800 mb-4 flex items-center">
                <i class="fas fa-bolt text-yellow-500 mr-2"></i>
                Tambah FAQ Cepat
            </h3>
            
            <form action="{{ route('admin.chat.add-to-faq') }}" method="POST" id="quick-faq-form">
                @csrf
                
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Pertanyaan</label>
                    <select id="quick-question-select" name="question" class="block w-full px-3 py-2.5 border border-gray-300 rounded-xl focus:ring-ropanasuri-500 focus:border-ropanasuri-500" required>
                        <option value="">-- Pilih pertanyaan --</option>
                        @foreach($unanswered as $log)
                            <option value="{{ $log->question }}">{{ Str::limit($log->question, 80) }}</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Jawaban</label>
                    <textarea name="answer" rows="3" class="block w-full px-3 py-2.5 border border-gray-300 rounded-xl focus:ring-ropanasuri-500 focus:border-ropanasuri-500" placeholder="Tulis jawaban untuk pertanyaan ini..." required></textarea>
                </div>
                
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Keywords (pisahkan dengan koma)</label>
                    <input type="text" name="keywords" class="block w-full px-3 py-2.5 border border-gray-300 rounded-xl focus:ring-ropanasuri-500 focus:border-ropanasuri-500" placeholder="contoh: jadwal, dokter, praktek" required>
                    <p class="text-xs text-gray-500 mt-1">Keyword digunakan AI untuk mencocokkan pertanyaan</p>
                </div>
                
                <div class="mb-4">
                    <label class="flex items-center">
                        <input type="checkbox" name="update_previous" value="1" checked class="rounded border-gray-300 text-ropanasuri-600 shadow-sm focus:border-ropanasuri-300 focus:ring focus:ring-ropanasuri-200 focus:ring-opacity-50">
                        <span class="ml-2 text-sm text-gray-600">Perbarui juga pertanyaan serupa sebelumnya</span>
                    </label>
                </div>
                
                <div class="flex justify-end">
                    <button type="submit" class="px-6 py-2.5 bg-ropanasuri-600 text-white rounded-xl hover:bg-ropanasuri-700 transition flex items-center">
                        <i class="fas fa-save mr-2"></i>
                        Simpan ke FAQ
                    </button>
                </div>
            </form>
        </div>
        
        <!-- Daftar Pertanyaan Tidak Terjawab -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-6 py-4 bg-gray-50 border-b border-gray-200 flex justify-between items-center">
                <h3 class="font-semibold text-gray-800 flex items-center">
                    <i class="fas fa-list-ul text-gray-600 mr-2"></i>
                    Semua Pertanyaan Tidak Terjawab
                    <span class="ml-3 bg-yellow-100 text-yellow-800 px-2.5 py-0.5 rounded-full text-xs">
                        {{ $unanswered->total() }}
                    </span>
                </h3>
            </div>
            
            <div class="divide-y divide-gray-200">
                @forelse($unanswered as $log)
                <div class="p-5 hover:bg-gray-50 transition">
                    <div class="flex justify-between items-start">
                        <div class="flex-1">
                            <div class="flex items-start gap-3">
                                <div class="text-yellow-600 mt-1">
                                    <i class="fas fa-question-circle"></i>
                                </div>
                                <div>
                                    <p class="text-gray-800 font-medium">"{{ $log->question }}"</p>
                                    <div class="flex items-center gap-4 mt-2 text-xs">
                                        <span class="text-gray-500">
                                            <i class="far fa-clock mr-1"></i>
                                            {{ $log->created_at->diffForHumans() }}
                                        </span>
                                        <span class="text-gray-500">
                                            <i class="fas fa-globe mr-1"></i>
                                            {{ $log->session_id ? 'Online' : 'Guest' }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center gap-2 ml-4">
                            <button onclick="fillForm('{{ addslashes($log->question) }}')" 
                                    class="px-3 py-1.5 bg-ropanasuri-50 text-ropanasuri-700 rounded-lg hover:bg-ropanasuri-100 transition text-xs flex items-center">
                                <i class="fas fa-plus-circle mr-1"></i>
                                Gunakan
                            </button>
                            <form action="{{ route('admin.chat.destroy', $log) }}" method="POST" 
                                  onsubmit="return confirm('Hapus pertanyaan ini dari daftar?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-1.5 text-gray-400 hover:text-red-600 transition">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @empty
                <div class="p-8 text-center">
                    <div class="text-gray-400 text-5xl mb-3">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <p class="text-gray-600 font-medium">Tidak ada pertanyaan yang belum terjawab</p>
                    <p class="text-gray-400 text-sm mt-1">Semua pertanyaan user sudah ada di database FAQ</p>
                </div>
                @endforelse
            </div>
            
            <!-- Pagination -->
            <div class="px-6 py-4 border-t border-gray-200">
                {{ $unanswered->links() }}
            </div>
        </div>
    </div>
    
    <!-- Kolom Kanan: Statistik & Top Pertanyaan -->
    <div class="lg:col-span-1 space-y-6">
        
        <!-- Card: Ringkasan -->
        <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100">
            <h3 class="font-bold text-gray-800 mb-4 flex items-center">
                <i class="fas fa-chart-pie text-ropanasuri-600 mr-2"></i>
                Ringkasan
            </h3>
            
            <div class="space-y-4">
                <div class="flex justify-between items-center pb-3 border-b border-gray-100">
                    <span class="text-sm text-gray-600">Total pertanyaan</span>
                    <span class="font-bold text-gray-900">{{ $unanswered->total() }}</span>
                </div>
                <div class="flex justify-between items-center pb-3 border-b border-gray-100">
                    <span class="text-sm text-gray-600">Hari ini</span>
                    <span class="font-bold text-gray-900">
                        {{ \App\Models\ChatLog::where('status', 'not_found')->whereDate('created_at', today())->count() }}
                    </span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-sm text-gray-600">Paling sering ditanyakan</span>
                    <span class="text-xs bg-gray-100 px-2 py-1 rounded-full">
                        {{ $grouped->first()->question ?? '-' }}
                    </span>
                </div>
            </div>
        </div>
        
        <!-- Card: Top 10 Pertanyaan -->
        <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100">
            <h3 class="font-bold text-gray-800 mb-4 flex items-center">
                <i class="fas fa-trophy text-yellow-500 mr-2"></i>
                Top Pertanyaan
            </h3>
            
            <div class="space-y-3">
                @forelse($grouped as $index => $item)
                <div class="flex items-center justify-between group hover:bg-gray-50 p-2 rounded-lg">
                    <div class="flex items-center">
                        <span class="w-6 h-6 flex items-center justify-center {{ $index < 3 ? 'bg-yellow-100 text-yellow-700' : 'bg-gray-100 text-gray-600' }} rounded-full text-xs font-bold mr-3">
                            {{ $index + 1 }}
                        </span>
                        <span class="text-sm text-gray-800 truncate max-w-[150px]">
                            "{{ Str::limit($item->question, 30) }}"
                        </span>
                    </div>
                    <span class="text-xs bg-gray-100 px-2 py-1 rounded-full">
                        {{ $item->total }}x
                    </span>
                </div>
                @empty
                <p class="text-gray-500 text-sm text-center py-4">Belum ada data</p>
                @endforelse
            </div>
            
            <div class="mt-5 pt-4 border-t border-gray-100">
                <a href="{{ route('admin.faq.create') }}" class="text-sm text-ropanasuri-600 hover:text-ropanasuri-700 flex items-center justify-center w-full py-2 border border-ropanasuri-200 rounded-xl hover:bg-ropanasuri-50 transition">
                    <i class="fas fa-plus-circle mr-2"></i>
                    Buat FAQ Baru
                </a>
            </div>
        </div>
        
        <!-- Card: Tips -->
        <div class="bg-gradient-to-br from-ropanasuri-600 to-ropanasuri-700 rounded-2xl shadow-lg p-6 text-white">
            <div class="flex items-center mb-3">
                <div class="bg-white/20 backdrop-blur-sm p-2 rounded-xl mr-3">
                    <i class="fas fa-lightbulb text-white text-xl"></i>
                </div>
                <h4 class="font-semibold">Tips Menulis FAQ</h4>
            </div>
            <ul class="space-y-2 text-sm text-ropanasuri-50">
                <li class="flex items-start">
                    <i class="fas fa-check-circle mr-2 mt-0.5 text-xs"></i>
                    Gunakan bahasa yang jelas dan mudah dipahami
                </li>
                <li class="flex items-start">
                    <i class="fas fa-check-circle mr-2 mt-0.5 text-xs"></i>
                    Tambahkan 3-5 keyword relevan per pertanyaan
                </li>
                <li class="flex items-start">
                    <i class="fas fa-check-circle mr-2 mt-0.5 text-xs"></i>
                    Kelompokkan FAQ berdasarkan kategori
                </li>
                <li class="flex items-start">
                    <i class="fas fa-check-circle mr-2 mt-0.5 text-xs"></i>
                    Update jawaban jika ada kebijakan baru
                </li>
            </ul>
        </div>
    </div>
</div>

@push('scripts')
<script>
function fillForm(question) {
    document.getElementById('quick-question-select').value = question;
    document.getElementById('quick-faq-form').scrollIntoView({ behavior: 'smooth' });
}
</script>
@endpush
@endsection