@extends('layouts.frontend')
@section('content')
    <div class="login-register-area pt-100px pb-100px">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-8 col-lg-5">
                    <div class="login-form-container" style="background:#fff;border-radius:12px;box-shadow:0 8px 24px rgba(0,0,0,0.06);padding:24px;">
                        <h3 class="text-center mb-3">تسجيل الدخول</h3>
                        @if (session('message'))
                            <div class="alert alert-info">{{ session('message') }}</div>
                        @endif
                        <form method="POST" action="{{ route('login') }}" id="custom-login-form">
                            @csrf
                            <div class="mb-3">
                                <label for="email" class="form-label">البريد الإلكتروني</label>
                                <input id="email" type="email" name="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" value="{{ old('email') }}" required autofocus />
                                @if ($errors->has('email'))
                                    <div class="invalid-feedback">{{ $errors->first('email') }}</div>
                                @endif
                            </div>
                            <div class="mb-3 position-relative">
                                <label for="password" class="form-label">كلمة المرور</label>
                                <input id="password" type="password" name="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" required />
                                <button type="button" class="toggle-password" data-target="#password" aria-label="عرض/إخفاء" style="position:absolute;top:36px;{{ app()->getLocale() === 'ar' ? 'left' : 'right' }}:12px;background:transparent;border:none;cursor:pointer;color:#666;">👁️</button>
                                @if ($errors->has('password'))
                                    <div class="invalid-feedback">{{ $errors->first('password') }}</div>
                                @endif
                            </div>
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="remember" name="remember" />
                                    <label class="form-check-label ms-1" for="remember">تذكرني</label>
                                </div>
                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}" class="text-muted" style="font-size: 0.9rem;">نسيت كلمة السر؟</a>
                                @endif
                            </div>
                            <button type="submit" class="btn btn-cta w-100 py-2" style="background:#242424;border:1px solid #242424;color:#fff;">دخول</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    @parent
    <script>
        document.addEventListener('click', function(e){
            var btn = e.target.closest('.toggle-password');
            if(!btn) return;
            var input = document.querySelector(btn.getAttribute('data-target'));
            if(!input) return;
            input.type = input.type === 'password' ? 'text' : 'password';
        });
    </script>
@endsection
