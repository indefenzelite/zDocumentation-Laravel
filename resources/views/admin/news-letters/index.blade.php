@extends('layouts.main')
@section('title', $label)
@section('content')
    @php
        $breadcrumb_arr = [['name' => $label, 'url' => 'javascript:void(0);', 'class' => 'active']];
    @endphp
    <!-- push external head elements to head -->
    @push('head')
        <link rel="stylesheet" href="{{ asset('admin/plugins/select2/dist/css/select2.min.css') }}">
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
            @if (auth()->user()->isAbleTo('add_newletter'))
                <div class="col-md-4">
                    <form action="{{ route('admin.news-letters.store') }}" method="post" enctype="multipart/form-data"
                        class="ajaxForm">
                        @csrf
                        <div class="card">
                            <div class="card-header justify-content-between">
                                <h3>Create NewsLetter</h3>
                                <div>
                                    <button type="submit" class="btn btn-primary mr-2">Create</button>
                                    <a href="{{ route('admin.compose-emails.index') }}"
                                        class="btn btn-icon btn-outline-info">
                                        <span title="Add Campaign">
                                            <i class="fa fa-bullhorn"></i>

                                        </span>
                                    </a>
                                </div>


                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <input type="hidden" name="request_with" value="create">
                                    <div class="form-group col-md-12">
                                        <label for="name">Name<span class="text-red">*</span></label>
                                        <a href="javascript:void(0);" title="@lang('admin/tooltip.add_newsletter_name')"><i
                                                class="ik ik-help-circle text-muted ml-1"></i></a>
                                        <input required class="form-control" name="name" type="text"
                                            pattern="[a-zA-Z]+.*"
                                            title="Please enter first letter alphabet and at least one alphabet character is required."
                                            placeholder="Enter Name" id="name" value="{{ old('name') }}" required>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="name">Type<span class="text-red">*</span></label>
                                        <a href="javascript:void(0);" title="@lang('admin/tooltip.add_newsletter_type')"><i
                                                class="ik ik-help-circle text-muted ml-1"></i></a>
                                        <select required name="type" id="type"class="form-control select2">
                                            <option value="1"selected>{{ 'Email' }}</option>
                                            <option value="2">{{ 'Number' }}</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="name">
                                            <span id="valueLabel">
                                                Email Address
                                            </span>
                                            <span class="text-red">*</span></label>
                                        <a href="javascript:void(0);" title="@lang('admin/tooltip.add_newsletter_email')"><i
                                                class="ik ik-help-circle text-muted ml-1"></i></a>
                                        <input class="form-control" name="value" type="email" pattern="[a-zA-Z]+.*"
                                            title="Please enter first letter alphabet and at least one alphabet character is required."
                                            min="1" id="value" placeholder="Enter Value"
                                            value="{{ old('value') }}" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            @endif
            @if (auth()->user()->isAbleTo('control_newletter'))
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h3>Newsletters</h3>
                            <div class="d-flex justify-content-between">
                                <button type="button" class="off-canvas btn btn-outline-secondary btn-icon ml-2"><i
                                        class="fa fa-filter"></i></button>
                                {{-- @if (env('IS_DEV') == 1) --}}
                                {{-- <a href="{{ route('admin.news-letters.create') }}" class="btn btn-icon btn-sm btn-outline-primary mr-1" title="Add New NewsLetter"><i class="fa fa-plus" aria-hidden="true"></i></a> --}}
                                {{-- @endif --}}
                                {{-- <a href="{{ route('admin.news-letters.launchcampaign') }}" class="btn btn-icon btn-sm btn-outline-success mr-1" title="Launch Campaign"><i class="ik ik-send" aria-hidden="true"></i></a> --}}
                                <form action="{{ route('admin.news-letters.bulk-action') }}" method="POST" id="bulkAction">
                                    @csrf
                                    <input type="hidden" name="ids" id="bulk_ids">
                                    <div class="dropdown d-flex">
                                        <button style="background: transparent;border:none;"
                                            class="dropdown-toggle p-0 three-dots" type="button" id="dropdownMenu1"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                                                class="ik ik-more-vertical pl-1"></i></button>
                                        <ul class="dropdown-menu multi-level dropdown-position" role="menu"
                                            aria-labelledby="dropdownMenu">
                                            <button type="submit" class="dropdown-item bulk-action text-danger fw-700"
                                                data-value="" data-message="You want to delete these items?"
                                                data-action="delete" data-callback="bulkDeleteCallback">Bulk Delete
                                            </button>
                                        </ul>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div id="ajax-container">
                            @include('admin.news-letters.load')
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
    @include('admin.news-letters.include.filter')
    @include('admin.include.bulk-script')
    <!-- push external js -->
    @push('script')
        <script src="{{ asset('admin/js/index-page.js') }}"></script>
        {{-- START SELECT 2 INIT --}}
        <script src="{{ asset('admin/plugins/select2/dist/js/select2.min.js') }}"></script>
        <script>
            $('select.select2').select2();
        </script>
        {{-- END SELECT 2 INIT --}}

        {{-- START HTML TO EXCEL INIT --}}
        <script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>
        <script>
            function html_table_to_excel(type) {
                var table_core = $("#news-letter").clone();
                var clonedTable = $("#news-letter").clone();
                clonedTable.find('[class*="no-export"]').remove();
                clonedTable.find('[class*="d-none"]').remove();
                $("#news-letter").html(clonedTable.html());
                var data = document.getElementById('news-letter');

                var file = XLSX.utils.table_to_book(data, {
                    sheet: "sheet1"
                });
                XLSX.write(file, {
                    bookType: type,
                    bookSST: true,
                    type: 'base64'
                });
                XLSX.writeFile(file, 'newsLetterFile.' + type);
                $("#news-letter").html(table_core.html());
            }

            $(document).on('click', '#export_button', function() {
                html_table_to_excel('xlsx');
            });
            $('#reset').click(function() {
                fetchData("{{ route('admin.news-letters.index') }}");
                window.history.pushState("", "", "{{ route('admin.news-letters.index') }}");
                $('#TableForm').trigger("reset");
                $(document).find('.close.off-canvas').trigger('click');
            });

            $(document).ready(function() {
                if ($('#type').val() == 1) {
                    $('#value').attr('type', 'email');
                } else {
                    $('#value').attr('type', 'number');
                }
                $("#type").on("change", function() {
                    if ($(this).val() == 1) {
                        $('#value').attr('type', 'email');
                        $('#valueLabel').html('Email Address');
                    } else {
                        $('#value').attr('type', 'number');
                        $('#valueLabel').html('Mobile Number');
                    }
                });
            });
        </script>
        {{-- END HTML TO EXCEL INIT --}}

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
                var redirectUrl = "{{ url('admin/news-letters') }}";
                if (typeof(response) != "undefined" && response !== null && response.status == "success") {
                    window.location.href = redirectUrl;
                }
            });
        </script>
        {{-- END AJAX FORM INIT --}}
    @endpush
@endsection
