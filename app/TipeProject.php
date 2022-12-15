<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Portfolio;

class TipeProject extends Model
{
    protected $table = 'tipe_projects';

    protected $fillable = [
        'tipe_project','slug','gambar','desc'
    ];

    public function portfolios()
    {
        return $this->belongsToMany(Portfolio::class);
    }

    public function estimasi()
    {
        return $this->belongsToMany(Estimasi::class);
    }

    public function tipe_project_detail(){
        return $this->hasMany('App\TipeProjectDetail','tipe_project_id','id');
    }
}
