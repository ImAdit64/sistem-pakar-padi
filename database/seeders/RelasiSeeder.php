<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RelasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
{
    $relasi = [
        // Tikus (D01)
        ['penyakit_id' => 1, 'gejala_id' => 1,  'mb' => 0.70, 'md' => 0.30, 'cf_pakar' => 0.40],
        ['penyakit_id' => 1, 'gejala_id' => 2,  'mb' => 0.80, 'md' => 0.20, 'cf_pakar' => 0.60],
        ['penyakit_id' => 1, 'gejala_id' => 3,  'mb' => 0.80, 'md' => 0.20, 'cf_pakar' => 0.60],
        ['penyakit_id' => 1, 'gejala_id' => 8,  'mb' => 0.65, 'md' => 0.35, 'cf_pakar' => 0.30],
        ['penyakit_id' => 1, 'gejala_id' => 10, 'mb' => 0.60, 'md' => 0.40, 'cf_pakar' => 0.20],
        // Penggerek Batang (D02)
        ['penyakit_id' => 2, 'gejala_id' => 4,  'mb' => 0.75, 'md' => 0.25, 'cf_pakar' => 0.50],
        ['penyakit_id' => 2, 'gejala_id' => 5,  'mb' => 0.70, 'md' => 0.30, 'cf_pakar' => 0.40],
        ['penyakit_id' => 2, 'gejala_id' => 6,  'mb' => 0.75, 'md' => 0.25, 'cf_pakar' => 0.50],
        ['penyakit_id' => 2, 'gejala_id' => 7,  'mb' => 0.80, 'md' => 0.20, 'cf_pakar' => 0.60],
        ['penyakit_id' => 2, 'gejala_id' => 17, 'mb' => 0.70, 'md' => 0.30, 'cf_pakar' => 0.40],
        // Keong (D03)
        ['penyakit_id' => 3, 'gejala_id' => 1,  'mb' => 0.70, 'md' => 0.30, 'cf_pakar' => 0.40],
        ['penyakit_id' => 3, 'gejala_id' => 8,  'mb' => 0.75, 'md' => 0.25, 'cf_pakar' => 0.50],
        ['penyakit_id' => 3, 'gejala_id' => 9,  'mb' => 0.80, 'md' => 0.20, 'cf_pakar' => 0.60],
        ['penyakit_id' => 3, 'gejala_id' => 10, 'mb' => 0.80, 'md' => 0.20, 'cf_pakar' => 0.60],
        ['penyakit_id' => 3, 'gejala_id' => 11, 'mb' => 0.75, 'md' => 0.25, 'cf_pakar' => 0.50],
        // Wereng (D04)
        ['penyakit_id' => 4, 'gejala_id' => 12, 'mb' => 0.80, 'md' => 0.20, 'cf_pakar' => 0.60],
        ['penyakit_id' => 4, 'gejala_id' => 13, 'mb' => 0.80, 'md' => 0.20, 'cf_pakar' => 0.60],
        ['penyakit_id' => 4, 'gejala_id' => 14, 'mb' => 0.75, 'md' => 0.25, 'cf_pakar' => 0.50],
        ['penyakit_id' => 4, 'gejala_id' => 16, 'mb' => 0.75, 'md' => 0.25, 'cf_pakar' => 0.50],
        // Tungro (D05)
        ['penyakit_id' => 5, 'gejala_id' => 4,  'mb' => 0.70, 'md' => 0.30, 'cf_pakar' => 0.40],
        ['penyakit_id' => 5, 'gejala_id' => 15, 'mb' => 0.80, 'md' => 0.20, 'cf_pakar' => 0.60],
        ['penyakit_id' => 5, 'gejala_id' => 16, 'mb' => 0.80, 'md' => 0.20, 'cf_pakar' => 0.60],
        ['penyakit_id' => 5, 'gejala_id' => 17, 'mb' => 0.75, 'md' => 0.25, 'cf_pakar' => 0.50],
        // Blas (D06)
        ['penyakit_id' => 6, 'gejala_id' => 18, 'mb' => 0.80, 'md' => 0.20, 'cf_pakar' => 0.60],
        ['penyakit_id' => 6, 'gejala_id' => 19, 'mb' => 0.80, 'md' => 0.20, 'cf_pakar' => 0.60],
        ['penyakit_id' => 6, 'gejala_id' => 20, 'mb' => 0.85, 'md' => 0.15, 'cf_pakar' => 0.70],
        ['penyakit_id' => 6, 'gejala_id' => 21, 'mb' => 0.75, 'md' => 0.25, 'cf_pakar' => 0.50],
        ['penyakit_id' => 6, 'gejala_id' => 22, 'mb' => 0.75, 'md' => 0.25, 'cf_pakar' => 0.50],
    ];

    foreach ($relasi as $r) {
        DB::table('relasi')->insert([
            'penyakit_id' => $r['penyakit_id'],
            'gejala_id'   => $r['gejala_id'],
            'mb'          => $r['mb'],
            'md'          => $r['md'],
            'cf_pakar'    => $r['cf_pakar'],
            'created_at'  => now(),
        ]);
    }
}
}
