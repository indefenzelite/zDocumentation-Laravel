@extends('layouts.main') 
@section('title', $label)
@section('content')
@php
$breadcrumb_arr = [
    ['name'=>'Edit'.$label, 'url'=> "javascript:void(0);", 'class' => '']
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
        <form action="{{ route('admin.mail-sms-templates.update', $mailSmsTemplate->id) }}" method="post"class="ajaxForm">
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
                            <input type="hidden" name="request_with" value="update">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group {{ $errors->has('code') ? 'has-error' : ''}}">
                                        <label for="code" class="control-label">{{ 'Code' }}<span class="text-red">*</span></label>
                                        <a href="javascript:void(0);" title="@lang('admin/tooltip.edit_mail_sms_template_code')"><i class="ik ik-help-circle text-muted ml-1"></i></a>
                                        <input class="form-control" name="code" type="text"  pattern="[a-zA-Z]+.*" title="Please enter first letter alphabet and at least one alphabet character is required." title="Please enter first letter alphabet and at least one alphabet character is required."id="code" required value="{{ isset($mailSmsTemplate->code) ? $mailSmsTemplate->code : ''}}" required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group {{ $errors->has('purpose') ? 'has-error' : '' }}">
                                        <label for="purpose"class="control-label">{{ 'Purpose' }}<span class="text-danger">*</span></label>
                                        <a href="javascript:void(0);" title="@lang('admin/tooltip.edit_mail_sms_template_purpose')"><i class="ik ik-help-circle text-muted ml-1"></i></a>
                                        <textarea class="form-control" rows="3" name="purpose" pattern="[a-zA-Z]+.*" title="Please enter first letter alphabet and at least one alphabet character is required." title="Please enter first letter alphabet and at least one alphabet character is required." placeholder="Text Info" type="textarea" id="purpose">{{ $mailSmsTemplate->purpose }}</textarea>
                                    </div>
                                </div>
                                @if($mailSmsTemplate->variables != null)
                                <div class="col-md-12 alert alert-info">
                                        <label for="">You can put these variables under content:</label><br>
                                        @foreach ($mailSmsTemplate->variables as $item)
                                            {{ $item }}@if(!$loop->last), @endif
                                        @endforeach
                                </div>
                                @endif
                                <div class="col-12 mx-auto">
                                    <div class="form-group {{ $errors->has('content') ? 'has-error' : '' }}">
                                        <label for="content" class="control-label">{{ 'Content' }}</label><span class="text-danger">*</span>
                                        {!! getHelp('Content for your Mail') !!}
                                        <div id="toolbar-container"></div>
                                        @if($mailSmsTemplate->type == 1)
                                        <div id="txt_area">
                                            {!! $mailSmsTemplate->content !!}
                                        </div>
                                        @else
                                        <div id="mail-content">
                                            <textarea name="content" class="form-control ck-editor description" rows="5">{{ $mailSmsTemplate->content }}</textarea>
                                        </div>
                                        @endif
                                       
                                        
                                    </div>
                                </div>
                            </div>       
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h3>Subject</h3>
                            <button type="submit" class="btn btn-primary">Save & Update</button>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group {{ $errors->has('subject') ? 'has-error' : ''}}">
                                        <label for="subject" class="control-label">{{ 'Subject' }}<span class="text-red">*</span></label>
                                        <a href="javascript:void(0);" title="@lang('admin/tooltip.edit_mail_sms_template_subject')"><i class="ik ik-help-circle text-muted ml-1"></i></a>
                                        <input class="form-control" name="subject" type="text"  pattern="[a-zA-Z]+.*" title="Please enter first letter alphabet and at least one alphabet character is required." title="Please enter first letter alphabet and at least one alphabet character is required." id="subject"  required value="{{ isset($mailSmsTemplate->subject) ? $mailSmsTemplate->subject : ''}}" required>
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
    {{-- START DECOUPLEDEDITOR INIT --}}
    <script src="https://cdn.ckeditor.com/ckeditor5/37.1.0/decoupled-document/ckeditor.js"></script>
    <script>
        let editor;
        $(window).on('load', function (){
            var type = '{{$mailSmsTemplate->type}}';
            if(type == 1){
                $('#txt_area').addClass('ck-editor');
                DecoupledEditor
                .create( document.querySelector('.ck-editor'),{
                    ckfinder: {
                        uploadUrl: "{{route('admin.media.ckeditor.upload').'?_token='.csrf_token()}}",
                    }
                })
                .then( newEditor => {
                    editor = newEditor;
                    const toolbarContainer = document.querySelector( '#toolbar-container' );
        
                    toolbarContainer.appendChild( editor.ui.view.toolbar.element );
                } )
                .catch( error => {
                    console.error( error );
                } );
            }else{
                var content = $('#description').val();
                    $('#mail-content').html('<textarea  class="form-control" name="sms_content" id="description" placeholder="Enter Content">{{$mailSmsTemplate->content}}</textarea>');
                }
        }); 
    </script>
    
{{-- END DECOUPLEDEDITOR INIT --}}  

    {{-- START AJAX FORM INIT --}}
    <script src="{{ asset('admin/js/ajaxForm.js') }}"></script>
    <script>
        // STORE DATA USING AJAX
        $('.ajaxForm').on('submit',function(e){
            e.preventDefault();
            if ("{{$mailSmsTemplate->type}}" == 1) {
                var tempDescription = editor.getData();
            } else {
                var tempDescription = $('#description').val();
            }
            var route = $(this).attr('action');
            var method = $(this).attr('method');
            var data = new FormData(this);
            const description = tempDescription;
            data.append('content',description);
            var response = postData(method,route,'json',data,null,null);
            var redirectUrl = "{{url('admin/mail-sms-templates')}}";
            if(typeof(response) != "undefined" && response !== null && response.status == "success"){
                window.location.href = redirectUrl;
            }
        })
    </script>
    {{-- END AJAX FORM INIT --}}
    @endpush
@endsection
