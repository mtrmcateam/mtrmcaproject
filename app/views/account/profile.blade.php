@extends('layout.default')

@section('head')
@parent
<title>{{ Auth::user()->username}} | Mycollegeadda</title>
@stop
      
@section('content')
<section class="uk-container uk-container-center uk-margin-large-top">
<h2>My Profile</h2>
<hr>
<div class="uk-grid uk-panel uk-panel-box">
      <div class="uk-width-1-10">
            @if (Auth::user()->photo)
              <img src="{{ Auth::user()->photo}}"/>
            @else
              <img src="{{ route('home'); }}/images/avtar.png"/>
            @endif
      </div>
      <div class="uk-width-9-10">
            <h2>{{ Auth::user()->username}}</h2>
            <small>{{ Auth::user()->email}}</small>
      </div>
</div>
<div class="uk-grid uk-panel uk-panel-box">
      <div class="uk-panel-badge uk-badge uk-badge-danger"><a style="color:white;" href="{{ URL::route('getManageProfile') }}">Edit</a></div>
      <h2>Profile Details</h2><br>
      <dl class="uk-description-list-horizontal">
        <dt>College Name</dt>
        <dd>{{ $profile->college_id}}</dd>
        <dt>Mobile No.</dt>
        <dd>{{ $profile->contact}}</dd>
        <dt>City</dt>
        <dd>{{ $profile->city}}</dd>
        <dt>User Type</dt>
        <dd>{{ $profile->user_type}}</dd>
    </dl>
</div>
<div class="uk-margin-top">
      <h3>Items Posted by You</h3>
      <ul class="uk-tab" data-uk-tab="{connect:'#tab-content'}">
          <li class="uk-active" aria-expanded="true"><a href="#">Books</a></li>
          <li aria-expanded="false" class=""><a href="#">Notes</a></li>
          <li aria-expanded="false" class=""><a href="#">Electronics</a></li>
          <li aria-expanded="false" class=""><a href="#">Car Pool</a></li>
          <li aria-expanded="false" class=""><a href="#">Flatmates</a></li>
      <li class="uk-tab-responsive uk-active uk-hidden" aria-haspopup="true" aria-expanded="false"><a>Tab</a><div class="uk-dropdown uk-dropdown-small"><ul class="uk-nav uk-nav-dropdown"></ul><div></div></div></li></ul>

      <ul id="tab-content" class="uk-switcher uk-margin">
          <li class="uk-active" aria-hidden="false">
            <div class="uk-overflow-container">
                  @if(count($books_posted) > 0)
              <table class="uk-table uk-table-hover uk-table-striped uk-table-condensed">
                  <thead>
                      <tr>
                          <th>Book Name</th>
                          <th>Posted On</th>
                          <th>View Ad</th>
                      </tr>
                  </thead>
                  <tbody>
                  @foreach($books_posted as $books)
                      <tr>
                          <td>{{$books->book_name}}</td>
                          <td>{{$books->created_at}}</td>
                          <td><a href="{{ URL::route('getBooksDetails',$books->book_name .'~'.$books->id)}}" target="_blank">View</a></td>
                      </tr>
                  @endforeach
                  </tbody>
              </table>
              @else
                  <p>You have not posted anything in this category.<p>
              @endif
          </div>
          </li>
          <li aria-hidden="true" class="">
            <div class="uk-overflow-container">
                  @if(count($notes_posted) > 0)
              <table class="uk-table uk-table-hover uk-table-striped uk-table-condensed">
                  <thead>
                      <tr>
                          <th>Ad Title</th>
                          <th>Posted On</th>
                          <th>View Ad</th>
                      </tr>
                  </thead>
                  <tbody>
                  @foreach($notes_posted as $notes)
                      <tr>
                          <td>{{$notes->ad_title}}</td>
                          <td>{{$notes->created_at}}</td>
                          <td><a href="{{ URL::route('getNotesDetails',$notes->ad_title .'~'.$notes->id)}}" target="_blank">View</a></td>
                      </tr>
                  @endforeach
                  </tbody>
              </table>
              @else
                  <p>You have not posted anything in this category.<p>
              @endif
          </div>
          </li>
          <li aria-hidden="true" class="">
            <div class="uk-overflow-container">
                  @if(count($electronics_posted) > 0)
              <table class="uk-table uk-table-hover uk-table-striped uk-table-condensed">
                  <thead>
                      <tr>
                          <th>Ad Title</th>
                          <th>Posted On</th>
                          <th>View Ad</th>
                      </tr>
                  </thead>
                  <tbody>
                  @foreach($electronics_posted as $notes)
                      <tr>
                          <td>{{$notes->ad_title}}</td>
                          <td>{{$notes->created_at}}</td>
                          <td><a href="{{ URL::route('getElectronicsDetails',$notes->ad_title .'~'.$notes->id)}}" target="_blank">View</a></td>
                      </tr>
                  @endforeach
                  </tbody>
              </table>
              @else
                  <p>You have not posted anything in this category.<p>
              @endif
          </div>
          </li>
          <li aria-hidden="true" class="">
            <div class="uk-overflow-container">
                  @if(count($carpool_posted) > 0)
              <table class="uk-table uk-table-hover uk-table-striped uk-table-condensed">
                  <thead>
                      <tr>
                          <th>Ad Title</th>
                          <th>Posted On</th>
                          <th>View Ad</th>
                      </tr>
                  </thead>
                  <tbody>
                  @foreach($carpool_posted as $notes)
                      <tr>
                          <td>{{$notes->ad_title}}</td>
                          <td>{{$notes->created_at}}</td>
                          <td><a href="{{ URL::route('getCarPoolDetails',$notes->ad_title .'~'.$notes->id)}}" target="_blank">View</a></td>
                      </tr>
                  @endforeach
                  </tbody>
              </table>
              @else
                  <p>You have not posted anything in this category.<p>
              @endif
          </div>
          </li>
          <li aria-hidden="true" class="">
            <div class="uk-overflow-container">
                  @if(count($flatmates_posted) > 0)
              <table class="uk-table uk-table-hover uk-table-striped uk-table-condensed">
                  <thead>
                      <tr>
                          <th>Ad Title</th>
                          <th>Posted On</th>
                          <th>View Ad</th>
                      </tr>
                  </thead>
                  <tbody>
                  @foreach($flatmates_posted as $notes)
                      <tr>
                          <td>{{$notes->ad_title}}</td>
                          <td>{{$notes->created_at}}</td>
                          <td><a href="{{ URL::route('getFlatmatesDetails',$notes->ad_title .'~'.$notes->id)}}" target="_blank">View</a></td>
                      </tr>
                  @endforeach
                  </tbody>
              </table>
              @else
                  <p>You have not posted anything in this category.<p>
              @endif
          </div>
          </li>
      </ul>
</div>
</section>
@stop