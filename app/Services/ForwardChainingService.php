<?php

namespace App\Services;

use App\Models\Relasi;

class ForwardChainingService
{
    public function run(array $gejalaInput): array
    {
        // Ambil semua relasi dari database
        $semuaRelasi = Relasi::with(['penyakit', 'gejala'])->get();

        // Kelompokkan gejala per penyakit
        $penyakitGejala = [];
        foreach ($semuaRelasi as $relasi) {
            $penyakitGejala[$relasi->penyakit_id][] = $relasi->gejala_id;
        }

        // Cocokkan gejala input dengan rule
        $terdeteksi = [];
        foreach ($penyakitGejala as $penyakit_id => $gejalaIds) {
            $cocok = array_intersect(array_keys($gejalaInput), $gejalaIds);
            if (count($cocok) > 0) {
                $terdeteksi[] = $penyakit_id;
            }
        }

        return $terdeteksi;
    }
}