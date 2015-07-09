<div id="offcanvas" class="uk-offcanvas">
        <div class="uk-offcanvas-bar">
            <ul class="uk-nav uk-nav-offcanvas">
                <li>
                  <a href="{{ URL::route('getSell')}}">Post a free Ad</a>
                </li>
                <li>
                    <a href="{{ URL::route('getDonateBooks')}}">Donate a book</a>
                </li>
                <li>
                    <a href="http://blog.mycollegeadda.com" target="blank">Our Blog</a>
                </li>
                @if(!Auth::check())
                <li><a href="#login" data-uk-modal="{center:true}">LOGIN</a></li>   
                @endif
                @if(Auth::check())
                <li class="uk-parent" data-uk-dropdown="" aria-haspopup="true" aria-expanded="false">
                    <a href="">
                      @if (Auth::user()->photo)
                      <img src="{{ Auth::user()->photo}}" height=20px width=20px> {{ Auth::user()->username }}<b class="caret"></b>
                      @else
                      <img src="{{ route('home'); }}/images/avtar.png" height=20px width=20px> {{ Auth::user()->username }}<b class="caret"></b>
                      @endif
                      <i class="uk-icon-caret-down"></i>
                    </a>

                    <div class="uk-dropdown uk-dropdown-navbar">
                        <ul class="uk-nav uk-nav-navbar">
                            <li><a style="color:black;" href="{{ URL::route('viewProfile') }}">View Profile</a></li>
                            <li><a style="color:black;" href="{{ URL::route('getManageProfile') }}">Manage Profile</a></li>
                            <li class="uk-nav-divider"></li>
                            <li><a style="color:black;" href="{{URL::route('account-logout')}}">Logout</a></li>
                        </ul>
                    </div>
                </li>
                @endif
            </ul>
        </div>
  </div>

  <!-- This is login modal -->
  <div id="login" class="uk-modal">
      <div class="uk-modal-dialog">
          <a class="uk-modal-close uk-close"></a>
            <div aria-hidden="true" class="uk-grid uk-grid-divider uk-margin-large-top uk-margin-large-bottom data-uk-grid-match">
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
  <!-- This is login modal ends -->
@section('header')
<?php
  $college_name = College::get(); 
?><!-- Header -->
  <nav class="h-navbar uk-navbar uk-contrast uk-margin-bottom" data-uk-sticky="{boundary:'#define-an-offset'}">
            <a class="uk-navbar-brand uk-hidden-small uk-contrast" href="{{ URL::route('home')}}"><img src="{{asset('images/logo.png')}}" alt="mycollegeadda"></a>
             <div class="uk-navbar-content uk-hidden-small">
              <ul class="uk-navbar-nav">
                  <li class="uk-parent" data-uk-dropdown="" aria-haspopup="true" aria-expanded="false">
                      @section('select_category')
                      <a href="">Select Category <i class="uk-icon-caret-down"></i></a>

                      <div class="uk-dropdown uk-dropdown-navbar">
                          <ul class="uk-nav uk-nav-navbar">
                              <li><a style="color:black;" href="{{ URL::route('getBooksSearchQueryResult')}}">Books</a></li>
                              <li><a style="color:black;" href="{{ URL::route('getNotesSearchQueryResult')}}">Notes</a></li>
                              <li><a style="color:black;" href="{{ URL::route('getElectronicsSearchQueryResult')}}">Electronics</a></li>
                              <li><a style="color:black;" href="{{ URL::route('getCarPoolSearchQueryResult')}}">Car Pool</a></li>
                              <li><a style="color:black;" href="{{ URL::route('getFlatmatesSearchQueryResult')}}">Flatmates</a></li>
                          </ul>
                      </div>
                      @show
                  </li>
              </ul>
          <form class="uk-form uk-margin-remove uk-display-inline-block" method="get" action="{{ URL::route('getCollege') }}">
              <div class="uk-form-icon">
              <i class="uk-icon-mortar-board"></i>
              <input type="text" list="colleges" placeholder="Enter College" name="college_name" class="uk-form-width-medium" required>
              <datalist id="colleges">
              @foreach($college_name as $name)
              <option value="{{ $name->name}}">
              @endforeach
            </datalist>
          </div>
          </form>
      </div>
             <div class="uk-navbar-flip">
            <ul class="uk-navbar-nav uk-hidden-small">
              <li>
                <a href="{{ URL::route('getSell')}}">Post a free Ad</a>
              </li>
              <li>
                <a href="{{ URL::route('getDonateBooks')}}">Donate a book</a>
              </li>
              <li>
                <a href="http://blog.mycollegeadda.com" target="blank">Our Blog</a>
              </li>
              @if(!Auth::check())
              <li><a href="#login" data-uk-modal="{center:true}">LOGIN</a></li>   
              @endif
              @if(Auth::check())
              <li class="uk-parent" data-uk-dropdown aria-haspopup="true" aria-expanded="false">
                  <a href>
                    @if (Auth::user()->photo)
                    <img src="{{ Auth::user()->photo}}" height=20px width=20px> {{ Auth::user()->username }}<b class="caret"></b>
                    @else
                    <img src="{{ route('home'); }}/images/avtar.png" height=20px width=20px> {{ Auth::user()->username }}<b class="caret"></b>
                    @endif
                    <i class="uk-icon-caret-down"></i>
                  </a>

                  <div class="uk-dropdown uk-dropdown-navbar">
                      <ul class="uk-nav uk-nav-navbar">
                          <li><a style="color:black;" href="{{ URL::route('viewProfile') }}">View Profile</a></li>
                          <li><a style="color:black;" href="{{ URL::route('getManageProfile') }}">Manage Profile</a></li>
                          <li class="uk-nav-divider"></li>
                          <li><a style="color:black;" href="{{URL::route('account-logout')}}">Logout</a></li>
                      </ul>
                  </div>
              </li>
              @endif
            </ul>
        </div>
            <a href="#offcanvas" class="uk-navbar-toggle uk-contrast uk-visible-small" data-uk-offcanvas=""></a>
            <a class="uk-navbar-brand uk-navbar-center uk-contrast uk-visible-small" href="{{ URL::route('home')}}"><img src="{{asset('images/logo.png')}}" alt="mycollegeadda"></a>
        </nav>
@show