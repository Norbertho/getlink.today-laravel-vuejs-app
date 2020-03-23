@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card p-4">
                <form action="{{route('category.store')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="category">Enter a category</label>
                        <input type="text" class="form-control" id="category" name="category">
                            @error('category')
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