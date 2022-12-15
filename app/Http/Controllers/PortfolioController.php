<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Portfolio;

class PortfolioController extends Controller
{
    public function index()
    {
        $portfolio = Portfolio::with('tipeprojects')->get();
        return view('pages.portofolio', compact(['portfolio']));
    }

    public function detail($slug)
    {
        $port = Portfolio::with('tipeprojects')->where('slug', $slug)->first();
        return view('pages.detail-portofolio', compact(['port']));
    }
}