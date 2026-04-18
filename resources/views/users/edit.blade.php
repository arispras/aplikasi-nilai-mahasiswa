@extends('layouts.app')

@section('title', 'Edit User')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><i class="fas fa-user-edit"></i> Edit User</h2>
        <a href="{{ route('users.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>
    
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Form Edit User</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('users.update', $user) }}" method="POST" class="needs-validation" novalidate>
                @csrf
                @method('PUT')
                
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="card bg-light">
                            <div class="card-body">
                                <h6><i class="fas fa-info-circle"></i> Informasi User</h6>
                                <p class="mb-1"><strong>Dibuat:</strong> {{ $user->created_at->format('d/m/Y H:i') }}</p>
                                <p class="mb-1"><strong>Email Verified:</strong> 
                                    @if($user->email_verified_at)
                                        {{ $user->email_verified_at->format('d/m/Y H:i') }}
                                    @else
                                        <span class="badge bg-warning">Belum Verifikasi</span>
                                    @endif
                                </p>
                                <p class="mb-0"><strong>Role Saat Ini:</strong> 
                                    @if($user->role == 'admin')
                                        <span class="badge bg-danger">Administrator</span>
                                    @else
                                        <span class="badge bg-primary">User Biasa</span>
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="name" class="form-label">Nama Lengkap *</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" 
                               id="name" name="name" 
                               value="{{ old('name', $user->name) }}"
                               required>
                        @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="email" class="form-label">Email *</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" 
                               id="email" name="email" 
                               value="{{ old('email', $user->email) }}"
                               required>
                        @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="password" class="form-label">Password Baru</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" 
                               id="password" name="password" 
                               placeholder="Kosongkan jika tidak ingin mengubah">
                        <div class="form-text">Minimal 6 karakter</div>
                        @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="password_confirmation" class="form-label">Konfirmasi Password Baru</label>
                        <input type="password" class="form-control" 
                               id="password_confirmation" name="password_confirmation" 
                               placeholder="Konfirmasi password baru">
                    </div>
                </div>
                
                <div class="mb-4">
                    <label for="role" class="form-label">Role *</label>
                    <select class="form-select @error('role') is-invalid @enderror" 
                            id="role" name="role" required>
                        <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Administrator</option>
                        <option value="nonadmin" {{ old('role', $user->role) == 'nonadmin' ? 'selected' : '' }}>User Biasa</option>
                    </select>
                    @error('role')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                @if($user->id == auth()->id())
                <div class="alert alert-info">
                    <i class="fas fa-info-circle"></i> 
                    Anda sedang mengedit akun sendiri. Hati-hati dalam mengubah role.
                </div>
                @endif
                
                <div class="text-end">
                    <button type="reset" class="btn btn-secondary">
                        <i class="fas fa-redo"></i> Reset Form
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Update User
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection