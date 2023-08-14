@extends('layouts.main') 
@section('title', 'Website Enquiry')
@section('content')
@php
$breadcrumb_arr = [
    ['name'=>'View Website Enquiry', 'url'=> "javascript:void(0);", 'class' => '']
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
                            <h5>{{ $websiteEnquiry->getPrefix() }}</h5>
                            <span>At {{$websiteEnquiry->formatted_created_at }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    @include('admin.include.breadcrumb')
                </div>
            </div>
        </div>
        <div class="row">
            <!-- start message area-->
            @include('admin.include.message')
            <!-- end message area-->
            <div class="col-md-6 mx-auto" > 
                <div class="card ">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div>
                            <h3 class="fw-700">
                                {{ $websiteEnquiry->name}}
                            </h3>
                        </div>
                        <div>
                            <span class="badge badge-{{@\App\Models\WebsiteEnquiry::STATUSES[$websiteEnquiry->status]['color'] ?? '--' }} status-change">
                                {{@\App\Models\WebsiteEnquiry::STATUSES[$websiteEnquiry->status]['label'] ?? '--' }}
                            </span>

                            @if($websiteEnquiry->status != App\Models\WebsiteEnquiry::STATUS_CLOSED)
                                <button style="background: transparent;border:none;" class="dropdown-toggle p-0 custom-dopdown mt-2" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="ik ik-more-vertical pl-1"></i></button>

                                <form action="{{route('admin.website-enquiries.status-update',$websiteEnquiry->id)}}" method="get"  id="updateStatus">
                                    @csrf
                                    <ul class="dropdown-menu multi-level" name="status" id="Status" role="menu" aria-labelledby="dropdownMenu">
                                    @if($websiteEnquiry->status == App\Models\WebsiteEnquiry::STATUS_NEW)
                                        <button type="submit" name="status"class="dropdown-item" value="{{App\Models\WebsiteEnquiry::STATUS_CONTACTED}}">Mark as Contacted </button>  
                                    @endif
                                    @if($websiteEnquiry->status == App\Models\WebsiteEnquiry::STATUS_NEW || $websiteEnquiry->status == App\Models\WebsiteEnquiry::STATUS_CONTACTED)
                                        <button type="submit"name="status" class="dropdown-item" value="{{App\Models\WebsiteEnquiry::STATUS_CLOSED}}">Mark as Closed </button>  
                                    @endif
                                    </ul>
                                </form>
                            @endif 
                        </div>
                    </div>
                    <div class="card-body">

                        <h6>
                             {{ $websiteEnquiry->subject }}
                        </h6>
                        <p class="text-muted">
                            <i class="ik ik-arrow-down-right"></i>
                            {!! nl2br($websiteEnquiry->description) !!}
                        </p>

                        <hr>

                      <div class="d-flex justify-content-between">
                        <a class="btn btn-link text-muted fw-700 p-0 mb-0" href="tel:{{ $websiteEnquiry->phone }}">
                            <i class="fa fa-phone"></i>
                            {{ $websiteEnquiry->phone }}
                        </a>

                        <a class="btn btn-link text-muted fw-700 p-0 mb-0" href="emailto:{{ $websiteEnquiry->email }}">
                            <i class="fa fa-envelope"></i>
                            {{ $websiteEnquiry->email }}
                        </a>

                        <div class="text-muted fw-600" title="Last Updated At">
                            <i class="fas fa-clock"></i>
                            {{$websiteEnquiry->updated_at->diffForHumans()}}
                        </div>
                      </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- push external js -->
    @push('script')
    {{-- START UPDATE STATUS INIT --}}
    <script>
        $('#Status').on('change', function() {
            $('#updateStatus').submit();
        });
    </script>
    {{-- END UPDATE STATUS INIT --}}
    @endpush
@endsection
