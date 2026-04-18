<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login - Sistem Nilai Mahasiswa</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        * {
            font-family: 'Poppins', sans-serif;
        }
        
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            padding: 20px;
        }
        
        .login-container {
            max-width: 1200px;
            margin: 0 auto;
            width: 100%;
        }
        
        .login-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            overflow: hidden;
            min-height: 600px;
        }
        
        .login-left {
            background: linear-gradient(135deg, #2c3e50 0%, #3498db 100%);
            color: white;
            padding: 60px 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            height: 100%;
        }
        
        .login-right {
            padding: 60px 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            height: 100%;
        }
        
        .university-logo {
            width: 100px;
            height: 100px;
            background: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 30px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }
        
        .university-logo i {
            font-size: 40px;
            color: #3498db;
        }
        
        .university-name {
            font-size: 24px;
            font-weight: 700;
            text-align: center;
            margin-bottom: 10px;
        }
        
        .system-name {
            font-size: 28px;
            font-weight: 800;
            text-align: center;
            margin-bottom: 30px;
            background: linear-gradient(90deg, #00b09b, #96c93d);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .welcome-text {
            font-size: 18px;
            text-align: center;
            opacity: 0.9;
            margin-bottom: 40px;
        }
        
        .features-list {
            list-style: none;
            padding: 0;
        }
        
        .features-list li {
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 15px;
        }
        
        .feature-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(255,255,255,0.1);
        }
        
        .login-title {
            font-size: 32px;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 10px;
        }
        
        .login-subtitle {
            color: #6c757d;
            margin-bottom: 40px;
        }
        
        .form-group {
            margin-bottom: 25px;
        }
        
        .form-label {
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 8px;
        }
        
        .form-control {
            padding: 15px;
            border-radius: 10px;
            border: 2px solid #e9ecef;
            font-size: 16px;
            transition: all 0.3s;
        }
        
        .form-control:focus {
            border-color: #3498db;
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.1);
        }
        
        .input-group {
            position: relative;
        }
        
        .input-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #6c757d;
            z-index: 4;
        }
        
        .input-icon + .form-control {
            padding-left: 45px;
        }
        
        .btn-login {
            background: linear-gradient(135deg, #3498db, #2980b9);
            color: white;
            border: none;
            padding: 15px;
            border-radius: 10px;
            font-weight: 600;
            font-size: 16px;
            width: 100%;
            transition: all 0.3s;
            margin-top: 10px;
        }
        
        .btn-login:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(52, 152, 219, 0.3);
        }
        
        .forgot-password {
            text-align: center;
            margin-top: 20px;
        }
        
        .forgot-password a {
            color: #3498db;
            text-decoration: none;
            font-weight: 500;
        }
        
        .back-to-home {
            text-align: center;
            margin-top: 30px;
        }
        
        .back-to-home a {
            color: #6c757d;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        
        .error-message {
            color: #e74c3c;
            font-size: 14px;
            margin-top: 5px;
        }
        
        .alert {
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 25px;
        }
        
        /* Responsive */
        @media (max-width: 992px) {
            .login-left {
                padding: 40px 30px;
            }
            
            .login-right {
                padding: 40px 30px;
            }
        }
        
        @media (max-width: 768px) {
            body {
                padding: 10px;
            }
            
            .login-card {
                min-height: auto;
            }
            
            .login-left {
                padding: 40px 20px;
            }
            
            .login-right {
                padding: 40px 20px;
            }
            
            .login-title {
                font-size: 28px;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-card">
            <div class="row g-0">
                <!-- Left Side - Info -->
                <div class="col-lg-6">
                    <div class="login-left">
                        <div class="university-logo">
                            <i class="fas fa-graduation-cap"></i>
                        </div>
                        
                        <h1 class="university-name">Universitas Saintek Muhammadiyah</h1>
                        <h2 class="system-name">SISTEM INFORMASI NILAI MAHASISWA</h2>
                        
                        <p class="welcome-text">
                            Selamat datang di sistem pengelolaan nilai akademik terintegrasi
                        </p>
                        
                        <ul class="features-list">
                            <li>
                                <div class="feature-icon">
                                    <i class="fas fa-shield-alt"></i>
                                </div>
                                <span>Sistem keamanan terenkripsi untuk data sensitif</span>
                            </li>
                            <li>
                                <div class="feature-icon">
                                    <i class="fas fa-bolt"></i>
                                </div>
                                <span>Proses cepat dan real-time update data</span>
                            </li>
                            <li>
                                <div class="feature-icon">
                                    <i class="fas fa-chart-pie"></i>
                                </div>
                                <span>Analisis dan laporan data yang komprehensif</span>
                            </li>
                            <li>
                                <div class="feature-icon">
                                    <i class="fas fa-mobile-alt"></i>
                                </div>
                                <span>Akses mudah dari berbagai perangkat</span>
                            </li>
                        </ul>
                    </div>
                </div>
                
                <!-- Right Side - Login Form -->
                <div class="col-lg-6">
                    <div class="login-right">
                        <h2 class="login-title">Masuk ke Akun Anda</h2>
                        <p class="login-subtitle">Silakan masukkan email dan password untuk mengakses sistem</p>
                        
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            
                            <div class="form-group">
                                <label for="email" class="form-label">Alamat Email</label>
                                <div class="input-group">
                                    <span class="input-icon">
                                        <i class="fas fa-envelope"></i>
                                    </span>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" 
                                           name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                                           placeholder="email@universitas.ac.id">
                                </div>
                                @error('email')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="form-group">
                                <label for="password" class="form-label">Password</label>
                                <div class="input-group">
                                    <span class="input-icon">
                                        <i class="fas fa-lock"></i>
                                    </span>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" 
                                           name="password" required autocomplete="current-password"
                                           placeholder="Masukkan password">
                                </div>
                                @error('password')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="form-group">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="remember">
                                        Ingat Saya
                                    </label>
                                </div>
                            </div>
                            
                            <button type="submit" class="btn btn-login">
                                <i class="fas fa-sign-in-alt"></i> Masuk ke Sistem
                            </button>
                            
                            @if (Route::has('password.request'))
                                <div class="forgot-password">
                                    <a href="{{ route('password.request') }}">
                                        <i class="fas fa-key"></i> Lupa Password?
                                    </a>
                                </div>
                            @endif
                        </form>
                        
                        @if (Route::has('register'))
                            <div class="text-center mt-4">
                                <p class="text-muted">
                                    Belum memiliki akun? 
                                    <a href="{{ route('register') }}" class="text-primary fw-bold">Daftar disini</a>
                                </p>
                            </div>
                        @endif
                        
                        <div class="back-to-home">
                            <a href="{{ url('/') }}">
                                <i class="fas fa-arrow-left"></i> Kembali ke Halaman Utama
                            </a>
                        </div>
                        
                        <!-- Demo Accounts Info -->
                        <div class="mt-4 p-3 bg-light rounded">
                            <small class="text-muted d-block mb-1">
                                <i class="fas fa-info-circle"></i> <strong>Akun Demo:</strong>
                            </small>
                            <small class="text-muted">
                                Admin: admin@nilai.com / admin123
                            </small><br>
                            <small class="text-muted">
                                User: user@nilai.com / user123
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Auto focus on email field
            document.getElementById('email').focus();
            
            // Show welcome message for first-time visitors
            if (!localStorage.getItem('loginVisited')) {
                setTimeout(() => {
                    Swal.fire({
                        title: 'Selamat Datang!',
                        text: 'Gunakan akun demo untuk mencoba sistem',
                        icon: 'info',
                        timer: 3000,
                        showConfirmButton: false
                    });
                    localStorage.setItem('loginVisited', 'true');
                }, 1000);
            }
        });
    </script>
</body>
</html>