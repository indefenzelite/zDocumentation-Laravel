
@extends('layouts.empty') 
@section('title','User Subscriptions')
@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="table-responsive">
                    <table id="table" class="table">
                        <thead>
                            <tr>     
                                <th>#</th>                                 
                                <th class="col_1">User Name</th>
                                <th class="col_2">Status</th>
                                <th class="col_4">Subject</th>
                                <th class="col_5">Created At</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            @if($supportTickets->count() > 0)
                                @foreach($supportTickets as  $supportTicket)
                                    <tr>
                                        <td>{{ $supportTicket->getPrefix() }}</td>
                                        <td>{{  $supportTicket->user->full_name ?? 'Not avaialble'}}</td>
                                         <td>{{ $supportTicket->status_parsed->label}}</td>
                                        <td>{{$supportTicket->subject }}</td>
                                        <td>{{($supportTicket->formatted_created_at) }}</td>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection