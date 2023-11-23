<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;
use Alert;
class KategoriController extends Controller
{
    public function index()
    {
        $kategoris = Kategori::all();
        return view('kategori.index', compact('kategoris'));
    }

    public function create()
    {
        return view('kategori.create');
    }

    public function store(Request $request)
    {
        // Validasi data yang dikirimkan melalui formulir
        $request->validate([
            'nama_kategori' => 'required|unique:kategori,nama_kategori',
        ]);

        // Simpan data kategori baru ke database
        Kategori::create([
            'nama_kategori' => $request->input('nama_kategori'),
        ]);

        return redirect()->route('kategori.index')->with('success', 'Kategori baru berhasil ditambahkan.');
    }

    public function show(Kategori $kategori)
    {
        return view('kategori.show', compact('kategori'));
    }

    public function edit($id)
    {
        $kategori = Kategori::find($id);
    
        if (!$kategori) {
            return redirect()->route('kategori.index')->with('error', 'Kategori tidak ditemukan.');
        }
    
        return view('kategori.edit', compact('kategori'));
    }

    public function update(Request $request, $id)
{
    $kategori = Kategori::find($id);

    if (!$kategori) {
        return redirect()->route('kategori.index')->with('error', 'Kategori tidak ditemukan.');
    }

    $request->validate([
        'nama_kategori' => 'required',
    ]);

    $kategori->nama_kategori = $request->input('nama_kategori');
    $kategori->save();
    Alert::success('berhasil', 'Data berhasil diperbarui');
    return redirect()->route('kategori.index');
}


    public function destroy($id)
{
    // Cari kategori berdasarkan ID
    $kategori = Kategori::find($id);

    if (!$kategori) {
        Alert::warning('Gagal', 'Data tidak ditemuka');
        return redirect()->route('kategori.index');
    }

    // Hapus kategori
    $kategori->delete();
    Alert::success('berhasil', 'Data berhasil dihapus');
    return redirect()->route('kategori.index');
}
}
