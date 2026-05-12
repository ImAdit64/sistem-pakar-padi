<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanSesi extends Model
{
    use HasFactory;

    protected $table = 'laporan_sesi';
    protected $fillable = ['sesi_id', 'no_laporan', 'format', 'file_path', 'digenerate_oleh', 'jumlah_download'];
    public $timestamps = false;

    public function sesiDiagnosa()
    {
        return $this->belongsTo(SesiDiagnosa::class, 'sesi_id');
    }
}
