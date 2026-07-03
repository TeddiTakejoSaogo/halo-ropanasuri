@extends('layouts.app')

@section('title', 'Halo-Ropanasuri')

@section('content')
@php
    $hour = date('H');
    if ($hour < 11) {
        $greeting = 'Selamat Pagi';
    } elseif ($hour < 15) {
        $greeting = 'Selamat Siang';
    } elseif ($hour < 18) {
        $greeting = 'Selamat Sore';
    } else {
        $greeting = 'Selamat Malam';
    }
@endphp
<div class="grid grid-cols-1 lg:grid-cols-12 gap-6 lg:gap-8 max-w-7xl mx-auto">
    
    <!-- Sidebar Kiri: Info & Stats (Desktop) -->
    <div class="hidden lg:flex lg:col-span-3 flex-col gap-6">
        
        <!-- Welcome Card -->
        <div class="relative overflow-hidden rounded-[2rem] bg-white/60 dark:bg-gray-800/60 backdrop-blur-2xl border border-white/80 dark:border-gray-700 shadow-sm p-7 transition-all duration-500 hover:shadow-md hover:bg-white/80 dark:hover:bg-gray-800 group">
            <div class="absolute -top-24 -right-24 w-48 h-48 bg-gradient-to-br from-ropanasuri-400/20 to-emerald-400/20 dark:from-ropanasuri-600/20 dark:to-emerald-600/20 rounded-full blur-3xl group-hover:scale-110 transition-transform duration-700"></div>
            
            <div class="flex flex-col mb-5 relative z-10">
                <div class="w-12 h-12 bg-white dark:bg-gray-700 rounded-2xl flex items-center justify-center text-ropanasuri-600 dark:text-ropanasuri-400 shadow-sm border border-gray-100 dark:border-gray-600 mb-4 group-hover:-translate-y-1 transition-transform duration-300">
                    <i class="fas fa-hand-holding-medical text-xl"></i>
                </div>
                <div>
                    <h3 class="text-xl font-extrabold text-gray-800 dark:text-gray-100 tracking-tight">{{ $greeting }}!</h3>
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1 font-medium">{{ now()->translatedFormat('l, d F Y') }}</p>
                </div>
            </div>
            <p class="text-[13px] text-gray-600 dark:text-gray-300 leading-relaxed relative z-10 font-medium">
                Asisten virtual Ropanasuri siap mendampingi Anda. Tanyakan seputar layanan, jadwal, maupun fasilitas.
            </p>
            <div class="mt-5 pt-5 border-t border-gray-200/50 dark:border-gray-700/50 relative z-10">
                <div class="flex items-center text-[11px] font-bold text-emerald-600 dark:text-emerald-400 bg-emerald-50/80 dark:bg-emerald-900/30 w-fit px-3 py-1.5 rounded-xl border border-emerald-100/50 dark:border-emerald-800/50">
                    <span class="relative flex h-2 w-2 mr-2">
                      <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                      <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                    </span>
                    {{ __('messages.online_fast_response') }}
                </div>
            </div>
        </div>
        
        <!-- Panduan Darurat -->
        <div class="relative overflow-hidden rounded-[2rem] bg-gradient-to-br from-red-50 to-rose-50/80 dark:from-red-900/30 dark:to-rose-900/20 backdrop-blur-xl border border-red-100/50 dark:border-red-800/30 shadow-sm p-7 group transition-all duration-500 hover:shadow-md">
            <div class="absolute -right-10 -bottom-10 w-32 h-32 bg-red-400/10 dark:bg-red-500/10 rounded-full blur-2xl group-hover:bg-red-400/20 transition-colors duration-700"></div>
            
            <div class="flex items-center mb-4 relative z-10">
                <div class="w-10 h-10 rounded-xl bg-red-100/80 dark:bg-red-900/50 text-red-600 dark:text-red-400 flex items-center justify-center mr-3 shadow-inner">
                    <i class="fas fa-truck-medical text-sm animate-pulse"></i>
                </div>
                <h4 class="text-sm font-bold text-red-700 dark:text-red-300 tracking-tight">{{ __('messages.emergency_triage') }}</h4>
            </div>
            
            <div class="space-y-4 relative z-10">
                <p class="text-xs text-red-800/80 dark:text-red-300/80 leading-relaxed font-medium">{{ __('messages.emergency_triage_desc') }}</p>
                <div class="flex flex-wrap gap-2">
                    <span class="px-2.5 py-1 bg-white/90 dark:bg-gray-800 text-red-600 dark:text-red-400 border border-red-100 dark:border-red-800/50 rounded-lg text-[10px] font-bold shadow-sm cursor-default">{{ __('messages.bleeding') }}</span>
                    <span class="px-2.5 py-1 bg-white/90 dark:bg-gray-800 text-red-600 dark:text-red-400 border border-red-100 dark:border-red-800/50 rounded-lg text-[10px] font-bold shadow-sm cursor-default">{{ __('messages.severe_pain') }}</span>
                    <span class="px-2.5 py-1 bg-white/90 dark:bg-gray-800 text-red-600 dark:text-red-400 border border-red-100 dark:border-red-800/50 rounded-lg text-[10px] font-bold shadow-sm cursor-default">{{ __('messages.shortness_of_breath') }}</span>
                    <span class="px-2.5 py-1 bg-white/90 dark:bg-gray-800 text-red-600 dark:text-red-400 border border-red-100 dark:border-red-800/50 rounded-lg text-[10px] font-bold shadow-sm cursor-default">{{ __('messages.fainting') }}</span>
                </div>
                <p class="text-[10px] text-red-600/80 dark:text-red-400/90 leading-relaxed font-bold bg-red-100/50 dark:bg-red-900/30 p-2.5 rounded-xl border border-red-100/50 dark:border-red-800/30 flex items-start">
                    <i class="fas fa-bolt text-amber-500 mr-1.5 mt-0.5"></i> {{ __('messages.instant_access_er') }}
                </p>
            </div>
        </div>
    </div>
        


    <!-- Kolom Tengah: Chat Area -->
    <div class="lg:col-span-6 flex flex-col h-[calc(100vh-140px)] min-h-[600px]">
        <div class="flex-1 bg-white/80 dark:bg-gray-800/80 backdrop-blur-xl rounded-[2rem] shadow-xl shadow-gray-200/50 dark:shadow-gray-900/50 border border-white dark:border-gray-700 flex flex-col overflow-hidden relative">
            
            <!-- Chat Header -->
            <div class="px-6 py-4 flex items-center justify-between border-b border-gray-100/80 dark:border-gray-700/80 bg-white/50 dark:bg-gray-800/50 backdrop-blur-md z-20">
                <div class="flex items-center">
                    <div class="relative group cursor-pointer">
                        <div class="w-12 h-12 bg-gradient-to-br from-gray-50 to-white dark:from-gray-700 dark:to-gray-800 rounded-2xl flex items-center justify-center shadow-sm border border-gray-100 dark:border-gray-600 p-2 transition-transform duration-300 group-hover:scale-105">
                            <img src="{{ asset("images/airopanasuri.png") }}" alt="AI" class="w-full h-full object-contain filter drop-shadow-sm">
                        </div>
                        <div class="absolute -bottom-0.5 -right-0.5 w-3.5 h-3.5 bg-emerald-500 border-2 border-white dark:border-gray-800 rounded-full"></div>
                    </div>
                    <div class="ml-4">
                        <h2 class="text-gray-800 dark:text-gray-100 font-extrabold text-lg flex items-center tracking-tight">
                            Halo-Ropanasuri
                            <span class="ml-2.5 px-2 py-0.5 bg-ropanasuri-50 dark:bg-ropanasuri-900/50 text-ropanasuri-600 dark:text-ropanasuri-400 rounded-md text-[9px] font-bold uppercase tracking-wider border border-ropanasuri-100 dark:border-ropanasuri-800/50">AI v1.0</span>
                        </h2>
                        <p class="text-gray-500 dark:text-gray-400 text-[11px] font-medium mt-0.5 flex items-center">
                            {{ __('messages.online_fast_response') }}
                        </p>
                    </div>
                </div>
                
                <!-- Action Buttons -->
                <div class="flex space-x-1">
                    <button class="p-2.5 hover:bg-gray-100 rounded-xl transition-colors text-gray-400 hover:text-gray-600">
                        <i class="fas fa-ellipsis-h"></i>
                    </button>
                </div>
            </div>
            
            <!-- Chat Messages -->
            <div id="chat-messages" class="flex-1 overflow-y-auto p-6 bg-gray-50/30 dark:bg-gray-900/30 space-y-2 scroll-smooth relative z-10 custom-scrollbar">
                <!-- Welcome Message -->
                <div class="flex items-start group animate-fade-in-up mb-4">
                    <div class="w-9 h-9 bg-gradient-to-br from-ropanasuri-500 to-ropanasuri-600 rounded-2xl flex items-center justify-center text-white font-bold text-[10px] mr-3 flex-shrink-0 shadow-md">
                        AI
                    </div>
                    <div class="flex-1 max-w-[85%]">
                        <div class="bg-white dark:bg-gray-800 rounded-2xl rounded-tl-sm p-5 shadow-sm border border-gray-100 dark:border-gray-700 transition-shadow hover:shadow-md">
                            <p class="text-gray-700 dark:text-gray-200 leading-relaxed text-[14px]">
                                👋 {{ $greeting }}! {!! __('messages.ai_welcome') !!}
                            </p>
                            <p class="text-gray-500 dark:text-gray-400 mt-3 text-[13px] font-medium">
                                {{ __('messages.ai_help') }}
                            </p>
                            <div class="mt-4 flex flex-wrap gap-2">
                                <button type="button" class="px-3 py-1.5 bg-gray-50 dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-xl text-[11px] hover:bg-ropanasuri-50 dark:hover:bg-ropanasuri-900/50 hover:text-ropanasuri-700 dark:hover:text-ropanasuri-400 transition-all duration-300 font-medium border border-gray-200 dark:border-gray-600 hover:border-ropanasuri-200 dark:hover:border-ropanasuri-700 quick-question flex items-center gap-1.5 group/btn">
                                    <div class="w-5 h-5 rounded-md bg-white dark:bg-gray-600 flex items-center justify-center shadow-sm group-hover/btn:text-ropanasuri-500 dark:group-hover/btn:text-ropanasuri-400"><i class="fas fa-clock text-[9px]"></i></div>
                                    Jam besuk
                                </button>
                                <button type="button" class="px-3 py-1.5 bg-gray-50 dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-xl text-[11px] hover:bg-ropanasuri-50 dark:hover:bg-ropanasuri-900/50 hover:text-ropanasuri-700 dark:hover:text-ropanasuri-400 transition-all duration-300 font-medium border border-gray-200 dark:border-gray-600 hover:border-ropanasuri-200 dark:hover:border-ropanasuri-700 quick-question flex items-center gap-1.5 group/btn">
                                    <div class="w-5 h-5 rounded-md bg-white dark:bg-gray-600 flex items-center justify-center shadow-sm group-hover/btn:text-ropanasuri-500 dark:group-hover/btn:text-ropanasuri-400"><i class="fas fa-laptop-medical text-[9px]"></i></div>
                                    Cara daftar
                                </button>
                                <!-- <button type="button" class="px-3 py-1.5 bg-gray-50 dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-xl text-[11px] hover:bg-ropanasuri-50 dark:hover:bg-ropanasuri-900/50 hover:text-ropanasuri-700 dark:hover:text-ropanasuri-400 transition-all duration-300 font-medium border border-gray-200 dark:border-gray-600 hover:border-ropanasuri-200 dark:hover:border-ropanasuri-700 quick-question flex items-center gap-1.5 group/btn">
                                    <div class="w-5 h-5 rounded-md bg-white dark:bg-gray-600 flex items-center justify-center shadow-sm group-hover/btn:text-ropanasuri-500 dark:group-hover/btn:text-ropanasuri-400"><i class="fas fa-file-invoice-dollar text-[9px]"></i></div>
                                    Biaya
                                </button> -->
                            </div>
                        </div>
                        <span class="text-[10px] text-gray-400 mt-1.5 block ml-1 font-medium">{{ now()->format('H:i') }}</span>
                    </div>
                </div>
            </div>
            
            <!-- Chat Input Area -->
            <div class="p-4 bg-white/60 dark:bg-gray-800/60 backdrop-blur-md border-t border-gray-100 dark:border-gray-700 z-20">
                <form id="chat-form" class="relative">
                    <div class="flex items-end gap-2 bg-white dark:bg-gray-700 p-2 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-600 focus-within:border-ropanasuri-400 dark:focus-within:border-ropanasuri-500 focus-within:ring-4 focus-within:ring-ropanasuri-50 dark:focus-within:ring-ropanasuri-900/30 transition-all duration-300">
                        <!-- Mic Button -->
                        <button type="button" id="mic-btn" class="p-2.5 text-gray-400 dark:text-gray-400 hover:text-ropanasuri-500 dark:hover:text-ropanasuri-400 hover:bg-ropanasuri-50 dark:hover:bg-ropanasuri-900/50 rounded-xl transition-all self-center ml-1" title="{{ __('messages.use_voice') }}">
                            <i class="fas fa-microphone"></i>
                        </button>
                        
                        <!-- Textarea -->
                        <textarea 
                            id="question-input"
                            rows="1"
                            class="flex-1 py-3 px-2 bg-transparent border-none focus:outline-none focus:ring-0 resize-none overflow-hidden text-gray-700 dark:text-gray-200 placeholder-gray-400 dark:placeholder-gray-500 text-[14px] leading-relaxed self-center custom-scrollbar"
                            placeholder="{{ __('messages.type_question_here') }}"
                            style="min-height: 44px; max-height: 120px;"
                        ></textarea>
                        
                        <!-- Send Button -->
                        <button type="submit" class="p-3 bg-gradient-to-br from-ropanasuri-500 to-emerald-500 dark:from-ropanasuri-600 dark:to-emerald-600 text-white rounded-xl shadow-md hover:shadow-lg hover:shadow-ropanasuri-500/30 hover:-translate-y-0.5 transition-all duration-300 self-center mr-1 disabled:opacity-50 disabled:cursor-not-allowed">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                            </svg>
                        </button>
                    </div>
                    
                    <div class="flex justify-between items-center mt-2 px-2">
                        <span class="text-[10px] text-gray-400 dark:text-gray-500 font-medium flex items-center">
                            <i class="fas fa-shield-alt mr-1.5 opacity-70"></i> {{ __('messages.safe_encrypted') }}
                        </span>
                        <div class="hidden md:flex gap-3 text-[9px] text-gray-400 dark:text-gray-500 font-medium uppercase tracking-wider">
                            <span class="flex items-center"><i class="fas fa-level-down-alt rotate-90 mr-1"></i> {{ __('messages.enter_send') }}</span>
                            <span class="flex items-center">{{ __('messages.shift_enter_newline') }}</span>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Kolom Kanan: Edukasi Pasien -->
    <div class="hidden lg:flex lg:col-span-3 flex-col gap-6">
        
        <!-- Tips Cepat -->
        <div class="relative overflow-hidden rounded-[2rem] bg-gray-900 dark:bg-gray-800 p-7 shadow-lg group">
            <div class="absolute -right-6 -top-6 w-32 h-32 bg-ropanasuri-500/20 rounded-full blur-3xl group-hover:scale-150 transition-transform duration-1000"></div>
            
            <div class="flex items-center mb-5 relative z-10">
                <div class="w-10 h-10 rounded-xl bg-white/10 flex items-center justify-center mr-3 backdrop-blur-md border border-white/10">
                    <i class="fas fa-lightbulb text-sm text-yellow-400 animate-pulse"></i>
                </div>
                <h4 class="font-bold text-white tracking-tight text-sm">{{ __('messages.search_tips') }}</h4>
            </div>
            
            <ul class="space-y-3 relative z-10">
                <li class="flex items-start group/item">
                    <div class="bg-white/10 rounded-full p-1 mr-3 group-hover/item:bg-ropanasuri-500 transition-colors">
                        <i class="fas fa-check text-[9px] text-white"></i>
                    </div>
                    <span class="text-xs text-gray-400 font-medium pt-0.5">{{ __('messages.type') }} <span class="text-white font-bold">{!! __('messages.type_doctor_schedule') !!}</span></span>
                </li>
                <li class="flex items-start group/item">
                    <div class="bg-white/10 rounded-full p-1 mr-3 group-hover/item:bg-ropanasuri-500 transition-colors">
                        <i class="fas fa-check text-[9px] text-white"></i>
                    </div>
                    <span class="text-xs text-gray-400 font-medium pt-0.5">{{ __('messages.type') }} <span class="text-white font-bold">{!! __('messages.type_bpjs') !!}</span></span>
                </li>
                <li class="flex items-start group/item">
                    <div class="bg-white/10 rounded-full p-1 mr-3 group-hover/item:bg-ropanasuri-500 transition-colors">
                        <i class="fas fa-check text-[9px] text-white"></i>
                    </div>
                    <span class="text-xs text-gray-400 font-medium pt-0.5">{{ __('messages.type') }} <span class="text-white font-bold">{!! __('messages.type_kamarmaya') !!}</span></span>
                </li>
            </ul>
        </div>

        <!-- Header Edukasi -->
        <div class="flex items-center justify-between px-1">
            <div>
                <h3 class="text-base font-extrabold text-gray-800 dark:text-gray-100 flex items-center tracking-tight">
                    <span class="w-8 h-8 rounded-xl bg-indigo-50 dark:bg-indigo-900/30 text-indigo-500 dark:text-indigo-400 flex items-center justify-center mr-3 border border-indigo-100 dark:border-indigo-800/50">
                        <i class="fas fa-book-open text-[13px]"></i>
                    </span>
                    {{ __('messages.medical_education') }}
                </h3>
                <p class="text-[10px] text-gray-500 dark:text-gray-400 mt-1 font-medium ml-11">{{ __('messages.articles_guide') }}</p>
            </div>
        </div>

        <!-- Artikel Cards -->
        <div class="space-y-3 max-h-[calc(100vh-220px)] overflow-y-auto pr-2 custom-scrollbar">
            @forelse($artikels ?? [] as $index => $artikel)
            @php
                $colors = ['text-blue-500 bg-blue-50 dark:bg-blue-900/30 dark:text-blue-400', 'text-emerald-500 bg-emerald-50 dark:bg-emerald-900/30 dark:text-emerald-400', 'text-purple-500 bg-purple-50 dark:bg-purple-900/30 dark:text-purple-400', 'text-rose-500 bg-rose-50 dark:bg-rose-900/30 dark:text-rose-400', 'text-amber-500 bg-amber-50 dark:bg-amber-900/30 dark:text-amber-400'];
                $icons = ['fa-heart-pulse', 'fa-brain', 'fa-lungs', 'fa-bone', 'fa-capsules'];
                $color = $colors[$index % count($colors)];
                $icon = $icons[$index % count($icons)];
            @endphp
            <a href="{{ route('artikel.show', $artikel->slug) }}" class="block group">
                <div class="bg-white/60 dark:bg-gray-800/60 backdrop-blur-xl rounded-[1.5rem] p-3.5 shadow-sm border border-gray-100 dark:border-gray-700 transition-all duration-300 hover:shadow-md hover:bg-white dark:hover:bg-gray-800 hover:-translate-y-1">
                    <div class="flex gap-3.5">
                        <!-- Thumbnail -->
                        @if($artikel->gambar)
                            <div class="w-14 h-14 rounded-xl flex-shrink-0 overflow-hidden shadow-sm border border-gray-100 dark:border-gray-600">
                                <img src="{{ asset('storage/'.$artikel->gambar) }}" alt="{{ $artikel->judul }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            </div>
                        @else
                            <div class="w-14 h-14 rounded-xl flex-shrink-0 flex items-center justify-center {{ $color }} border border-white/50 dark:border-gray-600/50">
                                <i class="fas {{ $icon }} text-xl"></i>
                            </div>
                        @endif
                        
                        <!-- Content -->
                        <div class="flex-1 min-w-0">
                            <h4 class="text-[13px] font-bold text-gray-800 dark:text-gray-100 leading-tight mb-1 group-hover:text-ropanasuri-600 dark:group-hover:text-ropanasuri-400 transition-colors line-clamp-2">
                                {{ $artikel->judul }}
                            </h4>
                            <div class="flex items-center text-[9px] text-gray-500 dark:text-gray-400 font-medium">
                                <span class="flex items-center">
                                    <i class="far fa-calendar-alt mr-1 opacity-70"></i>
                                    {{ $artikel->created_at->translatedFormat('d M') }}
                                </span>
                                <span class="mx-1.5 opacity-50">•</span>
                                <span class="flex items-center">
                                    <i class="far fa-eye mr-1 opacity-70"></i>
                                    {{ $artikel->view_count ?? rand(100, 500) }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
            @empty
            <div class="bg-white/50 dark:bg-gray-800/50 backdrop-blur-sm rounded-[2rem] p-8 text-center border border-dashed border-gray-200 dark:border-gray-700">
                <div class="w-12 h-12 bg-white dark:bg-gray-700 rounded-2xl flex items-center justify-center text-xl mx-auto shadow-sm mb-3 text-gray-300 dark:text-gray-600">
                    <i class="fas fa-folder-open"></i>
                </div>
                <p class="text-[10px] text-gray-400 mt-1">Edukasi medis akan segera hadir.</p>
            </div>
            @endforelse
        </div>
        
        <!-- Minimalist Copyright -->
        <div class="mt-auto pt-4 border-t border-gray-100 dark:border-gray-800 text-center">
            <p class="text-[10px] text-gray-400 dark:text-gray-500 font-medium">
                © {{ date('Y') }} IT RSKB Ropanasuri.<br>All rights reserved.
            </p>
        </div>
    </div>
</div>

<!-- Quick Question Mobile (Visible only on mobile) -->
<div class="fixed bottom-24 right-4 lg:hidden z-50">
    <button class="bg-gray-900 text-white p-4 rounded-full shadow-2xl hover:bg-ropanasuri-600 transition-all duration-300 transform hover:scale-110">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
    </button>
</div>

@push('styles')
<style>
    @keyframes blob {
        0% { transform: translate(0px, 0px) scale(1); }
        33% { transform: translate(30px, -50px) scale(1.1); }
        66% { transform: translate(-20px, 20px) scale(0.9); }
        100% { transform: translate(0px, 0px) scale(1); }
    }
    .animate-blob {
        animation: blob 7s infinite;
    }
    .animation-delay-2000 {
        animation-delay: 2s;
    }
    .animation-delay-4000 {
        animation-delay: 4s;
    }
    .custom-scrollbar::-webkit-scrollbar {
        width: 5px;
    }
    .custom-scrollbar::-webkit-scrollbar-track {
        background: transparent;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb {
        background-color: #e5e7eb;
        border-radius: 10px;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb:hover {
        background-color: #d1d5db;
    }
    .animate-fade-in-up {
        animation: fadeInUp 0.4s ease-out forwards;
    }
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // ============== AUTO-RESIZE TEXTAREA ==============
        const textarea = document.getElementById('question-input');
        if (textarea) {
            textarea.addEventListener('input', function() {
                this.style.height = 'auto';
                this.style.height = (this.scrollHeight) + 'px';
            });
        }

        // ============== ENTER KEY HANDLER (FIX BUG) ==============
        const chatForm = document.getElementById('chat-form');
        const questionInput = document.getElementById('question-input');
        
        if (chatForm && questionInput) {
            questionInput.addEventListener('keydown', function(e) {
                if (e.key === 'Enter' && !e.shiftKey) {
                    e.preventDefault(); 
                    chatForm.dispatchEvent(new Event('submit')); 
                }
            });
        }

        // ============== QUICK QUESTION BUTTONS ==============
        document.querySelectorAll('.quick-question').forEach(button => {
            button.addEventListener('click', function() {
                const question = this.textContent.trim();
                const input = document.getElementById('question-input');
                if (input) {
                    input.value = question;
                    input.style.height = 'auto';
                    input.style.height = input.scrollHeight + 'px';
                    document.getElementById('chat-form').dispatchEvent(new Event('submit'));
                }
            });
        });

        // ============== CHAT FORM SUBMISSION ==============
        document.getElementById('chat-form').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const input = document.getElementById('question-input');
            const question = input.value.trim();
            const messagesDiv = document.getElementById('chat-messages');
            
            if (!question) {
                appendMessage('user', '(pesan kosong)');
                appendMessage('bot', '{{ __('messages.ai_empty') }}', true);
                input.value = '';
                input.style.height = 'auto';
                scrollToBottom();
                return;
            }
            
            appendMessage('user', question);
            
            input.value = '';
            input.style.height = 'auto';
            
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
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                removeLoading(loadingId);
                
                if (data.status === 'emergency') {
                    renderEmergencyResponse(data.answer);
                } else {
                    appendMessage('bot', data.answer, true, data.follow_ups || []);
                }
                
                scrollToBottom();
            })
            .catch(error => {
                console.error('Error:', error);
                removeLoading(loadingId);
                appendMessage('bot', 'Maaf, terjadi gangguan. Silakan coba lagi.', true);
                scrollToBottom();
            });
        });

        // ============== FUNGSI-FUNGSI CHAT ==============
        
        function appendMessage(sender, message, isTyping = false, followUps = []) {
            const messagesDiv = document.getElementById('chat-messages');
            const time = new Date().toLocaleTimeString('id-ID', { 
                hour: '2-digit', 
                minute: '2-digit',
                hour12: false 
            });
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
                    return `<button type="button" onclick="quickAsk('${escapedFaq}')" class="flex items-center text-left bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 text-gray-700 dark:text-gray-200 hover:bg-ropanasuri-50 dark:hover:bg-ropanasuri-900/50 hover:border-ropanasuri-200 dark:hover:border-ropanasuri-700 px-3.5 py-2 rounded-xl text-[11px] transition-all shadow-sm w-full font-medium hover:-translate-y-0.5"><i class="fas fa-sparkles text-amber-500 mr-2 text-[10px]"></i>${escapeHtml(f)}</button>`;
                }).join('');
                followUpsHtml = `
                    <div class="mt-4 pt-4 border-t border-gray-100/80 dark:border-gray-700/80 w-full animate-fade-in-up" style="animation-delay: 0.5s;">
                        <p class="text-[9px] font-bold text-gray-400 dark:text-gray-500 mb-2 uppercase tracking-widest">Saran Pertanyaan:</p>
                        <div class="space-y-2">
                            ${pills}
                        </div>
                    </div>
                `;
            }
            
            const messageHtml = `
                <div class="flex items-start group animate-fade-in-up ${sender === 'user' ? 'justify-end' : 'w-full'} mb-4">
                    ${sender === 'bot' ? 
                        '<div class="w-9 h-9 bg-gradient-to-br from-ropanasuri-500 to-ropanasuri-600 rounded-2xl flex items-center justify-center text-white font-bold text-[10px] mr-3 flex-shrink-0 shadow-md">AI</div>' 
                        : ''}
                    <div class="${sender === 'user' ? 
                        'bg-gray-900 dark:bg-gray-700 text-white rounded-2xl rounded-tr-sm shadow-md max-w-[85%]' 
                        : 'bg-white dark:bg-gray-800 rounded-2xl rounded-tl-sm w-full md:max-w-[85%]'} 
                        p-5 shadow-sm border ${sender === 'user' ? 'border-gray-800 dark:border-gray-600' : 'border-gray-100 dark:border-gray-700'} transition-shadow hover:shadow-md">
                        
                        <p id="${msgId}" class="${sender === 'user' ? 'text-white' : 'text-gray-700 dark:text-gray-200'} leading-relaxed whitespace-pre-wrap text-[14px]">${isTyping ? '' : escapeHtml(message)}</p>
                        
                        ${sender === 'bot' && !isTyping ? speakerBtnHtml : ''}
                        ${sender === 'bot' && !isTyping ? followUpsHtml : ''}
                    </div>
                    ${sender === 'user' ? 
                        '<div class="w-9 h-9 bg-gray-100 dark:bg-gray-800 rounded-2xl flex items-center justify-center text-gray-400 dark:text-gray-500 font-bold text-[12px] ml-3 flex-shrink-0 shadow-sm border border-gray-200 dark:border-gray-700"><i class="fas fa-user"></i></div>' 
                        : ''}
                </div>
                <div class="flex ${sender === 'user' ? 'justify-end mr-14' : 'justify-start ml-14'} -mt-3 mb-4">
                    <span class="text-[10px] text-gray-400 font-medium opacity-0 group-hover:opacity-100 transition-opacity">${time}</span>
                </div>
            `;
            
            messagesDiv.insertAdjacentHTML('beforeend', messageHtml);
            
            if (isTyping) {
                const p = document.getElementById(msgId);
                let i = 0;
                const speed = 15;
                function typeWriter() {
                    if (i < message.length) {
                        p.textContent += message.charAt(i);
                        i++;
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
                <div id="${id}" class="flex items-start animate-fade-in-up mb-4">
                    <div class="w-9 h-9 bg-gradient-to-br from-ropanasuri-500 to-ropanasuri-600 rounded-2xl flex items-center justify-center text-white font-bold text-[10px] mr-3 flex-shrink-0 shadow-md">AI</div>
                    <div class="bg-white dark:bg-gray-800 rounded-2xl rounded-tl-sm p-4 shadow-sm border border-gray-100 dark:border-gray-700">
                        <div class="flex space-x-1.5">
                            <div class="w-2 h-2 bg-ropanasuri-400 rounded-full animate-bounce"></div>
                            <div class="w-2 h-2 bg-ropanasuri-500 rounded-full animate-bounce" style="animation-delay: 0.15s"></div>
                            <div class="w-2 h-2 bg-ropanasuri-600 rounded-full animate-bounce" style="animation-delay: 0.3s"></div>
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
        
        // ==========================================
        // FITUR RED FLAG TRIAGE
        // ==========================================
        function renderEmergencyResponse(message) {
            const messagesDiv = document.getElementById('chat-messages');
            
            document.body.classList.add('bg-red-50');
            setTimeout(() => document.body.classList.remove('bg-red-50'), 1000);
            
            const emergencyHtml = `
                <div class="flex items-start group animate-fade-in-up w-full mt-4 mb-6">
                    <div class="w-10 h-10 bg-red-600 dark:bg-red-700 rounded-2xl flex items-center justify-center text-white text-lg mr-3 flex-shrink-0 shadow-lg ring-4 ring-red-100 dark:ring-red-900/30 animate-pulse">
                        <i class="fas fa-truck-medical"></i>
                    </div>
                    <div class="bg-red-50 dark:bg-red-900/30 rounded-[2rem] rounded-tl-sm p-6 shadow-xl border-2 border-red-200 dark:border-red-800/50 w-full relative overflow-hidden">
                        <div class="absolute -right-4 -top-4 w-20 h-20 bg-red-500/10 dark:bg-red-400/10 rounded-full blur-xl animate-ping"></div>
                        <h4 class="font-extrabold text-red-700 dark:text-red-400 text-base mb-2 flex items-center relative z-10 tracking-tight">
                            <i class="fas fa-exclamation-triangle mr-2"></i> PERINGATAN DARURAT
                        </h4>
                        <p class="text-red-900 dark:text-red-200 font-medium leading-relaxed mb-5 relative z-10 text-[14px]">${message}</p>
                        
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
        const micBtn = document.getElementById('mic-btn');
        const form = document.getElementById('chat-form');
        const input = document.getElementById('question-input');
        const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
        
        if (SpeechRecognition && micBtn) {
            const recognition = new SpeechRecognition();
            recognition.lang = 'id-ID'; 
            recognition.continuous = false;
            recognition.interimResults = false;
            
            let isRecording = false;

            micBtn.addEventListener('click', () => {
                if (isRecording) {
                    recognition.stop();
                } else {
                    recognition.start();
                }
            });

            recognition.onstart = function() {
                isRecording = true;
                micBtn.classList.add('text-red-500', 'animate-pulse', 'bg-red-50');
                micBtn.classList.remove('text-gray-400');
                input.placeholder = "Mendengarkan suara Anda...";
            };

            recognition.onresult = function(event) {
                const transcript = event.results[0][0].transcript;
                input.value = transcript;
                input.style.height = 'auto';
                input.style.height = (input.scrollHeight) + 'px';
                
                setTimeout(() => form.dispatchEvent(new Event('submit')), 500);
            };

            recognition.onerror = function(event) {
                console.error("Speech recognition error", event.error);
                input.placeholder = "Gagal mendengarkan. Coba lagi.";
                setTimeout(() => input.placeholder = "Tulis pertanyaan Anda di sini...", 2000);
            };

            recognition.onend = function() {
                isRecording = false;
                micBtn.classList.remove('text-red-500', 'animate-pulse', 'bg-red-50');
                micBtn.classList.add('text-gray-400');
                if(!input.value) {
                    input.placeholder = "Tulis pertanyaan Anda di sini...";
                }
            };
        } else if (micBtn) {
            micBtn.style.display = 'none';
        }

        // ==========================================
        // FITUR TEXT-TO-SPEECH (TTS) BACA JAWABAN
        // ==========================================
        window.speakText = function(text) {
            if (!('speechSynthesis' in window)) {
                alert("Maaf, browser Anda tidak mendukung fitur suara.");
                return;
            }
            
            window.speechSynthesis.cancel();
            
            const utterance = new SpeechSynthesisUtterance(text);
            utterance.lang = 'id-ID'; 
            utterance.rate = 1.0; 
            utterance.pitch = 1.0;
            
            window.speechSynthesis.speak(utterance);
        };

        // ==========================================
        // QUICK ASK (DARI FOLLOW UP / SUGGESTION)
        // ==========================================
        window.quickAsk = function(question) {
            input.value = question;
            form.dispatchEvent(new Event('submit'));
        };

        setTimeout(scrollToBottom, 100);
    });
</script>
@endpush
@endsection