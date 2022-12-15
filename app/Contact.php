<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $table = 'contacts';

    protected $fillable = [
        'alamat','alamat_link','email','telepon','instagram','linkedin'
    ];

}
