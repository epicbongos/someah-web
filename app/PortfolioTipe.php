<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
class PortfolioTipe extends Model
{
    protected $table = 'portfolio_tipe_project';

    public function portofolio(){
        return $this->belongsTo('App\Portfolio','portfolio_id','id');
    }

}
