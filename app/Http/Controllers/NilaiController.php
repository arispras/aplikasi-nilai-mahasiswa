<?php

namespace App\Http\Controllers;

use App\Models\Nilai;
use App\Models\Mahasiswa;
use App\Models\MataKuliah;
use Illuminate\Http\Request;

class NilaiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        // Perbaiki eager loading untuk include mataKuliah
        $nilais = Nilai::with(['mahasiswa.jurusan', 'mataKuliah'])->get();
        return view('nilai.index', compact('nilais'));
    }


    public function show(Nilai $nilai)
    {

        $nilai->load('mahasiswa.jurusan', 'mataKuliah');
        return view('nilai.show', compact('nilai'));
    }

    public function create()
    {
        $mahasiswas = Mahasiswa::with('jurusan')->get();
        $mataKuliahs = MataKuliah::with('jurusan')->get();
        return view('nilai.create', compact('mahasiswas', 'mataKuliahs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'mahasiswa_id' => 'required|exists:mahasiswas,id',
            'mata_kuliah_id' => 'required|exists:mata_kuliahs,id',
            'nilai_uts' => 'required|numeric|min:0|max:100',
            'nilai_uas' => 'required|numeric|min:0|max:100',
            'nilai_tugas' => 'required|numeric|min:0|max:100'
        ]);

        // Cek apakah mahasiswa sudah mengambil mata kuliah ini
        $existingNilai = Nilai::where('mahasiswa_id', $request->mahasiswa_id)
            ->where('mata_kuliah_id', $request->mata_kuliah_id)
            ->first();

        if ($existingNilai) {
            return back()->withErrors(['mata_kuliah_id' => 'Mahasiswa sudah mengambil mata kuliah ini.']);
        }

        // Hitung nilai akhir dan grade
        $hitung = Nilai::hitungNilaiAkhir(
            $request->nilai_uts,
            $request->nilai_uas,
            $request->nilai_tugas
        );

        $data = $request->all();
        $data['nilai_akhir'] = $hitung['nilai_akhir'];
        $data['grade'] = $hitung['grade'];

        Nilai::create($data);

        return redirect()->route('nilai.index')
            ->with('success', 'Nilai berhasil ditambahkan.');
    }

   
    public function edit(Nilai $nilai)
    {
        $mahasiswas = Mahasiswa::all();
        $mataKuliahs = MataKuliah::all();

        // Load relasi untuk mendapatkan data saat ini
        $nilai->load('mahasiswa', 'mataKuliah');

        return view('nilai.edit', compact('nilai', 'mahasiswas', 'mataKuliahs'));
    }

  

    public function update(Request $request, Nilai $nilai)
    {
        $request->validate([
            'mahasiswa_id' => 'required|exists:mahasiswas,id',
            'mata_kuliah_id' => 'required|exists:mata_kuliahs,id',
            'nilai_uts' => 'required|numeric|min:0|max:100',
            'nilai_uas' => 'required|numeric|min:0|max:100',
            'nilai_tugas' => 'required|numeric|min:0|max:100'
        ]);

        // Cek duplikat (kecuali untuk record yang sama)
        if ($nilai->mahasiswa_id != $request->mahasiswa_id || $nilai->mata_kuliah_id != $request->mata_kuliah_id) {
            $existingNilai = Nilai::where('mahasiswa_id', $request->mahasiswa_id)
                ->where('mata_kuliah_id', $request->mata_kuliah_id)
                ->where('id', '!=', $nilai->id)
                ->first();

            if ($existingNilai) {
                return back()->withErrors(['mata_kuliah_id' => 'Mahasiswa sudah mengambil mata kuliah ini.']);
            }
        }

        // Hitung nilai akhir dan grade
        $hitung = Nilai::hitungNilaiAkhir(
            $request->nilai_uts,
            $request->nilai_uas,
            $request->nilai_tugas
        );

        $data = $request->all();
        $data['nilai_akhir'] = $hitung['nilai_akhir'];
        $data['grade'] = $hitung['grade'];

        $nilai->update($data);

        return redirect()->route('nilai.index')
            ->with('success', 'Nilai berhasil diperbarui.');
    }

    public function destroy(Nilai $nilai)
    {
        $nilai->delete();

        return redirect()->route('nilai.index')
            ->with('success', 'Nilai berhasil dihapus.');
    }

   
    // Get mata kuliah by mahasiswa's jurusan (AJAX)
    public function getMataKuliahByMahasiswa($mahasiswa_id)
    {
        try {
            $mahasiswa = Mahasiswa::with('jurusan')->findOrFail($mahasiswa_id);
            $mataKuliahs = MataKuliah::where('jurusan_id', $mahasiswa->jurusan_id)->get();

            return response()->json($mataKuliahs);
        } catch (\Exception $e) {
            return response()->json([], 404);
        }
    }
}
