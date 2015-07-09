@if(count($products) < 1 )
<div class="uk-alert" data-uk-alert>
    <a href="" class="uk-alert-close uk-close"></a>
    <p>All products have been sold. <a href="{{ URL::route('getSell')}}">Post your stuff</a> now to make quick cash!</p>
</div>
@endif
@foreach($products as $product)
    <section class="uk-panel uk-panel-box-secondary" data-uk-alert>
            <div class="uk-grid">
                <div class="uk-width-medium-3-10">
                    <?php
                        if($product->photo){
                            $photoArray = explode(",",rtrim($product->photo,","));
                        $url = asset('uploads/'.$product->profile->user_id.'/'.$photoArray[0]);
                        echo '<img src="'.$url.'" class="uk-align-medium-left" alt="'.$product->ad_title.'" width="290" height="220">';
                        }
                        else
                         echo '<img src="'.asset('images/noimage.jpg').'" class="no-img img-rounded pull-left" alt="'.$product->ad_title.'" width="290" height="220">';   
                    ?>
                </div>
                <div class="uk-width-medium-7-10">
                    <h2><a style="color:#1ABC9C;" href="{{ URL::route('getFlatmatesDetails',$product->ad_title .'~'.$product->id)}}" target="blank">{{ $product->ad_title }}</a><div class="uk-align-right" style=""><small><a href="#" class="uk-alert-close uk-close"></a></small></div></h2>
                    <b>{{substr($product->ad_description,0,150)}}...</b>
                    <div class="uk-grid uk-margin-top uk-grid-small">
                        <div class="uk-width-1-3"><h5 class="uk-text-muted" style="margin-bottom:0px;"><b>Rent Per Person</b></h5><i class="uk-icon-rupee"></i> {{$product->monthly_rent}}/-</div>
                        <div class="uk-width-1-3"><h5 class="uk-text-muted"><b>Posted by</b></h5>{{ $product->profile->user_type }}</div>
                        <div class="uk-width-1-3"><h5 class="uk-text-muted"><b>Date</b></h5>{{$product->created_at->format('d-m-Y')}}</div>
                    </div>
                    <div class="uk-grid uk-margin-top uk-grid-small">
                        <div class="uk-width-1-3"><h5 class="uk-text-muted"><b>Facilities Available</b></h5>{{ $product->facilities_available }}</div>
                        <div class="uk-width-1-3"><h5 class="uk-text-muted"><b>Location</b></h5>{{ $product->location }}</div>
                        <div class="uk-width-1-3"><h5 class="uk-text-muted"><b>Category</b></h5>{{ $product->category }}</div>
                    </div>
                    <div class="uk-margin-top">
                    <b class="uk-text-muted">Available in</b> <a href="{{ URL::route('getFlatmatesKeywordSearchResult',array('college_id',$product->profile->college_id))}}">{{ $product->profile->college_id }}</a>
                    <a class="uk-align-right uk-button uk-button-primary" href="{{ URL::route('getFlatmatesDetails',$product->ad_title .'~'.$product->id)}}" target="blank" >View More</a>
                    
                    </div>
                </div>
            </div>
            <hr class="uk-margin-bottom">
        </section>
    @endforeach
    {{$products->links()}}