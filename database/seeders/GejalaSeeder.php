<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GejalaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
{
    $gejala = [
        ['kode' => 'G01', 'nama_gejala' => 'Lubang dan sarang'],
        ['kode' => 'G02', 'nama_gejala' => 'Jejak kotoran'],
        ['kode' => 'G03', 'nama_gejala' => 'Bekas potongan bersudut'],
        ['kode' => 'G04', 'nama_gejala' => 'Pucuk batang padi kering kekuningan'],
        ['kode' => 'G05', 'nama_gejala' => 'Bulir padi hampa'],
        ['kode' => 'G06', 'nama_gejala' => 'Anakan kerdil'],
        ['kode' => 'G07', 'nama_gejala' => 'Batang mudah terlepas'],
        ['kode' => 'G08', 'nama_gejala' => 'Potongan daun dan batang mengambang'],
        ['kode' => 'G09', 'nama_gejala' => 'Padi yang baru ditanam habis total'],
        ['kode' => 'G10', 'nama_gejala' => 'Daun berlubang'],
        ['kode' => 'G11', 'nama_gejala' => 'Terdapat jalur bekas lendir'],
        ['kode' => 'G12', 'nama_gejala' => 'Batang tanaman berwarna coklat'],
        ['kode' => 'G13', 'nama_gejala' => 'Tanaman mengering seperti disiram air panas'],
        ['kode' => 'G14', 'nama_gejala' => 'Bagian daun terpuntir'],
        ['kode' => 'G15', 'nama_gejala' => 'Padi menguning hingga berwarna jingga'],
        ['kode' => 'G16', 'nama_gejala' => 'Daun muda menggulung'],
        ['kode' => 'G17', 'nama_gejala' => 'Anakan berkurang'],
        ['kode' => 'G18', 'nama_gejala' => 'Bercak pada daun berbentuk belah ketupat'],
        ['kode' => 'G19', 'nama_gejala' => 'Tengah bercak abu-abu keputihan dengan tepi coklat kehitaman'],
        ['kode' => 'G20', 'nama_gejala' => 'Leher malai menghitam dan membusuk'],
        ['kode' => 'G21', 'nama_gejala' => 'Malai patah atau tidak berisi (gabah hampa)'],
        ['kode' => 'G22', 'nama_gejala' => 'Tanaman tampak mengering sebagian'],
    ];

    foreach ($gejala as $g) {
        DB::table('gejala')->insert([
            'kode'        => $g['kode'],
            'nama_gejala' => $g['nama_gejala'],
            'created_at'  => now(),
        ]);
    }
}
}
