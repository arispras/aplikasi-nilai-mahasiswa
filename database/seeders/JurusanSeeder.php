<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Jurusan;

class JurusanSeeder extends Seeder
{
    public function run()
    {
        $jurusans = [
            [
                'kode_jurusan' => 'TI',
                'nama_jurusan' => 'Teknik Informatika',
                'deskripsi' => 'Jurusan yang mempelajari pemrograman dan teknologi informasi'
            ],
            [
                'kode_jurusan' => 'SI',
                'nama_jurusan' => 'Sistem Informasi',
                'deskripsi' => 'Jurusan yang mempelajari sistem informasi bisnis'
            ],
            [
                'kode_jurusan' => 'TK',
                'nama_jurusan' => 'Teknik Komputer',
                'deskripsi' => 'Jurusan yang mempelajari hardware dan jaringan komputer'
            ],
            [
                'kode_jurusan' => 'MI',
                'nama_jurusan' => 'Manajemen Informatika',
                'deskripsi' => 'Jurusan yang mempelajari manajemen teknologi informasi'
            ],
        ];

        foreach ($jurusans as $jurusan) {
            Jurusan::create($jurusan);
        }
    }
}