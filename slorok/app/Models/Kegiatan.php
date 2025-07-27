<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika tidak mengikuti konvensi Laravel (kegiatans)
    protected $table = 'kegiatan';

    // Izinkan kolom ini untuk diisi secara massal
    protected $fillable = [
        'judul',
        'isi',
        'gambar',
    ];
}