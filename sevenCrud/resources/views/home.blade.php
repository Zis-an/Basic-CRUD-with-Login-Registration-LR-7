@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{-- {{ __('Dashboard') }} --}}
                    <b>Welcome</b> {{ Auth::user()->name }}
                    <p class="badge badge-success" style="margin-left: 10px;">Active Now</p>
                <b style="float:right;">Total Users <span class="badge badge-danger">{{ count($users) }}</span></b>
                </div>

                <div class="card-body">
                    {{-- @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif 

                    {{ __('You are logged in!') }} --}}

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">SL No.</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Created At</th>
                            </tr>
                        </thead>

                        <tbody>
                            @php($i = 1)
                            @foreach ($users as $user)
                            <tr>
                                <th scope="row">{{ $i++ }}</th>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ Carbon\Carbon::parse($user->created_at)->diffForHumans()}}</td>
                            </tr>
                        @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
