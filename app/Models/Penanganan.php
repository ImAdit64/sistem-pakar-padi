<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penanganan extends Model
{
    use HasFactory;

    protected $table = 'penanganan';
    protected $fillable = ['penyakit_id', 'jenis', 'deskripsi', 'urutan'];
    public $timestamps = false;

    public function penyakit()
    {
        return $this->belongsTo(Penyakit::class, 'penyakit_id');
    }
}
