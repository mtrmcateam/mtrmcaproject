@extends('layout.default')

@section('head')
@parent
<title>Forgot Password | Mycollegeadda</title>
@stop
      
@section('content')
<section class="uk-container uk-container-center">
          <div class="uk-grid">
      <article class="uk-article uk-width-medium-8-10">
        <ul class="uk-breadcrumb">
            <li><a href="{{ URL::route('home')}}">Home</a></li>
            <li class="uk-active"><span>Recover Acccount</span></li>
        </ul>
          <h2>Recover Acccount</h2>
          <p class="uk-article-lead uk-text-primary">Request new password here</p>
          <div class="uk-panel uk-panel-box uk-panel-box-secondary">
          
          <form class="uk-form uk-form-horizontal" method="post" enctype="multipart/form-data" action="{{ URL::route('account-forgot-password-post')}}">
            <div class="uk-form-row">
              <label class="uk-form-label" for="email">Email<span class="uk-text-danger">*</span></label>
                <div class="uk-form-controls">
                  <input type="text" id="txtBookSearch" class="uk-form-large uk-width-medium-1-2{{ ($errors->has('email')) ? ' uk-form-danger' : ''}}" name="email"{{ (Input::old('email'))? 'value="'. e(Input::old('email')) . '"' : ''}} id="email" placeholder="Enter your registered email">
                  @if($errors->has('email'))
                  {{ $errors->first('email')}}
                  @endif
                </div>
            </div>
            {{ Form::token() }}
          <div class="uk-form-row">
              <span class="uk-form-label"></span>
              <div class="uk-form-controls uk-form-controls-text">
                <button type="submit" class="uk-button uk-button-primary">Request new Password</button>
              </div>
          </div>
          <p>*Request new password service is not available for users registered via google or facebook.</p>
        </div>
      
      </article>
      <article class="uk-width-medium-2-10">
        @include('layout.rsidebar') 
      </article>
      </div>
</section>
@stop