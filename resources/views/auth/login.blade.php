@extends('layouts.auth')

@section('content')
    <!-- BEGIN LOGIN FORM -->
    <form class="login-form" role="form" method="POST" action="{{ route('login')}}">
        {{ csrf_field() }}
        <h3 class="form-title">Login to your account</h3>
        <div class="alert alert-danger display-hide">
            <button class="close" data-close="alert"></button>
            <span> Enter any username and password. </span>
        </div>
        <div class="form-group">
            <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
            <label for="email" class="control-label visible-ie8 visible-ie9">Username</label>
            <div class="input-icon">
                <i class="fa fa-user"></i>
                <input class="form-control placeholder-no-fix {{ $errors->has('email') ? ' has-error' : '' }}" type="email" autocomplete="off" id="email" name="email" value="{{ old('email') }}" required autofocus /> </div>
                @if ($errors->has('email'))<span class="help-block"><strong>{{ $errors->first('email') }}</strong></span>@endif
        </div>
        <div class="form-group">
            <label for="password" class="control-label visible-ie8 visible-ie9">Password</label>
            <div class="input-icon">
                <i class="fa fa-lock"></i>
                <input class="form-control placeholder-no-fix {{ $errors->has('password') ? ' has-error' : '' }}" type="password" id="password" name="password" required/> </div>
                @if ($errors->has('password')) <span class="help-block"> <strong>{{ $errors->first('password') }}</strong></span> @endif
        </div>
        <div class="form-actions">
            <label class="checkbox">
                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }} checked/> Remember me </label>
            <button type="submit" class="btn green pull-right"> Login </button>
        </div>
        <div class="forget-password">
            <h4>Forgot your password ?</h4>
            <p> no worries, click
                <a href="{{ route('password.request') }}" id="forget-password"> here </a> to reset your password. </p>
        </div>
    </form>
    <!-- END LOGIN FORM -->
@endsection
