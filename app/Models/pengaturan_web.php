<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class pengaturan_web extends Model
{
    protected $table = 'pengaturan_web';
    protected $primaryKey = 'id';
    protected $fillable = [
        'code',
        'value',
        'canDelete',
    ];
}
