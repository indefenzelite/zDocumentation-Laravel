<div id="offcanvas" data-uk-offcanvas="flip: true; overlay: true">
    <div class="uk-offcanvas-bar">
      <a class="uk-logo" href="{{url('/')}}">
        <img src="{{asset('site/assets/img/gbooks-logo.png')}}" style="width: 30%"/>
      </a>
      <button class="uk-offcanvas-close" type="button" data-uk-close></button>
      <ul class="uk-nav uk-nav-primary uk-nav-offcanvas uk-margin-top">
        <li class="{{Route::currentRouteName()=='index' ? 'uk-active':''}}"><a href="{{url('/')}}">Home</a></li>
        <li class="uk"><a href="https://gbooks.io/">Accounting</a></li>
        @if(auth()->check())
          <li class="uk"><a href="{{route('admin.dashboard.index')}}">Dashboard</a></li>
        @else
            <li class="uk"><a href="{{route('login','admin')}}">Sign In</a></li>
          
        @endif
      </ul>
      {{-- <div class="uk-margin-top uk-text-center">
        <div data-uk-grid class="uk-child-width-auto uk-grid-small uk-flex-center">
          <div>
            <a href="{{getSetting('twitter_link')}}" data-uk-icon="icon: twitter" class="uk-icon-link" target="_blank"></a>
          </div>
          <div>
            <a href="{{getSetting('facebook_link')}}" data-uk-icon="icon: facebook" class="uk-icon-link" target="_blank"></a>
          </div>
          <div>
            <a href="{{getSetting('linkedin_link')}}" data-uk-icon="icon: linkedin" class="uk-icon-link" target="_blank"></a>
          </div>
          
        </div>
      </div> --}}
    </div>
  </div>