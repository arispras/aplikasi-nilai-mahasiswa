@extends('layouts.app')

@section('title', 'Transkrip Nilai - ' . $mahasiswa->nama)

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><i class="fas fa-graduation-cap"></i> Transkrip Nilai - {{ $mahasiswa->nama }}</h2>
        <div>
            <a href="{{ route('laporan.transkrip.pdf', $mahasiswa) }}" class="btn btn-danger">
                <i class="fas fa-file-pdf"></i> Download PDF
            </a>
            <a href="{{ route('mahasiswa.show', $mahasiswa) }}" class="btn btn-info">
                <i class="fas fa-user"></i> Profil Mahasiswa
            </a>
            <a href="{{ route('laporan.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">TRANSKRIP NILAI AKADEMIK</h5>
        </div>
        <div class="card-body">
            <!-- Header Transkrip -->
            <div class="row mb-4">
                <div class="col-md-8">
                    <table class="table table-borderless">
                        <tr>
                            <th width="30%">Nama Mahasiswa</th>
                            <td>: <strong>{{ $mahasiswa->nama }}</strong></td>
                        </tr>
                        <tr>
                            <th>Nomor Induk Mahasiswa</th>
                            <td>: <strong>{{ $mahasiswa->nim }}</strong></td>
                        </tr>
                        <tr>
                            <th>Program Studi</th>
                            <td>: {{ $mahasiswa->jurusan->nama_jurusan }}</td>
                        </tr>
                        <tr>
                            <th>Jurusan</th>
                            <td>: {{ $mahasiswa->jurusan->nama_jurusan }}</td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-4 text-center">
                    <div class="border p-3">
                        <h6>INDEKS PRESTASI KUMULATIF</h6>
                        <div class="display-3 text-primary">
                            @php
                            $totalSKS = $mahasiswa->nilais->count() * 3; // Asumsi 3 SKS per mata kuliah
                            $totalNilai = 0;

                            foreach($mahasiswa->nilais as $nilai) {
                            $bobot = 0;
                            if($nilai->grade == 'A') $bobot = 4.0;
                            elseif($nilai->grade == 'B') $bobot = 3.0;
                            elseif($nilai->grade == 'C') $bobot = 2.0;
                            elseif($nilai->grade == 'D') $bobot = 1.0;
                            else $bobot = 0;

                            $totalNilai += $bobot * 3; // 3 SKS
                            }

                            $ipk = $totalSKS > 0 ? $totalNilai / $totalSKS : 0;
                            @endphp
                            {{ number_format($ipk, 2) }}
                        </div>
                        <p class="mb-0">IPK</p>
                    </div>
                </div>
            </div>

            <!-- Daftar Nilai -->


            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Kode MK</th>
                            <th>Mata Kuliah</th>
                            <th>SKS</th>
                            <th>Nilai UTS</th>
                            <th>Nilai UAS</th>
                            <th>Nilai Tugas</th>
                            <th>Nilai Akhir</th>
                            <th>Grade</th>
                            <th>Bobot</th>
                            <th>Nilai x SKS</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $totalSKS = 0;
                        $totalNilaiSKS = 0;
                        @endphp

                        @foreach($mahasiswa->nilais as $nilai)
                        @php
                        $sks = $nilai->mataKuliah ? $nilai->mataKuliah->sks : 0;
                        $totalSKS += $sks;

                        // Konversi grade ke bobot
                        if($nilai->grade == 'A') $bobot = 4.0;
                        elseif($nilai->grade == 'B') $bobot = 3.0;
                        elseif($nilai->grade == 'C') $bobot = 2.0;
                        elseif($nilai->grade == 'D') $bobot = 1.0;
                        else $bobot = 0;

                        $nilaiSKS = $bobot * $sks;
                        $totalNilaiSKS += $nilaiSKS;
                        @endphp
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td class="text-center">{{ $nilai->mataKuliah ? $nilai->mataKuliah->kode_mk : '-' }}</td>
                            <td>{{ $nilai->mataKuliah ? $nilai->mataKuliah->nama_mk : '-' }}</td>
                            <td class="text-center">{{ $sks }}</td>
                            <td class="text-center">{{ $nilai->nilai_uts }}</td>
                            <td class="text-center">{{ $nilai->nilai_uas }}</td>
                            <td class="text-center">{{ $nilai->nilai_tugas }}</td>
                            <td class="text-center">{{ $nilai->nilai_akhir }}</td>
                            <td class="text-center">
                                <span class="badge bg-{{ $nilai->grade == 'A' ? 'success' : ($nilai->grade == 'B' ? 'info' : ($nilai->grade == 'C' ? 'warning' : ($nilai->grade == 'D' ? 'orange' : 'danger'))) }}">
                                    {{ $nilai->grade }}
                                </span>
                            </td>
                            <td class="text-center">{{ number_format($bobot, 1) }}</td>
                            <td class="text-center">{{ number_format($nilaiSKS, 1) }}</td>
                        </tr>
                        @endforeach

                        <!-- Total -->
                        <tr class="table-success">
                            <td colspan="3" class="text-end"><strong>TOTAL</strong></td>
                            <td class="text-center"><strong>{{ $totalSKS }}</strong></td>
                            <td colspan="5"></td>
                            <td class="text-center"><strong>{{ number_format($totalNilaiSKS, 1) }}</strong></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Hitung IPK -->
            @php
            $ipk = $totalSKS > 0 ? $totalNilaiSKS / $totalSKS : 0;
            @endphp

            <!-- ... kode setelahnya ... -->

            <!-- Statistik -->
            <div class="row mt-4">
                <div class="col-md-4">
                    <div class="card text-center">
                        <div class="card-body">
                            <h6>Rata-rata Nilai</h6>
                            <h3 class="text-primary">
                                {{ number_format($mahasiswa->nilais->avg('nilai_akhir') ?? 0, 2) }}
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-center">
                        <div class="card-body">
                            <h6>Total Mata Kuliah</h6>
                            <h3 class="text-success">{{ $mahasiswa->nilais->count() }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-center">
                        <div class="card-body">
                            <h6>Indeks Prestasi</h6>
                            <h3 class="text-warning">{{ number_format($ipk, 2) }}</h3>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Keterangan -->
            <div class="card mt-4">
                <div class="card-header">
                    <h6 class="mb-0"><i class="fas fa-info-circle"></i> Keterangan</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h6>Konversi Nilai:</h6>
                            <p class="mb-1">A = 4.00 (86-100)</p>
                            <p class="mb-1">B = 3.00 (76-85)</p>
                            <p class="mb-1">C = 2.00 (66-75)</p>
                            <p class="mb-1">D = 1.00 (56-65)</p>
                            <p class="mb-0">E = 0.00 (0-55)</p>
                        </div>
                        <div class="col-md-6">
                            <h6>Rumus IPK:</h6>
                            <p>IPK = Σ (Nilai × SKS) ÷ Σ SKS</p>
                            <p class="mb-0">SKS = Satuan Kredit Semester (3 SKS per mata kuliah)</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div class="row mt-4">
                <div class="col-md-6">
                    <div class="card bg-light">
                        <div class="card-body">
                            <h6>Informasi Cetak</h6>
                            <p class="mb-1">Dicetak oleh: <strong>{{ Auth::user()->name }}</strong></p>
                            <p class="mb-1">Tanggal: <strong>{{ date('d/m/Y') }}</strong></p>
                            <p class="mb-0">Waktu: <strong>{{ date('H:i:s') }}</strong></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 text-end">
                    <div class="mt-4">
                        <p>Mengetahui,</p>
                        <br><br><br>
                        <p><strong>Kepala Jurusan</strong></p>
                        <p>{{ $mahasiswa->jurusan->nama_jurusan }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection