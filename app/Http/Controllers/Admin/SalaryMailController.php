<?php

namespace App\Http\Controllers\Admin;

use App\Employee;
use App\Http\Controllers\Controller;
use App\Jobs\SendSalaryEmail;
use App\Mail\SalaryEmail;
use App\Salary;
use App\SalaryDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;

class SalaryMailController extends Controller
{
    public function sendMail($id)
    {

        $detail_gaji = SalaryDetail::with('salary', 'employee', 'employee.position')->where('salary_id', $id)->get();

        foreach ($detail_gaji as $val) {
            //           dispatch(new SendSalaryEmail([
            //               'salary_detail' => $val
            //           ]));
            Mail::to($val->employee->email)->queue(new SalaryEmail([
                'salary_detail' => $val
            ]));
        }

        $gaji = Salary::find($id);
        $gaji->status = 1;
        $gaji->save();

        return redirect(route('salary.index'))->with(Session::flash('success_message', 'Data Sedang Dikirim'));
    }

    public function sendMailSatuan($id)
    {
        $salary_detail = SalaryDetail::where('id', $id)->with('salary', 'employee', 'employee.position')->first();

        dispatch(new SendSalaryEmail([
            'salary_detail' => $salary_detail
        ]));

        return 1;
    }
}