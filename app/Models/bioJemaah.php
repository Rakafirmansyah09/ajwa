<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class bioJemaah extends Model
{
    protected $table = 'bioJemaahs';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'nama_lengkap',
        'nik',
        'email',
        'tanggal_lahir',
        'jenis_kelamin',
        'tempat_lahir',
        'file_ktp',
        'file_paspor',
        'id_akun',
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
    public function jemaah()
    {
        return $this->hasMany(jemaah::class, 'jemaah_id');
    }

    // Relasi ke tabel users
    public function user()
    {
        return $this->belongsTo(User::class, 'id_akun');
    }
}
