@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between"><div>Subcategories</div>   <div><a class="btn btn-info" href="{{route('home')}}">Back</a></div> </div>
                <div class="card-body">
                   @foreach ($subcategories as $subcategory)
                <p><strong>Subcategory name:</strong> {{$subcategory->subcategoryname}} || Category: {{$subcategory->category->categoryname}}</p>    
                   @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection