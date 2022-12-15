<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\TipeKarir;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;
use DataTables;
use Session;
use App\TipeProject;

class TipeKarirController extends Controller
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
                    '<a href="'.url('/admin/tipe-karir/edit/').'/'. $type->slug .  '" style="padding: 7px 22px;" class="mr-2 float-left btn btn-success text-light">Edit</a>' .
                    '<button style="padding: 7px 15px;" class="btn btn-danger float-left" id="btn-hapus" onclick="deleteDataKarir(' . $type->id . ')">Hapus</button>' .
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
        return view('admin.pages.tipe-karir.list');
    }

    public function create(){

        return view('admin.pages.tipe-karir.form');
    }
    public function store(Request $request){
        $this->validate($request, [
            'tipe_karir.*' => 'required',
        ]);
//        dd($request->tipe_karir);

        $tipekarir = $request->tipe_karir;

        $data = array(
            'tipe_karir' => $tipekarir,
            'slug' => Str::slug($tipekarir,'-'),
        );

        $insert_data[] = $data;


        TipeKarir::insert($insert_data);
        return redirect(url('admin/tipe-karir'))->with(Session::flash('success_message', 'Data Berhasil Ditambahkan'));
    }

    public function edit($slug){
        $data['type'] = TipeKarir::where('slug', $slug)->first();
        return view('admin.pages.tipe-karir.form',$data);
    }

    public function update(Request $request, $slug){
        $type = TipeKarir::where('slug', $slug)->first();
        $type->tipe_karir = $request->tipekarir;
        $type->slug = Str::slug($request->tipekarir,'-');
        $type->update();
        return redirect(url('admin/tipe-karir'))->with(Session::flash('success_message', 'Data Berhasil Diubah'));
    }


    public function destroy($id)
    {
        TipeKarir::where('id', $id)->delete();
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
