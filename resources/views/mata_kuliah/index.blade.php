@extends('layouts.app')

@section('title', 'Data Mata Kuliah')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><i class="fas fa-book-open"></i> Data Mata Kuliah</h2>
        <a href="{{ route('mata-kuliah.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Mata Kuliah
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
                    <h5 class="mb-0">Daftar Mata Kuliah</h5>
                </div>
                <div class="col-md-6">
                    <div class="input-group">
                        <input type="text" id="searchInput" class="form-control" placeholder="Cari kode atau nama mata kuliah...">
                        <button class="btn btn-outline-secondary" type="button" id="searchBtn">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-striped" id="mataKuliahTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Kode MK</th>
                            <th>Nama Mata Kuliah</th>
                            <th>SKS</th>
                            <th>Semester</th>
                            <th>Jurusan</th>
                            <th>Total Nilai</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($mataKuliahs as $mk)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><span class="badge bg-primary">{{ $mk->kode_mk }}</span></td>
                            <td>
                                <strong>{{ $mk->nama_mk }}</strong>
                                @if($mk->deskripsi)
                                <small class="d-block text-muted">{{ Str::limit($mk->deskripsi, 50) }}</small>
                                @endif
                            </td>
                            <td>
                                <span class="badge bg-info">{{ $mk->sks }} SKS</span>
                            </td>
                            <td>Semester {{ $mk->semester }}</td>
                            <td>{{ $mk->jurusan->nama_jurusan }}</td>
                            <td>
                                <span class="badge bg-success">{{ $mk->nilais->count() }} Nilai</span>
                            </td>
                            <td>
                                <a href="{{ route('mata-kuliah.show', $mk) }}" class="btn btn-sm btn-info" title="Detail">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('mata-kuliah.edit', $mk) }}" class="btn btn-sm btn-warning" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button onclick="confirmDelete('delete-form-{{ $mk->id }}')" 
                                        class="btn btn-sm btn-danger" title="Hapus">
                                    <i class="fas fa-trash"></i>
                                </button>
                                <form id="delete-form-{{ $mk->id }}" 
                                      action="{{ route('mata-kuliah.destroy', $mk) }}" 
                                      method="POST" class="d-none">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted py-4">
                                <i class="fas fa-book fa-2x mb-3"></i><br>
                                Belum ada data mata kuliah
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            @if($mataKuliahs->count() > 0)
            <div class="row mt-3">
                <div class="col-md-6">
                    <div class="card bg-light">
                        <div class="card-body py-2">
                            <div class="row">
                                <div class="col-4 text-center border-end">
                                    <h5 class="mb-0 text-primary">{{ $mataKuliahs->count() }}</h5>
                                    <small class="text-muted">Total MK</small>
                                </div>
                                <div class="col-4 text-center border-end">
                                    <h5 class="mb-0 text-success">{{ $mataKuliahs->sum('sks') }}</h5>
                                    <small class="text-muted">Total SKS</small>
                                </div>
                                <div class="col-4 text-center">
                                    @php
                                        $rataSKS = $mataKuliahs->count() > 0 ? $mataKuliahs->avg('sks') : 0;
                                    @endphp
                                    <h5 class="mb-0 text-info">{{ number_format($rataSKS, 1) }}</h5>
                                    <small class="text-muted">Rata-rata SKS</small>
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
    const table = document.getElementById('mataKuliahTable');
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