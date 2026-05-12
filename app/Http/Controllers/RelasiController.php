<?php

namespace App\Http\Controllers;

use App\Models\Relasi;
use App\Models\Penyakit;
use App\Models\Gejala;
use Illuminate\Http\Request;

class RelasiController extends Controller
{
    public function index()
    {
        $relasi = Relasi::with(['penyakit', 'gejala'])->get();
        return view('admin.relasi.index', compact('relasi'));
    }

    public function create()
    {
        $penyakit = Penyakit::all();
        $gejala   = Gejala::all();
        return view('admin.relasi.create', compact('penyakit', 'gejala'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'penyakit_id' => 'required|exists:penyakit,id',
            'gejala_id'   => 'required|exists:gejala,id',
            'mb'          => 'required|numeric|min:0|max:1',
            'md'          => 'required|numeric|min:0|max:1',
        ]);

        $cf_pakar = $request->mb - $request->md;

        Relasi::create([
            'penyakit_id' => $request->penyakit_id,
            'gejala_id'   => $request->gejala_id,
            'mb'          => $request->mb,
            'md'          => $request->md,
            'cf_pakar'    => $cf_pakar,
        ]);

        return redirect()->route('admin.relasi.index')->with('success', 'Relasi berhasil ditambahkan.');
    }

    public function edit(Relasi $relasi)
    {
        $penyakit = Penyakit::all();
        $gejala   = Gejala::all();
        return view('admin.relasi.edit', compact('relasi', 'penyakit', 'gejala'));
    }

    public function update(Request $request, Relasi $relasi)
    {
        $request->validate([
            'penyakit_id' => 'required|exists:penyakit,id',
            'gejala_id'   => 'required|exists:gejala,id',
            'mb'          => 'required|numeric|min:0|max:1',
            'md'          => 'required|numeric|min:0|max:1',
        ]);

        $cf_pakar = $request->mb - $request->md;

        $relasi->update([
            'penyakit_id' => $request->penyakit_id,
            'gejala_id'   => $request->gejala_id,
            'mb'          => $request->mb,
            'md'          => $request->md,
            'cf_pakar'    => $cf_pakar,
        ]);

        return redirect()->route('admin.relasi.index')->with('success', 'Relasi berhasil diperbarui.');
    }

    public function destroy(Relasi $relasi)
    {
        $relasi->delete();
        return redirect()->route('admin.relasi.index')->with('success', 'Relasi berhasil dihapus.');
    }

    public function aturan()
{
    $penyakit = \App\Models\Penyakit::with(['relasi.gejala'])->get();
    return view('admin.aturan', compact('penyakit'));
}
}