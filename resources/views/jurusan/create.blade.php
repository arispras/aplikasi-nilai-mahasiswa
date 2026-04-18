@extends('layouts.app')

@section('title', 'Tambah Jurusan')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><i class="fas fa-plus-circle"></i> Tambah Jurusan</h2>
        <a href="{{ route('jurusan.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>
    
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Form Tambah Jurusan</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('jurusan.store') }}" method="POST" class="needs-validation" novalidate>
                @csrf
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="kode_jurusan" class="form-label">Kode Jurusan *</label>
                        <input type="text" class="form-control @error('kode_jurusan') is-invalid @enderror" 
                               id="kode_jurusan" name="kode_jurusan" 
                               value="{{ old('kode_jurusan') }}" 
                               placeholder="Contoh: TI, SI, TK"
                               required maxlength="10">
                        <div class="form-text">Maksimal 10 karakter, harus unik</div>
                        @error('kode_jurusan')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="nama_jurusan" class="form-label">Nama Jurusan *</label>
                        <input type="text" class="form-control @error('nama_jurusan') is-invalid @enderror" 
                               id="nama_jurusan" name="nama_jurusan" 
                               value="{{ old('nama_jurusan') }}"
                               placeholder="Contoh: Teknik Informatika"
                               required maxlength="100">
                        @error('nama_jurusan')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi</label>
                    <textarea class="form-control @error('deskripsi') is-invalid @enderror" 
                              id="deskripsi" name="deskripsi" rows="4"
                              placeholder="Deskripsi singkat tentang jurusan">{{ old('deskripsi') }}</textarea>
                    @error('deskripsi')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="alert alert-info">
                    <i class="fas fa-info-circle"></i> 
                    <strong>Perhatian:</strong> Setelah jurusan dibuat, Anda dapat menambahkan mahasiswa ke dalam jurusan ini.
                </div>
                
                <div class="text-end">
                    <button type="reset" class="btn btn-secondary">
                        <i class="fas fa-redo"></i> Reset
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Simpan Jurusan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection