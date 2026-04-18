<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Mahasiswa extends Model
{
       use HasFactory;
    protected $table = 'mahasiswas';
    
    protected $fillable = [
        'nim', 'nama', 'jurusan_id', 'alamat', 'email', 
        'telepon', 'jenis_kelamin', 'tanggal_lahir'
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
    ];

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class);
    }

    public function nilais()
    {
        return $this->hasMany(Nilai::class);
    }

    // Hitung IPK
    public function getIpkAttribute()
    {
        $totalSKS = 0;
        $totalNilaiSKS = 0;
        
        foreach ($this->nilais as $nilai) {
            $sks = $nilai->mataKuliah ? $nilai->mataKuliah->sks : 3; // Default 3 SKS jika tidak ada
            $totalSKS += $sks;
            
            // Konversi grade ke bobot
            $bobot = $this->gradeToBobot($nilai->grade);
            $totalNilaiSKS += $bobot * $sks;
        }
        
        return $totalSKS > 0 ? round($totalNilaiSKS / $totalSKS, 2) : 0;
    }

    private function gradeToBobot($grade)
    {
        switch ($grade) {
            case 'A': return 4.0;
            case 'B': return 3.0;
            case 'C': return 2.0;
            case 'D': return 1.0;
            default: return 0;
        }
    }

    // Total SKS yang sudah diambil
    public function getTotalSksAttribute()
    {
        $total = 0;
        foreach ($this->nilais as $nilai) {
            $total += $nilai->mataKuliah ? $nilai->mataKuliah->sks : 3;
        }
        return $total;
    }
}