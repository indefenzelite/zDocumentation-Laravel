@extends('layouts.main')
@section('title', 'Items')
@section('content')
    @php
        /**
         * Item
         *
         * @category ZStarter
         *
         * @ref zCURD
         * @author  Defenzelite <hq@defenzelite.com>
         * @license https://www.defenzelite.com Defenzelite Private Limited
         * @version <zStarter: 1.1.0>
         * @link    https://www.defenzelite.com
         */
        $breadcrumb_arr = [['name' => 'Items', 'url' => 'javascript:void(0);', 'class' => 'active']];
    @endphp
    <!-- push external head elements to head -->
    @push('head')
        <style>
            .featured-icon i {
                font-size: 14px;
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
                            <h5>Items</h5>
                            <span>List of Items</span>
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
                        <h3>Items</h3>
                        <div class="d-flex justify-content-right">
                            @if (auth()->user()->isAbleTo('add_item'))
                                <a href="{{ route('admin.items.create') }}" class="btn btn-icon btn-sm btn-outline-primary"
                                    title="Add New Item"><i class="fa fa-plus" aria-hidden="true"></i></a>
                            @endif
                            <button type="button" class="off-canvas btn btn-outline-secondary btn-icon ml-2"><i
                                    class="fa fa-filter"></i></button>
                            <form action="{{ route('admin.items.bulk-action') }}" method="POST" id="bulkAction"
                                class="">
                                @csrf
                                <input type="hidden" name="ids" id="bulk_ids">
                                <div>
                                    <button style="background: transparent;border:none;"
                                        class="dropdown-toggle p-0 custom-dopdown mt-2" type="button" id="dropdownMenu1"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                                            class="ik ik-more-vertical pl-1"></i></button>
                                    <ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">

                                        <button type="submit" class="dropdown-item bulk-action text-danger fw-700"
                                            data-value="" data-message="You want to delete these items?"
                                            data-action="delete" data-callback="bulkDeleteCallback"> Delete
                                        </button>

                                        <a href="javascript:void(0)" class="dropdown-item bulk-action" data-value="0"
                                            data-status="Unpublish" data-column="is_published"
                                            data-message="You want to mark Unpublish these items?"
                                            data-action="columnUpdate" data-callback="bulkColumnUpdateCallback">Mark as
                                            Unpublish
                                        </a>

                                        <a href="javascript:void(0)" class="dropdown-item bulk-action" data-value="1"
                                            data-status="Publish" data-column="is_published"
                                            data-message="You want to mark Publish these items?" data-action="columnUpdate"
                                            data-callback="bulkColumnUpdateCallback">Mark as Publish
                                        </a>
                                    </ul>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div id="ajax-container">
                        @include('admin.items.load')
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('admin.items.include.filter')
    <!-- push external js -->
    @push('script')
        <script src="{{ asset('admin/js/ajaxForm.js') }}"></script>
        @include('admin.include.bulk-script')
        <script src="{{ asset('admin/js/index-page.js') }}"></script>
        {{-- START HTML TO EXCEL BUTTON INIT --}}
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
                XLSX.writeFile(file, 'ItemFile.' + type);
                $("#table").html(table_core.html());
            }
            $(document).on('click', '#export_button', function() {
                html_table_to_excel('xlsx');
            })
        </script>
        {{-- END HTML TO EXCEL BUTTON INIT --}}

        {{-- START RESET BUTTON INIT --}}
        <script>
            $('#reset').click(function() {
                fetchData("{{ route('admin.items.index') }}");
                window.history.pushState("", "", "{{ route('admin.items.index') }}");
                $('#TableForm').trigger("reset");
                $(document).find('.close.off-canvas').trigger('click');
            });
        </script>
        {{-- END RESET BUTTON INIT --}}
    @endpush
@endsection
