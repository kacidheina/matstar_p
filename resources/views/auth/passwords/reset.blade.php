@extends('layouts.auth')

@section('content')
    <!-- BEGIN FORGOT PASSWORD FORM -->
    <form class="login-form" role="form" method="POST" action="{{ route('password.request') }}">
        {{ csrf_field() }}

        <input type="hidden" name="token" value="{{ $token }}">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <h3>Forget Password ?</h3>
        <p> Enter your e-mail address below to reset your password. </p>
        <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
            <div class="input-icon">
                <i class="fa fa-envelope"></i>
                <input class="form-control placeholder-no-fix" id="email" type="email" name="email" value="{{ $email or old('email') }}" required autofocus/> </div>
                @if ($errors->has('email')) <span class="help-block"> <strong>{{ $errors->first('email') }}</strong></span>@endif
        </div>
        <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
            <div class="input-icon">
                <i class="fa fa-envelope"></i>
                <input class="form-control placeholder-no-fix" id="password" type="password" name="password"  required/> </div>
                @if ($errors->has('password')) <span class="help-block"> <strong>{{ $errors->first('password') }}</strong></span>@endif
        </div>
        <div class="form-group {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
            <div class="input-icon">
                <i class="fa fa-envelope"></i>
                <input class="form-control placeholder-no-fix" id="password_confirmation" type="password" name="password_confirmation"  required/> </div>
            @if ($errors->has('password_confirmation')) <span class="help-block"> <strong>{{ $errors->first('password_confirmation') }}</strong></span>@endif
        </div>
        <div class="form-actions">
            <button type="button" id="back-btn" class="btn red btn-outline">Back </button>
            <button type="submit" class="btn green pull-right"> Submit </button>
        </div>
    </form>
@endsection
