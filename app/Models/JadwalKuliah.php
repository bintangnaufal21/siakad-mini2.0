<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalKuliah extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika tidak mengikuti konvensi Laravel (opsional)
    protected $table = 'jadwal_kuliah';

    // Tentukan kolom yang bisa diisi massal
    protected $fillable = [
        'mata_kuliah_id',
        'hari',
        'waktu_mulai',
        'waktu_selesai',
        'ruang',
    ];

    /**
     * Mendefinisikan relasi bahwa satu jadwal milik satu mata kuliah.
     */
    public function mataKuliah()
    {
        return $this->belongsTo(MataKuliah::class, 'mata_kuliah_id');
    }
}
