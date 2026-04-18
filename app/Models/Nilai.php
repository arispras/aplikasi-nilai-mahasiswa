<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Nilai extends Model
{
       use HasFactory;
    protected $table = 'nilais';
    
    protected $fillable = [
        'mahasiswa_id', 'mata_kuliah_id', 'nilai_uts', 
        'nilai_uas', 'nilai_tugas', 'nilai_akhir', 'grade'
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class);
    }

    public function mataKuliah()
    {
        return $this->belongsTo(MataKuliah::class);
    }

    // Hitung nilai akhir dan grade
    public static function hitungNilaiAkhir($uts, $uas, $tugas)
    {
        $nilai_akhir = ($uts * 0.3) + ($uas * 0.4) + ($tugas * 0.3);
        
        if ($nilai_akhir >= 85) $grade = 'A';
        elseif ($nilai_akhir >= 75) $grade = 'B';
        elseif ($nilai_akhir >= 65) $grade = 'C';
        elseif ($nilai_akhir >= 55) $grade = 'D';
        else $grade = 'E';
        
        return [
            'nilai_akhir' => round($nilai_akhir, 2),
            'grade' => $grade
        ];
    }

    // Accessor untuk mendapatkan nama mata kuliah
    public function getNamaMataKuliahAttribute()
    {
        return $this->mataKuliah ? $this->mataKuliah->nama_mk : '-';
    }

    public function getKodeMataKuliahAttribute()
    {
        return $this->mataKuliah ? $this->mataKuliah->kode_mk : '-';
    }
}