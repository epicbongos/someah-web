<?php

namespace App\Http\Controllers\Admin;

use App\About;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;
use DataTables;
use Carbon\Carbon;
use App\Client;
use Session;
use Image;
use File;

class AboutController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $data['about'] = About::where('id',1)->first();
        return view('admin.pages.about.list',$data);
    }

    public function update(Request $request){
        $this->validate($request, [
            'visi' => 'required',
            'misi.*' => 'image|mimes:jpeg,png,jpg,gif,svg',
            'tentang_kami' => 'required'
        ]);

        $about = About::where('id',1)->first();
        $about->tentang_kami = $request->tentang_kami;
        $about->visi = $request->visi;
        $about->misi = $request->misi;

        $about->save();

        $data['about'] = $about;
//        return url('admin.pages.about.list',$data)->with(Session::flash('success_message', 'Data Berhasil DiUbah'));
        return view('admin.pages.about.list',$data);

    }
}
