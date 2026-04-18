<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sistem Nilai Mahasiswa - Universitas Saintek Muhammadiyah</title>
    
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
        }
        
        .welcome-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        
        .welcome-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            overflow: hidden;
            animation: fadeIn 0.8s ease-out;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .hero-section {
            background: linear-gradient(135deg, #2c3e50 0%, #3498db 100%);
            color: white;
            padding: 60px 40px;
            text-align: center;
        }
        
        .university-logo {
            width: 120px;
            height: 120px;
            background: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }
        
        .university-logo i {
            font-size: 50px;
            color: #3498db;
        }
        
        .university-name {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 10px;
            letter-spacing: 1px;
        }
        
        .system-name {
            font-size: 36px;
            font-weight: 800;
            margin-bottom: 15px;
            background: linear-gradient(90deg, #00b09b, #96c93d);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .tagline {
            font-size: 18px;
            opacity: 0.9;
            margin-bottom: 30px;
        }
        
        .features-section {
            padding: 50px 40px;
        }
        
        .feature-card {
            text-align: center;
            padding: 30px 20px;
            border-radius: 15px;
            transition: transform 0.3s, box-shadow 0.3s;
            height: 100%;
            border: 1px solid #e9ecef;
        }
        
        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.1);
        }
        
        .feature-icon {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            font-size: 30px;
            color: white;
        }
        
        .feature-1 .feature-icon { background: linear-gradient(135deg, #00b09b, #96c93d); }
        .feature-2 .feature-icon { background: linear-gradient(135deg, #3498db, #2c3e50); }
        .feature-3 .feature-icon { background: linear-gradient(135deg, #e74c3c, #c0392b); }
        
        .feature-title {
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 10px;
            color: #2c3e50;
        }
        
        .feature-desc {
            color: #6c757d;
            font-size: 14px;
        }
        
        .auth-section {
            padding: 40px;
            background: #f8f9fa;
            border-top: 1px solid #e9ecef;
        }
        
        .auth-buttons {
            display: flex;
            gap: 20px;
            justify-content: center;
            flex-wrap: wrap;
        }
        
        .auth-btn {
            padding: 15px 40px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 16px;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .btn-login {
            background: linear-gradient(135deg, #3498db, #2980b9);
            color: white;
            border: none;
        }
        
        .btn-register {
            background: white;
            color: #3498db;
            border: 2px solid #3498db;
        }
        
        .auth-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.2);
        }
        
        .stats-section {
            padding: 40px;
            background: white;
            border-top: 1px solid #e9ecef;
        }
        
        .stat-card {
            text-align: center;
            padding: 20px;
        }
        
        .stat-number {
            font-size: 36px;
            font-weight: 700;
            color: #3498db;
            margin-bottom: 5px;
        }
        
        .stat-label {
            color: #6c757d;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        .footer {
            padding: 30px;
            background: #2c3e50;
            color: white;
            text-align: center;
        }
        
        .copyright {
            opacity: 0.8;
            font-size: 14px;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .hero-section {
                padding: 40px 20px;
            }
            
            .system-name {
                font-size: 28px;
            }
            
            .university-name {
                font-size: 22px;
            }
            
            .features-section {
                padding: 30px 20px;
            }
            
            .auth-buttons {
                flex-direction: column;
                align-items: center;
            }
            
            .auth-btn {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
</head>
<body>
    <div class="welcome-container">
        <div class="welcome-card">
            <!-- Hero Section -->
            <div class="hero-section">
                <div class="university-logo">
                    <i class="fas fa-graduation-cap"></i>
                </div>
                <h1 class="university-name">Universitas Saintek Muhammadiyah</h1>
                <h2 class="system-name">SISTEM INFORMASI NILAI MAHASISWA</h2>
                <p class="tagline">Platform digital terintegrasi untuk pengelolaan nilai akademik mahasiswa</p>
            </div>
            
            <!-- Features Section -->
            <div class="features-section">
                <div class="row g-4">
                    <div class="col-md-4">
                        <div class="feature-card feature-1">
                            <div class="feature-icon">
                                <i class="fas fa-chart-line"></i>
                            </div>
                            <h3 class="feature-title">Manajemen Nilai</h3>
                            <p class="feature-desc">
                                Kelola nilai UTS, UAS, dan tugas dengan sistem perhitungan otomatis. 
                                Generate grade dan transkrip nilai secara instan.
                            </p>
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="feature-card feature-2">
                            <div class="feature-icon">
                                <i class="fas fa-users"></i>
                            </div>
                            <h3 class="feature-title">Data Mahasiswa</h3>
                            <p class="feature-desc">
                                Kelola data mahasiswa lengkap dengan jurusan, biodata, dan kontak.
                                Sistem pencarian dan filter yang canggih.
                            </p>
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="feature-card feature-3">
                            <div class="feature-icon">
                                <i class="fas fa-file-pdf"></i>
                            </div>
                            <h3 class="feature-title">Laporan & Export</h3>
                            <p class="feature-desc">
                                Generate laporan dalam format HTML dan PDF. 
                                Export data nilai dan transkrip dengan desain profesional.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Statistics (Optional) -->
            <div class="stats-section">
                <div class="row g-4">
                    <div class="col-md-3">
                        <div class="stat-card">
                            <div class="stat-number" id="mahasiswaCount">0</div>
                            <div class="stat-label">Mahasiswa</div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stat-card">
                            <div class="stat-number" id="jurusanCount">0</div>
                            <div class="stat-label">Jurusan</div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stat-card">
                            <div class="stat-number" id="nilaiCount">0</div>
                            <div class="stat-label">Data Nilai</div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stat-card">
                            <div class="stat-number" id="userCount">0</div>
                            <div class="stat-label">Pengguna</div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Authentication Section -->
            <div class="auth-section">
                <div class="auth-buttons">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="btn auth-btn btn-login">
                                <i class="fas fa-tachometer-alt"></i> Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="btn auth-btn btn-login">
                                <i class="fas fa-sign-in-alt"></i> Login ke Sistem
                            </a>
                            
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="btn auth-btn btn-register">
                                    <i class="fas fa-user-plus"></i> Daftar Akun Baru
                                </a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
            
            <!-- Footer -->
            <div class="footer">
                <p class="copyright">
                    © {{ date('Y') }} Universitas Saintek Muhammadiyah. Hak Cipta Dilindungi.
                    <br>
                    Sistem Informasi Nilai Mahasiswa v1.0
                </p>
            </div>
        </div>
    </div>
    
    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <script>
        // Animated counter
        function animateCounter(elementId, target, duration = 2000) {
            const element = document.getElementById(elementId);
            const increment = target / (duration / 16); // 60fps
            
            let current = 0;
            const timer = setInterval(() => {
                current += increment;
                if (current >= target) {
                    element.textContent = target;
                    clearInterval(timer);
                } else {
                    element.textContent = Math.floor(current);
                }
            }, 16);
        }
        
        // Initialize counters when page loads
        document.addEventListener('DOMContentLoaded', function() {
            // Example data - in real app, you would fetch this from API
            setTimeout(() => {
                animateCounter('mahasiswaCount', 150);
                animateCounter('jurusanCount', 5);
                animateCounter('nilaiCount', 450);
                animateCounter('userCount', 25);
            }, 500);
            
            // Auto redirect to login after 5 seconds if not logged in
            @guest
            setTimeout(() => {
                Swal.fire({
                    title: 'Mengarahkan ke Login',
                    text: 'Anda akan diarahkan ke halaman login...',
                    icon: 'info',
                    timer: 2000,
                    showConfirmButton: false,
                    timerProgressBar: true
                }).then(() => {
                    window.location.href = "{{ route('login') }}";
                });
            }, 8000); // 8 seconds delay
            @endguest
        });
    </script>
</body>
</html>