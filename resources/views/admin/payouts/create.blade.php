@extends('layouts.main') 
@section('title', 'Payout')
@section('content')
@php
/**
 * Payout 
 *
 * @category  zStarter
 *
 * @ref  zCURD
 * @author    Defenzelite <hq@defenzelite.com>
 * @license  https://www.defenzelite.com Defenzelite Private Limited
 * @version  <zStarter: 1.1.0>
 * @link        https://www.defenzelite.com
 */
$breadcrumb_arr = [
    ['name'=>'Add Payout', 'url'=> "javascript:void(0);", 'class' => '']
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
                            <h5>Add Payout</h5>
                            <span>Create a record for Payout</span>
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
                        <h3>Create Payout</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.payouts.store') }}" method="post" enctype="multipart/form-data" id="PayoutForm">
                            @csrf
                            <input type="hidden" name="request_with" value="create">
                            <div class="row">
                                <div class="col-md-6 col-12"> 
                                    <div class="form-group">
                                        <label for="user_id">User <span class="text-danger">*</span></label>
                                        <select required name="user_id" id="user_id" class="form-control select2">
                                            <option value="" readonly>Select User </option>
                                            @foreach($users  as $user)
                                                <option value="{{ $user->id }}" {{  old('user_id') == $user->id ? 'Selected' : '' }}>{{ $user->id->full_name}}</option> 
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12"> 
                                    <div class="form-group {{ $errors->has('amount') ? 'has-error' : ''}}">
                                        <label for="amount" class="control-label">Amount<span class="text-danger">*</span> </label>
                                        <input required  class="form-control" name="amount" type="number" id="amount" value="{{old('amount')}}" placeholder="Enter Amount" >
                                    </div>
                                </div>
                                <div class="col-md-6 col-12"> 
                                    <div class="form-group">
                                        <label for="type">Type</label>
                                        <select  name="type" id="type" class="form-control select2">
                                            <option value="" readonly>Select Type</option>
                                    </select>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12"> 
                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <select  name="status" id="status" class="form-control select2">
                                            <option value="" readonly>Select Status</option>
                                         </select>
                                    </div>
                                </div>
                                                                                            
                                <div class="col-md-6 col-12"> 
                                    <div class="form-group">
                                        <label for="approved_by">Approved By</label>
                                        <select  name="approved_by" id="approved_by" class="form-control select2">
                                            <option value="" readonly>Select Approved By</option>
                                                                                    </select>
                                    </div>
                                </div>
                                                                                            
                                <div class="col-md-6 col-12"> 
                                    <div class="form-group {{ $errors->has('approved_at') ? 'has-error' : ''}}">
                                        <label for="approved_at" class="control-label">Approved At<span class="text-danger">*</span> </label>
                                        <input   class="form-control" name="approved_at" type="date" id="approved_at" value="{{old('approved_at')}}" placeholder="Enter Approved At" >
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
    <script src="{{ asset('admin/plugins/mohithg-switchery/dist/switchery.min.js') }}"></script>
        <script>
        $('#PayoutForm').validate();
                                                                                                                                
    </script>
    @endpush
@endsection
