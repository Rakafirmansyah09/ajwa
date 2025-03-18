<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class kategori extends Model
{
    protected $table = 'kategoris'; // Nama tabel

    protected $fillable = [
        'nama',
        'tanggal',
        'durasi',
        'harga',
        'detail',
    ];

    // Relasi ke tabel pendaftarans
    public function pendaftar()
    {
        return $this->hasMany(Pendaftaran::class);
    }
}
