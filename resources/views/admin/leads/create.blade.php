@extends('layouts.main') 
@section('title', $label)
@section('content')
@php
$breadcrumb_arr = [
    ['name'=>'Add'.' '.$label, 'url'=> "javascript:void(0);", 'class' => '']
]
@endphp
    <!-- push external head elements to head -->
    @push('head')
    @endpush

    <div class="container-fluid">
    	<div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-grid bg-blue"></i>
                        <div class="d-inline">
                            <h5>{{ __('Create')}} {{$label}}</h5>
                            <span>{{ __('Add a new record for')}} {{$label}}</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    @include('admin.include.breadcrumb')
                </div>
            </div>
        </div>
        <form action="{{ route('admin.leads.store') }}" method="post" class="ajaxForm">
        @csrf
        <div class="row">
            <!-- start message area-->
            @include('admin.include.message')
            <!-- end message area-->
            <div class="col-md-8">
                <div class="card ">
                    <div class="card-header">
                        <h3>Lead Details</h3>
                    </div>
                    <div class="card-body">
                        <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                        <input type="hidden" name="request_with" value="create">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group {{ $errors->has('lead_type_id') ? 'has-error' : ''}}">
                                    <label for="lead_type_id" class="control-label">{{ 'Status' }} <span class="text-red">*</span> </label>
                                    
                                    <a href="javascript:void(0);" title="@lang('admin/tooltip.add_lead_type_id')"><i class="ik ik-help-circle text-muted ml-1"></i></a>
                                    <select required name="lead_type_id" id="" class="form-control select2">
                                        @foreach ($status_categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group {{ $errors->has('lead_source_id') ? 'has-error' : ''}}">
                                    <label for="lead_source_id" class="control-label">{{ 'Source' }} <span class="text-red">*</span> </label>
                                    <a href="javascript:void(0);" title="@lang('admin/tooltip.add_lead_source_id')"><i class="ik ik-help-circle text-muted ml-1"></i></a>
                                    <select required name="lead_source_id" id="" class="form-control select2">
                                        <option value="" selected disabled> Select Source</option>
                                        @foreach ($source_categories as $category)
                                            <option value="{{ $category->id }}"@if($category->id == 79) selected @endif>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group {{ $errors->has('lead_source_id') ? 'has-error' : ''}}">
                                    <label for="lead_source_id" class="control-label">{{ 'Category' }} <span class="text-red">*</span> </label>
                                    <a href="javascript:void(0);" title="@lang('admin/tooltip.add_lead_source_id')"><i class="ik ik-help-circle text-muted ml-1"></i></a>
                                    <select name="category_id" id="" class="form-control select2">
                                        <option value="" selected disabled> Select Category</option>
                                        @foreach ($type_categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
            
                            {{-- <div class="col-lg-4">
                                <div class="form-group {{ $errors->has('lead_source_id') ? 'has-error' : ''}}">
                                    <label for="lead_type_id" class="control-label">{{ 'Type' }} <span class="text-red">*</span> </label>
                                    <select name="lead_type_id" id="" class="form-control select2">
                                        <option value="" readonly>Select Type</option>
                                        @foreach ($type_categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div> --}}
                            <div class="col-lg-12">
                                <div class="form-group {{ $errors->has('remark') ? 'has-error' : ''}}">
                                    <label for="remark" class="control-label">{{ 'Remark' }} </label>
                                    <a href="javascript:void(0);" title="@lang('admin/tooltip.add_lead_remark')"><i class="ik ik-help-circle text-muted ml-1"></i></a>
                                    <textarea class="form-control" rows="9" name="remark" type="textarea" id="remark" placeholder="Enter Remark" >{{ isset($lead->remark) ? $lead->remark : ''}}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header justify-content-between">
                        <h3>Personal Info</h3>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                                    <label for="name" class="control-label">{{ 'Name' }} <span class="text-red">*</span> </label>
                                    <a href="javascript:void(0);" title="@lang('admin/tooltip.add_lead_name')"><i class="ik ik-help-circle text-muted ml-1"></i></a>
                                    <input class="form-control" name="name" type="text"  pattern="[a-zA-Z]+.*" title="Please enter first letter alphabet and at least one alphabet character is required." title="Please enter first letter alphabet and at least one alphabet character is required." id="name" placeholder="Enter Name" value="{{ isset($lead->name) ? $lead->name : ''}}" required>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group {{ $errors->has('owner_email') ? 'has-error' : ''}}">
                                    <label for="owner_email" class="control-label">{{ 'Email' }} </label>
                                    <a href="javascript:void(0);" title="@lang('admin/tooltip.add_lead_email')"><i class="ik ik-help-circle text-muted ml-1"></i></a>
                                    <input class="form-control" name="owner_email" type="email" id="owner_email" placeholder="Enter Email" value="{{ isset($lead->owner_email) ? $lead->owner_email : ''}}" >
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group {{ $errors->has('phone') ? 'has-error' : ''}}">
                                    <label for="phone" class="control-label">{{ 'Phone' }} </label>
                                     <a href="javascript:void(0);" title="@lang('admin/tooltip.add_lead_phone')"><i class="ik ik-help-circle text-muted ml-1"></i></a>
                                    {{-- <input class="form-control" name="phone" type="tel" minlength="10" maxlength="12" id="phone"placeholder="Enter Phone" value="{{ isset($lead->phone) ? $lead->phone : ''}}" > --}}
                                    <input type="tel" class="form-control" id="phone" min="0"  minlength="10" maxlength="12" placeholder="Enter Phone Number" pattern="[1-9]{1}[0-9]{9}" name="phone" value="{{ isset($lead->phone) ? $lead->phone : ''}}">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group {{ $errors->has('address') ? 'has-error' : ''}}">
                                    <label for="address"  class="control-label">{{ 'Address' }} </label>
                                     <a href="javascript:void(0);" title="@lang('admin/tooltip.add_lead_address')"><i class="ik ik-help-circle text-muted ml-1"></i></a>
                                    
                                    <textarea input type="text" pattern="[a-zA-Z]+.*" title="Please enter first letter alphabet and at least one alphabet character is required." title="Please enter first letter alphabet and at least one alphabet character is required." class="form-control" id="address" placeholder="Enter the address"name="address" value="{{ isset($lead->address) ? $lead->address : ''}}"></textarea>
                                </div>
                            </div>                         
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </form>
    </div>
    <!-- push external js -->
    @push('script')
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
            var redirectUrl = "{{url('admin/leads')}}";
            if(typeof(response) != "undefined" && response !== null && response.status == "success"){
                window.location.href = redirectUrl;
            }
        });
    </script>
    {{-- END AJAX FORM INIT --}}
    @endpush
@endsection
