<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    protected $table = 'salaries';

    protected $fillable = [
        'tanggal', 'total_transferred', 'keterangan', 'status'
    ];

    public function salary_detail()
    {
        return $this->hasMany('App\SalaryDetail', 'salary_id', 'id');
    }
}