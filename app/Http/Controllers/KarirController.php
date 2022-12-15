<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;
use App\Applicant;
use App\Carrer;
use Carbon\Carbon;
use Session;
use File;

class KarirController extends Controller
{
    public function index(){
        $carrers = Carrer::with('tipekarir')->get();
        return view('pages.karir', compact(['carrers']));
    }

    public function detail($slug){
        $karir = Carrer::where('slug', $slug)->first();
        $carrers = Carrer::with('tipekarir')
                            ->whereNotIn('slug',[$slug])
                            ->get();
        $relate = $carrers->shuffle()->slice(0,3);
        if(Session::has('msg'))
        {
            Alert::success('Berhasil', session('msg'));
            Session::forget('msg');
        }
        return view('pages.detail-karir', compact(['karir','relate']));
    }

    public function store(Request $request)
    {
        $messages = [
            'required' => ':attribute wajib diisi',
            'min' => ':attribute harus diisi minimal :min karakter',
            'max' => ':attribute harus diisi maksimal :max karakter',
            'email' => ':attribute memerlukan "@"'
        ];

        $this->validate($request, [
            'attachment' => 'bail|required|image|mimes:jpeg,png,jpg,gif,svg',
            'desc' => 'required',
            'email' => 'bail|required|email',
            'telp' => 'required',
            'namadepan' => 'required',
            'namabelakang' => 'required',
        ], $messages);

        $path = "uploaded/applicant";
        if(!File::isDirectory($path)){
            File::makeDirectory($path, 0777, true, true);
        }

		$attachment = $request->file('attachment');
        $namaattachment = ucfirst(trans($request->namadepan . $request->namabelakang)) . 'Attachment' . Carbon::now()->format('Ymd') . '.' . $attachment->getClientOriginalExtension();
        $targetdir = 'uploaded/applicant';
		$attachment->move($targetdir, $namaattachment);

        $applicant = new Applicant;
        $applicant->carrers_id = $request->karir_id;
        $applicant->first_name = $request->namadepan;
        $applicant->last_name = $request->namabelakang;
        $applicant->telp = $request->telp;
        $applicant->email = $request->email;
        $applicant->desc = $request->desc;
        $applicant->attachment = $namaattachment;
        $applicant->save();

        return redirect()->back()->with(Session::flash('msg', 'Lamaran Berhasil Dikirim'));
    }
}
