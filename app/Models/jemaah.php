<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class jemaah extends Model
{
    protected $table = 'jemaahs'; // Nama tabel

    protected $fillable = [
        'nama_lengkap',
        'nik',
        'tanggal_lahir',
        'tempat_lahir',
        'file_ktp',
        'file_paspor',
    ];

    // Relasi ke tabel pendaftarans
    public function pendaftarans()
    {
        return $this->hasMany(Pendaftaran::class);
    }
}
