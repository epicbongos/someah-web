<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estimasi extends Model
{
    protected $table = 'estimasis';

    protected $fillable = [
        'nama','email','perusahaan','nama_seluler','bidang_perusahaan','asal_perusahaan','ide_anda','tipe_lingkup_id'
    ];

    public function tipelingkup()
    {
        return $this->hasOne(TipeLingkup::class,'id','tipe_lingkup_id');
    }

    public function tipeproject()
    {
        return $this->belongsToMany(TipeProject::class);
    }
}
