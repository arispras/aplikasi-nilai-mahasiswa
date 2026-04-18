@extends('layouts.app')

@section('title', 'Edit Jurusan')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><i class="fas fa-edit"></i> Edit Jurusan</h2>
        <div>
            <a href="{{ route('jurusan.show', $jurusan) }}" class="btn btn-info">
                <i class="fas fa-eye"></i> Detail
            </a>
            <a href="{{ route('jurusan.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>
    
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Form Edit Jurusan</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('jurusan.update', $jurusan) }}" method="POST" class="needs-validation" novalidate>
                @csrf
                @method('PUT')
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="kode_jurusan" class="form-label">Kode Jurusan *</label>
                        <input type="text" class="form-control @error('kode_jurusan') is-invalid @enderror" 
                               id="kode_jurusan" name="kode_jurusan" 
                               value="{{ old('kode_jurusan', $jurusan->kode_jurusan) }}" 
                               required maxlength="10">
                        @error('kode_jurusan')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="nama_jurusan" class="form-label">Nama Jurusan *</label>
                        <input type="text" class="form-control @error('nama_jurusan') is-invalid @enderror" 
                               id="nama_jurusan" name="nama_jurusan" 
                               value="{{ old('nama_jurusan', $jurusan->nama_jurusan) }}"
                               required maxlength="100">
                        @error('nama_jurusan')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi</label>
                    <textarea class="form-control @error('deskripsi') is-invalid @enderror" 
                              id="deskripsi" name="deskripsi" rows="4">{{ old('deskripsi', $jurusan->deskripsi) }}</textarea>
                    @error('deskripsi')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="card bg-light">
                            <div class="card-body">
                                <h6><i class="fas fa-info-circle"></i> Informasi</h6>
                                <p class="mb-1"><strong>Dibuat:</strong> {{ $jurusan->created_at->format('d/m/Y H:i') }}</p>
                                <p class="mb-1"><strong>Diupdate:</strong> {{ $jurusan->updated_at->format('d/m/Y H:i') }}</p>
                                <p class="mb-0"><strong>Total Mahasiswa:</strong> {{ $jurusan->mahasiswas->count() }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="text-end">
                    <button type="reset" class="btn btn-secondary">
                        <i class="fas fa-redo"></i> Reset
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Update Jurusan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection