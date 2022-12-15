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

class KarirController extends Controller
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
        return view('admin.pages.careers.view-carrer');
    }

    public function jsonCarrer(){
        $carrers = Carrer::select('carrers.*');
        return DataTables::eloquent($carrers)
        ->addColumn('aksi', function($carrer){
            return  '<div style="width: 100% !important; justify-content: center !important; display: flex">' .
                    '<a href="' . url("/admin/karir/update-karir/$carrer->slug") .'" style="padding: 7px 22px;" class="mr-2 float-left btn btn-success text-light">Edit</a>' .
                    '<button style="padding: 7px 15px;" class="btn btn-danger" id="btn-hapus" onclick="deleteKarir(' . $carrer->id . ')">Hapus</button>' .
                    '</div>';
        })
        ->addColumn('type', function($carrer){
                $template = '';
                foreach($carrer->tipekarir as $cat)
                {
                    $template .= $cat->tipe_karir . ', ';
                }

                return $template;
            })
            ->addColumn('desc', function($carrer){
                $template = '';
                $template .= substr($carrer->desc,0,70);
                if(strlen($carrer->desc) >= 70){
                    $template .= '. . . .';
                }
                return $template;
            })
        ->rawColumns(['desc','aksi','type'])
        ->toJson();
    }


    public function destroyApplicant($id)
    {
        Applicant::where('id', $id)->delete();
        return redirect()->back()->with(Session::flash('success_message', 'Data Berhasil Dihapus'));
    }

    public function destroyKarir($id)
    {
        $karir = Carrer::find($id);
        $karir->delete();
        $karir->tipekarir()->detach();
        return redirect()->back()->with(Session::flash('success_message', 'Data Berhasil Dihapus'));
    }

    public function showInsert()
    {
        $tipekarir = TipeKarir::all();
        return view('admin.pages.careers.view-insert-career', compact(['tipekarir']))->with('status','insert');
    }

    public function showUpdate($slug)
    {
//        dd($slug);
        $carrer = Carrer::with('tipekarir')
                            ->where('slug', $slug)
                            ->first();

        foreach($carrer->tipekarir as $tk)
        {
            $categories[] = $tk->id;
        }
        $tipekarir = TipeKarir::all();
        return view('admin.pages.careers.view-insert-career', compact(['carrer','tipekarir','categories']))->with('status','update');
    }

    public function store(request $request)
    {
        $this->validate($request, [
            'job_position' => 'required',
            'desc' => 'required',
            'categories' => 'required'
        ]);

        $karir = Carrer::create([
            'job_position' => $request->job_position,
            'desc' => $request->desc,
            'slug' => Str::slug($request->job_position,'-'),
        ]);

        $tipekarir = TipeKarir::find($request->categories);

        $karir->tipekarir()->attach($tipekarir);

        return redirect('/admin/karir')->with(Session::flash('success_message', 'Data Berhasil Ditambahkan'));
    }

    public function update(request $request, $slug)
    {
        $karir = Carrer::where('slug', $slug)->first();
        $karir->job_position = $request->job_position;
        $karir->desc = $request->desc;
        $karir->slug = Str::slug($request->job_position,'-');
        $karir->update();

        $tipekarir = TipeKarir::find($request->categories);
        $karir->tipekarir()->sync($tipekarir);

        return redirect('/admin/karir')->with(Session::flash('success_message', 'Data Berhasil Diperbaharui'));
    }


}
