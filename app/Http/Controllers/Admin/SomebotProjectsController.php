<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;
use DataTables;
use Carbon\Carbon;
use App\SomebotProjects;
use App\Eloquent;
use Session;

class SomebotProjectsController extends Controller{
    public function __construct(){
        $this->middleware('auth');
    }

    public $timestamps = true;

    public function json(){
        $somebot = SomebotProjects::select('projects.*');

        return DataTables::eloquent($somebot)
        ->addColumn('aksi', function($somebot){
            return '<div style="width: 100% !important; justify-content: center; display: flex;">' .
                '<a href="' . url("/admin/somebot-projects/update-project/$somebot->id") . '" style="padding: 7px; width: 25%;" class="mr-2 float-left btn btn-success text-light">Edit</a>' .
                '<button style="padding: 7px; width: 25%;" class="btn btn-danger float-left" id="btn-hapus" onclick="deleteData(' . $somebot->id . ')">Hapus</button>' .
                '</div>';
        })
        ->rawColumns(['aksi'])
        ->toJson();
    }

    public function index(){
        $somebot = SomebotProjects::all();
        if (Session::has('success_message')) {
            Alert::success('Berhasil', session('success_message'));
            Session::forget('success_message');
        }
        return view('admin.pages.somebot.view-somebot');
    }

    public function destroy($id){
        $somebot = SomebotProjects::where('id', $id)->first();
        $projects = $somebot->detail($id)->delete();
        // dd($projects);
        $somebot->delete();

        return redirect()->back()->with(Session::flash('success_message', 'Data Berhasil Dihapus'));
    }

    public function store(Request $request){
        $this->validate($request, [
            'project_id.*' => 'required',
            'ref.*' => 'required',
            'token.*' => 'required'
        ]);

        $project_id = $request->project_id;
        $ref = $request->ref;
        $token = $request->token;
        $current_timestamp = Carbon::now()->toDateTimeString();
        // $data = [$project_id, $ref, $token];
        $data = array(
            'project_id' => $project_id,
            'ref' => $ref,
            'token' => $token,
            'createdAt' => $current_timestamp,
            'updatedAt' => $current_timestamp
        );


        SomebotProjects::insert($data);
        return redirect('/admin/somebot-projects')->with(Session::flash('success_message', 'Data Berhasil Ditambahkan'));
    }

    public function showUpdate($id){
        $somebot = SomebotProjects::where('id', $id)->first();
        return view('admin.pages.somebot.view-update-somebot', ['somebot'=> $somebot]);
    }

    public function update(Request $request, $id){
        $somebot = SomebotProjects::where('id', $id)->first();
        $somebot->project_id = $request->project_id;
        $somebot->ref = $request->ref;
        $somebot->token = $request->token;

        $somebot->update();

        return redirect('/admin/somebot-projects')->withSuccessMessage('Project Diperbaharui');
    }
}
