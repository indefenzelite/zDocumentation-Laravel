
@extends('layouts.empty') 
@section('title', 'User')
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
                                <th>Customer Name</th>
                                <th>Contact Details</th>
                                <th>Subject</th>
                                <th>Status</th>
                                <th>Created At</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            @if($websiteEnquiries->count() > 0)
                                @foreach($websiteEnquiries as  $websiteEnquiry)
                                    <tr>
                                        <td>{{$websiteEnquiry->getPrefix() }}</td>
                                        <td>{{$websiteEnquiry->name }}</td>
                                        <td>{{$websiteEnquiry->phone  }}</td>
                                        <td>{{$websiteEnquiry->subject}}</td>
                                        <td >
                                                {{@\App\Models\WebsiteEnquiry::STATUSES[$websiteEnquiry->status]['label']}}
                                        </td>
                                        <td>{{$websiteEnquiry->created_at}}</td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td class="text-center" colspan="8">No Data Found...</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection