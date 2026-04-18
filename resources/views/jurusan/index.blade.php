@extends('layouts.app')

@section('title', 'Data Jurusan')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><i class="fas fa-university"></i> Data Jurusan</h2>
        <a href="{{ route('jurusan.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Jurusan
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
            <h5 class="mb-0">Daftar Jurusan</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Kode Jurusan</th>
                            <th>Nama Jurusan</th>
                            <th>Deskripsi</th>
                            <th>Jumlah Mahasiswa</th>
                            <th>Dibuat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($jurusans as $jurusan)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><span class="badge bg-primary">{{ $jurusan->kode_jurusan }}</span></td>
                            <td><strong>{{ $jurusan->nama_jurusan }}</strong></td>
                            <td>{{ Str::limit($jurusan->deskripsi, 50) }}</td>
                            <td>
                                <span class="badge bg-info">{{ $jurusan->mahasiswas->count() }} Mahasiswa</span>
                            </td>
                            <td>{{ $jurusan->created_at->format('d/m/Y') }}</td>
                            <td>
                                <a href="{{ route('jurusan.show', $jurusan) }}" class="btn btn-sm btn-info" title="Detail">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('jurusan.edit', $jurusan) }}" class="btn btn-sm btn-warning" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button onclick="confirmDelete('delete-form-{{ $jurusan->id }}', 'Jurusan {{ $jurusan->nama_jurusan }} akan dihapus. Mahasiswa terkait juga akan terhapus!')" 
                                        class="btn btn-sm btn-danger" title="Hapus">
                                    <i class="fas fa-trash"></i>
                                </button>
                                <form id="delete-form-{{ $jurusan->id }}" 
                                      action="{{ route('jurusan.destroy', $jurusan) }}" 
                                      method="POST" class="d-none">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-4">
                                <i class="fas fa-database fa-2x mb-3"></i><br>
                                Belum ada data jurusan
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            @if($jurusans->count() > 0)
            <div class="mt-3">
                <div class="row">
                    <div class="col-md-6">
                        <p class="text-muted">Total: <strong>{{ $jurusans->count() }}</strong> jurusan</p>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection