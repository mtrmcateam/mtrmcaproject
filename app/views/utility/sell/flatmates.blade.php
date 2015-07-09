@extends('layout.default')

@section('head')
@parent
<title>Find Flatmates | Mycollegeadda</title>
{{ HTML::script('js/components/tooltip.min.js') }}
{{ HTML::script('js/components/upload.min.js') }}
{{ HTML::script('js/getbooks.js') }}
@stop
      
@section('content')
<section class="uk-container uk-container-center">
          <div class="uk-grid">
      <article class="uk-article uk-width-medium-8-10">
        <ul class="uk-breadcrumb">
            <li><a href="{{ URL::route('home')}}">Home</a></li>
            <li><a href="{{ URL::route('getSell')}}">Sell</a></li>
            <li class="uk-active"><span>Flatmates</span></li>
        </ul>
          <h2> Post Ad to Find Flatmates</h2>
          <p class="uk-article-lead uk-text-primary">Post details of the flat to let buyer find you</p>
          <div class="uk-panel uk-panel-box uk-panel-box-secondary">
            <div class="uk-text-danger uk-text-right">*Mandatory Fields</div>
          
          <form class="uk-form uk-form-horizontal" method="post" enctype="multipart/form-data" action="{{ URL::route('postSellFlatmates')}}">
            <div class="uk-form-row">
                <label class="uk-form-label" for="college_name">Posting in College</label>
                <div class="uk-form-controls">
                    <input type="text" id="college_name" class="uk-form-large uk-width-medium-1-2" value="{{ $college_id }}" disabled data-uk-tooltip="{pos:'right',offset:20}" title="This is the college name as selected in your profile">
                </div>
            </div>
            <div class="uk-form-row">
              <label class="uk-form-label" for="ad_title">Ad Title<span class="uk-text-danger">*</span></label>
                <div class="uk-form-controls">
                  <div id="divDescription"></div>
                  <input type="text" id="txtBookSearch" class="uk-form-large uk-width-medium-1-2{{ ($errors->has('ad_title')) ? ' uk-form-danger' : ''}}" name="ad_title"{{ (Input::old('ad_title'))? 'value="'. e(Input::old('ad_title')) . '"' : ''}} id="ad_title" placeholder="Enter a suitable title for your Ad" data-uk-tooltip="{pos:'right',offset:20}" title="Keep your title Brief and Precise">
                  @if($errors->has('ad_title'))
                  {{ $errors->first('ad_title')}}
                  @endif
                </div>
            </div>
            <div class="uk-form-row">
                <label for="category" class="uk-form-label">Accomodation Type</label>
                <div class="uk-form-controls">
                  <select data-toggle="select" class="uk-form-large uk-width-medium-1-2{{ ($errors->has('category')) ? ' uk-form-danger' : ''}}" name="category" id="category" class="form-control">
                    @foreach($category as $cat)
                      <option value="{{ $cat->category_name }}">{{ $cat->category_name }}</option>
                    @endforeach
                  </select>
                  @if($errors->has('category'))
                  {{ $errors->first('category')}}
                  @endif
                </div>
          </div>
            <div class="uk-form-row">
                  <label class="uk-form-label" for="location">Location<span class="uk-text-danger">*</span></label>
                  <div class="uk-form-controls">
                    <textarea id="location" class="uk-form-large uk-width-medium-1-2{{ ($errors->has('location')) ? ' uk-form-danger' : ''}}" name="location"{{ (Input::old('location'))? 'value="'. e(Input::old('location')) . '"' : ''}} id="location" placeholder="Enter the location of Flat/House/PG" ></textarea>
                    @if($errors->has('location'))
                    {{ $errors->first('location')}}
                    @endif
                  </div>
            </div>
            <div class="uk-form-row">
                  <label class="uk-form-label" for="facilities_available">Facilities Available</label>
                  <div class="uk-form-controls">
                    <input type="text" id="facilities_available" class="uk-form-large uk-width-medium-1-2{{ ($errors->has('facilities_available')) ? ' uk-form-danger' : ''}}" name="facilities_available"{{ (Input::old('facilities_available'))? 'value="'. e(Input::old('facilities_available')) . '"' : ''}} id="facilities_available" placeholder="Enter the facilites available" data-uk-tooltip="{pos:'right',offset:20}" title="You can tell facilities like tv, ac, fridge, wifi, etc are available or not">
                    @if($errors->has('facilities_available'))
                    {{ $errors->first('facilities_available')}}
                    @endif
                  </div>
            </div>
          <div class="uk-form-row">
                  <label for="monthly_rent" class="uk-form-label">Monthly Rent<span class="uk-text-danger">*</span></label>
                  <div class="uk-form-controls">
                    <input type="text"  class="uk-form-large uk-width-medium-1-2{{ ($errors->has('monthly_rent')) ? ' uk-form-danger' : ''}}" name="monthly_rent"{{ (Input::old('monthly_rent'))? 'value="'. e(Input::old('monthly_rent')) . '"' : ''}} id="monthly_rent" placeholder="Enter monthly rent">
                    @if($errors->has('monthly_rent'))
                    {{ $errors->first('monthly_rent')}}
                    @endif
                  </div>
          </div>
          <div class="uk-form-row">
                  <label for="ad_description" class="uk-form-label">Ad Description<span class="uk-text-danger">*</span></label>
                  <div class="uk-form-controls">
                    <textarea  id="ad_description" rows="4" placeholder="Enter any additional info if you want to provide" class="uk-form-large uk-width-medium-1-2{{ ($errors->has('ad_description')) ? ' uk-form-danger' : ''}}" name="ad_description" id="ad_description" rows="4">{{ (Input::old('ad_description'))? e(Input::old('ad_description')) : ''}}</textarea>
                    @if($errors->has('ad_description'))
                    {{ $errors->first('ad_description')}}
                    @endif
                  </div>
           </div>
<!-- *********************************************** UPLOAD PHOTO START ******************************************************* -->
          <div class="uk-form-row">
            <label for="photo" class="uk-form-label">Upload Photo</label>
            <div class="uk-form-controls">
              <div id="upload-drop" class="uk-placeholder uk-text-center">
                  <i class="uk-icon-cloud-upload uk-icon-medium uk-text-muted uk-margin-small-right"></i> Upload photos by dropping them here or <a class="uk-form-file">selecting one<input name="photo[]" id="photo" multiple type="file"></a>.
              </div>
              <div id="progressbar" class="uk-progress uk-hidden">
                  <div class="uk-progress-bar" style="width: 0%;">0%</div>
              </div>
              <span id="complete"></span>
              <div class="col-lg-12">
              <div id="bookCover"></div>
              <div id="results" style="display:none">
                        <!-- Your captured image will appear here... -->
              </div>
              </div>
              @if($errors->has('photo'))
              {{ $errors->first('photo')}}
              @endif
            </div>
          </div>
<!-- *********************************************** UPLOAD PHOTO ENDS ******************************************************* -->
          <div class="uk-form-row">
              <span class="uk-form-label"></span>
              <div class="uk-form-controls uk-form-controls-text">
                <input type="checkbox" value="" id="checkbox1" required> <label for="checkbox1">I Agree all the <a target="_blank" href="{{ url('termsofservice') }}">terms and conditions.</a></label>
              </div>
          </div>
          {{ Form::token() }}
          <div class="uk-form-row">
              <span class="uk-form-label"></span>
              <div class="uk-form-controls uk-form-controls-text">
                <button type="submit" class="uk-button uk-button-primary">Post your Ad</button>
              </div>
          </div>
        </form>
        </div>
      
      </article>
      <article class="uk-width-medium-2-10">
        @include('layout.rsidebar') 
      </article>
      </div>
</section>

@if(Session::has('modal'))
<!-- Share Modal HTML <a href="#modal" data-uk-modal="">Open</a>-->
<div id="modal" class="uk-modal" aria-hidden="true" style="display: none; overflow-y: scroll;">
  <div class="uk-modal-dialog uk-modal-dialog-large">
      <a href="" class="uk-modal-close uk-close"></a>
      <h1>Social Share</h1>
      <p>Share your ad on popular social networks to quickly find buyer.</p>
      <div class="uk-grid uk-width-medium-1-2 ">
          <div class="uk-width-medium-1-3">
            <a href="#" onclick="window.open('https://www.facebook.com/dialog/feed?app_id=435206653312400&redirect_uri=http://mycollegeadda.com&link=http://mycollegeadda.com/&caption=MYCOLLEGEADAA.COM&description=I have posted item on mycollegeadda.com, do you want to purchase it?','facebook-share-dialog','width=626,height=436');return false;" class="uk-button uk-width-1-1 uk-button-large uk-button-facebook"> Facebook</a></div>
          <div class="uk-width-medium-1-3"><a href="https://plus.google.com/u/0/+Mycollegeaddapage" class="uk-button uk-width-1-1 uk-button-large uk-button-google"> Google+</a></div>
          <div class="uk-width-medium-1-3"><a href="https://twitter.com/Mycollegeadda" class="uk-button uk-width-1-1 uk-button-large uk-button-primary"> Twitter</a></div>
      </div>
      <hr>
      <h1>Your Coupons</h1>
      <div class="uk-grid tm-grid-truncate" data-uk-grid-margin="">
        @foreach(Session::get('coupons') as $coupon)
            <div class="uk-width-medium-1-4">
                <div class="uk-panel uk-panel-box uk-panel-box-secondary">
                      <img src="../images/coupon_logos/{{ $coupon->campaign }}.jpg" class="uk-align-center" alt="{{ $coupon->campaign }}">
                    <h3 class="uk-panel-title">{{ $coupon->campaign }}</h3>
                    {{ $coupon->coupon_title }}
                    <a href="{{ $coupon->landing_page }}" target="_blank" class="uk-button uk-width-1-1 uk-button-danger uk-margin-top">COUPON CODE:  {{ $coupon->coupon_code }}</a>
                </div>
            </div>
          @endforeach
        </div>
      <div class="uk-modal-footer uk-text-right">
          <button type="button" class="uk-button uk-modal-close">No Thanks</button>
      </div>
  </div>
</div>
  @endif
<!-- modal call -->
  @if(Session::has('modal'))
  <script type="text/javascript">
  var modal = UIkit.modal("#modal");
  if ( modal.isActive() ) {
      modal.hide();
  } else {
      modal.show();
  }
  </script>
  @endif
  
@stop
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=places"></script>

    <script>

    function initialize() {


    var defaultBounds = new google.maps.LatLngBounds(
      new google.maps.LatLng(41.8160,-71.4001)
      );

    var origin_input = document.getElementById('location');
    var destination_input = document.getElementById('destination_location');


    var options = {
      bounds: defaultBounds,
      componentRestrictions: {country: 'ind'}
    };


    var autocomplete_origin = new google.maps.places.Autocomplete(origin_input, options);    
    var autocomplete_destination = new google.maps.places.Autocomplete(destination_input, options);
    }

    google.maps.event.addDomListener(window, 'load', initialize);


    </script>