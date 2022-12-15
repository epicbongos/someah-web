<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Applicant extends Model
{
    protected $table = 'applicants';

    protected $fillable = [
        'first_name', 'carrers_id','last_name','telp','email','desc','attachment'
    ];

    public function carrer(){
        return $this->belongsTo('App\Carrer','carrers_id','id');
    }
}
