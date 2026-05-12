<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HasilDiagnosa extends Model
{
    use HasFactory;

    protected $table = 'hasil_diagnosa';
    protected $fillable = ['sesi_id', 'penyakit_id', 'cf_akhir', 'persentase', 'interpretasi', 'urutan'];
    public $timestamps = false;

    public function sesiDiagnosa()
    {
        return $this->belongsTo(SesiDiagnosa::class, 'sesi_id');
    }

    public function penyakit()
    {
        return $this->belongsTo(Penyakit::class, 'penyakit_id');
    }
}
