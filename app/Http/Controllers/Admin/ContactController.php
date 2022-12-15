<?php

namespace App\Http\Controllers\Admin;

use App\About;
use App\Contact;
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

class ContactController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $data['about'] = About::where('id',1)->first();
        $data['kontak'] = Contact::where('id',1)->first();
        return view('admin.pages.contact.list',$data);
    }

    public function update(Request $request){

//        dd($request->all());
        $this->validate($request, [
            'alamat_link' => 'required',
            'alamat' => 'required',
            'email' => 'required',
            'telepon' => 'required',
            'instagram' => 'required',
            'linkedin' => 'required'
        ]);

        $kontak = Contact::where('id',1)->first();
        $kontak->alamat_link = $request->alamat_link;
        $kontak->alamat = $request->alamat;
        $kontak->email = $request->email;
        $kontak->telepon = $request->telepon;
        $kontak->instagram = $request->instagram;
        $kontak->linkedin = $request->linkedin;

        $kontak->save();

        $data['kontak'] = $kontak;
        return view('admin.pages.contact.list',$data)->with(Session::flash('success_message', 'Data Berhasil DiUbah'));
//        return view('admin.pages.contact.list',$data);

    }
}
