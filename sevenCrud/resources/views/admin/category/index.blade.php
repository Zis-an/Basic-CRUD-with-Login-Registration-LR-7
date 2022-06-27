@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">All Category
                </div>

                <div class="card-body">
                    @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>{{ session('success') }}</strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                    {{-- @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif 

                    {{ __('You are logged in!') }} --}}

                    <table class="table table-striped">
                        <thead style="text-align: center;">
                            <tr>
                                <th scope="col">SL No.</th>
                                <th scope="col">Name</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Created At</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            {{-- When using pagination, serial number has to come from DB --}}
                            {{-- @php($i = 1) --}}
                            @foreach ($categories as $category)
                            <tr style="text-align: center;">
                                {{-- <th scope="row">{{ $i++ }}</th> --}}
                                <th scope="row">{{$categories->firstItem()+$loop->index}}</th>
                                <td>{{$category ->category_name}}</td>
                                <td>{{$category->user_id }}</td>
                                <td>
                                    @if ($category->created_at == NULL)
                                    <span class="text-danger">No Time was set.</span>
                                    @else
                                   {{-- {{  Carbon\Carbon::parse($category->created_at)->diffForHumans()}}     --}}
                                   {{-- When using Eloquent ORM --}}
                                   {{$category->created_at->diffForHumans()}}
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ url('category/edit').'/'.$category->id }}" class="btn btn-primary">Edit</a>
                                     <a href="{{ url('category/delete/'.$category->id) }}" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{$categories->links()}}
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Add Category</div>
                <div class="card-body">
                    {{-- @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif 

                    {{ __('You are logged in!') }} --}}
                    <form action="{{ route('add.category') }} " method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Add Category</label>
                            <input type="text" name="category_name" class="form-control 
                            @error('category_name') is invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Category">
                            @error('category_name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <br>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Trash List
                </div>

                <div class="card-body">
                    {{-- @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif 

                    {{ __('You are logged in!') }} --}}

                    <table class="table table-striped">
                        <thead style="text-align: center;">
                            <tr>
                                <th scope="col">SL No.</th>
                                <th scope="col">Name</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Created At</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            {{-- When using pagination, serial number has to come from DB --}}
                            {{-- @php($i = 1) --}}
                            {{-- @foreach ($categories as $category)  without Delete Functionality --}}
                            @foreach ($trashCategory as $category)
                            <tr style="text-align: center;">
                                {{-- <th scope="row">{{ $i++ }}</th> --}}
                                <th scope="row">{{$trashCategory->firstItem()+$loop->index}}</th>
                                <td>{{$category ->category_name}}</td>
                                <td>{{$category->user_id }}</td>
                                <td>
                                    @if ($category->created_at == NULL)
                                    <span class="text-danger">No Time was set.</span>
                                    @else
                                   {{-- {{  Carbon\Carbon::parse($category->created_at)->diffForHumans()}}     --}}
                                   {{-- When using Eloquent ORM --}}
                                   {{$category->created_at->diffForHumans()}}
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ url('category/restore').'/'.$category->id }}" class="btn btn-primary">Restore</a>
                                    <a href="{{ url('delete/category').'/'.$category->id }}" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{$trashCategory->links()}}
                </div>
            </div>
        </div>

        <div class="col-md-4"></div>
    </div>
</div>
@endsection
