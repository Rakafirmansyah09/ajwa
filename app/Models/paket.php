<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class paket extends Model
{
    protected $table = 'pakets';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'nama',
        'gambar',
        'code',
        'durasi',
        'harga',
        'fasilitas',
        'itinerary',
        'kuota',
        'detail',
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


    public function group()
    {
        return $this->hasMany(group::class, 'paket_id');
    }

    public function getListFasilitasAttribute()
    {
        return json_decode($this->fasilitas, true) ?? [];
        // no
        // nama fasilitas
    }

    public function getListItineraryAttribute()
    {
        return json_decode($this->itinerary, true) ?? [];
        // no
        // tanggal
        // judul
        // deskripso
        // lokasi
    }
}
