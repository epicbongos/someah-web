<?php

namespace App\Http\Controllers;

use App\PortfolioTipe;
use App\TipeProject;
use Illuminate\Http\Request;
use App\Portfolio;

class LayananController extends Controller
{
    public function index()
    {
        $data['layanan'] = TipeProject::all();
        return view('pages.layanan',$data);
    }

    public function detail($slug)
    {
        $data['tipe'] = TipeProject::with('tipe_project_detail')->where('slug',$slug)->first();
        $data['port'] = PortfolioTipe::with('portofolio')->where('tipe_project_id', $data['tipe']->id)->inRandomOrder()->limit(3)->get();

        return view('pages.detail-layanan', $data);
    }
}
