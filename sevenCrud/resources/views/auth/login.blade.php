@extends('layouts.app')

<script src="{{ URL::asset('js/main.js') }}"></script>
<script src="https://kit.fontawesome.com/88ba240026.js" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6 position-relative" id="icon">
                                
                                <input id="myInput" type="password" class="form-control @error('password') is-invalid @enderror" name="password"  required autocomplete="current-password">


                                <i id="yess" class="fas fa-eye position-absolute" onclick="myFunction()" style="top:37%; right:20px; margin-right:10px; cursor:pointer;"></i>



                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" style="cursor: pointer;" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<script>
    function myFunction() {
        var e = document.getElementById("myInput");
        // var c = document.getElementByClassName("fas fa-eye position-absolute");
        if (e.type === "password") {
            e.type = "text";
            $("#yess").attr('class', 'fas fa-eye-slash position-absolute');
            // e.toggleClass = "fas fa-eye-slash position-absolute";
        } else {
            e.type = "password";
             $("#yess").attr('class', 'fas fa-eye position-absolute');
            // e.toggleClass = "";
        }
    }
</script>
