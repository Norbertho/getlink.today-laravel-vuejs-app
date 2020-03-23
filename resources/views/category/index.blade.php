@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
            <div class="card-header d-flex justify-content-between"><div>Categories</div>   <div><a class="btn btn-info" href="{{route('home')}}">Back</a></div> </div>

                <div class="card-body">
                   @foreach ($categories as $category)
                <p><strong>Categoryname:</strong> {{$category->categoryname}}</p> 
                <ul>
                    @foreach ($category->subcategories as $subcategory)
                <li>{{$subcategory->subcategoryname}}</li>
                    
                    @endforeach 
                </ul>
  
                   @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection