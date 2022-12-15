<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipeProjectDetail extends Model
{
    protected $table = 'tipe_projects_details';

    protected $fillable = [
        'tipe_project_id','bahasa_pemrograman','logo'
    ];

    public function tipe_project(){
        return $this->belongsTo('App\TipeProject','tipe_project_id','id');
    }

}
