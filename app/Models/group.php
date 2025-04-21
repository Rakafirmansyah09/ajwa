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

    public function jadwalPenerbangan()
    {
        return $this->hasMany(JadwalPenerbangan::class, 'group_id');
    }

    public function akomodasi()
    {
        return $this->hasMany(Akomodasi::class, 'group_id');
    }
}
