@extends('layouts.main') 
@section('title', $label)
@section('content')
@php
$breadcrumb_arr = [
    ['name'=>'Edit'.' ' .$label, 'url'=> "javascript:void(0);", 'class' => '']
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
                            <h5>{{ __('Edit')}} {{$label}}</h5>
                            <span>{{ __('Update a record for ')}} {{$label}}</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    @include('admin.include.breadcrumb')
                </div>
            </div>
        </div>
        <div class="row">
            <!-- start message area-->
            <!-- end message area-->
            <div class="col-md-8 mx-auto">
                <div class="card ">
                    <div class="card-header">
                        <h3>{{ __('Update')}} {{$label}}</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.locations.country.update', $country->id) }}" method="post" enctype="multipart/form-data" class="ajaxForm">
                            @csrf
                            <input type="hidden" name="request_with" value="country-update">
                            <input type="hidden" name="request_with" value="country-update">
                            <div class="row">
                                <div class="col-md-12 mx-auto">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group {{ $errors->has('Name') ? 'has-error' : ''}}">
                                                <label for="Name" class="control-label">{{ 'Country Name' }} <span class="text-danger">*</span></label>
                                                <a href="javascript:void(0);" title="@lang('admin/tooltip.edit_country_name')"><i class="ik ik-help-circle text-muted ml-1"></i></a>
                                                <input class="form-control" name="name" type="text" pattern="[a-zA-Z]+.*" title="Please enter first letter alphabet and at least one alphabet character is required." title="Please enter first letter alphabet and at least one alphabet character is required." id="Name" value="{{ $country->name }}" placeholder="Enter Name" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group {{ $errors->has('Name') ? 'has-error' : ''}}">
                                                <label for="Name" class="control-label">{{ 'Capital' }} <span class="text-danger">*</span></label>
                                                <a href="javascript:void(0);" title="@lang('admin/tooltip.edit_country_capital')"><i class="ik ik-help-circle text-muted ml-1"></i></a>
                                                <input class="form-control" name="capital" type="text" pattern="[a-zA-Z]+.*" title="Please enter first letter alphabet and at least one alphabet character is required." title="Please enter first letter alphabet and at least one alphabet character is required." id="capital" value="{{ $country->capital }}" placeholder="Enter capital" required>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6">
                                            <div class="form-group {{ $errors->has('Code') ? 'has-error' : ''}}">
                                                <label for="Code" class="control-label">{{ 'Country Code' }} <span class="text-danger">*</span></label>
                                                <a href="javascript:void(0);" title="@lang('admin/tooltip.edit_country_code')"><i class="ik ik-help-circle text-muted ml-1"></i></a>
                                                <input class="form-control" name="iso3" type="text" pattern="[a-zA-Z]+.*" title="Please enter first letter alphabet and at least one alphabet character is required." title="Please enter first letter alphabet and at least one alphabet character is required." value="{{ $country->iso3 }}" placeholder="Enter Code" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group {{ $errors->has('Currency') ? 'has-error' : ''}}">
                                                <label for="Currency" class="control-label">{{ 'Country Currency' }} <span class="text-danger">*</span></label>
                                                <a href="javascript:void(0);" title="@lang('admin/tooltip.edit_country_currency')"><i class="ik ik-help-circle text-muted ml-1"></i></a>
                                                <input class="form-control" name="currency" type="text" id="Currency" value="{{ $country->currency }}" placeholder="Enter Currency" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group {{ $errors->has('region') ? 'has-error' : ''}}">
                                                <label for="region" class="control-label">{{ 'Region' }} <span class="text-danger">*</span></label>
                                                <a href="javascript:void(0);" title="@lang('admin/tooltip.edit_country_region')"><i class="ik ik-help-circle text-muted ml-1"></i></a>
                                                <input class="form-control" name="region" type="text" id="region" value="{{ $country->region }}" placeholder="Enter Region" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group {{ $errors->has('Emoji') ? 'has-error' : ''}}">
                                                <label for="Emoji" class="control-label">{{ 'Emoji Code' }} <span class="text-danger">*</span></label>
                                                <a href="javascript:void(0);" title="@lang('admin/tooltip.edit_country_emoji')"><i class="ik ik-help-circle text-muted ml-1"></i></a>
                                                <input class="form-control" name="emoji" type="text" id="Emoji" value="{{ $country->phonecode }}" placeholder="Enter Emoji Code" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group {{ $errors->has('phonecode') ? 'has-error' : ''}}">
                                                <label for="phonecode" class="control-label">{{ 'Phone Code' }} <span class="text-danger">*</span></label>
                                                <a href="javascript:void(0);" title="@lang('admin/tooltip.edit_country_phonecode')"><i class="ik ik-help-circle text-muted ml-1"></i></a>
                                                <input class="form-control" name="phonecode" type="text" id="phonecode" value="{{ $country->phonecode }}" placeholder="Enter Phone Code" required>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group text-right">
                                        <button type="submit" class="btn btn-primary float-right"> Save & Update</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection    
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
            var redirectUrl = "{{url('admin/locations/country')}}";
            if(typeof(response) != "undefined" && response !== null && response.status == "success"){
                window.location.href = redirectUrl;
            }
        }) 
    </script>
    {{-- END AJAX FORM INIT --}}
    @endpush
