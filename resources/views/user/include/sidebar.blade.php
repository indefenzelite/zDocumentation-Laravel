<div class="col-lg-4 col-md-6 col-12 toggle-area mb-3">
    <div class="sidebar sticky-bar p-4 rounded shadow bg-white">
            {{-- <div class="widget">
                <h5 class="widget-title">Hello {{ auth()->user()->name }}</h5>
            </div> --}}
        
        <div class="widget mt-4">
            <ul class="list-unstyled sidebar-nav mb-0" id="navmenu-nav">
                <li class="navbar-item account-menu px-0 @if(request()->routeIs('user.dashboard.index')) active @endif">
                    <a href="{{route('user.dashboard.index')}}" class="navbar-link d-flex rounded shadow align-items-center py-2 px-4">
                        <span class="h4 mb-0"><i class="uil uil-dashboard"></i></span>
                        <h6 class="mb-0 ms-2">Dashboard</h6>
                    </a>
                </li>
                <li class="navbar-item account-menu px-0 mt-2 @if(request()->routeIs('user.wallet.index')) active @endif">
                    <a href="{{route('user.wallet.index')}}" class="navbar-link d-flex rounded shadow align-items-center py-2 px-4">
                        <span class="h4 mb-0"><i class="uil uil-wallet"></i></span>
                        <h6 class="mb-0 ms-2">Wallet</h6>
                    </a>
                </li>
                <li class="navbar-item account-menu px-0 mt-2 @if(request()->routeIs('user.payout.index')) active @endif">
                    <a href="{{route('user.payout.index')}}" class="navbar-link d-flex rounded shadow align-items-center py-2 px-4">
                        <span class="h4 mb-0"><i class="uil uil-transaction"></i></span>
                        <h6 class="mb-0 ms-2">Payouts</h6>
                    </a>
                </li>
                <li class="navbar-item account-menu px-0 mt-2 @if(request()->routeIs('user.order.index')) active @endif">
                    <a href="{{route('user.order.index')}}" class="navbar-link d-flex rounded shadow align-items-center py-2 px-4">
                        <span class="h4 mb-0"><i class="uil uil-shopping-cart-alt"></i></span>
                        <h6 class="mb-0 ms-2">Orders</h6>
                    </a>
                </li>
                <li class="navbar-item account-menu px-0 mt-2 @if(request()->routeIs('user.support-ticket.index') || request()->routeIs('user.support-ticket.show')) active  @endif">
                    <a href="{{route('user.support-ticket.index')}}" class="navbar-link d-flex rounded shadow align-items-center py-2 px-4">
                        <span class="h4 mb-0"><i class="uil uil-envelope"></i></span>
                        <h6 class="mb-0 ms-2">Support Ticket</h6>
                    </a>
                </li>
                <li class="navbar-item account-menu px-0 mt-2">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a href="" onClick="event.preventDefault();this.closest('form').submit();" class="navbar-link d-flex rounded shadow align-items-center py-2 px-4">
                        <span class="h4 mb-0"><i class="uil uil-sign-out-alt"></i></span>
                        <h6 class="mb-0 ms-2">Log out</h6>
                        </a>
                    </form>
                </li>
            </ul>
        </div>

        <div class="widget">
            <p class="text-muted style">© <script>document.write(new Date().getFullYear())</script> {{getSetting('app_name')}}</p>  
        </div>
    </div>
</div><!--end col-->