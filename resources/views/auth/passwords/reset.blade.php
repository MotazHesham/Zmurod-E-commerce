@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card mx-4">
            <div class="card-body p-4">
                <h1>{{ trans('panel.site_title') }}</h1>
                <p class="text-muted">{{ trans('global.reset_password') }}</p>

                <form method="POST" action="{{ route('password.update') }}">
                    @csrf

                    <!-- Hidden token field -->
                    <input name="token" value="{{ $token }}" type="hidden">

                    <!-- Email field -->
                    <div class="form-group">
                        <label for="email">{{ trans('global.login_email') }}</label>
                        <input id="email" type="email" name="email" 
                               class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" 
                               required autocomplete="email" autofocus 
                               placeholder="{{ trans('global.login_email') }}"
                               value="{{ old('email', $email ?? '') }}">

                        <!-- Error message for email -->
                        @if ($errors->has('email'))
                            <div class="invalid-feedback">
                                {{ $errors->first('email') }}
                            </div>
                        @endif
                    </div>

                    <!-- Password field -->
                    <div class="form-group">
                        <label for="password">{{ trans('global.login_password') }}</label>
                        <input id="password" type="password" name="password" 
                               class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" 
                               required placeholder="{{ trans('global.login_password') }}">

                        <!-- Error message for password -->
                        @if ($errors->has('password'))
                            <div class="invalid-feedback">
                                {{ $errors->first('password') }}
                            </div>
                        @endif
                    </div>

                    <!-- Password confirmation field -->
                    <div class="form-group">
                        <label for="password-confirm">{{ trans('global.login_password_confirmation') }}</label>
                        <input id="password-confirm" type="password" name="password_confirmation" 
                               class="form-control" required 
                               placeholder="{{ trans('global.login_password_confirmation') }}">
                    </div>

                    <!-- Submit button -->
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block">
                                {{ trans('global.reset_password') }}
                            </button>
                        </div>
                    </div>

                    <!-- Success message -->
                    @if (session('status'))
                        <div class="alert alert-success mt-3" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
