<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>@yield('title', 'Admin Panel') - Halo-Ropanasuri</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700|plus-jakarta-sans:600,700,800&display=swap" rel="stylesheet" />
    
    <!-- Scripts & Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Font Awesome 6 (Free) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    @stack('styles')
</head>
<body class="font-['Inter'] antialiased bg-gray-50">
    
    <div class="flex h-screen overflow-hidden">
        <!-- SIDEBAR - Fixed, tidak ikut scroll -->
        <div class="hidden md:flex md:flex-shrink-0">
            <div class="flex flex-col w-72 bg-gradient-to-b from-ropanasuri-800 to-ropanasuri-900 text-white">
                
                <!-- Logo Area -->
                <div class="flex items-center justify-center h-20 px-6 border-b border-ropanasuri-700/50">
                    <div class="flex items-center">
                        <div class="bg-white/20 backdrop-blur-sm p-2.5 rounded-2xl">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4.26 10.147a60.436 60.436 0 00-.656 8.348 60.437 60.437 0 018.348-.656 60.445 60.445 0 018.348.656 60.436 60.436 0 00-.656-8.348 60.443 60.443 0 00-7.692-3.975 60.44 60.44 0 00-7.692 3.975z" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <span class="font-['Plus_Jakarta_Sans'] font-extrabold text-lg tracking-tight">
                                Halo<span class="text-ropanasuri-300">Ropa</span>nāsuri
                            </span>
                            <span class="block text-xs text-ropanasuri-300 -mt-1">Admin Panel v1.0</span>
                        </div>
                    </div>
                </div>
                
                <!-- Admin Profile Summary -->
                {{-- <div class="px-6 py-5 border-b border-ropanasuri-700/50">
                    <div class="flex items-center">
                        <div class="bg-gradient-to-br from-ropanasuri-500 to-ropanasuri-600 p-2.5 rounded-2xl shadow-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-white">{{ Auth::user()->name ?? 'Admin' }}</p>
                            <p class="text-xs text-ropanasuri-300">{{ Auth::user()->email ?? 'admin@ropanasuri.id' }}</p>
                        </div>
                    </div>
                </div> --}}
                
                <!-- MAIN NAVIGATION -->
                <div class="flex-1 overflow-y-auto py-4 px-4">
                    <nav class="space-y-1">
                        
                        <!-- Group: Dashboard -->
                        <div class="mb-6">
                            <h3 class="px-3 text-xs font-semibold text-ropanasuri-300 uppercase tracking-wider">
                                Utama
                            </h3>
                            <div class="mt-2 space-y-1">
                                <a href="{{ route('admin.dashboard') }}" 
                                   class="flex items-center px-3 py-2.5 text-sm font-medium rounded-xl transition-all {{ request()->routeIs('admin.dashboard') ? 'bg-ropanasuri-700/80 text-white shadow-lg' : 'text-ropanasuri-100 hover:bg-ropanasuri-700/50 hover:text-white' }}">
                                    <i class="fas fa-chart-pie w-5 text-center mr-3"></i>
                                    Dashboard
                                </a>
                            </div>
                        </div>
                        
                        <!-- Group: Chat Management -->
                        <div class="mb-6">
                            <h3 class="px-3 text-xs font-semibold text-ropanasuri-300 uppercase tracking-wider">
                                Manajemen Chat AI
                            </h3>
                            <div class="mt-2 space-y-1">
                                <a href="{{ route('admin.faq.index') }}" 
                                   class="flex items-center px-3 py-2.5 text-sm font-medium rounded-xl transition-all {{ request()->routeIs('admin.faq.*') && !request()->routeIs('admin.faq.trash') ? 'bg-ropanasuri-700/80 text-white shadow-lg' : 'text-ropanasuri-100 hover:bg-ropanasuri-700/50 hover:text-white' }}">
                                    <i class="fas fa-question-circle w-5 text-center mr-3"></i>
                                    FAQ & Keywords
                                </a>
                                <a href="{{ route('admin.chat.logs') }}" 
                                   class="flex items-center px-3 py-2.5 text-sm font-medium rounded-xl transition-all {{ request()->routeIs('admin.chat.logs') ? 'bg-ropanasuri-700/80 text-white shadow-lg' : 'text-ropanasuri-100 hover:bg-ropanasuri-700/50 hover:text-white' }}">
                                    <i class="fas fa-history w-5 text-center mr-3"></i>
                                    Riwayat Chat
                                    <span class="ml-auto bg-ropanasuri-600 text-white px-2 py-0.5 rounded-full text-xs">
                                        {{ \App\Models\ChatLog::whereDate('created_at', today())->count() ?? 0 }}
                                    </span>
                                </a>
                                <a href="{{ route('admin.chat.unanswered') }}" 
                                   class="flex items-center px-3 py-2.5 text-sm font-medium rounded-xl transition-all {{ request()->routeIs('admin.chat.unanswered') ? 'bg-ropanasuri-700/80 text-white shadow-lg' : 'text-ropanasuri-100 hover:bg-ropanasuri-700/50 hover:text-white' }}">
                                    <i class="fas fa-question w-5 text-center mr-3"></i>
                                    Pertanyaan Baru
                                    @php
                                        $unansweredCount = \App\Models\ChatLog::where('status', 'not_found')->whereDate('created_at', today())->count();
                                    @endphp
                                    @if($unansweredCount > 0)
                                        <span class="ml-auto bg-red-500 text-white px-2 py-0.5 rounded-full text-xs">
                                            {{ $unansweredCount }}
                                        </span>
                                    @endif
                                </a>
                            </div>
                        </div>
                        
                        <!-- Group: Edukasi -->
                        <div class="mb-6">
                            <h3 class="px-3 text-xs font-semibold text-ropanasuri-300 uppercase tracking-wider">
                                Edukasi Pasien
                            </h3>
                            <div class="mt-2 space-y-1">
                                <a href="{{ route('admin.artikel.index') }}" 
                                   class="flex items-center px-3 py-2.5 text-sm font-medium rounded-xl transition-all {{ request()->routeIs('admin.artikel.*') ? 'bg-ropanasuri-700/80 text-white shadow-lg' : 'text-ropanasuri-100 hover:bg-ropanasuri-700/50 hover:text-white' }}">
                                    <i class="fas fa-book-medical w-5 text-center mr-3"></i>
                                    Semua Artikel
                                </a>
                                <a href="{{ route('admin.artikel.create') }}" 
                                   class="flex items-center px-3 py-2.5 text-sm font-medium rounded-xl transition-all text-ropanasuri-100 hover:bg-ropanasuri-700/50 hover:text-white">
                                    <i class="fas fa-plus-circle w-5 text-center mr-3"></i>
                                    Tulis Artikel
                                </a>
                                <a href="{{ route('admin.artikel.categories') }}" 
                                   class="flex items-center px-3 py-2.5 text-sm font-medium rounded-xl transition-all {{ request()->routeIs('admin.artikel.categories') ? 'bg-ropanasuri-700/80 text-white shadow-lg' : 'text-ropanasuri-100 hover:bg-ropanasuri-700/50 hover:text-white' }}">
                                    <i class="fas fa-tags w-5 text-center mr-3"></i>
                                    Kategori
                                </a>
                            </div>
                        </div>
                        
                        <!-- Group: Pengaturan -->
                        <div class="mb-6">
                            {{-- <h3 class="px-3 text-xs font-semibold text-ropanasuri-300 uppercase tracking-wider">
                                Pengaturan
                            </h3> --}}
                            {{-- <div class="mt-2 space-y-1">
                                <a href="{{ route('admin.settings') }}" 
                                   class="flex items-center px-3 py-2.5 text-sm font-medium rounded-xl transition-all {{ request()->routeIs('admin.settings') ? 'bg-ropanasuri-700/80 text-white shadow-lg' : 'text-ropanasuri-100 hover:bg-ropanasuri-700/50 hover:text-white' }}">
                                    <i class="fas fa-cog w-5 text-center mr-3"></i>
                                    Pengaturan AI
                                </a>
                                <a href="{{ route('admin.profile') }}" 
                                   class="flex items-center px-3 py-2.5 text-sm font-medium rounded-xl transition-all {{ request()->routeIs('admin.profile') ? 'bg-ropanasuri-700/80 text-white shadow-lg' : 'text-ropanasuri-100 hover:bg-ropanasuri-700/50 hover:text-white' }}">
                                    <i class="fas fa-user-cog w-5 text-center mr-3"></i>
                                    Profil Admin
                                </a>
                            </div> --}}
                        </div>
                    </nav>
                </div>
                
                <!-- Footer Sidebar - Logout -->
                <div class="border-t border-ropanasuri-700/50 p-4">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="flex items-center w-full px-3 py-2.5 text-sm font-medium text-ropanasuri-100 rounded-xl hover:bg-ropanasuri-700/50 hover:text-white transition-all">
                            <i class="fas fa-sign-out-alt w-5 text-center mr-3"></i>
                            Keluar
                        </button>
                    </form>
                </div>
            </div>
        </div>
        
        
        <!-- Mobile Sidebar Toggle -->
        <div class="md:hidden fixed top-0 left-0 z-50">
            <button id="mobile-sidebar-toggle" class="m-3 p-2.5 bg-ropanasuri-700 text-white rounded-xl shadow-lg">
                <i class="fas fa-bars text-xl"></i>
            </button>
        </div>
        
        <!-- Mobile Sidebar (Hidden by default) -->
        <div id="mobile-sidebar" class="fixed inset-0 z-40 hidden md:hidden">
            <div class="absolute inset-0 bg-gray-900 bg-opacity-50 backdrop-blur-sm" id="mobile-sidebar-overlay"></div>
            <div class="absolute left-0 top-0 h-full w-72 bg-gradient-to-b from-ropanasuri-800 to-ropanasuri-900 text-white transform transition-transform duration-300 ease-in-out">
                <!-- Copy sidebar content from above -->
                <div class="flex items-center justify-between h-20 px-6 border-b border-ropanasuri-700/50">
                    <div class="flex items-center">
                        <div class="bg-white/20 backdrop-blur-sm p-2.5 rounded-2xl">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4.26 10.147a60.436 60.436 0 00-.656 8.348 60.437 60.437 0 018.348-.656 60.445 60.445 0 018.348.656 60.436 60.436 0 00-.656-8.348 60.443 60.443 0 00-7.692-3.975 60.44 60.44 0 00-7.692 3.975z" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <span class="font-['Plus_Jakarta_Sans'] font-extrabold text-lg tracking-tight">
                                Halo<span class="text-ropanasuri-300">Ropa</span>nāsuri
                            </span>
                        </div>
                    </div>
                    <button id="mobile-sidebar-close" class="text-white/70 hover:text-white">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
                <!-- ... rest of sidebar content ... -->
            </div>
        </div>

        <!-- MAIN CONTENT AREA -->
        <div class="flex-1 flex flex-col overflow-y-auto bg-gray-50">
            
            <!-- Top Navigation -->
            <header class="bg-white shadow-sm border-b border-gray-200 sticky top-0 z-30">
                <div class="px-4 sm:px-6 lg:px-8 py-4">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <h1 class="text-2xl font-bold text-gray-800 font-['Plus_Jakarta_Sans']">
                                @yield('page-title', 'Dashboard')
                            </h1>
                            @hasSection('page-badge')
                                <span class="ml-3 px-2.5 py-1 bg-ropanasuri-100 text-ropanasuri-800 rounded-full text-xs font-medium">
                                    @yield('page-badge')
                                </span>
                            @endif
                        </div>
                        
                        <!-- Right Header Actions -->
                        <div class="flex items-center space-x-3">
                            @yield('header-actions')
                            
                            <!-- User Menu (Desktop) -->
                            <div class="hidden md:flex items-center">
                                <div class="text-right mr-3">
                                    <p class="text-sm font-medium text-gray-700">{{ Auth::user()->name ?? 'Admin' }}</p>
                                    <p class="text-xs text-gray-500">{{ Auth::user()->email ?? 'admin@ropanasuri.id' }}</p>
                                </div>
                                <div class="w-10 h-10 bg-gradient-to-br from-ropanasuri-500 to-ropanasuri-600 rounded-2xl flex items-center justify-center text-white shadow-md">
                                    <span class="font-bold text-lg">
                                        {{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Breadcrumbs -->
                    @hasSection('breadcrumbs')
                        <div class="mt-2 text-sm text-gray-500">
                            @yield('breadcrumbs')
                        </div>
                    @endif
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 px-4 sm:px-6 lg:px-8 py-8">
                @yield('content')
            </main>
            
            <!-- Footer -->
            <footer class="bg-white border-t border-gray-200 px-4 sm:px-6 lg:px-8 py-4 text-center text-xs text-gray-500">
                <p>© {{ date('Y') }} Rumah Sakit Ropanāsuri. Admin Panel v1.0</p>
            </footer>
        </div>
    </div>

    <!-- Mobile Sidebar Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toggleBtn = document.getElementById('mobile-sidebar-toggle');
            const closeBtn = document.getElementById('mobile-sidebar-close');
            const overlay = document.getElementById('mobile-sidebar-overlay');
            const sidebar = document.getElementById('mobile-sidebar');
            
            if (toggleBtn && sidebar) {
                toggleBtn.addEventListener('click', function() {
                    sidebar.classList.remove('hidden');
                });
            }
            
            if (closeBtn && sidebar) {
                closeBtn.addEventListener('click', function() {
                    sidebar.classList.add('hidden');
                });
            }
            
            if (overlay && sidebar) {
                overlay.addEventListener('click', function() {
                    sidebar.classList.add('hidden');
                });
            }
        });
    </script>
    
    @stack('scripts')
</body>
</html>