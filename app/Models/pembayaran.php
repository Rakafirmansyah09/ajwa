<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class pembayaran extends Model
{
    protected $table = 'pembayarans';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'jemaah_id',
        'dibayar_oleh',
        'harga',
        'method',
        'key',
        'status',
        'detail',
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->id)) {
                $model->id = Str::uuid();
            }
        });
    }

    // Relasi ke Pendaftaran
    public function jemaah()
    {
        return $this->belongsTo(jemaah::class, 'jemaah_id');
    }
}
