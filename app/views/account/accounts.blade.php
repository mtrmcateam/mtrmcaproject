extends('layout.default')

@section('head')
@parent
<title>Sell Books</title>
@stop


@section('content_heading')
<header class="major">
<h3>My Profile</h3>
</header>
@stop
      
@section('content')
<div class="col-md-9">
  <hr>
    <div class="media">
    <a href="#" class="pull-left">
       <img src="../images/noimage.jpg" class="media-object" alt="Sample Image">
    </a>
    <div class="media-body">
        <h4 class="media-heading">{{ Auth::user()->username}} <small><i>Email is {{ Auth::user()->email}}</i></small></h4>
        <p>Excellent feature! I love it. One day I'm definitely going to put this Bootstrap component into use and I'll let you know once I do.</p>
    </div>
</div>
            <div class="header">
                <h3>{{ Auth::user()->username}}</h3>
                <h5>{{ Auth::user()->email}}</h5>
                <span>Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit..."
"There is no one who loves pain itself, who seeks after it and wants to have it, simply because it is pain..."</span>
           </div>
</div>
@include('layout.rsidebar')
@stop