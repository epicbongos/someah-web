<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;
use DataTables;
use App\Carrer;
use App\TipeKarir;
use App\Applicant;
use Session;

class ApplicantController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if(Session::has('success_message'))
        {
            Alert::success('Berhasil', session('success_message'));
            Session::forget('success_message');
        }
        return view('admin.pages.applicants.list');
    }



    public function jsonApplicant(){
        $applicants = Applicant::select('applicants.*');
        return DataTables::eloquent($applicants)
        ->addColumn('aksi', function($applicant){

            return  '<div style="width: 100% !important; justify-content: center !important; display: flex">' .
                '<a href="'.route('applicant.download',$applicant->id).'" style="padding: 7px 22px;" class="mr-2 float-left btn btn-primary text-light"><i class="fas fa-file-download"></i></a>' .
                '<button style="padding: 7px 15px;" class="btn btn-danger" id="btn-hapus" onclick="deleteApplicant(' . $applicant->id . ')">Hapus</button>'.
                '</div>';
        })
        ->addColumn('nama', function ($applicants){
            return $applicants->first_name.' '.$applicants->last_name;
        })
        ->addColumn('posisi', function ($applicants){
            return $applicants->carrer->job_position;
        })
        ->rawColumns(['nama','aksi'])
        ->toJson();
    }

    public function destroyApplicant($id)
    {
        Applicant::where('id', $id)->delete();
        return redirect()->back()->with(Session::flash('success_message', 'Data Berhasil Dihapus'));
    }

    public function download($id){
        $applicant = Applicant::find($id);
        $filepath = public_path('uploaded/applicant/').$applicant->attachment;
//        dd($filepath);
//        return Response::download($filepath);
        return response()->download($filepath);
    }
}
