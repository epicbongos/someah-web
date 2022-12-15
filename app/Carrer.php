<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Carrer extends Model
{
    protected $table = 'carrers';

    protected $fillable = [
        'job_position','desc','slug','tipe_karir_id'
    ];   

    public function tipekarir()
    { 
        return $this->belongsToMany(TipeKarir::class);
    }
}
