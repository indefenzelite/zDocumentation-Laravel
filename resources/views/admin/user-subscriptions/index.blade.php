@extends('layouts.main')
@section('title', 'User Subscriptions')
@section('content')
    @php
        /**
         * User Subscription
         *
         * @category ZStarter
         *
         * @ref zCURD
         * @author  Defenzelite <hq@defenzelite.com>
         * @license https://www.defenzelite.com Defenzelite Private Limited
         * @version <zStarter: 1.1.0>
         * @link    https://www.defenzelite.com
         */
        $breadcrumb_arr = [['name' => 'User Subscriptions', 'url' => 'javascript:void(0);', 'class' => 'active']];
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
                            <h5>Assign Subscriptions</h5>
                            <span>List of Assign Subscriptions</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    @include('admin.include.breadcrumb')
                </div>
            </div>
        </div>

        <form action="{{ route('admin.user-subscriptions.index') }}" method="GET" id="TableForm">
            <div class="row">
                <!-- start message area-->
                <!-- end message area-->

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h3>Subscriptions Assignment</h3>
                            <div class="d-flex justify-content-right">
                                <a href="{{ route('admin.user-subscriptions.create') }}"
                                    class="btn btn-icon btn-sm btn-outline-primary mr-2"
                                    title="Add New User Subscription"><i class="fa fa-plus" aria-hidden="true"></i></a>
                                <button type="button" class="off-canvas btn btn-outline-secondary btn-icon"><i
                                        class="fa fa-filter"></i></button>
                            </div>
                        </div>
                        <div id="ajax-container">
                            @include('admin.user-subscriptions.load')
                        </div>
                    </div>
                </div>
            </div>
            <form>
    </div>

    @include('admin.user-subscriptions.include.filter')
    <!-- push external js -->
    @push('script')
        <script src="{{ asset('admin/js/index-page.js') }}"></script>

        {{-- START RESET BUTTON INIT --}}
        <script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>
        <script>
            function html_table_to_excel(type) {
                var table_core = $("#table").clone();
                var clonedTable = $("#table").clone();
                clonedTable.find('[class*="no-export"]').remove();
                clonedTable.find('[class*="d-none"]').remove();
                $("#table").html(clonedTable.html());
                var data = document.getElementById('table');

                var file = XLSX.utils.table_to_book(data, {
                    sheet: "sheet1"
                });
                XLSX.write(file, {
                    bookType: type,
                    bookSST: true,
                    type: 'base64'
                });
                XLSX.writeFile(file, 'UserSubscriptionFile.' + type);
                $("#table").html(table_core.html());

            }

            $(document).on('click', '#export_button', function() {
                html_table_to_excel('xlsx');
            })
        </script>
        {{-- START RESET BUTTON INIT --}}

        {{-- START RESET BUTTON INIT --}}
        <script>
            $('#reset').click(function() {
                fetchData("{{ route('admin.user-subscriptions.index') }}");
                window.history.pushState("", "", "{{ route('admin.user-subscriptions.index') }}");
                $('#TableForm').trigger("reset");
                $(document).find('.close.off-canvas').trigger('click');
            });
        </script>
        {{-- END RESET BUTTON INIT --}}
        {{-- START GETUSERS INIT --}}
        <script>
            $(document).ready(function() {
                getUsers();
            })
        </script>
        {{-- END GETUSERS INIT --}}
    @endpush
@endsection
