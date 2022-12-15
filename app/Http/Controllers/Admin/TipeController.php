<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;
use DataTables;
use Session;
use App\TipeKarir;
use App\TipeProject;
use App\TipeLingkup;

class TipeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function jsonkarir(){
        $types = TipeKarir::select('tipe_karirs.*');

        return DataTables::eloquent($types)
        ->addColumn('aksi', function($type){
            return  '<div style="width: 100% !important; justify-content: center !important; display: flex">' .
                    '<a href="'.url('/admin/tipe/update-tipe-karir/').'/'. $type->slug .  '" style="padding: 7px 22px;" class="mr-2 float-left btn btn-success text-light">Edit</a>' .
                    '<button style="padding: 7px 15px;" class="btn btn-danger float-left" id="btn-hapus" onclick="deleteDataKarir(' . $type->id . ')">Hapus</button>' .
                    '</div>';
        })
        ->rawColumns(['aksi'])
        ->toJson();
    }

    public function jsonProject(){
        $types = TipeProject::select('tipe_projects.*');

        return DataTables::eloquent($types)
        ->addColumn('aksi', function($type){
            return  '<div style="width: 100% !important; justify-content: center !important; display: flex">' .
                    '<a href="'.url('/admin/tipe/update-tipe-project/').'/'. $type->slug .  '" style="padding: 7px 22px;" class="mr-2 float-left btn btn-success text-light">Edit</a>' .
                    '<button style="padding: 7px 15px;" class="btn btn-danger" id="btn-hapus" onclick="deleteDataProject(' . $type->id . ')">Hapus</button>' .
                    '</div>';
        })
        ->rawColumns(['aksi'])
        ->toJson();
    }

    public function jsonLingkup(){
        $types = TipeLingkup::select('tipe_lingkup.*');

        return DataTables::eloquent($types)
        ->addColumn('aksi', function($type){
            return  '<div style="width: 100% !important; justify-content: center !important; display: flex">' .
                    '<a href="'.url('/admin/tipe/update-tipe-lingkup/').'/'. $type->slug .  '" style="padding: 7px 22px;" class="mr-2 float-left btn btn-success text-light">Edit</a>' .
                    '<button style="padding: 7px 15px;" class="btn btn-danger" id="btn-hapus" onclick="deleteDataLingkup(' . $type->id . ')">Hapus</button>' .
                    '</div>';
        })
        ->rawColumns(['aksi'])
        ->toJson();
    }

    public function index()
    {
        if(Session::has('success_message'))
        {
            Alert::success('Berhasil', session('success_message'));
            Session::forget('success_message');
        }
        return view('admin.pages.view-tipe');
    }

    public function showInsertKarir()
    {
        return view('admin.pages.view-insert-tipekarir')->with('status','insert');
    }

    public function showUpdatekarir($slug)
    {
        $type = TipeKarir::where('slug', $slug)->first();
        return view('admin.pages.view-insert-tipekarir', compact(['type']))->with('status','update');
    }

    public function showInsertProject()
    {
        return view('admin.pages.view-insert-tipeproject')->with('status','insert');
    }

    public function showUpdateProject($slug)
    {
        $type = TipeProject::where('slug', $slug)->first();
        return view('admin.pages.view-insert-tipeproject', compact(['type']))->with('status','update');
    }

    public function showInsertLingkup()
    {
        return view('admin.pages.view-insert-tipelingkup')->with('status','insert');
    }

    public function showUpdateLingkup($slug)
    {
        $type = TipeLingkup::where('slug', $slug)->first();
        return view('admin.pages.view-insert-tipelingkup', compact(['type']))->with('status','update');
    }

    public function storeKarir(Request $request){

        $this->validate($request, [
            'tipekarir.*' => 'required',
        ]);

        $tipekarir = $request->tipekarir;

        for($count = 0; $count < count($tipekarir); $count++)
        {
            $data = array(
                'tipe_karir' => $tipekarir[$count],
                'slug' => Str::slug($tipekarir[$count],'-'),
            );

            $insert_data[] = $data;
        }

        TipeKarir::insert($insert_data);

        return redirect('/admin/tipe')->with(Session::flash('success_message', 'Data Berhasil Ditambahkan'));
    }

    public function storeLingkup(Request $request){

        $this->validate($request, [
            'tipelingkup.*' => 'required',
        ]);

        $tipelingkup = $request->tipelingkup;

        for($count = 0; $count < count($tipelingkup); $count++)
        {
            $data = array(
                'tipe_lingkup' => $tipelingkup[$count],
                'slug' => Str::slug($tipelingkup[$count],'-'),
            );

            $insert_data[] = $data;
        }

        TipeLingkup::insert($insert_data);

        return redirect('/admin/tipe')->with(Session::flash('success_message', 'Data Berhasil Ditambahkan'));
    }

    public function storeProject(Request $request){
//        dd($request->all());
        $this->validate($request, [
            'tipeproject.*' => 'required',
            'gambar.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg'
        ]);

        $input['tipe_project'] = $request->tipeproject;
        $input['slug'] = Str::slug($request->tipeproject,'-');
        $input['desc'] = $request->desc;
        $namaFoto = Str::random(16);

        if ($request->hasFile('gambar')) {
            $input['gambar'] = $this->uploadImage($request,$namaFoto);
        }



        TipeProject::insert($input);
        return redirect('/admin/tipe')->with(Session::flash('success_message', 'Data Berhasil Ditambahkan'));
    }


    public function updateKarir(Request $request, $slug)
    {
        $type = TipeKarir::where('slug', $slug)->first();
        $type->tipe_karir = $request->tipekarir;
        $type->slug = Str::slug($request->tipekarir,'-');
        $type->update();
        return redirect('/admin/tipe')->with(Session::flash('success_message', 'Data Berhasil Diperbaharui'));
    }

    public function updateLingkup(Request $request, $slug)
    {
        $type = TipeLingkup::where('slug', $slug)->first();
        $type->tipe_lingkup = $request->tipelingkup;
        $type->slug = Str::slug($request->tipelingkup,'-');
        $type->update();
        return redirect('/admin/tipe')->with(Session::flash('success_message', 'Data Berhasil Diperbaharui'));
    }


    public function updateProject(Request $request, $slug)
    {
        $type = TipeProject::where('slug', $slug)->first();
        $type->tipe_project = $request->tipeproject;
        $type->slug = Str::slug($request->tipeproject,'-');
        $type->desc = $request->desc;
        $namaFoto = Str::random(16);
        if ($request->hasFile('gambar')) {
            File::delete('uploaded/tipe_project/'.$type->gambar);
            $type->gambar = $this->uploadImage($request,$namaFoto);
        }
        $type->update();
        return redirect('/admin/tipe')->with(Session::flash('success_message', 'Data Berhasil Diperbaharui'));
    }

    public function destroyKarir($id)
    {
        TipeKarir::where('id', $id)->delete();
        return redirect()->back()->with(Session::flash('success_message', 'Data Berhasil Dihapus'));
    }

    public function destroyProject($id)
    {
        TipeProject::where('id', $id)->delete();
        return redirect()->back()->with(Session::flash('success_message', 'Data Berhasil Dihapus'));
    }

    public function destroyLingkup($id)
    {
        TipeLingkup::where('id', $id)->delete();
        return redirect()->back()->with(Session::flash('success_message', 'Data Berhasil Dihapus'));
    }

    private function uploadImage(Request $request,$name){
        $image = $request->file('gambar');
        $ext = $image->getClientOriginalExtension();

        if($request->file('gambar')->isValid()){
            $upload_path = 'uploaded/tipe_project';
            $imagename = $name.'.'.$ext;
            $request->file('gambar')->move($upload_path,$imagename);
            return $imagename;
        }
        return false;
    }
}
