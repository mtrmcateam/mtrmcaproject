@if(Session::has('success'))
  <div class="uk-alert uk-alert-success uk-width-1-2 uk-container-center uk-text-center" data-uk-alert><a href="" class="uk-alert-close uk-close"></a>{{{ Session::get('success')}}}</div>
@elseif(Session::has('fail'))
  <div class="uk-alert uk-alert-danger uk-width-1-2 uk-container-center uk-text-center" data-uk-alert><a href="" class="uk-alert-close uk-close"></a>{{{ Session::get('fail')}}}</div>
@endif