@extends('layouts.main') 
@section('title', 'Notification')
@section('content')
    @php
    $breadcrumb_arr = [
        ['name'=>'Notification', 'url'=> "javascript:void(0);", 'class' => 'active'],
    ]
    @endphp
    <!-- push external head elements to head -->

    <div class="container-fluid">
    	<div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-grid bg-blue"></i>
                        <div class="d-inline">
                            <h5>{{ __('Notification')}}</h5>
                            <span>{{ __('List of Notification')}}</span>
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
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3>{{ __('Notification')}}</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="notification_table" class="table">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th>Notification</th>
                                        <th >Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($notifications as $notification)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td>
                                                @if($notification->is_read == 0)
                                                <span class="new-update"></span>
                                                @endif
                                                {{ $notification->title }} {{ $notification->notification }}
                                            </td>
                                            <td><a href="{{ route('admin.notifications.update',$notification->id) }}" class="btn btn-icon btn-sm btn-outline-info"><i class="ik ik-eye"></i></a></td>
                                        </tr>
                                    @endforeach
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
        <script>
            $(document).ready(function() {

                var table = $('#notification_table').DataTable({
                    responsive: true,
                    fixedColumns: true,
                    fixedHeader: true,
                    scrollX: false,
                    'aoColumnDefs': [{
                        'bSortable': false,
                        'aTargets': ['nosort']
                    }],
                    dom: "<'row'<'col-sm-2'l><'col-sm-7 text-center'B><'col-sm-3'f>>tipr",
                    buttons: [
                        {
                            extend: 'excel',
                            className: 'btn-sm btn-success',
                            header: true,
                            footer: true,
                            exportOptions: {
                                columns: ':visible',
                            }
                        },
                        'colvis',
                        {
                            extend: 'print',
                            className: 'btn-sm btn-primary',
                            header: true,
                            footer: false,
                            orientation: 'landscape',
                            exportOptions: {
                                columns: ':visible',
                                stripHtml: false
                            }
                        }
                    ]

                });
            });
        </script>
    @endpush
@endsection
