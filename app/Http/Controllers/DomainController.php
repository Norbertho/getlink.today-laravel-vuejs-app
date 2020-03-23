<?php

namespace App\Http\Controllers;

use App\domain;
use Storage;
use App\Category;
use App\subcategory;
use File;
use Illuminate\Http\Request;

class DomainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::get();
        $subcategories = subcategory::get();
        return view('domain.create')->with('categories', $categories)->with('subcategories', $subcategories);
    }
    public function paymentsuccess($payment_id){
        $domain = domain::where('payment_id', $payment_id)->first();
        $domain->paid = "1";
        $domain->save();
        return view('paidsuccess');
    }
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'email' => 'required|email',
            'title' =>'required|max:250',
            'url' => 'required|max:250',
            'shortdescription' => 'required',
            'img' => 'sometimes|image|mimes:jpeg,bmp,png,jpg,svg|max:2000',
        ]);
        $domain = new domain();
        $domain->title = $request['title'];
        $domain->email = $request['email'];
        $domain->url = $request['url'];
        $domain->shortdescription = $request['shortdescription'];
        $domain->description = $request['description'];
        $domain->category_id = $request['category_id'];
        $domain->subcategory_id = $request['subcategory_id'];
        $domain->payment_id = uniqid();
        if($request['img']){
        $image = $request['img'];
        $extension = $image->getClientOriginalExtension();
        $name = time() .'_'. $image->getClientOriginalName(); 
        Storage::disk('public')->put($name,  File::get($image));
        $domain->img = $name;
    }else{
        $domain->img = 'default.jpg';
    }
        $domain->save();
        return $domain->payment_id;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\domain  $domain
     * @return \Illuminate\Http\Response
     */
    public function show(domain $domain)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\domain  $domain
     * @return \Illuminate\Http\Response
     */
    public function edit(domain $domain)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\domain  $domain
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, domain $domain)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\domain  $domain
     * @return \Illuminate\Http\Response
     */
    public function destroy(domain $domain)
    {
        //
    }
}
