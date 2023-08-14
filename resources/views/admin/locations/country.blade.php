@extends('layouts.main') 
@section('title', $label)
@section('content')
    @php
    $breadcrumb_arr = [
        ['name'=> $label, 'url'=> "javascript:void(0);", 'class' => 'active']
    ]
    @endphp

    <div class="container-fluid">
    	<div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-grid bg-blue"></i>
                        <div class="d-inline">
                            <h5>{{ __($label)}}</h5>
                            <span>{{ __('List of ')}} {{$label}}</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    @include("admin.include.breadcrumb")
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h3>{{ __('Locations')}}</h3>
                        @if(auth()->user()->isAbleTo('add_location'))
                            <a href="{{ route('admin.locations.country.create') }}" class="btn btn-icon btn-sm btn-outline-primary" title="Add Country"><i class="fa fa-plus" aria-hidden="true"></i></a>
                        @endif
                    </div>
                    <div id="ajax-container">
                        @include('admin.locations.loads.country')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
    <!-- push external js -->
@push('script')
    <script src="{{ asset('admin/js/index-page.js') }}"></script>
@endpush

