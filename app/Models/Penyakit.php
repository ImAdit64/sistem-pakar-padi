<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penyakit extends Model
{
    use HasFactory;

    protected $table = 'penyakit';
    protected $fillable = ['kode', 'nama', 'deskripsi', 'gambar'];
    public $timestamps = false;

    public function relasi()
    {
        return $this->hasMany(Relasi::class, 'penyakit_id');
    }

    public function penanganan()
    {
        return $this->hasMany(Penanganan::class, 'penyakit_id');
    }

    public function hasilDiagnosa()
    {
        return $this->hasMany(HasilDiagnosa::class, 'penyakit_id');
    }
}
