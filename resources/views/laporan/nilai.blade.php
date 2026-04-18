@extends('layouts.app')

@section('title', 'Laporan Data Nilai')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><i class="fas fa-chart-bar"></i> Laporan Data Nilai</h2>
        <div>
            <a href="{{ route('laporan.nilai.pdf') }}" class="btn btn-danger">
                <i class="fas fa-file-pdf"></i> Download PDF
            </a>
            <a href="{{ route('laporan.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-header bg-success text-white">
            <div class="row">
                <div class="col-md-6">
                    <h5 class="mb-0">Laporan Data Nilai Mahasiswa</h5>
                </div>
                <div class="col-md-6 text-end">
                    <small>Dicetak: {{ date('d/m/Y H:i:s') }}</small>
                </div>
            </div>
        </div>
        <div class="card-body">
            <!-- Filter (Optional) -->
            <div class="row mb-4">
                <div class="col-md-4">
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-search"></i></span>
                        <input type="text" id="searchInput" class="form-control" placeholder="Cari nama atau NIM...">
                    </div>
                </div>
                <div class="col-md-4">
                    <select class="form-select" id="filterGrade">
                        <option value="">Semua Grade</option>
                        <option value="A">Grade A</option>
                        <option value="B">Grade B</option>
                        <option value="C">Grade C</option>
                        <option value="D">Grade D</option>
                        <option value="E">Grade E</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <select class="form-select" id="filterJurusan">
                        <option value="">Semua Jurusan</option>
                        @foreach(\App\Models\Jurusan::all() as $jurusan)
                        <option value="{{ $jurusan->id }}">{{ $jurusan->nama_jurusan }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Data Table -->
         
       

            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Mahasiswa</th>
                            <th>NIM</th>
                            <th>Kode MK</th>
                            <th>Mata Kuliah</th>
                            <th>SKS</th>
                            <th>UTS</th>
                            <th>UAS</th>
                            <th>Tugas</th>
                            <th>Nilai Akhir</th>
                            <th>Grade</th>
                            <th>Tanggal Input</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($nilais as $nilai)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $nilai->mahasiswa->nama }}</td>
                            <td>{{ $nilai->mahasiswa->nim }}</td>
                            <td>{{ $nilai->mataKuliah->kode_mk ?? '-' }}</td>
                            <td>{{ $nilai->mataKuliah->nama_mk ?? '-' }}</td>
                            <td class="text-center">{{ $nilai->mataKuliah->sks ?? '-' }}</td>
                            <td class="text-center">{{ $nilai->nilai_uts }}</td>
                            <td class="text-center">{{ $nilai->nilai_uas }}</td>
                            <td class="text-center">{{ $nilai->nilai_tugas }}</td>
                            <td class="text-center">
                                @php
                                $color = 'primary';
                                if($nilai->grade == 'A') $color = 'success';
                                elseif($nilai->grade == 'B') $color = 'info';
                                elseif($nilai->grade == 'C') $color = 'warning';
                                elseif($nilai->grade == 'D') $color = 'orange';
                                else $color = 'danger';
                                @endphp
                                <span class="badge bg-{{ $color }}">
                                    {{ $nilai->nilai_akhir }}
                                </span>
                            </td>
                            <td class="text-center">
                                <span class="badge bg-{{ $color }}">
                                    {{ $nilai->grade }}
                                </span>
                            </td>
                            <td>{{ $nilai->created_at->format('d/m/Y') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>



            <!-- Statistik -->
            <div class="row mt-4">
                <div class="col-md-6">
                    <div class="card bg-light">
                        <div class="card-body">
                            <h6><i class="fas fa-chart-line"></i> Statistik Nilai</h6>
                            <div class="row">
                                <div class="col-6">
                                    <p class="mb-1">Total Data</p>
                                    <h4 class="text-primary">{{ $nilais->count() }}</h4>
                                </div>
                                <div class="col-6">
                                    <p class="mb-1">Rata-rata</p>
                                    <h4 class="text-success">{{ number_format($nilais->avg('nilai_akhir'), 2) }}</h4>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-6">
                                    <p class="mb-1">Nilai Tertinggi</p>
                                    <h5 class="text-success">{{ number_format($nilais->max('nilai_akhir'), 2) }}</h5>
                                </div>
                                <div class="col-6">
                                    <p class="mb-1">Nilai Terendah</p>
                                    <h5 class="text-danger">{{ number_format($nilais->min('nilai_akhir'), 2) }}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card bg-light">
                        <div class="card-body">
                            <h6><i class="fas fa-chart-pie"></i> Distribusi Grade</h6>
                            <div class="row">
                                @php
                                $grades = [
                                'A' => $nilais->where('grade', 'A')->count(),
                                'B' => $nilais->where('grade', 'B')->count(),
                                'C' => $nilais->where('grade', 'C')->count(),
                                'D' => $nilais->where('grade', 'D')->count(),
                                'E' => $nilais->where('grade', 'E')->count(),
                                ];
                                @endphp

                                @foreach($grades as $grade => $count)
                                @php
                                $color = 'primary';
                                if($grade == 'A') $color = 'success';
                                elseif($grade == 'B') $color = 'info';
                                elseif($grade == 'C') $color = 'warning';
                                elseif($grade == 'D') $color = 'orange';
                                else $color = 'danger';

                                $percentage = $nilais->count() > 0 ? ($count / $nilais->count() * 100) : 0;
                                @endphp
                                <div class="col-4 mb-2">
                                    <div class="text-center">
                                        <div class="badge bg-{{ $color }} mb-1" style="font-size: 1.2em; padding: 8px 12px;">
                                            {{ $grade }}
                                        </div>
                                        <div>
                                            <strong>{{ $count }}</strong><br>
                                            <small>{{ number_format($percentage, 1) }}%</small>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Informasi Cetak -->
            <div class="row mt-4">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h6><i class="fas fa-info-circle"></i> Informasi Laporan</h6>
                            <div class="row">
                                <div class="col-md-4">
                                    <p class="mb-1">Dicetak oleh</p>
                                    <h6>{{ Auth::user()->name }}</h6>
                                </div>
                                <div class="col-md-4">
                                    <p class="mb-1">Tanggal</p>
                                    <h6>{{ date('d/m/Y') }}</h6>
                                </div>
                                <div class="col-md-4">
                                    <p class="mb-1">Waktu</p>
                                    <h6>{{ date('H:i:s') }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Filter functionality
        const searchInput = document.getElementById('searchInput');
        const filterGrade = document.getElementById('filterGrade');
        const filterJurusan = document.getElementById('filterJurusan');
        const tableRows = document.querySelectorAll('#nilaiTable tbody tr');

        function applyFilters() {
            const searchTerm = searchInput.value.toLowerCase();
            const selectedGrade = filterGrade.value;
            const selectedJurusan = filterJurusan.value;

            tableRows.forEach(row => {
                const cells = row.querySelectorAll('td');
                const mahasiswaName = cells[1].textContent.toLowerCase();
                const nim = cells[2].textContent.toLowerCase();
                const jurusan = row.getAttribute('data-jurusan');
                const grade = row.classList.contains('grade-A') ? 'A' :
                    row.classList.contains('grade-B') ? 'B' :
                    row.classList.contains('grade-C') ? 'C' :
                    row.classList.contains('grade-D') ? 'D' : 'E';

                let show = true;

                // Search filter
                if (searchTerm && !mahasiswaName.includes(searchTerm) && !nim.includes(searchTerm)) {
                    show = false;
                }

                // Grade filter
                if (selectedGrade && grade !== selectedGrade) {
                    show = false;
                }

                // Jurusan filter
                if (selectedJurusan && jurusan !== selectedJurusan) {
                    show = false;
                }

                row.style.display = show ? '' : 'none';
            });
        }

        // Add event listeners
        searchInput.addEventListener('keyup', applyFilters);
        filterGrade.addEventListener('change', applyFilters);
        filterJurusan.addEventListener('change', applyFilters);
    });
</script>

<style>
    .grade-A {
        background-color: rgba(40, 167, 69, 0.1) !important;
    }

    .grade-B {
        background-color: rgba(23, 162, 184, 0.1) !important;
    }

    .grade-C {
        background-color: rgba(255, 193, 7, 0.1) !important;
    }

    .grade-D {
        background-color: rgba(255, 152, 0, 0.1) !important;
    }

    .grade-E {
        background-color: rgba(220, 53, 69, 0.1) !important;
    }
</style>
@endpush
@endsection