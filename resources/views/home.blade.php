@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between"><span class="inline-block">Dashboard</span> <form class="inline-block" method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit">Logout</button>
                  </form></div>
           
                <div class="card-body d-flex flex-column ">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
<div class=" d-flex align-items-between">
    <a class="btn btn-success w-50 m-1" href="{{route('category.create')}}">Add new Category</a>  <a class="btn btn-success w-50 m-1" href="{{route('category.index')}}">Show Categories</a>
</div>
<div class=" d-flex align-items-between">
    <a class="btn btn-success w-50 m-1" href="{{route('subcategory.create')}}">Add new SubCategory</a>  <a class="btn btn-success w-50 m-1" href="{{route('subcategory.index')}}">Show SubCategories</a>
</div>
                    
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between"><span class="inline-block">Added Domains</span></div>
           
                <div class="card-body d-flex flex-column ">
                    @foreach ($domains as $domain)
                <li class="{{$domain->paid == '1' ? 'text-success' : 'text-danger'}}">
                            {{$domain->title}}
                        </li>
                    @endforeach
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
