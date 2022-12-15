<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use RealRashid\SweetAlert\Facades\Alert;
use App\Portfolio;
use App\Client;
use DataTables;
use Session;
use File;

class HomeController extends Controller
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
        $clients = Client::all();
        $portfolios = Portfolio::all();
        return view('admin.index', [ 'clients' => $clients,
                                     'portfolios' => $portfolios 
                                   ]);
    }

    public function jsonKlien(){
        $clients = Client::select('clients.*');

        return DataTables::eloquent($clients)
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
        ->addColumn('gambar_logo', function($client){
            return '<img width="70px !important;" src="' . asset("uploaded/client/$client->logo").'" alt="">';
        })
        ->rawColumns(['status','gambar_logo','mini_logo'])
        ->toJson();
    }

    public function jsonPortfolio(){
        $portfolios = Portfolio::select('portfolios.*');
        
        return DataTables::eloquent($portfolios)
        ->addColumn('status', function($portfolio){
            $show = '';

            if($portfolio->status == 1)
            {
                $show = 'checked';
            } else {
                $show = '';
            }
            return  '<label class="switch mt-2">' .
                        '<input type="checkbox" id="change_status_portfolio" name="status"' . $show . ' value="1" data-id="' . $portfolio->id .'">' .
                        '<span class="slider round"></span>' .
                    '</label>' ;
        })
        ->addColumn('gambar', function($portfolio){
            foreach($portfolio->product_img as $img)
            {
                return '<img width="70px !important;" src="' . asset("uploaded/portfolio/$img").'" alt="">';
            }
        })
        ->addColumn('mini_logo', function($portfolio){
            $mini_img = $portfolio->client->mini_logo;

            return '<img width="70px !important;" src="' . asset("uploaded/client/$mini_img ").'" alt="">';
        })
        ->addColumn('deskripsi', function($portfolio){
            $template = '';
            $template .= substr($portfolio->desc,0,95);
            if(strlen($portfolio->desc) >= 95){
                $template .= '. . . .';
            }
            return $template;
        })
        ->rawColumns(['status', 'gambar','mini_logo','deskripsi'])
        ->toJson();
    }

    public function updateClient(Request $request, $id)
    {
        $client = Client::where('id', $id)->first();
        $client->update(['status'=>$request->status]);
    }

    public function updatePortfolio(Request $request, $id)
    {
        $portfolio = Portfolio::where('id', $id)->first();
        $portfolio->update(['status'=>$request->status]);
    }

}