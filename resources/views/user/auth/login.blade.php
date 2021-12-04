@extends('layouts.auth.app')
@section("header-resources")
    <script type="module" src="{{asset("assets/js/pages/user/auth.js")}}"></script>
@endsection
@section('content')
    <div class="login-errors" style="display: none">
    </div>
    <div class="login-box">
        <form class="login-form"  method="post" action="/api/login" id="loginForm">
            <h3 class="login-head"><i class="fa fa-lg fa-fw fa-lock"></i>SIGN IN</h3>
            <div class="form-group">
                <label class="control-label">USERNAME OR EMAIL</label>
                <input class="form-control" type="text" placeholder="Email" name="login" autofocus>
            </div>
            <div class="form-group">
                <label class="control-label">PASSWORD</label>
                <input class="form-control" type="password" placeholder="Password" name="password">
            </div>

            <div class="form-group">
                <div class="utility">
                    <p class="semibold-text mb-2"><a href="#" data-toggle="flip">Don't Have Account ?</a></p>
                </div>
            </div>
            <div class="form-group btn-container">
                <button class="btn btn-primary btn-block"><i class="fa fa-sign-in fa-lg fa-fw"></i>SIGN IN</button>
            </div>
        </form>
        <form class="forget-form" method="POST" action="/api/register" id="RegisterForm">
            @csrf
            <h3 class="login-head"><i class="fa fa-lg fa-fw fa-user"></i>Register</h3>
            <div class="form-group">
                <label class="control-label">NAME</label>
                <input class="form-control register-input" type="text" placeholder="Name" name="name" >
                <div class="invalid-feedback" style="display: none"></div>
            </div>
            <div class="form-group">
                <label class="control-label">USERNAME</label>
                <input class="form-control register-input" type="text" placeholder="Username" name="username" >
                <div class="invalid-feedback" style="display: none"></div>
            </div>
            <div class="form-group">
                <label class="control-label">EMAIL</label>
                <input class="form-control register-input" type="text" placeholder="Email" name="email" >
                <div class="invalid-feedback" style="display: none"></div>
            </div>
            <div class="form-group">
                <label class="control-label">PASSWORD</label>
                <input class="form-control register-input" type="text" placeholder="Password" name="password" >
                <div class="invalid-feedback" style="display: none"></div>
            </div>
            <div class="form-group">
                <label class="control-label">CONFIRM PASSWORD</label>
                <input class="form-control register-input" type="text" placeholder="Confirm Password" name="confirm_password">
                <div class="invalid-feedback" style="display: none"></div>
            </div>

            <div class="form-group btn-container">
                <button class="btn btn-primary btn-block">Register</button>
            </div>
            <div class="form-group mt-3">
                <p class="semibold-text mb-0"><a href="#" data-toggle="flip"><i class="fa fa-angle-left fa-fw"></i> Back to Login</a></p>
            </div>
        </form>
    </div>
@endsection

@section("scripts")
    <script type="text/javascript">
        // Login Page Flipbox control
        $('.login-content [data-toggle="flip"]').click(function() {
            $('.login-box').toggleClass('flipped');
            return false;
        });
    </script>
@endsection

