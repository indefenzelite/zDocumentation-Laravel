@extends('layouts.main') 

@section('title', $label)
@section('content')
@php
$breadcrumb_arr = [
    ['name'=>'Edit'.' '.$label, 'url'=> "javascript:void(0);", 'class' => '']
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
        <!-- start message area-->
        @include('admin.include.message')
        <!-- end message area-->
        <form action="{{ route('admin.support-tickets.update',$supportTicket->id) }}" method="post" class="ajaxForm">
            @csrf
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h3>User Name</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="type">Customer<span class="text-red">*</span></label>
                                         <a href="javascript:void(0);" title="@lang('admin/tooltip.edit_support_ticket_name')"><i class="ik ik-help-circle text-muted ml-1"></i></a>
                                         <select type="text" name="user_id" class="form-control select2" id="">
                                            <option value="" readonly>Select User</option>
                                            @foreach ($users as $user)
                                            <option value="{{$user->id}}"{{$supportTicket->user_id == $user->id ? 'selected' : ''}}>{{$user->full_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>  
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h3>Priority</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="gender">{{ __('Priority')}}</label>
                                        <a href="javascript:void(0);" title="@lang('admin/tooltip.edit_support_ticket_priority')"><i class="ik ik-help-circle text-muted ml-1"></i></a>
                                        <div class="form-radio">
                                            <div class="radio radio-inline">
                                                <label>
                                                    <input type="radio" name="priority" value="0"{{ $supportTicket->priority == 'Low' ? 'checked' : '' }}>
                                                    <i class="helper"></i>{{ __('Low')}}
                                                </label>
                                            </div>
                                            <div class="radio radio-inline">
                                                <label>
                                                    <input type="radio" name="priority" value="1"{{ $supportTicket->priority == 'Medium' ? 'checked' : '' }}>
                                                    <i class="helper"></i>{{ __('Medium')}}
                                                </label>
                                            </div>
                                            <div class="radio radio-inline">
                                                <label>
                                                    <input type="radio" name="priority" value="2"{{ $supportTicket->priority == 'High' ? 'checked' : '' }}>
                                                    <i class="helper"></i>{{ __('High')}}
                                                </label>
                                            </div>
                                        </div>                                        
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h3>Category</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="type">Category<span class="text-red">*</span></label>
                                         <a href="javascript:void(0);" title="@lang('admin/tooltip.edit_support_ticket_category')"><i class="ik ik-help-circle text-muted ml-1"></i></a>
                                         <select type="text" name="ticket_type_id" class="form-control select2" id="">
                                            @foreach ($categories as $category)
                                                <option value="{{$category->id}}"{{$supportTicket->ticket_type_id == $category->id ? 'selected' : ''}}>{{$category->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <input type="hidden" name="request_with" value="update">
                    <div class="card ">
                        <div class="card-header justify-content-between">
                            <h3>{{ __('Edit Support Ticket')}}</h3>
                            <button class="btn btn-primary" type="submit">Save & Update Ticket</button>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group ">
                                        <label for="name" class="control-label">Subject<span class="text-red">*</span></label>
                                        <a href="javascript:void(0);" title="@lang('admin/tooltip.edit_support_ticket_subject')"><i class="ik ik-help-circle text-muted ml-1"></i></a>
                                        <select name="subject" id="subject" class="form-control select2">
                                            <option value="">Select Subject</option>
                                            <option value="General Support" {{$supportTicket->subject == "General Support" ? 'selected' : ''}}>General Support</option>
                                            <option value="Facing problems using their system" {{$supportTicket->subject == "Facing problems using their system" ? 'selected' : ''}}>Facing problems using their system</option>
                                        </select>
                                    </div>
                                </div>
                                    <div class="col-md-12">
                                    <div class="form-group ">
                                        <label for="value" class="control-label">Body<span class="text-red">*</span></label>
                                        <a href="javascript:void(0);" title="@lang('admin/tooltip.edit_support_ticket_body')"><i class="ik ik-help-circle text-muted ml-1"></i></a>
                                        <textarea  class="form-control"cols="30" rows="10" name="message" type="text" id="value"  value=""  placeholder="Enter Here" required>{{$supportTicket->message}}</textarea>
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
                var redirectUrl = "{{url('admin/support-tickets')}}";
                if(typeof(response) != "undefined" && response !== null && response.status == "success"){
                    window.location.href = redirectUrl;
                }
            })
        </script>
    {{-- END AJAX FORM INIT --}}
    @endpush
@endsection
