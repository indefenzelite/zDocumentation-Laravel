
<style>
	.tool_tip{
		position: absolute;
		 width: 100px;
		 height: 100px;
		 border: 1px solid #000;
		 top:70%;
		 right:20%;
		 border-radius: 5px;
		 background: #fff;
	}
</style>
    <!-- Navbar Start -->
    <header style="box-shadow: rgba(141, 140, 140, 0.24) 0px 3px 8px;">
        <div data-uk-sticky="animation: uk-animation-slide-top; sel-target: .uk-navbar-container; cls-active: uk-navbar-sticky; cls-inactive: uk-navbar-transparent; top: 200" class="uk-sticky">
          <nav class="uk-navbar-container uk-navbar-transparent" style="box-shadow: rgba(141, 140, 140, 0.24) 0px 3px 8px;">
            <div class="uk-container">
              <div data-uk-navbar="" class="uk-navbar">
                
                
                  <a class="uk-navbar-item uk-logo uk-visible@m" href="{{url('/')}}">
                   
                    <img src="https://gbooks.io/site/images/gbooks-logo.png" style="width:100px"/>
                  </a>
                               <ul class="uk-navbar-nav uk-visible@m" id="nav_link">
                    <li class="uk-active"><a href="{{url('/')}}">Home</a></li>
                    
                    <li class=" 
                      
                      ">
                    </li>
                  </ul>
                
                
                <div class="uk-navbar-center uk-hidden@m" style=" left:40px ">
                  <a class="uk-navbar-item uk-logo" href="index.html">
                    <img src="https://gbooks.io/site/images/gbooks-logo.png" style="width:100px"/>
                  </a>
                </div>
                <div class="uk-navbar-right">
                  <div>
                    <a id="search-navbar-toggle" type="submit" class="uk-navbar-toggle searchBtn text-success uk-icon uk-search-icon" data-uk-search-icon="" href="#" aria-expanded="false"><svg width="20" height="20" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" data-svg="search-icon"><circle fill="none" stroke="#000" stroke-width="1.1" cx="9" cy="9" r="7"></circle><path fill="none" stroke="#000" stroke-width="1.1" d="M14,14 L18,18 L14,14 Z"></path></svg></a>
                    <div class="uk-background-default uk-border-rounded uk-drop" data-uk-drop="mode: click; pos: left-center; offset: 0">
                      <form action="" class="uk-search uk-search-navbar uk-width-1-1" method="GET">
                        <input id="search-navbar" class="uk-search-input" type="search" placeholder="Search for Standards, Roles, Duties" name="search" autofocus="" autocomplete="off" data-minchars="1" data-maxitems="30">
                      </form>
                    </div>
                  </div>
                  <ul class="uk-navbar-nav uk-visible@m">
                    <li>
                      <div class="uk-navbar-item " style="position: relative">
                        @if (auth()->check())
                          <a class="uk-button uk-button-primary-outline" target="_blank" href="{{route('admin.dashboard.index')}}">Dashboard</a> 
                        @else
                          <a class="uk-button uk-button-primary-outline" target="_blank" href="{{route('login','admin')}}">Sign In</a> 
                        @endif
                      </div>
                    </li>
                    
                  </ul>
                  <a class="uk-navbar-toggle uk-hidden@m" href="#offcanvas" data-uk-toggle=""><span data-uk-navbar-toggle-icon="" class="uk-icon uk-navbar-toggle-icon"><svg width="20" height="20" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" data-svg="navbar-toggle-icon"><rect y="9" width="20" height="2"></rect><rect y="3" width="20" height="2"></rect><rect y="15" width="20" height="2"></rect></svg></span> <span class="uk-margin-small-left">Menu</span></a>
                </div>
              </div>
            </div>
          </nav>
        </div><div class="uk-sticky-placeholder" hidden="" style="height: 80px; margin: 0px;"></div>
        
    </header>
    @push('script')
	<script>
		$('#search-navbar-toggle').on('click',function(){
			var val = $('#search-navbar').val();
			if (val != "") {
				$('.uk-search').submit();
			}
		});
	</script>
@endpush
<!-- Navbar End -->