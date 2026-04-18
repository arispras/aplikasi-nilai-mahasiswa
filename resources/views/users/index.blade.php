@extends('layouts.app')

@section('title', 'Manajemen User')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><i class="fas fa-user-cog"></i> Manajemen User</h2>
        <a href="{{ route('users.create') }}" class="btn btn-primary">
            <i class="fas fa-user-plus"></i> Tambah User
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
            <h5 class="mb-0">Daftar Pengguna Sistem</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Email Verified</th>
                            <th>Dibuat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="avatar-sm me-2">
                                        <div class="avatar-title bg-primary rounded-circle">
                                            {{ substr($user->name, 0, 1) }}
                                        </div>
                                    </div>
                                    <div>
                                        <strong>{{ $user->name }}</strong>
                                        @if($user->id == auth()->id())
                                            <span class="badge bg-success ms-1">Anda</span>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @if($user->role == 'admin')
                                <span class="badge bg-danger">Administrator</span>
                                @else
                                <span class="badge bg-primary">User Biasa</span>
                                @endif
                            </td>
                            <td>
                                @if($user->email_verified_at)
                                <span class="badge bg-success">Terverifikasi</span>
                                @else
                                <span class="badge bg-warning">Belum Verifikasi</span>
                                @endif
                            </td>
                            <td>{{ $user->created_at->format('d/m/Y') }}</td>
                            <td>
                                <a href="{{ route('users.edit', $user) }}" class="btn btn-sm btn-warning" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                
                                @if($user->id != auth()->id())
                                <button onclick="confirmDelete('delete-form-{{ $user->id }}', 'User {{ $user->name }} akan dihapus permanen!')" 
                                        class="btn btn-sm btn-danger" title="Hapus">
                                    <i class="fas fa-trash"></i>
                                </button>
                                <form id="delete-form-{{ $user->id }}" 
                                      action="{{ route('users.destroy', $user) }}" 
                                      method="POST" class="d-none">
                                    @csrf
                                    @method('DELETE')
                                </form>
                                @else
                                <button class="btn btn-sm btn-secondary" title="Tidak dapat menghapus akun sendiri" disabled>
                                    <i class="fas fa-trash"></i>
                                </button>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <div class="row mt-3">
                <div class="col-md-6">
                    <div class="card bg-light">
                        <div class="card-body py-2">
                            <div class="row">
                                <div class="col-4 text-center border-end">
                                    <h5 class="mb-0 text-primary">{{ $users->count() }}</h5>
                                    <small class="text-muted">Total User</small>
                                </div>
                                <div class="col-4 text-center border-end">
                                    <h5 class="mb-0 text-danger">{{ $users->where('role', 'admin')->count() }}</h5>
                                    <small class="text-muted">Admin</small>
                                </div>
                                <div class="col-4 text-center">
                                    <h5 class="mb-0 text-primary">{{ $users->where('role', 'nonadmin')->count() }}</h5>
                                    <small class="text-muted">User Biasa</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="card mt-4">
        <div class="card-header">
            <h5 class="mb-0"><i class="fas fa-info-circle"></i> Informasi Hak Akses</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="card border-danger">
                        <div class="card-header bg-danger text-white">
                            <h6 class="mb-0">Administrator</h6>
                        </div>
                        <div class="card-body">
                            <ul class="mb-0">
                                <li>Mengelola semua data (CRUD)</li>
                                <li>Manajemen user (tambah/edit/hapus)</li>
                                <li>Akses semua laporan</li>
                                <li>Export data ke PDF</li>
                                <li>Full system access</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card border-primary">
                        <div class="card-header bg-primary text-white">
                            <h6 class="mb-0">User Biasa</h6>
                        </div>
                        <div class="card-body">
                            <ul class="mb-0">
                                <li>Hanya melihat data (Read Only)</li>
                                <li>Tidak bisa edit/hapus data</li>
                                <li>Tidak bisa akses manajemen user</li>
                                <li>Bisa cetak laporan terbatas</li>
                                <li>Limited access</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection