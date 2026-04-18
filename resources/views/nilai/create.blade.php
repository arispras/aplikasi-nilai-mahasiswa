@extends('layouts.app')

@section('title', 'Input Nilai')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><i class="fas fa-plus-circle"></i> Input Nilai Baru</h2>
        <a href="{{ route('nilai.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>
    
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Form Input Nilai</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('nilai.store') }}" method="POST" class="needs-validation" novalidate>
                @csrf
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="mahasiswa_id" class="form-label">Mahasiswa *</label>
                        <select class="form-select @error('mahasiswa_id') is-invalid @enderror" 
                                id="mahasiswa_id" name="mahasiswa_id" required>
                            <option value="">Pilih Mahasiswa</option>
                            @foreach($mahasiswas as $mahasiswa)
                            <option value="{{ $mahasiswa->id }}" {{ old('mahasiswa_id') == $mahasiswa->id ? 'selected' : '' }}>
                                {{ $mahasiswa->nim }} - {{ $mahasiswa->nama }} ({{ $mahasiswa->jurusan->nama_jurusan }})
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
                            <option value="">Pilih Mata Kuliah</option>
                            @foreach($mataKuliahs as $mk)
                            <option value="{{ $mk->id }}" {{ old('mata_kuliah_id') == $mk->id ? 'selected' : '' }}>
                                {{ $mk->kode_mk }} - {{ $mk->nama_mk }} ({{ $mk->jurusan->nama_jurusan }})
                            </option>
                            @endforeach
                        </select>
                        <div class="form-text" id="mataKuliahInfo"></div>
                        @error('mata_kuliah_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="row mb-4">
                    <div class="col-md-4 mb-3">
                        <label for="nilai_uts" class="form-label">Nilai UTS *</label>
                        <div class="input-group">
                            <input type="number" class="form-control @error('nilai_uts') is-invalid @enderror" 
                                   id="nilai_uts" name="nilai_uts" 
                                   value="{{ old('nilai_uts') }}" 
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
                                   value="{{ old('nilai_uas') }}" 
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
                                   value="{{ old('nilai_tugas') }}" 
                                   min="0" max="100" step="0.01"
                                   required>
                            <span class="input-group-text">/ 100</span>
                        </div>
                        @error('nilai_tugas')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <!-- Preview Perhitungan -->
                <div class="card bg-light mb-4">
                    <div class="card-header">
                        <h6 class="mb-0"><i class="fas fa-calculator"></i> Preview Perhitungan</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 text-center">
                                <h6>UTS (30%)</h6>
                                <div class="display-6" id="utsPreview">0</div>
                            </div>
                            <div class="col-md-4 text-center">
                                <h6>UAS (40%)</h6>
                                <div class="display-6" id="uasPreview">0</div>
                            </div>
                            <div class="col-md-4 text-center">
                                <h6>Tugas (30%)</h6>
                                <div class="display-6" id="tugasPreview">0</div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-6 text-center">
                                <h6>Nilai Akhir</h6>
                                <div class="display-4 text-primary" id="nilaiAkhirPreview">0.00</div>
                            </div>
                            <div class="col-md-6 text-center">
                                <h6>Grade</h6>
                                <div class="display-4" id="gradePreview">-</div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="alert alert-info">
                    <i class="fas fa-info-circle"></i> 
                    <strong>Rumus Perhitungan:</strong> Nilai Akhir = (UTS × 30%) + (UAS × 40%) + (Tugas × 30%)
                    <br>
                    <strong>Grade:</strong> A (≥85), B (75-84), C (65-74), D (55-64), E (<55)
                </div>
                
                <div class="text-end">
                    <button type="reset" class="btn btn-secondary">
                        <i class="fas fa-redo"></i> Reset
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Simpan Nilai
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const mahasiswaSelect = document.getElementById('mahasiswa_id');
    const mataKuliahSelect = document.getElementById('mata_kuliah_id');
    const mataKuliahInfo = document.getElementById('mataKuliahInfo');
    const utsInput = document.getElementById('nilai_uts');
    const uasInput = document.getElementById('nilai_uas');
    const tugasInput = document.getElementById('nilai_tugas');
    
    const utsPreview = document.getElementById('utsPreview');
    const uasPreview = document.getElementById('uasPreview');
    const tugasPreview = document.getElementById('tugasPreview');
    const nilaiAkhirPreview = document.getElementById('nilaiAkhirPreview');
    const gradePreview = document.getElementById('gradePreview');
    
    // Filter mata kuliah berdasarkan jurusan mahasiswa
    mahasiswaSelect.addEventListener('change', function() {
        const mahasiswaId = this.value;
        mataKuliahSelect.innerHTML = '<option value="">Pilih Mata Kuliah</option>';
        mataKuliahInfo.textContent = '';
        
        if (mahasiswaId) {
            fetch(`/get-mata-kuliah-by-mahasiswa/${mahasiswaId}`)
                .then(response => response.json())
                .then(data => {
                    data.forEach(mk => {
                        const option = document.createElement('option');
                        option.value = mk.id;
                        option.textContent = `${mk.kode_mk} - ${mk.nama_mk} (${mk.sks} SKS)`;
                        mataKuliahSelect.appendChild(option);
                    });
                });
        }
    });
    
    // Show mata kuliah info
    mataKuliahSelect.addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        if (selectedOption.value) {
            const text = selectedOption.textContent;
            mataKuliahInfo.textContent = `Mata Kuliah: ${text}`;
        } else {
            mataKuliahInfo.textContent = '';
        }
    });
    
    function calculatePreview() {
        const uts = parseFloat(utsInput.value) || 0;
        const uas = parseFloat(uasInput.value) || 0;
        const tugas = parseFloat(tugasInput.value) || 0;
        
        // Update preview
        utsPreview.textContent = uts;
        uasPreview.textContent = uas;
        tugasPreview.textContent = tugas;
        
        // Calculate final score
        const nilaiAkhir = (uts * 0.3) + (uas * 0.4) + (tugas * 0.3);
        
        // Determine grade
        let grade = '-';
        let gradeColor = 'text-dark';
        
        if (nilaiAkhir >= 85) {
            grade = 'A';
            gradeColor = 'text-success';
        } else if (nilaiAkhir >= 75) {
            grade = 'B';
            gradeColor = 'text-info';
        } else if (nilaiAkhir >= 65) {
            grade = 'C';
            gradeColor = 'text-warning';
        } else if (nilaiAkhir >= 55) {
            grade = 'D';
            gradeColor = 'text-orange';
        } else if (nilaiAkhir > 0) {
            grade = 'E';
            gradeColor = 'text-danger';
        }
        
        // Update preview
        nilaiAkhirPreview.textContent = nilaiAkhir.toFixed(2);
        gradePreview.textContent = grade;
        gradePreview.className = `display-4 ${gradeColor}`;
    }
    
    // Add event listeners
    [utsInput, uasInput, tugasInput].forEach(input => {
        input.addEventListener('input', calculatePreview);
        input.addEventListener('change', calculatePreview);
    });
    
    // Initial calculation
    calculatePreview();
});
</script>
<style>
.text-orange {
    color: #ff9800 !important;
}
</style>
@endpush
@endsection