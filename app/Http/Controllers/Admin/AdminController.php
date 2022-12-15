<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;
use DataTables;
use Carbon\Carbon;
use App\Client;
use Session;
use Image;
use File;

class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }




    public function index()
    {
        $data['user'] = User::all();
        if(session('success_message'))
        {
            Alert::success('Berhasil', session('success_message'));
        }
        return view('admin.pages.admin.list', $data);
    }

    public function json(){
//        $clients = Client::select('clients.*');

        $users = User::select('users.*');
//        dd($users);

        return DataTables::eloquent($users)
            ->addColumn('aksi', function($users){
                return  '<div style="width: 100% !important; justify-content: center !important; display: flex; align-items: center;">' .
                    '<a href="' . url("/admin/admin/edit/$users->id") .'" style="padding: 7px; width:40%;" class="mr-2 float-left btn btn-success text-light">Edit</a>' .
                    '<button style="padding: 7px; width: 40%;" class="btn btn-danger float-left" id="btn-hapus" onclick="deleteData(' . $users->id . ')">Hapus</button>' .
                    '</div>';
            })
            ->rawColumns(['aksi'])
            ->toJson();
    }

    public function create()
    {
        return view('admin.pages.admin.form');
    }

    public function store(Request $request)
    {
//        dd($request->all());
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required'
        ]);

        $input['name'] = $request->name;
        $input['email'] = $request->email;
        $input['role'] = $request->role;
        $input['password'] = Hash::make($request->password);

        $status = User::create($input);
        if($status){
            return redirect('/admin/admin')->with(Session::flash('success_message', 'Data Berhasil Ditambahkan'));
        }
    }

    public function edit($id){
        $data['admin'] = User::find($id);
        return view('admin.pages.admin.form',$data);

    }

    public function update(Request $request, $id)
    {
//        dd($request->all());
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required'
        ]);

        $admin = User::find($id);
        $admin->name = $request->name;
        $admin->role = $request->role;
        $admin->email = $request->email;
        if($request->password){
            $admin->password = Hash::make($request->password);
        }

        $status = $admin->save();
        if($status){
            return redirect('/admin/admin')->with(Session::flash('success_message', 'Data Berhasil Diubah'));
        }
        return redirect('/admin/client')->withSuccessMessage('Client Diperbaharui');
    }

    public function destroy($id)
    {
        $admin = User::find( $id);
        $admin->delete();

        return redirect()->back()->withSuccessMessage('Client Dihapus');
    }
}
