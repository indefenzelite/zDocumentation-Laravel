<div id="offcanvas" data-uk-offcanvas="flip: true; overlay: true">
    <div class="uk-offcanvas-bar">
      <a class="uk-logo" href="{{url('/')}}">
        <img src="{{asset('viewer/assets/img/nims_logo.png')}}" style="width: 30%"/>
      </a>
      <button class="uk-offcanvas-close" type="button" data-uk-close></button>
      <ul class="uk-nav uk-nav-primary uk-nav-offcanvas uk-margin-top">
        <li class="{{Route::currentRouteName()=='index' ? 'uk-active':''}}"><a href="{{url('/')}}">Home</a></li>
       
        {{-- <li class="{{Route::currentRouteName()=='contact' ? 'uk-active':''}}"><a href="{{url('/contact')}}">Feedback</a></li> --}}
        {{-- <li>
          <div class="uk-navbar-item"><a class="uk-button uk-button-success" href="{{url('/contact')}}">Feedback</a></div>
        </li> --}}
      </ul>
      <div class="uk-margin-top uk-text-center">
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
          {{-- <div>
            <a href="https://vimeo.com/" data-uk-icon="icon: vimeo" class="uk-icon-link" target="_blank"></a>
          </div> --}}
        </div>
      </div>
    </div>
  </div>