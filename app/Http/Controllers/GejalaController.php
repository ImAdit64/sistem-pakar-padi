<?php

namespace App\Http\Controllers;

use App\Models\Gejala;
use Illuminate\Http\Request;

class GejalaController extends Controller
{
    public function index()
    {
        $gejala = Gejala::all();
        return view('admin.gejala.index', compact('gejala'));
    }

    public function create()
    {
        return view('admin.gejala.create');
    }

    public function store(Request $request)
{
    $request->validate([
        'kode'        => 'required|unique:gejala,kode',
        'nama_gejala' => 'required',
        'foto'        => 'nullable|image|max:2048',
    ]);

    $foto = null;
    if ($request->hasFile('foto')) {
        $foto = $request->file('foto')->store('images/gejala', 'public');
    }

    Gejala::create([
        'kode'        => $request->kode,
        'nama_gejala' => $request->nama_gejala,
        'foto'        => $foto,
    ]);

    return redirect()->route('admin.gejala.index')->with('success', 'Gejala berhasil ditambahkan.');
}

    public function edit(Gejala $gejala)
    {
        return view('admin.gejala.edit', compact('gejala'));
    }

    public function update(Request $request, Gejala $gejala)
{
    $request->validate([
        'kode'        => 'required|unique:gejala,kode,' . $gejala->id,
        'nama_gejala' => 'required',
        'foto'        => 'nullable|image|max:2048',
    ]);

    $foto = $gejala->foto;
    if ($request->hasFile('foto')) {
        $foto = $request->file('foto')->store('images/gejala', 'public');
    }

    $gejala->update([
        'kode'        => $request->kode,
        'nama_gejala' => $request->nama_gejala,
        'foto'        => $foto,
    ]);

    return redirect()->route('admin.gejala.index')->with('success', 'Gejala berhasil diperbarui.');
}

    public function destroy(Gejala $gejala)
    {
        $gejala->delete();
        return redirect()->route('admin.gejala.index')->with('success', 'Gejala berhasil dihapus.');
    }
}