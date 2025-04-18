<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class rombongan extends Model
{
    protected $table = 'rombongan';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'nama',
        'paket_keberangkatan_id',
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->id)) {
                $model->id = mt_rand(1000000000, 9999999999);
            }
        });
    }


    // Relasi ke tabel pendaftarans
    public function jemaah()
    {
        return $this->hasMany(jemaah::class, 'rombongan_id');
    }

    public function pembayaran()
    {
        return $this->hasMany(Pembayaran::class, 'rombongan_id');
    }
}
