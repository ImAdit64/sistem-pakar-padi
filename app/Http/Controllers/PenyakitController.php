<?php

namespace App\Http\Controllers;

use App\Models\Penyakit;
use Illuminate\Http\Request;

class PenyakitController extends Controller
{
    public function index()
    {
        $penyakit = Penyakit::all();
        return view('admin.penyakit.index', compact('penyakit'));
    }

    public function create()
    {
        return view('admin.penyakit.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode'      => 'required|unique:penyakit,kode',
            'nama'      => 'required',
            'deskripsi' => 'nullable',
            'gambar'    => 'nullable|image|max:2048',
        ]);

        $gambar = null;
        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar')->store('images/penyakit', 'public');
        }

        Penyakit::create([
            'kode'      => $request->kode,
            'nama'      => $request->nama,
            'deskripsi' => $request->deskripsi,
            'gambar'    => $gambar,
        ]);

        return redirect()->route('admin.penyakit.index')->with('success', 'Penyakit berhasil ditambahkan.');
    }

    public function edit(Penyakit $penyakit)
    {
        return view('admin.penyakit.edit', compact('penyakit'));
    }

    public function update(Request $request, Penyakit $penyakit)
    {
        $request->validate([
            'kode'      => 'required|unique:penyakit,kode,' . $penyakit->id,
            'nama'      => 'required',
            'deskripsi' => 'nullable',
            'gambar'    => 'nullable|image|max:2048',
        ]);

        $gambar = $penyakit->gambar;
        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar')->store('images/penyakit', 'public');
        }

        $penyakit->update([
            'kode'      => $request->kode,
            'nama'      => $request->nama,
            'deskripsi' => $request->deskripsi,
            'gambar'    => $gambar,
        ]);

        return redirect()->route('admin.penyakit.index')->with('success', 'Penyakit berhasil diperbarui.');
    }

    public function destroy(Penyakit $penyakit)
    {
        $penyakit->delete();
        return redirect()->route('admin.penyakit.index')->with('success', 'Penyakit berhasil dihapus.');
    }
}