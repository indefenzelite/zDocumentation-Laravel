@extends('layouts.main')
@section('title', 'Support Tickets')

@php
    $breadcrumb_arr = [['name' => 'Support Tickets', 'url' => 'javascript:void(0);', 'class' => 'active']];
@endphp
@section('content')
    <style>
        .chat {
            border: none;
            border-radius: 5px;
            padding: 0.5em;
        }

        .chat-left {
            align-self: flex-start;
            background-color: rgb(244, 244, 244);
        }

        .chat-right {
            text-align: right;
            align-self: flex-end;
        }

        .address-check {
            position: absolute;
            top: 0;
            right: 5px;
        }

        .scroll {
            max-height: 270px;
            overflow-y: auto;
            overflow-x: hidden;
        }

        .sticky-bar {
            position: sticky;
            top: 80px;
        }

        .dropdown-menu.multi-level.show {
            position: absolute;
            will-change: transform;
            top: 0px;
            left: -35px !important;
            transform: translate3d(-5px, 30px, 0px);
        }
    </style>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="card ">
                    <div class="card-header d-flex justify-content-between">
                        <h3>{{ $supportTicket->getPrefix() }} </h3>
                        <div class="d-flex">
                            <div><span
                                    class="mr-2 badge badge-{{ $supportTicket->status_parsed->color }}">{{ $supportTicket->status_parsed->label }}</span>
                            </div>
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu1"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                                <ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu"
                                    style="    position: absolute;
                                transform: translate3d(-5px, 30px, 0px);
                                top: 0px;
                                left: -175px !important;
                                will-change: transform;">
                                    @foreach ($statuses as $key => $status)
                                        @if ($supportTicket->status != $key)
                                            <a href="{{ route('admin.support-tickets.status', [$supportTicket->id, $key]) }}"
                                                title="Update Status" class="btn btn-sm p-0 d-block text-left">
                                                <li class="dropdown-item">{{ $status['label'] }}</li>
                                            </a>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    <ul class="nav nav-pills custom-pills" id="pills-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="pills-profile-tab" data-toggle="pill" href="#last-month"
                                role="tab" aria-controls="pills-profile" aria-selected="false">{{ __('Details') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-setting-tab" data-toggle="pill" href="#previous-month"
                                role="tab" aria-controls="pills-setting"
                                aria-selected="false">{{ __('Attachments') }}</a>
                        </li><br>
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="last-month" role="tabpanel"
                            aria-labelledby="pills-profile-tab">
                            <div class="card-body">
                                <div class="">
                                    <p class="mb-0">Name: {{ $supportTicket->user->full_name }} <br> Subject:
                                        <strong>{{ $supportTicket->subject ?? 'N\A' }}</strong> <br> Message:
                                        {{ Str::limit($supportTicket->message, 70) }}<br>
                                        <small class="text-muted">
                                            {{ $supportTicket->created_at->diffForHumans() }}</small>
                                    </p>
                                    <div class="card-body scroll">
                                        <div class="row my-1 chat">
                                            @foreach ($supportTicket->ticketConversations as $index => $ticketConversation)
                                                @if ($ticketConversation->user_id == auth()->id())
                                                    <div class="col-md-11 py-2 chat-right mb-1">
                                                        <div class="p-0 m-0">
                                                            <span>
                                                                {{ $ticketConversation->comment }}
                                                            </span>
                                                        </div>
                                                        <small
                                                            class="text-muted">{{ $ticketConversation->created_at->diffForHumans() }}</small>
                                                    </div>
                                                    <div class="col-md-1">
                                                        <a href="{{ route('admin.ticket-conversations.destroy', $ticketConversation->id) }}"
                                                            title="Delete Enquiry"
                                                            class="btn mt-2 btn-sm btn-icon btn-outline-danger delete-item"
                                                            style="display: flex;align-items: center;justify-content: center;"><i
                                                                class="ik ik-trash"></i></a>
                                                    </div>
                                                @else
                                                    <div class="col-md-11 py-2 chat-left mb-1">
                                                        <div class="p-0 m-0">
                                                            <span>
                                                                {{ $ticketConversation->comment }}
                                                            </span>
                                                        </div>
                                                        <small
                                                            class="text-muted">{{ $ticketConversation->created_at }}</small>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                        <div class="msg-card"></div>
                                    </div>
                                    <div class="card-footer">
                                        @if ($sender != auth()->id())
                                            <div class="alert alert-info mb-0"><strong>Note:</strong> You don't have
                                                permission to send messsage to this enquiry</div>
                                        @else
                                            <div class="row">
                                                <div class="col-md-12 col-lg-12">
                                                    <form action="{{ route('admin.ticket-conversations.store') }}"
                                                        method="post" class="ChatForm">
                                                        @csrf
                                                        <input type="hidden" name="request_with" value="create"
                                                            id="groupId">
                                                        <input type="hidden" name="type_id"
                                                            value="{{ $supportTicket->id }}" id="groupId">
                                                        <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                                                        <input type="hidden" name="type"
                                                            value="{{ 'Support Ticket' }}">
                                                        <input type="hidden" name="reciever_id"
                                                            value="{{ $receiver }}" id="receiverId">
                                                        <div
                                                            class="d-flex align-items-center form-group {{ $errors->has('comment') ? 'has-error' : '' }}">
                                                            <input type="text" pattern="[a-zA-Z]+.*"
                                                                title="Please enter first letter alphabet and at least one alphabet character is required."
                                                                class="form-control" required name="comment" id="message"
                                                                placeholder="Enter Message">
                                                            <div class="ml-2">
                                                                <button type="submit" class="btn btn-primary btn-icon"><i
                                                                        class="ik ik-navigation"></i></button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="previous-month" role="tabpanel"
                            aria-labelledby="pills-setting-tab">
                            <div class="card-body">
                                <form action="{{ route('admin.support-tickets.add-attachment', $supportTicket->id) }}"
                                    method="post" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="request_with" value="media">
                                    <div class="d-flex">
                                        <input type="file" class="form-control"
                                            style="width:100%; margin-bottom:15px;" name="file_name" required>
                                        <button class="btn btn-sm btn-primary ml-2" type="submit">Add Attachment</button>
                                    </div>
                                </form>
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
                                                <td><a href="{{ $media->getUrl() }}" class="btn btn-link"
                                                        download=""><i class="ik ik-download"></i></a></td>
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
                </div>
            </div>
        </div>

    </div>

@endsection
