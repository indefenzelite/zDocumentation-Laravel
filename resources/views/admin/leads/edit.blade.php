@extends('layouts.main') 
@section('title', $label)
@section('content')
@php
$breadcrumb_arr = [
    ['name'=>'Edit'.''.$label, 'url'=> "javascript:void(0);", 'class' => '']
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
        <form action="{{ route('admin.leads.update', $lead->id) }}" method="post" class="ajaxForm" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <!-- start message area-->
                @include('admin.include.message')
                <!-- end message area-->
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h3>{{ __('Update')}} {{$label}}</h3>
                        </div>
                        <div class="card-body">
                            <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                            <input type="hidden" name="lead_type_id" value="19">
                            <div class="row">
                                <div class="col-md-4"> 
                                    <div class="form-group {{ $errors->has('type_id') ? 'has-error' : ''}}">
                                        <label for="lead_type_id" class="control-label">{{ 'Status' }} </label>
                                        <a href="javascript:void(0);" title="@lang('admin/tooltip.edit_lead_type_id')"><i class="ik ik-help-circle text-muted ml-1"></i></a>
                                        <select name="lead_type_id" class="form-control select2" id="">
                                            <option value="" readonly>Select Type</option>
                                            @forelse ($status_categories as $type_category)
                                                <option value="{{ $type_category->id }}" @if ($lead->lead_type_id == $type_category->id)
                                                    selected
                                                @endif>{{ $type_category->name }}</option>

                                            @empty    
                                            @endforelse
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4"> 
                                    <div class="form-group {{ $errors->has('lead_source_id') ? 'has-error' : ''}}">
                                        <label for="lead_source_id" class="control-label">{{ 'Source' }} </label>
                                         <a href="javascript:void(0);" title="@lang('admin/tooltip.edit_lead_source_id')"><i class="ik ik-help-circle text-muted ml-1"></i></a>
                                         <select name="lead_source_id" class="form-control select2" id="">
                                            @forelse ($source_categories as $source_category)
                                                <option value="{{ $source_category->id }}" 
                                                    {{ $lead->lead_source_id == $source_category->id ? 'selected' : ''}}>
                                                    {{ $source_category->name }}
                                                </option>

                                            @empty 
                                            @endforelse
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group {{ $errors->has('category_id') ? 'has-error' : ''}}">
                                        <label for="lead_source_id" class="control-label">{{ 'Category' }} <span class="text-red">*</span> </label>
                                        <a href="javascript:void(0);" title="@lang('admin/tooltip.add_lead_source_id')"><i class="ik ik-help-circle text-muted ml-1"></i></a>
                                        <select name="category_id" id="" class="form-control select2">
                                            <option value="" selected disabled> Select Category</option>
                                            @foreach ($type_categories as $category)
                                                <option value="{{ $category->id }}"   {{ $lead->category_id == $category->id ? 'selected' : ''}}>{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                {{-- <div class="col-md-4"> 
                                    <div class="form-group {{ $errors->has('status') ? 'has-error' : ''}}">
                                        <label for="status" class="control-label">{{ 'Status' }} </label>
                                        {!! getHelp('Used to define status of a lead') !!}
                                        <select name="status" class="form-control select2" id="">
                                            @forelse ($status_categories as $status_category)
                                                <option value="{{ $status_category->id }}"{{ $lead->status == $status_category->id ? 'selected' : ''}}>{{ $status_category->name }}</option>

                                            @empty 
                                            @endforelse
                                        </select>
                                    </div>
                                </div>
                                 --}}
                                
                                <div class="col-md-12"> 
                                    <div class="form-group {{ $errors->has('remark') ? 'has-error' : ''}}">
                                        <label for="remark" class="control-label">{{ 'Remark' }} </label>
                                        <a href="javascript:void(0);" title="@lang('admin/tooltip.edit_lead_remark')"><i class="ik ik-help-circle text-muted ml-1"></i></a>
                                        <textarea class="form-control" rows="5" name="remark" type="textarea" id="remark" placeholder="Enter R$categoryemark" >{{ isset($lead->remark) ? $lead->remark : ''}}</textarea>
                                    </div>
                                </div>
                            </div> 
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header justify-content-between pb-1">
                            <h4 class="card-title">Personal Info</h4>
                            <button class="btn btn-primary" type="submit"> Save & Update</button>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md-12 {{ $errors->has('name') ? 'has-error' : ''}}">
                                    <label for="name" class="control-label">{{ 'Name' }} <span class="text-red">*</span> </label>
                                    <a href="javascript:void(0);" title="@lang('admin/tooltip.edit_lead_name')"><i class="ik ik-help-circle text-muted ml-1"></i></a>
                                    <input class="form-control" name="name" type="text" pattern="[a-zA-Z]+.*" title="Please enter first letter alphabet and at least one alphabet character is required." title="Please enter first letter alphabet and at least one alphabet character is required." id="name" placeholder="Enter Name" value="{{ isset($lead->name) ? $lead->name : ''}}" required>
                                </div>
                                <div class="form-group col-md-12 {{ $errors->has('owner_email') ? 'has-error' : ''}}">
                                    <label for="owner_email" class="control-label">{{ 'Email' }} </label>
                                    <a href="javascript:void(0);" title="@lang('admin/tooltip.edit_lead_email')"><i class="ik ik-help-circle text-muted ml-1"></i></a>
                                    <input class="form-control" name="owner_email" pattern="[a-zA-Z]+.*" title="Please enter first letter alphabet and at least one alphabet character is required." title="Please enter first letter alphabet and at least one alphabet character is required." type="email" id="owner_email" placeholder="Enter Owner Email" value="{{ isset($lead->owner_email) ? $lead->owner_email : ''}}">
                                </div>
                                <div class="form-group col-md-12 {{ $errors->has('Phone') ? 'has-error' : ''}}">
                                    <label for="phone" class="control-label">{{ 'Phone' }}  </label>
                                    <a href="javascript:void(0);" title="@lang('admin/tooltip.edit_lead_phone')"><i class="ik ik-help-circle text-muted ml-1"></i></a>
                                    <input class="form-control" name="phone" pattern="^[0-9]*$" min="0"  type="number" id="phone" placeholder="Enter Phone" value="{{ isset($lead->phone) ? $lead->phone : ''}}" >
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group {{ $errors->has('address') ? 'has-error' : ''}}">
                                        <label for="address"  class="control-label">{{ 'address' }} </label>
                                        <a href="javascript:void(0);" title="@lang('admin/tooltip.edit_lead_address')"><i class="ik ik-help-circle text-muted ml-1"></i></a>
                                        <textarea input type="text" pattern="[a-zA-Z]+.*" title="Please enter first letter alphabet and at least one alphabet character is required." title="Please enter first letter alphabet and at least one alphabet character is required." class="form-control" id="address" placeholder="Enter the Address" name="address" value="{{ isset($lead->address) ? $lead->address : ''}}">{{$lead->address}}</textarea>
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
        })
    </script>
    {{-- END AJAX FORM INIT --}}
    @endpush
@endsection
