<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Nilai;
use App\Models\Mahasiswa;
use App\Models\MataKuliah;

class NilaiSeeder extends Seeder
{
    public function run()
    {
        $mahasiswas = Mahasiswa::all();
        $mataKuliahs = MataKuliah::all();
        
        $nilais = [
            // Budi Santoso (TI)
            [
                'mahasiswa_nim' => '20210001',
                'mata_kuliah_kode' => 'TI101',
                'nilai_uts' => 85,
                'nilai_uas' => 90,
                'nilai_tugas' => 88
            ],
            [
                'mahasiswa_nim' => '20210001',
                'mata_kuliah_kode' => 'TI102',
                'nilai_uts' => 78,
                'nilai_uas' => 82,
                'nilai_tugas' => 80
            ],
            [
                'mahasiswa_nim' => '20210001',
                'mata_kuliah_kode' => 'TI201',
                'nilai_uts' => 90,
                'nilai_uas' => 92,
                'nilai_tugas' => 91
            ],
            // Siti Rahayu (TI)
            [
                'mahasiswa_nim' => '20210002',
                'mata_kuliah_kode' => 'TI101',
                'nilai_uts' => 75,
                'nilai_uas' => 80,
                'nilai_tugas' => 78
            ],
            [
                'mahasiswa_nim' => '20210002',
                'mata_kuliah_kode' => 'TI102',
                'nilai_uts' => 82,
                'nilai_uas' => 85,
                'nilai_tugas' => 84
            ],
            // Dewi Anggraini (SI)
            [
                'mahasiswa_nim' => '20220001',
                'mata_kuliah_kode' => 'SI101',
                'nilai_uts' => 88,
                'nilai_uas' => 85,
                'nilai_tugas' => 87
            ],
            [
                'mahasiswa_nim' => '20220001',
                'mata_kuliah_kode' => 'SI102',
                'nilai_uts' => 76,
                'nilai_uas' => 80,
                'nilai_tugas' => 78
            ],
        ];

        foreach ($nilais as $data) {
            $mahasiswa = Mahasiswa::where('nim', $data['mahasiswa_nim'])->first();
            $mataKuliah = MataKuliah::where('kode_mk', $data['mata_kuliah_kode'])->first();
            
            if ($mahasiswa && $mataKuliah) {
                // Cek apakah sudah ada
                $existing = Nilai::where('mahasiswa_id', $mahasiswa->id)
                    ->where('mata_kuliah_id', $mataKuliah->id)
                    ->first();
                
                if (!$existing) {
                    $hitung = Nilai::hitungNilaiAkhir(
                        $data['nilai_uts'],
                        $data['nilai_uas'],
                        $data['nilai_tugas']
                    );
                    
                    Nilai::create([
                        'mahasiswa_id' => $mahasiswa->id,
                        'mata_kuliah_id' => $mataKuliah->id,
                        'nilai_uts' => $data['nilai_uts'],
                        'nilai_uas' => $data['nilai_uas'],
                        'nilai_tugas' => $data['nilai_tugas'],
                        'nilai_akhir' => $hitung['nilai_akhir'],
                        'grade' => $hitung['grade']
                    ]);
                }
            }
        }
    }
}