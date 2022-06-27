@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Edit Category
                </div>
                <div class="card-body">
                    <form action="{{ url('store/category').'/'.$categories->id }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputemail1">
                                Update Category
                            </label>
                            <input type="text" name="category_name" class="form-control @error ('category_name') is invalid @enderror" id="exampleInputemail1" aria-describedby="emailHelp" value="{{$categories->category_name}}">
                            @error('category_name')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                            <button type="submit" class="btn btn-primary">Add</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
