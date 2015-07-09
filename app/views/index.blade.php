@extends('layout.default')

@section('head')
@parent
<title>Mycollegeadda | Buy,Sell &amp; Connect with your college folks</title>
<style>
 #colleges option{
  color: red !important;
 }
 datalist {
    display: none;
    color: red;
}
</style>
{{ HTML::script('js/components/parallax.min.js') }}
{{ HTML::script('js/college_autocomplete.js') }}
@stop

@section('header')
@stop
@section('home_content')
<?php
  $college_name = College::get(); 
?><!-- Header -->
<header class="uk-cover-background uk-position-relative" data-uk-parallax="{bg: '-200'}" style="height: 350px;background-color:#000; background-image: url(images/home_banner.jpg);background-position: 50% -34.29px; background-repeat: no-repeat;">
  
  <nav class="h-navbar uk-navbar uk-contrast" style="background-color:transparent;border-bottom-color:transparent;">
    <a class="uk-navbar-brand uk-hidden-small uk-contrast" href="{{ URL::route('home')}}"><img src="{{asset('images/logo.png')}}" alt="mycollegeadda"></a>
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
    <a href="#offcanvas" class="uk-navbar-toggle uk-contrast uk-visible-small" data-uk-offcanvas=""></a>
    <a class="uk-navbar-brand uk-navbar-center uk-contrast uk-visible-small" href="{{ URL::route('home')}}"><img src="{{asset('images/logo.png')}}" alt="mycollegeadda"></a>
  </nav>

  <img class="uk-invisible home_banner" src="images/home_banner.jpg" width="850" height="850" alt="">
  <div class="uk-position-cover uk-flex uk-flex-center uk-flex-top uk-margin-large-top">
    <div class="uk-container uk-text-center uk-container-center uk-margin-large-top">
    <div class="uk-grid">
      <div class="uk-width-1-1">
      <h1 class="uk-contrast uk-scrollspy-init-inview"  data-uk-scrollspy="{cls:'uk-animation-slide-left', repeat: true}">Welcome To India's First Online College Adda, Mycollegeadda</h1>
      <h3 class="uk-contrast uk-scrollspy-init-inview" style="font-weight: bold" data-uk-scrollspy="{cls:'uk-animation-slide-right', repeat: true}">Marketplace To Buy And Sell Used Goods Within Your College Campus</h3>
      </div>
    <div class="uk-width-medium-5-10 uk-container-center uk-margin-large-top">
      <form class="uk-form" method="get" action="{{ URL::route('getCollege') }}">
        <div id="outer">
            <div class="uk-form-icon uk-autocomplete uk-form uk-text-left" style="width:80%;">
            <i class="uk-icon-mortar-board"></i>
            <input type="text" list="colleges" placeholder="Enter college" name="college_name" class="uk-width-1-1 uk-form-large" required>
            <datalist id="colleges">
              @foreach($college_name as $name)
              <option style="color:red;" value="{{ $name->name}}">
              @endforeach
            </datalist>
            </div>
            <button class="uk-button uk-button-mycollegeadda uk-button-large " type="submit">Search</button>
        </div>
      </form> 
    </div>
    </div>
    </div>
  </div>
</header>

<div class="uk-grid uk-text-center uk-grid-collapse uk-margin-large-bottom uk-grid-match homenav" data-uk-grid-match="{target:'.uk-panel'}" style="box-shadow: 0px 1px 5px;">
      <div class="uk-width-medium-1-5 tab">
        <a class="uk-panel uk-panel-hover" href="{{ URL::route('getBooksSearchQueryResult')}}">
          <i class="uk-icon-book uk-icon-large"></i> 
          <h3 class="uk-panel-title uk-margin-top">BOOKS</h3>
        </a>
    </div>
    <div class="uk-width-medium-1-5 tab">
        <a class="uk-panel uk-panel-hover" href="{{ URL::route('getNotesSearchQueryResult')}}">
          <i class="uk-icon-newspaper-o uk-icon-large"></i> 
          <h3 class="uk-panel-title uk-margin-top">NOTES</h3>
        </a>
    </div>
    <div class="uk-width-medium-1-5 tab">
        <a class="uk-panel uk-panel-hover" href="{{ URL::route('getElectronicsSearchQueryResult')}}">
          <i class="uk-icon-fax uk-icon-large"></i> 
          <h3 class="uk-panel-title uk-margin-top">ELECTRONICS</h3>
        </a>
    </div>
    <div class="uk-width-medium-1-5 tab">
        <a class="uk-panel uk-panel-hover" href="{{ URL::route('getCarPoolSearchQueryResult')}}">
          <i class="uk-icon-automobile uk-icon-large"></i> 
          <h3 class="uk-panel-title uk-margin-top">CAR POOL</h3>
        </a>
    </div>
    <div class="uk-width-medium-1-5 tab">
        <a class="uk-panel uk-panel-hover" href="{{ URL::route('getFlatmatesSearchQueryResult')}}">
          <i class="uk-icon-home uk-icon-large"></i> 
          <h3 class="uk-panel-title uk-margin-top">FLATMATES - PG</h3>
        </a>
    </div>
  </div>

  <article class="uk-panel uk-panel-hover uk-width-medium-8-10 uk-container-center uk-text-center uk-animation-slide-top uk-animation-7">
      <h3>Mycollegeadda.com Is an Online Marketplace for College Folks to Buy and Sell Used Books, Notes or Electronics Within Their College Campus. Students Can Also Find Ride Sharing Partners for Carpool or Find Room Mates for Sharing the Flat.</h3>
      <a href="#how-it-works" data-uk-modal="{center:true}" class="uk-button uk-button-primary uk-button-large" type="button">How it works</a>
  </article>

  <!-- This is how-it-works modal -->
  <div id="how-it-works" class="uk-modal">
      <div class="uk-modal-dialog">
          <a class="uk-modal-close uk-close"></a>
          <h1>How it works</h1>
          <hr>
          <img src="images/how-it-works.png">
      </div>
  </div>
  <!-- This is how-it-works modal ends -->
  
  <div class="uk-container uk-container-center uk-margin-large-bottom">
    <hr class="uk-margin-large-bottom">
  <ul class="uk-grid uk-grid-width-1-1 uk-grid-width-medium-1-2 uk-grid-width-large-1-4 uk-text-center" data-uk-grid-margin="">
        <li><img src="images/green1.png" alt="Make Friends"><h4><b>Make Friends</b></h4> Transact and develop friendship with colleagues</li>
        <li><img src="images/green2.png" alt="Save Environment"><h4><b>Save Environment</b></h4> Sell &amp; Reuse Goods, Save Resources – Save Environment</li>
        <li><img src="images/green3.png" alt="Economical"><h4><b>Economical</b></h4> Save money by sharing and using trusted pre owned items</li>
        <li><img src="images/green4.png" alt="Convenience"><h4><b>Convenience</b></h4> Sell &amp; Find goods at few moves of your fingertips</li>
    </ul>
  </div>

  <div class="uk-panel uk-panel-box uk-contrast create-alert" style="border:none;border-radius:0px;">
      <div class="uk-container uk-container-center">
      <div class="uk-grid uk-grid-width-1-1">
          <div class="uk-width-1-1 uk-width-medium-1-2">
            <h2 class="uk-margin-large-top">Not able to find your college or item, <b>Create Alert!!</b></h2>
          </div>
          <div class="uk-width-1-1 uk-width-medium-1-2">
            <form method="post" action="{{ URL::route('postAlert')}}" class="uk-form uk-form-controls-condensed" action="#submitted">
        <div class="uk-grid uk-grid-small uk-grid-match" data-uk-grid-margin="">
            <div class="uk-width-medium-1-3">
                      <div class="uk-form-controls">
                          <input type="text" id="college_id" name="college_id" class="uk-width-1-1{{ ($errors->has('college_id')) ? ' uk-form-danger' : ''}}" placeholder="Enter College">
                      </div>
                </div>
            <div class="uk-width-medium-1-3">
                <div class="uk-form-controls">
                          <input type="text" name="name" class="uk-width-1-1{{ ($errors->has('name')) ? ' uk-form-danger' : ''}}" placeholder="Enter Name">
                      </div>
                  </div>
            <div class="uk-width-medium-1-3">
                <div class="uk-form-controls">
                  <input type="email" name="email" class="uk-width-1-1{{ ($errors->has('email')) ? ' uk-form-danger' : ''}}" placeholder="Enter Email id">
                </div>
            </div>
            <div class="uk-width-medium-1-1">
                <div class="uk-form-controls">
                    <textarea name="message" class="uk-width-1-1{{ ($errors->has('message')) ? ' uk-form-danger' : ''}}" rows="5" placeholder="Tell us your need"></textarea>
                </div>
            </div>
            {{ Form::token() }}
            <div class="uk-width-medium-1-3 uk-container-center">
              <div class="uk-form-controls">
                 <input type="submit" id="form-s-it" class="uk-button uk-button-danger uk-button-large uk-width-1-1" value="Create Alert">
              </div>
            </div>
        </div>
      </form>
          </div>
      </div>
    </div>
  </div>
  <div style="background:url('images/vbg.png');">
    <h2 class="uk-container uk-container-center uk-width-1-5 uk-text-center" style="padding-top:2%;"><b>Story of Cyrus</b></h2>
  <div class="uk-container uk-container-center  uk-width-medium-5-10">
    <iframe width="640" height="360" class="uk-margin-large-bottom uk-margin-top" src="https://www.youtube.com/embed/koWeYDou8AA?rel=0" frameborder="0" allowfullscreen></iframe>
  </div>
</div>
  
@stop