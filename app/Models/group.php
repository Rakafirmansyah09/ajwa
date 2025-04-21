<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class group extends Model
{

    protected $table = 'group';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'paket_id',
        'nama',
        'tanggal_keberangkatan',
        'tanggal_kepulangan',
        'jadwal_penerbangan',
        'akomodasi',
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

    public function paket()
    {
        return $this->belongsTo(Paket::class);
    }

    public function jemaah()
    {
        return $this->hasMany(jemaah::class, 'group_id');
    }

    public function getListJadwalPenerbanganAttribute()
    {
        return json_decode($this->jadwal_penerbangan, true) ?? [];
        // no
        // judul
        // maskapai
        // tanggal_keberangkatan
        // tanggal_tiba
        // lama_penerbangan
        // bagasi
        // bagasi_kabin
        // kussi
        // bandara_asal
        // bandara tujuan
        // kota_asal
        // kota_tujuan

    }

    public function getListAkomodasiAttribute()
    {
        return json_decode($this->akomodasi, true) ?? [];
        // no
        // nama_hotel
        // kota
        // alamat
        // tanggal_cekin
        // tanggal_checkout
        // rating
    }
}
