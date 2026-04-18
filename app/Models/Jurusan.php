<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Jurusan extends Model
{
      use HasFactory;
    protected $table = 'jurusans';
    
    protected $fillable = [
        'kode_jurusan', 'nama_jurusan', 'deskripsi'
    ];

    public function mahasiswas()
    {
        return $this->hasMany(Mahasiswa::class);
    }

    public function mataKuliahs()
    {
        return $this->hasMany(MataKuliah::class);
    }
}