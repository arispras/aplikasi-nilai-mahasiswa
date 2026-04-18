<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MataKuliah;
use App\Models\Jurusan;

class MataKuliahSeeder extends Seeder
{
    public function run()
    {
        $jurusans = Jurusan::all();
        
        $mataKuliahs = [
            // Teknik Informatika
            [
                'kode_mk' => 'TI101',
                'nama_mk' => 'Algoritma dan Pemrograman',
                'sks' => 3,
                'semester' => 1,
                'deskripsi' => 'Mata kuliah dasar pemrograman'
            ],
            [
                'kode_mk' => 'TI102',
                'nama_mk' => 'Basis Data',
                'sks' => 3,
                'semester' => 2,
                'deskripsi' => 'Konsep dan implementasi basis data'
            ],
            [
                'kode_mk' => 'TI201',
                'nama_mk' => 'Pemrograman Web',
                'sks' => 3,
                'semester' => 3,
                'deskripsi' => 'Pengembangan aplikasi web'
            ],
            [
                'kode_mk' => 'TI202',
                'nama_mk' => 'Jaringan Komputer',
                'sks' => 3,
                'semester' => 4,
                'deskripsi' => 'Konsep jaringan komputer'
            ],
            // Sistem Informasi
            [
                'kode_mk' => 'SI101',
                'nama_mk' => 'Sistem Informasi Manajemen',
                'sks' => 3,
                'semester' => 1,
                'deskripsi' => 'Konsep sistem informasi'
            ],
            [
                'kode_mk' => 'SI102',
                'nama_mk' => 'Analisis Sistem',
                'sks' => 3,
                'semester' => 2,
                'deskripsi' => 'Analisis dan desain sistem'
            ],
        ];

        foreach ($mataKuliahs as $index => $mk) {
            $jurusanIndex = $index < 4 ? 0 : 1; // 4 pertama TI, 2 berikutnya SI
            if (isset($jurusans[$jurusanIndex])) {
                MataKuliah::create(array_merge($mk, [
                    'jurusan_id' => $jurusans[$jurusanIndex]->id
                ]));
            }
        }
    }
}