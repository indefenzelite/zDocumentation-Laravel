@extends('layouts.main')
@section('title', 'Add '.$label)
@section('content')
@php
    $breadcrumb_arr = [
    ['name'=>'Add '.$label, 'url'=> "javascript:void(0);", 'class' => '']
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
                        <h5>{{ __('Create New') }}{{$label}}</h5>
                        <span>{{ __('Add a new record for')}}{{$label}}</span>
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
    <form action="{{ route('admin.mail-sms-templates.store') }}"method="post" class="ajaxForm">
        @csrf
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3>{{ __('Add '.$label) }}</h3>
                    </div>
                    <div class="card-body">
                        <input type="hidden" name="request_with" value="create">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group {{ $errors->has('code') ? 'has-error' : '' }}">
                                    <label for="code" class="control-label">{{ 'Code' }}<span class="text-red">*</span></label>
                                    <a href="javascript:void(0);" title="@lang('admin/tooltip.add_mail_sms_template_code')"><i class="ik ik-help-circle text-muted ml-1"></i></a>
                                    <input class="form-control" name="code" type="text"  pattern="[a-zA-Z]+.*" title="Please enter first letter alphabet and at least one alphabet character is required." title="Please enter first letter alphabet and at least one alphabet character is required." id="code" value="{{ old('code') }}"
                                        placeholder="Enter Code" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group {{ $errors->has('subject') ? 'has-error' : '' }}">
                                    <label for="subject" class="control-label">{{ 'Subject' }}<span
                                            class="text-red">*</span></label>
                                            <a href="javascript:void(0);" title="@lang('admin/tooltip.add_mail_sms_template_subject')"><i class="ik ik-help-circle text-muted ml-1"></i></a>
                                    <input class="form-control" name="subject" type="text"  pattern="[a-zA-Z]+.*" title="Please enter first letter alphabet and at least one alphabet character is required." title="Please enter first letter alphabet and at least one alphabet character is required." id="subject" value="{{ old('subject') }}"
                                        placeholder="Enter Subject" required>
                                </div>
                                <span class="alert d-block mt-2 alert-warning">
                                    Content is editable after creation
                                </span>
                            </div>

                            
                            <div class="form-group mx-3 text-right">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h3> Subject</h3>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group {{ $errors->has('type') ? 'has-error' : '' }}">
                                    <label for="type">{{ __('Type') }}<span class="text-red">*</span></label>
                                     <a href="javascript:void(0);" title="@lang('admin/tooltip.add_mail_sms_template_type')"><i class="ik ik-help-circle text-muted ml-1"></i></a>
                                    <select required name="type" id="mailType" class="form-control">
                                        <option @if(request()->get('type') == 1) selected  @endif value="1">{{ __('Mail (Rich Texteditor)') }}</option>
                                        <option @if(request()->get('type') == 2) selected  @endif  value="2">{{ __('SMS (Plain Texteditor)') }}</option>
                                        <option @if(request()->get('type') == 3) selected  @endif  value="3">{{ __('Whatsapp (Plain Texteditor)') }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group {{ $errors->has('purpose') ? 'has-error' : '' }}">
                                    <label for="purpose"class="control-label">{{ 'Purpose' }}</label>
                                    <a href="javascript:void(0);" title="@lang('admin/tooltip.add_mail_sms_template_purpose')"><i class="ik ik-help-circle text-muted ml-1"></i></a>
                                    <textarea class="form-control" rows="3" name="purpose" placeholder="Enter Purpose" type="textarea" id="purpose">{{ old('purpose') }}</textarea>
                                </div>
                            </div>
                           <div class="col-md-12">
                               <label for="purpose"class="control-label">{{ 'Default Template' }}</label>
                               <a href="javascript:void(0);" title="@lang('admin/tooltip.add_mail_sms_template_default')"><i class="ik ik-help-circle text-muted ml-1"></i></a>
                                <div class="form-radio form-group">
                                    <div class="radio radio-inline">
                                        <label>
                                            <input type="radio" name="is_default" value="1">
                                            <i class="helper"></i>{{ __('Make Default') }}
                                        </label>
                                    </div>
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
            var redirectUrl = "{{url('admin/mail-sms-templates/')}}";
            if(typeof(response) != "undefined" && response !== null && response.status == "success"){
                window.location.href = redirectUrl;
            }
        })
</script>
{{-- END AJAX FORM INIT --}}
@endpush
@endsection
