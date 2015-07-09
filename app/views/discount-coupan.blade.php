@extends('layout.default')

@section('head')
@parent
<title>MAC | Discount Coupan</title>
@stop


@section('content_heading')
<header class="major">
<h3>Discount Coupan</h3>
</header>
@stop
      
@section('content')
<div class="col-md-9">
<h5>Feedback Form</h5>
<hr>
@if($count)
<div class="well">
	You need to post atleast one ad to get coupan code
	</div>
@else
<div class="well">
	You need to post atleast one ad to get coupan code
	</div>
@endif

<form class="form-horizontal" role="form" method="post" url="{{ URL::route('postFeedback')}}">
	<div class="form-group{{ ($errors->has('full_name')) ? ' has-error' : ''}}">
		<label for="full_name" class="col-lg-3 control-label">Name: </label>
		<div class="col-lg-5">
		<input id="full_name" name="full_name"{{ (Input::old('full_name'))? 'value="'. e(Input::old('full_name')) . '"' : ''}} type="text" class="form-control" placeholder="Enter your full name">
		@if($errors->has('full_name'))
			{{ $errors->first('full_name')}}
		@endif
		</div>
	</div>
	<div class="form-group{{ ($errors->has('email')) ? ' has-error' : ''}}">
		<label for="email" class="col-lg-3 control-label">Email: </label>
		<div class="col-lg-5">
		<input id="email" name="email"{{ (Input::old('email'))? 'value="'. e(Input::old('email')) . '"' : ''}} type="text" class="form-control" placeholder="Enter your valid email address">
		@if($errors->has('email'))
			{{ $errors->first('email')}}
		@endif
		</div>
	</div>
	<div class="form-group{{ ($errors->has('message')) ? ' has-error' : ''}}">
                  <label for="message" class="col-xs-12 col-sm-3 col-md-3 col-lg-3 control-label">Message</label>
                  <div class="col-xs-12 col-sm-5 col-md-5 col-lg-5">
                    <textarea class="form-control" id="message" name="message" id="message" rows="4" placeholder="Write your valuable feedback here...">{{ (Input::old('message'))? e(Input::old('message')) : ''}}</textarea>
                    @if($errors->has('message'))
                    {{ $errors->first('message')}}
                    @endif
                  </div>
           </div>
	{{ Form::token() }}
	<div class="form-group">
      <div class="col-lg-offset-3 col-lg-10">
        <button name="register" type="submit" class="btn btn-primary">Submit</button>
      </div>
    </div>
</form>
</div>
@include('layout.rsidebar')
@stop