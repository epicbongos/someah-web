<?php

namespace App\Http\Controllers;

use App\About;
use Illuminate\Http\Request;
use App\Team;

class TentangController extends Controller
{
    public function index()
    {
        $data['teams'] = Team::all();
        $data['about'] = About::where('id',1)->first();


        return view('pages.tentangkami',$data);
    }
}
