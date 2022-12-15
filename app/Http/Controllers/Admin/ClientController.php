<?php

namespace App\Http\Controllers\Admin;

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

class ClientController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function detail($slug)
    {
        $klien = Client::where('slug',$slug)->first();
        return view('pages.detail-klien', compact(['klien']));
    }

    public function json(){
        $clients = Client::select('clients.*');
//        $clients = Client::all();

        return DataTables::eloquent($clients)
        ->addColumn('aksi', function($client){
            return  '<div style="width: 100% !important; justify-content: center !important; display: flex; align-items: center;">' .
                    '<a href="' . url("/admin/client/update-client/$client->slug") .'" style="padding: 7px; width:40%;" class="mr-2 float-left btn btn-success text-light">Edit</a>' .
                    '<button style="padding: 7px; width: 40%;" class="btn btn-danger float-left" id="btn-hapus" onclick="deleteData(' . $client->id . ')">Hapus</button>' .
                    '</div>';
        })
        ->addColumn('gambar_logo', function($client){
            return '<img width="115px !important;" src="' . asset("uploaded/client/$client->logo").'" alt="">';
        })
        ->addColumn('gambar_mini_logo', function($client){
            return '<img width="115px !important;" src="' . asset("uploaded/client/$client->mini_logo").'" alt="">';
        })
        ->addColumn('deskripsi', function($client){
            $template = '';
            $template .= substr($client->desc,0,50);
            if(strlen($client->desc) >= 50){
                $template .= '. . . .';
            }

            return $template;
        })
            ->addColumn('status', function($client){
                $show = '';

                if($client->status == 1)
                {
                    $show = 'checked';
                } else {
                    $show = '';
                }

                return  '<label class="switch mt-2">' .
                    '<input type="checkbox" id="change_status_client" name="status"' . $show . ' value="1" data-id="' . $client->id .'">' .
                    '<span class="slider round"></span>' .
                    '</label>' ;
            })
        ->rawColumns(['aksi','gambar_logo','status','gambar_mini_logo'])
        ->toJson();
    }

    public function index()
    {
        $clients = Client::all();
        if(session('success_message'))
        {
            Alert::success('Berhasil', session('success_message'));
        }
        return view('admin.pages.clients.view-client', ['clients' => $clients]);
    }

    public function showInsert()
    {
        return view('admin.pages.clients.view-insert-clients')->with('status','insert');
    }

    public function showUpdate($slug)
    {
        $client = Client::where('slug', $slug)->first();
        return view('admin.pages.clients.view-insert-clients', compact(['client']))->with('status','update');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'logo' => 'required',
            'logo.*' => 'image|mimes:jpeg,png,jpg,gif,svg',
            'mini_logo' => 'required',
            'mini_logo.*' => 'image|mimes:jpeg,png,jpg,gif,svg',
            'company_name.*' => 'required',
            'desc.*' => 'required',
            'website.*' => 'required',
        ]);

        $logo = $request->file('logo');
        $mini_logo = $request->file('mini_logo');
        $company_name = $request->company_name;
        $desc = $request->desc;
        $website = $request->website;

        for($count = 0; $count < count($logo); $count++)
        {
            $path = "uploaded/client";
            if(!File::isDirectory($path)){
                File::makeDirectory($path, 0777, true, true);
            }
            $namaLogo[$count] = 'logo' . Carbon::now()->format('Ymd') . ' at ' . Carbon::now()->format('His') . Str::random(20) . '.' . $logo[$count]->getClientOriginalExtension();
            Image::make(File::get($logo[$count]))->resize(206, 77, function ($constraint) {
                $constraint->aspectRatio();
            })->save('uploaded/client/'. $namaLogo[$count]);

            $namaMiniLogo[$count] = 'mini_logo' . Carbon::now()->format('Ymd') . ' at ' . Carbon::now()->format('His') . Str::random(20) . '.' . $mini_logo[$count]->getClientOriginalExtension();
            Image::make(File::get($mini_logo[$count]))->resize(206, 77, function ($constraint) {
                $constraint->aspectRatio();
            })->save('uploaded/client/'. $namaMiniLogo[$count]);

            $data = array(
                'logo' => $namaLogo[$count],
                'mini_logo' => $namaMiniLogo[$count],
                'company_name' => $company_name[$count],
                'desc' => $desc[$count],
                'website' => $website[$count],
                'slug' => Str::slug($company_name[$count],'-'),
            );
            // ini command
            $insert_data[] = $data;
        }

        Client::insert($insert_data);

        return redirect('/admin/client')->with(Session::flash('success_message', 'Data Berhasil Ditambahkan'));
    }

    public function update(Request $request, $slug)
    {
        $client = Client::where('slug', $slug)->first();
        $client->company_name = $request->company_name;
        $client->desc = $request->desc;
        $client->website = $request->website;
        if($request->hasfile('logo')){
            $imageLogo = public_path("uploaded/client/" . $client->logo);
            \File::delete($imageLogo);
            $logo = $request->file('logo');
            $namaLogo = 'CLogo' . Carbon::now()->format('Ymd') . ' at ' . Carbon::now()->format('His') .  '.' . $logo->getClientOriginalExtension();
            Image::make(File::get($logo))->resize(206, 77, function ($constraint) {
                $constraint->aspectRatio();
            })->save('uploaded/client/'. $namaLogo);
            $client->logo = $namaLogo;
        }

        if($request->hasfile('mini_logo')){
            $imageMiniLogo = public_path("uploaded/client/" . $client->mini_logo);
            \File::delete($imageMiniLogo);
            $miniLogo = $request->file('mini_logo');
            $namaMiniLogo = 'CMLogo' . Carbon::now()->format('Ymd') . ' at ' . Carbon::now()->format('His') .  '.' . $miniLogo->getClientOriginalExtension();
            Image::make(File::get($miniLogo))->resize(206, 77, function ($constraint) {
                $constraint->aspectRatio();
            })->save('uploaded/client/'. $namaMiniLogo);
            $client->mini_logo = $namaMiniLogo;
        }
        $client->update();

        return redirect('/admin/client')->withSuccessMessage('Client Diperbaharui');
    }

    public function destroy($id)
    {
        $client = Client::where('id', $id)->first();
        $logo = public_path("uploaded/client/" . $client->logo);
        if(\File::exists($logo)){
            \File::delete($logo);
        }
        $minilogo = public_path("uploaded/client/" . $client->mini_logo);
        if(\File::exists($minilogo)){
            \File::delete($minilogo);
        }
        $client->delete();

        return redirect()->back()->withSuccessMessage('Client Dihapus');
    }
}
