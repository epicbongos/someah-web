<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $table = 'clients';

    protected $fillable = [
        'company_name', 'desc', 'slug', 'logo', 'mini_logo', 'status'
    ];

    public function portfolios()
    {
        return $this->hasMany(Portfolio::class);
    }
}