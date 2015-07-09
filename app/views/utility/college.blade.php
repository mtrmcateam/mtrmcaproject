@extends('layout.default')

@section('head')
@parent
<title>{{ $college_name }} | Mycollegeadda</title>
{{ HTML::script('js/components/parallax.min.js') }}
@stop

@section('header')
@stop
@section('home_content')
<header class="uk-cover-background uk-position-relative uk-margin-large-bottom" data-uk-parallax="{bg: '-200'}" style="height: 350px; background-image: url(images/sell_banner.jpg); background-size: 1223px 612px; background-position: 50% -34.29px; background-repeat: no-repeat;">
<div style="background: rgba(0, 0, 0, 0.55);">  
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
    <img class="uk-invisible home_banner" src="images/sell_banner.jpg" width="500" height="500" alt="">
    <div class="uk-position-cover uk-flex uk-flex-center uk-flex-top uk-margin-large-top">
      <div class="uk-container uk-text-center uk-container-center uk-margin-large-top">
      <div class="uk-grid">
        <div class="uk-width-medium-1-1">
        <h2 class="uk-contrast" style="font-weight: bold">{{ $college_name }}</h2>
        <h3 class="uk-contrast" style="font-weight: bold">Search stuff available in your college</h3>
        <div id="outer" class="uk-container-center uk-margin-large-top">
            <a class="uk-button uk-button-white uk-button-large" href="{{ URL::route('getBooksKeywordSearchResult',array('college_id',$college_name))}}"><i class="uk-icon-book"></i> Books</a>
            <a class="uk-button uk-button-white uk-button-large" href="{{ URL::route('getNotesKeywordSearchResult',array('college_id',$college_name))}}"><i class="uk-icon-newspaper-o"></i> Notes</a>
            <a class="uk-button uk-button-white uk-button-large" href="{{ URL::route('getElectronicsKeywordSearchResult',array('college_id',$college_name))}}"><i class="uk-icon-fax"></i> Electronics</a>
            <a class="uk-button uk-button-white uk-button-large" href="{{ URL::route('getCarPoolKeywordSearchResult',array('college_id',$college_name))}}"><i class="uk-icon-automobile"></i> Car Pool</a>
            <a class="uk-button uk-button-white uk-button-large" href="{{ URL::route('getFlatmatesKeywordSearchResult',array('college_id',$college_name))}}"><i class="uk-icon-home"></i> Flatmates</a>
        </div>
      </div>
    </div>
    </div>
    </div>
</div>
</header>

<article class="uk-panel uk-panel-hover uk-width-medium-8-10 uk-container-center uk-text-center uk-animation-slide-top uk-animation-7">
  <h3>Mycollegeadda.com is an online marketplace for college folks to Buy and Sell used Books, Notes or Electronics within their college campus.
    Students can also find ride sharing partners for Carpool or find room mates for sharing the Flat.</h3>
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
      <li><img src="images/green1.png" alt=""><h4><b>Make Friends</b></h4> Transact and develop friendship with colleagues</li>
      <li><img src="images/green2.png" alt=""><h4><b>Save Environment</b></h4> Sell &amp; Reuse Goods, Save Resources – Save Environment</li>
      <li><img src="images/green3.png" alt=""><h4><b>Economical</b></h4> Save money by sharing and using trusted pre owned items</li>
      <li><img src="images/green4.png" alt=""><h4><b>Convenience</b></h4> Sell &amp; Find goods at few moves of your fingertips</li>
  </ul>
</div>

  <!-- This is login modal -->
<div id="login" class="uk-modal">
    <div class="uk-modal-dialog">
        <a class="uk-modal-close uk-close"></a>
        <h1>Login</h1>
        <hr>
    </div>
</div>
  <!-- This is login modal ends -->
@stop