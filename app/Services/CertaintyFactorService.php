<?php

namespace App\Services;

use App\Models\Relasi;

class CertaintyFactorService
{
    public function hitung(array $gejalaInput, array $penyakitIds): array
    {
        $hasil = [];

        foreach ($penyakitIds as $penyakit_id) {
            // Ambil relasi untuk penyakit ini
            $relasi = Relasi::where('penyakit_id', $penyakit_id)
                ->whereIn('gejala_id', array_keys($gejalaInput))
                ->get();

            if ($relasi->isEmpty()) continue;

            // Hitung CF untuk setiap gejala
            $cfValues = [];
            foreach ($relasi as $r) {
                $cf_user  = $gejalaInput[$r->gejala_id] ?? 0;
                $cf_pakar = $r->cf_pakar;
                $cfValues[] = $cf_user * $cf_pakar;
            }

            // Kombinasikan semua CF
            $cfAkhir = $this->kombinasi($cfValues);
            $persentase = round($cfAkhir * 100, 2);

            $hasil[] = [
                'penyakit_id'  => $penyakit_id,
                'cf_akhir'     => $cfAkhir,
                'persentase'   => $persentase,
                'interpretasi' => $this->interpretasi($cfAkhir),
            ];
        }

        // Urutkan dari CF tertinggi
        usort($hasil, fn($a, $b) => $b['cf_akhir'] <=> $a['cf_akhir']);

        return $hasil;
    }

    private function kombinasi(array $cfValues): float
    {
        if (empty($cfValues)) return 0;

        $hasil = array_shift($cfValues);
        foreach ($cfValues as $cf) {
            if ($hasil >= 0 && $cf >= 0) {
                $hasil = $hasil + $cf * (1 - $hasil);
            } elseif ($hasil < 0 && $cf < 0) {
                $hasil = $hasil + $cf * (1 + $hasil);
            } else {
                $hasil = ($hasil + $cf) / (1 - min(abs($hasil), abs($cf)));
            }
        }

        return round($hasil, 4);
    }

    private function interpretasi(float $cf): string
    {
        if ($cf >= 0.8)  return 'Sangat Yakin';
        if ($cf >= 0.6)  return 'Kemungkinan Besar';
        if ($cf >= 0.4)  return 'Mungkin';
        if ($cf >= 0.2)  return 'Kemungkinan Kecil';
        if ($cf > 0)     return 'Tidak Yakin';
        return 'Tidak Terdeteksi';
    }
}