<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SesiDiagnosa extends Model
{
    use HasFactory;

    protected $table = 'sesi_diagnosa';
    protected $fillable = ['kode_sesi', 'nama_pengguna', 'tanggal', 'status'];
    public $timestamps = false;

    public function detailGejala()
    {
        return $this->hasMany(DetailGejala::class, 'sesi_id');
    }

    public function hasilDiagnosa()
    {
        return $this->hasMany(HasilDiagnosa::class, 'sesi_id');
    }

    public function laporanSesi()
    {
        return $this->hasOne(LaporanSesi::class, 'sesi_id');
    }
}
