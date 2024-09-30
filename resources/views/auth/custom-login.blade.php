@extends('layouts.frontend')
@section('content')

 <!-- breadcrumb-area start -->
 <div class="breadcrumb-area">
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-12 text-center">
                <h2 class="breadcrumb-title">تسجيل دخول  </h2>
                <!-- breadcrumb-list start -->
                <ul class="breadcrumb-list">
                    <li class="breadcrumb-item"><a href="{{route('frontend.home')}}">الرئيسية</a></li>
                    <li class="breadcrumb-item active">دخول</li>
                </ul>
                <!-- breadcrumb-list end -->
            </div>
        </div>
    </div>
</div>
<!-- breadcrumb-area end -->


<!-- login area start -->
<div class="login-register-area pt-100px pb-100px">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 col-md-12 ml-auto mr-auto">
                <div class="login-register-wrapper">
                    <div class="login-register-tab-list-login nav">
                            <div class="login-form-container">
                            <div class="login-register-form">
                                <a class="active" data-bs-toggle="tab" href="#lg1">
                                    <h4 class="text-center">دخول</h4>
                                </a>
                                <br>
                                @if($errors->count() > 0)
                                    <div class="alert alert-danger">
                                        <ul class="list-unstyled">
                                            @foreach($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <input type="email" name="email" value="{{ old('email') }}" placeholder="البريد الألكتروني" required autofocus autocomplete="email"/>
                                        @if($errors->has('email'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('email') }}
                                            </div>
                                        @endif
                                    <input type="password" name="password" placeholder="كلمة المرور" required/>
                                    @if($errors->has('password'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('password') }}
                                        </div>
                                    @endif
                                    <div class="button-box">
                                        <div class="login-toggle-btn">
                                            {{-- <input type="checkbox" name="remember"/>
                                            <a class="flote-none" href="javascript:void(0)">تذكرني</a> --}}
                                            <a href="{{route('password.request')}}">نسيت كلمة المرور</a>
                                        </div>
                                        <button type="submit" style="margin-top: 20px"><span>دخول</span></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- login area end -->


@endsection
