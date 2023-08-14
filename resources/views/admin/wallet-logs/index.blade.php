@extends('layouts.main')
@section('title', 'Wallet Logs')
@section('content')
    @php
        $breadcrumb_arr = [['name' => 'Wallet Logs', 'url' => 'javascript:void(0);', 'class' => 'active']];
    @endphp
    <!-- push external head elements to head -->
    @push('head')
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    @endpush

    <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-grid bg-blue"></i>
                        <div class="d-inline">
                            <h5>{{ Str::limit($userName->fullname, 20) ?? '' }}</h5>
                            <span>List of Wallet Logs</span>
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
            <!-- end message area-->
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3>Wallet Logs</h3>
                        <div class="d-flex justicy-content-right">
                            <button class="btn btn-outline-primary btn-icon  open-wallet-modal"
                                data-id="{{ $id }}" type="submit"><i class="fa fa-plus"></i> </button>
                            <button type="button" class="off-canvas btn btn-outline-secondary btn-icon ml-2"><i
                                    class="fa fa-filter"></i></button>
                        </div>

                    </div>
                    <div class="card-body">
                        <div id="ajax-container">
                            @include('admin.wallet-logs.load')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('admin.modal.add-user-wallet')
    @include('admin.wallet-logs.include.filter')
    <!-- push external js -->
    @push('script')
        <script src="{{ asset('admin/js/ajaxForm.js') }}"></script>
        @include('admin.include.bulk-script')
        <script src="{{ asset('admin/js/index-page.js') }}"></script>
        {{-- START JS HELPERS INIT --}}
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
        <script>
            $(document).on('click', '.open-wallet-modal', function() {
                var user_id = $(this).data('id');
                $('#uuid').val(user_id);
                $('#walletModal').modal('show');
            });

            $(document).ready(function() {
                // var table = $('#walletLogsTable').DataTable({
                //     responsive: true,
                //     fixedColumns: true,
                //     fixedHeader: true,
                //     scrollX: false,
                //     'aoColumnDefs': [{
                //         'bSortable': false,
                //         'aTargets': ['nosort']
                //     }],
                //     dom: "<'row'<'col-sm-2'l><'col-sm-7 text-center'B><'col-sm-3'f>>tipr",
                //     buttons: [{
                //             extend: 'excel',
                //             className: 'btn-sm btn-success',
                //             header: true,
                //             footer: true,
                //             exportOptions: {
                //                 columns: ':visible',
                //             }
                //         },
                //         'colvis',
                //         {
                //             extend: 'print',
                //             className: 'btn-sm btn-primary',
                //             header: true,
                //             footer: false,
                //             orientation: 'landscape',
                //             exportOptions: {
                //                 columns: ':visible',
                //                 stripHtml: false
                //             }
                //         }
                //     ]

                // });
            });
        </script>
        {{-- END JS HELPERS INIT --}}

        {{-- START EXPORT BUTTON INIT --}}
        <script>
            $(document).on('click', '#export_button', function() {
                html_table_to_excel('xlsx');
            })
        </script>
        {{-- END EXPORT BUTTON INIT --}}

        {{-- START RESET PAGE INIT --}}
        <script>
            $('#reset').click(function() {
                var url = $(this).data('url');
                fetchData(url);
                window.history.pushState("", "", url);
                $('#TableForm').trigger("reset");
                $(document).find('.close.off-canvas').trigger('click');
            });
        </script>
        {{-- END RESET PAGE INIT --}}
    @endpush
@endsection
