@php
    $notifications = App\Models\Notification::where('user_id',auth()->id())->latest()->where('is_read',0)->limit(5)->get();
@endphp
<header class="header-top" header-theme="light">
    <div class="container-fluid">
        <div class="d-flex justify-content-between">
            <div class="top-menu d-flex align-items-center">
                <button type="button" class="btn-icon mobile-nav-toggle d-lg-none"><span></span></button>

                <a href="javascript:void(0)" onclick="window.history.back();" type="button" id="" class="nav-link bg-gray mr-1"><i class="ik ik-arrow-left"></i></a>

             
                <button type="button" id="navbar-fullscreen" class="nav-link"><i class="ik ik-maximize"></i></button>
                <a href="{{route('index')}}" type="button" id="" class="nav-link bg-gray ml-1"><i class="ik ik-home"></i></a>
                {{-- @if(Route::is('admin.dashboard.index'))
                    <button type="button" class="nav-link bg-gray ml-1" data-toggle="modal" data-target="#addBrodcast">
                        <i class="ik ik ik-radio" title="Broadcast"></i>
                    </button>
                @endif --}}
            </div>
                    <div class="top-menu d-flex align-items-center">
                    {{-- <div class="dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="notiDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="ik ik-bell"></i><span class="badge bg-danger" style="line-height: 13px;">{{ $notifications->count() > 4 ? '4+' : $notifications->count() }}</span></a>
                        <div class="dropdown-menu dropdown-menu-right notification-dropdown" aria-labelledby="notiDropdown">
                            <h4 class="header">Notifications</h4>
                            @if($notifications != null)
                                <div class="notifications-wrap">
                                    @foreach($notifications as $item)
                                        <a href="" class="media">
                                            <span class="d-flex">
                                                <i class="ik ik-check"></i>
                                            </span>
                                            <span class="media-body">
                                                <span class="heading-font-family media-heading">{{ $item->title }}</span><br>
                                                <span class="media-content">{{ $item->notification }}</span>
                                            </span>
                                        </a>
                                    @endforeach
                                </div>
                            @else
                                <h6 class="text-center my-10">No Notification Yet!</h6>
                            @endif
                            <div class="footer"><a href="{{ route('admin.notifications.index') }}">See all activity</a>
                            </div>
                        </div>
                    </div> --}}
                    <div class="dropdown">
                    
                    <a class="dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img class="avatar" src="{{ (auth()->user() && auth()->user()->avatar) ? auth()->user()->avatar : asset('backend/default/default-avatar.png') }}" style="object-fit: cover; width: 35px; height: 35px" alt="">
                        <span class="user-name font-weight-bolder" style="top: -0.8rem;position: relative;margin-left: 8px;">{{ auth()->user()->full_name }}
                            <span class="text-muted" style="font-size: 10px;position: absolute;top: 16px;left: 3px;">{{ AuthRole()}}</span>
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="{{route('admin.profile.index')}}"><i class="ik ik-user dropdown-icon"></i> Profile</a>
                        
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a href="" onClick="event.preventDefault();this.closest('form').submit();" class="dropdown-item text-danger fw-700"><i class="ik ik-power dropdown-icon text-danger"></i>
                                {{__('Log out')}}
                            </a>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</header>
@include('admin.include.modal.broadcast')



