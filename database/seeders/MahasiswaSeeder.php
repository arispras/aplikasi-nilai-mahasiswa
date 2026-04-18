<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Mahasiswa;
use App\Models\Jurusan;

class MahasiswaSeeder extends Seeder
{
    public function run()
    {
        $jurusans = Jurusan::all();
        
        $mahasiswas = [
            // Teknik Informatika
            [
                'nim' => '20210001',
                'nama' => 'Budi Santoso',
                'alamat' => 'Jl. Merdeka No. 10, Jakarta',
                'email' => 'budi.santoso@email.com',
                'telepon' => '081234567890',
                'jenis_kelamin' => 'L',
                'tanggal_lahir' => '2000-05-15'
            ],
            [
                'nim' => '20210002',
                'nama' => 'Siti Rahayu',
                'alamat' => 'Jl. Sudirman No. 25, Bandung',
                'email' => 'siti.rahayu@email.com',
                'telepon' => '081234567891',
                'jenis_kelamin' => 'P',
                'tanggal_lahir' => '2001-03-20'
            ],
            [
                'nim' => '20210003',
                'nama' => 'Ahmad Hidayat',
                'alamat' => 'Jl. Gatot Subroto No. 5, Surabaya',
                'email' => 'ahmad.hidayat@email.com',
                'telepon' => '081234567892',
                'jenis_kelamin' => 'L',
                'tanggal_lahir' => '2000-11-10'
            ],
            // Sistem Informasi
            [
                'nim' => '20220001',
                'nama' => 'Dewi Anggraini',
                'alamat' => 'Jl. Thamrin No. 8, Yogyakarta',
                'email' => 'dewi.anggraini@email.com',
                'telepon' => '081234567893',
                'jenis_kelamin' => 'P',
                'tanggal_lahir' => '2001-07-25'
            ],
            [
                'nim' => '20220002',
                'nama' => 'Rudi Hartono',
                'alamat' => 'Jl. Asia Afrika No. 15, Semarang',
                'email' => 'rudi.hartono@email.com',
                'telepon' => '081234567894',
                'jenis_kelamin' => 'L',
                'tanggal_lahir' => '2000-09-05'
            ],
        ];

        foreach ($mahasiswas as $index => $mhs) {
            // 3 pertama untuk TI, 2 berikutnya untuk SI
            $jurusanIndex = $index < 3 ? 0 : 1;
            
            if (isset($jurusans[$jurusanIndex])) {
                Mahasiswa::create(array_merge($mhs, [
                    'jurusan_id' => $jurusans[$jurusanIndex]->id
                ]));
            }
        }
    }
}