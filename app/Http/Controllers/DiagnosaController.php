<?php

namespace App\Http\Controllers;

use App\Models\Gejala;
use App\Models\SesiDiagnosa;
use App\Models\DetailGejala;
use App\Models\HasilDiagnosa;
use App\Services\ForwardChainingService;
use App\Services\CertaintyFactorService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DiagnosaController extends Controller
{
    protected $fcService;
    protected $cfService;

    public function __construct(
        ForwardChainingService $fcService,
        CertaintyFactorService $cfService
    ) {
        $this->fcService = $fcService;
        $this->cfService = $cfService;
    }

    public function index()
    {
        $gejala = Gejala::all();
        return view('user.diagnosa', compact('gejala'));
    }

    public function proses(Request $request)
    {
        $request->validate([
            'nama_pengguna' => 'required|string|max:100',
            'gejala'        => 'required|array|min:1',
            'gejala.*'      => 'exists:gejala,id',
            'cf_user.*'     => 'required|numeric',
        ]);

        // Buat sesi diagnosa baru
        $kode_sesi = 'SESI-' . strtoupper(Str::random(8));
        $sesi = SesiDiagnosa::create([
            'kode_sesi'     => $kode_sesi,
            'nama_pengguna' => $request->nama_pengguna,
            'tanggal'       => now(),
            'status'        => 'proses',
        ]);

        // Bobot keyakinan user
        $bobotLabel = [
            '1.0' => 'Pasti',
            '0.8' => 'Sangat Yakin',
            '0.6' => 'Kemungkinan Besar',
            '0.4' => 'Mungkin',
            '0.2' => 'Kurang Pasti',
            '0.0' => 'Tidak Mungkin',
        ];

        // Simpan detail gejala
        $gejalaInput = [];
        foreach ($request->gejala as $gejala_id) {
            $cf_user = $request->cf_user[$gejala_id] ?? 0;
            $bobot   = $bobotLabel[(string)$cf_user] ?? 'Tidak Mungkin';

            DetailGejala::create([
                'sesi_id'         => $sesi->id,
                'gejala_id'       => $gejala_id,
                'cf_user'         => $cf_user,
                'bobot_keyakinan' => $bobot,
            ]);

            $gejalaInput[$gejala_id] = $cf_user;
        }

        // Jalankan Forward Chaining
        $penyakitTerdeteksi = $this->fcService->run($gejalaInput);

        // Jalankan Certainty Factor
        $hasilCF = $this->cfService->hitung($gejalaInput, $penyakitTerdeteksi);

        // Simpan hasil diagnosa
        $urutan = 1;
        foreach ($hasilCF as $hasil) {
            HasilDiagnosa::create([
                'sesi_id'       => $sesi->id,
                'penyakit_id'   => $hasil['penyakit_id'],
                'cf_akhir'      => $hasil['cf_akhir'],
                'persentase'    => $hasil['persentase'],
                'interpretasi'  => $hasil['interpretasi'],
                'urutan'        => $urutan++,
            ]);
        }

        // Update status sesi
        $sesi->update(['status' => 'selesai']);

        return redirect()->route('diagnosa.hasil', $kode_sesi);
    }

    public function hasil($kode_sesi)
    {
        $sesi = SesiDiagnosa::where('kode_sesi', $kode_sesi)
            ->with(['hasilDiagnosa.penyakit', 'detailGejala.gejala'])
            ->firstOrFail();

        return view('user.hasil', compact('sesi'));
    }

    public function cetak($kode_sesi)
    {
        $sesi = SesiDiagnosa::where('kode_sesi', $kode_sesi)
            ->with(['hasilDiagnosa.penyakit', 'detailGejala.gejala'])
            ->firstOrFail();

        return view('user.cetak', compact('sesi'));
    }
}