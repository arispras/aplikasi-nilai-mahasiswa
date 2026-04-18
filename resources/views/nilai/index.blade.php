@extends('layouts.app')

@section('title', 'Data Nilai')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><i class="fas fa-chart-bar"></i> Data Nilai</h2>
        <a href="{{ route('nilai.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Input Nilai
        </a>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-6">
                    <h5 class="mb-0">Daftar Nilai Mahasiswa</h5>
                </div>
                <div class="col-md-6">
                    <div class="input-group">
                        <input type="text" id="searchInput" class="form-control" placeholder="Cari nama mahasiswa atau mata kuliah...">
                        <button class="btn btn-outline-secondary" type="button" id="searchBtn">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-striped" id="nilaiTable">
                    <!-- ... kode sebelumnya ... -->

                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Mahasiswa</th>
                            <th>NIM</th>
                            <th>Kode MK</th>
                            <th>Mata Kuliah</th>
                            <th>UTS</th>
                            <th>UAS</th>
                            <th>Tugas</th>
                            <th>Nilai Akhir</th>
                            <th>Grade</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($nilais as $nilai)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="avatar-sm me-2">
                                        <div class="avatar-title bg-primary rounded-circle">
                                            {{ substr($nilai->mahasiswa->nama, 0, 1) }}
                                        </div>
                                    </div>
                                    <div>
                                        <strong>{{ $nilai->mahasiswa->nama }}</strong><br>
                                        <small class="text-muted">{{ $nilai->mahasiswa->jurusan->nama_jurusan }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $nilai->mahasiswa->nim }}</td>
                            <td>{{ $nilai->mataKuliah ? $nilai->mataKuliah->kode_mk : '-' }}</td>
                            <td>{{ $nilai->mataKuliah ? $nilai->mataKuliah->nama_mk : '-' }}</td>
                            <td>{{ $nilai->nilai_uts }}</td>
                            <td>{{ $nilai->nilai_uas }}</td>
                            <td>{{ $nilai->nilai_tugas }}</td>
                            <td>
                                @php
                                $color = 'primary';
                                if($nilai->grade == 'A') $color = 'success';
                                elseif($nilai->grade == 'B') $color = 'info';
                                elseif($nilai->grade == 'C') $color = 'warning';
                                elseif($nilai->grade == 'D') $color = 'orange';
                                else $color = 'danger';
                                @endphp
                                <span class="badge bg-{{ $color }} fs-6">
                                    {{ $nilai->nilai_akhir }}
                                </span>
                            </td>
                            <td>
                                <span class="badge bg-{{ $color }} fs-6">
                                    {{ $nilai->grade }}
                                </span>
                            </td>
                            <td>{{ $nilai->created_at->format('d/m/Y') }}</td>
                            <td>
                                <a href="{{ route('nilai.show', $nilai) }}" class="btn btn-sm btn-info" title="Detail">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('nilai.edit', $nilai) }}" class="btn btn-sm btn-warning" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button onclick="confirmDelete('delete-form-{{ $nilai->id }}')"
                                    class="btn btn-sm btn-danger" title="Hapus">
                                    <i class="fas fa-trash"></i>
                                </button>
                                <form id="delete-form-{{ $nilai->id }}"
                                    action="{{ route('nilai.destroy', $nilai) }}"
                                    method="POST" class="d-none">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="12" class="text-center text-muted py-4">
                                <i class="fas fa-chart-line fa-2x mb-3"></i><br>
                                Belum ada data nilai
                            </td>
                        </tr>
                        @endforelse
                    </tbody>


                </table>
            </div>

            @if($nilais->count() > 0)
            <div class="row mt-3">
                <div class="col-md-6">
                    <div class="card bg-light">
                        <div class="card-body py-2">
                            <div class="row">
                                <div class="col-4 text-center border-end">
                                    <h5 class="mb-0 text-primary">{{ $nilais->count() }}</h5>
                                    <small class="text-muted">Total Data</small>
                                </div>
                                <div class="col-4 text-center border-end">
                                    <h5 class="mb-0 text-success">{{ number_format($nilais->avg('nilai_akhir'), 2) }}</h5>
                                    <small class="text-muted">Rata-rata</small>
                                </div>
                                <div class="col-4 text-center">
                                    @php
                                    $gradeA = $nilais->where('grade', 'A')->count();
                                    $persenA = $nilais->count() > 0 ? ($gradeA / $nilais->count() * 100) : 0;
                                    @endphp
                                    <h5 class="mb-0 text-success">{{ number_format($persenA, 1) }}%</h5>
                                    <small class="text-muted">Grade A</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Search functionality
        const searchInput = document.getElementById('searchInput');
        const searchBtn = document.getElementById('searchBtn');
        const table = document.getElementById('nilaiTable');
        const rows = table.getElementsByTagName('tbody')[0].getElementsByTagName('tr');

        function performSearch() {
            const searchTerm = searchInput.value.toLowerCase();

            for (let row of rows) {
                const cells = row.getElementsByTagName('td');
                let found = false;

                for (let cell of cells) {
                    if (cell.textContent.toLowerCase().includes(searchTerm)) {
                        found = true;
                        break;
                    }
                }

                row.style.display = found ? '' : 'none';
            }
        }

        searchBtn.addEventListener('click', performSearch);
        searchInput.addEventListener('keyup', function(event) {
            if (event.key === 'Enter') {
                performSearch();
            }
        });
    });
</script>
@endpush
@endsection