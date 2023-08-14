@extends('layouts.main')
@section('title', $label)
@section('content')
    @php
        /**
         * Subscription
         *
         * @category ZStarter
         *
         * @ref zCURD
         * @author  Defenzelite <hq@defenzelite.com>
         * @license https://www.defenzelite.com Defenzelite Private Limited
         * @version <zStarter: 1.1.0>
         * @link    https://www.defenzelite.com
         */
        $breadcrumb_arr = [['name' => $label, 'url' => 'javascript:void(0);', 'class' => 'active']];
    @endphp
    <!-- push external head elements to head -->
    @push('head')
        <link rel="stylesheet" href="{{ asset('admin/plugins/mohithg-switchery/dist/switchery.min.css') }}">
        <style>
            .error {
                color: red;
            }

            .form-group-append {
                position: relative;
                display: -ms-flexbox;
                display: flex;
                -ms-flex-wrap: wrap;
                flex-wrap: wrap;
                -ms-flex-align: stretch;
                align-items: stretch;
                width: 100%;
                margin-bottom: 1.25em;
                border: 1px solid #eaeaea;
                color: #495057;
            }

            .alert {
                padding: 5px 10px;
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
            @if (auth()->user()->isAbleTo('add_subscription_plan'))
                <div class="col-md-4">
                    <form action="{{ route('admin.subscriptions.store') }}" method="post" enctype="multipart/form-data"
                        id="SubscriptionForm"class="ajaxForm">
                        @csrf
                        <div class="card">
                            <div class="card-header justify-content-between">
                                <h3>New Plan </h3>
                                <button type="submit" class="btn btn-primary">Create</button>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12 col-12">
                                        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                                            <label for="name" class="control-label">Name<span
                                                    class="text-danger">*</span></label>
                                            <a href="javascript:void(0);" title="@lang('admin/tooltip.add_subscription_name')"><i
                                                    class="ik ik-help-circle text-muted ml-1"></i></a>
                                            <input required class="form-control" name="name" type="text"
                                                pattern="[a-zA-Z]+.*"
                                                title="Please enter first letter alphabet and at least one alphabet character is required."
                                                title="Please enter first letter alphabet and at least one alphabet character is required."
                                                title="Please enter first letter alphabet and at least one alphabet character is required."
                                                id="name" value="{{ old('name', '') }}" placeholder="Enter Name">
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-12">
                                        <div class="form-group {{ $errors->has('duration') ? 'has-error' : '' }}">
                                            <label for="duration" class="control-label">Duration<span
                                                    class="text-danger">*</span></label>
                                            <a href="javascript:void(0);" title="@lang('admin/tooltip.add_subscription_duration')"><i
                                                    class="ik ik-help-circle text-muted ml-1"></i></a>
                                            <div class="d-flex">
                                                <input required class="form-control" name="duration" type="number"
                                                    id="duration" min="0" value="{{ old('duration', '') }}"
                                                    placeholder="Enter Duration">
                                                <div class="input-group-append"style="margin-left: -6px;">
                                                    <span class="input-group-text" id="basic-addon2">In days</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="alert alert-info fade show mt-3" role="alert">
                                            <p class="mb-0">To make Lifetime plan, set the duration to 0</p>
                                        </div>
                                    </div>

                                    <div class="col-md-12 col-12">
                                        <div class="form-group {{ $errors->has('price') ? 'has-error' : '' }}">
                                            <label for="price" class="control-label">Price<span
                                                    class="text-danger">*</span></label>
                                            <a href="javascript:void(0);" title="@lang('admin/tooltip.add_subscription_price')"><i
                                                    class="ik ik-help-circle text-muted ml-1"></i></a>
                                            <div class="d-flex">
                                                <input class="form-control" name="price" type="number" step="any"
                                                    min="0" maxlength="5" id="price" value="{{ old('price') }}"
                                                    placeholder="Enter Price"required>
                                                <div class="input-group-append"style="margin-left: -6px;">
                                                    <span class="input-group-text" id="basic-addon2">In ₹</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="alert alert-info fade show mt-3" role="alert">
                                            <p class="mb-0">To give Free Subscription, set the price to 0</p>
                                        </div>
                                    </div>

                                    <div class="col-md-12 col-12">
                                        <div class="form-group {{ $errors->has('is_featured') ? 'has-error' : '' }}"><br>
                                            <label for="is_published" class="control-label">
                                                <input class="js-switch switch-input" checked
                                                    @if (old('is_published')) checked @endif name="is_published"
                                                    type="checkbox" id="is_published" value="1"> Published</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            @endif

            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h3>Plans</h3>
                        <button type="button" class="off-canvas btn btn-outline-secondary btn-icon ml-2"><i
                                class="fa fa-filter"></i></button>
                    </div>
                    <div id="ajax-container">
                        @include('admin.subscriptions.load')
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('admin.subscriptions.include.filter')
    <!-- push external js -->
    @push('script')
        <script src="{{ asset('admin/js/index-page.js') }}"></script>
        @include('admin.include.bulk-script')
        <script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>
        <script src="{{ asset('admin/plugins/mohithg-switchery/dist/switchery.min.js') }}"></script>
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
                var redirectUrl = "{{ url('admin/subscriptions/') }}";
                if (typeof(response) != "undefined" && response !== null && response.status == "success") {
                    window.location.href = redirectUrl;
                }
            });
        </script>
        {{-- END AJAX FORM INIT --}}

        {{-- START HTML TO EXCEL INIT --}}
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
                XLSX.writeFile(file, 'SubscriptionFile.' + type);
                $("#table").html(table_core.html());
            }
            $(document).on('click', '#export_button', function() {
                html_table_to_excel('xlsx');
            });
        </script>
        {{-- END HTML TO EXCEL INIT --}}

        {{-- START RESET BUTTON INIT --}}
        <script>
            $('#reset').click(function() {
                fetchData("{{ route('admin.subscriptions.index') }}");
                window.history.pushState("", "", "{{ route('admin.subscriptions.index') }}");
                $('#TableForm').trigger("reset");
                $(document).find('.close.off-canvas').trigger('click');
            });
        </script>
        {{-- END RESET BUTTON INIT --}}
    @endpush
@endsection
