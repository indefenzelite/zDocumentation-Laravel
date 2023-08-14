@extends('layouts.main') 
@section('title', $label)
@section('content')
@php
$breadcrumb_arr = [
    ['name'=>'Edit'.' '. $label, 'url'=> "javascript:void(0);", 'class' => '']
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
                            <span>{{ __('Update a record for')}} {{$label}}</span>
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
            <div class="col-md-6 mx-auto">
                <div class="card ">
                    <div class="card-header">
                        <h3>{{ __('Update')}} {{$label}}</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.category-types.update', $categoryType->id) }}" method="post"class="ajaxForm">
                            @csrf
                            <input type="hidden" name="request_with" value="update">
                            <div class="row">
                                <div class="col-md-6">   
                                    <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                                        <label for="name" class="control-label">{{ ' Display Name' }}<span class="text-red">*</span></label>
                                        <a href="javascript:void(0);" title="@lang('admin/tooltip.edit_category_types_name')"><i class="ik ik-help-circle text-muted ml-1"></i></a>
                                        <input class="form-control" name="name" type="text" pattern="[a-zA-Z]+.*" title="Please enter first letter alphabet and at least one alphabet character is required." title="Please enter first letter alphabet and at least one alphabet character is required." id="name" value="{{ isset($categoryType->name) ? $categoryType->name : ''}}" required>
                                    </div>
                                </div>
                                <div class="col-md-6">   
                                    <div class="form-group {{ $errors->has('allowed_level') ? 'has-error' : ''}}">
                                        <label for="allowed_level">{{ __('Allowed Level')}}<span class="text-red">*</span></label>
                                        <a href="javascript:void(0);" title="@lang('admin/tooltip.edit_category_types_allowed_level')"><i class="ik ik-help-circle text-muted ml-1"></i></a>
                                        <select required name="allowed_level" id="allowed_level" class="form-control select2">
                                            <option value="" readonly>{{ __('Select Allowed Level')}}</option>
                                            <option value="1" {{ $categoryType->allowed_level == 1 ? 'selected' : ''}}>{{ __('1 - One Level')}}</option> 
                                            <option value="2" {{ $categoryType->allowed_level == 2 ? 'selected' : ''}}>{{ __('2 - Two Level')}}</option>
                                            <option value="3" {{ $categoryType->allowed_level == 3 ? 'selected' : ''}}>{{ __('3 - Three Level')}}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12">  
                                    <div class="form-group {{ $errors->has('remark') ? 'has-error' : ''}}">
                                        <label for="remark" class="control-label">{{ 'Remark' }}</label>
                                        <a href="javascript:void(0);" title="@lang('admin/tooltip.edit_category_types_remark')"><i class="ik ik-help-circle text-muted ml-1"></i></a>
                                        <input class="form-control" rows="5" name="remark" type="textarea" id="remark" value="{{ isset($categoryType->remark) ? $categoryType->remark : ''}}">
                                    </div>
                                </div>
                                <div class="form-group mx-3">
                                <button type="submit" class="btn btn-primary">Save & Update</button>
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
    {{-- START AJAX FORM INIT --}}
      <script src="{{ asset('admin/js/ajaxForm.js') }}"></script>
      <script>
        $('.ajaxForm').on('submit',function(e){
            e.preventDefault();
            var route = $(this).attr('action');
            var method = $(this).attr('method');
            var data = new FormData(this);
            var response = postData(method,route,'json',data,null,null);
            var redirectUrl = "{{url('admin/category-types')}}";
            if(typeof(response) != "undefined" && response !== null && response.status == "success"){
                window.location.href = redirectUrl;
            }
            })
      </script>
    {{-- END AJAX FORM INIT --}}

    @endpush
@endsection
