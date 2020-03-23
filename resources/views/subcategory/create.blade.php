@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card p-4">
                <form action="{{route('subcategory.store')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Select category</label>
                        <select class="form-control" id="exampleFormControlSelect1" name="category_id">
                        @foreach ($categories as $category)
                        <option value="{{$category->id}}">{{$category->categoryname}}</option>
                          @endforeach
                        </select>
                      </div>

                    <div class="form-group">
                        <label for="category">Enter a Subcategory</label>
                        <input type="text" class="form-control" id="subcategory" name="subcategory">
                        @error('subcategory')
                        <div class="error text-danger">{{ $message }}</div>
                        @enderror
                      </div>
                      <div class="d-flex align-items-center justify-content-between">
                        <button type="submit" class="btn btn-primary">Submit</button> <a class="btn btn-warning" href="/home">Back</a>
                      </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection