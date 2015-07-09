@extends('layout.default')

@section('head')
@parent
<title>Donate Books | Mycollegeadda</title>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
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
            <li class="uk-active"><span>Donate Books</span></li>
        </ul>
          <h2>Donate your book here</h2>
          <p class="uk-article-lead uk-text-primary">Post Details of the Book you want to Donate to your College Library</p>
          <div class="uk-panel uk-panel-box uk-panel-box-secondary">
            <div class="uk-text-danger uk-text-right">*Mandatory Fields</div>
          
          <form class="uk-form uk-form-horizontal" method="post" enctype="multipart/form-data" action="{{ URL::route('postDonateBooks')}}">
            <div class="uk-form-row">
                <label class="uk-form-label" for="college_name">Posting in College</label>
                <div class="uk-form-controls">
                    <input type="text" id="college_name" class="uk-form-large uk-width-medium-1-2" value="{{ $college_id }}" disabled data-uk-tooltip="{pos:'right',offset:20}" title="This is the college name as selected in your profile">
                </div>
            </div>
            <div class="uk-form-row">
              <label class="uk-form-label" for="book_name">Book Name<span class="uk-text-danger">*</span></label>
                <div class="uk-form-controls">
                  <div id="divDescription"></div>
                  <input type="text" id="txtBookSearch" class="uk-form-large uk-width-medium-1-2{{ ($errors->has('book_name')) ? ' uk-form-danger' : ''}}" name="book_name"{{ (Input::old('book_name'))? 'value="'. e(Input::old('book_name')) . '"' : ''}} id="book_name" placeholder="Enter name of the book" data-uk-tooltip="{pos:'right',offset:20}" title="You may use autocomplete to fill the details">
                  @if($errors->has('book_name'))
                  {{ $errors->first('book_name')}}
                  @endif
                </div>
            </div>
            <div class="uk-form-row">
                  <label class="uk-form-label" for="author_name">Author Name</label>
                  <div class="uk-form-controls">
                    <input type="text" id="author_name" class="uk-form-large uk-width-medium-1-2{{ ($errors->has('author_name')) ? ' uk-form-danger' : ''}}" name="author_name"{{ (Input::old('author_name'))? 'value="'. e(Input::old('author_name')) . '"' : ''}} id="author_name" placeholder="Enter Author of the book" data-uk-tooltip="{pos:'right',offset:20}" title="In case of multiple authors use comma">
                    @if($errors->has('author_name'))
                    {{ $errors->first('author_name')}}
                    @endif
                  </div>
            </div>
            <div class="uk-form-row">
                  <label for="book_edition" class="uk-form-label">Book Edition</label>
                  <div class="uk-form-controls">
                    <input type="text"  id="book_edition" class="uk-form-large uk-width-medium-1-2{{ ($errors->has('book_edition')) ? ' uk-form-danger' : ''}}" name="book_edition"{{ (Input::old('book_edition'))? 'value="'. e(Input::old('book_edition')) . '"' : ''}} id="book_edition" placeholder="Enter edition of the book">
                    @if($errors->has('book_edition'))
                    {{ $errors->first('book_edition')}}
                    @endif
                  </div>
          </div>
          <div class="uk-form-row">
                  <label for="print_year" class="uk-form-label">Print Year</label>
                  <div class="uk-form-controls">
                    <input type="text"  id="print_year" class="uk-form-large uk-width-medium-1-2{{ ($errors->has('print_year')) ? ' uk-form-danger' : ''}}" name="print_year"{{ (Input::old('print_year'))? 'value="'. e(Input::old('print_year')) . '"' : ''}} id="print_year" placeholder="Enter print year of the book">
                    @if($errors->has('print_year'))
                    {{ $errors->first('print_year')}}
                    @endif
                  </div>
          </div>
          <div class="uk-form-row">
                  <label for="book_condition" class="uk-form-label">Book Condition<span class="uk-text-danger">*</span></label>
                  <div class="uk-form-controls {{ ($errors->has('book_condition')) ? ' uk-form-danger' : ''}}">
                    <div class="uk-grid">
                        <div class="uk-width-1-4"><label><input type="radio" name="book_condition" id="book_condition1" value="Excellent"> Excellent</label></div>
                        <div class="uk-width-1-4"><label><input type="radio" name="book_condition" id="book_condition2" value="Very Good"> Very Good</label></div>
                    </div>
                    <div class="uk-grid">
                        <div class="uk-width-1-4"><label><input type="radio" name="book_condition" id="book_condition3" value="Good"> Good</label></div>
                        <div class="uk-width-1-4"><label><input type="radio" name="book_condition" id="book_condition4" value="Acceptable"> Acceptable</label></div>
                    </div>
                    @if($errors->has('book_condition'))
                    {{ $errors->first('book_condition')}}
                    @endif
                  </div>
          </div>
          <div class="uk-form-row">
                  <label for="isbn" class="uk-form-label">ISBN</label>
                  <div class="uk-form-controls">
                    <input type="text"  id="isbn" class="uk-form-large uk-width-medium-1-2{{ ($errors->has('isbn')) ? ' uk-form-danger' : ''}}" name="isbn"{{ (Input::old('isbn'))? 'value="'. e(Input::old('isbn')) . '"' : ''}} id="isbn" placeholder="Enter printed isbn on book">
                    @if($errors->has('isbn'))
                    {{ $errors->first('isbn')}}
                    @endif
                  </div>
          </div>
          <div class="uk-form-row">
                  <label for="publisher" class="uk-form-label">Publisher</label>
                  <div class="uk-form-controls">
                    <input type="text"  id="publisher" class="uk-form-large uk-width-medium-1-2{{ ($errors->has('publisher')) ? ' uk-form-danger' : ''}}" name="publisher"{{ (Input::old('publisher'))? 'value="'. e(Input::old('publisher')) . '"' : ''}} id="publisher" placeholder="Enter publication of book">
                    @if($errors->has('publisher'))
                    {{ $errors->first('publisher')}}
                    @endif
                  </div>
          </div>
          <div class="uk-form-row">
                <label for="category" class="uk-form-label">Category</label>
                <div class="uk-form-controls">
                  <select data-toggle="select" class="uk-form-large uk-width-medium-1-2{{ ($errors->has('category')) ? ' uk-form-danger' : ''}}" name="category" id="category" class="form-control">
                    @foreach($category as $cat)
                      <option value="{{ $cat->category_name }}">{{ $cat->category_name }}</option>
                    @endforeach
                    <option value="Others">Others</option>
                  </select>
                  @if($errors->has('category'))
                  {{ $errors->first('category')}}
                  @endif
                </div>
          </div>
          <div class="uk-form-row">
                  <label for="book_description" class="uk-form-label">Book Description</label>
                  <div class="uk-form-controls">
                    <textarea  id="book_description" placeholder="Enter any additional info if you want to provide" class="uk-form-large uk-width-medium-1-2{{ ($errors->has('book_description')) ? ' uk-form-danger' : ''}}" name="book_description" id="book_description" rows="4">{{ (Input::old('book_description'))? e(Input::old('book_description')) : ''}}</textarea>
                    @if($errors->has('book_description'))
                    {{ $errors->first('book_description')}}
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
                <input type="checkbox" value="" id="checkbox1" required> <label for="checkbox1">I Agree all the <a href="{{ url('termsofservice') }}">terms and conditions.</a></label>
              </div>
          </div>
          {{ Form::token() }}
          <div class="uk-form-row">
              <span class="uk-form-label"></span>
              <div class="uk-form-controls uk-form-controls-text">
                <button type="submit" class="uk-button uk-button-primary">Submit for Donation</button>
              </div>
          </div>
        </div>
      
      </article>
      <article class="uk-width-medium-2-10">
        @include('layout.rsidebar') 
      </article>
      </div>
</section>
@stop