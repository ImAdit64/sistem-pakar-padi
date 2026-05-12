<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenyakitSeeder extends Seeder
{
    /**
     * Run the database seeds.
    */
    public function run(): void
{
    $penyakit = [
        ['kode' => 'D01', 'nama' => 'Tikus',            'deskripsi' => 'Hama tikus sawah (Rattus argentiventer) yang menyerang dari fase penyemaian hingga penyimpanan.'],
        ['kode' => 'D02', 'nama' => 'Penggerek Batang', 'deskripsi' => 'Hama penggerek batang (Scirpophaga incertulas) dari ordo lepidoptera yang menyerang batang padi.'],
        ['kode' => 'D03', 'nama' => 'Keong',            'deskripsi' => 'Keong mas (Pomacea canaliculata) yang menyerang tanaman padi pada masa vegetatif.'],
        ['kode' => 'D04', 'nama' => 'Wereng',           'deskripsi' => 'Wereng coklat (Nilaparvata lugens) yang menyebabkan daun menguning hingga mengering.'],
        ['kode' => 'D05', 'nama' => 'Tungro',           'deskripsi' => 'Penyakit virus yang ditularkan wereng hijau, menyebabkan daun menguning dan tanaman kerdil.'],
        ['kode' => 'D06', 'nama' => 'Blas',             'deskripsi' => 'Penyakit jamur yang menyebabkan bercak pada daun berbentuk belah ketupat dengan tengah abu-abu keputihan.'],
    ];

    foreach ($penyakit as $p) {
        DB::table('penyakit')->insert([
            'kode'       => $p['kode'],
            'nama'       => $p['nama'],
            'deskripsi'  => $p['deskripsi'],
            'created_at' => now(),
        ]);
    }
}
}
