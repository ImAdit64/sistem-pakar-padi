<?php

namespace App\Http\Controllers;

use App\Models\SesiDiagnosa;

class LaporanController extends Controller
{
    public function index()
    {
        $sesi = SesiDiagnosa::with('hasilDiagnosa.penyakit')
            ->orderBy('tanggal', 'desc')
            ->get();
        return view('admin.laporan', compact('sesi'));
    }

    public function cetak($sesi_id)
    {
        $sesi = SesiDiagnosa::with(['hasilDiagnosa.penyakit', 'detailGejala.gejala'])
            ->findOrFail($sesi_id);
        return view('user.cetak', compact('sesi'));
    }
}