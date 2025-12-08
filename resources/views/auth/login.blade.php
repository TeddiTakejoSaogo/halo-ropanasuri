<!DOCTYPE html>
<html lang="id" class="h-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Admin Login - Rumah Sakit Sehat Sentosa">
    <title>Admin Login | RSKB ROPANASURI</title>
    
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary-color: #11b9ec;
            --secondary-color: #3a0ca3;
            --success-color: #4cc9f0;
            --dark-color: #1a1a2e;
            --light-color: #f8f9fa;
            --gradient-primary: linear-gradient(135deg, #3fcefa 0%, #9edcf3 100%);
            --gradient-secondary: linear-gradient(135deg, #7209b7 0%, #3a0ca3 100%);
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        
        .login-container {
            max-width: 1200px;
            width: 100%;
            margin: 0 auto;
        }
        
        .login-card {
            background: white;
            border-radius: 24px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            display: flex;
            min-height: 600px;
        }
        
        .login-left {
            flex: 1;
            background: var(--gradient-primary);
            padding: 60px 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            color: white;
            position: relative;
            overflow: hidden;
        }
        
        .login-left::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -20%;
            width: 400px;
            height: 400px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
        }
        
        .login-left::after {
            content: '';
            position: absolute;
            bottom: -30%;
            left: -20%;
            width: 300px;
            height: 300px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 50%;
        }
        
        .login-right {
            flex: 1;
            padding: 60px 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        
        .hospital-logo {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 20px;
            z-index: 1;
            position: relative;
        }
        
        .hospital-logo i {
            margin-right: 15px;
            background: rgba(255, 255, 255, 0.2);
            padding: 15px;
            border-radius: 15px;
        }
        
        .welcome-text {
            font-size: 2.8rem;
            font-weight: 700;
            line-height: 1.2;
            margin-bottom: 15px;
            z-index: 1;
            position: relative;
        }
        
        .subtitle {
            font-size: 1.1rem;
            opacity: 0.9;
            margin-bottom: 30px;
            z-index: 1;
            position: relative;
        }
        
        .features-list {
            list-style: none;
            padding: 0;
            margin: 40px 0;
            z-index: 1;
            position: relative;
        }
        
        .features-list li {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
            font-size: 1rem;
        }
        
        .features-list i {
            background: rgba(255, 255, 255, 0.2);
            padding: 10px;
            border-radius: 10px;
            margin-right: 15px;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .login-header {
            text-align: center;
            margin-bottom: 40px;
        }
        
        .login-title {
            font-size: 2rem;
            font-weight: 700;
            color: var(--dark-color);
            margin-bottom: 10px;
        }
        
        .login-subtitle {
            color: #6c757d;
            font-size: 1rem;
        }
        
        .form-group {
            margin-bottom: 25px;
            position: relative;
        }
        
        .form-label {
            font-weight: 600;
            color: var(--dark-color);
            margin-bottom: 8px;
            display: block;
            font-size: 0.9rem;
        }
        
        .input-group {
            position: relative;
        }
        
        .form-control {
            padding: 15px 20px 15px 50px;
            border: 2px solid #e9ecef;
            border-radius: 12px;
            font-size: 1rem;
            transition: all 0.3s ease;
            height: 55px;
        }
        
        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.1);
            outline: none;
        }
        
        .input-icon {
            position: absolute;
            left: 20px;
            top: 50%;
            transform: translateY(-50%);
            color: #6c757d;
            font-size: 1.1rem;
            z-index: 2;
        }
        
        .password-toggle {
            position: absolute;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #6c757d;
            cursor: pointer;
            z-index: 2;
        }
        
        .form-check {
            display: flex;
            align-items: center;
            margin-bottom: 25px;
        }
        
        .form-check-input {
            margin-right: 10px;
            width: 18px;
            height: 18px;
            cursor: pointer;
        }
        
        .form-check-input:checked {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        .form-check-label {
            color: #6c757d;
            font-size: 0.9rem;
            cursor: pointer;
        }
        
        .btn-login {
            background: var(--gradient-primary);
            color: white;
            border: none;
            padding: 16px;
            border-radius: 12px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            margin-bottom: 20px;
        }
        
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(67, 97, 238, 0.3);
        }
        
        .btn-login:active {
            transform: translateY(0);
        }
        
        .alert {
            border-radius: 12px;
            padding: 15px 20px;
            margin-bottom: 25px;
            border: none;
        }
        
        .alert-danger {
            background: #ffe6e6;
            color: #dc3545;
            border-left: 4px solid #dc3545;
        }
        
        .alert-danger i {
            margin-right: 10px;
        }
        
        .login-footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #e9ecef;
            color: #6c757d;
            font-size: 0.9rem;
        }
        
        .copyright {
            margin-top: 20px;
            font-size: 0.8rem;
            opacity: 0.7;
        }
        
        .error-message {
            color: #dc3545;
            font-size: 0.85rem;
            margin-top: 5px;
            display: flex;
            align-items: center;
            gap: 5px;
        }
        
        /* Animations */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .fade-in {
            animation: fadeIn 0.6s ease forwards;
        }
        
        .delay-1 { animation-delay: 0.2s; opacity: 0; }
        .delay-2 { animation-delay: 0.4s; opacity: 0; }
        .delay-3 { animation-delay: 0.6s; opacity: 0; }
        
        /* Responsive Design */
        @media (max-width: 992px) {
            .login-card {
                flex-direction: column;
                min-height: auto;
            }
            
            .login-left {
                padding: 40px 20px;
                text-align: center;
            }
            
            .login-right {
                padding: 40px 20px;
            }
            
            .welcome-text {
                font-size: 2.2rem;
            }
        }
        
        @media (max-width: 576px) {
            .login-container {
                padding: 10px;
            }
            
            .login-card {
                border-radius: 16px;
            }
            
            .welcome-text {
                font-size: 1.8rem;
            }
            
            .login-title {
                font-size: 1.6rem;
            }
        }
        
        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }
        
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }
        
        ::-webkit-scrollbar-thumb {
            background: var(--primary-color);
            border-radius: 10px;
        }
        
        ::-webkit-scrollbar-thumb:hover {
            background: var(--secondary-color);
        }
        
        /* Loading Animation */
        .spinner-border {
            width: 1.2rem;
            height: 1.2rem;
            border-width: 0.2em;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-card">
            <!-- Left Panel - Branding & Info -->
            <div class="login-left">
                <img src="{{ asset('storage/' . $hospitalProfile->logo) }}" 
                                alt="{{ $hospitalProfile->name }}" 
                                class="img-fluid rounded" 
                                style="width: 200px; height: 200px; object-fit;">
                <h1 class="welcome-text fade-in delay-1">
                    Sistem Administrasi<br>Rumah Sakit
                </h1>
                
                <p class="subtitle fade-in delay-1">
                    Akses dashboard admin untuk mengelola website rumah sakit secara profesional dan aman.
                </p>
                
                <ul class="features-list fade-in delay-2">
                    <li>
                        <i class="fas fa-shield-alt"></i>
                        <span>Keamanan Terenkripsi</span>
                    </li>
                    <li>
                        <i class="fas fa-tachometer-alt"></i>
                        <span>Dashboard Real-time</span>
                    </li>
                    <li>
                        <i class="fas fa-users-cog"></i>
                        <span>Manajemen Pengguna</span>
                    </li>
                    <li>
                        <i class="fas fa-chart-line"></i>
                        <span>Analytics Lengkap</span>
                    </li>
                </ul>
            </div>
            
            <!-- Right Panel - Login Form -->
            <div class="login-right">
                <div class="login-header fade-in">
                    <h2 class="login-title">Masuk ke Dashboard</h2>
                    <p class="login-subtitle">Silakan masuk dengan akun admin Anda</p>
                </div>
                
                @if($errors->any())
                    <div class="alert alert-danger fade-in delay-1">
                        <i class="fas fa-exclamation-triangle"></i>
                        {{ $errors->first() }}
                    </div>
                @endif
                
                <form method="POST" action="{{ route('login') }}" id="loginForm" class="fade-in delay-2">
                    @csrf
                    
                    <div class="form-group">
                        <label for="email" class="form-label">Email Admin</label>
                        <div class="input-group">
                            <i class="input-icon fas fa-envelope"></i>
                            <input type="email" 
                                   id="email" 
                                   name="email" 
                                   class="form-control" 
                                   value="{{ old('email') }}" 
                                   placeholder="admin@admin.com"
                                   required
                                   autocomplete="email"
                                   autofocus>
                        </div>
                        @error('email')
                            <div class="error-message">
                                <i class="fas fa-exclamation-circle"></i>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="password" class="form-label">Password</label>
                        <div class="input-group">
                            <i class="input-icon fas fa-lock"></i>
                            <input type="password" 
                                   id="password" 
                                   name="password" 
                                   class="form-control" 
                                   placeholder="••••••••"
                                   required
                                   autocomplete="current-password">
                            <button type="button" class="password-toggle" id="togglePassword">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                        @error('password')
                            <div class="error-message">
                                <i class="fas fa-exclamation-circle"></i>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    
                    <div class="form-check">
                        <input class="form-check-input" 
                               type="checkbox" 
                               name="remember" 
                               id="remember" 
                               {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label" for="remember">
                            Ingat Saya
                        </label>
                    </div>
                    
                    <button type="submit" class="btn-login" id="loginButton">
                        <span id="buttonText">Masuk ke Dashboard</span>
                        <i class="fas fa-sign-in-alt"></i>
                    </button>
                    
                    <div class="login-footer">
                        <p>
                            <i class="fas fa-info-circle me-2"></i>
                            Untuk masalah akses, hubungi administrator sistem
                        </p>
                        <div class="copyright">
                            &copy; {{ date('Y') }} Rumah Sakit Khusus Bedah Ropanasuri. All rights reserved.
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Password toggle functionality
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');
        const passwordIcon = togglePassword.querySelector('i');
        
        togglePassword.addEventListener('click', function() {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            passwordIcon.className = type === 'password' ? 'fas fa-eye' : 'fas fa-eye-slash';
        });
        
        // Form submission with loading state
        const loginForm = document.getElementById('loginForm');
        const loginButton = document.getElementById('loginButton');
        const buttonText = document.getElementById('buttonText');
        
        loginForm.addEventListener('submit', function(e) {
            // Only show loading if form is valid
            if (loginForm.checkValidity()) {
                loginButton.disabled = true;
                buttonText.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Memproses...';
                loginButton.style.opacity = '0.8';
                
                // Simulate minimum loading time for better UX
                setTimeout(() => {
                    if (loginButton.disabled) {
                        loginButton.disabled = false;
                        buttonText.textContent = 'Masuk ke Dashboard';
                        loginButton.style.opacity = '1';
                    }
                }, 2000);
            }
        });
        
        // Add input validation styles
        const inputs = document.querySelectorAll('.form-control');
        inputs.forEach(input => {
            input.addEventListener('blur', function() {
                if (this.value.trim() !== '') {
                    this.classList.add('is-valid');
                    this.classList.remove('is-invalid');
                } else {
                    this.classList.remove('is-valid');
                }
            });
            
            input.addEventListener('input', function() {
                if (this.value.trim() !== '') {
                    this.classList.remove('is-invalid');
                }
            });
        });
        
        // Auto-focus email field
        document.getElementById('email')?.focus();
        
        // Add floating label effect
        const formGroups = document.querySelectorAll('.form-group');
        formGroups.forEach(group => {
            const input = group.querySelector('.form-control');
            const label = group.querySelector('.form-label');
            
            if (input && label) {
                input.addEventListener('focus', () => {
                    label.style.color = 'var(--primary-color)';
                    label.style.fontWeight = '600';
                });
                
                input.addEventListener('blur', () => {
                    if (!input.value) {
                        label.style.color = '';
                        label.style.fontWeight = '';
                    }
                });
            }
        });
        
        // Smooth transitions
        document.body.style.opacity = '0';
        document.body.style.transition = 'opacity 0.5s ease';
        
        setTimeout(() => {
            document.body.style.opacity = '1';
        }, 100);
        
        // Add particles effect for modern look
        const leftPanel = document.querySelector('.login-left');
        if (leftPanel) {
            for (let i = 0; i < 15; i++) {
                const particle = document.createElement('div');
                particle.style.position = 'absolute';
                particle.style.width = Math.random() * 5 + 2 + 'px';
                particle.style.height = particle.style.width;
                particle.style.background = 'rgba(255, 255, 255, 0.3)';
                particle.style.borderRadius = '50%';
                particle.style.left = Math.random() * 100 + '%';
                particle.style.top = Math.random() * 100 + '%';
                particle.style.zIndex = '0';
                leftPanel.appendChild(particle);
            }
        }
        
        // Enter key submits form
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Enter' && !loginButton.disabled) {
                if (document.activeElement.tagName !== 'TEXTAREA') {
                    loginForm.requestSubmit();
                }
            }
        });
    });
    
    // Handle browser autofill
    window.addEventListener('pageshow', function() {
        const emailInput = document.getElementById('email');
        const passwordInput = document.getElementById('password');
        
        if (emailInput?.value) {
            emailInput.classList.add('is-valid');
        }
        
        if (passwordInput?.value) {
            passwordInput.classList.add('is-valid');
        }
    });
    </script>
</body>
</html>