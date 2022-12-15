<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipeLingkup extends Model
{
    protected $table = 'tipe_lingkup';

    protected $fillable = [
        'tipe_lingkup','slug',
    ];       

    public function estimasi()
    {
        return $this->hasOne(Estimasi::class);
    }
}
