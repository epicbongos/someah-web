<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client;
use App\Portfolio;

class KlienController extends Controller
{
    public function index()
    {
        $clients = Client::all();
        return view('pages.klien', compact(['clients']));
    }

    public function detail($slug)
    {
        $client = Client::where('slug', $slug)->first();

        $portfolio = Portfolio::where('client_id',$client->id)->get();
        return view('pages.detail-klien', compact(['client','portfolio']));
    }
}
