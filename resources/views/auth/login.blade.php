@extends('layouts.app')

@section('content')
<div class="logo">
    <a href="{{ url('/') }}" style="color: #ffffff; margin-top: 12px; font-size: 41px; text-decoration: none;">
        <!-- <img src="" alt="" class="logo-default" /> --> 
        <span style="color: rgb(54, 198, 211)"> MY </span> SRIBOGA
        </a>
    <div class="menu-toggler sidebar-toggler">
        <span></span>
    </div>
</div>
<div class="content">
    <!-- BEGIN LOGIN FORM -->
    <form class="login-form" method="post" action="{{ route('login') }}">

    {{ csrf_field() }}

        <h3 class="form-title">Login to your account</h3>
        <div class="alert alert-danger display-hide ">
            <button class="close" data-close="alert"></button>
            <span> Enter any email and password. </span>
        </div>
        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
            <label class="control-label visible-ie8 visible-ie9">Email</label>
            <div class="input-icon">
                <i class="fa fa-user"></i>
                <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Email" name="email" /> </div>
                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
        </div>
        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
            <label class="control-label visible-ie8 visible-ie9">Password</label>
            <div class="input-icon">
                <i class="fa fa-lock"></i>
                <input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="Password" name="password" /> </div>
        </div>
        <div class="form-actions">
            <label class="rememberme mt-checkbox mt-checkbox-outline">
                <input type="checkbox" name="remember" value="1" /> Remember me
                <span></span>
            </label>
            <button type="submit" class="btn green pull-right"> Login </button>
        </div>
    </form>
    <!-- END LOGIN FORM -->
    <!-- BEGIN FORGOT PASSWORD FORM -->
    
    <!-- END FORGOT PASSWORD FORM -->
    <!-- BEGIN REGISTRATION FORM -->
    
    <!-- END REGISTRATION FORM -->
</div>
<div class="copyright"> 2017 &copy; Bandung Techno Park </div>
@endsection
