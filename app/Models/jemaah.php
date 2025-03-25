<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class jemaah extends Model
{
    protected $table = 'jemaahs';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'nama_lengkap',
        'nik',
        'tanggal_lahir',
        'tempat_lahir',
        'file_ktp',
        'file_paspor',
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


    // Relasi ke tabel pendaftarans
    public function pendaftarans()
    {
        return $this->hasMany(Pendaftaran::class, 'jemaah_id');
    }
}
