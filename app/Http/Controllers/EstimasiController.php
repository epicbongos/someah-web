<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;
use App\TipeProject;
use App\TipeLingkup;
use App\Estimasi;
use Session;
use File;

class EstimasiController extends Controller
{
    public function index()
    {
        if(Session::has('msg'))
        {
            Alert::success('Berhasil', session('msg'));
            Session::forget('msg');
        }
        return view('pages.estimasi-projek');
    }

    public function store(Request $request)
    {   
        $messages = [
            'required' => ':attribute wajib diisi',
            'min' => ':attribute harus diisi minimal :min karakter',
            'max' => ':attribute harus diisi maksimal :max karakter',
            'email' => ':attribute memerlukan "@"'
        ];

        $this->validate($request,[
            'nama' => 'bail|required|string',
            'email' => 'bail|required|email',
            'perusahaan' => 'required|string',
            'nama_seluler' => 'required|string',
            'bidang_perusahaan' => 'required|string',
            'asal_perusahaan' => 'required|string',
            'ide_anda' => 'required|string',
            'tipeproject' => 'required',
            'tipelingkup' => 'required',
        ], $messages);

        $idproject = $request->tipeproject;
        $idlingkup = $request->tipelingkup;

        $tipe_lingkup = TipeLingkup::findOrfail($idlingkup);
        $tipe_lingkup->estimasi()->create([
            'nama' => $request->nama,
            'email' => $request->email,
            'perusahaan' => $request->perusahaan,
            'nama_seluler' => $request->nama_seluler,
            'bidang_perusahaan' => $request->bidang_perusahaan,
            'asal_perusahaan' => $request->asal_perusahaan,
            'ide_anda' => $request->ide_anda,
        ])->tipeproject()->attach(TipeProject::find($idproject));

        return redirect('/estimasi-project')->with(Session::flash('msg', 'Estimasi Project Berhasil Dikirim'));
    }
}