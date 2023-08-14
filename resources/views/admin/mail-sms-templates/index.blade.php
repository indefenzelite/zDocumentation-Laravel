@extends('layouts.main')
@section('title', $label)
@section('content')
    @php
        $breadcrumb_arr = [['name' => $label, 'url' => 'javascript:void(0);', 'class' => 'active']];
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
                            <h5>{{ __($label) }}</h5>
                            <span>{{ __('List of ') }}{{ $label }}</span>
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
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h3>{{ $label }}</h3>
                        <div class="mr-4">
                            <ul class="nav nav-pills custom-pills" id="pills-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link @if (!request()->has('type')) active @endif"
                                        href="{{ route('admin.mail-sms-templates.index') }}">{{ __('All Template') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link @if (request()->has('type') && request()->get('type') == 1) active @endif"
                                        href="{{ route('admin.mail-sms-templates.index', ['type' => 1]) }}">{{ __('Mail Template') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link @if (request()->has('type') && request()->get('type') == 2) active @endif"
                                        href="{{ route('admin.mail-sms-templates.index', ['type' => 2]) }}">{{ __('SMS Template') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link @if (request()->has('type') && request()->get('type') == 3) active @endif"
                                        href="{{ route('admin.mail-sms-templates.index', ['type' => 3]) }}" role="tab"
                                        aria-controls="pills-timeline"
                                        aria-selected="true">{{ __('Whatsapp Template') }}</a>
                                </li>
                            </ul>
                        </div>
                        {{-- @dd(request()->get('type')) --}}
                        <div class="d-flex justify-content-between">

                            <form action="{{ route('admin.mail-sms-templates.index') }}" class="d-flex ajaxForm"
                                method="GET" id="TableForm">
                                {{-- <div class="form-group mb-0 mr-2"> 
                                    <select name="type" id="" class="form-control select2" style="width: 150px;">
                                        <option value="" aria-readonly="true">Select Type</option>
                                        <option @if (request()->has('type') && request()->get('type') == 1) selected @endif value="1">Mail</option>
                                        <option @if (request()->has('type') && request()->get('type') == 2) selected @endif value="2">SMS</option>
                                        <option @if (request()->has('type') && request()->get('type') == 3) selected @endif value="3">Whatapp</option>
                                    </select>
                                </div> --}}
                                <div class="dropdown">
                                    {{-- <button type="submit" class="btn btn-icon btn-sm mr-2 btn-outline-warning" title="Filter"><i class="fa fa-filter" aria-hidden="true"></i></button> --}}
                                    <a href="<?php $_SERVER['PHP_SELF']; ?>" id="reset"
                                        class="btn btn-icon btn-sm btn-outline-danger mr-2" title="Reset"><i
                                            class="fa fa-redo" aria-hidden="true"></i></a>
                                    @if (env('IS_DEV') == 1)
                                        <a class="btn btn-icon btn-sm btn-outline-success mr-2" href="#"
                                            data-toggle="modal" data-target="#siteModal"><i class="fa fa-info"></i></a>
                                    @endif
                                    @if (auth()->user()->isAbleTo('add_mail_template'))
                                        <a href="{{ route('admin.mail-sms-templates.create') }}"
                                            class="btn btn-icon btn-sm btn-outline-primary mr-1" title="Add new lead"><i
                                                class="fa fa-plus" aria-hidden="true"></i>
                                        </a>
                                    @endif
                                </div>
                            </form>
                            <form action="{{ route('admin.mail-sms-templates.bulk-action') }}" method="POST"
                                id="bulkAction">
                                @csrf
                                <input type="hidden" name="ids" id="bulk_ids">

                                <button style="background: transparent;border:none;" class="dropdown-toggle p-0 three-dots"
                                    type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false"><i class="ik ik-more-vertical pl-1"></i></button>
                                <ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">
                                    <button type="submit" class="dropdown-item bulk-action text-danger fw-700"
                                        data-value="" data-message="You want to delete these items?" data-action="delete"
                                        data-callback="bulkDeleteCallback"> Bulk Delete
                                    </button>
                                </ul>

                            </form>
                        </div>
                    </div>
                    <div id="ajax-container">
                        @include('admin.mail-sms-templates.load')
                    </div>
                </div>
            </div>
            @include('admin.modal.sitemodal', [
                'title' => 'How to use',
                'content' =>
                    'You need to create a unique code and call the unique code with paragraph content helper.',
            ])
        </div>
    </div>
@endsection
<!-- push external js -->

@push('script')
    @include('admin.include.bulk-script')
    <script src="{{ asset('admin/js/index-page.js') }}"></script>
    <script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>

    {{-- START AJAX FORM INIT --}}
    <script src="{{ asset('admin/js/ajaxForm.js') }}"></script>
    <script>
        // STORE DATA USING AJAX
        $('.ajaxForm').on('submit', function(e) {
            e.preventDefault();
            var route = $(this).attr('action');
            var method = $(this).attr('method');
            var data = new FormData(this);
            var response = postData(method, route, 'json', data, null, null);
            if (typeof(response) != "undefined" && response !== null && response.status == "success") {

            }
        })
    </script>
    {{-- END AJAX FORM INIT --}}

    {{-- START HTML TO EXCEL INIT --}}
    <script>
        function html_table_to_excel(type) {
            var table_core = $("#mailSmsTable").clone();
            var clonedTable = $("#mailSmsTable").clone();
            clonedTable.find('[class*="no-export"]').remove();
            clonedTable.find('[class*="d-none"]').remove();
            $("#mailSmsTable").html(clonedTable.html());
            var data = document.getElementById('mailSmsTable');

            var file = XLSX.utils.table_to_book(data, {
                sheet: "sheet1"
            });
            XLSX.write(file, {
                bookType: type,
                bookSST: true,
                type: 'base64'
            });
            XLSX.writeFile(file, 'leadFile.' + type);
            $("#mailSmsTable").html(table_core.html());
        }
        $(document).on('click', '#export_button', function() {
            html_table_to_excel('xlsx');
        });
    </script>
    {{-- END HTML TO EXCEL INIT --}}

    {{-- START RESET BUTTON INIT --}}
    <script>
        $('#reset').click(function() {
            fetchData("{{ route('admin.mail-sms-templates.index') }}");
            window.history.pushState("", "", "{{ route('admin.mail-sms-templates.index') }}");
            $('#TableForm').trigger("reset");
            $(document).find('.close.off-canvas').trigger('click');
        });
    </script>
    {{-- END RESET BUTTON INIT --}}
@endpush
