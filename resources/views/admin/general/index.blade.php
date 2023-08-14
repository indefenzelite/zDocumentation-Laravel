@extends('layouts.main')
@section('title', $label)
@section('content')
    @php
    $breadcrumb_arr = [['name' => $label, 'url' => 'javascript:void(0);', 'class' => ''], ['name' => 'General', 'url' => 'javascript:void(0);', 'class' => 'active']];
    @endphp
    <!-- push external head elements to head -->
    @push('head')
    <link rel="stylesheet" href="{{ asset('admin/plugins/mohithg-switchery/dist/switchery.min.css') }}">

    <style>
        .radio-toolbar-cus {
            margin: 10px;
        }

        .radio-toolbar-cus input[type="radio"] {
            opacity: 0;
            position: fixed;
            width: 0;
        }

        .radio-toolbar-cus label {
            display: inline-block;
            background-color: #ddd;
            margin-top: 0;
            padding: 6px 12px;
            font-family: sans-serif, Arial;
            font-size: 14px;
            border: 2px solid rgb(255, 255, 255);
            border-radius: 4px;
        }

        .radio-toolbar-cus label:hover {
            background-color: rgb(194, 192, 192);
        }

        .radio-toolbar-cus input[type="radio"]:focus+label {
            border: 2px #444;
            background: #444;
        }

        .radio-toolbar-cus input[type="radio"]:checked+label {
            background-color: rgb(64, 153, 255);
            color: #ffffff;
            border: #444;
        }

    </style>
    @endpush
    <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-grid bg-blue"></i>
                        <div class="d-inline">
                            <h5>{{ __($label) }}</h5>
                            <span>{{ __('This setting will be automatically updated in your website.') }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    @include('admin.include.breadcrumb')
				@include('admin.modal.sitemodal',['title'=>"How to use",'content'=>"You need to create a unique code and call the unique code with paragraph content helper."])
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card card-484">
                    <div role="tabpanel">
                        <div class="card-header" style="border:none;">
                            <ul class="nav nav-tabs" role="tablist">
                                @if(auth()->user()->isAbleTo('access_general_setting'))
                                    <li class="nav-item">
                                        <a href="#general" data-active="general" class="nav-link active-swicher @if(request()->has('active') && request()->get('active') == "general" || !request()->has('active')) active @endif" aria-controls="general" role="tab" data-toggle="tab">General</a>
                                    </li>
                                @endif
                                @if(auth()->user()->isAbleTo('access_currency_setting'))
                                    <li class="nav-item">
                                        <a href="#currency" data-active="currency" class="nav-link active-swicher @if(request()->has('active') && request()->get('active') == "currency") active @endif" aria-controls="currency" role="tab" data-toggle="tab">Currency</a>
                                    </li>
                                @endif
                                @if(auth()->user()->isAbleTo('access_date_time_setting'))
                                    <li class="nav-item">
                                        <a href="#datetime" data-active="datetime" class="nav-link active-swicher @if(request()->has('active') && request()->get('active') == "datetime") active @endif" aria-controls="datetime" role="tab" data-toggle="tab">Date & Time</a>
                                    </li>
                                @endif
                                @if(auth()->user()->isAbleTo('access_notification_setting'))
                                    <li class="nav-item">
                                        <a href="#verification" data-active="verification" class="nav-link active-swicher @if(request()->has('active') && request()->get('active') == "verification") active @endif" aria-controls="verification" role="tab"
                                            data-toggle="tab">Notification / Verification</a>
                                    </li>
                                @endif
                                @if(auth()->user()->isAbleTo('access_troubleshoot_setting'))
                                    <li class="nav-item">
                                        <a href="#troubleshoot" data-active="troubleshoot" class="nav-link active-swicher @if(request()->has('active') && request()->get('active') == "troubleshoot") active @endif" aria-controls="troubleshoot" role="tab"
                                        data-toggle="tab">Troubleshoot</a>
                                    </li>
                                @endif
                            </ul>
                        </div>
                        <div class="card-body pt-0">
                            <div class="tab-content">
                                @if(auth()->user()->isAbleTo('access_general_setting'))
                                    <div role="tabpanel" class="tab-pane fade @if(request()->has('active') && request()->get('active') == "general" || !request()->has('active')) show active  @endif pt-3" id="general"
                                        aria-labelledby="general-tab">
                                        @include('admin.general.include.general-tab')
                                    </div>
                                @endif
                                @if(auth()->user()->isAbleTo('access_currency_setting'))
                                    <div role="tabpanel" class="tab-pane fade pt-3 @if(request()->has('active') && request()->get('active') == "currency") show active  @endif" id="currency"
                                        aria-labelledby="currency-tab">
                                        @include('admin.general.include.currency-tab')
                                    </div>
                                @endif
                                @if(auth()->user()->isAbleTo('access_date_time_setting'))
                                    <div role="tabpanel" class="tab-pane fade pt-3 @if(request()->has('active') && request()->get('active') == "datetime") show active  @endif" id="datetime" aria-labelledby="datetime-tab">
                                        @include('admin.general.include.datetime-tab')
                                    </div>
                                @endif
                                @if(auth()->user()->isAbleTo('access_notification_setting'))
                                    <div role="tabpanel" class="tab-pane fade pt-3 @if(request()->has('active') && request()->get('active') == "verification") show active  @endif" id="verification"
                                    aria-labelledby="verification-tab">
                                        @include('admin.general.include.varification-tab')
                                    </div>
                                @endif
                                @if(auth()->user()->isAbleTo('access_troubleshoot_setting'))
                                    <div role="tabpanel" class="tab-pane fade pt-3 @if(request()->has('active') && request()->get('active') == "troubleshoot") show active  @endif" id="troubleshoot"
                                    aria-labelledby="troubleshoot-tab">
                                        @include('admin.general.include.troubleshoot-tab')
                                    </div>
                                @endif
                            </div>
                        <!--tab content-->
                    </div>
                </div>
                <!--tab panel-->
            </div>
        </div>
    </div>
</div>
@push('script')
<script src="{{ asset('admin/plugins/mohithg-switchery/dist/switchery.min.js') }}"></script>
    {{-- START AJAX FORM INIT --}}
        <script src="{{ asset('admin/js/ajaxForm.js') }}"></script>
        <script>
            // STORE DATA USING AJAX
            $('.ajaxForm').on('submit',function(e){
                e.preventDefault();
                var route = $(this).attr('action');
                var method = $(this).attr('method');
                var data = new FormData(this);
                var response = postData(method,route,'json',data,null,null);
                if(typeof(response) != "undefined" && response !== null && response.status == "success"){
                
                }
            })
        </script>
    {{-- END AJAX FORM INIT --}}

    {{-- START JS HELPERS INIT --}}
    <script>
        $('.active-swicher').on('click', function() {
            var active = $(this).attr('data-active');
            updateURL('active',active);
        });
    </script>
    {{-- END JS HELPERS INIT --}}
    @endpush

    <!-- push external js -->
@endsection


