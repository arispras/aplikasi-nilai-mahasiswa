@extends('layouts.app')

@section('title', 'Tambah Mata Kuliah')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><i class="fas fa-plus-circle"></i> Tambah Mata Kuliah</h2>
        <a href="{{ route('mata-kuliah.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>
    
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Form Tambah Mata Kuliah</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('mata-kuliah.store') }}" method="POST" class="needs-validation" novalidate>
                @csrf
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="kode_mk" class="form-label">Kode Mata Kuliah *</label>
                        <input type="text" class="form-control @error('kode_mk') is-invalid @enderror" 
                               id="kode_mk" name="kode_mk" 
                               value="{{ old('kode_mk') }}" 
                               placeholder="Contoh: TI101, SI201"
                               required maxlength="10">
                        <div class="form-text">Maksimal 10 karakter, harus unik</div>
                        @error('kode_mk')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="nama_mk" class="form-label">Nama Mata Kuliah *</label>
                        <input type="text" class="form-control @error('nama_mk') is-invalid @enderror" 
                               id="nama_mk" name="nama_mk" 
                               value="{{ old('nama_mk') }}"
                               placeholder="Contoh: Pemrograman Web, Basis Data"
                               required maxlength="100">
                        @error('nama_mk')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="sks" class="form-label">SKS *</label>
                        <select class="form-select @error('sks') is-invalid @enderror" 
                                id="sks" name="sks" required>
                            <option value="">Pilih SKS</option>
                            @for($i = 1; $i <= 6; $i++)
                            <option value="{{ $i }}" {{ old('sks') == $i ? 'selected' : '' }}>
                                {{ $i }} SKS
                            </option>
                            @endfor
                        </select>
                        @error('sks')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-4 mb-3">
                        <label for="semester" class="form-label">Semester *</label>
                        <select class="form-select @error('semester') is-invalid @enderror" 
                                id="semester" name="semester" required>
                            <option value="">Pilih Semester</option>
                            @for($i = 1; $i <= 8; $i++)
                            <option value="{{ $i }}" {{ old('semester') == $i ? 'selected' : '' }}>
                                Semester {{ $i }}
                            </option>
                            @endfor
                        </select>
                        @error('semester')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-4 mb-3">
                        <label for="jurusan_id" class="form-label">Jurusan *</label>
                        <select class="form-select @error('jurusan_id') is-invalid @enderror" 
                                id="jurusan_id" name="jurusan_id" required>
                            <option value="">Pilih Jurusan</option>
                            @foreach($jurusans as $jurusan)
                            <option value="{{ $jurusan->id }}" {{ old('jurusan_id') == $jurusan->id ? 'selected' : '' }}>
                                {{ $jurusan->nama_jurusan }}
                            </option>
                            @endforeach
                        </select>
                        @error('jurusan_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="mb-4">
                    <label for="deskripsi" class="form-label">Deskripsi Mata Kuliah</label>
                    <textarea class="form-control @error('deskripsi') is-invalid @enderror" 
                              id="deskripsi" name="deskripsi" rows="4"
                              placeholder="Deskripsi singkat tentang mata kuliah">{{ old('deskripsi') }}</textarea>
                    @error('deskripsi')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="alert alert-info">
                    <i class="fas fa-info-circle"></i> 
                    <strong>Informasi:</strong> Setelah mata kuliah dibuat, Anda dapat menambahkan nilai untuk mata kuliah ini.
                </div>
                
                <div class="text-end">
                    <button type="reset" class="btn btn-secondary">
                        <i class="fas fa-redo"></i> Reset
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Simpan Mata Kuliah
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection