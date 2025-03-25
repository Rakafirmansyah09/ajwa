<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class pendaftaran extends Model
{
    protected $table = 'pendaftarans';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'jemaah_id',
        'kategori_id',
        'no_hp',
        'alamat',
        'kecamatan',
        'file_kk',
        'file_foto',
        'file_ijazah',

        'sumber_info',
        'sumber_ket',
        'detail_info',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (!$model->kategori_id) {
                throw new \Exception("Kategori harus diisi sebelum membuat ID Pendaftaran");
            }

            $kategori = Kategori::find($model->kategori_id);
            if (!$kategori) {
                throw new \Exception("Kategori tidak ditemukan");
            }

            $kodeKategori = strtoupper($kategori->code); // Pastikan kategori memiliki 'code'
            $randomStr = Str::upper(Str::random(3));

            $model->id = $kodeKategori . '-' . $randomStr;
        });
    }


    public function jemaah()
    {
        return $this->belongsTo(Jemaah::class, 'jemaah_id');
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    public function pembayaran()
    {
        return $this->hasMany(Pembayaran::class, 'pendaftaran_id');
    }
}
