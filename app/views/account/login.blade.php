@extends('layout.default')

@section('head')
@parent
<title>Login | Mycollegeadda</title>
@stop
      
@section('content')
<div class="uk-container uk-container-center">
          <div class="uk-grid">
      <article class="uk-article uk-width-medium-8-10">
        <ul class="uk-breadcrumb">
            <li><a href="{{ URL::route('home')}}">Home</a></li>
            <li class="uk-active"><span>Login</span></li>
        </ul>
          <h2>Login</h2>
          <div class="uk-panel uk-panel-box uk-panel-box-secondary">
          
            <div class="uk-container-center uk-width-medium-7-10 uk-margin-top">
            <div class="uk-grid uk-grid-divider data-uk-grid-match">
                <div class="uk-width-medium-1-2 uk-text-center">
                  <div class="uk-panel uk-panel-secondary">
                  <p><a class="uk-button uk-width-1-1 uk-button-large uk-button-facebook" href="{{ URL::route('account-login-facebook') }}"><i class="uk-icon-facebook"></i> Sign in with Facebook</a></p>
                  <p><a class="uk-button uk-width-1-1 uk-button-large uk-button-google" href="{{ URL::route('account-login-google') }}"><i class="uk-icon-google-plus"></i> Sign in with Google+</a></p>
                  <p class="uk-text-muted">OR<br> Register with Email</p>
                  <p>
                    <a aria-expanded="true" class="uk-button uk-width-1-1 uk-button-large uk-button-mycollegeadda" href="{{ URL::route('account-create')}}">Register</a>
                  </p>
                  </div>
              </div>
                <div class="uk-width-medium-1-2"><div class="uk-panel uk-panel-secondary">
                  <form class="uk-form" method="post" action="{{ URL::route('account-login-post')}}">
                    <fieldset>
                        <legend class="uk-text-bold">Login with Email</legend>
                        <div class="uk-form-row">
                            <input id="email" name="email"{{ (Input::old('email'))? 'value="'. e(Input::old('email')) . '"' : ''}} type="text" class="uk-form-large uk-width-medium-1-1{{ ($errors->has('email')) ? ' uk-form-danger' : ''}}" placeholder="Enter your email">
                            @if($errors->has('email'))
                              {{ $errors->first('email')}}
                            @endif
                        </div>
                        <div class="uk-form-row">
                            <input id="password" name="password"{{ (Input::old('password'))? 'value="'. e(Input::old('password')) . '"' : ''}} type="password" class="uk-form-large uk-width-medium-1-1{{{ ($errors->has('password')) ? ' uk-form-danger' : ''}}}" placeholder="************">
                            @if($errors->has('password'))
                              {{ $errors->first('password')}}
                            @endif
                        </div>
                        <div class="uk-form-row">
                            <label><input type="checkbox" name="remember" id="remember"> Remember me</label>
                        </div>
                        <div class="uk-form-row">
                            <button class="uk-button uk-width-1-1 uk-button-large uk-button-mycollegeadda" type="submit">Login</button>
                        </div>
                    </fieldset>
                    {{ Form::token() }}
                </form>
                <a href="{{URL::route('account-forgot-password')}}">Forgot password?</a>
                </div>
            </div>
            </div>
            </div>
        </div>
      </article>
      <article class="uk-width-medium-2-10">
        @include('layout.rsidebar')
      </article>
      </div>
    </div>
@stop