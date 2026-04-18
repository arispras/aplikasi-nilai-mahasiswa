<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Aplikasi Nilai Mahasiswa')</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- Custom CSS -->
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
        }

        .sidebar {
            min-height: 100vh;
            background: linear-gradient(180deg, #2c3e50 0%, #3498db 100%);
            color: white;
            position: fixed;
            width: 250px;
            padding-top: 20px;
        }

        .sidebar a {
            color: white;
            padding: 10px 15px;
            text-decoration: none;
            display: block;
            transition: all 0.3s;
        }

        .sidebar a:hover {
            background-color: rgba(255, 255, 255, 0.1);
            padding-left: 20px;
        }

        .sidebar .active {
            background-color: rgba(255, 255, 255, 0.2);
            border-left: 4px solid #1abc9c;
        }

        .main-content {
            margin-left: 250px;
            padding: 20px;
        }

        .card {
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .card-header {
            background: linear-gradient(90deg, #3498db 0%, #2c3e50 100%);
            color: white;
            border-radius: 10px 10px 0 0 !important;
        }

        .table th {
            background-color: #2c3e50;
            color: white;
        }

        .btn-primary {
            background: linear-gradient(90deg, #3498db 0%, #2980b9 100%);
            border: none;
        }

        .btn-success {
            background: linear-gradient(90deg, #27ae60 0%, #2ecc71 100%);
            border: none;
        }

        .btn-danger {
            background: linear-gradient(90deg, #c0392b 0%, #e74c3c 100%);
            border: none;
        }

        .badge-admin {
            background-color: #e74c3c;
            color: white;
        }

        .badge-nonadmin {
            background-color: #3498db;
            color: white;
        }

        .user-info {
            color: white;
            padding: 15px;
            text-align: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .user-info img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            margin-bottom: 10px;
            border: 3px solid #1abc9c;
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                position: relative;
                min-height: auto;
            }

            .main-content {
                margin-left: 0;
            }
        }
    </style>

    @stack('styles')
</head>

<body>
    @auth
    <div class="d-flex">
        <!-- Sidebar -->
        <div class="sidebar d-none d-md-block">
            <div class="user-info">
                <div class="d-flex justify-content-center mb-2">
                    <i class="fas fa-user-circle fa-4x"></i>
                </div>
                <h6>{{ Auth::user()->name }}</h6>
                <span class="badge {{ Auth::user()->isAdmin() ? 'bg-danger' : 'bg-primary' }}">
                    {{ Auth::user()->isAdmin() ? 'Admin' : 'User' }}
                </span>
            </div>

            <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <i class="fas fa-tachometer-alt"></i> Dashboard
            </a>

            <a href="{{ route('mahasiswa.index') }}" class="{{ request()->routeIs('mahasiswa.*') ? 'active' : '' }}">
                <i class="fas fa-users"></i> Data Mahasiswa
            </a>
 
            <a href="{{ route('mata-kuliah.index') }}" class="{{ request()->routeIs('mata-kuliah.*') ? 'active' : '' }}">
                <i class="fas fa-book-open"></i> Data Mata Kuliah
            </a>

            <a href="{{ route('jurusan.index') }}" class="{{ request()->routeIs('jurusan.*') ? 'active' : '' }}">
                <i class="fas fa-university"></i> Data Jurusan
            </a>

            <a href="{{ route('nilai.index') }}" class="{{ request()->routeIs('nilai.*') ? 'active' : '' }}">
                <i class="fas fa-chart-bar"></i> Data Nilai
            </a>

            @if(Auth::user()->isAdmin())
            <a href="{{ route('users.index') }}" class="{{ request()->routeIs('users.*') ? 'active' : '' }}">
                <i class="fas fa-user-cog"></i> Manajemen User
            </a>
            @endif

            <a href="{{ route('laporan.index') }}" class="{{ request()->routeIs('laporan.*') ? 'active' : '' }}">
                <i class="fas fa-file-alt"></i> Laporan
            </a>

            <div class="mt-5">
                <a href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </div>

        <!-- Main Content -->
        <div class="main-content w-100">
            <!-- Mobile Navbar -->
            <nav class="navbar navbar-dark bg-dark d-md-none mb-3">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#">
                        <i class="fas fa-graduation-cap"></i> Nilai Mahasiswa
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mobileNav">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="mobileNav">
                        <div class="navbar-nav">
                            <a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a>
                            <a class="nav-link" href="{{ route('mahasiswa.index') }}">Mahasiswa</a>
                            <a class="nav-link" href="{{ route('jurusan.index') }}">Jurusan</a>
                            <a class="nav-link" href="{{ route('nilai.index') }}">Nilai</a>
                            @if(Auth::user()->isAdmin())
                            <a class="nav-link" href="{{ route('users.index') }}">Users</a>
                            @endif
                            <a class="nav-link" href="{{ route('laporan.index') }}">Laporan</a>
                            <a class="nav-link" href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form-mobile').submit();">
                                Logout
                            </a>
                            <form id="logout-form-mobile" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Content -->
            <div class="container-fluid">
                @yield('content')
            </div>
        </div>
    </div>
    @else
    @yield('content')
    @endauth

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // SweetAlert untuk konfirmasi delete
        function confirmDelete(formId, message = 'Apakah Anda yakin ingin menghapus data ini?') {
            Swal.fire({
                title: 'Konfirmasi',
                text: message,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(formId).submit();
                }
            });
        }

        // Tampilkan flash message
        @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '{{ session('
            success ') }}',
            timer: 3000,
            showConfirmButton: false
        });
        @endif

        @if(session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Gagal!',
            text: '{{ session('
            error ') }}'
        });
        @endif

        // Validasi form
        document.addEventListener('DOMContentLoaded', function() {
            var forms = document.querySelectorAll('.needs-validation');
            Array.prototype.slice.call(forms).forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        });
    </script>

    @stack('scripts')
</body>

</html>