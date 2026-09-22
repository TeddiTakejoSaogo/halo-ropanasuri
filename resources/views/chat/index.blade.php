@extends('layouts.app')

@section('title', 'Halo-Ropanasuri - Pusat Informasi Kesehatan')

@section('content')
@php
    $hour = date('H');
    if ($hour < 11) {
        $greeting = 'Selamat Pagi';
        $greetIcon = 'fa-sun';
    } elseif ($hour < 15) {
        $greeting = 'Selamat Siang';
        $greetIcon = 'fa-sun';
    } elseif ($hour < 18) {
        $greeting = 'Selamat Sore';
        $greetIcon = 'fa-cloud-sun';
    } else {
        $greeting = 'Selamat Malam';
        $greetIcon = 'fa-moon';
    }
@endphp

<!-- Background Decoration -->
<div class="fixed inset-0 z-[-1] overflow-hidden pointer-events-none">
    <div class="absolute -top-[20%] -left-[10%] w-[50%] h-[50%] bg-ropanasuri-400/10 dark:bg-ropanasuri-600/10 rounded-full blur-[120px]"></div>
    <div class="absolute top-[10%] -right-[10%] w-[40%] h-[40%] bg-emerald-400/10 dark:bg-emerald-600/10 rounded-full blur-[100px]"></div>
</div>

<div class="flex flex-col min-h-screen">
    
    <!-- HERO SECTION & SMART SEARCH -->
    <div id="top-section-wrapper" class="relative w-full max-w-[95rem] mx-auto pt-12 md:pt-16 pb-10 px-4 xl:px-8 flex flex-col lg:flex-row items-center justify-center lg:items-start gap-0 lg:gap-8 transition-all duration-700 ease-in-out">
        
        <!-- LEFT WIDGETS (IDLE STATE) -->
        <div id="left-floating-widgets" class="hidden xl:flex w-[280px] flex-col gap-6 shrink-0 transition-all duration-700 opacity-100 translate-x-0 mt-8">
            <!-- Widget: Jam Besuk -->
            <div class="bg-white/60 dark:bg-gray-800/60 backdrop-blur-xl rounded-3xl p-5 border border-gray-100 dark:border-gray-700 shadow-[0_8px_30px_rgb(0,0,0,0.04)] hover:-translate-y-1 transition-transform">
                <div class="flex items-center space-x-3 mb-3">
                    <div class="w-10 h-10 rounded-xl bg-blue-50 dark:bg-blue-900/40 flex items-center justify-center text-blue-600 dark:text-blue-400">
                        <i class="fas fa-clock"></i>
                    </div>
                    <h4 class="font-bold text-gray-800 dark:text-gray-100">Jam Besuk</h4>
                </div>
                <p class="text-sm text-gray-500 dark:text-gray-400 font-medium">Pagi: 10:00 - 12:00 WIB<br>Sore: 17:00 - 19:00 WIB</p>
            </div>
            
            <!-- Widget: Call Center -->
            <div class="bg-gradient-to-br from-ropanasuri-500 to-emerald-500 rounded-3xl p-5 border border-ropanasuri-400 shadow-xl shadow-ropanasuri-500/20 hover:-translate-y-1 transition-transform text-white">
                <div class="flex items-center space-x-3 mb-3">
                    <div class="w-10 h-10 rounded-xl bg-white/20 flex items-center justify-center backdrop-blur-sm">
                        <i class="fas fa-phone-alt"></i>
                    </div>
                    <h4 class="font-bold">Call Center</h4>
                </div>
                <p class="text-sm text-white/90 font-medium mb-1">Layanan Informasi 24 Jam</p>
                <p class="text-xl font-black tracking-wider">(0751) 123456</p>
            </div>
        </div>

        <!-- HERO CONTENT -->
        <div id="hero-content" class="w-full max-w-4xl lg:max-w-5xl flex flex-col items-center text-center transition-all duration-700 ease-in-out relative z-20 xl:mx-4">
            <div id="hero-badge" class="inline-flex items-center space-x-2 bg-white/60 dark:bg-gray-800/60 backdrop-blur-md px-4 py-1.5 rounded-full border border-gray-200/50 dark:border-gray-700/50 shadow-sm mb-6 animate-fade-in-up">
                <span class="relative flex h-2 w-2">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                </span>
                <span class="text-xs font-bold text-gray-700 dark:text-gray-300">{{ __('messages.online_fast_response') }}</span>
            </div>

            <h1 id="hero-title" class="text-4xl md:text-5xl lg:text-6xl font-black text-transparent bg-clip-text bg-gradient-to-r from-gray-900 to-gray-600 dark:from-white dark:to-gray-300 tracking-tight mb-6 leading-tight animate-fade-in-up transition-all duration-700" style="animation-delay: 0.1s;">
                Apa yang ingin Anda ketahui <span class="bg-gradient-to-r from-ropanasuri-500 to-emerald-500 text-transparent bg-clip-text">hari ini?</span>
            </h1>
            
            <p id="hero-desc" class="text-gray-500 dark:text-gray-400 text-base md:text-lg mb-10 max-w-2xl font-medium animate-fade-in-up transition-all duration-700" style="animation-delay: 0.2s;">
                Cari informasi jadwal dokter, layanan spesialis, panduan BPJS, ketersediaan kamar, atau tanyakan langsung pada asisten AI kami.
            </p>

            <!-- Search Box / Chat Form (Hero) -->
            <div id="hero-search-container" class="w-full max-w-3xl relative z-20 animate-fade-in-up transition-all duration-700" style="animation-delay: 0.3s;">
                <form id="hero-chat-form" class="relative group">
                    <div class="absolute inset-y-0 left-0 pl-6 flex items-center pointer-events-none">
                        <i class="fas fa-sparkles text-ropanasuri-500 text-xl group-focus-within:animate-pulse transition-transform"></i>
                    </div>
                    <input type="text" id="hero-question-input" autocomplete="off" 
                        class="block w-full pl-16 pr-[100px] py-5 md:py-6 bg-white dark:bg-gray-800 border-2 border-white/50 dark:border-gray-700 shadow-xl shadow-gray-200/50 dark:shadow-gray-900/50 focus:border-ropanasuri-400 dark:focus:border-ropanasuri-500 rounded-full focus:ring-4 focus:ring-ropanasuri-50 dark:focus:ring-ropanasuri-900/30 transition-all duration-300 text-lg md:text-xl text-gray-800 dark:text-gray-100 placeholder-gray-400 font-medium" 
                        placeholder="{{ __('messages.type_question_here') }}">
                    <div class="absolute inset-y-0 right-3 flex items-center space-x-2">
                        <button type="button" class="mic-btn p-3 text-gray-400 hover:text-ropanasuri-500 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-full transition-all" title="{{ __('messages.use_voice') }}">
                            <i class="fas fa-microphone text-xl"></i>
                        </button>
                        <button type="submit" class="w-12 h-12 md:w-14 md:h-14 bg-gradient-to-br from-ropanasuri-500 to-emerald-500 dark:from-ropanasuri-600 dark:to-emerald-600 text-white rounded-full shadow-lg hover:shadow-xl hover:shadow-ropanasuri-500/30 hover:-translate-y-0.5 transition-all duration-300 flex items-center justify-center">
                            <i class="fas fa-paper-plane text-lg md:text-xl ml-[-2px]"></i>
                        </button>
                    </div>
                </form>
                <div id="form-disclaimer" class="mt-4 flex items-center justify-center space-x-2 text-[11px] md:text-xs text-gray-400 dark:text-gray-500 font-medium transition-all duration-700">
                    <i class="fas fa-lock"></i>
                    <span>Percakapan aman & terenkripsi. Hindari membagikan data medis sensitif.</span>
                </div>
            </div>
            <!-- QUICK CATEGORIES (Moved Inside Hero Content) -->
            <div id="quick-categories" class="w-full mt-16 mb-4 px-2 relative z-10 transition-all duration-500 delay-150 animate-fade-in-up">
                <h3 class="text-center lg:text-left text-sm font-bold text-gray-400 dark:text-gray-500 uppercase tracking-widest mb-6 transition-all" id="quick-cat-title">Pencarian Cepat</h3>
                <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6" id="quick-categories-grid">
                    <!-- Card 1 -->
                    <button class="quick-question group flex flex-col items-center justify-center p-5 bg-white dark:bg-gray-800 rounded-3xl shadow-sm hover:shadow-xl hover:shadow-indigo-500/10 border border-gray-100 dark:border-gray-700 hover:-translate-y-1 transition-all duration-300">
                        <div class="w-12 h-12 bg-indigo-50 dark:bg-indigo-900/30 text-indigo-500 dark:text-indigo-400 rounded-2xl flex items-center justify-center mb-3 group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-user-md text-xl"></i>
                        </div>
                        <span class="font-bold text-gray-800 dark:text-gray-100 text-xs md:text-sm tracking-tight text-center">Jadwal Dokter</span>
                    </button>
                    <!-- Card 2 -->
                    <button class="quick-question group flex flex-col items-center justify-center p-5 bg-white dark:bg-gray-800 rounded-3xl shadow-sm hover:shadow-xl hover:shadow-emerald-500/10 border border-gray-100 dark:border-gray-700 hover:-translate-y-1 transition-all duration-300">
                        <div class="w-12 h-12 bg-emerald-50 dark:bg-emerald-900/30 text-emerald-500 dark:text-emerald-400 rounded-2xl flex items-center justify-center mb-3 group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-bed text-xl"></i>
                        </div>
                        <span class="font-bold text-gray-800 dark:text-gray-100 text-xs md:text-sm tracking-tight text-center">Info Kamar</span>
                    </button>
                    <!-- Card 3 -->
                    <button class="quick-question group flex flex-col items-center justify-center p-5 bg-white dark:bg-gray-800 rounded-3xl shadow-sm hover:shadow-xl hover:shadow-blue-500/10 border border-gray-100 dark:border-gray-700 hover:-translate-y-1 transition-all duration-300">
                        <div class="w-12 h-12 bg-blue-50 dark:bg-blue-900/30 text-blue-500 dark:text-blue-400 rounded-2xl flex items-center justify-center mb-3 group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-id-card text-xl"></i>
                        </div>
                        <span class="font-bold text-gray-800 dark:text-gray-100 text-xs md:text-sm tracking-tight text-center">Info BPJS</span>
                    </button>
                    <!-- Card 4 (Emergency) -->
                    <button class="quick-question group flex flex-col items-center justify-center p-5 bg-gradient-to-br from-red-50 to-rose-50 dark:from-red-900/20 dark:to-rose-900/20 rounded-3xl shadow-sm hover:shadow-xl hover:shadow-red-500/10 border border-red-100 dark:border-red-800/50 hover:-translate-y-1 transition-all duration-300 relative overflow-hidden">
                        <div class="absolute -right-4 -top-4 w-16 h-16 bg-red-400/10 dark:bg-red-500/10 rounded-full blur-xl group-hover:scale-150 transition-transform duration-500"></div>
                        <div class="w-12 h-12 bg-red-100 dark:bg-red-900/50 text-red-600 dark:text-red-400 rounded-2xl flex items-center justify-center mb-3 group-hover:scale-110 transition-transform duration-300 relative z-10 shadow-inner">
                            <i class="fas fa-truck-medical text-xl animate-pulse"></i>
                        </div>
                        <span class="font-bold text-red-700 dark:text-red-400 text-xs md:text-sm tracking-tight text-center relative z-10">Darurat</span>
                    </button>
                </div>
            </div>
        </div>

        <!-- Dynamic Chat Results Area -->
        <div id="chat-results-container" class="w-full relative z-30 transition-all duration-700 ease-in-out">
            <div class="bg-white/95 dark:bg-gray-800/95 backdrop-blur-xl rounded-[2rem] shadow-2xl shadow-gray-300/50 dark:shadow-black/50 border border-gray-100 dark:border-gray-700 overflow-hidden flex flex-col h-[500px]">
                
                <!-- Chat Header -->
                <div class="px-6 py-4 bg-gray-50/80 dark:bg-gray-900/80 border-b border-gray-100 dark:border-gray-700 flex justify-between items-center z-10 relative">
                    <div class="flex items-center">
                        <div class="relative mr-3">
                            <div class="w-10 h-10 bg-white dark:bg-gray-700 rounded-xl flex items-center justify-center shadow-sm border border-gray-200 dark:border-gray-600 p-1">
                                <img src="{{ asset('images/airopanasuri.png') }}" alt="AI" class="w-full h-full object-contain filter drop-shadow-sm">
                            </div>
                            <div class="absolute -bottom-1 -right-1 w-3 h-3 bg-emerald-500 border-2 border-white dark:border-gray-800 rounded-full"></div>
                        </div>
                        <div>
                            <h3 class="font-extrabold text-gray-800 dark:text-gray-100 tracking-tight text-sm md:text-base">Halo-Ropanasuri AI</h3>
                            <p class="text-[10px] text-gray-500 dark:text-gray-400 font-medium">Asisten Virtual Interaktif</p>
                        </div>
                    </div>
                    <button type="button" id="close-chat" class="w-8 h-8 flex items-center justify-center rounded-full bg-gray-100 dark:bg-gray-700 text-gray-500 hover:text-gray-800 dark:hover:text-gray-200 hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors">
                        <i class="fas fa-times text-sm"></i>
                    </button>
                </div>
                
                <!-- Chat Messages -->
                <div id="chat-messages" class="flex-1 overflow-y-auto p-4 md:p-6 space-y-4 custom-scrollbar bg-transparent relative z-0 scroll-smooth">
                    <!-- Welcome Message -->
                    <div class="flex items-start animate-fade-in-up mb-4">
                        <div class="w-9 h-9 bg-gradient-to-br from-ropanasuri-500 to-ropanasuri-600 rounded-2xl flex items-center justify-center text-white font-bold text-[10px] mr-3 flex-shrink-0 shadow-md">AI</div>
                        <div class="bg-white dark:bg-gray-700 rounded-2xl rounded-tl-sm p-4 md:p-5 shadow-sm border border-gray-100 dark:border-gray-600 max-w-[85%]">
                            <p class="text-gray-700 dark:text-gray-200 leading-relaxed text-[14px]">
                                👋 {{ $greeting }}! {!! __('messages.ai_welcome') !!}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Inner Chat Form (Active State) -->
                <div class="p-4 bg-gray-50 dark:bg-gray-900/80 border-t border-gray-100 dark:border-gray-700">
                    <form id="inner-chat-form" class="relative group">
                        <input type="text" id="inner-question-input" autocomplete="off" 
                            class="block w-full pl-4 pr-16 py-3 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-600 shadow-sm focus:border-ropanasuri-400 dark:focus:border-ropanasuri-500 rounded-xl focus:ring-2 focus:ring-ropanasuri-50 dark:focus:ring-ropanasuri-900/30 transition-all duration-300 text-sm text-gray-800 dark:text-gray-100 placeholder-gray-400 font-medium" 
                            placeholder="{{ __('messages.type_question_here') }}">
                        <div class="absolute inset-y-0 right-2 flex items-center space-x-1">
                            <button type="button" class="mic-btn p-2 text-gray-400 hover:text-ropanasuri-500 rounded-lg transition-all">
                                <i class="fas fa-microphone"></i>
                            </button>
                            <button type="submit" class="w-8 h-8 bg-ropanasuri-500 hover:bg-ropanasuri-600 text-white rounded-lg shadow-sm transition-all flex items-center justify-center">
                                <i class="fas fa-paper-plane text-xs"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- RIGHT WIDGETS (IDLE STATE) -->
        <div id="right-floating-widgets" class="hidden xl:flex w-[280px] flex-col gap-6 shrink-0 transition-all duration-700 opacity-100 translate-x-0 mt-8">
            <!-- Widget: Layanan Cepat -->
            <div class="bg-white/60 dark:bg-gray-800/60 backdrop-blur-xl rounded-3xl p-5 border border-gray-100 dark:border-gray-700 shadow-[0_8px_30px_rgb(0,0,0,0.04)] hover:-translate-y-1 transition-transform">
                <div class="flex items-center space-x-3 mb-4">
                    <div class="w-10 h-10 rounded-xl bg-purple-50 dark:bg-purple-900/40 flex items-center justify-center text-purple-600 dark:text-purple-400">
                        <i class="fas fa-stethoscope"></i>
                    </div>
                    <h4 class="font-bold text-gray-800 dark:text-gray-100">Poliklinik</h4>
                </div>
                <div class="space-y-3">
                    <button onclick="quickAsk('Jadwal Poli Penyakit Dalam')" class="w-full text-left text-sm text-gray-600 dark:text-gray-300 hover:text-ropanasuri-600 dark:hover:text-ropanasuri-400 font-medium flex justify-between items-center group">
                        <span>Penyakit Dalam</span>
                        <i class="fas fa-chevron-right text-[10px] opacity-0 group-hover:opacity-100 transition-opacity"></i>
                    </button>
                    <button onclick="quickAsk('Jadwal Poli Onkologi')" class="w-full text-left text-sm text-gray-600 dark:text-gray-300 hover:text-ropanasuri-600 dark:hover:text-ropanasuri-400 font-medium flex justify-between items-center group">
                        <span>Spesialis Onkologi</span>
                        <i class="fas fa-chevron-right text-[10px] opacity-0 group-hover:opacity-100 transition-opacity"></i>
                    </button>
                    <button onclick="quickAsk('Jadwal Poli Urologi')" class="w-full text-left text-sm text-gray-600 dark:text-gray-300 hover:text-ropanasuri-600 dark:hover:text-ropanasuri-400 font-medium flex justify-between items-center group">
                        <span>Spesialis Urologi</span>
                        <i class="fas fa-chevron-right text-[10px] opacity-0 group-hover:opacity-100 transition-opacity"></i>
                    </button>
                    <button onclick="quickAsk('Jadwal Poli THT')" class="w-full text-left text-sm text-gray-600 dark:text-gray-300 hover:text-ropanasuri-600 dark:hover:text-ropanasuri-400 font-medium flex justify-between items-center group">
                        <span>Spesialis THT</span>
                        <i class="fas fa-chevron-right text-[10px] opacity-0 group-hover:opacity-100 transition-opacity"></i>
                    </button>
                </div>
            </div>
            
            <!-- Widget: Greeting -->
            <div class="bg-white/60 dark:bg-gray-800/60 backdrop-blur-xl rounded-3xl p-5 border border-gray-100 dark:border-gray-700 shadow-[0_8px_30px_rgb(0,0,0,0.04)] relative overflow-hidden group hover:-translate-y-1 transition-transform">
                <div class="absolute -right-6 -top-6 w-24 h-24 bg-amber-400/20 dark:bg-amber-500/10 rounded-full blur-2xl group-hover:scale-150 transition-transform duration-500"></div>
                <div class="flex items-center space-x-3 mb-2 relative z-10">
                    <div class="w-8 h-8 rounded-full bg-amber-100 dark:bg-amber-900/40 flex items-center justify-center text-amber-600 dark:text-amber-400">
                        <i class="fas {{ $greetIcon }}"></i>
                    </div>
                    <h4 class="font-bold text-gray-800 dark:text-gray-100 text-sm">{{ $greeting }}!</h4>
                </div>
                <p class="text-[13px] text-gray-500 dark:text-gray-400 font-medium relative z-10 leading-relaxed">Semoga Anda selalu dalam keadaan sehat. Asisten virtual RSKB Ropanasuri siap melayani pertanyaan medis Anda.</p>
            </div>
        </div>
    </div>

    <!-- (Quick Categories dipindahkan ke dalam Hero Content) -->

    <!-- ARTIKEL MEDIS & BERITA -->
    <div id="artikel-section" class="max-w-[85rem] mx-auto w-full mt-32 md:mt-48 mb-16 px-4 xl:px-8 animate-fade-in-up transition-all duration-500 delay-300 flex-1">
        <div class="flex items-center justify-between mb-8">
            <div>
                <h2 class="text-2xl md:text-3xl font-extrabold text-gray-900 dark:text-white flex items-center tracking-tight">
                    <span class="w-10 h-10 rounded-xl bg-ropanasuri-50 dark:bg-ropanasuri-900/30 text-ropanasuri-500 dark:text-ropanasuri-400 flex items-center justify-center mr-3 border border-ropanasuri-100 dark:border-ropanasuri-800/50">
                        <i class="fas fa-book-medical text-lg"></i>
                    </span>
                    Edukasi & Artikel Medis
                </h2>
                <p class="text-gray-500 dark:text-gray-400 mt-2 font-medium text-sm md:text-base ml-14">Informasi kesehatan terpercaya yang disusun oleh tim medis profesional kami.</p>
            </div>
        </div>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
            @forelse($artikels ?? [] as $index => $artikel)
            @php
                $colors = ['text-blue-500 bg-blue-50 dark:bg-blue-900/30', 'text-emerald-500 bg-emerald-50 dark:bg-emerald-900/30', 'text-purple-500 bg-purple-50 dark:bg-purple-900/30', 'text-rose-500 bg-rose-50 dark:bg-rose-900/30', 'text-amber-500 bg-amber-50 dark:bg-amber-900/30'];
                $icons = ['fa-heart-pulse', 'fa-brain', 'fa-lungs', 'fa-bone', 'fa-capsules'];
                $color = $colors[$index % count($colors)];
                $icon = $icons[$index % count($icons)];
            @endphp
            <a href="{{ route('artikel.show', $artikel->slug) }}" class="group block h-full outline-none">
                <div class="bg-white dark:bg-gray-800 rounded-[2rem] overflow-hidden shadow-sm hover:shadow-xl border border-gray-100 dark:border-gray-700 transition-all duration-500 h-full flex flex-col hover:-translate-y-2 relative focus:ring-4 focus:ring-ropanasuri-500/20">
                    <div class="h-48 md:h-52 overflow-hidden relative">
                        @if($artikel->gambar)
                            <img src="{{ asset('storage/'.$artikel->gambar) }}" alt="{{ $artikel->judul }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                        @else
                            <div class="w-full h-full flex items-center justify-center {{ $color }} transition-colors duration-500">
                                <i class="fas {{ $icon }} text-5xl opacity-40 group-hover:scale-110 transition-transform duration-500 group-hover:opacity-60"></i>
                            </div>
                        @endif
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <div class="absolute top-4 right-4 bg-white/90 dark:bg-gray-800/90 backdrop-blur-md px-3 py-1.5 rounded-xl text-[10px] font-bold text-ropanasuri-600 dark:text-ropanasuri-400 uppercase tracking-widest shadow-sm">
                            Artikel Baru
                        </div>
                    </div>
                    <div class="p-6 md:p-7 flex flex-col flex-1 relative bg-white dark:bg-gray-800">
                        <h3 class="text-lg md:text-xl font-extrabold text-gray-800 dark:text-gray-100 leading-snug mb-3 group-hover:text-ropanasuri-600 dark:group-hover:text-ropanasuri-400 transition-colors line-clamp-2 tracking-tight">
                            {{ $artikel->judul }}
                        </h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400 line-clamp-2 mb-4 font-medium leading-relaxed">
                            {{ strip_tags($artikel->konten) }}
                        </p>
                        <div class="flex items-center justify-between text-xs text-gray-400 dark:text-gray-500 font-bold mt-auto pt-5 border-t border-gray-100 dark:border-gray-700/50">
                            <span class="flex items-center"><i class="far fa-calendar-alt mr-2 opacity-70"></i> {{ $artikel->created_at->translatedFormat('d M Y') }}</span>
                            <span class="flex items-center bg-gray-50 dark:bg-gray-700/50 px-2 py-1 rounded-lg"><i class="far fa-eye mr-1.5 opacity-70"></i> {{ $artikel->view_count ?? rand(100, 500) }}</span>
                        </div>
                    </div>
                </div>
            </a>
            @empty
            <div class="col-span-full bg-white/50 dark:bg-gray-800/50 backdrop-blur-sm rounded-[2rem] p-12 text-center border-2 border-dashed border-gray-200 dark:border-gray-700">
                <div class="w-16 h-16 bg-gray-100 dark:bg-gray-700 rounded-2xl flex items-center justify-center text-2xl mx-auto shadow-inner mb-4 text-gray-300 dark:text-gray-500">
                    <i class="fas fa-folder-open"></i>
                </div>
                <h4 class="text-lg font-bold text-gray-700 dark:text-gray-300 mb-2">Belum ada artikel</h4>
                <p class="text-sm text-gray-500 dark:text-gray-400 font-medium">Edukasi medis akan segera hadir di sini.</p>
            </div>
            @endforelse
        </div>
    </div>

    <!-- FOOTER -->
    <footer class="w-full text-center py-8 mt-10 border-t border-gray-200/40 dark:border-gray-700/40">
        <p class="text-sm text-gray-500 dark:text-gray-400 font-medium tracking-wide">
            &copy; {{ date('Y') }} Rumah Sakit Khusus Bedah Ropanasuri. Hak Cipta Dilindungi.<br>
            <span class="text-[11px] mt-2 inline-block opacity-60">Dikembangkan oleh Departemen IT RSKB Ropanasuri (Teddi Takejo Saogok)</span>
        </p>
    </footer>
</div>

@push('styles')
<style>
    .custom-scrollbar::-webkit-scrollbar {
        width: 6px;
    }
    .custom-scrollbar::-webkit-scrollbar-track {
        background: transparent;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb {
        background-color: rgba(156, 163, 175, 0.5);
        border-radius: 10px;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb:hover {
        background-color: rgba(156, 163, 175, 0.8);
    }
    .animate-fade-in-up {
        animation: fadeInUp 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        opacity: 0;
        transform: translateY(20px);
    }
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    /* CSS Transition Layout for Chat */
    #chat-results-container {
        width: 0;
        opacity: 0;
        visibility: hidden;
        height: 0;
        transform: translateX(2rem);
    }
    
    @media (min-width: 1024px) {
        .chat-active #top-section-wrapper {
            max-width: 85rem;
        }
        .chat-active #left-floating-widgets, .chat-active #right-floating-widgets {
            opacity: 0;
            width: 0;
            margin: 0;
            overflow: hidden;
            pointer-events: none;
            transform: scale(0.9);
        }
        .chat-active #hero-content {
            width: 35%;
            align-items: flex-start;
            text-align: left;
        }
        .chat-active #hero-title {
            font-size: 2.5rem;
            line-height: 1.2;
        }
        .chat-active #hero-desc {
            font-size: 0.875rem;
        }
        .chat-active #quick-cat-title {
            text-align: left;
        }
        .chat-active #quick-categories-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
        .chat-active #chat-results-container {
            width: 65%;
            max-width: 1000px;
            opacity: 1;
            visibility: visible;
            height: auto;
            transform: translateX(0);
        }
        .chat-active #hero-search-container {
            opacity: 0;
            visibility: hidden;
            height: 0;
            overflow: hidden;
            transform: scale(0.95);
            margin-top: 0;
            padding: 0;
        }
    }

    @media (max-width: 1023px) {
        .chat-active #chat-results-container {
            width: 100%;
            opacity: 1;
            visibility: visible;
            height: auto;
            transform: translateY(0);
            margin-top: 1rem;
        }
        .chat-active #hero-search-container {
            display: none;
        }
        #chat-results-container {
            transform: translateY(1rem);
        }
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const topSection = document.getElementById('top-section-wrapper');
        const closeChatBtn = document.getElementById('close-chat');
        const heroForm = document.getElementById('hero-chat-form');
        const innerForm = document.getElementById('inner-chat-form');
        const heroInput = document.getElementById('hero-question-input');
        const innerInput = document.getElementById('inner-question-input');
        
        let isChatOpen = false;

        function openChatArea() {
            if (!isChatOpen) {
                topSection.classList.add('chat-active');
                
                // Focus the inner input immediately after transition starts
                setTimeout(() => {
                    innerInput.focus();
                }, 100);
                
                // Pada mobile, scroll otomatis ke chat box
                if (window.innerWidth < 1024) {
                    setTimeout(() => {
                        document.getElementById('chat-results-container').scrollIntoView({ behavior: 'smooth', block: 'start' });
                    }, 100);
                }
                
                isChatOpen = true;
            }
        }

        function closeChatArea() {
            if (isChatOpen) {
                topSection.classList.remove('chat-active');
                isChatOpen = false;
            }
        }

        closeChatBtn.addEventListener('click', closeChatArea);

        // ============== QUICK QUESTION BUTTONS ==============
        document.querySelectorAll('.quick-question').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const questionText = this.querySelector('span').textContent.trim();
                
                if (questionText === 'Layanan Darurat') {
                    openChatArea();
                    renderEmergencyResponse("Segera hubungi IGD RSKB Ropanasuri untuk penanganan darurat.");
                    return;
                }

                submitQuestion(questionText);
            });
        });

        // ============== CHAT FORM SUBMISSION ==============
        heroForm.addEventListener('submit', function(e) {
            e.preventDefault();
            submitQuestion(heroInput.value);
            heroInput.value = '';
        });

        innerForm.addEventListener('submit', function(e) {
            e.preventDefault();
            submitQuestion(innerInput.value);
            innerInput.value = '';
        });

        function submitQuestion(questionText) {
            const question = questionText.trim();
            if (!question) return;

            // Pastikan semua kolom input dibersihkan otomatis
            heroInput.value = '';
            innerInput.value = '';

            // Open chat area if not open
            openChatArea();
            
            // Ubah state input menjadi memproses
            window.isFetching = true;
            heroInput.placeholder = "Sedang menjawab pertanyaan Anda...";
            innerInput.placeholder = "Sedang menjawab pertanyaan Anda...";
            heroInput.disabled = true;
            innerInput.disabled = true;
            
            // Append user message
            appendMessage('user', question);
            scrollToBottom();
            
            const loadingId = showLoading();
            scrollToBottom();
            
            fetch('{{ route("chat.ask") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ question: question })
            })
            .then(response => {
                if (!response.ok) throw new Error('Network response was not ok');
                return response.json();
            })
            .then(data => {
                removeLoading(loadingId);
                
                if (data.status === 'emergency') {
                    renderEmergencyResponse(data.answer);
                    resetInputState(); // Langsung reset karena darurat tidak diketik
                } else {
                    // resetInputState() dipanggil nanti setelah efek ketik selesai di appendMessage
                    appendMessage('bot', data.answer, true, data.follow_ups || []);
                }
                
                scrollToBottom();
            })
            .catch(error => {
                console.error('Error:', error);
                removeLoading(loadingId);
                resetInputState();
                appendMessage('bot', 'Maaf, terjadi gangguan saat menyambungkan ke server. Silakan coba lagi.', true);
                scrollToBottom();
            });
        }

        function resetInputState() {
            window.isFetching = false;
            heroInput.placeholder = "{{ __('messages.type_question_here') }}";
            innerInput.placeholder = "{{ __('messages.type_question_here') }}";
            heroInput.disabled = false;
            innerInput.disabled = false;
            // Kembalikan fokus ke input aktif jika chat terbuka
            if (isChatOpen) {
                innerInput.focus();
            } else {
                heroInput.focus();
            }
        }

        // ============== FUNGSI-FUNGSI CHAT ==============
        function appendMessage(sender, message, isTyping = false, followUps = []) {
            const messagesDiv = document.getElementById('chat-messages');
            const time = new Date().toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit', hour12: false });
            const msgId = 'msg-' + Date.now() + Math.floor(Math.random() * 1000);
            
            let speakerBtnHtml = '';
            if (sender === 'bot') {
                const escapedMsgForSpeech = escapeHtml(message).replace(/'/g, "\\'").replace(/"/g, '\\"');
                speakerBtnHtml = `
                    <button type="button" onclick="speakText('${escapedMsgForSpeech}')" class="mt-3 text-[10px] font-bold uppercase tracking-wide text-gray-500 hover:text-ropanasuri-600 flex items-center transition-colors w-max active:scale-95">
                        <i class="fas fa-volume-up mr-1.5"></i> Bacakan
                    </button>
                `;
            }

            let followUpsHtml = '';
            if (followUps && followUps.length > 0) {
                let pills = followUps.map(f => {
                    const escapedFaq = escapeHtml(f).replace(/'/g, "\\'").replace(/"/g, '\\"');
                    return `<button type="button" onclick="quickAsk('${escapedFaq}')" class="flex items-center text-left bg-gray-50 dark:bg-gray-600 border border-gray-200 dark:border-gray-500 text-gray-700 dark:text-gray-200 hover:bg-ropanasuri-50 dark:hover:bg-ropanasuri-900/50 hover:border-ropanasuri-200 dark:hover:border-ropanasuri-700 px-3 py-2 rounded-xl text-[12px] transition-all shadow-sm w-full font-medium hover:-translate-y-0.5"><i class="fas fa-sparkles text-amber-500 mr-2 text-[10px]"></i>${escapeHtml(f)}</button>`;
                }).join('');
                followUpsHtml = `
                    <div class="mt-4 pt-4 border-t border-gray-100/80 dark:border-gray-600/80 w-full animate-fade-in-up" style="animation-delay: 0.2s;">
                        <p class="text-[10px] font-bold text-gray-400 dark:text-gray-400 mb-2 uppercase tracking-widest">Saran Pertanyaan:</p>
                        <div class="space-y-2">
                            ${pills}
                        </div>
                    </div>
                `;
            }
            
            const formattedMessage = formatMessageText(message);
            
            const messageHtml = `
                <div class="flex items-start group animate-fade-in-up ${sender === 'user' ? 'justify-end' : 'w-full'} mb-4">
                    ${sender === 'bot' ? 
                        '<div class="w-9 h-9 bg-gradient-to-br from-ropanasuri-500 to-ropanasuri-600 rounded-2xl flex items-center justify-center text-white font-bold text-[10px] mr-3 flex-shrink-0 shadow-md mt-1">AI</div>' 
                        : ''}
                    <div class="${sender === 'user' ? 
                        'bg-gray-900 dark:bg-gray-700 text-white rounded-2xl rounded-tr-sm shadow-md max-w-[85%]' 
                        : 'bg-white dark:bg-gray-700 rounded-2xl rounded-tl-sm w-full md:max-w-[85%]'} 
                        p-4 md:p-5 shadow-sm border ${sender === 'user' ? 'border-gray-800 dark:border-gray-600' : 'border-gray-100 dark:border-gray-600'} transition-shadow hover:shadow-md">
                        
                        <p id="${msgId}" class="${sender === 'user' ? 'text-white' : 'text-gray-700 dark:text-gray-200'} leading-relaxed whitespace-pre-wrap text-[14px] md:text-[15px] font-medium">${isTyping ? '' : formattedMessage}</p>
                        
                        ${sender === 'bot' && !isTyping ? speakerBtnHtml : ''}
                        ${sender === 'bot' && !isTyping ? followUpsHtml : ''}
                    </div>
                    ${sender === 'user' ? 
                        '<div class="w-9 h-9 bg-gray-100 dark:bg-gray-600 rounded-2xl flex items-center justify-center text-gray-400 dark:text-gray-300 font-bold text-[12px] ml-3 flex-shrink-0 shadow-sm border border-gray-200 dark:border-gray-500 mt-1"><i class="fas fa-user"></i></div>' 
                        : ''}
                </div>
            `;
            
            messagesDiv.insertAdjacentHTML('beforeend', messageHtml);
            
            if (isTyping) {
                const p = document.getElementById(msgId);
                let i = 0;
                let currentHTML = '';
                const speed = 10;
                function typeWriter() {
                    if (i < formattedMessage.length) {
                        if (formattedMessage.charAt(i) === '<') {
                            let tagEnd = formattedMessage.indexOf('>', i);
                            if (tagEnd !== -1) {
                                currentHTML += formattedMessage.substring(i, tagEnd + 1);
                                i = tagEnd + 1;
                            } else {
                                currentHTML += formattedMessage.charAt(i);
                                i++;
                            }
                        } else if (formattedMessage.charAt(i) === '&') {
                            let entityEnd = formattedMessage.indexOf(';', i);
                            if (entityEnd !== -1 && entityEnd - i < 10) {
                                currentHTML += formattedMessage.substring(i, entityEnd + 1);
                                i = entityEnd + 1;
                            } else {
                                currentHTML += formattedMessage.charAt(i);
                                i++;
                            }
                        } else {
                            currentHTML += formattedMessage.charAt(i);
                            i++;
                        }
                        p.innerHTML = currentHTML;
                        scrollToBottom();
                        setTimeout(typeWriter, speed);
                    } else {
                        if (sender === 'bot') {
                            const container = p.parentElement;
                            if (speakerBtnHtml) p.insertAdjacentHTML('afterend', speakerBtnHtml);
                            if (followUpsHtml) {
                                const insertPoint = container.querySelector('button') || p;
                                insertPoint.insertAdjacentHTML('afterend', followUpsHtml);
                            }
                            scrollToBottom();
                            // Reset state input setelah efek ketikan bot selesai
                            if (typeof resetInputState === 'function') resetInputState();
                        }
                    }
                }
                typeWriter();
            }
        }
        
        function showLoading() {
            const id = 'loading-' + Date.now();
            const messagesDiv = document.getElementById('chat-messages');
            
            const loadingHtml = `
                <div id="${id}" class="flex items-start animate-fade-in-up mb-4 mt-1">
                    <div class="w-9 h-9 bg-gradient-to-br from-ropanasuri-500 to-ropanasuri-600 rounded-2xl flex items-center justify-center text-white font-bold text-[10px] mr-3 flex-shrink-0 shadow-md mt-1">AI</div>
                    <div class="bg-white dark:bg-gray-700 rounded-2xl rounded-tl-sm p-4 md:p-5 shadow-sm border border-gray-100 dark:border-gray-600">
                        <div class="flex space-x-1.5 items-center h-4">
                            <div class="w-2.5 h-2.5 bg-ropanasuri-400 rounded-full animate-bounce"></div>
                            <div class="w-2.5 h-2.5 bg-ropanasuri-500 rounded-full animate-bounce" style="animation-delay: 0.15s"></div>
                            <div class="w-2.5 h-2.5 bg-ropanasuri-600 rounded-full animate-bounce" style="animation-delay: 0.3s"></div>
                        </div>
                    </div>
                </div>
            `;
            
            messagesDiv.insertAdjacentHTML('beforeend', loadingHtml);
            return id;
        }
        
        function removeLoading(id) {
            const el = document.getElementById(id);
            if (el) el.remove();
        }
        
        function scrollToBottom() {
            const messagesDiv = document.getElementById('chat-messages');
            if (messagesDiv) {
                messagesDiv.scrollTop = messagesDiv.scrollHeight;
            }
        }
        
        function escapeHtml(unsafe) {
            if (!unsafe) return '';
            return unsafe
                .replace(/&/g, "&amp;")
                .replace(/</g, "&lt;")
                .replace(/>/g, "&gt;")
                .replace(/"/g, "&quot;")
                .replace(/'/g, "&#039;");
        }
        
        function formatMessageText(text) {
            if (!text) return '';
            let escaped = escapeHtml(text);
            escaped = escaped.replace(/\[([^\]]+)\]\((https?:\/\/[^\)]+)\)/g, '<a href="$2" target="_blank" class="text-emerald-500 dark:text-emerald-400 hover:text-emerald-600 dark:hover:text-emerald-300 underline font-bold transition-colors">$1</a>');
            escaped = escaped.replace(/(^|[^"'])(https?:\/\/[^\s<]+)/g, function(match, p1, p2) {
                return p1 + '<a href="' + p2 + '" target="_blank" class="text-emerald-500 dark:text-emerald-400 hover:text-emerald-600 dark:hover:text-emerald-300 underline font-bold transition-colors">' + p2 + '</a>';
            });
            return escaped;
        }
        
        // ==========================================
        // FITUR RED FLAG TRIAGE
        // ==========================================
        function renderEmergencyResponse(message) {
            const messagesDiv = document.getElementById('chat-messages');
            const safeMessage = formatMessageText(message);
            
            const emergencyHtml = `
                <div class="flex items-start group animate-fade-in-up w-full mt-4 mb-6">
                    <div class="w-10 h-10 bg-red-600 dark:bg-red-700 rounded-2xl flex items-center justify-center text-white text-lg mr-3 flex-shrink-0 shadow-lg ring-4 ring-red-100 dark:ring-red-900/30 animate-pulse mt-1">
                        <i class="fas fa-truck-medical"></i>
                    </div>
                    <div class="bg-red-50 dark:bg-red-900/30 rounded-[2rem] rounded-tl-sm p-5 md:p-6 shadow-xl border-2 border-red-200 dark:border-red-800/50 w-full relative overflow-hidden">
                        <div class="absolute -right-4 -top-4 w-24 h-24 bg-red-500/10 dark:bg-red-400/10 rounded-full blur-xl animate-ping"></div>
                        <h4 class="font-black text-red-700 dark:text-red-400 text-base mb-2 flex items-center relative z-10 tracking-tight">
                            <i class="fas fa-exclamation-triangle mr-2"></i> PERINGATAN DARURAT
                        </h4>
                        <p class="text-red-900 dark:text-red-200 font-medium leading-relaxed mb-5 relative z-10 text-[14px] md:text-[15px]">${safeMessage}</p>
                        
                        <a href="tel:075131938" class="block w-full text-center bg-red-600 hover:bg-red-700 text-white font-bold py-3.5 rounded-xl transition-all shadow-md text-sm hover:-translate-y-0.5 relative z-10">
                            <i class="fas fa-ambulance mr-2 animate-bounce"></i> IGD: (0751) 31938
                        </a>
                    </div>
                </div>
            `;
            messagesDiv.insertAdjacentHTML('beforeend', emergencyHtml);
        }

        // ==========================================
        // FITUR VOICE TO TEXT (Web Speech API)
        // ==========================================
        const micBtns = document.querySelectorAll('.mic-btn');
        const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
        
        if (SpeechRecognition && micBtns.length > 0) {
            const recognition = new SpeechRecognition();
            recognition.lang = 'id-ID'; 
            recognition.continuous = false;
            recognition.interimResults = false;
            let isRecording = false;
            let activeInput = null;
            let activeBtn = null;

            micBtns.forEach(btn => {
                btn.addEventListener('click', (e) => {
                    activeBtn = btn;
                    activeInput = isChatOpen ? innerInput : heroInput;
                    
                    if (isRecording) {
                        recognition.stop();
                    } else {
                        recognition.start();
                    }
                });
            });

            recognition.onstart = function() {
                isRecording = true;
                if(activeBtn) {
                    activeBtn.classList.add('text-red-500', 'animate-pulse', 'bg-red-50');
                    activeBtn.classList.remove('text-gray-400');
                }
                if(activeInput) {
                    activeInput.placeholder = "Mendengarkan...";
                }
            };

            recognition.onresult = function(event) {
                const transcript = event.results[0][0].transcript;
                if(activeInput) {
                    activeInput.value = transcript;
                    setTimeout(() => submitQuestion(transcript), 500);
                }
            };

            recognition.onerror = function(event) {
                if(activeInput) {
                    activeInput.placeholder = "Gagal mendengarkan.";
                    setTimeout(() => activeInput.placeholder = "{{ __('messages.type_question_here') }}", 2000);
                }
            };

            recognition.onend = function() {
                isRecording = false;
                if(activeBtn) {
                    activeBtn.classList.remove('text-red-500', 'animate-pulse', 'bg-red-50');
                    activeBtn.classList.add('text-gray-400');
                }
                if(activeInput && !window.isFetching) {
                    activeInput.placeholder = "{{ __('messages.type_question_here') }}";
                }
            };
        }

        // ==========================================
        // FITUR TEXT-TO-SPEECH (TTS) BACA JAWABAN
        // ==========================================
        window.speakText = function(text) {
            if (!('speechSynthesis' in window)) return;
            window.speechSynthesis.cancel();
            const utterance = new SpeechSynthesisUtterance(text);
            utterance.lang = 'id-ID'; 
            window.speechSynthesis.speak(utterance);
        };

        window.quickAsk = function(question) {
            submitQuestion(question);
        };
    });
</script>
@endpush
@endsection