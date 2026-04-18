<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Jurusan;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $mahasiswas = Mahasiswa::with('jurusan')->get();
        return view('mahasiswa.index', compact('mahasiswas'));
    }

    public function create()
    {
        $jurusans = Jurusan::all();
        return view('mahasiswa.create', compact('jurusans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nim' => 'required|unique:mahasiswas|max:15',
            'nama' => 'required|max:100',
            'jurusan_id' => 'required|exists:jurusans,id',
            'alamat' => 'required',
            'email' => 'required|email|unique:mahasiswas',
            'telepon' => 'required|max:15',
            'jenis_kelamin' => 'required|in:L,P',
            'tanggal_lahir' => 'required|date'
        ]);

        Mahasiswa::create($request->all());

        return redirect()->route('mahasiswa.index')
            ->with('success', 'Mahasiswa berhasil ditambahkan.');
    }

    public function show(Mahasiswa $mahasiswa)
    {
        $mahasiswa->load('jurusan', 'nilais');
        return view('mahasiswa.show', compact('mahasiswa'));
    }

    public function edit(Mahasiswa $mahasiswa)
    {
        $jurusans = Jurusan::all();
        return view('mahasiswa.edit', compact('mahasiswa', 'jurusans'));
    }

    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        $request->validate([
            'nim' => 'required|max:15|unique:mahasiswas,nim,'.$mahasiswa->id,
            'nama' => 'required|max:100',
            'jurusan_id' => 'required|exists:jurusans,id',
            'alamat' => 'required',
            'email' => 'required|email|unique:mahasiswas,email,'.$mahasiswa->id,
            'telepon' => 'required|max:15',
            'jenis_kelamin' => 'required|in:L,P',
            'tanggal_lahir' => 'required|date'
        ]);

        $mahasiswa->update($request->all());

        return redirect()->route('mahasiswa.index')
            ->with('success', 'Mahasiswa berhasil diperbarui.');
    }

    public function destroy(Mahasiswa $mahasiswa)
    {
        $mahasiswa->delete();

        return redirect()->route('mahasiswa.index')
            ->with('success', 'Mahasiswa berhasil dihapus.');
    }
}