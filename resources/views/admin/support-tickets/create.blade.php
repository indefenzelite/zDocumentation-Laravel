@extends('layouts.main') 
@section('title', $label)

@php
    $breadcrumb_arr = [
        ['name'=>$label, 'url'=> "javascript:void(0);", 'class' => 'active']
        ]
@endphp
@push('head')
@endpush

@section('content')

    <div class="container-fluid">
    	<div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-grid bg-blue"></i>
                        <div class="d-inline">
                            <h5>{{$label}}</h5>
                            <span>List of {{$label}}</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    @include("admin.include.breadcrumb")
                </div>
            </div>
        </div>
        <form action="{{route('admin.support-tickets.store')}}" method="post" class="ajaxForm row">
            @csrf

            <div class="col-md-4 mx-auto">
                <div class="card mb-2">
                    <div class="card-header">
                        <h3>Ticket For</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">               
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="type">User Name<span class="text-red">*</span></label>
                                    <a href="javascript:void(0);" title="@lang('admin/tooltip.add_support_ticket_username')"><i class="ik ik-help-circle text-muted ml-1"></i></a>
                                    <select name="user_id" class="form-control getUsersList"  data-placeholder="Select Users" style="width: 125px;">
                                        <option value=""aria-readonly="true">Select Users</option>
                                    </select>
                                </div>  
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mb-2">
                    <div class="card-header">
                        <h3>Priority</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="gender">{{ __('Priority')}}</label>
                                    <a href="javascript:void(0);" title="@lang('admin/tooltip.add_support_ticket_priority')"><i class="ik ik-help-circle text-muted ml-1"></i></a>
                                    <div class="form-radio">
                                        <div class="radio radio-inline radio-success">
                                            <label>
                                                <input type="radio" name="priority" value="0">
                                                <i class="helper"></i>{{ __('Low')}}
                                            </label>
                                        </div>
                                        <div class="radio radio-inline radio-warning">
                                            <label>
                                                <input type="radio" name="priority" value="1"checked>
                                                <i class="helper"></i>{{ __('Medium')}}
                                            </label>
                                        </div>
                                        <div class="radio radio-inline radio-danger">
                                            <label>
                                                <input type="radio" name="priority" value="2">
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
                <div class="card mb-2">
                    <div class="card-header">
                        <h3>Category</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="type">Category<span class="text-red">*</span></label>
                                    <a href="javascript:void(0);" title="@lang('admin/tooltip.add_support_ticket_category')"><i class="ik ik-help-circle text-muted ml-1"></i></a>
                                    <select type="text" required name="ticket_type_id" data-flag="0" class="form-control select2 category_id" id="supportTicketCategoryId" >
                                        <option value="">Select Category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{$category->id}}" >{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8 mx-auto sticky">

                {{-- <form action="{{route('admin.support-tickets.store')}}" method="post" class="ajaxForm"> --}} 
                    <input type="hidden" name="request_with" value="create">
                    <div class="card mb-2">
                        <div class="card-header d-flex justify-content-between">
                            <h3>Ticket Details </h3>
                            <button class="btn btn-primary" type="submit">Create Ticket</button>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="name" class="control-label">Subject<span class="text-red">*</span></label>
                                        <a href="javascript:void(0);" title="@lang('admin/tooltip.add_support_ticket_subject')"><i class="ik ik-help-circle text-muted ml-1"></i></a>
                                        <select name="subject" id="subject" class="form-control select2">
                                            <option value="">Select Subject</option>
                                            <option value="General Support">General Support</option>
                                           <option value="Facing problems using their system">Facing problems using their system</option>
                                        </select>
                                    </div>
                                    <div class="form-group ">
                                        <label for="value" class="control-label">Body<span class="text-red">*</span></label>
                                        <a href="javascript:void(0);" title="@lang('admin/tooltip.add_support_ticket_body')"><i class="ik ik-help-circle text-muted ml-1"></i></a>
                                        <textarea  class="form-control"cols="30" rows="10" name="message" type="text" id="value"  value=""  placeholder="Enter Here" required></textarea>
                                     
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group ">
                                        <label for="name" class="control-label">Subject<span class="text-red">*</span></label>
                                        <select name="subject" id="subject" class="form-control select2">
                                            <option value="">Select Subject</option>
                                            <option value="General Support">General Support</option>
                                           <option value="Facing problems using their system">Facing problems using their system</option>
                                        </select>
                                    </div>
                                </div>
                                 <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="type">Customer<span class="text-red">*</span></label>
                                        <select type="text" name="user_id" class="form-control select2" id="">
                                            <option value="" readonly>Select User</option>
                                            @foreach ($users as $user)
                                            <option value="{{$user->id}}">{{$user->full_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                 </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="type">Category<span class="text-red">*</span></label>
                                        <select type="text" name="ticket_type_id" class="form-control" id="">
                                            @foreach ($categories as $category)
                                            <option value="{{$category->id}}" >{{$category->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="type">Priority<span class="text-red">*</span></label>
                                        <select required name="assigned_to" id="type" class="form-control select2">
                                            <option value="" readonly>Select Priority</option>
                                            @foreach ($priorities as $key => $priority)
                                            <option value="{{$key}}">{{$priority['label']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div> 
                                <div class="col-md-12">
                                    <div class="form-group ">
                                        <label for="value" class="control-label">Body<span class="text-red">*</span></label>
                                        <textarea  class="form-control" name="message" type="text" id="value"  value=""  placeholder="Enter Here" required></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <button class="btn btn-primary" type="submit">Save</button>
                                </div>
                            </div> 
                        </div>  --}}
                    </div>
                {{-- </form> --}}
            </div>
        </form>
    </div>
    @include('admin.include.add-category',['level' =>1,'category_type_code' => 'SupportTicketCategories'])
@endsection

@push('script')

<script src="{{asset('admin/js/jquery.validate.js') }}"></script>
    <script src="{{asset('admin/js/jquery.validate.min.js') }}"></script>
@include('admin.include.script.modal-script')

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

{{-- START GET USER INIT --}}
<script>
     $(document).ready(function(){
        getUsers();
    })
</script>
{{-- END GET USER INIT --}}
@endpush

