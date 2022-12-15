<?php

namespace App\Http\Controllers;

use App\Contact;
use Illuminate\Http\Request;
use App\Client;
use App\Portfolio;

class HomeController extends Controller
{
    public function index()
    {
        $clients = Client::all();
        $clientsNotShow = Client::where('status', '0')->get();
        $portfolio = Portfolio::where('status', '1')->get();
        $kontak = Contact::find(1);
        return view('welcome', compact(['clients', 'clientsNotShow', 'portfolio', 'kontak']));
    }
}