@extends('layout.default')

@section('head')
@parent
<title>Browse Carpool | Mycollegeadda</title>
@stop
@section('select_category')
<a href="">Car Pool <i class="uk-icon-caret-down"></i></a>

<div class="uk-dropdown uk-dropdown-navbar">
  <ul class="uk-nav uk-nav-navbar">
      <li><a style="color:black;" href="{{ URL::route('getBooksSearchQueryResult')}}">Books</a></li>
      <li><a style="color:black;" href="{{ URL::route('getNotesSearchQueryResult')}}">Notes</a></li>
      <li><a style="color:black;" href="{{ URL::route('getElectronicsSearchQueryResult')}}">Electronics</a></li>
      <li><a style="color:black;" href="{{ URL::route('getFlatmatesSearchQueryResult')}}">Flatmates</a></li>
  </ul>
</div>
@stop
@section('content')
<div class="uk-container uk-container-center">
    <div class="uk-grid uk-grid-divider">
    <article class="uk-width-medium-2-10" style="padding-right:0px;">
        <div>
            <h3>Categories</h3>
            <ul class="uk-nav uk-nav-side uk-nav-parent-icon uk-hidden-small" data-uk-nav>
                @foreach($category as $categorym)
                    <li class="category_nav" value="{{ $categorym->category_name }}"><a href="">{{ $categorym->category_name }}</a></li>
                @endforeach
            </ul>
            <div class="uk-form-row uk-form uk-hidden-medium uk-hidden-large uk-margin-bottom">
                <select>
                 @foreach($category as $categorys)
                    <option class="category_nav" value="{{ $categorys->category_name }}">{{ $categorys->category_name }}</option>
                @endforeach   
                </select>
            </div>
        </div>         
    </article>
    <article class="uk-article uk-width-medium-8-10">
        <ul class="uk-breadcrumb">
            <li><a href="{{ URL::route('home')}}">Home</a></li>
            <li class="uk-active"><span>Car Pool</span></li>
        </ul>
        <h2 class="mca-page-title">Car Pool</h2>
        <div class="uk-hidden-small uk-margin-bottom mca-refiner">
            <span class="uk-text-bold">{{ count($products) }} results showing</span>
            <div class="uk-align-right">
                <b>Sort By: </b><a href="#"> Relevance</a> <a href="#">Newest</a> |
                <b>Price: </b><a href="#">Low</a> <a href="#">High</a>
            </div>
        </div>
        <div class="productContent">
        @include('utility.ajax.carpool')
        </div>
    </article>
    </div>
</div>

<!-- SCRIPT FOR PAGINATION -->

<script>
    $('.spinner').hide();
    $(document).on('click','.pagination a', function(e){
        e.preventDefault();

        var page = $(this).attr('href').split('page=')[1];

        getProducts(page);
    });

    function getProducts(page){
        $('.spinner').show();
        $.ajax({
            url:'ajax/carpool?page='+ page
        }).done(function(data){
            $('.spinner').hide();
            $('.productContent').html(data);
            location.hash = page;
        });
    }

</script>

<script type="text/javascript">
    $('#searchForm').on('submit',function(e) {
        $('.spinner').show();
        e.preventDefault();
        $.ajax({
            type: "GET",
            url: "{{ URL::route('getCarPoolSearchResultAJAX') }}",
            data: {searchQuery: $(this).find( 'input[name=searchQuery]' ).val()},
            success: function(data) {
                $('.spinner').hide();
                $('.productContent').html(data).show();
                }
            });
        return false;
    });
</script>

<script type="text/javascript">
    $('.category_nav').on('click',function(e) {
        $('.spinner').show();
        e.preventDefault();
        $.ajax({
            type: "GET",
            url: "{{ URL::route('getCarPoolSearchResultAJAX') }}",
            data: {searchQuery: $(this).attr('value')},
            success: function(data) {
                $('.spinner').hide();
                $('.productContent').html(data).show();
                }
            });
        return false;
    });
</script>

@stop