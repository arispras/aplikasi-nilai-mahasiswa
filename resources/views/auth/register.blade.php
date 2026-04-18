<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registrasi - Sistem Nilai Mahasiswa</title>
    
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
        
        .register-container {
            max-width: 1000px;
            margin: 0 auto;
            width: 100%;
        }
        
        .register-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            overflow: hidden;
            min-height: 700px;
        }
        
        .register-left {
            background: linear-gradient(135deg, #2c3e50 0%, #3498db 100%);
            color: white;
            padding: 60px 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            height: 100%;
        }
        
        .register-right {
            padding: 60px 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            height: 100%;
        }
        
        .university-logo {
            width: 80px;
            height: 80px;
            background: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }
        
        .university-logo i {
            font-size: 35px;
            color: #3498db;
        }
        
        .university-name {
            font-size: 22px;
            font-weight: 700;
            text-align: center;
            margin-bottom: 10px;
        }
        
        .system-name {
            font-size: 24px;
            font-weight: 800;
            text-align: center;
            margin-bottom: 30px;
            background: linear-gradient(90deg, #00b09b, #96c93d);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .register-title {
            font-size: 32px;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 10px;
        }
        
        .register-subtitle {
            color: #6c757d;
            margin-bottom: 30px;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-label {
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 8px;
            font-size: 14px;
        }
        
        .form-control {
            padding: 12px 15px;
            border-radius: 10px;
            border: 2px solid #e9ecef;
            font-size: 15px;
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
        
        .btn-register {
            background: linear-gradient(135deg, #00b09b, #96c93d);
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
        
        .btn-register:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(0, 176, 155, 0.3);
        }
        
        .back-to-login {
            text-align: center;
            margin-top: 25px;
        }
        
        .back-to-login a {
            color: #6c757d;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        
        .error-message {
            color: #e74c3c;
            font-size: 13px;
            margin-top: 5px;
        }
        
        .alert {
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 25px;
        }
        
        .password-strength {
            margin-top: 5px;
            height: 5px;
            border-radius: 3px;
            background: #e9ecef;
            overflow: hidden;
        }
        
        .strength-bar {
            height: 100%;
            width: 0%;
            transition: width 0.3s;
            border-radius: 3px;
        }
        
        .strength-weak { background: #e74c3c; }
        .strength-medium { background: #f39c12; }
        .strength-strong { background: #27ae60; }
        
        .strength-text {
            font-size: 12px;
            margin-top: 5px;
            color: #6c757d;
        }
        
        /* Responsive */
        @media (max-width: 992px) {
            .register-left {
                padding: 40px 30px;
            }
            
            .register-right {
                padding: 40px 30px;
            }
        }
        
        @media (max-width: 768px) {
            body {
                padding: 10px;
            }
            
            .register-card {
                min-height: auto;
            }
            
            .register-left {
                padding: 40px 20px;
            }
            
            .register-right {
                padding: 40px 20px;
            }
            
            .register-title {
                font-size: 28px;
            }
        }
    </style>
</head>
<body>
    <div class="register-container">
        <div class="register-card">
            <div class="row g-0">
                <!-- Left Side - Info -->
                <div class="col-lg-5">
                    <div class="register-left">
                        <div class="university-logo">
                            <i class="fas fa-graduation-cap"></i>
                        </div>
                        
                        <h1 class="university-name">UNIVERSITAS TEKNOLOGI INDONESIA</h1>
                        <h2 class="system-name">SISTEM INFORMASI NILAI MAHASISWA</h2>
                        
                        <div class="mt-4">
                            <h4 class="mb-3">Keuntungan Bergabung:</h4>
                            <ul class="list-unstyled">
                                <li class="mb-3">
                                    <i class="fas fa-check-circle text-success me-2"></i>
                                    Akses data nilai real-time
                                </li>
                                <li class="mb-3">
                                    <i class="fas fa-check-circle text-success me-2"></i>
                                    Transkrip nilai otomatis
                                </li>
                                <li class="mb-3">
                                    <i class="fas fa-check-circle text-success me-2"></i>
                                    Laporan akademik lengkap
                                </li>
                                <li class="mb-3">
                                    <i class="fas fa-check-circle text-success me-2"></i>
                                    Notifikasi penting
                                </li>
                                <li>
                                    <i class="fas fa-check-circle text-success me-2"></i>
                                    Support 24/7
                                </li>
                            </ul>
                        </div>
                        
                        <div class="mt-5">
                            <p class="text-center mb-0">
                                <small>
                                    Sudah memiliki akun?<br>
                                    <a href="{{ route('login') }}" class="text-white fw-bold">
                                        Login disini <i class="fas fa-arrow-right ms-1"></i>
                                    </a>
                                </small>
                            </p>
                        </div>
                    </div>
                </div>
                
                <!-- Right Side - Register Form -->
                <div class="col-lg-7">
                    <div class="register-right">
                        <h2 class="register-title">Buat Akun Baru</h2>
                        <p class="register-subtitle">Daftarkan diri Anda untuk mengakses sistem pengelolaan nilai</p>
                        
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name" class="form-label">Nama Lengkap *</label>
                                        <div class="input-group">
                                            <span class="input-icon">
                                                <i class="fas fa-user"></i>
                                            </span>
                                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" 
                                                   name="name" value="{{ old('name') }}" required autocomplete="name" autofocus
                                                   placeholder="Nama lengkap">
                                        </div>
                                        @error('name')
                                            <div class="error-message">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email" class="form-label">Alamat Email *</label>
                                        <div class="input-group">
                                            <span class="input-icon">
                                                <i class="fas fa-envelope"></i>
                                            </span>
                                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" 
                                                   name="email" value="{{ old('email') }}" required autocomplete="email"
                                                   placeholder="email@universitas.ac.id">
                                        </div>
                                        @error('email')
                                            <div class="error-message">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="password" class="form-label">Password *</label>
                                        <div class="input-group">
                                            <span class="input-icon">
                                                <i class="fas fa-lock"></i>
                                            </span>
                                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" 
                                                   name="password" required autocomplete="new-password"
                                                   placeholder="Minimal 8 karakter">
                                        </div>
                                        <div class="password-strength">
                                            <div class="strength-bar" id="strengthBar"></div>
                                        </div>
                                        <div class="strength-text" id="strengthText">Kekuatan password</div>
                                        @error('password')
                                            <div class="error-message">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="password-confirm" class="form-label">Konfirmasi Password *</label>
                                        <div class="input-group">
                                            <span class="input-icon">
                                                <i class="fas fa-lock"></i>
                                            </span>
                                            <input id="password-confirm" type="password" class="form-control" 
                                                   name="password_confirmation" required autocomplete="new-password"
                                                   placeholder="Ulangi password">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <div class="form-check">
                                    <input class="form-check-input @error('terms') is-invalid @enderror" type="checkbox" name="terms" id="terms" required>
                                    <label class="form-check-label" for="terms">
                                        Saya setuju dengan 
                                        <a href="#" class="text-primary">Syarat & Ketentuan</a> dan 
                                        <a href="#" class="text-primary">Kebijakan Privasi</a>
                                    </label>
                                    @error('terms')
                                        <div class="error-message">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <button type="submit" class="btn btn-register">
                                <i class="fas fa-user-plus"></i> Daftar Akun
                            </button>
                        </form>
                        
                        <div class="back-to-login">
                            <a href="{{ route('login') }}">
                                <i class="fas fa-arrow-left"></i> Kembali ke Halaman Login
                            </a>
                        </div>
                        
                        <!-- Demo Info -->
                        <div class="mt-4 p-3 bg-light rounded">
                            <small class="text-muted">
                                <i class="fas fa-info-circle"></i> 
                                <strong>Untuk demo cepat:</strong> Gunakan akun admin@nilai.com / admin123
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Password strength checker
            const passwordInput = document.getElementById('password');
            const strengthBar = document.getElementById('strengthBar');
            const strengthText = document.getElementById('strengthText');
            
            passwordInput.addEventListener('input', function() {
                const password = this.value;
                let strength = 0;
                let text = '';
                let color = '';
                
                // Check password strength
                if (password.length >= 8) strength++;
                if (password.match(/[a-z]+/)) strength++;
                if (password.match(/[A-Z]+/)) strength++;
                if (password.match(/[0-9]+/)) strength++;
                if (password.match(/[$@#&!]+/)) strength++;
                
                // Update UI
                switch(strength) {
                    case 0:
                    case 1:
                        text = 'Lemah';
                        color = 'strength-weak';
                        strengthBar.style.width = '20%';
                        break;
                    case 2:
                    case 3:
                        text = 'Cukup';
                        color = 'strength-medium';
                        strengthBar.style.width = '60%';
                        break;
                    case 4:
                    case 5:
                        text = 'Kuat';
                        color = 'strength-strong';
                        strengthBar.style.width = '100%';
                        break;
                }
                
                strengthBar.className = 'strength-bar ' + color;
                strengthText.textContent = 'Kekuatan password: ' + text;
            });
            
            // Auto focus on name field
            document.getElementById('name').focus();
        });
    </script>
</body>
</html>