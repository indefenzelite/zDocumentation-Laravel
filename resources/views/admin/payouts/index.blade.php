@extends('layouts.main')
@section('title', $label)
@section('content')
    @php
        /**
         * Payout
         *
         * @category  zStarter
         *
         * @ref  zCURD
         * @author    Defenzelite <hq@defenzelite.com>
         * @license  https://www.defenzelite.com Defenzelite Private Limited
         * @version  <zStarter: 1.1.0>
         * @link        https://www.defenzelite.com
         */
        $breadcrumb_arr = [['name' => $label, 'url' => 'javascript:void(0);', 'class' => 'active']];
    @endphp
    <!-- push external head elements to head -->
    @push('head')
        <style>
            .select2-selection__rendered {
                width: 150px;
            }
        </style>
    @endpush

    <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-grid bg-blue"></i>
                        <div class="d-inline">
                            <h5>{{ $label }}</h5>
                            <span>List of {{ $label }}</span>
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
                    <div class="card-header d-flex justify-content-between">
                        <h3>{{ $label }}</h3>
                        <button button type="button" class="off-canvas btn btn-outline-secondary btn-icon"><i
                                class="fa fa-filter"></i></button>
                    </div>
                    <div id="ajax-container">
                        @include('admin.payouts.load')
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('admin.payouts.include.filter')
    <!-- push external js -->
    @push('script')
        <script src="{{ asset('admin/js/ajaxForm.js') }}"></script>
        @include('admin.include.bulk-script')
        <script src="{{ asset('admin/js/index-page.js') }}"></script>
        <script>
            $(document).ready(function() {
                getUsers();
            })
        </script>

        {{-- START HTML TO EXCEL INIT --}}
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
                XLSX.writeFile(file, 'PayoutFile.' + type);
                $("#table").html(table_core.html());

            }
            $(document).on('click', '#export_button', function() {
                html_table_to_excel('xlsx');
            })
        </script>
        {{-- END HTML TO EXCEL INIT --}}

        {{-- START RESET BUTTON INIT --}}
        <script>
            $('#reset').click(function() {
                fetchData("{{ route('admin.payouts.index') }}");
                window.history.pushState("", "", "{{ route('admin.payouts.index') }}");
                $('#TableForm').trigger("reset");
                $(document).find('.close.off-canvas').trigger('click');
            });
        </script>
        {{-- END RESET BUTTON INIT --}}
    @endpush
@endsection
