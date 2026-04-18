<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use App\Models\Jurusan;
use App\Models\Nilai;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $totalMahasiswa = Mahasiswa::count();
        $totalJurusan = Jurusan::count();
        $totalNilai = Nilai::count();
        $totalUser = User::count();
        
        $rataRataNilai = Nilai::avg('nilai_akhir');
        $nilaiTertinggi = Nilai::max('nilai_akhir');
        $nilaiTerendah = Nilai::min('nilai_akhir');
        
        return view('dashboard.index', compact(
            'totalMahasiswa', 'totalJurusan', 'totalNilai', 'totalUser',
            'rataRataNilai', 'nilaiTertinggi', 'nilaiTerendah'
        ));
    }
}