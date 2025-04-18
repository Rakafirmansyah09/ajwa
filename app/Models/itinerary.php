<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class itinerary extends Model
{

    protected $table = 'itinerary';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'paket_id',
        'tanggal',
        'judul_kegiatan',
        'deskripsi',
        'lokasi',
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
        return $this->belongsTo(paket::class, 'paket_id');
    }
}
