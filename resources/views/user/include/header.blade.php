<!-- Navbar Start -->
<style>
    @media print {
        .printButton {
            display: none;
        }
    }
    .notification-icon {
        min-height: 8px;
        min-width: 8px;
        margin-right: 5px;
        background-color: #e43f52!important;
        border-radius: 50%;
        display: inline-block;
        right: 20px;
        top: -10px;
        position: relative;
    }
</style>
@php
    $notifications = App\Models\Notification::where('user_id',auth()->id())->latest()->where('is_read',0)->get();
@endphp
  <header id="topnav" class="defaultscroll sticky bg-white printButton" style="box-shadow: rgba(0, 0, 0, 0.15) 1.95px 1.95px 2.6px;">
    <div class="container">
        <a class="logo" href="{{ route('index') }}">
            <span class="logo-light-mode">
                <img src="{{ getBackendLogo(getSetting('app_logo'))}}" class="l-dark" height="48" alt=""style="margin-top: 14px;
                margin-left: 10px;">
                <img src="{{ getBackendLogo(getSetting('app_logo'))}}" class="l-light" height="48" alt=""style="margin-top: 14px;
                margin-left: 10px;">
            </span>
            <img src="{{ getBackendLogo(getSetting('app_logo'))}}" height="24" class="logo-dark-mode" alt=""style="margin-top: 14px;
            margin-left: 10px;">
        
        </a>

        <!-- End Logo container-->
        <div class="menu-extras">
            <div class="menu-item">
                <!-- Mobile menu toggle-->
                <a class="navbar-toggle toggleBtn" id="isToggle" onclick="toggleMenu()">
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
        <ul class="buy-button list-inline mb-0 navigation-menu">
            
            <li class="list-inline-item ps-0 pe-0 mb-0 m-0">
                <a href="{{route('user.notification.index')}}" title="Notification" style="padding-right:10px;" class="pl-0">
                    <div class="login-btn-primary"><span class="btn btn-icon btn-pills"><i class="uil uil-bell align-middle"></i></span>
                        @if ($notifications->count() > 0)
                        
                        <span class="notification-icon"> </span>
                        @endif
                    </div>
                </a>
            </li>
            <li class="has-submenu parent-parent-menu-item mb-0"id="toggle-submenu">
                <a href="javascript:void(0)" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight" class="pl-0">
                    <div class="login-btn-primary d-flex">
                        @php
                            $user = auth()->user();
                        @endphp
                        <div>
                            <span class="btn btn-icon btn-pills btn-soft-primary">
                                <img src="{{ getAuthProfileImage(auth()->user()->avatar ) }}" alt="" class="author-img" style="height: 38px; width: 38px;border-radius: 50%;object-fit: cover;">
                            </span> 
                        </div>
                        <div>
                            <div class="user-name font-weight-bolder d-block" style="top: 3px; position: relative; margin-left: 8px; line-height: normal;">
                                {{ auth()->user()->full_name }} 
                                <div class="text-muted"style="font-size: 10px;">
                                    Member
                                </div>
                            </div>
                        </div>
                    </div>     
                </a>
                <ul class="submenu mobile-submenu" id="show-submenu">
                    @auth
                    <li><a href="{{route('user.dashboard.index')}}" class="sub-menu-item"><i class="uil uil-dashboard me-1" style="font-size:20px;"></i>Dashboard</a></li>
                    <li><a href="{{route('user.setting.index')}}" class="sub-menu-item"><i class="uil uil-cog align-middle me-1"style="font-size:20px;"></i>Setting</a></li>
                        @if(auth()->user() && session()->has("admin_user_id") && session()->has("temp_user_id"))
                            <li> <a class="sub-menu-item" href="{{route('user.dashboard.logout-as')}}"><i class="uil uil-sign-in-alt align-middle me-1" style="font-size:20px;"></i>Re-Login as Admin</a></li>
                        @endif
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a href="" onClick="event.preventDefault();this.closest('form').submit();"><i class="uil uil-sign-out-alt align-middle me-1" style="font-size:20px;"></i>
                                    {{__('Log out')}}
                                </a>
                            </form>
                        </li>
                    @else
                        <li><a href="{{route('/login')}}" class="sub-menu-item">Login</a></li>
                    @endif 
                </ul>
            </li>
        </ul>
        <!--Login button End-->
    </div><!--end container-->
</header><!--end header-->
<!-- Navbar End -->