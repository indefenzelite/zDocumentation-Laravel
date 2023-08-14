@extends('layouts.main') 
@section('title', 'Subscription')
@section('content')
@php
/**
* Subscription 
*
* @category zStarter
*
* @ref zCURD
* @author  Defenzelite <hq@defenzelite.com>
* @license https://www.defenzelite.com Defenzelite Private Limited
* @version <zStarter: 1.1.0>
* @link    https://www.defenzelite.com
*/
$breadcrumb_arr = [
    ['name'=>'Edit Subscription', 'url'=> "javascript:void(0);", 'class' => '']
]
@endphp
    <!-- push external head elements to head -->
    @push('head')
    <link rel="stylesheet" href="{{ asset('admin/plugins/mohithg-switchery/dist/switchery.min.css') }}">
    <style>
        .error{
            color:red;
        }
        .alert{
            padding: 5px 10px;
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
                            <h5>Edit Subscription</h5>
                            <span>Update a record for Subscription</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    @include('admin.include.breadcrumb')
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 mx-auto">
                <!-- start message area-->
               @include('admin.include.message')
                <!-- end message area-->
                <div class="card ">
                    <div class="card-header">
                        <h3>Update Subscription</h3>
                    </div>
                    <div class="card-body" >
                        <form action="{{ route('admin.subscriptions.update',$subscription->id) }}" method="post"enctype="multipart/form-data" id="SubscriptionForm" class="ajaxForm">
                            @csrf
                            <div class="row ">
                                <div class="col-md-12 col-12"> 
                                    <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                                        <label for="name" class="control-label">Name<span class="text-danger">*</span></label>
                                        <a href="javascript:void(0);" title="@lang('admin/tooltip.edit_subscription_name')"><i class="ik ik-help-circle text-muted ml-1"></i></a>
                                        <input required  class="form-control" name="name" pattern="[a-zA-Z]+.*" title="Please enter first letter alphabet and at least one alphabet character is required." title="Please enter first letter alphabet and at least one alphabet character is required." title="Please enter first letter alphabet and at least one alphabet character is required." type="text" id="name" value="{{$subscription->name }}">
                                    </div>
                                </div>

                                 <div class="col-md-12 col-12"> 
                                    <div class="form-group {{ $errors->has('duration') ? 'has-error' : ''}}">
                                        <label for="duration" class="control-label">Duration<span class="text-danger">*</span></label>
                                        <a href="javascript:void(0);" title="@lang('admin/tooltip.edit_subscription_duration')"><i class="ik ik-help-circle text-muted ml-1"></i></a>
                                        <div class="d-flex">
                                        <input required class="form-control" name="duration" type="text" id="duration" value="{{ $subscription->duration }}" placeholder="Enter Duration">
                                        <div class="input-group-append"style="margin-left: -6px;">
                                            <span class="input-group-text" id="basic-addon2">In days</span>
                                        </div>
                                        </div>
                                    </div>
                                    <div class="alert alert-info fade show mt-3" role="alert"><p class="mb-0">To make Lifetime plan, set the duration to 0</p></div>
                                </div> 
                                 
                                <div class="col-md-12 col-12"> 
                                    <div class="form-group {{ $errors->has('price') ? 'has-error' : ''}}">
                                        <label for="price" class="control-label">Price<span class="text-danger">*</span></label>
                                        <a href="javascript:void(0);" title="@lang('admin/tooltip.edit_subscription_price')"><i class="ik ik-help-circle text-muted ml-1"></i></a>
                                        <div class="d-flex">
                                        <input class="form-control" name="price" type="number" step="any"min="0" id="price" value="{{$subscription->price }}" placeholder="Enter Price"required>
                                        <div class="input-group-append"style="margin-left: -6px;">
                                        <span class="input-group-text" id="basic-addon2">In ₹</span>
                                        </div>
                                        </div>
                                    </div>
                                    <div class="alert alert-info fade show mt-3" role="alert"><p class="mb-0">To give Free Subscription, set the price to 0</p></div>
                                </div>
                              
                                        
                                 <div class="col-md-12 col-12"> 
                                    <div class="form-group {{ $errors->has('is_featured') ? 'has-error' : ''}}"><br>
                                        <label for="is_published" class="control-label">
                                        <input   class="js-switch switch-input" @if($subscription->is_published == 1)  checked @endif name="is_published" type="checkbox" id="is_published" value="1"> Published</label>
                                    </div>
                                </div>
                                                                                        
                             
                                <div class="col-md-12 mx-auto">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- push external js -->
    @push('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
    <script src="{{ asset('admin/plugins/mohithg-switchery/dist/switchery.min.js') }}"></script>
    {{-- START SUBSCRIPTION FORM INIT --}}
    <script>
        $('#SubscriptionForm').validate();
    </script>
    {{-- END SUBSCRIPTION FORM INIT --}}

    {{-- START AJAX FORM INIT --}}
    <script>
        // STORE DATA USING AJAX
        $('.ajaxForm').on('submit',function(e){
            e.preventDefault();
            var route = $(this).attr('action');
            var method = $(this).attr('method');
            var data = new FormData(this);
            var response = postData(method,route,'json',data,null,null);
            var redirectUrl = "{{url('admin/subscriptions/')}}";
            if(typeof(response) != "undefined" && response !== null && response.status == "success"){
                window.location.href = redirectUrl;
            }
        })                                                                        
    </script>
    {{-- END AJAX FORM INIT --}}
    @endpush
@endsection
