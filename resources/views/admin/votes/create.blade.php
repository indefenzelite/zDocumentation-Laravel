@extends('layouts.main') 
@section('title', 'Vote')
@section('content')
@php
/**
 * Vote 
 *
 * @category ZStarter
 *
 * @ref zCURD
 * @author  Defenzelite <hq@defenzelite.com>
 * @license https://www.defenzelite.com Defenzelite Private Limited
 * @version <zStarter: 1.1.0>
 * @link    https://www.defenzelite.com
 */
$breadcrumb_arr = [
    ['name'=>'Vote', 'url'=>  route('admin.votes.index')  , 'class' => ''],
    ['name'=>'Add Vote', 'url'=> "javascript:void(0);", 'class' => 'Active']
]
@endphp
    <!-- push external head elements to head -->
    @push('head')
    <link rel="stylesheet" href="{{ asset('admin/plugins/mohithg-switchery/dist/switchery.min.css') }}">
    <style>
        .error{
            color:red;
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
                            <h5>Add Vote</h5>
                            <span>Create a record for Vote</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    @include('admin.include.breadcrumb')
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 mx-auto">
                <!-- start message area-->
               @include('admin.include.message')
                <!-- end message area-->
                <div class="card ">
                    <div class="card-header">
                        <h3>Create Vote</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.votes.store') }}" method="post" enctype="multipart/form-data" class="ajaxForm" id="VoteForm">
                            @csrf
                            <input type="hidden" name="request_with" value="create">
                            <div class="row">
                                                                                                
                                <div class="col-md-4 col-12"> 
                                    <div class="form-group">
                                        <label for="faq_id">Faq <span class="text-danger">*</span></label>
                                        <select required   name="faq_id" id="faq_id" class="form-control select2">
                                            <option value="" readonly>Select Faq </option>
                                            @foreach(App\Models\Faq::all()  as $option)
                                                <option value="{{ $option->id }}" {{  old('faq_id') == $option->id ? 'Selected' : '' }}>{{  $option->name ?? ''}}</option> 
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                                                                            
                                <div class="col-md-4 col-12"> 
                                    <div class="form-group">
                                        <label for="status">Status<span class="text-danger">*</span></label>
                                        <select required   name="status" id="status" class="form-control select2">
                                            <option value="" readonly>Select Status</option>                                            
                                            @php
                                                    $arr = ["Up","Down"];
                                            @endphp
                                                @foreach(getSelectValues($arr) as $key => $option)
                                                    <option value="{{  $option }}" {{  old('status') == $option ? 'selected' : '' }}>{{ $option}}</option> 
                                                @endforeach                                         
                                        </select>
                                    </div>
                                </div>
                                                                                                                                
                                <div class="col-md-4 col-12"> 
                                    <div class="form-group">
                                        <label for="user_id">User </label>
                                        <select    name="user_id" id="user_id" class="form-control select2">
                                            <option value="" readonly>Select User </option>
                                            @foreach(App\Models\User::all()  as $option)
                                                <option value="{{ $option->id }}" {{  old('user_id') == $option->id ? 'Selected' : '' }}>{{  $option->name ?? ''}}</option> 
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                                                                            
                                <div class="col-md-12 col-12"> 
                                    <div class="form-group">
                                        <label for="ip_address" class="control-label">Ip Address </label>
                                        <textarea  class="form-control" name="ip_address" id="ip_address" placeholder="Enter Ip Address">{{ old('ip_address')}}</textarea>
                                    </div>
                                </div>
                                                            
                                                        
                                <div class="col-md-12 ml-auto">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Create</button>
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
    <script src="{{asset('admin/plugins/mohithg-switchery/dist/switchery.min.js') }}"></script>
    <script src="{{asset('admin/js/form-advanced.js') }}"></script>
    <script>
        $('#VoteForm').validate();
        $('.ajaxForm').on('submit',function(e){
            e.preventDefault();
            let route = $(this).attr('action');
            let method = $(this).attr('method');
            let data = new FormData(this);
            let response = postData(method,route,'json',data,null,null);
            if(typeof(response) != "undefined" && response !== null && response.status == "success"){
                $('.ajaxForm').attr('action','{{ url("admin/votes/update")}}/'+response.id);
                history.pushState({},"Tests","{{ url('admin/votes')}}"+'/edit/'+response.id);
            }
        })
                                                                                                
                
    </script>
    @endpush
@endsection




