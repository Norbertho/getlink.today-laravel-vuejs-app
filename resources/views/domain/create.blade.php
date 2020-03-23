@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row py-5">
            <div class="w-100">
                    <h3 class="text-center">Add your Domain to our website and get backlink!</h3>
            </div>
        </div>
    <domainregister-component :categories="{{$categories}}" :subcategories="{{$subcategories}}"></domainregister-component>
    </div>
@endsection