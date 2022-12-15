<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;
use DataTables;
use Carbon\Carbon;
use App\SomebotGroups;
use App\SomebotNotification;
use App\SomebotProjects;
use App\Eloquent;
use Session;

class SomebotGroupsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public $timestamps = true;

    public function json()
    {
        $somebot = SomebotGroups::select('groups.*');
        return DataTables::eloquent($somebot)
        ->addColumn('total_project', function($somebot){
            $projects = SomebotGroups::where('id', $somebot->id)->first(); //show projects that relate on group id via notification table
            return count($projects->detail);
        })
        ->addColumn('aksi', function($somebot){
            return '<div style="width: 100% !important; justify-content: center; display: flex;">' .
                '<a href="' . url("/admin/somebot-groups/showdetail/$somebot->id") . '" style="padding: 7px; width: 25%;" class="mr-2 float-left btn btn-primary text-light" id="btn-detail">Detail</a>' .
                '<a href="' . url("/admin/somebot-groups/update-group/$somebot->group_id") . '" style="padding: 7px; width: 25%;" class="mr-2 float-left btn btn-success text-light">Edit</a>' .
                '<button style="padding: 7px; width: 25%;" class="btn btn-danger float-left" id="btn-hapus" onclick="deleteData(' . $somebot->id . ')">Hapus</button>' .
                '</div>';
        })
        ->rawColumns(['total_project'])
        ->rawColumns(['aksi'])
        ->toJson();
    }

    public function index()
    {
        // $somebot = SomebotGroups::all();
        if (Session::has('success_message')) {
            Alert::success('Berhasil', session('success_message'));
            Session::forget('success_message');
        }
        return view('admin.pages.somebot.view-somebot-groups');
    }

    public function showDetail($id)
    {
        $somebot = SomebotGroups::where('id', $id)->first();

        $projectlist = [];
        foreach ($somebot->detail as $key => $value) {
            $projectlist[] = [
                $value->detailProjects->id, $value->detailProjects->project_id, $value->detailProjects->ref
            ];
        }
        return view('admin.pages.somebot.detail-somebot-groups', compact('somebot', 'projectlist'));
    }

    public function destroy($id)
    {
        $somebot = SomebotGroups::where('id', $id)->first();
        $groups = $somebot->detail($id)->delete(); //Remove Notification
        $somebot->delete();

        return redirect()->back()->with(Session::flash('success_message', 'Data Berhasil Dihapus'));
    }

    public function showUpdate($group_id)
    {
        $somebot = SomebotGroups::where('group_id', $group_id)->first();

        $projectlist = [];
        foreach($somebot->detail as $key=>$value){
            $projectlist[] = [
                $value->detailProjects->id, $value->detailProjects->project_id, $value->detailProjects->ref
            ];
        }

        return view('admin.pages.somebot.view-update-somebot-groups', compact('somebot', 'projectlist'));
    }

    public function getProjects(Request $request)
    {
        $search = $request->search;
        if($search==''){
            $projects = SomebotProjects::select('id', 'project_id', 'ref')->get();
        }else{
            $projects = SomebotProjects::select('id', 'project_id', 'ref')->where('project_id', 'like', '%' . $search . '%')->get();
        }
        $response = array();
        foreach ($projects as $project) {
            $response[] = array(
                "id" => $project->id,
                "text" => $project->project_id . ' - ' . $project->ref
            );
        }
        echo json_encode($response);

        exit;
    }

    public function update(Request $request, $group_id)
    {
        $somebot = SomebotGroups::where('group_id', $group_id)->first();
        $somebot->group_id = $request->group_id;
        $somebot->name = $request->name;

        $somebot->update();

        $id = $somebot->id;
        $projects = $somebot->detail($id)->delete(); //Remove First
        $projects = $request->projectlist;

        $current_timestamp = Carbon::now()->toDateTimeString();
        for ($count = 0; $count < count($projects); $count++){
            $data = array(
                'group_id' => $id,
                'project_id' => $projects[$count],
                'createdAt' => $current_timestamp,
                'updatedAt' => $current_timestamp
            );

            $insert_data[] = $data;
        }
        SomebotNotification::insert($insert_data);

        return redirect('/admin/somebot-groups')->withSuccessMessage('Project Diperbaharui');
    }
}
