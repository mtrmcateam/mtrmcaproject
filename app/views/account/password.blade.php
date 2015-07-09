@extends('layout.default')

@section('head')
@parent
<title>MAC | Change password</title>
@stop


@section('content_heading')
<header class="major">
<h3>Change Password</h3>
</header>
@stop
      
@section('content')
<div class="col-md-9">
<h5>Change password here...</h5>
<hr>
<form class="form-horizontal" role="form" method="post" action="{{ URL::route('account-change-password-post')}}">
	<div class="form-group{{{ ($errors->has('old_password')) ? ' has-error' : ''}}}">
		<label for="old_password" class="col-lg-3 control-label">Old Password: </label>
		<div class="col-lg-5">
		<input id="old_password" name="old_password"{{ (Input::old('old_password'))? 'value="'. e(Input::old('old_password')) . '"' : ''}} type="password" class="form-control">
		@if($errors->has('old_password'))
			{{ $errors->first('old_password')}}
		@endif
		</div>
	</div>
	<div class="form-group{{{ ($errors->has('password')) ? ' has-error' : ''}}}">
		<label for="pass1" class="col-lg-3 control-label">New Password: </label>
		<div class="col-lg-5">
		<input id="password" name="password"{{ (Input::old('password'))? 'value="'. e(Input::old('password')) . '"' : ''}} type="password" class="form-control">
		@if($errors->has('password'))
			{{ $errors->first('password')}}
		@endif
		</div>
	</div>
	<div class="form-group{{{ ($errors->has('password_again')) ? ' has-error' : ''}}}">
		<label for="password_again" class="col-lg-3 control-label">Confirm Password: </label>
		<div class="col-lg-5">
		<input id="password_again" name="password_again" type="password" class="form-control">
		@if($errors->has('password_again'))
			{{ $errors->first('password_again')}}
		@endif
		</div>
	</div>
	<div class="form-group">
      <div class="col-lg-offset-3 col-lg-10">
        <label class="checkbox" for="checkbox3">
          <input type="checkbox" data-toggle="checkbox" value="" id="checkbox3" required>
          I Agree all the <a href="{{ url('termsofservice') }}">terms and conditions.</a>
        </label>
      </div>
    </div>
	{{ Form::token() }}
	<div class="form-group">
      <div class="col-lg-offset-3 col-lg-10">
        <button id="register" name="register" type="submit" class="btn btn-primary">Register</button>
      </div>
    </div>
</form>
</div>
@include('layout.rsidebar')
@stop