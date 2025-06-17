<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class jemaah extends Model
{
    protected $table = 'pendaftaran';
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

        'id_rombongan',

        'pembatalan',
        'tanggal_pembatalan',
        'alasan_pembatalan',

        'sumber_info',
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

    // Relasi
    public function ketuaRombongan()
    {
        return $this->belongsTo(Jemaah::class, 'id_rombongan');
    }

    public function bioJemaah()
    {
        return $this->belongsTo(bioJemaah::class, 'jemaah_id');
    }

    public function infoSales()
    {
        return $this->belongsTo(Sales::class, 'sumber_info');
    }

    public function group()
    {
        return $this->belongsTo(Group::class, 'group_id');
    }

    public function pembayaran()
    {
        return $this->hasMany(Pembayaran::class, 'jemaah_id');
    }

    // Fungsi rombongan
    public static function listRombongan($idGroup)
    {
        return self::where('group_id', $idGroup)
            ->where(function ($query) {
                $query->whereNull('id_rombongan')
                    ->orWhereColumn('id_rombongan', 'id');
            })->get();
    }

    public static function memberRombongan($idRombongan)
    {
        return self::where('id_rombongan', $idRombongan)->get();
    }

    public static function addRombongan($idJemaah, $idRombongan)
    {
        if (self::isKetua($idRombongan)) {
            self::where('id', $idJemaah)->update(['id_rombongan' => $idRombongan]);
            self::where('id', $idRombongan)->update(['id_rombongan' => $idRombongan]);
            return true;
        }
        return false;
    }

    public static function updateRombongan($idJemaah, $idRombongan)
    {
        if (self::isKetua($idJemaah)) {
            if (self::isKetua($idRombongan)) {
                $data = self::memberRombongan($idJemaah);
                foreach ($data as $item) {
                    self::where('id', $item->id)->update(['id_rombongan' => $idRombongan]);
                }
                return true;
            }
            return false;
        }

        if (self::isKetua($idRombongan)) {
            self::where('id', $idJemaah)->update(['id_rombongan' => $idRombongan]);
            self::where('id', $idRombongan)->update(['id_rombongan' => $idRombongan]);
            return true;
        }

        return false;
    }

    public static function deleteRombongan($idJemaah)
    {
        if (self::isKetua($idJemaah)) {
            $data = self::memberRombongan($idJemaah);
            foreach ($data as $item) {
                self::where('id', $item->id)->update(['id_rombongan' => null]);
            }
        }
        self::where('id', $idJemaah)->update(['id_rombongan' => null]);
        return true;
    }

    public static function isKetua($idJemaah)
    {
        $data = self::find($idJemaah);
        return $data && ($data->id_rombongan === null || $data->id_rombongan === $data->id);
    }

    public static function isMember($idJemaah, $id_rombongan = null)
    {
        $data = self::find($idJemaah);
        if (!$data) return false;

        if ($id_rombongan !== null && $data->id_rombongan === $id_rombongan) {
            return true;
        } elseif ($data->id_rombongan !== null && $data->id_rombongan !== $data->id) {
            return true;
        }

        return false;
    }
}
