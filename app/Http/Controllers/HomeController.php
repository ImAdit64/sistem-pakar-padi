<?php

namespace App\Http\Controllers;

use App\Models\Penyakit;
use App\Models\SesiDiagnosa;

class HomeController extends Controller
{
    public function index()
    {
        $penyakit = Penyakit::all();
        return view('user.home', compact('penyakit'));
    }

    public function informasi()
    {
        $penyakit = Penyakit::with('penanganan')->get();
        return view('user.informasi', compact('penyakit'));
    }

    public function tentang()
    {
        return view('user.tentang');
    }

    public function dashboard()
{
    return view('admin.dashboard', [
        'totalPenyakit' => \App\Models\Penyakit::count(),
        'totalGejala'   => \App\Models\Gejala::count(),
        'totalRelasi'   => \App\Models\Relasi::count(),
        'totalDiagnosa' => \App\Models\SesiDiagnosa::count(),
    ]);
}
}