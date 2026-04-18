@extends('layouts.app')

@section('title', 'Edit Mata Kuliah')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><i class="fas fa-edit"></i> Edit Mata Kuliah</h2>
        <div>
            <a href="{{ route('mata-kuliah.show', $mataKuliah) }}" class="btn btn-info">
                <i class="fas fa-eye"></i> Detail
            </a>
            <a href="{{ route('mata-kuliah.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>
    
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Form Edit Mata Kuliah</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('mata-kuliah.update', $mataKuliah) }}" method="POST" class="needs-validation" novalidate>
                @csrf
                @method('PUT')
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="kode_mk" class="form-label">Kode Mata Kuliah *</label>
                        <input type="text" class="form-control @error('kode_mk') is-invalid @enderror" 
                               id="kode_mk" name="kode_mk" 
                               value="{{ old('kode_mk', $mataKuliah->kode_mk) }}" 
                               required maxlength="10">
                        @error('kode_mk')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="nama_mk" class="form-label">Nama Mata Kuliah *</label>
                        <input type="text" class="form-control @error('nama_mk') is-invalid @enderror" 
                               id="nama_mk" name="nama_mk" 
                               value="{{ old('nama_mk', $mataKuliah->nama_mk) }}"
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
                            @for($i = 1; $i <= 6; $i++)
                            <option value="{{ $i }}" {{ old('sks', $mataKuliah->sks) == $i ? 'selected' : '' }}>
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
                            @for($i = 1; $i <= 8; $i++)
                            <option value="{{ $i }}" {{ old('semester', $mataKuliah->semester) == $i ? 'selected' : '' }}>
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
                            @foreach($jurusans as $jurusan)
                            <option value="{{ $jurusan->id }}" {{ old('jurusan_id', $mataKuliah->jurusan_id) == $jurusan->id ? 'selected' : '' }}>
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
                              id="deskripsi" name="deskripsi" rows="4">{{ old('deskripsi', $mataKuliah->deskripsi) }}</textarea>
                    @error('deskripsi')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="card bg-light">
                            <div class="card-body">
                                <h6><i class="fas fa-info-circle"></i> Informasi</h6>
                                <p class="mb-1"><strong>Dibuat:</strong> {{ $mataKuliah->created_at->format('d/m/Y H:i') }}</p>
                                <p class="mb-1"><strong>Diupdate:</strong> {{ $mataKuliah->updated_at->format('d/m/Y H:i') }}</p>
                                <p class="mb-0"><strong>Total Nilai:</strong> {{ $mataKuliah->nilais->count() }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="text-end">
                    <button type="reset" class="btn btn-secondary">
                        <i class="fas fa-redo"></i> Reset
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Update Mata Kuliah
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection