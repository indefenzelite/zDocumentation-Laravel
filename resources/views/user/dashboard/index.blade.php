@extends('layouts.user')

@section('meta_data')
    @php
		$meta_title = 'Home | '.getSetting('app_name');		
		$meta_description = '' ?? getSetting('seo_meta_description');
		$meta_keywords = '' ?? getSetting('seo_meta_keywords');
		$meta_motto = '' ?? getSetting('site_motto');		
		$meta_abstract = '' ?? getSetting('site_motto');		
		$meta_author_name = '' ?? 'Defenzelite';		
		$meta_author_email = '' ?? 'support@defenzelite.com';		
		$meta_reply_to = '' ?? getSetting('app_email');		
		$meta_img = ' ';
        $customer = 1;		
	@endphp
@endsection

@section('content')
    

    <!-- Profile Start -->
    <section class="section mt-60">
        <div class="container mt-lg-3">
            <div class="row">
                @include('user.include.sidebar')
                <div class="col-lg-8 col-md-12 mx-auto">
                    <div class="p-3"> 
                        <div class="border-bottom pb-4">
                           <h5 class="title mb-0">Dashboard</h5>
                           <span>
                            Welcome {{auth()->user()->full_name}}
                           </span>
                        </div>
                        <div class="card" style="background-color:#ffff">
                            {{-- #F5F5F6 --}}
                            <div class="card-body p-0" style="height:120px">
                                <div class="d-flex justify-content-between">
                                    <img src="{{ getAuthProfileImage(auth()->user()->avatar ) }}"
                                         class="avatar " alt="" style="height: 120px;
                                         min-height: 120px;
                                         width: 120px;
                                         min-width: 120px;">
                                    <div class="btn-wrap d-flex flex-column align-items-end p-4" id="payout-btn">

                                        <a href="{{route('user.setting.index')}}" class="btn   btn-outline-secondary btn-sm btn-round"
                                           style="margin-left: 41px;">
                                            <span>Edit Profile<i class="icon-long-arrow-right"></i></span>

                                        </a>
                                        <div class="mt-2" style="margin-left:55px;">
                                            <h6 class="text-secondary fw-700">
                                                Wallet Balance {{format_price(auth()->user()->wallet)}}
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        @php
                            $boxes = [
                                ['label'=>'My Wallet','link'=>route('user.wallet.index'),'icon'=>'wallet'],
                                ['label'=>'Payouts','link'=>route('user.payout.index'),'icon'=>'transaction'],
                                ['label'=>'Orders','link'=>route('user.order.index'),'icon'=>'shopping-cart-alt'],
                                ['label'=>'Support Ticket','link'=>route('user.support-ticket.index'),'icon'=>'envelope'],
                                ['label'=>'Logout','link'=>route('logout'),'icon'=>'sign-out-alt'],
                               
                            ];
                        @endphp

                        <div class="">
                            <div class="row mt-4">
                                @foreach ($boxes as $box)
                                    <div class="col-md-2 col-lg-4 mb-4">
                                        <div class="bg-white text-center rounded" style="padding: 10px 0px 10px 0px;border: solid #ced9dd 0.5px;">  
                                            <a href="{{$box['link']}}">
                                                <div class="h2 mb-0">
                                                    <i class="uil uil-{{$box['icon']}} uil-lg text-muted"></i>
                                                </div>
                                                <span class="">{{$box['label']}}</span>
                                            </a>
                                        </div>
                                    </div><!--end col-->
                                @endforeach
                            </div><!--end row-->
                        </div>
                    </div>
                </div><!--end col-->
            </div><!--end row-->
        </div><!--end container-->
    </section><!--end section-->
    <!-- Profile End -->
    
@endsection