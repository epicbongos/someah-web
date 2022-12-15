<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SalaryDetail extends Model
{
    protected $table = 'salaries_details';

    protected $fillable = [
        'salary_id', 'employee_id', 'gapok', 'tunj_jabatan', 'bonus', 'insentif_project', 'reimburse', 'lembur', 'total_gaji', 'salary_cut', 'transferred', 'keterangan',
        'tunj_bpjs_kes', 'tunj_bpjs_jkk', 'tunj_bpjs_jkm', 'tunj_bpjs_jht', 'tunj_hari_raya', 'pph21', 'iuran_bpjs_someah', 'iuran_bpjs_jkk',
        'iuran_bpjs_jht', 'total_potongan', 'terbilang', 'iuran_bpjs_kes1',
        'tunj_transport', 'kehadiran_potongan'
    ];

    public function salary()
    {
        return $this->belongsTo('App\Salary', 'salary_id', 'id');
    }

    public function employee()
    {
        return $this->belongsTo('App\Employee', 'employee_id', 'id');
    }
}