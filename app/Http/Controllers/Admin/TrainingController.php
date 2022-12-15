<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Str;
// use RealRashid\SweetAlert\Facadesoms\Alert;
use RealRashid\SweetAlert\Facades\Alert;
use DataTables;
use App\Employee;
use App\Training;
use Carbon\Carbon;
use Session;
use Image;
use File;

class TrainingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function json()
    {
        $training = Training::select('training.*');

        return DataTables::eloquent($training)
            ->addColumn('nama_pegawai', function ($training) {
                return $training->employee_id . ' - ' .  $training->employee->nama;
            })
            ->addColumn('biaya', function ($training) {
                return 'Rp. ' . number_format($training->biaya, 0);
            })
            ->addColumn('pdf', function ($training) {
                if ($training->pdf) {
                    return '<a href="' . asset("uploaded/training/$training->pdf") . '" target="_blank" class="btn btn-success btn-sm">Lihat</a>';
                } else {
                    return '-';
                }
            })
            ->addColumn('mulai_pelatihan', function ($training) {
                return Carbon::parse($training->mulai_pelatihan)->format('d-m-Y');
            })
            ->addColumn('akhir_pelatihan', function ($training) {
                return Carbon::parse($training->mulai_pelatihan)->format('d-m-Y');
            })
            ->addColumn('aksi', function ($training) {
                return  '<div style="width: 100% !important; justify-content: center; display: flex;">' .
                    '<a href="' . route("training.show.update", $training->employee_id) . '"  style="padding: 7px; width:50%;" class="mr-2 float-left btn btn-success text-light">Edit</a>' .
                    '<button onclick="deleteData(' . $training->id . ')" style="padding: 7px; width: 50%;" class="btn btn-danger float-left" id="btn-hapus" >Hapus</button>' .
                    '</div>';
            })
            ->rawColumns(['biaya', 'aksi', 'pdf'])
            ->toJson();
    }
    public function index()
    {
        $training = Training::all();
        if (Session::has('success_message')) {
            Alert::success('Berhasil', session('success_message'));
            Session::forget('success_message');
        }
        return view('admin.pages.training.view-training', ['training' => $training]);
    }

    public function showInsert()
    {
        $data['employees'] = Employee::all();
        return view('admin.pages.training.view-input-training', $data);
    }

    public function showUpdate($id)
    {
        $data['employees'] = Employee::all();
        $data['training'] = Training::with('employee')->where('employee_id', $id)->first();
        return view('admin.pages.training.view-input-training', $data);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'employee_id' => 'required',
            'nama_pelatihan' => 'required',
            'tipe_pelatihan' => 'required',
            'penyelenggaraan' => 'required',
            'mulai_pelatihan' => 'required',
            'akhir_pelatihan' => 'required',
            'biaya' => 'required',
            'laporan' => 'required',
            'pdf' => 'required',
            'pdf' => 'mimes:pdf,doc,xls,ppt,jpeg,png,jpg,',
        ]);
        $input = $request->all();
        $input['mulai_pelatihan'] = Carbon::createFromFormat('m/d/Y', $input['mulai_pelatihan']);
        $input['akhir_pelatihan'] = Carbon::createFromFormat('m/d/Y', $input['akhir_pelatihan']);
        $input['biaya'] = (int)str_replace('.', '', $request->biaya);
        $path = 'uploaded/training';

        if (!File::isDirectory($path)) {
            File::makeDirectory($path, 0777, true, true);
        }

        if ($request->hasFile('pdf')) {
            $newFileName = Carbon::now()->format('Y-m-d')  . '-' . $request->file('pdf')->getClientOriginalName();
            $input['pdf'] = $newFileName;
            $request->file('pdf')->move($path, $newFileName);
        } else {
            $input['pdf'] = null;
        }

        $insert = new Training();
        $insert->fill($input);
        $insert->save();

        return redirect('/admin/training')->with(Session::flash('success_message', 'Data Berhasil Ditambahkan'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'employee_id' => 'required',
            'nama_pelatihan' => 'required',
            'tipe_pelatihan' => 'required',
            'penyelenggaraan' => 'required',
            'mulai_pelatihan' => 'required',
            'akhir_pelatihan' => 'required',
            'biaya' => 'required',
            'laporan' => 'required',
            'pdf' => 'mimes:pdf,doc,xls,ppt,jpeg,png,jpg,',
        ]);
        $input = $request->all();
        $input['mulai_pelatihan'] = Carbon::createFromFormat('m/d/Y', $input['mulai_pelatihan']);
        $input['akhir_pelatihan'] = Carbon::createFromFormat('m/d/Y', $input['akhir_pelatihan']);
        $input['biaya'] = (int)str_replace('.', '', $request->biaya);
        $path = 'uploaded/training';

        if ($request->hasFile('pdf')) {
            $input['pdf'] = $request->file('pdf');
            $newFileName = Carbon::now()->format('Ymd')  . '-' . $request->file('pdf')->getClientOriginalName();
            $request->file('pdf')->move($path, $newFileName);
            $input['pdf'] = $newFileName;
        }
        $anggota = Training::where('id', $id)->first();
        $anggota->fill($input);
        $anggota->update();
        return redirect('/admin/training')->with(Session::flash('success_message', 'Data Berhasil Diperbaharui'));
    }

    public function destroy($id)
    {
        $anggota = Training::where('id', $id)->first();
        $anggota->delete();
        return redirect()->back()->with(Session::flash('success_message', 'Data Berhasil Dihapus'));
    }
}