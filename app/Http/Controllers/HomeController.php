<?php

namespace App\Http\Controllers;
use App\domain;
use App\Category;
use App\subcategory;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $domains = domain::get();
        return view('home')->with('domains', $domains);
    }
}
