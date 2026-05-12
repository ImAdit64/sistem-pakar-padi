<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailGejala extends Model
{
    use HasFactory;

    protected $table = 'detail_gejala';
    protected $fillable = ['sesi_id', 'gejala_id', 'cf_user', 'bobot_keyakinan'];
    public $timestamps = false;

    public function sesiDiagnosa()
    {
        return $this->belongsTo(SesiDiagnosa::class, 'sesi_id');
    }

    public function gejala()
    {
        return $this->belongsTo(Gejala::class, 'gejala_id');
    }
}
