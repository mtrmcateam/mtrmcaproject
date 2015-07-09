@extends('layout.default')

@section('head')
@parent
<title>Give Feedback | Mycollegeadda</title>
@stop
      
@section('content')
<section class="uk-container uk-container-center">
          <div class="uk-grid">
      <article class="uk-article uk-width-medium-8-10">
        <ul class="uk-breadcrumb">
            <li><a href="{{ URL::route('home')}}">Home</a></li>
            <li class="uk-active"><span>Feedback</span></li>
        </ul>
          <h2>Give us your Feedback</h2>
          <div class="uk-panel uk-panel-box uk-panel-box-secondary">
            <div class="uk-text-danger uk-text-right">*Mandatory Fields</div>
          
          <form class="uk-form uk-form-horizontal" method="post" enctype="multipart/form-data" action="{{ URL::route('postFeedback')}}">
            <div class="uk-form-row">
              <label class="uk-form-label" for="full_name">Name<span class="uk-text-danger">*</span></label>
                <div class="uk-form-controls">
                  <div id="divDescription"></div>
                  <input type="text" id="name" class="uk-form-large uk-width-medium-1-2{{ ($errors->has('full_name')) ? ' uk-form-danger' : ''}}" name="full_name"{{ (Input::old('full_name'))? 'value="'. e(Input::old('full_name')) . '"' : ''}} id="full_name" placeholder="Enter name">
                  @if($errors->has('full_name'))
                  {{ $errors->first('full_name')}}
                  @endif
                </div>
            </div>
            <div class="uk-form-row">
                  <label class="uk-form-label" for="email">Email<span class="uk-text-danger">*</span></label>
                  <div class="uk-form-controls">
                    <input type="text" id="email" class="uk-form-large uk-width-medium-1-2{{ ($errors->has('email')) ? ' uk-form-danger' : ''}}" name="email"{{ (Input::old('email'))? 'value="'. e(Input::old('email')) . '"' : ''}} id="email" placeholder="Enter valid e-mail address">
                    @if($errors->has('email'))
                    {{ $errors->first('email')}}
                    @endif
                  </div>
            </div>
          <div class="uk-form-row">
                  <label for="message" class="uk-form-label">Message<span class="uk-text-danger">*</span></label>
                  <div class="uk-form-controls">
                    <textarea  id="message" placeholder="Write your valuable feedback here..." class="uk-form-large uk-width-medium-1-2{{ ($errors->has('message')) ? ' uk-form-danger' : ''}}" name="message" id="message" rows="4">{{ (Input::old('message'))? e(Input::old('message')) : ''}}</textarea>
                    @if($errors->has('message'))
                    {{ $errors->first('message')}}
                    @endif
                  </div>
           </div>
          {{ Form::token() }}
          <div class="uk-form-row">
              <span class="uk-form-label"></span>
              <div class="uk-form-controls uk-form-controls-text">
                <button type="submit" class="uk-button uk-button-primary">Submit</button>
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

<!-- Share Modal HTML <a href="#modal" data-uk-modal="">Open</a>-->
<div id="modal" class="uk-modal" aria-hidden="true" style="display: none; overflow-y: scroll;">
  <div class="uk-modal-dialog" style="top: 113px;">
      <a href="" class="uk-modal-close uk-close"></a>
      <h1>Social Share</h1>
      <p>Share your ad on popular social networks to quickly find buyer.</p>
      <div class="uk-grid">
          <div class="uk-width-1-3">
            <a href="#" onclick="window.open('https://www.facebook.com/dialog/feed?app_id=435206653312400&redirect_uri=http://mycollegeadda.com&link=http://mycollegeadda.com/&caption=MYCOLLEGEADAA.COM&description=I have posted item on mycollegeadda.com, do you want to purchase it?','facebook-share-dialog','width=626,height=436');return false;" class="uk-button uk-width-1-1 uk-button-large uk-button-facebook"> Facebook</a></div>
          <div class="uk-width-1-3"><a href="#" class="uk-button uk-width-1-1 uk-button-large uk-button-google"> Google+</a></div>
          <div class="uk-width-1-3"><a href="#" class="uk-button uk-width-1-1 uk-button-large uk-button-primary"> Twitter</a></div>
      </div>
      <div class="uk-modal-footer uk-text-right">
          <button type="button" class="uk-button uk-modal-close">No Thanks</button>
      </div>
  </div>
</div>



  @if(Session::has('modal'))
  <script type="text/javascript">
  $("{{ Session::get('modal') }}").modal('show');
  </script>
  @endif
@stop