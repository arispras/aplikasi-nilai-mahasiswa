<?php

namespace App\Http\Controllers;

use App\Models\MataKuliah;
use App\Models\Jurusan;
use Illuminate\Http\Request;

class MataKuliahController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $mataKuliahs = MataKuliah::with('jurusan')->get();
        return view('mata_kuliah.index', compact('mataKuliahs'));
    }

    public function create()
    {
        $jurusans = Jurusan::all();
        return view('mata_kuliah.create', compact('jurusans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_mk' => 'required|unique:mata_kuliahs|max:10',
            'nama_mk' => 'required|max:100',
            'sks' => 'required|integer|min:1|max:6',
            'jurusan_id' => 'required|exists:jurusans,id',
            'semester' => 'required|integer|min:1|max:8',
            'deskripsi' => 'nullable'
        ]);

        MataKuliah::create($request->all());

        return redirect()->route('mata-kuliah.index')
            ->with('success', 'Mata kuliah berhasil ditambahkan.');
    }

    public function show(MataKuliah $mataKuliah)
    {
        $mataKuliah->load('jurusan', 'nilais.mahasiswa');
        return view('mata_kuliah.show', compact('mataKuliah'));
    }

    public function edit(MataKuliah $mataKuliah)
    {
        $jurusans = Jurusan::all();
        return view('mata_kuliah.edit', compact('mataKuliah', 'jurusans'));
    }

    public function update(Request $request, MataKuliah $mataKuliah)
    {
        $request->validate([
            'kode_mk' => 'required|max:10|unique:mata_kuliahs,kode_mk,'.$mataKuliah->id,
            'nama_mk' => 'required|max:100',
            'sks' => 'required|integer|min:1|max:6',
            'jurusan_id' => 'required|exists:jurusans,id',
            'semester' => 'required|integer|min:1|max:8',
            'deskripsi' => 'nullable'
        ]);

        $mataKuliah->update($request->all());

        return redirect()->route('mata-kuliah.index')
            ->with('success', 'Mata kuliah berhasil diperbarui.');
    }

    public function destroy(MataKuliah $mataKuliah)
    {
        $mataKuliah->delete();

        return redirect()->route('mata-kuliah.index')
            ->with('success', 'Mata kuliah berhasil dihapus.');
    }

    // Get mata kuliah by jurusan (for AJAX)
    public function getByJurusan($jurusan_id)
    {
        $mataKuliahs = MataKuliah::where('jurusan_id', $jurusan_id)->get();
        return response()->json($mataKuliahs);
    }
}