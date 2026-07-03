<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Asisten virtual Rumah Sakit Ropanasuri - Informasi layanan, jadwal dokter, dan edukasi pasien">
    <meta name="theme-color" content="#0ea5e9">
    <title>@yield('title', 'Halo-Ropanasuri')</title>
     <!-- Favicon - SEMUA UKURAN -->
    <link rel="icon" type="image/x-icon" href="{{ asset('images/airopanasuri.png') }}">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700|plus-jakarta-sans:600,700,800&display=swap" rel="stylesheet" />
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/favicon/ropanasuri.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/favicon/ropanasuri-apple.png') }}">
    
    <!-- FontAwesome for Medical Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Scripts & Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    @stack('styles')
    
    <!-- Dark Mode Init -->
    <script>
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark')
        } else {
            document.documentElement.classList.remove('dark')
        }
    </script>
</head>
<body class="font-['Inter'] antialiased bg-gradient-to-br from-[#ecfdf5] via-white to-[#d1fae5] dark:from-gray-900 dark:via-gray-800 dark:to-gray-900 min-h-screen text-gray-800 dark:text-gray-100 transition-colors duration-300">
    
    <!-- Navigation Modern & Transparan -->
    <nav class="sticky top-0 z-50 backdrop-blur-lg bg-white/70 dark:bg-gray-900/70 border-b border-white/20 dark:border-gray-700/50 shadow-sm">
        <div class="max-w-[96%] 2xl:max-w-[1800px] mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                
                <!-- Logo & Brand -->
                <a href="{{ route('chat.index') }}" class="flex items-center group">
                    <div class="relative">
                        <div class="absolute inset-0 bg-ropanasuri-400 rounded-2xl blur-lg opacity-20 group-hover:opacity-30 transition"></div>
                        {{-- <div class="relative bg-gradient-to-br from-ropanasuri-500 to-ropanasuri-700 text-white p-3 rounded-2xl shadow-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.436 60.436 0 00-.656 8.348 60.437 60.437 0 018.348-.656 60.445 60.445 0 018.348.656 60.436 60.436 0 00-.656-8.348 60.443 60.443 0 00-7.692-3.975 60.44 60.44 0 00-7.692 3.975z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 12v.01M16.5 12v.01M7.5 12v.01" />
                            </svg>
                        </div> --}}
                        <div class="w-12 h-12 bg-gradient-to-br bg-white/70 to-amber-500 rounded-2xl flex items-center justify-center text-white shadow-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <img src="{{ asset("images/airopanasuri.png") }}" alt="">
                                {{-- <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /> --}}
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4">
                        <span class="font-['Plus_Jakarta_Sans'] font-extrabold text-2xl tracking-tight bg-gradient-to-r from-ropanasuri-700 to-ropanasuri-500 dark:from-ropanasuri-400 dark:to-ropanasuri-300 bg-clip-text text-transparent">
                            Halo<span class="text-ropanasuri-600 dark:text-ropanasuri-400">Ropa</span>nasuri
                        </span>
                        <span class="block text-xs text-gray-500 dark:text-gray-400 -mt-1">Asisten Virtual RS</span>
                    </div>
                </a>

                <!-- Right Menu -->
                <div class="flex items-center space-x-2 md:space-x-4">
                    <!-- Language Switcher -->
                    @php $locale = session()->get('locale', 'id'); @endphp
                    <a href="{{ route('lang.switch', $locale === 'id' ? 'en' : 'id') }}" class="flex items-center justify-center w-10 h-10 rounded-full bg-white/80 dark:bg-gray-800 backdrop-blur-sm border border-gray-200 dark:border-gray-700 text-gray-600 dark:text-gray-300 hover:bg-ropanasuri-50 dark:hover:bg-ropanasuri-900/50 transition-all font-bold text-sm shadow-sm" title="Switch Language">
                        {{ strtoupper($locale) }}
                    </a>

                    <!-- Theme Toggle -->
                    <button id="theme-toggle" type="button" class="flex items-center justify-center w-10 h-10 rounded-full bg-white/80 dark:bg-gray-800 backdrop-blur-sm border border-gray-200 dark:border-gray-700 text-gray-600 dark:text-gray-300 hover:bg-ropanasuri-50 dark:hover:bg-ropanasuri-900/50 transition-all shadow-sm" title="Toggle Dark Mode">
                        <i id="theme-toggle-dark-icon" class="hidden fas fa-moon"></i>
                        <i id="theme-toggle-light-icon" class="hidden fas fa-sun"></i>
                    </button>

                    @auth
                        <a href="{{ route('dashboard') }}" class="hidden md:flex items-center px-5 py-2.5 bg-white/80 dark:bg-gray-800 backdrop-blur-sm border border-gray-200 dark:border-gray-700 rounded-full text-gray-700 dark:text-gray-300 hover:bg-ropanasuri-50 dark:hover:bg-ropanasuri-900/50 hover:border-ropanasuri-300 transition-all duration-300 shadow-sm">
                            <i class="fas fa-chart-pie mr-2"></i>
                            Dashboard
                        </a>
                    @endauth
                    
                    <button id="mobile-menu-button" class="md:hidden p-2.5 rounded-lg bg-white/80 dark:bg-gray-800 backdrop-blur-sm border border-gray-200 dark:border-gray-700 text-gray-600 dark:text-gray-300 hover:bg-ropanasuri-50 dark:hover:bg-ropanasuri-900/50 transition shadow-sm">
                        <i class="fas fa-bars"></i>
                    </button>
                </div>
            </div>
        </div>
        
        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden md:hidden bg-white/95 backdrop-blur-lg border-t border-gray-100 px-4 py-4">
            <div class="space-y-2">
                @auth
                    <a href="{{ route('dashboard') }}" class="flex items-center px-4 py-3 rounded-xl text-gray-700 hover:bg-ropanasuri-50 hover:text-ropanasuri-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                        Dashboard Admin
                    </a>
                @else
                    <a href="{{ route('login') }}" class="flex items-center px-4 py-3 rounded-xl bg-gradient-to-r from-ropanasuri-600 to-ropanasuri-500 text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                        Login Admin
                    </a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="relative">
        <!-- Decorative Background Elements (Medical Theme) -->
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <!-- Top Right Cross subtle pattern -->
            <div class="absolute -top-40 -right-40 w-96 h-96 bg-ropanasuri-100 rounded-full mix-blend-multiply filter blur-3xl opacity-50 animate-blob"></div>
            <!-- Center Medical Green subtle glow -->
            <div class="absolute top-1/4 -left-20 w-72 h-72 bg-emerald-100 rounded-full mix-blend-multiply filter blur-3xl opacity-50 animate-blob animation-delay-2000"></div>
            <!-- Bottom Subtle Glow -->
            <div class="absolute top-2/3 right-1/4 w-80 h-80 bg-teal-50 rounded-full mix-blend-multiply filter blur-3xl opacity-50 animate-blob animation-delay-4000"></div>
        </div>
        
        <!-- Content Container -->
        <div class="relative max-w-[98%] mx-auto px-4 sm:px-6 lg:px-8 pt-2 pb-8 lg:pt-2 lg:pb-12">
            @yield('content')
        </div>
    </main>

    @if(!request()->routeIs('chat.index'))
    <!-- Footer Modern -->
    <footer class="relative bg-white/80 dark:bg-gray-900/80 backdrop-blur-sm border-t border-gray-100 dark:border-gray-800 mt-20 py-12">
        <div class="max-w-screen-2xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <!-- Brand Info -->
                <div class="col-span-1 md:col-span-2">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-gradient-to-br bg-white/70 to-amber-500 dark:bg-gray-700 dark:to-gray-800 rounded-2xl flex items-center justify-center text-white shadow-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <img src="{{ asset("images/airopanasuri.png") }}" alt="">                            </svg>
                        </div>
                        <span class="ml-3 font-bold text-lg text-gray-800 dark:text-gray-100">{{ __('messages.hospital_name') }}</span>
                    </div>
                    <p class="text-gray-600 dark:text-gray-400 text-sm leading-relaxed max-w-md">
                        {{ __('messages.hospital_desc') }}
                    </p>
                </div>
                
                <div>
                    <h3 class="font-semibold text-gray-800 dark:text-gray-200 mb-4 flex items-center"><i class="fas fa-stethoscope text-ropanasuri-500 mr-2"></i> {{ __('messages.services') }}</h3>
                    <ul class="space-y-2 text-sm text-gray-600 dark:text-gray-400">
                        <li><a href="#" class="hover:text-ropanasuri-600 dark:hover:text-ropanasuri-400 transition flex items-center"><i class="fas fa-user-md w-5 text-center text-gray-400"></i> {{ __('messages.doctor_schedule') }}</a></li>
                        <li><a href="#" class="hover:text-ropanasuri-600 dark:hover:text-ropanasuri-400 transition flex items-center"><i class="fas fa-laptop-medical w-5 text-center text-gray-400"></i> {{ __('messages.online_registration') }}</a></li>
                        <li><a href="#" class="hover:text-ropanasuri-600 dark:hover:text-ropanasuri-400 transition flex items-center"><i class="fas fa-headset w-5 text-center text-gray-400"></i> {{ __('messages.contact_us') }}</a></li>
                    </ul>
                </div>
                
                <div>
                    <h3 class="font-semibold text-gray-800 dark:text-gray-200 mb-4 flex items-center"><i class="fas fa-clock text-ropanasuri-500 mr-2"></i> {{ __('messages.operational_hours') }}</h3>
                    <ul class="space-y-3 text-sm text-gray-600 dark:text-gray-400">
                        <li class="flex items-start">
                            <div class="bg-red-50 dark:bg-red-900/30 text-red-500 dark:text-red-400 p-1.5 rounded-lg mr-3">
                                <i class="fas fa-ambulance"></i>
                            </div>
                            <div>
                                <span class="font-semibold text-gray-800 dark:text-gray-200 block">{{ __('messages.er_24_hours') }}</span>
                                <span class="text-xs">{{ __('messages.er_desc') }}</span>
                            </div>
                        </li>
                        <li class="flex items-start mt-3">
                            <div class="bg-ropanasuri-50 dark:bg-ropanasuri-900/30 text-ropanasuri-500 dark:text-ropanasuri-400 p-1.5 rounded-lg mr-3">
                                <i class="fas fa-clinic-medical"></i>
                            </div>
                            <div>
                                <span class="font-semibold text-gray-800 dark:text-gray-200 block">{{ __('messages.outpatient') }}</span>
                                <span class="text-xs">08.00 - 20.00 WIB</span>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            
            <div class="border-t border-gray-200 dark:border-gray-700 mt-8 pt-8 text-center">
                <p class="text-xs text-gray-500 dark:text-gray-400">
                    © {{ date('Y') }} {{ __('messages.copyright') }} Rumah Sakit Khusus Bedah Ropanasuri. 
                    <span class="block mt-1 text-ropanasuri-600 dark:text-ropanasuri-400 font-medium">"Profesional, Berintegritas, Responsif, dan Fokus Pada Keselamatan Pasien"</span>
                </p>
            </div>
        </div>
    </footer>
    @endif

    <!-- Mobile Menu Script -->
    <script>
        document.getElementById('mobile-menu-button')?.addEventListener('click', function() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        });

        // Theme Toggle Logic
        const themeToggleBtn = document.getElementById('theme-toggle');
        const darkIcon = document.getElementById('theme-toggle-dark-icon');
        const lightIcon = document.getElementById('theme-toggle-light-icon');

        // Initial icon state
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            lightIcon.classList.remove('hidden');
        } else {
            darkIcon.classList.remove('hidden');
        }

        themeToggleBtn.addEventListener('click', function() {
            // Toggle icons
            darkIcon.classList.toggle('hidden');
            lightIcon.classList.toggle('hidden');

            // Toggle theme
            if (localStorage.theme === 'dark') {
                document.documentElement.classList.remove('dark');
                localStorage.theme = 'light';
            } else {
                document.documentElement.classList.add('dark');
                localStorage.theme = 'dark';
            }
        });
    </script>
    
    @stack('scripts')
</body>
</html>