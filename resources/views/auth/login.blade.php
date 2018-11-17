@extends('layouts.app')

@section('content')
    <div class="modal login-modal">
        <span class="cover-photo"></span>
        <div class="body clearfix">
            <a href="#" class="fb-login">Log in with Faceebook</a>
            <p class="or-divider"><span>Or</span></p>
            <form method="POST" class="login-form" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
                @csrf

                <input id="name" type="username" name="name" placeholder="Username..." required autofocus />
                @if ($errors->has('email'))
                    <span>
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif

                <input id="password" type="password" name="password" placeholder="Password..." required />
                @if ($errors->has('password'))
                    <span>
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif

                <a href="#" class="forgot-password">Forgot password?</a>
                <div>
                    <input type="submit" value="{{ __('Login') }}" id="login-form-submit" />
                </div>
            </form>
        </div>

        <footer>
            <p>
                Not a member? <a href="#">Register</a>
            </p>
        </footer>

    </div>

@endsection
