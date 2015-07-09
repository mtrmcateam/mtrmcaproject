@extends('layout.default')

@section('head')
@parent
<title>MAC | Wishlist</title>
@stop


@section('content_heading')
<header class="major">
<h3>Wishlist</h3>
</header>
@stop
      
@section('content')
<div class="col-md-9">
<h5>Your Wishlist</h5>
<hr>

<?php
  /*  if (isset($_COOKIE['wishlist'])) {
    for ($i = 0; $i < count($_COOKIE['wishlist']); $i++) {
        echo $_COOKIE['wishlist'][$i] . '<br>';
        }
    }
*/
?>
@foreach($products as $product)
    <section class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <article class="panel panel-default">
            <div class="panel-body">
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <?php
                        $photoArray = explode(",",rtrim($product->photo,","));
                        $url = asset('uploads/'.$product->profile->user_id.'/'.$photoArray[0]);
                        echo '<img src="'.$url.'" class="img-rounded pull-left" alt="'.$product->book_name.'" height=100px width=100px>';
                    ?>
                    
                </div>
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
                    <a href="{{ URL::route('getBooksDetails',$product->book_name .'~'.$product->id)}}"><h6>{{ $product->book_name }}</h6></a>
                    {{substr($product->book_description,0,150)}}...
                </div>
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                    <i class="text-muted small">Posted on:</i><br><em class="text-info small"><i class="icon  fa-clock-o"></i> {{$product->created_at->format('d-m-Y')}}</em>
                    <div class="btn btn-danger col-xs-12">
                        <em><i class="icon  fa-inr"></i> {{$product->selling_price}}/-</em>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <br>Author: <a>{{ $product->author_name }}</a> | Posted In College: <a href="{{ URL::route('getBooksKeywordSearchResult',array('college_id',$product->profile->college_id))}}">{{ $product->profile->college_id }}</a>
                </div>
            </div> 
            <div class="panel-footer clearfix">
                <div class="btn-group btn-group-justified">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <a class="btn btn-link" href="{{ URL::route('postWishlist', $product->id) }}" style="text-decoration:none;"><i class="icon  fa-heart"></i> Add to Wishlist</a>
              
                </div>
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <a class="btn btn-block btn-primary" href="{{ URL::route('getBooksDetails',$product->book_name .'~'.$product->id)}}"><i class="icon  fa-comment"></i> REPLY</a>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                      <a class="btn btn-block btn-success" href="{{ URL::route('getBooksDetails',$product->book_name .'~'.$product->id)}}"><i class="icon  fa-th-large"></i> VIEW</a>
                    </div>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                    <a 
                        class="btn btn-link" 
                        data-toggle="popover" 
                        title="Share" 
                        data-html="true"
                        data-content='
                            <button class="btn btn-social-facebook icon fa-facebook-square" /></br></br>
                            <button class="btn btn-social-stumbleupon icon fa-google-plus-square" /></br></br>
                            <button class="btn btn-social-twitter icon fa-twitter-square" />'
                        style="text-decoration:none;" >
                        <i class="icon  fa-share-alt"></i> Share
                    </a>
                </div>
                </div>
                </div>      
            </div>
        </article>
    </section>
    @endforeach
    {{$products->links()}}
</div>
@include('layout.rsidebar')
@stop