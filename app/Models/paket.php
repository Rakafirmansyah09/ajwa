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

    protected $appends = [
        'list_fasilitas',
        'list_itinerary',
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
        $data =  json_decode($this->fasilitas, true);
        return is_array($data) || is_object($data)
            ? collect($data)
            : collect(); // fallback jika null atau gagal decode

    }

    public function getListItineraryAttribute()
    {
        $data =  json_decode($this->itinerary, true);
        return is_array($data) || is_object($data)
            ? collect($data)
            : collect(); // fallback jika null atau gagal decode

    }
}
