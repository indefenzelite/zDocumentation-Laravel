@extends('layouts.main') 
@section('title', 'Mail Text Template')
@section('content')
@php
$breadcrumb_arr = [
    ['name'=>'View Mail Text Template', 'url'=> "javascript:void(0);", 'class' => '']
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
                            <h5>{{ __('View Mail Text Template')}}</h5>
                            <span>{{ __('View a record for Mail Text Template')}}</span>
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
            <div class="col-md-12 mx-auto">
                <div class="card ">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3>Mail Text Template</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th width="15%">ID</th>
                                        <td>{{ $mailSmsTemplate->getPrefix() }}</td>
                                    </tr>
                                    <tr>
                                        <th> Code </th>
                                        <td> {{ $mailSmsTemplate->code }} </td>
                                    </tr>
                                    <tr>
                                        {{-- @dd($mailSmsTemplate); --}}
                                        <th> Subject </th>
                                        <td> {{ $mailSmsTemplate->subject }} </td>
                                    </tr>
                                    </tr>
                                    <tr>
                                        <th> Type </th>
                                        <td> {{ $mailSmsTemplate->type == 1 ? "Mail" : ($mailSmsTemplate->type == 2 ? "Sms" : "Whatsapp") }} </td>
                                    </tr>
                                    <tr>
                                        <th> Description </th>
                                        <td> {!! nl2br($mailSmsTemplate->content) !!} </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- push external js -->
    @push('script')
    @endpush
@endsection
