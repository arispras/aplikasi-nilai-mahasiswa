<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class MataKuliah extends Model
{
    use HasFactory;
    protected $table = 'mata_kuliahs';
    
    protected $fillable = [
        'kode_mk', 'nama_mk', 'sks', 'jurusan_id', 'semester', 'deskripsi'
    ];

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class);
    }

    public function nilais()
    {
        return $this->hasMany(Nilai::class);
    }

    // Scope untuk filter
    public function scopeByJurusan($query, $jurusan_id)
    {
        return $query->where('jurusan_id', $jurusan_id);
    }

    public function scopeBySemester($query, $semester)
    {
        return $query->where('semester', $semester);
    }
}