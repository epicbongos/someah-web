<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipeKarir extends Model
{
    protected $table = 'tipe_karirs';

    protected $fillable = [
        'tipe_karir','slug',
    ];       

    public function carrer()
    {
        return $this->belongsToMany(Carrer::class);
    }
}
