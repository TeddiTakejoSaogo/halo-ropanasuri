<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>Login Admin - Halo-Ropanasuri</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700|plus-jakarta-sans:600,700,800&display=swap" rel="stylesheet" />
    
    <!-- Scripts & Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <style>
        .login-gradient {
            background: linear-gradient(135deg, #f0f9ff 0%, #e6f2ff 50%, #ffffff 100%);
        }
        .login-card {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.95);
        }
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
            100% { transform: translateY(0px); }
        }
        .float-animation {
            animation: float 6s ease-in-out infinite;
        }
    </style>
</head>
<body class="font-['Inter'] antialiased login-gradient min-h-screen flex items-center justify-center p-4">
    
    <!-- Background Decorative Elements -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none">
        <div class="absolute -top-40 -right-40 w-80 h-80 bg-ropanasuri-200 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob"></div>
        <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-blue-200 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob animation-delay-2000"></div>
        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-80 h-80 bg-teal-200 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-4000"></div>
    </div>
    
    <!-- Login Card -->
    <div class="relative w-full max-w-md">
        <!-- Logo & Brand -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center mb-4">
                <div class="w-20 h-20 bg-gradient-to-br bg-white/70 to-amber-500 rounded-2xl flex items-center justify-center text-white shadow-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <img src="{{ asset("images/airopanasuri.png") }}" alt="">                            
                    </svg>
                </div>
            </div>
            <h1 class="font-['Plus_Jakarta_Sans'] font-extrabold text-3xl text-gray-800">
                Halo<span class="text-ropanasuri-600">Ropa</span>nasuri
            </h1>
            <p class="text-gray-600 mt-2 text-sm">Admin Panel • Rumah Sakit Ropanasuri</p>
        </div>
        
        <!-- Card Login -->
        <div class="login-card rounded-3xl shadow-2xl p-8 border border-white/50">
            
            <!-- Alert Error -->
            @if($errors->any())
            <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4 rounded-r-xl">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <i class="fas fa-exclamation-circle text-red-500"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-red-700">
                            {{ $errors->first() }}
                        </p>
                    </div>
                </div>
            </div>
            @endif
            
            <!-- Session Status -->
            @if(session('status'))
            <div class="mb-6 bg-green-50 border-l-4 border-green-500 p-4 rounded-r-xl">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <i class="fas fa-check-circle text-green-500"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-green-700">
                            {{ session('status') }}
                        </p>
                    </div>
                </div>
            </div>
            @endif
            
            <!-- Form Login -->
            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf
                
                <!-- Email Field -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-envelope mr-2 text-ropanasuri-500"></i>
                        Email Admin
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                            <i class="fas fa-envelope text-gray-400"></i>
                        </div>
                        <input type="email" name="email" value="{{ old('email') }}" 
                               class="block w-full pl-10 pr-3 py-3.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-ropanasuri-500 focus:border-ropanasuri-500 transition bg-white/50"
                               placeholder="admin@ropanasuri.id"
                               required autofocus>
                    </div>
                </div>
                
                <!-- Password Field -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-lock mr-2 text-ropanasuri-500"></i>
                        Password
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                            <i class="fas fa-lock text-gray-400"></i>
                        </div>
                        <input type="password" name="password" 
                               class="block w-full pl-10 pr-12 py-3.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-ropanasuri-500 focus:border-ropanasuri-500 transition bg-white/50"
                               placeholder="••••••••"
                               required>
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                            <button type="button" onclick="togglePassword()" class="text-gray-400 hover:text-gray-600 focus:outline-none">
                                <i class="fas fa-eye" id="eye-icon"></i>
                            </button>
                        </div>
                    </div>
                </div>
                
                <!-- Remember Me & Forgot Password (Hidden) -->
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input type="checkbox" name="remember" id="remember" 
                               class="h-4 w-4 text-ropanasuri-600 focus:ring-ropanasuri-500 border-gray-300 rounded">
                        <label for="remember" class="ml-2 block text-sm text-gray-700">
                            Ingat saya
                        </label>
                    </div>
                    
                    <!-- Forgot password link dihapus karena tidak perlu -->
                    <div></div>
                </div>
                
                <!-- Info Akun Default -->
                {{-- <div class="bg-blue-50/80 border border-blue-100 rounded-xl p-4">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <i class="fas fa-info-circle text-blue-600 mt-0.5"></i>
                        </div>
                        <div class="ml-3 text-xs">
                            <p class="text-blue-800 font-medium">Akun Admin Default:</p>
                            <p class="text-blue-700 mt-1 font-mono text-xs bg-blue-100/50 p-1.5 rounded">
                                Email: <span class="font-bold">admin@ropanasuri.id</span><br>
                                Password: <span class="font-bold">ropanasuri2025</span>
                            </p>
                            <p class="text-blue-600 mt-2 italic">
                                * Segera ganti password setelah login pertama
                            </p>
                        </div>
                    </div>
                </div> --}}
                
                <!-- Submit Button -->
                <button type="submit" 
                        class="w-full bg-gradient-to-r from-ropanasuri-600 to-ropanasuri-500 text-white py-3.5 px-4 rounded-xl hover:from-ropanasuri-700 hover:to-ropanasuri-600 transition-all duration-300 transform hover:-translate-y-0.5 shadow-lg hover:shadow-xl flex items-center justify-center font-medium text-base">
                    <i class="fas fa-sign-in-alt mr-2"></i>
                    Masuk ke Admin Panel
                </button>
            </form>
            
            <!-- Footer -->
            <div class="mt-8 text-center border-t border-gray-100 pt-6">
                <p class="text-xs text-gray-500">
                    <i class="fas fa-shield-alt mr-1 text-ropanasuri-400"></i>
                    Sistem aman & terenkripsi • Hanya untuk admin RS Ropanasuri
                </p>
                <p class="text-xs text-gray-400 mt-2">
                    © {{ date('Y') }} Rumah Sakit Ropanasuri
                </p>
            </div>
        </div>
        
        <!-- Back to Chat Link -->
        <div class="text-center mt-6">
            <a href="{{ route('chat.index') }}" class="text-sm text-gray-600 hover:text-ropanasuri-600 transition inline-flex items-center">
                <i class="fas fa-arrow-left mr-2"></i>
                Kembali ke Halaman Chat
            </a>
        </div>
    </div>
    
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
    </style>
    
    <script>
        function togglePassword() {
            const password = document.querySelector('input[name="password"]');
            const eye = document.getElementById('eye-icon');
            
            if (password.type === 'password') {
                password.type = 'text';
                eye.classList.remove('fa-eye');
                eye.classList.add('fa-eye-slash');
            } else {
                password.type = 'password';
                eye.classList.remove('fa-eye-slash');
                eye.classList.add('fa-eye');
            }
        }
    </script>
</body>
</html>