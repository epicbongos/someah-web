<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $table = 'employees';

    protected $fillable = [
        'position_id', 'nip', 'nama', 'photo', 'tempat', 'tgl_lahir', 'alamat', 'bank', 'no_rekening', 'email', 'ktp', 'npwp', 'bpjs', 'no_telepon', 'nama_ibu', 'status_pegawai'
    ];

    public function position()
    {
        return $this->hasOne('App\Position', 'id', 'position_id');
    }

    public function salary_detail()
    {
        return $this->hasOne('App\SalaryDetail', 'employee_id', 'id');
    }
    public function training()
    {
        return $this->hasMany('App\Training', 'employee_id', 'id');
    }
}

