<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class jadwalPenerbangan extends Model
{
    protected $table = 'jadwal_penerbangan';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'paket_keberangkatan_id',
        'judul',
        'maskapai',
        'tanggal_berangkat',
        'tanggal_tiba',
        'lama_penerbangan',
        'bagasi',
        'bagasi_kabin',
        'kursi',
        'bandara_asal',
        'kota_bandara_asal',
        'bandara_tujuan',
        'kota_bandara_tujuan',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->id)) {
                $model->id = Str::uuid();
            }
        });
    }


    public function paketKeberangkatan()
    {
        return $this->belongsTo(PaketKeberangkatan::class);
    }
}
