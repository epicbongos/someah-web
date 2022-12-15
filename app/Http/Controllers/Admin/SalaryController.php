<?php

namespace App\Http\Controllers\Admin;

use App\Employee;
use App\Http\Controllers\Controller;
use App\Salary;
use App\SalaryDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;

class SalaryController extends Controller
{
    public function index()
    {
        if (session('success_message')) {
            Alert::success('Berhasil', session('success_message'));
        }
        $data['pegawai'] = Employee::where('status_pegawai', 'aktif')->get();
        return view('admin.pages.salary.list', $data);
    }

    public function json()
    {
        $gaji = Salary::select('salaries.*');

        return DataTables::eloquent($gaji)
            ->addColumn('aksi', function ($gaji) {
                return '<div style="width: 100% !important; justify-content: center !important; display: flex; align-items: center;">' .
                    '<a href="' . route("salary.show", $gaji->id) . '" style="padding: 7px; width:20%;" class="mr-2 float-left btn btn-success text-light"><i class="fas fa-eye"></i></a>' .
                    '<button onclick="sendEmail(' . $gaji->id . ')" style="padding: 7px; width:20%;" class="mr-2 float-left btn btn-primary text-light" ><i class="far fa-paper-plane"></i></button>' .
                    '<a href="' . url('/admin/salary/print-csv/' . $gaji->id) . '" style="padding: 7px; width:20%;" class="mr-2 float-left btn btn-warning text-light" target="_blank"><i class="fa  fa-print"></i></a>' .
                    '<button style="padding: 7px; width: 20%;" class="btn btn-danger float-left" id="btn-hapus" onclick="deleteData(' . $gaji->id . ')"><i class="fas fa-trash-alt"></i></button>' .
                    '</div>';
            })
            ->addColumn('bulan', function ($gaji) {
                return Carbon::createFromFormat('Y-m-d', $gaji->tanggal)->format('F ( Y )');
            })
            ->addColumn('total_transferred', function ($gaji) {
                return 'Rp. ' . number_format($gaji->total_transferred, 0);
            })
            ->addColumn('status', function ($gaji) {
                if ($gaji->status == 1) {
                    return '<badge class="badge badge-success">Email Telah Dikirim</badge>';
                } else {
                    return '<badge class="badge badge-warning"><span>Email Belum Dikirim</span></badge>';
                }
            })
            ->rawColumns(['status', 'total_transferred', 'bulan', 'aksi', 'status_pegawai '])
            ->toJson();
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'tanggal' => 'required',
            'keterangan' => 'required',
        ]);

        $input = $request->all();
        $input['tanggal'] = Carbon::createFromFormat('d/m/Y', $request->tanggal);
        //
        $gaji = Salary::create($input);

        if ($gaji) {
            $data_pegawai = Employee::where('status_pegawai', 'aktif')->get();
            foreach ($data_pegawai as $pegawai) {
                $inputDetail['salary_id'] = $gaji->id;
                $inputDetail['employee_id'] = $pegawai->id;

                $inputDetail['gapok'] = $pegawai->position->gapok;
                $inputDetail['tunj_jabatan'] = $pegawai->position->tunj_jabatan;
                $inputDetail['tunj_transportasi'] = $pegawai->position->tunj_transportasi;
                $inputDetail['total_potongan'] = 0;

                $inputDetail['total_gaji'] = $inputDetail['gapok'] + $inputDetail['tunj_jabatan'];
                $inputDetail['transferred'] = $inputDetail['total_gaji'] - $inputDetail['total_potongan'];

                $detailSalary = SalaryDetail::create($inputDetail);
            }
        }

        if ($detailSalary) {
            $salary = Salary::with('salary_detail')->where('id', $gaji->id)->first();
            $tot_transferred = 0;

            foreach ($salary->salary_detail as $val) {
                $tot_transferred += $val->transferred;
            }

            $salary->total_transferred = $tot_transferred;
            // dd($salary->salary_detail);
            $salary->save();
        }


        if ($salary) {
            return redirect('/admin/salary')->with(Session::flash('success_message', 'Data Penggajian Berhasil Digenerate'));
        }
    }

    public function show($id)
    {
        $data['gaji'] = Salary::find($id);
        $data['detail_gaji'] = SalaryDetail::with('salary', 'employee', 'employee.position')->where('salary_id', $id)->get();

        if (session('success_message')) {
            Alert::success('Berhasil', session('success_message'));
        }

        return view('admin.pages.salary.detail', $data);
    }

    public function show_detail($id)
    {
        $data['detail'] = SalaryDetail::with('salary', 'employee', 'employee.position')->where('id', $id)->first();
        //        dd($data);
        return response()->json($data);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'tanggal' => 'required',
            'keterangan_gaji' => 'required',
        ]);

        $gaji = Salary::find($id);
        $gaji->keterangan = $request->keterangan_gaji;
        $gaji->tanggal = Carbon::createFromFormat('d/m/Y', $request->tanggal);
        $gaji->save();

        return redirect(route('salary.show', $id))->with(Session::flash('success_message', 'Data Berhasil DIubah'));
    }

    public function detail_update(Request $request, $id)
    {
        $this->validate($request, [
            'gapok' => 'required',
            'tunj_jabatan' => 'required',
            'bonus' => 'required',
            'insentif_project' => 'required',
            'reimburse' => 'required',
            'lembur' => 'required',
            'total_gaji' => 'required',
            'salary_cut' => 'required',
            'transferred' => 'required'
        ]);

        $detail = SalaryDetail::with('salary')->where('id', $id)->first();
        $detail->gapok = (int)str_replace('.', '', $request->gapok);
        $detail->tunj_jabatan = (int)str_replace('.', '', $request->tunj_jabatan);
        $detail->bonus = (int)str_replace('.', '', $request->bonus);
        $detail->insentif_project = (int)str_replace('.', '', $request->insentif_project);
        $detail->reimburse = (int)str_replace('.', '', $request->reimburse);
        $detail->total_gaji = (int)str_replace('.', '', $request->total_gaji);
        $detail->lembur = (int)str_replace('.', '', $request->lembur);
        $detail->salary_cut = (int)str_replace('.', '', $request->salary_cut);
        $detail->transferred = (int)str_replace('.', '', $request->transferred);
        $detail->keterangan = $request->keterangan;
        $detail->save();

        $id_gaji = $detail->salary->id;
        $gaji = Salary::find($id_gaji);

        $tot_transferred = 0;
        $detailAll = SalaryDetail::where('salary_id', $id_gaji)->get();
        foreach ($detailAll as $val) {
            $tot_transferred += (int)$val->transferred;
        }
        $gaji->total_transferred = $tot_transferred;
        $status = $gaji->save();

        if ($status) {
            return redirect()->route('salary.show', $id_gaji)->with(Session::flash('success_message', 'Data Berhasil Diubah'));
        }
    }

    public function detail_gaji($id)
    {
        $data['detail'] = SalaryDetail::with('salary', 'employee')->where('id', $id)->first();
        if (session('success_message')) {
            Alert::success('Berhasil', session('success_message'));
        }
        return view('admin.pages.salary.form-detail-gaji', $data);
    }

    public function detail_gaji_store(Request $request, $id)
    {
        $this->validate($request, [
            'gapok' => 'required',
            'pph21' => 'required',
            'tunj_jabatan' => 'required',
            'iuran_bpjs_someah' => 'required',
            'bonus' => 'required',
            'iuran_bpjs_kes1' => 'required',
            'insentif_project' => 'required',
            'iuran_bpjs_jkk' => 'required',
            'reimburse' => 'required',
            'iuran_bpjs_jht' => 'required',
            'lembur' => 'required',
            'salary_cut' => 'required',
            'tunj_bpjs_kes' => 'required',
            'total_potongan' => 'required',
            'tunj_bpjs_jkk' => 'required',
            'tunj_bpjs_jkm' => 'required',
            'tunj_bpjs_jht' => 'required',
            'tunj_hari_raya' => 'required',
            'tunj_transport' => 'required',
            'total_gaji' => 'required',
            'kehadiran_potongan' => 'required',
            'transferred' => 'required',
            'terbilang' => 'required'
        ]);

        $detail = SalaryDetail::with('salary')->where('id', $id)->first();
        $updateDetail['gapok'] = (int)str_replace('.', '', $request->gapok);
        $updateDetail['pph21'] = (int)str_replace('.', '', $request->pph21);
        $updateDetail['tunj_jabatan'] = (int)str_replace('.', '', $request->tunj_jabatan);
        $updateDetail['iuran_bpjs_someah'] = (int)str_replace('.', '', $request->iuran_bpjs_someah);
        $updateDetail['bonus'] = (int)str_replace('.', '', $request->bonus);
        $updateDetail['iuran_bpjs_kes1'] = (int)str_replace('.', '', $request->iuran_bpjs_kes1);
        $updateDetail['insentif_project'] = (int)str_replace('.', '', $request->insentif_project);
        $updateDetail['iuran_bpjs_jkk'] = (int)str_replace('.', '', $request->iuran_bpjs_jkk);
        $updateDetail['reimburse'] = (int)str_replace('.', '', $request->reimburse);
        $updateDetail['iuran_bpjs_jht'] = (int)str_replace('.', '', $request->iuran_bpjs_jht);
        $updateDetail['lembur'] = (int)str_replace('.', '', $request->lembur);
        $updateDetail['salary_cut'] = (int)str_replace('.', '', $request->salary_cut);
        $updateDetail['tunj_bpjs_kes'] = (int)str_replace('.', '', $request->tunj_bpjs_kes);
        $updateDetail['total_potongan'] = (int)str_replace('.', '', $request->total_potongan);
        $updateDetail['tunj_bpjs_jkk'] = (int)str_replace('.', '', $request->tunj_bpjs_jkk);
        $updateDetail['tunj_bpjs_jkm'] = (int)str_replace('.', '', $request->tunj_bpjs_jkm);
        $updateDetail['tunj_bpjs_jht'] = (int)str_replace('.', '', $request->tunj_bpjs_jht);
        $updateDetail['tunj_hari_raya'] = (int)str_replace('.', '', $request->tunj_hari_raya);
        $updateDetail['tunj_transport'] = (int)str_replace('.', '', $request->tunj_transport);
        $updateDetail['kehadiran_potongan'] = (int)str_replace('.', '', $request->kehadiran_potongan);
        $updateDetail['total_gaji'] = (int)str_replace('.', '', $request->total_gaji);
        $updateDetail['transferred'] = (int)str_replace('.', '', $request->transferred);
        $updateDetail['terbilang'] = $request->terbilang;
        $status = $detail->update($updateDetail);

        $id_gaji = $detail->salary->id;
        $gaji = Salary::find($id_gaji);

        $tot_transferred = 0;
        $detailAll = SalaryDetail::where('salary_id', $id_gaji)->get();
        foreach ($detailAll as $val) {
            $tot_transferred += (int)$val->transferred;
        }
        $gaji->total_transferred = $tot_transferred;
        $gaji->save();
        if ($status) {
            return redirect(url('admin/salary/detail-gaji/' . $id))->with(Session::flash('success_message', 'Data Berhasil Diubah'));
        }
    }


    public function destroy($id)
    {
        $gaji = Salary::find($id);
        $deleteGaji = $gaji->delete();
        if ($deleteGaji) {
            $detailGaji = SalaryDetail::where('salary_id', $id)->get();
            foreach ($detailGaji as $value) {
                $status = $value->delete();
            }
        }

        if ($status) {
            return redirect(route('salary.index'))->with(Session::flash('success_message', 'Data Berhasil Dihapus'));
        }
    }

    public function delete_detail($id)
    {
        $detail = SalaryDetail::find($id);
        $status = $detail->delete();

        if ($status) {
            return 1;
        }
    }

    public function printCSV($id)
    {
        $filename = sprintf('%s.csv', Str::title(Salary::find($id)->keterangan));

        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=' . $filename);

        $gaji = SalaryDetail::with('salary', 'employee')->where('salary_id', $id)
            ->whereHas('employee', function ($query) {
                $query->whereIn('bank', ['BNI', 'BNI SYARIAH']);
            })
            ->get();

        $file = fopen('php://output', 'w');

        $row = [Carbon::now()->setTimezone("Asia/Jakarta")->format('d/m/Y H:i:s'), $gaji->count(), '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''];
        fputs($file, implode(",", $row) . "\n");

        $total = 0;
        foreach ($gaji as $value) {
            $total += $value->transferred;
        }
        $row = ['P', Carbon::createFromFormat('Y-m-d', $gaji[0]->salary->tanggal)->format('Ymd'), 8812349994, $gaji->count(), $total, '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''];
        fputcsv($file, $row);

        foreach ($gaji as $val) {
            $data = [$val->employee->no_rekening, $val->employee->nama, $val->transferred, 0, 0, '', '', '', '', '', '', '', '', '', '', '', 'N', '', '', 'N'];
            fputs($file, implode(",", $data) . "\n");
        }

        fclose($file);
    }
}