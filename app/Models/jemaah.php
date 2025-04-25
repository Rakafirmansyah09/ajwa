<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class jemaah extends Model
{
    protected $table = 'jemaah';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'jemaah_id',
        'group_id',

        'no_hp',
        'usia',
        'alamat',
        'kecamatan',

        'sumber_info',
        'sumber_ket',
        'detail_info',
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


    public function bioJemaah()
    {
        return $this->belongsTo(bioJemaah::class, 'jemaah_id');
    }

    public function group()
    {
        return $this->belongsTo(group::class, 'group_id');
    }
}
