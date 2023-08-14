@extends('layouts.main') 
@section('title', 'Support Tickets')

@php
    $breadcrumb_arr = [
        ['name'=>'Support Tickets', 'url'=> "javascript:void(0);", 'class' => 'active']
        ]
@endphp
@section('content')
  <style>
    .chat{
       border: none;
       border-radius: 5px;
       padding: 0.5em;
    }
   .chat-left{
        align-self: flex-start;
        background-color: #fff;
        border-radius: 20px;
        border: 1px solid #cccccc6b;
        background: #fdfdfd;
    }
   .chat-right{
       text-align: right;
       align-self: flex-end;
       display: flex;
       justify-content: right;
       border-radius: 20px;
       border: 1px solid #cccccc6b;
       background: #19b5fe12;
    }
   .address-check{
       position: absolute;
        top: 0;
        right: 5px;
    }
   .scroll {
        height: 60vh;
        overflow-y: auto;
        overflow-x: hidden;
    }
    .sticky-bar { 
        position: sticky; 
        top: 80px; 
    }
    .dropdown-menu.multi-level.show{
        position: absolute;
        will-change: transform;
        top: 0px;
        left: -35px !important;
        transform: translate3d(-5px, 30px, 0px);
    }
    .btn-attachment{
        width: 50px;
        height: 50px;
        padding: 0;
        text-align: center;
        line-height: 52px;
        font-size: 20px;
        display: inline-block;
        border-radius: 50%;
        -webkit-border-radius: 50%;
        -moz-border-radius: 50%;
        -moz-transition: all 0.5s ease-in-out;
        -o-transition: all 0.5s ease-in-out;
        -webkit-transition: all 0.5s ease-in-out;
        transition: all 0.5s ease-in-out;
        position: fixed !important;
        right: 290px !important;
        bottom: 178px !important;
    }

    .myfileupload-buttonbar input
    {
        position: absolute;
        top: 0;
        right: 0;
        margin: 0;
        border: solid transparent;
        border-width: 0 0 100px 200px;
        opacity: 0.0;
        filter: alpha(opacity=0);
        -o-transform: translate(250px, -50px) scale(1);
        -moz-transform: translate(-300px, 0) scale(4);
        direction: ltr;
        cursor: pointer;
    }
    .myui-button
    {
        position: relative;
        cursor: pointer;
        text-align: center;
        overflow: visible;
        overflow: hidden;
    }
  </style>
    <div class="container-fluid">
    	<div class="row">
            <div class="col-md-12 col-lg-10 mx-auto">
                <div class="card ">
                    <div class="card-header d-flex justify-content-between">
                        <div>
                            <div class="d-flex">
                                <h3 class="mr-2">{{($supportTicket->getPrefix()) }} </h3>
                                <div>
                                    <span class="mr-2 badge badge-{{ $supportTicket->status_parsed->color}}">{{ $supportTicket->status_parsed->label }}</span>
                                </div>
                                @if($supportTicket->status != App\Models\SupportTicket::STATUS_RESOLVED)
                                    <a class="badge badge-primary" href="{{ route('admin.support-tickets.status',[$supportTicket->id,App\Models\SupportTicket::STATUS_RESOLVED]) }}">Marked Resolved</a>
                                @endif
                            </div>
                            <hr>
                            <h6 class="text-dark">
                                {{($supportTicket->subject) }}
                            </h6>
                        </div>
                      
                        <div>
                            <ul class="nav nav-pills custom-pills" id="pills-tab" role="tablist">
                           
                                <li class="nav-item">
                                    <a  data-active="details" class="nav-link active-swicher @if(request()->get('active') == "details" || !request()->has('active')) active  @endif" id="pills-profile-tab" data-type="details" data-toggle="pill" href="#last-month" role="tab" aria-controls="pills-profile" aria-selected="false">{{ __('Converstaion')}}</a>
                                </li>
                                <li class="nav-item">
                                    <a  data-active="information" class="nav-link active-swicher @if(request()->get('active') == "information") active  @endif" id="pills-information-tab" data-type="information" data-toggle="pill" href="#info-month" role="tab" aria-controls="pills-information" aria-selected="false">{{ __('Information')}}</a>
                                </li>
                                <li class="nav-item">
                                    <a data-active="attachment" class="nav-link  active-swicher @if(request()->get('active') == "attachment") active  @endif" id="pills-setting-tab" data-type="attachment" data-toggle="pill" href="#previous-month" role="tab" aria-controls="pills-setting" aria-selected="false">{{ __('Attachments')}}</a>
                                </li><br>
                            </ul>
                        </div>
                    </div>
                    
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active  @if(request()->has('active') && request()->get('active') == "details" || !request()->has('active')) show active @endif" id="last-month" role="tabpanel" aria-labelledby="pills-profile-tab">
                            <div class="card-body scroll">
                                <div class="my-1 chat no-data">
                                    @if($supportTicket->conversations != null)
                                        @foreach ($supportTicket->conversations as $index => $conversation)
                                        
                                            @if ($conversation->user_id == auth()->id())
                                                <div class="row delete-enquiry-{{$conversation->id}}" id="{{$conversation->id}}">
                                                    <div class="col-md-6"></div>
                                                    <div class="col-md-6 py-2 chat-right mb-3 bg-chat-right">
                                                        <div class="mr-3">
                                                            @if($conversation->getFirstMediaUrl('file') != '')
                                                                @if(str_contains($conversation->getFirstMedia('file')->getAttribute('mime_type'),'image'))
                                                                <img src="{{ $conversation->getFirstMediaUrl('file') }}" class="img-fluid" alt="" width="50%">
                                                                @else
                                                                {{ $conversation->getFirstMedia('file')->getAttribute('file_name') }}
                                                                @endif
                                                            @endif
                                                            <p class="p-0 m-0 text-muted fw-600">
                                                                {!! nl2br($conversation->comment) !!}
                                                            </p>
                                                            <small class="text-muted">  {{'At '.$conversation->created_at}} By {{$conversation->user->full_name}}</small>
                                                        </div>

                                                        <a href="javascript:void(0)" data-id="{{$conversation->id}}" title="Delete Conversation" class="btn mt-2 btn-sm btn-icon btn-outline-danger deleteBtn" style="display: flex;align-items: center;justify-content: center;"><i class="ik ik-trash" style="width: 30px;"></i></a>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="row">
                                                    <div class="col-md-6 py-2 chat-left mb-1">
                                                        @if($conversation->getFirstMediaUrl('file') != '')
                                                            @if(str_contains($conversation->getFirstMedia('file')->getAttribute('mime_type'),'image'))
                                                            <img src="{{ $conversation->getFirstMediaUrl('file') }}" class="img-fluid" alt="" width="50%">
                                                            @else
                                                            {{ $conversation->getFirstMedia('file')->getAttribute('file_name') }}
                                                            @endif
                                                        @endif
                                                        <p class="p-0 m-0 text-muted fw-600">
                                                            {!! nl2br($conversation->comment) !!}
                                                        </p>
                                                        <small class="text-muted">  {{'At '.$conversation->created_at}} By {{$conversation->user->full_name}}</small>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    @else
                                    <h4 class="text-muted" style="text-align: center; margin-top: 120px !important;">Conversation not started yet!</h4>
                                    @endif
                                </div> 
                                {{-- <div class="msg-card"></div>
                                <a href="javascript:void(0)" style="position: absolute;
                                right: 0;" class="btn btn-attachment btn-sm btn-outline-primary mr-2 addAttachmentBtn" title="Add Attachment">
                                    <i class="fa fa-plus" aria-hidden="true"></i>
                                </a>  --}}
                            </div>
                            <div class="card-footer p-2">
                                 @if($sender != auth()->id())
                                    <div class="alert alert-info mb-0"><strong>Note:</strong> You don't have permission to send messsage to this enquiry</div>
                                @else
                                    <div class="row">
                                        <div class="col-md-12 col-lg-12">   
                                            @if(App\Models\SupportTicket::STATUS_RESOLVED != $supportTicket->status)
                                            <form action="{{route('admin.conversations.store')}}" method="POST" class="ChatForm ajaxForm messageBox">    
                                                @csrf
                                                <input type="hidden" name="request_with" value="create" id="groupId">
                                                <input type="hidden" class="supportTicketId" name="type_id" value="{{ $supportTicket->id }}" id="groupId">
                                                <input type="hidden" name="user_id" value="{{ auth()->id() }}" >
                                                <input type="hidden" name="type" value="{{ 'Support Ticket' }}">
                                                <input type="hidden" name="receiver_id" value="{{ $receiver }}" id="receiverId">

                                                <div class="d-flex align-items-center form-group {{ $errors->has('comment') ? 'has-error' : ''}}">
                                                    <div class="w-100"> 
                                                        <textarea type="text" class="form-control required-input" name="comment" rows="1" id="message" placeholder="Type Message Here..."></textarea>
                                                        <div class="comment-error"></div>
                                                    </div>
                                                    <div class="ml-2 mt-2" id="fileupload" >
                                                        <div class="myfileupload-buttonbar ">
                                                            <label class="myui-button">
                                                               <span class="btn btn-icon btn-secondary"><i class="fa fa-paperclip" aria-hidden="true"></i></span> 
                                                                <input class="required-input" id="file" type="file" name="file" />
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="ml-2">
                                                        <button id="submit" type="submit" class="btn btn-primary btn-icon sendBtn"><i class="ik ik-navigation"></i></button>
                                                    </div>
                                                </div>
                                            </form>
                                            @else
                                            <div class="alert alert-success" style="text-align: center;">This ticket has been successfully resolved and closed! Please create another ticket for further questions</div>
                                            @endif
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="tab-pane fade  @if(request()->has('active') && request()->get('active') == "information" || !request()->has('active')) show active @endif" id="info-month" role="tabpanel" aria-labelledby="pills-information-tab">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th colspan="2">Details</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th>Name</th>
                                                <td>{{ @$supportTicket->user->name }}</td>
                                            </tr>
                                            <tr>
                                                <th>Email</th>
                                                <td>{{ @$supportTicket->user->email }}</td>
                                            </tr>
                                            <tr>
                                                <th>Phone</th>
                                                <td>{{ @$supportTicket->user->phone }}</td>
                                            </tr>
                                            <tr>
                                                <th>Subject</th>
                                                <td>{{ @$supportTicket->subject }}</td>
                                            </tr>
                                            <tr>
                                                <th>Message</th>
                                                <td>{{ @$supportTicket->message }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade  @if(request()->has('active') && request()->get('active') == "attachment" || !request()->has('active')) show active @endif" id="previous-month" role="tabpanel" aria-labelledby="pills-setting-tab">
                            <div class="card-body">
                                <div class="d-flex flex-wrap">
                                    @if($supportTicket->conversations != null)
                                        @php
                                            $count =0 ;
                                        @endphp
                                        @foreach ($supportTicket->conversations()->whereHas('media')->get() as $index => $conversation)
                                            @foreach ($conversation->getMedia('file') as $media)
                                            @php
                                                $count ++;
                                            @endphp
                                            <div class="border p-2 m-2">
                                            @if(str_contains($media->mime_type,'image'))
                                                <img src="{{ $media->getUrl() }}"class="mt-3" style="border-radius: 10px;width:144px;height:144px;"/>
                                            @else
                                            {{-- use mime type helper where u get ext name place the doc image here & use that helper @ankita --}}
                                            <div class="position-relative"><span class="position-absolute ext-title">{{ mime2ext($media->mime_type) }}</span>  <img src="{{ asset('images/file.png') }}" alt=""></div>
                                        
                                            @endif
                                            </div>
                                            @endforeach
                                        @endforeach
                                        @if($count == 0)
                                            <div class="p-5 mx-auto">No attachments were uploaded!</div>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script') 
<script src="{{ asset('admin/plugins/select2/dist/js/select2.min.js') }}"></script>
<!--get role wise permissiom ajax script-->
<script src="{{ asset('admin/js/get-role.js') }}"></script>
<script src="{{ asset('admin/plugins/moment/moment.js') }}"></script>
<script src="{{ asset('admin/plugins/tempusdominus-bootstrap-4/build/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<script src="{{ asset('admin/plugins/jquery-minicolors/jquery.minicolors.min.js') }}"></script>
<script src="{{ asset('admin/plugins/datedropper/datedropper.min.js') }}"></script>
<script src="{{ asset('admin/js/form-picker.js') }}"></script>
    {{-- START AJAX FORM INIT --}}
        <script src="{{ asset('admin/js/ajaxForm.js') }}"></script>
        <script>

               function validation(inputs){
                    var hasValue = false;
                    for (var i = 0; i < inputs.length; i++) {
                        console.log(inputs[i].value);
                        if (inputs[i].value !== '') {
                        hasValue = true;
                        break;
                        }
                    }
                    if (!hasValue) {
                        event.preventDefault();
                        $('.comment-error').html('<strong class="text-danger">Please enter your message or select any file to send!</strong>');
                        return false;
                    }
                    return true;
                }

            $('.ajaxForm').on('submit',function(e){
                e.preventDefault();
                $('.comment-error').html('');
                var inputs = document.getElementsByClassName('required-input');
                if(validation(inputs)){
                    var id = $('.supportTicketId').val();
                    var route = $(this).attr('action');
                    var method = $(this).attr('method');
                    var data = new FormData(this);
                    var response = postData(method,route,'json',data,'handleChatCalllback',null,0);
                }
            })
        </script>
    {{-- END AJAX FORM INIT --}}

    {{-- START JS HELPERS INIT --}}
    <script>
        function nl2br (str, is_xhtml) {
            if (typeof str === 'undefined' || str === null) {
                return '';
            }
            var breakTag = (is_xhtml || typeof is_xhtml === 'undefined') ? '<br />' : '<br>';
            return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1' + breakTag + '$2');
        }

        function handleChatCalllback(response){
            if(typeof(response) != "undefined" && response !== null && response.status == "success"){
                var message = $('#message').val();
                if(response.filehtml)
                message = response.filehtml;
               var delete_url = "{{url('admin/conversations/destroy')}}";
               var html = '<div class="row delete-enquiry-'+response.conversation_id+'"> <div class="col-md-6"></div><div class="col-md-6 py-2 chat-right bg-chat-right mb-3"> <div class="mr-3"> <p class="mb-0">'+nl2br(message)+'</p> <small class="text-muted">Just Now</small> </div> <a href="javascript:void(0)" title="Delete Conversation" class="btn btn-sm btn-icon btn-outline-danger deleteBtn" data-id="'+response.conversation_id+'" style="display: flex;align-items: center;justify-content: center;"><i class="ik ik-trash"></i></a> </div> </div>';
               $('.chat').append(html);
               $('#message').val('');
               $('#file').val('');
               $("html, div").animate({
                    scrollTop: $('.chat').get(0).scrollHeight
                }, 5);
            }else{
                $.toast({
                    heading: response.message,
                    text: response.title,
                    showHideTransition: 'slide',
                    icon: 'error',
                    loaderBg: '#f96868',
                    position: 'top-right'
                }); 
            }
        }

        $(document).ready(function() {
            $(document).on('click','.deleteBtn',function(){
                var id = $(this).data('id');
                var method = 'get';
                var route = "{{route('admin.conversations.destroy')}}";
                var data = {id:id}
                var response = getData(method,route,'json',data,null,null,0);
                $('.delete-enquiry-'+id).remove();
            });
            $("html, div").animate({
                scrollTop: $('.chat').get(0).scrollHeight
            }, 100);
        });
        $('.addAttachmentBtn').on('click', function(){
            $('.messageBox').addClass('d-none');
            $('.addAttachmentForm').removeClass('d-none');
        });
        $('#message').keydown(function(e){
            if (e.ctrlKey && e.keyCode == 13) {
                $('.ajaxForm').submit();
            }
        });
    </script>
    {{-- END JS HELPERS INIT --}}
@endpush
