@extends('layouts.user')

@section('meta_data')
    @php
		$meta_title = 'Support Ticket | '.getSetting('app_name');		
		$meta_description = '' ?? getSetting('seo_meta_description');
		$meta_keywords = '' ?? getSetting('seo_meta_keywords');
		$meta_motto = '' ?? getSetting('site_motto');		
		$meta_abstract = '' ?? getSetting('site_motto');		
		$meta_author_name = '' ?? 'Defenzelite';		
		$meta_author_email = '' ?? 'support@defenzelite.com';		
		$meta_reply_to = '' ?? getSetting('app_email');		
		$meta_img = ' ';		
		$customer = 1;		
	@endphp
@endsection
<style>
    .delete-btn{
        height: 30px !important;
        width: 30px !important;
        border-radius: 50% !important;
    }
</style>
@section('content')
    

    <!-- Profile Start -->
    <section class="section mt-60">
        <div class="container mt-lg-3">
            <div class="row">
                @include('user.include.sidebar')
                <div class="col-lg-8 col-12">
                    <div class="card chatDiv">
                        <div class="card-header d-flex justify-content-between">
                            <div class="d-flex">
                                <a href="{{ route('user.dashboard.index') }}?active=support-ticket" class="p-0 m-0">
                                    <i class="uil uil-arrow-circle-left text-primary" style="font-size: 40px;margin-right: 10px;"></i>
                                </a>
                                <div>
                                    <h6 class="mt-1 mb-0">{{ $supportTicket->getPrefix() }} Converations</h6>
                                    <div class="p-0 text-{{$supportTicket->status_parsed->color}}">{{ $supportTicket->status_parsed->label }}</div>
                                </div>
                            </div>
                            <div class="mt-3">
                                <a href="javascript:void(0)" class="btn btn-outline-primary mr-2 btnAttachment p-1" style="font-size: small;">
                                    <i class="uil uil-paperclip"></i> Switch Attachment
                                </a>
                            </div>
                        </div>
                        {{-- <div>
                            <p class="text-muted">
                                Subject :  {{$supportTicket->subject}}
                                <small class="fw-600">
                                    - {{$supportTicket->priority}}
                                </small>
                            </p>
                        </div> --}}
                     
                        <div class="border-bottom p-2">
                            Subject : {{$supportTicket->subject}}
                            <small class="fw-600 text-info ">
                                - {{$supportTicket->priority}}
                            </small>
                        </div>
                        <ul class="p-4 list-unstyled mb-0 chat row" style="height: 280px;
                        overflow: auto;">
                            @if($supportTicket->conversations->count() > 0)
                                @foreach ($supportTicket->conversations as $conversation)
                                    @if($conversation->user_id != auth()->id())
                                        <div class="col-6">
                                            <li class="chat-left">
                                                <div class="d-inline-block">
                                                    <div class="d-flex chat-type mb-3">
                                                        <div class="chat-msg" style="max-width: 500px;">
                                                            <p class="text-muted small msg px-3 py-2 bg-light rounded mb-1">{{ $conversation->comment }}</p>
                                                            <small class="text-muted msg-time"><i class="uil uil-clock-nine me-1"></i>{{ $conversation->created_at->diffForHumans() }}</small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        </div>
                                        <div class="col-6"></div>
                                    @elseif($conversation->user_id == auth()->id())
                                        <div class="col-6"></div>
                                        <div class="col-6 d-flex justify-content-end">
                                            <li class="chat-right">
                                                <div class="d-inline-block">
                                                    <div class="d-flex chat-type mb-3">
                                                        <div class="chat-msg d-flex" style="max-width: 500px;">
                                                            <div>
                                                                <p class="text-muted small msg px-3 py-2 bg-light rounded mb-1">{{ $conversation->comment }}</p>
                                                                <small class="text-muted msg-time"><i class="uil uil-clock-nine me-1"></i>{{ $conversation->created_at->diffForHumans() }}</small>
                                                            </div>
                                                            {{-- <div class="">
                                                                <a href="{{route('user.conversation.delete',$conversation->id)}}" class="btn btn-icon delete-btn btn-outline-danger ms-3">
                                                                    <i class="uil uil-trash"></i>
                                                                </a>
                                                            </div> --}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        </div>

                                    @endif
                                @endforeach
                            @else   
                                <li class="d-flex align-items-center">
                                    <div class="text-center mx-auto pt-5">
                                        <p>No conversation yet!</p>
                                    </div>  
                                </li>  
                            @endif
                        </ul>

                        <div class="p-2 rounded-bottom shadow">
                            <form action="{{route('user.conversation.store')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="type_id" value="{{ $supportTicket->id }}">
                                <div class="row">
                                    <div class="col">
                                        <input required type="text" @if($supportTicket->status == 4) disabled @endif class="form-control" name="comment"pattern="[a-zA-Z]+.*" placeholder="Enter Message...">
                                    </div>
                                    <div class="col-auto">
                                        {{-- <label for="upload" class="btn btn-icon btn-primary mb-0">
                                             <i class="uil uil-paperclip"></i>
                                            <input type="file" id="upload" name="attachment" style="display:none">
                                        </label> --}}
                                        <button type="submit" @if($supportTicket->status == 4) disabled @endif class="btn btn-icon btn-primary"><i class="uil uil-message"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card attachmentDiv" style="display: none;">
                        <div class="card-header d-flex justify-content-between">
                            <div class="d-flex">
                                <a href="{{ route('user.dashboard.index') }}?active=support-ticket" class="p-0 m-0">
                                    <i class="uil uil-arrow-circle-left text-primary" style="font-size: 40px;margin-right: 10px;"></i>
                                </a>
                               <div>
                                <h6 class="mt-1 mb-0">{{ $supportTicket->getPrefix() }} Attachment</h6>
                                <div class="p-0 text-{{$supportTicket->status_parsed->color}}">{{ $supportTicket->status_parsed->label }}</div>
                               </div>
                            </div>
                            <div class="mt-3">
                                <a href="javascript:void(0)" class="btn btn-outline-primary mr-2 p-1 btnChat" style="font-size: small;">
                                    <i class="uil uil-comments"></i>  Switch Conversations
                                </a>
                            </div>
                        </div>

                        {{-- <div class="card-body">
                            Foreach all attachment
                        </div> --}}
                        <div>
                        <div class="card-body ">
                            <form action="{{route('user.support-ticket.add-attachment',$supportTicket->id)}}" method="post" enctype="multipart/form-data" >
                                @csrf
                                <input type="hidden" name="request_with" value="media">
                                <div  class="row">
                                    <div  class="col">
                                        <input type="file" class="form-control" style="width:100%; margin-bottom:18px;" @if($supportTicket->status == 4) disabled @endif name="file_name" required>
                                    </div>
                                    <div class="col-auto">
                                        <button class="btn btn-sm btn-primary " @if($supportTicket->status == 4) disabled @endif type="submit" >Upload Attachment</button>
                                    </div>
                                </div>
                            </form>
                            <div>
                                <table class="table table-striped table-responsive" style="display: inline-table;">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>File Name</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($supportTicket->getMedia('file') as $media)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $media->file_name }}</td>
                                                <td><a href="{{$media->getUrl()}}" class="btn btn-link" download=""><i class="uil uil-arrow-down"> </i> Download</a></td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3" class="text-center">No Attachment added!</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div><!--end col-->
            </div><!--end row-->
        </div><!--end container-->
    </section><!--end section-->
    <!-- Profile End -->
    
@endsection



@push('script')
  <script>
    $('.btnChat').on('click', function(e){
        e.preventDefault();
        $('.attachmentDiv').hide();
        $('.chatDiv').show();
    })
    $('.btnAttachment').on('click', function(e){
        $('.attachmentDiv').show();
        $('.chatDiv').hide();
    })
  </script>
@endpush