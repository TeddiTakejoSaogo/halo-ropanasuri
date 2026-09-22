@extends('layouts.admin')

@section('title', 'Dashboard Admin - Halo-Ropanasuri')
@section('page-title', 'Dashboard')
@section('page-badge', 'Live')

@section('header-actions')
    <button onclick="window.location.reload()" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-xl hover:bg-gray-200 transition flex items-center text-sm">
        <i class="fas fa-sync-alt mr-2"></i>
        Refresh
    </button>
    <a href="{{ route('admin.chat.export') }}" class="px-4 py-2 bg-ropanasuri-600 text-white rounded-xl hover:bg-ropanasuri-700 transition flex items-center text-sm">
        <i class="fas fa-download mr-2"></i>
        Export Laporan
    </a>
@endsection

@section('content')
<div class="space-y-8">
    
    <!-- === STATISTIK CARDS === -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        
        <!-- Card: Total FAQ -->
        <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Total FAQ</p>
                    <p class="text-3xl font-bold text-gray-800 mt-2">{{ $totalFaq }}</p>
                    <p class="text-xs text-gray-500 mt-2 flex items-center">
                        <i class="fas fa-keyboard text-gray-400 mr-1"></i>
                        {{ $totalKeyword }} keywords
                    </p>
                </div>
                <div class="bg-blue-100 p-3 rounded-2xl">
                    <i class="fas fa-question-circle text-blue-600 text-2xl"></i>
                </div>
            </div>
            <div class="mt-4 pt-4 border-t border-gray-100">
                <a href="{{ route('admin.faq.index') }}" class="text-sm text-ropanasuri-600 hover:text-ropanasuri-700 flex items-center">
                    Kelola FAQ
                    <i class="fas fa-arrow-right ml-1 text-xs"></i>
                </a>
            </div>
        </div>
        
        <!-- Card: Artikel Edukasi -->
        <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Artikel Edukasi</p>
                    <p class="text-3xl font-bold text-gray-800 mt-2">{{ $totalArtikel }}</p>
                    <p class="text-xs text-gray-500 mt-2">
                        {{ $artikelDraft ?? 0 }} draft, {{ $artikelPublished ?? $totalArtikel }} publik
                    </p>
                </div>
                <div class="bg-green-100 p-3 rounded-2xl">
                    <i class="fas fa-book-medical text-green-600 text-2xl"></i>
                </div>
            </div>
            <div class="mt-4 pt-4 border-t border-gray-100">
                <a href="{{ route('admin.artikel.index') }}" class="text-sm text-ropanasuri-600 hover:text-ropanasuri-700 flex items-center">
                    Kelola Artikel
                    <i class="fas fa-arrow-right ml-1 text-xs"></i>
                </a>
            </div>
        </div>
        
        <!-- Card: Total Chat -->
        <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Total Percakapan</p>
                    <p class="text-3xl font-bold text-gray-800 mt-2">{{ $totalChat }}</p>
                    <p class="text-xs text-gray-500 mt-2 flex items-center">
                        <i class="fas fa-calendar-day text-gray-400 mr-1"></i>
                        {{ $chatHariIni }} percakapan hari ini
                    </p>
                </div>
                <div class="bg-purple-100 p-3 rounded-2xl">
                    <i class="fas fa-comments text-purple-600 text-2xl"></i>
                </div>
            </div>
            <div class="mt-4 pt-4 border-t border-gray-100">
                <a href="{{ route('admin.chat.logs') }}" class="text-sm text-ropanasuri-600 hover:text-ropanasuri-700 flex items-center">
                    Lihat Riwayat
                    <i class="fas fa-arrow-right ml-1 text-xs"></i>
                </a>
            </div>
        </div>
        
        <!-- Card: Pertanyaan Baru -->
        <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition relative overflow-hidden">
            @php
                $unansweredCount = App\Models\ChatLog::where('status', 'not_found')->count();
            @endphp
            <div class="absolute top-0 right-0 w-20 h-20 bg-yellow-50 rounded-bl-full"></div>
            <div class="flex justify-between items-start relative">
                <div>
                    <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Belum Terjawab</p>
                    <p class="text-3xl font-bold {{ $unansweredCount > 0 ? 'text-yellow-600' : 'text-gray-800' }} mt-2">
                        {{ $unansweredCount }}
                    </p>
                    <p class="text-xs text-gray-500 mt-2">
                        Pertanyaan dari user
                    </p>
                </div>
                <div class="bg-yellow-100 p-3 rounded-2xl">
                    <i class="fas fa-question text-yellow-600 text-2xl"></i>
                </div>
            </div>
            @if($unansweredCount > 0)
                <div class="mt-4 pt-4 border-t border-gray-100">
                    <a href="{{ route('admin.chat.unanswered') }}" class="text-sm text-amber-600 hover:text-amber-700 flex items-center font-medium">
                        <i class="fas fa-exclamation-circle mr-1"></i>
                        Segera tangani ({{ $unansweredCount }})
                        <i class="fas fa-arrow-right ml-1 text-xs"></i>
                    </a>
                </div>
            @endif
        </div>
    </div>
    
    <!-- === GRAFIK & ANALITIK === -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        <!-- Chart: Aktivitas Chat 7 Hari -->
        <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm p-6 border border-gray-100">
            <div class="flex justify-between items-center mb-6">
                <h3 class="font-bold text-gray-800 flex items-center">
                    <i class="fas fa-chart-line text-ropanasuri-600 mr-2"></i>
                    Aktivitas Chat (7 Hari Terakhir)
                </h3>
                <div class="flex space-x-2">
                    <span class="flex items-center text-xs text-gray-500">
                        <span class="w-3 h-3 bg-ropanasuri-500 rounded-full mr-1"></span>
                        Terjawab
                    </span>
                    <span class="flex items-center text-xs text-gray-500">
                        <span class="w-3 h-3 bg-yellow-400 rounded-full mr-1"></span>
                        Tidak ditemukan
                    </span>
                </div>
            </div>
            
            <!-- ApexCharts Container -->
            <div id="chatActivityChart" class="w-full h-72 mt-2"></div>
        </div>
        
        <!-- Top FAQ -->
        <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100">
            <h3 class="font-bold text-gray-800 flex items-center mb-4">
                <i class="fas fa-fire text-orange-500 mr-2"></i>
                FAQ Terpopuler
            </h3>
            
            <div class="space-y-4">
                @forelse($faqPopuler ?? [] as $faq)
                <div class="flex items-center justify-between group hover:bg-gray-50 p-2 rounded-lg transition">
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-gray-800 truncate">{{ $faq->question }}</p>
                        <div class="flex items-center mt-1">
                            <span class="text-xs bg-gray-100 text-gray-600 px-2 py-0.5 rounded-full">
                                {{ $faq->category ?? 'Umum' }}
                            </span>
                            <span class="text-xs text-gray-400 ml-2">
                                {{ $faq->hit_count }}x ditanyakan
                            </span>
                        </div>
                    </div>
                    <div class="ml-3 flex items-center gap-2 opacity-0 group-hover:opacity-100 transition">
                        <a href="{{ route('admin.faq.edit', $faq) }}" class="text-blue-600 hover:text-blue-800">
                            <i class="fas fa-edit"></i>
                        </a>
                    </div>
                </div>
                @empty
                <p class="text-gray-500 text-sm text-center py-4">Belum ada data FAQ</p>
                @endforelse
            </div>
            
            <div class="mt-5 pt-4 border-t border-gray-100">
                <a href="{{ route('admin.faq.index') }}" class="text-sm text-ropanasuri-600 hover:text-ropanasuri-700 flex items-center justify-between">
                    <span>Lihat semua FAQ</span>
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
    
    <!-- === GRID 2 KOLOM: ARTIKEL & PERTANYAAN BARU === -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        
        <!-- Artikel Terbaru -->
        <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100">
            <div class="flex justify-between items-center mb-4">
                <h3 class="font-bold text-gray-800 flex items-center">
                    <i class="fas fa-newspaper text-green-600 mr-2"></i>
                    Artikel Terbaru
                </h3>
                <a href="{{ route('admin.artikel.create') }}" class="text-sm bg-green-50 text-green-700 px-3 py-1.5 rounded-xl hover:bg-green-100 transition">
                    <i class="fas fa-plus-circle mr-1"></i>
                    Tulis
                </a>
            </div>
            
            <div class="space-y-4">
                @forelse($artikelTerbaru ?? [] as $artikel)
                <div class="flex items-start border-b border-gray-100 pb-4 last:border-0 last:pb-0">
                    <div class="flex-1">
                        <a href="{{ route('admin.artikel.edit', $artikel) }}" class="font-medium text-gray-800 hover:text-ropanasuri-700 transition">
                            {{ Str::limit($artikel->judul, 60) }}
                        </a>
                        <div class="flex items-center gap-3 mt-1 text-xs">
                            <span class="text-gray-500">
                                <i class="far fa-calendar-alt mr-1"></i>
                                {{ $artikel->published_at?->format('d M Y') ?? 'Draft' }}
                            </span>
                            <span class="text-gray-500">
                                <i class="far fa-eye mr-1"></i>
                                {{ $artikel->dilihat ?? 0 }}x
                            </span>
                            @if($artikel->is_published)
                                <span class="bg-green-100 text-green-700 px-2 py-0.5 rounded-full">Publik</span>
                            @else
                                <span class="bg-yellow-100 text-yellow-700 px-2 py-0.5 rounded-full">Draft</span>
                            @endif
                        </div>
                    </div>
                </div>
                @empty
                <p class="text-gray-500 text-sm text-center py-4">Belum ada artikel</p>
                @endforelse
            </div>
        </div>
        
        <!-- Pertanyaan yang Sering Muncul & Belum Terjawab -->
        <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100">
            <div class="flex justify-between items-center mb-4">
                <h3 class="font-bold text-gray-800 flex items-center">
                    <i class="fas fa-question-circle text-yellow-600 mr-2"></i>
                    Pertanyaan Populer (Belum Terjawab)
                </h3>
                <a href="{{ route('admin.chat.unanswered') }}" class="text-sm bg-ropanasuri-50 text-ropanasuri-700 px-3 py-1.5 rounded-xl hover:bg-ropanasuri-100 transition">
                    Lihat Semua
                </a>
            </div>
            
            <div class="space-y-3 max-h-[300px] overflow-y-auto pr-2">
                @forelse($pertanyaanTidakDitemukan ?? [] as $log)
                <div class="bg-gray-50 rounded-xl p-3 hover:bg-gray-100 transition">
                    <div class="flex justify-between items-start">
                        <div class="flex-1">
                            <p class="text-sm text-gray-800 mb-2">"{{ Str::limit($log->question, 60) }}"</p>
                            <div class="flex items-center justify-between">
                                <span class="text-xs text-gray-500">
                                    <i class="far fa-clock mr-1"></i>
                                    {{ $log->created_at->diffForHumans() }}
                                </span>
                                <a href="{{ route('admin.faq.create') }}?question={{ urlencode($log->question) }}" 
                                   class="text-xs bg-ropanasuri-600 text-white px-3 py-1.5 rounded-lg hover:bg-ropanasuri-700 transition flex items-center">
                                    <i class="fas fa-plus-circle mr-1"></i>
                                    Tambah FAQ
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <p class="text-gray-500 text-sm text-center py-4">Tidak ada pertanyaan yang belum terjawab 🎉</p>
                @endforelse
            </div>
        </div>
    </div>
    
    <!-- === AKTIVITAS CHAT TERBARU === -->
    <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100">
        <div class="flex justify-between items-center mb-4">
            <h3 class="font-bold text-gray-800 flex items-center">
                <i class="fas fa-history text-blue-600 mr-2"></i>
                Aktivitas Chat Terbaru
            </h3>
            <a href="{{ route('admin.chat.logs') }}" class="text-sm text-ropanasuri-600 hover:text-ropanasuri-700">
                Lihat semua <i class="fas fa-arrow-right ml-1"></i>
            </a>
        </div>
        
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Waktu</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Pertanyaan</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($chatTerbaru ?? [] as $chat)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3 text-sm text-gray-600 whitespace-nowrap">
                            {{ $chat->created_at->format('H:i') }}
                            <span class="text-xs text-gray-400 block">{{ $chat->created_at->format('d/m') }}</span>
                        </td>
                        <td class="px-4 py-3 text-sm text-gray-800 max-w-xs truncate">
                            {{ Str::limit($chat->question, 50) }}
                        </td>
                        <td class="px-4 py-3">
                            @if($chat->status == 'found')
                                <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-700">
                                    Terjawab
                                </span>
                            @elseif($chat->status == 'not_found')
                                <span class="px-2 py-1 text-xs rounded-full bg-yellow-100 text-yellow-700">
                                    Tidak ditemukan
                                </span>
                            @else
                                <span class="px-2 py-1 text-xs rounded-full bg-gray-100 text-gray-700">
                                    Kosong
                                </span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-sm">
                            <a href="{{ route('admin.chat.show', $chat) }}" class="text-blue-600 hover:text-blue-800 mr-3">
                                <i class="fas fa-eye"></i>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-4 py-8 text-center text-gray-500">
                            Belum ada aktivitas chat
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const weeklyStats = @json($weeklyStats ?? []);
        
        // Membalik urutan agar dari hari terlama ke terbaru (kiri ke kanan)
        const categories = weeklyStats.map(s => s.date).reverse();
        const dataFound = weeklyStats.map(s => s.found).reverse();
        const dataNotFound = weeklyStats.map(s => s.not_found).reverse();

        var options = {
            series: [{
                name: 'Terjawab',
                data: dataFound
            }, {
                name: 'Tidak ditemukan',
                data: dataNotFound
            }],
            chart: {
                type: 'bar',
                height: 280,
                stacked: true,
                toolbar: {
                    show: false
                },
                zoom: {
                    enabled: false
                }
            },
            colors: ['#10b981', '#fbbf24'], // Emerald-500 (Terjawab), Amber-400 (Tidak ditemukan)
            plotOptions: {
                bar: {
                    horizontal: false,
                    borderRadius: 4,
                    columnWidth: '40%',
                },
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                width: 0,
            },
            xaxis: {
                categories: categories,
                labels: {
                    style: {
                        colors: '#6b7280',
                        fontSize: '12px',
                        fontFamily: 'Inter, sans-serif'
                    }
                },
                axisBorder: {
                    show: false
                },
                axisTicks: {
                    show: false
                }
            },
            yaxis: {
                labels: {
                    formatter: function(val) {
                        return Math.floor(val);
                    },
                    style: {
                        colors: '#6b7280',
                        fontSize: '12px',
                        fontFamily: 'Inter, sans-serif'
                    }
                }
            },
            legend: {
                show: false // Kita sudah punya legend custom di atas chart
            },
            fill: {
                opacity: 1
            },
            grid: {
                borderColor: '#f3f4f6',
                strokeDashArray: 4,
                yaxis: {
                    lines: {
                        show: true
                    }
                }
            }
        };

        if (document.querySelector("#chatActivityChart")) {
            var chart = new ApexCharts(document.querySelector("#chatActivityChart"), options);
            chart.render();
        }
    });
</script>
@endpush