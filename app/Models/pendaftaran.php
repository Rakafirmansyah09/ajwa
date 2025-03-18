<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class pendaftaran extends Model
{
    protected $table = 'pendaftarans'; // Nama tabel di database

    protected $fillable = [
        'jemaah_id',
        'kategori_id',
        'no_hp',
        'alamat',
        'kecamatan',
        'file_kk',
        'file_foto',
        'file_ijazah',
    ];

    // Relasi ke tabel jemaahs
    public function jemaah()
    {
        return $this->belongsTo(Jemaah::class);
    }

    // Relasi ke tabel kategoris
    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }
}
