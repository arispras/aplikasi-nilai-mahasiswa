@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid">
    <h2 class="mb-4"><i class="fas fa-tachometer-alt"></i> Dashboard</h2>
    
    <!-- Statistik -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card text-white bg-primary">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title">Total Mahasiswa</h6>
                            <h2 class="mb-0">{{ $totalMahasiswa }}</h2>
                        </div>
                        <i class="fas fa-users fa-3x"></i>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="card text-white bg-success">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title">Total Jurusan</h6>
                            <h2 class="mb-0">{{ $totalJurusan }}</h2>
                        </div>
                        <i class="fas fa-university fa-3x"></i>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="card text-white bg-warning">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title">Total Nilai</h6>
                            <h2 class="mb-0">{{ $totalNilai }}</h2>
                        </div>
                        <i class="fas fa-chart-bar fa-3x"></i>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="card text-white bg-info">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title">Total User</h6>
                            <h2 class="mb-0">{{ $totalUser }}</h2>
                        </div>
                        <i class="fas fa-user fa-3x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Ringkasan Nilai -->
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-chart-line"></i> Rata-rata Nilai</h5>
                </div>
                <div class="card-body text-center">
                    <h1 class="display-4">{{ number_format($rataRataNilai, 2) }}</h1>
                    <p class="text-muted">Nilai akhir seluruh mahasiswa</p>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-arrow-up"></i> Nilai Tertinggi</h5>
                </div>
                <div class="card-body text-center">
                    <h1 class="display-4 text-success">{{ number_format($nilaiTertinggi, 2) }}</h1>
                    <p class="text-muted">Nilai akhir tertinggi</p>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-arrow-down"></i> Nilai Terendah</h5>
                </div>
                <div class="card-body text-center">
                    <h1 class="display-4 text-danger">{{ number_format($nilaiTerendah, 2) }}</h1>
                    <p class="text-muted">Nilai akhir terendah</p>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Quick Actions -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-bolt"></i> Quick Actions</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <a href="{{ route('mahasiswa.create') }}" class="btn btn-primary btn-lg w-100">
                                <i class="fas fa-user-plus"></i><br>
                                Tambah Mahasiswa
                            </a>
                        </div>
                        <div class="col-md-3 mb-3">
                            <a href="{{ route('nilai.create') }}" class="btn btn-success btn-lg w-100">
                                <i class="fas fa-plus-circle"></i><br>
                                Input Nilai
                            </a>
                        </div>
                        <div class="col-md-3 mb-3">
                            <a href="{{ route('laporan.mahasiswa') }}" class="btn btn-info btn-lg w-100">
                                <i class="fas fa-file-pdf"></i><br>
                                Cetak Laporan
                            </a>
                        </div>
                        @if(Auth::user()->isAdmin())
                        <div class="col-md-3 mb-3">
                            <a href="{{ route('users.create') }}" class="btn btn-warning btn-lg w-100">
                                <i class="fas fa-user-plus"></i><br>
                                Tambah User
                            </a>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection