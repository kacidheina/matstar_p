@extends('layouts.auth')
@section('content')
    <!-- BEGIN FORGOT PASSWORD FORM -->
    <form class="login-form" role="form" method="POST" action="{{ route('password.email')}}">
        {{ csrf_field() }}
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <h3>Forget Password ?</h3>
        <p> Enter your e-mail address below to reset your password. </p>
        <div class="form-group" {{ $errors->has('email') ? ' has-error' : '' }}>
            <div class="input-icon">
                <i class="fa fa-envelope"></i>
                <input class="form-control placeholder-no-fix" id="email" type="email" name="email" value="{{ old('email') }}" required />
                @if ($errors->has('email'))<span class="help-block"><strong>{{ $errors->first('email') }}</strong></span>@endif
            </div>
        </div>
        <div class="form-actions">
            <button type="submit" class="btn green pull-right"> Submit </button>
        </div>
    </form>
    <!-- END FORGOT PASSWORD FORM -->
@endsection
