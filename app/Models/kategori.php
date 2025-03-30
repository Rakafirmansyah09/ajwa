<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class kategori extends Model
{
    protected $table = 'kategoris';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'nama',
        'code',
        'tanggal',
        'durasi',
        'harga',
        'detail',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->id = Str::upper(Str::random(3)) . '-' . Str::upper(Str::random(3));
        });

        static::addGlobalScope('orderByTanggal', function ($query) {
            $query->orderBy('tanggal', 'desc'); // Urutkan berdasarkan tanggal terbaru
        });
    }

    public function pendaftarans()
    {
        return $this->hasMany(Pendaftaran::class, 'kategori_id');
    }
}
