@extends('layout.default')

@section('head')
@parent
<title>{{ Auth::user()->username}} | Mycollegeadda</title>
{{ HTML::script('js/components/tooltip.min.js') }}
@stop


@section('content_heading')
<header class="major">
<h3>Update Profile</h3>
<h6>Keep your profile updated</h6>
</header>
@stop
      
@section('content')
<section class="uk-container uk-container-center">
          <div class="uk-grid">
      <article class="uk-article uk-width-medium-8-10">
        <ul class="uk-breadcrumb">
            <li><a href="{{ URL::route('home')}}">Home</a></li>
            <li class="uk-active"><span>Manage Profile</span></li>
        </ul>
          <h2>Manage Profile</h2>
          <p class="uk-article-lead uk-text-primary">Hello <b>{{ Auth::user()->username}}</b>, please keep your profile updated.</p>
          <div class="uk-panel uk-panel-box uk-panel-box-secondary">
            <div class="uk-text-danger uk-text-right">*Mandatory Fields</div>
          
          <form class="uk-form uk-form-horizontal" id="manageProfile" method="post" enctype="multipart/form-data" action="{{ URL::route('postManageProfile')}}">
              <div class="uk-form-row">
                    <label for="user_type" class="uk-form-label">You are<span class="uk-text-danger">*</span></label>
                    <div class="uk-form-controls {{ ($errors->has('user_type')) ? ' uk-form-danger' : ''}}">
                      <div class="uk-grid">
                          <div class="uk-width-1-4"><label><input type="radio" name="user_type" id="user_type1" value="Individual" <?php if($profiles->user_type == "Individual"){ echo "checked=\"yes\""; }?>> Individual</label></div>
                          <div class="uk-width-1-4"><label><input type="radio" name="user_type" id="user_type2" value="Dealer" <?php if($profiles->user_type == "Dealer"){ echo "checked=\"yes\""; }?>> Dealer</label></div>
                      </div>
                      @if($errors->has('user_type'))
                      {{ $errors->first('user_type')}}
                      @endif
                    </div>
            </div>
            <div class="uk-form-row">
              <label class="uk-form-label" for="college_id">College Name<span class="uk-text-danger">*</span></label>
                <div class="uk-form-controls">
                  <input type="text" id="txtBookSearch" list="colleges" value="{{ $profiles->college_id}}" class="uk-form-large uk-width-medium-1-2{{ ($errors->has('college_id')) ? ' uk-form-danger' : ''}}" name="college_id"{{ (Input::old('college_id'))? 'value="'. e(Input::old('college_id')) . '"' : ''}} id="college_id" placeholder="Enter your college name" data-uk-tooltip="{pos:'right',offset:20}" title="Select your college from the list if it is not there, type full name of your college">
                  @if($errors->has('college_id'))
                  {{ $errors->first('college_id')}}
                  @endif
                </div>
                <datalist id="colleges">
                @foreach($college_id as $college)
                <option value="{{ $college->name}}">
                @endforeach
              </datalist>
            </div>
            <div class="uk-form-row">
                  <label class="uk-form-label" for="contact">Mobile No.<span class="uk-text-danger">*</span></label>
                  <div class="uk-form-controls">
                    <input type="text" id="contact" value="{{ $profiles->contact}}" class="uk-form-large uk-width-medium-1-2{{ ($errors->has('contact')) ? ' uk-form-danger' : ''}}" name="contact"{{ (Input::old('contact'))? 'value="'. e(Input::old('contact')) . '"' : ''}} id="contact" placeholder="Enter your contact number">
                    @if($errors->has('contact'))
                    {{ $errors->first('contact')}}
                    @endif
                  </div>
            </div>
            <div class="uk-form-row">
                  <label for="city" class="uk-form-label">City<span class="uk-text-danger">*</span></label>
                  <div class="uk-form-controls">
                    <input type="text"  id="city" list="cities" value="{{ $profiles->city}}" class="uk-form-large uk-width-medium-1-2{{ ($errors->has('city')) ? ' uk-form-danger' : ''}}" name="city"{{ (Input::old('city'))? 'value="'. e(Input::old('city')) . '"' : ''}} id="city" placeholder="Enter your city name">
                    @if($errors->has('city'))
                    {{ $errors->first('city')}}
                    @endif
                  </div>
                  <datalist id="cities">
                  @foreach($city as $city_name)
                  <option value="{{ $city_name->city_name}}">
                  @endforeach
                </datalist>
          </div>
          <div class="uk-form-row">
              <span class="uk-form-label"></span>
              <div class="uk-form-controls uk-form-controls-text">
                <input type="checkbox" value="" id="checkbox1" required> <label for="checkbox1">I Agree all the <a href="{{ url('termsofservice') }}">terms and conditions.</a></label>
              </div>
          </div>
          {{ Form::token() }}
          <div class="uk-form-row">
              <span class="uk-form-label"></span>
              <div class="uk-form-controls uk-form-controls-text">
                <button type="submit" class="uk-button uk-button-primary" id="update">Update Profile</button>
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


<script type="text/javascript">
$('.spinner').show();
    $('#manageProfile').on('submit',function(e) {
        $('#update').html("Updating...").addClass("disabled");
        e.preventDefault();
        $.ajax({
            type: "post",
            url: "{{ URL::route('postManageProfile') }}",
            data: {user_type: $(this).find( 'input[name=user_type]' ).val(),
                   college_id: $(this).find( 'input[name=college_id]' ).val(),
                   contact: $(this).find( 'input[name=contact]' ).val(),
                   city: $(this).find( 'input[name=city]' ).val(),
                   _token: $(this).find( 'input[name=_token]' ).val() },
            success: function(data) {
                console.log(data);
                $('#update').html("Updated Succesfully").removeClass("disabled");
                }
            });
        return false;
    });
</script>

@stop