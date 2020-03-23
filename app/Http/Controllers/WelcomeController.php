<?php

namespace App\Http\Controllers;
use App\domain;
use App\Category;
use App\subcategory;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
 public function index()
 {
    $domains = domain::where('paid', '1')->get();
    $categories = Category::get();
    $subcategories = subcategory::get();

    return view('welcome')->with('domains', $domains)->with('subcategories', $subcategories)->with('categories', $categories);
 }
}
