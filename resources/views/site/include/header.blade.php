
<style>
@media (max-width: 667px) {
    .defaultscroll {
        width: 380px;
        /* Adjust the slider's layout for small screens */
        /* For example, you can set a specific width or height, change the positioning, etc. */
    }
    .logo{
        margin-top: 20px;
    }
}
</style>
    <!-- Navbar Start -->
  <header id="topnav" class="defaultscroll sticky bg-white py-10" style="box-shadow: rgba(0, 0, 0, 0.15) 1.95px 1.95px 2.6px;">
    <div class="container">
        <!-- Logo container-->
        <a class="logo mt-3" href="{{ route('index') }}">
            <span class="logo-light-mode">
                <img src="{{ getBackendLogo(getSetting('app_logo'))}}" class="l-dark" height="35" alt="" >
                <img src="{{ getBackendLogo(getSetting('app_logo'))}}" class="l-light" height="35" alt="">
            </span>
            <img src="{{ getBackendLogo(getSetting('app_logo'))}}" height="35" class="logo-dark-mode" alt="">
        </a>

        <!-- End Logo container-->
        <div class="menu-extras">
            <div class="menu-item">
                <!-- Mobile menu toggle-->
                <a class="navbar-toggle" id="isToggle" onclick="toggleMenu()">
                    <div class="lines">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </a>
                <!-- End mobile menu toggle-->
            </div>
        </div>

        <!--Login button Start-->
        <ul class="buy-button list-inline mb-0 navigation-menu login_wrapper">
            <li class="has-submenu parent-parent-menu-item mb-0">
                @php
                    if(auth()->check()){
                        if(auth()->user()->hasRole('admin')){
                            $route = route('admin.dashboard.index');
                        }elseif(auth()->user()->hasRole('super_admin')){
                            $route = route('admin.dashboard.index');
                        }else{
                            $route = route('user.dashboard.index');
                        }
                    }
                @endphp
                @auth
                    <a href="{{$route}}"  class="pl-0" style="margin-top: -10px;">
                        <img src="{{ getAuthProfileImage(auth()->user()->avatar ) }}" alt="" class="author-img" style="height: 38px; width: 38px;border-radius: 50%;object-fit: cover;">
                    </a>
                @else
                    <div style="margin-top: 20px;">
                        <a href="{{ route('login','admin') }}" class="btn btn-primary mb-2 mt-0">Admin Login</a>
                        <a href="{{ route('login','user') }}" class="btn btn-primary mb-2 mt-0">User Login</a>
                    </div>
                @endauth
            </li>
        </ul>
        <!--Login button End-->

        <div id="navigation">
            <!-- Navigation Menu-->   
            <ul class="navigation-menu nav-light">
                <li><a href="{{ route('index') }}" class="sub-menu-item">Home</a></li>
                <li><a href="{{ route('about') }}" class="sub-menu-item">About</a></li>
                <li><a href="{{ route('blogs') }}" class="sub-menu-item">Blogs</a></li>
                <li><a href="{{ route('faqs') }}" class="sub-menu-item">Faqs</a></li>
                <li><a href="{{ route('contact') }}" class="sub-menu-item">Contact</a></li>
            </ul><!--end navigation menu-->
        </div><!--end navigation-->
    </div><!--end container-->
</header><!--end header-->
<!-- Navbar End -->