@extends('layouts.admin')

@section('title', 'Detail Chat - Halo-Ropanasuri')
@section('page-title', 'Detail Percakapan')
@section('page-badge', 'Log')

@section('header-actions')
    <a href="{{ route('admin.chat.logs') }}" class="px-4 py-2 bg-white border border-gray-300 text-gray-700 rounded-xl hover:bg-gray-50 transition flex items-center text-sm font-medium">
        <i class="fas fa-arrow-left mr-2"></i>
        Kembali ke Riwayat
    </a>
@endsection

@section('breadcrumbs')
    <i class="fas fa-home text-gray-400 mr-1"></i> Dashboard 
    <i class="fas fa-chevron-right text-gray-400 mx-2 text-xs"></i> 
    <a href="{{ route('admin.chat.logs') }}" class="hover:text-ropanasuri-600 transition">Riwayat Chat</a>
    <i class="fas fa-chevron-right text-gray-400 mx-2 text-xs"></i>
    Detail #{{ $log->id }}
@endsection

@section('content')
<div class="max-w-4xl space-y-6">
    
    <!-- Informasi Utama -->
    <div class="bg-white rounded-2xl shadow-sm p-6 md:p-8 border border-gray-100">
        
        <div class="flex items-center justify-between mb-8 pb-6 border-b border-gray-100">
            <div>
                <h3 class="text-lg font-bold text-gray-800">Informasi Sesi</h3>
                <p class="text-sm text-gray-500 mt-1">ID Sesi: <span class="font-mono bg-gray-50 px-2 py-0.5 rounded">{{ $log->session_id }}</span></p>
            </div>
            <div class="text-right">
                <p class="text-sm font-bold text-gray-800">{{ $log->created_at->format('d M Y') }}</p>
                <p class="text-xs text-gray-500">{{ $log->created_at->format('H:i:s') }} WIB</p>
            </div>
        </div>

        <!-- Detail Percakapan (Mirip UI Chat) -->
        <div class="space-y-8">
            
            <!-- Pertanyaan User -->
            <div>
                <h4 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-3">Pertanyaan Pengguna</h4>
                <div class="flex items-start">
                    <div class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center text-gray-500 flex-shrink-0 mr-4">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="bg-gray-50 rounded-2xl rounded-tl-none p-5 border border-gray-100 flex-1">
                        <p class="text-gray-800 leading-relaxed">"{{ $log->question }}"</p>
                    </div>
                </div>
            </div>

            <!-- Jawaban AI -->
            <div>
                <div class="flex items-center justify-between mb-3">
                    <h4 class="text-xs font-bold text-gray-400 uppercase tracking-wider">Respons AI</h4>
                    
                    @if($log->status == 'found')
                        <span class="px-2.5 py-1 text-xs rounded-full bg-green-100 text-green-800 font-medium border border-green-200">
                            <i class="fas fa-check-circle mr-1"></i> Ditemukan (FAQ)
                        </span>
                    @elseif($log->status == 'emergency')
                        <span class="px-2.5 py-1 text-xs rounded-full bg-red-100 text-red-800 font-medium border border-red-200 animate-pulse">
                            <i class="fas fa-siren-on mr-1"></i> Triage Darurat
                        </span>
                    @elseif($log->status == 'not_found')
                        <span class="px-2.5 py-1 text-xs rounded-full bg-yellow-100 text-yellow-800 font-medium border border-yellow-200">
                            <i class="fas fa-question-circle mr-1"></i> Tidak Ditemukan
                        </span>
                    @else
                        <span class="px-2.5 py-1 text-xs rounded-full bg-gray-100 text-gray-800 font-medium border border-gray-200">
                            <i class="fas fa-ban mr-1"></i> {{ ucfirst($log->status) }}
                        </span>
                    @endif
                </div>
                
                <div class="flex items-start">
                    <div class="w-10 h-10 bg-gradient-to-br from-ropanasuri-500 to-ropanasuri-600 rounded-full flex items-center justify-center text-white flex-shrink-0 mr-4 shadow-md">
                        <i class="fas fa-robot"></i>
                    </div>
                    <div class="bg-ropanasuri-50/50 rounded-2xl rounded-tl-none p-5 border border-ropanasuri-100 flex-1">
                        <p class="text-gray-800 leading-relaxed">{{ $log->answer }}</p>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Referensi FAQ (Jika Ada) -->
    @if($log->faq)
    <div class="bg-white rounded-2xl shadow-sm p-6 md:p-8 border border-gray-100">
        <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
            <i class="fas fa-database text-ropanasuri-500 mr-2"></i> Referensi Data (FAQ)
        </h3>
        <div class="bg-blue-50/50 rounded-xl p-5 border border-blue-100">
            <p class="text-sm font-semibold text-blue-900 mb-2">Diambil dari basis pengetahuan:</p>
            <p class="text-gray-800 text-sm mb-4"><strong>Q:</strong> {{ $log->faq->pertanyaan }}</p>
            <a href="{{ route('admin.faq.edit', $log->faq) }}" class="inline-flex items-center text-xs font-bold text-blue-700 hover:text-blue-800 bg-white px-3 py-1.5 rounded-lg border border-blue-200 shadow-sm transition">
                <i class="fas fa-edit mr-2"></i> Edit Data FAQ Ini
            </a>
        </div>
    </div>
    @endif

    <!-- Tindakan Lanjutan (Jika Tidak Ditemukan) -->
    @if($log->status == 'not_found')
    <div class="bg-gradient-to-br from-yellow-50 to-orange-50 rounded-2xl shadow-sm p-6 md:p-8 border border-yellow-200">
        <div class="flex items-start">
            <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center text-yellow-500 text-xl shadow-sm mr-4 flex-shrink-0">
                <i class="fas fa-lightbulb"></i>
            </div>
            <div>
                <h3 class="text-lg font-bold text-yellow-800 mb-2">AI Tidak Memiliki Jawaban</h3>
                <p class="text-yellow-700 text-sm mb-4 leading-relaxed">
                    Sistem tidak menemukan jawaban yang relevan untuk pertanyaan ini di database. Anda disarankan untuk menambahkan pertanyaan ini beserta jawabannya ke sistem FAQ agar AI bisa menjawabnya di kemudian hari.
                </p>
                <a href="{{ route('admin.faq.create') }}?question={{ urlencode($log->question) }}" class="inline-block bg-yellow-500 hover:bg-yellow-600 text-white font-bold px-5 py-2.5 rounded-xl transition shadow-md text-sm">
                    <i class="fas fa-plus-circle mr-2"></i> Tambahkan ke FAQ
                </a>
            </div>
        </div>
    </div>
    @endif

</div>
@endsection
