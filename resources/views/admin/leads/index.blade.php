

@extends('layouts.main') 
@section('title', $label)
@section('content')

@push('head')
    <script src="{{ asset('backend/plugins/DataTables/datatables.min.js') }}"></script>
    <style>
        .select2-selection.select2-selection--single{
            width: 100px !important;
        }
    </style>
@endpush
    @php
    $breadcrumb_arr = [
       ['name'=>$label, 'url'=> "{{ javascript:void(0); }}", 'class' => 'active']
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
                   <div class="div"></div>
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
                        <h3>{{$label}}</h3>
                        <div class="d-flex justify-content-between">
                            <form action="{{ route('admin.leads.index') }}" class="d-flex" method="GET" id="TableForm">
                                <div class="form-group mb-0 mr-2">
                                    <span>From</span>
                                    <label for=""><input type="date" name="from" class="form-control" value="{{request()->get('from')}}"></label>
                                </div>
                                <div class="form-group mb-0 mr-2"> 
                                    <span>To</span>
                                        <label for=""><input type="date" name="to" class="form-control" value="{{ request()->get('to')}}"></label> 
                                </div>
                                <div class="form-group mb-0 mr-2">
                                    <select id="lead_type_id" name="lead_type_id" class="select2 form-control course-filter">
                                        <option readonly value="">{{ __('Status') }}</option>
                                            @foreach ($status_categories as $category)
                                                <option value="{{ $category->id }}" {{ $category->id == request()->get('lead_type_id') ? 'selected': ''}}>{{ $category->name }}</option> 
                                            @endforeach
                                    </select>
                                </div>
                                <div class="form-group mb-0 mr-2">
                                    <select id="lead_source_id" name="lead_source_id" class="select2 form-control course-filter">
                                        <option readonly value="">{{ __('Source') }}</option>
                                            @foreach ($source_categories as $category)
                                                <option value="{{ $category->id }}" {{ $category->id == request()->get('lead_source_id') ? 'selected': ''}}>{{ $category->name }}</option> 
                                            @endforeach
                                    </select>
                                </div>
                                <div class="dropdown">
                                    <button type="submit" class="btn btn-icon btn-sm btn-outline-warning" title="Filter"><i class="fa fa-filter" aria-hidden="true"></i></button>
                                    <a href="javascript:void(0)" id="reset" class="btn btn-icon btn-sm btn-outline-danger" title="Reset"><i class="fa fa-redo" aria-hidden="true"></i></a>
                                    @if(env('IS_DEV') == 1)
                                    <a href="{{ route('admin.leads.create') }}" class="btn btn-icon btn-sm btn-outline-primary mr-2" title="Add new lead"><i class="fa fa-plus" aria-hidden="true"></i>
                                    </a>
                                    @endif
                                </div>
                            </form>
                            <form action="{{route('admin.leads.bulk-delete')}}" method="POST"> 
                                @csrf
                                <input type="hidden" name="ids" id="bulk_ids">
                                <button style="background: transparent;border:none;" class="dropdown-toggle p-0 three-dots" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="ik ik-more-vertical pl-1"></i></button>
                                <ul class="dropdown-menu multi-level support-dropdown" role="menu" aria-labelledby="dropdownMenu">
                                    <button type="submit" id="" name="action" value="delete" class="dropdown-item bulk-delete" data-message="You want to delete these items?" data-action="delete">Bulk Delete</button>
                                </ul>
                            </form>
                        </div>
                    </div>
                    <div id="ajax-container">
                        @include('admin.leads.load')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
    <!-- push external js -->
    @push('script')
        <script>
       
            $('#reset').click(function(){
                window.location.href = "{{route('admin.leads.index')}}";
            });
            
        </script>
    @endpush
