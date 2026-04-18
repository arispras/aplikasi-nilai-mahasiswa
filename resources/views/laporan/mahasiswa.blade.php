@extends('layouts.app')

@section('title', 'Laporan Data Mahasiswa')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><i class="fas fa-users"></i> Laporan Data Mahasiswa</h2>
        <div>
            <a href="{{ route('laporan.mahasiswa.pdf') }}" class="btn btn-danger">
                <i class="fas fa-file-pdf"></i> Download PDF
            </a>
            <a href="{{ route('laporan.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>
    
    <div class="card">
        <div class="card-header bg-primary text-white">
            <div class="row">
                <div class="col-md-6">
                    <h5 class="mb-0">Laporan Data Mahasiswa</h5>
                </div>
                <div class="col-md-6 text-end">
                    <small>Dicetak: {{ date('d/m/Y H:i:s') }}</small>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>NIM</th>
                            <th>Nama</th>
                            <th>Jurusan</th>
                            <th>Jenis Kelamin</th>
                            <th>Email</th>
                            <th>Telepon</th>
                            <th>Alamat</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($mahasiswas as $mahasiswa)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $mahasiswa->nim }}</td>
                            <td>{{ $mahasiswa->nama }}</td>
                            <td>{{ $mahasiswa->jurusan->nama_jurusan }}</td>
                            <td>{{ $mahasiswa->jenis_kelamin == 'L' ? 'L' : 'P' }}</td>
                            <td>{{ $mahasiswa->email }}</td>
                            <td>{{ $mahasiswa->telepon }}</td>
                            <td>{{ $mahasiswa->alamat }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <div class="row mt-4">
                <div class="col-md-6">
                    <div class="card bg-light">
                        <div class="card-body">
                            <h6>Statistik Mahasiswa</h6>
                            <p class="mb-1">Total Mahasiswa: <strong>{{ $mahasiswas->count() }}</strong></p>
                            <p class="mb-1">Laki-laki: <strong>{{ $mahasiswas->where('jenis_kelamin', 'L')->count() }}</strong></p>
                            <p class="mb-0">Perempuan: <strong>{{ $mahasiswas->where('jenis_kelamin', 'P')->count() }}</strong></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card bg-light">
                        <div class="card-body">
                            <h6>Informasi Laporan</h6>
                            <p class="mb-1">Dicetak oleh: <strong>{{ Auth::user()->name }}</strong></p>
                            <p class="mb-1">Tanggal: <strong>{{ date('d/m/Y') }}</strong></p>
                            <p class="mb-0">Waktu: <strong>{{ date('H:i:s') }}</strong></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection