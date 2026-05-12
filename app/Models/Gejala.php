<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gejala extends Model
{
    use HasFactory;

    protected $table = 'gejala';
    protected $fillable = ['kode', 'nama_gejala', 'foto'];
    public $timestamps = false;

    public function relasi()
    {
        return $this->hasMany(Relasi::class, 'gejala_id');
    }

    public function detailGejala()
    {
        return $this->hasMany(DetailGejala::class, 'gejala_id');
    }
}
