<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\TipeProjectDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;
use DataTables;
use Session;
use App\TipeProject;
use Image;


class TipeProjectController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function jsonProject(){
        $types = TipeProject::select('tipe_projects.*');

        return DataTables::eloquent($types)

        ->addColumn('aksi', function($type){
            return  '<div style="width: 100% !important; justify-content: center !important; display: flex">' .
                    '<a href="'.url('/admin/tipe-project/edit').'/'. $type->slug .  '" style="padding: 7px 22px;" class="mr-2 float-left btn btn-success text-light">Edit</a>' .
                    '<button style="padding: 7px 15px;" class="btn btn-danger" id="btn-hapus" onclick="deleteDataProject(' . $type->id . ')">Hapus</button>' .
                    '</div>';
        })
        ->addColumn('detail',function ($type){
            $string = '';

            foreach($type->tipe_project_detail as $key=> $value){
                $string.= $key+1 .'. '.$value->bahasa_pemrograman.' ';
            }
            return $string;
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
        return view('admin.pages.tipe-project.list');
    }

    public function create(){

        return view('admin.pages.tipe-project.form');
    }
    public function store(Request $request){

        $this->validate($request, [
            'tipe_project' => 'required',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg'
        ]);

        $input= $request->all();

        $input['slug'] = Str::slug($request->tipe_project,'-');
        $namaFoto = Str::random(16);

        if ($request->hasFile('gambar')) {
            $input['gambar'] = $this->uploadImage($request,$namaFoto);
        }
        $tipe_project = TipeProject::create($input);

        foreach($request->detail as $key => $detail){
            $logoTitle = null;

            if (isset($detail['logo'])){
                $input['logo'] = 1;
                $logoTitle = 'logo' . Carbon::now()->format('Ymd') . '_' . Str::random(20) . '.' . $detail['logo']->getClientOriginalExtension();
                $image = Image::make(File::get($detail['logo']));
                $image->resize(730, 410, function ($constraint) {
                    $constraint->aspectRatio();
                })->save('uploaded/tipe_project/'. $logoTitle);
            }

            $inputDetail = [
                'tipe_project_id' => $tipe_project->id,
                'bahasa_pemrograman' => $detail['bahasa_pemrograman'],
                'logo' => $logoTitle,


            ];
            $status = TipeProjectDetail::create($inputDetail);
        }


        if($status) return redirect(url('admin/tipe-project'))->with(Session::flash('success_message', 'Data Berhasil Ditambahkan'));
    }

    public function edit($slug){

        $type = TipeProject::with('tipe_project_detail')->where('slug', $slug)->first();
        $d = [];

        foreach ($type->tipe_project_detail as $detail) {
            $d[] = [
                'id_project_detail' => $detail->id,
                'bahasa_pemrograman' => $detail->bahasa_pemrograman,
            ];
        }

        $data['detail'] = $d;
        $data['type'] = $type;
        return view('admin.pages.tipe-project.form',$data);
    }

    public function update(Request $request, $slug){

        $type = TipeProject::with('tipe_project_detail')->where('slug', $slug)->first();
        $type->tipe_project = $request->tipe_project;
        $type->slug = Str::slug($request->tipe_project,'-');
        $type->desc = $request->desc;
        $namaFoto = Str::random(16);
        if ($request->hasFile('gambar')) {
            File::delete('uploaded/tipe_project/'.$type->gambar);
            $type->gambar = $this->uploadImage($request,$namaFoto);
        }
        $type->update();

        //Delete Detail Yang Dihapus
        $arrDetail = [];
        foreach($request->detail as $key => $detail){
            if($detail['id_project_detail']) array_push($arrDetail,$detail['id_project_detail']);
        }
        $deleteDetail = TipeProjectDetail::where('tipe_project_id', $type->id)->whereNotIn('id', $arrDetail)->get();
        if($deleteDetail){
            foreach($deleteDetail as $value){
                File::delete('uploaded/tipe_project/'.$value->logo);
                $value->delete();
            }
        }

        //Loop Detail
        foreach($request->detail as $key => $detail){
            //Check data lama atau baru
            if($detail['id_project_detail']){
                $type_detail = TipeProjectDetail::where('id', $detail['id_project_detail'])->first();
                //Check upload image atau tidak
                if (isset($detail['logo'])){
                    File::delete('uploaded/tipe_project/'.$type->tipe_project_detail[$key]->logo);

                    $input['logo'] = 1;
                    $logoTitle = 'logo' . Carbon::now()->format('Ymd') . '_' . Str::random(20) . '.' . $detail['logo']->getClientOriginalExtension();
                    $image = Image::make(File::get($detail['logo']));
                    $image->resize(730, 410, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save('uploaded/tipe_project/'. $logoTitle);
                    $type_detail->logo = $logoTitle;
                }
                $type_detail->bahasa_pemrograman = $detail['bahasa_pemrograman'];
                $type_detail->update();
            }else{
                $logoTitle = null;
                if (isset($detail['logo'])){
                    $input['logo'] = 1;
                    $logoTitle = 'logo' . Carbon::now()->format('Ymd') . '_' . Str::random(20) . '.' . $detail['logo']->getClientOriginalExtension();
                    $image = Image::make(File::get($detail['logo']));
                    $image->resize(730, 410, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save('uploaded/tipe_project/'. $logoTitle);
                }

                $inputDetail = [
                    'tipe_project_id' => $type->id,
                    'bahasa_pemrograman' => $detail['bahasa_pemrograman'],
                    'logo' => $logoTitle,
                ];
                TipeProjectDetail::create($inputDetail);
            }
        }

        return redirect(url('admin/tipe-project'))->with(Session::flash('success_message', 'Data Berhasil Diubah'));
    }




    public function destroy($id)
    {
        $type = TipeProject::where('id', $id)->first();
        File::delete('uploaded/tipe_project/'.$type->gambar);
        $type->delete();

        if($type){
            $detail = TipeProjectDetail::where('tipe_project_id', $id)->get();
            foreach($detail as $value){
                File::delete('uploaded/tipe_project/'.$value->logo);
                $value->delete();
            }
        }

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

    private function uploadImageDetail(Request $request,$name){
        dd($request);
        $image = $request->file('logo');
        $ext = $image->getClientOriginalExtension();

        if($request->file('logo')->isValid()){
            $upload_path = 'uploaded/tipe_project/detail';
            $imagename = $name.'.'.$ext;
            $request->file('logo')->move($upload_path,$imagename);
            return $imagename;
        }
        return false;
    }
}
