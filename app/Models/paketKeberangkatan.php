<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class paketKeberangkatan extends Model
{

    protected $table = 'paket_keberangkatan';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'paket_id',
        'tanggal_keberangkatan',
        'tanggal_kepulangan',
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

    public function pendaftarans()
    {
        return $this->hasMany(Pendaftaran::class, 'paket_keberangkatan_id');
    }

    public function jadwalPenerbangan()
    {
        return $this->hasMany(JadwalPenerbangan::class, 'paket_keberangkatan_id');
    }

    public function akomodasi()
    {
        return $this->hasMany(Akomodasi::class, 'paket_keberangkatan_id');
    }
}
