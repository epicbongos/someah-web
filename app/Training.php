<?php

namespace App;



use Illuminate\Database\Eloquent\Model;

class Training extends Model
{
    protected $table = 'training';

    protected $fillable = [
        'employee_id', 'nama_pelatihan', 'tipe_pelatihan', 'penyelenggaraan', 'mulai_pelatihan', 'akhir_pelatihan', 'biaya', 'laporan', 'pdf'
    ];

    public function team()
    {
        return $this->belongsTo('App\Team', 'id_karyawan', 'id');
    }

    public function employee()
    {
        return $this->belongsTo('App\Employee', 'employee_id', 'id');
    }
}