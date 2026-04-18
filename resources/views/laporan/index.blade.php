@extends('layouts.app')

@section('title', 'Laporan')

@section('content')
<div class="container-fluid">
    <h2 class="mb-4"><i class="fas fa-file-alt"></i> Menu Laporan</h2>
    
    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="fas fa-users"></i> Laporan Mahasiswa</h5>
                </div>
                <div class="card-body text-center">
                    <i class="fas fa-file-pdf fa-5x text-danger mb-3"></i>
                    <p>Cetak daftar seluruh mahasiswa beserta informasi lengkapnya.</p>
                </div>
                <div class="card-footer bg-transparent">
                    <div class="d-grid gap-2">
                        <a href="{{ route('laporan.mahasiswa') }}" class="btn btn-outline-primary">
                            <i class="fas fa-eye"></i> Preview
                        </a>
                        <a href="{{ route('laporan.mahasiswa.pdf') }}" class="btn btn-danger">
                            <i class="fas fa-file-pdf"></i> Download PDF
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0"><i class="fas fa-chart-bar"></i> Laporan Nilai</h5>
                </div>
                <div class="card-body text-center">
                    <i class="fas fa-chart-line fa-5x text-success mb-3"></i>
                    <p>Cetak daftar seluruh nilai mahasiswa dengan statistik lengkap.</p>
                </div>
                <div class="card-footer bg-transparent">
                    <div class="d-grid gap-2">
                        <a href="{{ route('laporan.nilai') }}" class="btn btn-outline-success">
                            <i class="fas fa-eye"></i> Preview
                        </a>
                        <a href="{{ route('laporan.nilai.pdf') }}" class="btn btn-danger">
                            <i class="fas fa-file-pdf"></i> Download PDF
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <div class="card-header bg-warning text-white">
                    <h5 class="mb-0"><i class="fas fa-graduation-cap"></i> Transkrip Nilai</h5>
                </div>
                <div class="card-body text-center">
                    <i class="fas fa-file-contract fa-5x text-warning mb-3"></i>
                    <p>Cetak transkrip nilai per mahasiswa dengan perhitungan IPK.</p>
                </div>
                <div class="card-footer bg-transparent">
                    <div class="d-grid">
                        <select id="mahasiswaSelect" class="form-select mb-2">
                            <option value="">Pilih Mahasiswa</option>
                            @foreach(App\Models\Mahasiswa::all() as $mhs)
                            <option value="{{ $mhs->id }}">{{ $mhs->nim }} - {{ $mhs->nama }}</option>
                            @endforeach
                        </select>
                        <button id="btnPreview" class="btn btn-outline-warning mb-2" disabled>
                            <i class="fas fa-eye"></i> Preview Transkrip
                        </button>
                        <button id="btnDownload" class="btn btn-danger" disabled>
                            <i class="fas fa-file-pdf"></i> Download PDF
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Statistik Laporan -->
    <div class="card mt-4">
        <div class="card-header">
            <h5 class="mb-0"><i class="fas fa-chart-pie"></i> Statistik Data</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <canvas id="gradeChart" width="400" height="200"></canvas>
                </div>
                <div class="col-md-6">
                    <canvas id="jurusanChart" width="400" height="200"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Handle transkrip buttons
        const mahasiswaSelect = document.getElementById('mahasiswaSelect');
        const btnPreview = document.getElementById('btnPreview');
        const btnDownload = document.getElementById('btnDownload');
        
        mahasiswaSelect.addEventListener('change', function() {
            const selectedId = this.value;
            btnPreview.disabled = !selectedId;
            btnDownload.disabled = !selectedId;
            
            if (selectedId) {
                btnPreview.onclick = function() {
                    window.open(`/laporan/transkrip/${selectedId}`, '_blank');
                };
                btnDownload.onclick = function() {
                    window.location.href = `/laporan/transkrip/${selectedId}/pdf`;
                };
            }
        });
        
        // Grade Distribution Chart
        const gradeCtx = document.getElementById('gradeChart').getContext('2d');
        const gradeChart = new Chart(gradeCtx, {
            type: 'pie',
            data: {
                labels: ['A', 'B', 'C', 'D', 'E'],
                datasets: [{
                    data: [30, 40, 20, 5, 5],
                    backgroundColor: [
                        '#27ae60',
                        '#3498db',
                        '#f39c12',
                        '#e74c3c',
                        '#95a5a6'
                    ]
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    title: {
                        display: true,
                        text: 'Distribusi Grade Nilai'
                    }
                }
            }
        });
        
        // Jurusan Distribution Chart
        const jurusanCtx = document.getElementById('jurusanChart').getContext('2d');
        const jurusanChart = new Chart(jurusanCtx, {
            type: 'bar',
            data: {
                labels: ['Teknik Informatika', 'Sistem Informasi', 'Teknik Komputer', 'Manajemen Informatika'],
                datasets: [{
                    label: 'Jumlah Mahasiswa',
                    data: [45, 32, 28, 25],
                    backgroundColor: '#2c3e50'
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    title: {
                        display: true,
                        text: 'Distribusi Mahasiswa per Jurusan'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    });
</script>
@endsection