<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use App\Models\Nilai;
use App\Models\Jurusan;
use App\Models\MataKuliah;
use PDF;

class LaporanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('laporan.index');
    }

    public function mahasiswa()
    {
        $mahasiswas = Mahasiswa::with('jurusan')->get();
        return view('laporan.mahasiswa', compact('mahasiswas'));
    }

    public function mahasiswaPDF()
    {
        $mahasiswas = Mahasiswa::with('jurusan')->get();
        $pdf = PDF::loadView('laporan.mahasiswa_pdf', compact('mahasiswas'));
        return $pdf->download('laporan-mahasiswa.pdf');
    }


    public function nilai()
    {
        // Load dengan relasi yang benar
        $nilais = Nilai::with(['mahasiswa.jurusan', 'mataKuliah'])->get();
        return view('laporan.nilai', compact('nilais'));
    }

    public function nilaiPDF()
    {
        $nilais = Nilai::with(['mahasiswa.jurusan', 'mataKuliah'])->get();
        $pdf = PDF::loadView('laporan.nilai_pdf', compact('nilais'));
        return $pdf->download('laporan-nilai.pdf');
    }

    public function transkrip($mahasiswa_id)
    {
        // Load dengan relasi yang benar
        $mahasiswa = Mahasiswa::with(['jurusan', 'nilais.mataKuliah'])->findOrFail($mahasiswa_id);
        return view('laporan.transkrip', compact('mahasiswa'));
    }

    public function transkripPDF($mahasiswa_id)
    {
        $mahasiswa = Mahasiswa::with(['jurusan', 'nilais.mataKuliah'])->findOrFail($mahasiswa_id);
        $pdf = PDF::loadView('laporan.transkrip_pdf', compact('mahasiswa'));
        return $pdf->download('transkrip-' . $mahasiswa->nim . '.pdf');
    }

    public function mataKuliah()
    {
        $mataKuliahs = MataKuliah::with('jurusan')->get();
        return view('laporan.mata_kuliah', compact('mataKuliahs'));
    }

    public function mataKuliahPDF()
    {
        $mataKuliahs = MataKuliah::with('jurusan')->get();
        $pdf = PDF::loadView('laporan.mata_kuliah_pdf', compact('mataKuliahs'));
        return $pdf->download('laporan-mata-kuliah.pdf');
    }

  

    public function krs($mahasiswa_id)
    {
        $mahasiswa = Mahasiswa::with('jurusan')->findOrFail($mahasiswa_id);
        $mataKuliahs = MataKuliah::where('jurusan_id', $mahasiswa->jurusan_id)->get();
        return view('laporan.krs', compact('mahasiswa', 'mataKuliahs'));
    }

    public function krsPDF($mahasiswa_id)
    {
        $mahasiswa = Mahasiswa::with('jurusan')->findOrFail($mahasiswa_id);
        $mataKuliahs = MataKuliah::where('jurusan_id', $mahasiswa->jurusan_id)->get();
        $pdf = PDF::loadView('laporan.krs_pdf', compact('mahasiswa', 'mataKuliahs'));
        return $pdf->download('krs-' . $mahasiswa->nim . '.pdf');
    }
}
