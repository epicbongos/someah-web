<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
class Portfolio extends Model
{
    protected $table = 'portfolios';

    protected $fillable = [
        'portofolio_name','desc','product_img','year','client_id','slug','status','keterangan'
    ];   

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function tipeprojects()
    { 
        return $this->belongsToMany(TipeProject::class);
    }

    public function getProductImgAttribute()
    {
        $jsonProduct = @$this->attributes['product_img'] ?? [];
        return json_decode($jsonProduct);
    }
}
