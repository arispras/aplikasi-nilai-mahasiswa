@extends('layouts.app')

@section('title', 'Edit Nilai')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><i class="fas fa-edit"></i> Edit Nilai</h2>
        <div>
            <a href="{{ route('nilai.show', $nilai) }}" class="btn btn-info">
                <i class="fas fa-eye"></i> Detail
            </a>
            <a href="{{ route('nilai.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>
    
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Form Edit Nilai</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('nilai.update', $nilai) }}" method="POST" class="needs-validation" novalidate>
                @csrf
                @method('PUT')
                
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="card bg-light">
                            <div class="card-body">
                                <h6><i class="fas fa-user-graduate"></i> Informasi Mahasiswa</h6>
                                <p class="mb-1"><strong>Nama:</strong> {{ $nilai->mahasiswa->nama }}</p>
                                <p class="mb-1"><strong>NIM:</strong> {{ $nilai->mahasiswa->nim }}</p>
                                <p class="mb-0"><strong>Jurusan:</strong> {{ $nilai->mahasiswa->jurusan->nama_jurusan }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card bg-light">
                            <div class="card-body">
                                <h6><i class="fas fa-book"></i> Informasi Mata Kuliah</h6>
                                <p class="mb-1"><strong>Kode:</strong> {{ $nilai->mataKuliah->kode_mk ?? '-' }}</p>
                                <p class="mb-1"><strong>Nama:</strong> {{ $nilai->mataKuliah->nama_mk ?? '-' }}</p>
                                <p class="mb-0"><strong>SKS:</strong> {{ $nilai->mataKuliah->sks ?? '-' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="mahasiswa_id" class="form-label">Mahasiswa *</label>
                        <select class="form-select @error('mahasiswa_id') is-invalid @enderror" 
                                id="mahasiswa_id" name="mahasiswa_id" required>
                            @foreach($mahasiswas as $mahasiswa)
                            <option value="{{ $mahasiswa->id }}" {{ old('mahasiswa_id', $nilai->mahasiswa_id) == $mahasiswa->id ? 'selected' : '' }}>
                                {{ $mahasiswa->nim }} - {{ $mahasiswa->nama }}
                            </option>
                            @endforeach
                        </select>
                        @error('mahasiswa_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="mata_kuliah_id" class="form-label">Mata Kuliah *</label>
                        <select class="form-select @error('mata_kuliah_id') is-invalid @enderror" 
                                id="mata_kuliah_id" name="mata_kuliah_id" required>
                            @foreach($mataKuliahs as $mk)
                            <option value="{{ $mk->id }}" {{ old('mata_kuliah_id', $nilai->mata_kuliah_id) == $mk->id ? 'selected' : '' }}>
                                {{ $mk->kode_mk }} - {{ $mk->nama_mk }} ({{ $mk->sks }} SKS)
                            </option>
                            @endforeach
                        </select>
                        @error('mata_kuliah_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="nilai_uts" class="form-label">Nilai UTS *</label>
                        <div class="input-group">
                            <input type="number" class="form-control @error('nilai_uts') is-invalid @enderror" 
                                   id="nilai_uts" name="nilai_uts" 
                                   value="{{ old('nilai_uts', $nilai->nilai_uts) }}" 
                                   min="0" max="100" step="0.01"
                                   required>
                            <span class="input-group-text">/ 100</span>
                        </div>
                        @error('nilai_uts')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-4 mb-3">
                        <label for="nilai_uas" class="form-label">Nilai UAS *</label>
                        <div class="input-group">
                            <input type="number" class="form-control @error('nilai_uas') is-invalid @enderror" 
                                   id="nilai_uas" name="nilai_uas" 
                                   value="{{ old('nilai_uas', $nilai->nilai_uas) }}" 
                                   min="0" max="100" step="0.01"
                                   required>
                            <span class="input-group-text">/ 100</span>
                        </div>
                        @error('nilai_uas')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-4 mb-3">
                        <label for="nilai_tugas" class="form-label">Nilai Tugas *</label>
                        <div class="input-group">
                            <input type="number" class="form-control @error('nilai_tugas') is-invalid @enderror" 
                                   id="nilai_tugas" name="nilai_tugas" 
                                   value="{{ old('nilai_tugas', $nilai->nilai_tugas) }}" 
                                   min="0" max="100" step="0.01"
                                   required>
                            <span class="input-group-text">/ 100</span>
                        </div>
                        @error('nilai_tugas')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <!-- Current Grade Display -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h6 class="mb-0"><i class="fas fa-chart-line"></i> Nilai Saat Ini</h6>
                    </div>
                    <div class="card-body">
                        <div class="row text-center">
                            <div class="col-md-3">
                                <h6>UTS</h6>
                                <div class="display-6">{{ $nilai->nilai_uts }}</div>
                            </div>
                            <div class="col-md-3">
                                <h6>UAS</h6>
                                <div class="display-6">{{ $nilai->nilai_uas }}</div>
                            </div>
                            <div class="col-md-3">
                                <h6>Tugas</h6>
                                <div class="display-6">{{ $nilai->nilai_tugas }}</div>
                            </div>
                            <div class="col-md-3">
                                <h6>Nilai Akhir</h6>
                                <div class="display-4 text-primary">{{ $nilai->nilai_akhir }}</div>
                                <span class="badge bg-{{ $nilai->grade == 'A' ? 'success' : ($nilai->grade == 'B' ? 'info' : ($nilai->grade == 'C' ? 'warning' : ($nilai->grade == 'D' ? 'orange' : 'danger'))) }} fs-5">
                                    Grade {{ $nilai->grade }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="text-end">
                    <button type="reset" class="btn btn-secondary">
                        <i class="fas fa-redo"></i> Reset Form
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Update Nilai
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Filter mata kuliah berdasarkan mahasiswa yang dipilih
    const mahasiswaSelect = document.getElementById('mahasiswa_id');
    const mataKuliahSelect = document.getElementById('mata_kuliah_id');
    
    mahasiswaSelect.addEventListener('change', function() {
        const mahasiswaId = this.value;
        
        if (mahasiswaId) {
            // Reset select
            mataKuliahSelect.innerHTML = '<option value="">Loading...</option>';
            
            // Fetch mata kuliah berdasarkan jurusan mahasiswa
            fetch(`/get-mata-kuliah-by-mahasiswa/${mahasiswaId}`)
                .then(response => response.json())
                .then(data => {
                    mataKuliahSelect.innerHTML = '<option value="">Pilih Mata Kuliah</option>';
                    data.forEach(mk => {
                        const option = document.createElement('option');
                        option.value = mk.id;
                        option.textContent = `${mk.kode_mk} - ${mk.nama_mk} (${mk.sks} SKS)`;
                        mataKuliahSelect.appendChild(option);
                    });
                    
                    // Set selected value jika ada
                    const currentMkId = '{{ old("mata_kuliah_id", $nilai->mata_kuliah_id) }}';
                    if (currentMkId) {
                        mataKuliahSelect.value = currentMkId;
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    mataKuliahSelect.innerHTML = '<option value="">Error loading data</option>';
                });
        } else {
            mataKuliahSelect.innerHTML = '<option value="">Pilih Mata Kuliah</option>';
        }
    });
    
    // Trigger change event jika mahasiswa sudah terpilih
    if (mahasiswaSelect.value) {
        mahasiswaSelect.dispatchEvent(new Event('change'));
    }
});
</script>
@endpush
@endsection