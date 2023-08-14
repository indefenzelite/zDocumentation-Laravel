@extends('layouts.main')
@section('title', $label)
@section('content')
    @php
        $breadcrumb_arr = [['name' => $label, 'url' => 'javascript:void(0);', 'class' => ''], ['name' => 'Pages', 'url' => 'javascript:void(0);', 'class' => 'active']];
    @endphp
    <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-grid bg-blue"></i>
                        <div class="d-inline">
                            <h5>{{ __($label) }}</h5>
                            <span>{{ __('This setting will be automatically updated in your website.') }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">

                    <div>
                        @include('admin.include.breadcrumb')
                    </div>
                </div>
                @include('admin.modal.sitemodal', [
                    'title' => 'How to use',
                    'content' =>
                        'You need to create a unique code and call the unique code with paragraph content helper.',
                ])
            </div>
        </div>

        <div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between" style="margin-top: -8px;">
                            <h3 class="mb-0">{{ 'All Pages' }}</h3>
                            <div class="d-flex justify-content-right ">
                                {{-- <a href="{{ route('admin.website-pages.index') }}" class="btn btn-icon btn-sm btn-outline-danger mr-1 mt-2" title="Reset"><i class="fa fa-redo" aria-hidden="true"></i></a> --}}

                                <button type="button"
                                    class="off-canvas btn btn-outline-secondary btn-icon ml-2 mt-2 mr-2"><i
                                        class="fa fa-filter"></i></button>
                                @if (env('IS_DEV') == 1)
                                    <a class="btn btn-icon btn-sm btn-outline-success mr-1 mt-2" href="#"
                                        data-toggle="modal" data-target="#siteModal"><i class="fa fa-info"></i>
                                    </a>
                                    @if (auth()->user()->isAbleTo('add_page'))
                                        <a href="{{ route('admin.website-pages.create') }}"
                                            class="btn btn-icon btn-sm btn-outline-primary mt-2" title="Add New Page"><i
                                                class="fa fa-plus" aria-hidden="true"></i></a>
                                    @endif
                                @endif
                                <form action="{{ route('admin.website-pages.bulk-action') }}" method="POST" id="bulkAction"
                                    class="d-flex mr-2">
                                    @csrf
                                    <input type="hidden" name="ids" id="bulk_ids">
                                    <div>
                                        <button style="background: transparent;border:none;  position: absolute; top: 25px;"
                                            class="dropdown-toggle custom-dopdown" type="button" id="dropdownMenu1"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                                                class="ik ik-more-vertical pl-1"></i></button>
                                        <ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">
                                            <button type="submit" class="dropdown-item bulk-action text-danger fw-700"
                                                data-value="" data-message="You want to delete these items?"
                                                data-action="delete" data-callback="bulkDeleteCallback"> Bulk Delete
                                            </button>
                                        </ul>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <form action="{{ route('admin.website-pages.index') }}" method="GET" id="TableForm"
                            action="">
                            <div id="ajax-container">
                                @include('admin.website-setup.load')
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('admin.seo-tags.include.filter')
    <!-- push external js -->
    @push('script')
        <script src="{{ asset('admin/js/ajaxForm.js') }}"></script>
        @include('admin.include.bulk-script')
        <script src="{{ asset('admin/js/index-page.js') }}"></script>

        {{-- START HTML TO EXCEL INIT --}}
        <script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>
        <script>
            function html_table_to_excel(type) {
                var table_core = $("#page_table").clone();
                var clonedTable = $("#page_table").clone();
                clonedTable.find('[class*="no-export"]').remove();
                clonedTable.find('[class*="d-none"]').remove();
                $("#page_table").html(clonedTable.html());
                // console.log(clonedTable.html());
                var data = document.getElementById('page_table');

                var file = XLSX.utils.table_to_book(data, {
                    sheet: "sheet1"
                });
                XLSX.write(file, {
                    bookType: type,
                    bookSST: true,
                    type: 'base64'
                });
                XLSX.writeFile(file, 'PageFile.' + type);
                $("#page_table").html(table_core.html());
            }

            $(document).on('click', '#export_button', function() {
                html_table_to_excel('xlsx');
            });
        </script>
        {{-- END HTML TO EXCEL INIT --}}

        {{-- START RESET INIT --}}
        <script>
            $('#reset').click(function() {
                var url = $(this).data('url');
                fetchData(url);
                window.history.pushState("", "", url);
                $('#TableForm').trigger("reset");
                $(document).find('.close.off-canvas').trigger('click');
            });
        </script>
        {{-- END RESET INIT --}}
    @endpush
@endsection
