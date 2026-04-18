@extends('layouts.app')

@section('title', 'Detail Nilai')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><i class="fas fa-chart-bar"></i> Detail Nilai</h2>
        <div>
            <a href="{{ route('nilai.edit', $nilai) }}" class="btn btn-warning">
                <i class="fas fa-edit"></i> Edit
            </a>
            <a href="{{ route('laporan.transkrip', $nilai->mahasiswa) }}" class="btn btn-info" target="_blank">
                <i class="fas fa-file-pdf"></i> Cetak Transkrip
            </a>
            <a href="{{ route('nilai.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="fas fa-user-graduate"></i> Data Mahasiswa</h5>
                </div>
                <div class="card-body">
                    <div class="text-center mb-3">
                        <div class="avatar-xl mx-auto mb-3">
                            <div class="avatar-title bg-primary rounded-circle display-4">
                                {{ substr($nilai->mahasiswa->nama, 0, 1) }}
                            </div>
                        </div>
                        <h4>{{ $nilai->mahasiswa->nama }}</h4>
                        <p class="text-muted">{{ $nilai->mahasiswa->nim }}</p>
                    </div>
                    
                    <table class="table table-borderless">
                        <tr>
                            <th width="40%">Jurusan</th>
                            <td>{{ $nilai->mahasiswa->jurusan->nama_jurusan }}</td>
                        </tr>
                        <tr>
                            <th>Jenis Kelamin</th>
                            <td>{{ $nilai->mahasiswa->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{ $nilai->mahasiswa->email }}</td>
                        </tr>
                        <tr>
                            <th>Telepon</th>
                            <td>{{ $nilai->mahasiswa->telepon }}</td>
                        </tr>
                        <tr>
                            <th>Kode Mata Kuliah</th>
                            <td>{{ $nilai->mataKuliah ? $nilai->mataKuliah->kode_mk : '-' }}</td>
                        </tr>
                        <tr>
                            <th>Nama Mata Kuliah</th>
                            <td>{{ $nilai->mataKuliah ? $nilai->mataKuliah->nama_mk : '-' }}</td>
                        </tr>
                        <tr>
                            <th>SKS</th>
                            <td>{{ $nilai->mataKuliah ? $nilai->mataKuliah->sks : '-' }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0"><i class="fas fa-info-circle"></i> Informasi Nilai</h5>
                </div>
                <div class="card-body">
                    <table class="table table-borderless">
                        <tr>
                            <th width="50%">Dibuat</th>
                            <td>{{ $nilai->created_at->format('d/m/Y H:i') }}</td>
                        </tr>
                        <tr>
                            <th>Diupdate</th>
                            <td>{{ $nilai->updated_at->format('d/m/Y H:i') }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-chart-line"></i> Detail Nilai</h5>
                </div>
                <div class="card-body">
                    <div class="row text-center mb-4">
                        <div class="col-md-3">
                            <div class="card bg-light">
                                <div class="card-body">
                                    <h6>Nilai UTS</h6>
                                    <div class="display-4 text-primary">{{ $nilai->nilai_uts }}</div>
                                    <small class="text-muted">Bobot: 30%</small>
                                    <div class="progress mt-2" style="height: 10px;">
                                        <div class="progress-bar bg-primary" style="width: 30%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-light">
                                <div class="card-body">
                                    <h6>Nilai UAS</h6>
                                    <div class="display-4 text-info">{{ $nilai->nilai_uas }}</div>
                                    <small class="text-muted">Bobot: 40%</small>
                                    <div class="progress mt-2" style="height: 10px;">
                                        <div class="progress-bar bg-info" style="width: 40%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-light">
                                <div class="card-body">
                                    <h6>Nilai Tugas</h6>
                                    <div class="display-4 text-warning">{{ $nilai->nilai_tugas }}</div>
                                    <small class="text-muted">Bobot: 30%</small>
                                    <div class="progress mt-2" style="height: 10px;">
                                        <div class="progress-bar bg-warning" style="width: 30%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-light">
                                <div class="card-body">
                                    <h6>Nilai Akhir</h6>
                                    <div class="display-3 text-success">{{ $nilai->nilai_akhir }}</div>
                                    <span class="badge bg-{{ $nilai->grade == 'A' ? 'success' : ($nilai->grade == 'B' ? 'info' : ($nilai->grade == 'C' ? 'warning' : ($nilai->grade == 'D' ? 'orange' : 'danger'))) }} fs-5">
                                        Grade {{ $nilai->grade }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Perhitungan Detail -->
                    <div class="card">
                        <div class="card-header">
                            <h6 class="mb-0"><i class="fas fa-calculator"></i> Detail Perhitungan</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Komponen</th>
                                            <th>Nilai</th>
                                            <th>Bobot</th>
                                            <th>Nilai Tertimbang</th>
                                            <th>Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>UTS</td>
                                            <td>{{ $nilai->nilai_uts }}</td>
                                            <td>30%</td>
                                            <td>{{ number_format($nilai->nilai_uts * 0.3, 2) }}</td>
                                            <td>Ujian Tengah Semester</td>
                                        </tr>
                                        <tr>
                                            <td>UAS</td>
                                            <td>{{ $nilai->nilai_uas }}</td>
                                            <td>40%</td>
                                            <td>{{ number_format($nilai->nilai_uas * 0.4, 2) }}</td>
                                            <td>Ujian Akhir Semester</td>
                                        </tr>
                                        <tr>
                                            <td>Tugas</td>
                                            <td>{{ $nilai->nilai_tugas }}</td>
                                            <td>30%</td>
                                            <td>{{ number_format($nilai->nilai_tugas * 0.3, 2) }}</td>
                                            <td>Tugas dan Quiz</td>
                                        </tr>
                                        <tr class="table-success">
                                            <td colspan="3" class="text-end"><strong>Total Nilai Akhir:</strong></td>
                                            <td colspan="2"><strong>{{ $nilai->nilai_akhir }}</strong></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Chart -->
                    <div class="card mt-3">
                        <div class="card-header">
                            <h6 class="mb-0"><i class="fas fa-chart-bar"></i> Visualisasi Nilai</h6>
                        </div>
                        <div class="card-body">
                            <canvas id="nilaiChart" width="400" height="200"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('nilaiChart').getContext('2d');
    
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['UTS', 'UAS', 'Tugas', 'Nilai Akhir'],
            datasets: [{
                label: 'Nilai',
                data: [
                    {{ $nilai->nilai_uts }},
                    {{ $nilai->nilai_uas }},
                    {{ $nilai->nilai_tugas }},
                    {{ $nilai->nilai_akhir }}
                ],
                backgroundColor: [
                    '#3498db',
                    '#2ecc71',
                    '#f39c12',
                    '#e74c3c'
                ],
                borderColor: [
                    '#2980b9',
                    '#27ae60',
                    '#d35400',
                    '#c0392b'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    max: 100,
                    title: {
                        display: true,
                        text: 'Nilai'
                    }
                }
            },
            plugins: {
                legend: {
                    display: false
                },
                title: {
                    display: true,
                    text: 'Perbandingan Nilai'
                }
            }
        }
    });
});
</script>
@endpush
@endsection