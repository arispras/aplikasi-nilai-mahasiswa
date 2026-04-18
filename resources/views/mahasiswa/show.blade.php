@extends('layouts.app')

@section('title', 'Detail Mahasiswa')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><i class="fas fa-user"></i> Detail Mahasiswa</h2>
        <div>
            <a href="{{ route('mahasiswa.edit', $mahasiswa) }}" class="btn btn-warning">
                <i class="fas fa-edit"></i> Edit
            </a>
            <a href="{{ route('laporan.transkrip', $mahasiswa) }}" class="btn btn-info" target="_blank">
                <i class="fas fa-file-pdf"></i> Cetak Transkrip
            </a>
            <a href="{{ route('mahasiswa.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Biodata Mahasiswa</h5>
                </div>
                <div class="card-body">
                    <div class="text-center mb-3">
                        <i class="fas fa-user-circle fa-5x text-primary"></i>
                    </div>
                    <table class="table table-borderless">
                        <tr>
                            <th width="40%">NIM</th>
                            <td>{{ $mahasiswa->nim }}</td>
                        </tr>
                        <tr>
                            <th>Nama</th>
                            <td>{{ $mahasiswa->nama }}</td>
                        </tr>
                        <tr>
                            <th>Jurusan</th>
                            <td>{{ $mahasiswa->jurusan->nama_jurusan }}</td>
                        </tr>
                        <tr>
                            <th>Jenis Kelamin</th>
                            <td>{{ $mahasiswa->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                        </tr>
                        <tr>
                            <th>Tanggal Lahir</th>
                            <td>{{ $mahasiswa->tanggal_lahir->format('d/m/Y') }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{ $mahasiswa->email }}</td>
                        </tr>
                        <tr>
                            <th>Telepon</th>
                            <td>{{ $mahasiswa->telepon }}</td>
                        </tr>
                        <tr>
                            <th>Alamat</th>
                            <td>{{ $mahasiswa->alamat }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Daftar Nilai</h5>
                </div>
                <div class="card-body">
                    <!-- ... kode sebelumnya ... -->

                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Kode MK</th>
                                    <th>Mata Kuliah</th>
                                    <th>SKS</th>
                                    <th>UTS</th>
                                    <th>UAS</th>
                                    <th>Tugas</th>
                                    <th>Nilai Akhir</th>
                                    <th>Grade</th>
                                    <th>Tanggal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($mahasiswa->nilais as $nilai)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $nilai->mataKuliah ? $nilai->mataKuliah->kode_mk : '-' }}</td>
                                    <td>{{ $nilai->mataKuliah ? $nilai->mataKuliah->nama_mk : '-' }}</td>
                                    <td>{{ $nilai->mataKuliah ? $nilai->mataKuliah->sks : '-' }}</td>
                                    <td>{{ $nilai->nilai_uts }}</td>
                                    <td>{{ $nilai->nilai_uas }}</td>
                                    <td>{{ $nilai->nilai_tugas }}</td>
                                    <td>
                                        <span class="badge bg-{{ $nilai->grade == 'A' ? 'success' : ($nilai->grade == 'B' ? 'info' : ($nilai->grade == 'C' ? 'warning' : 'danger')) }}">
                                            {{ $nilai->nilai_akhir }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge bg-{{ $nilai->grade == 'A' ? 'success' : ($nilai->grade == 'B' ? 'info' : ($nilai->grade == 'C' ? 'warning' : 'danger')) }}">
                                            {{ $nilai->grade }}
                                        </span>
                                    </td>
                                    <td>{{ $nilai->created_at->format('d/m/Y') }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="10" class="text-center">Belum ada data nilai</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>

            <!-- Statistik Nilai -->
            <div class="row mt-3">
                <div class="col-md-4">
                    <div class="card text-center">
                        <div class="card-body">
                            <h6 class="card-title">Rata-rata Nilai</h6>
                            <h3 class="text-primary">
                                {{ number_format($mahasiswa->nilais->avg('nilai_akhir') ?? 0, 2) }}
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-center">
                        <div class="card-body">
                            <h6 class="card-title">Total Mata Kuliah</h6>
                            <h3 class="text-success">{{ $mahasiswa->nilais->count() }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-center">
                        <div class="card-body">
                            <h6 class="card-title">IPK</h6>
                            <h3 class="text-warning">
                                @php
                                $totalNilai = $mahasiswa->nilais->sum('nilai_akhir');
                                $totalMatkul = $mahasiswa->nilais->count();
                                $ipk = $totalMatkul > 0 ? $totalNilai / ($totalMatkul * 25) : 0;
                                @endphp
                                {{ number_format($ipk, 2) }}
                            </h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection