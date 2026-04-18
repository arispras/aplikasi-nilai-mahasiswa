@extends('layouts.app')

@section('title', 'Detail Jurusan')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><i class="fas fa-university"></i> Detail Jurusan</h2>
        <div>
            <a href="{{ route('jurusan.edit', $jurusan) }}" class="btn btn-warning">
                <i class="fas fa-edit"></i> Edit
            </a>
            <a href="{{ route('mahasiswa.create') }}" class="btn btn-success">
                <i class="fas fa-user-plus"></i> Tambah Mahasiswa
            </a>
            <a href="{{ route('jurusan.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="fas fa-info-circle"></i> Informasi Jurusan</h5>
                </div>
                <div class="card-body">
                    <div class="text-center mb-4">
                        <i class="fas fa-university fa-4x text-primary"></i>
                        <h3 class="mt-3">{{ $jurusan->nama_jurusan }}</h3>
                        <span class="badge bg-secondary fs-6">{{ $jurusan->kode_jurusan }}</span>
                    </div>
                    
                    <table class="table table-borderless">
                        <tr>
                            <th width="40%">Kode Jurusan</th>
                            <td>{{ $jurusan->kode_jurusan }}</td>
                        </tr>
                        <tr>
                            <th>Nama Jurusan</th>
                            <td>{{ $jurusan->nama_jurusan }}</td>
                        </tr>
                        <tr>
                            <th>Total Mahasiswa</th>
                            <td>
                                <span class="badge bg-info fs-6">
                                    {{ $jurusan->mahasiswas->count() }} Mahasiswa
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <th>Dibuat</th>
                            <td>{{ $jurusan->created_at->format('d/m/Y H:i') }}</td>
                        </tr>
                        <tr>
                            <th>Diupdate</th>
                            <td>{{ $jurusan->updated_at->format('d/m/Y H:i') }}</td>
                        </tr>
                    </table>
                    
                    <div class="mt-3">
                        <h6>Deskripsi:</h6>
                        <p class="text-muted">{{ $jurusan->deskripsi ?: 'Tidak ada deskripsi' }}</p>
                    </div>
                </div>
            </div>
            
            <div class="card mt-3">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0"><i class="fas fa-chart-pie"></i> Statistik</h5>
                </div>
                <div class="card-body text-center">
                    <div class="row">
                        <div class="col-6">
                            <h1 class="text-primary">{{ $jurusan->mahasiswas->count() }}</h1>
                            <p class="text-muted mb-0">Mahasiswa</p>
                        </div>
                        <div class="col-6">
                            @php
                                $totalNilai = 0;
                                $totalMatkul = 0;
                                foreach($jurusan->mahasiswas as $mhs) {
                                    $totalNilai += $mhs->nilais->avg('nilai_akhir') ?? 0;
                                    $totalMatkul += $mhs->nilais->count();
                                }
                                $rataRata = $jurusan->mahasiswas->count() > 0 ? $totalNilai / $jurusan->mahasiswas->count() : 0;
                            @endphp
                            <h1 class="text-success">{{ number_format($rataRata, 1) }}</h1>
                            <p class="text-muted mb-0">Rata-rata Nilai</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-users"></i> Daftar Mahasiswa</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>NIM</th>
                                    <th>Nama</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Email</th>
                                    <th>Total Nilai</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($jurusan->mahasiswas as $mahasiswa)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $mahasiswa->nim }}</td>
                                    <td>{{ $mahasiswa->nama }}</td>
                                    <td>{{ $mahasiswa->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                                    <td>{{ $mahasiswa->email }}</td>
                                    <td>
                                        <span class="badge bg-info">
                                            {{ $mahasiswa->nilais->count() }} Mata Kuliah
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('mahasiswa.show', $mahasiswa) }}" class="btn btn-sm btn-info">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center text-muted py-4">
                                        <i class="fas fa-user-slash fa-2x mb-3"></i><br>
                                        Belum ada mahasiswa di jurusan ini
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
            <!-- Chart Mahasiswa per Jenis Kelamin -->
            <div class="card mt-3">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-chart-bar"></i> Distribusi Mahasiswa</h5>
                </div>
                <div class="card-body">
                    <canvas id="genderChart" width="400" height="200"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Gender Distribution Chart
    const ctx = document.getElementById('genderChart').getContext('2d');
    
    @php
        $maleCount = $jurusan->mahasiswas->where('jenis_kelamin', 'L')->count();
        $femaleCount = $jurusan->mahasiswas->where('jenis_kelamin', 'P')->count();
    @endphp
    
    new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['Laki-laki', 'Perempuan'],
            datasets: [{
                data: [{{ $maleCount }}, {{ $femaleCount }}],
                backgroundColor: ['#3498db', '#e74c3c'],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom',
                },
                title: {
                    display: true,
                    text: 'Distribusi Jenis Kelamin'
                }
            }
        }
    });
});
</script>
@endpush
@endsection