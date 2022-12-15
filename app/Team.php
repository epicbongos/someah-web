<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $table = 'teams';

    protected $fillabel = [
        'name', 'position', 'photo', 'slug',
    ];

    public function training()
    {
        return $this->hasMany('App\Training', 'team_id', 'id');
    }
}