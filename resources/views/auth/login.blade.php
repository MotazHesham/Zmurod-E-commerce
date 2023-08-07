<!DOCTYPE html>
<!-- Created by CodingLab |www.youtube.com/c/CodingLabYT-->
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8" />
    <!--<title> Login and Registration Form in HTML & CSS | CodingLab </title>-->
    <link rel="stylesheet" href="{{ asset('login/style.css') }}" />
    <!-- Fontawesome CDN Link -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ trans('panel.site_title') }}</title>
    <style>
        .is-invalid{
            border-color: red !important;
        }
    </style>
</head>

<body>
    <div class="container">
        <input type="checkbox" id="flip" />
        <div class="cover">
            <div class="front">
                <img src="{{ asset('login/images/2.jpg') }}" alt="" />
                <div class="text">
                    <span class="text-1">SignIn <br /> </span>
                    <span class="text-2">Let's get connected</span>
                </div>
            </div>
        </div>
        <div class="forms">
            <div class="form-content">
                <div class="login-form">
                    <div class="title">Login</div>
                    @if (session('message'))
                        <div class="alert alert-info" role="alert" style="color: crimson;">
                            {{ session('message') }}
                        </div>
                    @endif
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="input-boxes">
                            <div class="input-box">
                                <i class="fas fa-envelope"></i>
                                <input class="{{ $errors->has('email') ? ' is-invalid' : '' }}" type="email" name="email" placeholder="Enter your email" autocomplete="email" required  autofocus value="{{ old('email') }}"/>
                                
                            </div>
                            @if ($errors->has('email'))
                                <div class="invalid-feedback" style="color:red">
                                    {{ $errors->first('email') }}
                                </div>
                            @endif
                            <div class="input-box">
                                <i class="fas fa-lock"></i>
                                <input type="password" class="{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Enter your password" required />
                                
                            </div>
                            @if ($errors->has('password'))
                                <div class="invalid-feedback" style="color:red">
                                    {{ $errors->first('password') }}
                                </div>
                            @endif
                            <div class="input-group mb-3 mt-3">
                                <div class="form-check checkbox">
                                    <input class="form-check-input" name="remember" type="checkbox" id="remember"
                                        style="vertical-align: middle;" />
                                    <label class="form-check-label" for="remember" style="vertical-align: middle;">
                                        Remember Me
                                    </label>
                                </div>
                            </div>
                            @if(Route::has('password.request'))
                                {{-- <div class="text"><a href="{{ route('password.request') }}">Forgot password?</a></div> --}}
                            @endif 
                            <div class="button input-box">
                                <input type="submit" value="Sumbit" />
                            </div> 
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html> 