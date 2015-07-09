@extends('layout.default')

@section('head')
@parent
<title>Register | Mycollegeadda</title>
@stop
      
@section('content')
<div class="uk-container uk-container-center">
          <div class="uk-grid">
      <article class="uk-article uk-width-medium-8-10">
        <ul class="uk-breadcrumb">
            <li><a href="{{ URL::route('home')}}">Home</a></li>
            <li class="uk-active"><span>Register</span></li>
        </ul>
          <h2>Register</h2>
          <div class="uk-panel uk-panel-box uk-panel-box-secondary">
          
            <div class="uk-container-center uk-width-medium-5-10 uk-margin-top">
            <div class="uk-grid uk-grid-divider data-uk-grid-match">
                <div class="uk-width-medium-1-"><div class="uk-panel uk-panel-secondary">
                  <form class="uk-form" method="post" action="{{ URL::route('account-create-post')}}">
                    <fieldset>
                        <legend class="uk-text-bold">Register with Email</legend>
                        <div class="uk-form-row">
                            <input id="email" name="email"{{ (Input::old('email'))? 'value="'. e(Input::old('email')) . '"' : ''}} type="text" class="uk-form-large uk-width-medium-1-1{{ ($errors->has('email')) ? ' uk-form-danger' : ''}}" placeholder="Enter your valid email address">
                            @if($errors->has('email'))
                              {{ $errors->first('email')}}
                            @endif
                        </div>
                        <div class="uk-form-row">
                            <input id="username" name="username"{{ (Input::old('username'))? 'value="'. e(Input::old('username')) . '"' : ''}} type="text" class="uk-form-large uk-width-medium-1-1{{ ($errors->has('username')) ? ' uk-form-danger' : ''}}" placeholder="Enter your username">
                            @if($errors->has('username'))
                              {{ $errors->first('username')}}
                            @endif
                        </div>
                        <div class="uk-form-row">
                            <input id="password" name="password"{{ (Input::old('password'))? 'value="'. e(Input::old('password')) . '"' : ''}} type="password" class="uk-form-large uk-width-medium-1-1{{{ ($errors->has('password')) ? ' uk-form-danger' : ''}}}" placeholder="Your Password">
                            @if($errors->has('password'))
                              {{ $errors->first('password')}}
                            @endif
                        </div>
                        <div class="uk-form-row">
                            <input id="password_again" name="password_again"{{ (Input::old('password_again'))? 'value="'. e(Input::old('password_again')) . '"' : ''}} type="password" class="uk-form-large uk-width-medium-1-1{{{ ($errors->has('password_again')) ? ' uk-form-danger' : ''}}}" placeholder="Confirm your password">
                            @if($errors->has('password_again'))
                              {{ $errors->first('password_again')}}
                            @endif
                        </div>
                        <div class="uk-form-row">
                            <label><input type="checkbox" name="remember" id="remember" required> I Agree all the <a target="blank" href="{{ url('termsofservice') }}">terms and conditions.</a></label>
                        </div>
                        <div class="uk-form-row">
                            <button class="uk-button uk-width-1-1 uk-button-large uk-button-mycollegeadda" type="submit">Register</button>
                        </div>
                    </fieldset>
                    {{ Form::token() }}
                </form>
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