@extends('layout.default')

@section('head')
@parent
<title>{{ $product->ad_title }} | Mycollegeadda</title>
{{ HTML::script('js/components/lightbox.min.js') }}
{{ HTML::script('js/components/sticky.min.js') }}
<style type="text/css">
#gallery li {display: inline;cursor: pointer; }
body {
    background-color: #f7f7f7;
}
</style>
<script type="text/JavaScript">
// product preview script 
$(document).ready(function() {
    $("#gallery li img").hover(function(){
        $('#main-img').attr('src',$(this).attr('src'));
    });
    var imgSwap = [];
     $("#gallery li img").each(function(){
        imgUrl = this.src;
        imgSwap.push(imgUrl);
    });
    $(imgSwap).preload();
});
$.fn.preload = function() {
    this.each(function(){
        $('<img/>')[0].src = this;
    });
}
</script>
@stop
      
@section('content')
<section class="uk-container uk-container-center">
          <div class="uk-grid">
      <article class="uk-article uk-width-medium-8-10">
        <ul class="uk-breadcrumb">
            <li><a href="{{ URL::route('home')}}">Home</a></li>
            <li><a href="{{ URL::route('getNotesSearchQueryResult')}}">Notes</a></li>
            <li class="uk-active"><span>{{$product->category}}</span></li>
        </ul>
          <h2>{{ $product->ad_title }}</h2>
        <div class="uk-panel uk-panel-box uk-panel-box-secondary">
        <div class="uk-text-danger uk-text-right">
            <i class="uk-text-muted"><i class="icon  uk-icon-info-circle"></i> Add ID: </i><em>{{$product->id}}</em> |   
            <i class="uk-text-muted"><i class="icon  uk-icon-clock-o"></i> Posted on: </i><em>{{$product->created_at->format('d-m-Y')}}</em>
        </div>
        </div>

        <div class="uk-grid uk-margin-large-top uk-margin-large-bottom" data-uk-grid-margin="">
            <div class="uk-width-medium-4-10">
                <div class="uk-panel uk-panel-box uk-panel-box-secondary">
                    <?php 
                    if($product->photo){
                    $photoArray = explode(",",rtrim($product->photo,","));
                    if(isset($photoArray))
                        {   
                            echo '
                            <div id="gallery">
                            <a href="../uploads/'.$seller->id.'/'.$photoArray[0].'" data-uk-lightbox><img src="../uploads/'.$seller->id.'/'.$photoArray[0].'" alt="'.$product->ad_title.'" class="uk-border-rounded" id="main-img" height="320px" width="320px"/></a>
                            <ul>';
                            foreach($photoArray as $photo)
                          {
                          echo '<li><a href="../uploads/'.$seller->id.'/'.$photo.'" data-uk-lightbox><img src="../uploads/'.$seller->id.'/'.$photo.'" height="40px" width="40px" alt="Image not available"></li></a>';
                          }
                          echo '
                            </ul>
                            </div>';
                        }
                    }
                    else
                    {
                        echo '<img src="../images/noimage.jpg" class="uk-border-rounded" alt="'.$product->ad_title.'">';
                    }
                    ?>
                </div>
            </div>
            <div class="uk-width-medium-6-10">
                <div class="uk-panel uk-panel-box uk-panel-box-secondary" data-uk-sticky="{boundary:true,top:50}" style="min-height:288px";>
                    <h3 class="uk-panel-title">Seller Details</h3>
                    @if(Auth::check())
                    <dl class="uk-description-list-horizontal">
                        <dt>Contact Person:</dt>
                        <dd>{{$seller->username}}</dd>
                        <dt>User Type:</dt>
                        <dd>{{$seller_profile->user_type}}</dd>
                        <dt>College Name:</dt>
                        <dd>{{$seller_profile->college_id}}</dd>
                        <dt>City:</dt>
                        <dd>{{$seller_profile->city}}</dd>
                        <dt>Mobile:</dt>
                        <dd>{{$seller_profile->contact}}</dd>
                        <dt>Email:</dt>
                        <dd>{{$seller->email}}</dd>
                    </dl>
                    <div class="uk-align-right uk-margin-large-top">
                    <a class="uk-button uk-button-mycollegeadda" href="" data-uk-modal="{target:'#sendMessage'}">Send Message</a>
                    </div>
                    @else
                    <p>Login to see seller details.<a href="#login" data-uk-modal="{center:true}">Click here</a> to Login.</p>
                    <div class="uk-align-right">
                    <button class="uk-button uk-button-mycollegeadda" href="" disabled>Send Message</button>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="uk-panel uk-panel-box uk-panel-box-secondary">
            <h2>Note Details</h2>
            <ul class="uk-grid uk-text-justify uk-container-center uk-width-9-10" data-uk-grid-margin="">
                <li class="uk-width-medium-1-3"><h5 style="margin-bottom:0px;" class="uk-text-muted"><b>Price</b></h5><i class="uk-icon-rupee"></i> {{$product->selling_price}}/-</li>
                <li class="uk-width-medium-1-3 uk-grid-margin"><h5 class="uk-text-muted"><b>Subject</b></h5>{{ $product->subject }}</li>
                <li class="uk-width-medium-1-3"><h5 class="uk-text-muted"><b>Posted by</b></h5>{{ $product->profile->user_type }}</li>
                <li class="uk-width-medium-1-3 uk-grid-margin"><h5 class="uk-text-muted"><b>Types of Notes</b></h5>{{$product->category}}</li>
                <li class="uk-width-medium-1-3 uk-grid-margin"><h5 class="uk-text-muted"><b>Notes Condition</b></h5>{{$product->item_condition}}</li>
            </ul>
        </div>

        <div class="uk-panel uk-panel-box uk-panel-box-secondary">
            <h2 class="uk-margin-bottom">Additional Info</h2>
            {{$product->ad_description}}
        </div>
      
      </article>
      <article class="uk-width-medium-2-10">
        @include('layout.rsidebar') 
      </article>
      </div>
</section>

<section class="uk-width-medium-8-10">
    <div id="disqus_thread"></div>
        <script type="text/javascript">
            /* * * CONFIGURATION VARIABLES * * */
            var disqus_shortname = 'mycollegeadda';
            
            /* * * DON'T EDIT BELOW THIS LINE * * */
            (function() {
                var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
                dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
                (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
            })();
        </script>
        <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript" rel="nofollow">comments powered by Disqus.</a></noscript>
</section>



<!-- Modal Send Message HTML -->
<div id="sendMessage" class="uk-modal" aria-hidden="true" style="display: none; overflow-y: scroll;">
    <div class="uk-modal-dialog">
        <button type="button" class="uk-modal-close uk-close"></button>
        <div class="uk-modal-header">
            <h2>Send Message</h2>
        </div>
        <form action="{{ URL::route('postSendMessage')}}" method="POST" class="uk-form">
        <div class="uk-form-controls">
            <textarea class="form-control uk-width-1-1" rows="10" id="inputEmail" name="message" placeholder="Write your message here..."></textarea>
            <input type="hidden" name="seller_id" value="{{$seller_profile->id}}" />
            <input type="hidden" name="product_id" value="{{$product->id}}" />
        </div>
        {{ Form::token() }}
        <div class="uk-modal-footer uk-text-right">
            <button type="button" class="uk-button uk-modal-close">Cancel</button>
            <button type="submit" class="uk-button uk-button-primary">Send Message</button>
        </div>
        </form>
    </div>
</div>



<section class="uk-container  uk-margin-large-top uk-margin-large-bottom">
    <h2>Other Notes in this college</h2>
<div class="uk-grid tm-grid-truncate" data-uk-grid-margin="">
    @foreach($other_notes as $other_note)
    <div class="uk-width-medium-1-3">
        <div class="uk-panel uk-panel-box uk-panel-box-secondary">
            <h3 class="uk-panel-title"><a href="{{ URL::route('getNotesDetails',$other_note->ad_title .'~'.$other_note->id)}}">{{$other_note->ad_title}}</a></h3>
            <p>Subject: {{$other_note->subject}}</p>
            <em><i class="uk-icon-rupee"></i> {{$other_note->selling_price}}/-</em>
            <a class="uk-align-right" href="{{ URL::route('getNotesDetails',$other_note->ad_title .'~'.$other_note->id)}}">VIEW</a>
        </div>
    </div>
    @endforeach
</div>
</section>

@stop