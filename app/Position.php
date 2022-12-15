<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    protected $table = 'positions';

    protected $fillable = [
        'nama_jabatan', 'status_posisi', 'gapok', 'tunj_jabatan', 'tunj_transportasi'
    ];
}