@extends('layouts.main')
@section('title', $label)
@section('content')
    @php
        $breadcrumb_arr = [['name' => $label, 'url' => 'javascript:void(0);', 'class' => 'active']];
    @endphp
    <!-- push external head elements to head -->
    @push('head')
        <style>
            .daterangepicker.dropdown-menu.ltr.show-calendar.opensright {
                width: 455px !important;
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
                            <h5>{{ __($label) }}</h5>
                            <span>{{ __('List of') }} {{ $label }}</span>
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
                    <div class="card-header d-flex justify-content-between align-items-right">
                        <h3>{{ __($label) }}</h3>
                        <div class="d-flex justify-content-right">
                            @if (auth()->user()->isAbleTo('add_website-enquiry'))
                                <a href="{{ route('admin.website-enquiries.create') }}"
                                    class="btn btn-icon btn-sm btn-outline-primary" title="Add Website Enquiry"><i
                                        class="fa fa-plus" aria-hidden="true"></i></a>
                            @endif
                            <button type="button" class="off-canvas btn btn-outline-secondary btn-icon ml-2"><i
                                    class="fa fa-filter"></i></button>
                            <form action="{{ route('admin.website-enquiries.bulk-action') }}" method="POST"
                                id="bulkAction">
                                @csrf
                                <input type="hidden" name="ids" id="bulk_ids">
                                <div class="dropdown d-flex justicy-content-left">
                                    <button style="background: transparent;border:none;"
                                        class="dropdown-toggle p-0 three-dots"type="button" id="dropdownMenu1"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                                            class="ik ik-more-vertical pl-1"></i></button>
                                    <ul class="dropdown-menu dropdown-position multi-level" role="menu"
                                        aria-labelledby="dropdownMenu">
                                        <button type="submit" class="dropdown-item bulk-action text-danger fw-700"
                                            data-value="" data-message="You want to delete these items?"
                                            data-action="delete" data-callback="bulkDeleteCallback"> Delete
                                        </button>
                                    </ul>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="ajax-container">
                            @include('admin.website-enquiries.load')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('admin.website-enquiries.include.filter')
    <!-- push external js -->
    @push('script')
        <script src="{{ asset('admin/js/ajaxForm.js') }}"></script>
        <script src="{{ asset('admin/js/index-page.js') }}"></script>
        {{-- START HTML TO EXCEL INIT --}}
        <script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>
        <script>
            function html_table_to_excel(type) {
                var table_core = $("#website_enquiry_table").clone();
                var clonedTable = $("#website_enquiry_table").clone();
                clonedTable.find('[class*="no-export"]').remove();
                clonedTable.find('[class*="d-none"]').remove();
                $("#website_enquiry_table").html(clonedTable.html());
                var data = document.getElementById('website_enquiry_table');

                var file = XLSX.utils.table_to_book(data, {
                    sheet: "sheet1"
                });
                XLSX.write(file, {
                    bookType: type,
                    bookSST: true,
                    type: 'base64'
                });
                XLSX.writeFile(file, 'WebsiteEnquiryFile.' + type);
                $("#website_enquiry_table").html(table_core.html());
            }

            $(document).on('click', '#export_button', function() {
                html_table_to_excel('xlsx');
            });
        </script>
        {{-- END HTML TO EXCEL INIT --}}

        {{-- START RESET BUTTON INIT --}}
        <script>
            $('#reset').click(function() {
                fetchData("{{ route('admin.website-enquiries.index') }}");
                window.history.pushState("", "", "{{ route('admin.website-enquiries.index') }}");
                $('#TableForm').trigger("reset");
                $(document).find('.close.off-canvas').trigger('click');
                $('#status').select2('val', "");
                $('#status').trigger('change');
            });
        </script>
        {{-- END RESET BUTTON INIT --}}
        @include('admin.include.bulk-script')
    @endpush
@endsection
