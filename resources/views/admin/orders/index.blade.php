@extends('layouts.main')
@section('title', $label)
@section('content')
    @php
        /**
         * Order
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
    @php
        use Carbon\Carbon;
        $fromDate = Carbon::parse(request()->get('from'));
        $toDate = Carbon::parse(request()->get('to'));
    @endphp
    <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-grid bg-blue"></i>
                        <div class="d-inline">
                            <h5>{{ $label }}</h5>
                            {{-- <span>List of {{ $label }}</span> --}}
                            <span>Between <strong class="from-date-html">{{ $fromDate->format('d-M-Y') ?? '--' }}</strong> to
                                <strong class="to-date-html">{{ $toDate->format('d-M-Y') ?? '--' }}</strong></span>
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
                        <div class="d-flex justicy-content-right">
                            @if (auth()->user()->isAbleTo('add_order'))
                                <a href="{{ route('admin.orders.create') }}"
                                    class="btn btn-icon btn-sm btn-outline-primary mr-2" title="Add New Orders"><i class="fa fa-plus mt-2" aria-hidden="true"></i></a>
                            @endif
                            <button type="button" class="off-canvas btn btn-outline-secondary btn-icon"><i class="fa fa-filter"></i></button>
                            <form action="{{ route('admin.orders.bulk-action') }}" method="POST" id="bulkAction"
                                class="d-flex">
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
                                            data-action="delete" data-callback="bulkDeleteCallback"> Bulk Delete
                                        </button>
                                        @foreach ($statuses as $key => $status)
                                            <a href="javascript:void(0)" class="dropdown-item bulk-action"
                                                data-value="{{ $key }}" data-status="{{ $status['label'] }}"
                                                data-column="status"
                                                data-message="You want to mark {{ $status['label'] }} these items?"
                                                data-action="columnUpdate" data-callback="bulkColumnUpdateCallback">Mark as
                                                {{ $status['label'] }}
                                            </a>
                                        @endforeach
                                    </ul>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div id="ajax-container">
                        @include('admin.orders.load')
                    </div>
                </div>
            </div>
        </div>
        </form>
    </div>
    @include('admin.orders.include.filter')
    <!-- push external js -->
    @push('script')
        <script src="{{ asset('admin/js/ajaxForm.js') }}"></script>
        @include('admin.include.bulk-script')
        <script src="{{ asset('admin/js/index-page.js') }}"></script>

        {{-- START EXCEL BUTTON INIT --}}
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
                XLSX.writeFile(file, 'OrderFile.' + type);
                $("#table").html(table_core.html());

            }
        </script>
        {{-- END EXCEL BUTTON INIT --}}

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
                fetchData("{{ route('admin.orders.index') }}");
                window.history.pushState("", "", "{{ route('admin.orders.index') }}");
                $('#TableForm').trigger("reset");
                $(document).find('.close.off-canvas').trigger('click');
                window.location.reload();
            });
        </script>
        {{-- END RESET PAGE INIT --}}

        {{-- START GETUSERS INIT --}}
        <script>
            $(document).ready(function() {
                getUsers();
            })
        </script>
        {{-- END GETUSERS INIT --}}
    @endpush
@endsection
