<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class pembayaran extends Model
{
    protected $table = 'pembayarans';

    protected $fillable = [
        'pendaftaran_id',
        'harga',
        'bukti',
        'method',
        'key',
        'detail',
    ];

    // Relasi ke Pendaftaran
    public function pendaftaran()
    {
        return $this->belongsTo(Pendaftaran::class);
    }
}
