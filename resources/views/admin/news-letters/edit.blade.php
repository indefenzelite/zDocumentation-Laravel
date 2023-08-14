@extends('layouts.main')
@section('title', $label)
@section('content')
    @php
        $breadcrumb_arr = [['name' => 'Edit' . ' ' . $label, 'url' => 'javascript:void(0);', 'class' => '']];
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
                            <h5>Edit {{ $label }}</h5>
                            <span>Update a record for {{ $label }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    @include('admin.include.breadcrumb')
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 mx-auto">
                <!-- start message area-->
                @include('admin.include.message')
                <!-- end message area-->
                <div class="card ">
                    <div class="card-header">
                        <h3>Update {{ $label }}</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.news-letters.update', $newsLetter->id) }}" method="post"
                            enctype="multipart/form-data" class="ajaxForm">
                            @csrf
                            <input type="hidden" value="update" name="request_with">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group ">
                                        <label for="name" class="control-label">Name<span
                                                class="text-red">*</span></label>
                                        <a href="javascript:void(0);" title="@lang('admin/tooltip.edit_newsletter_name')"><i
                                                class="ik ik-help-circle text-muted ml-1"></i></a>
                                        <input class="form-control" name="name" type="text" pattern="[a-zA-Z]+.*"
                                            title="Please enter first letter alphabet and at least one alphabet character is required."
                                            id="name" value="{{ $newsLetter->name }}" required>
                                    </div>
                                </div>
                                <div class="col-md-6">

                                    <div class="form-group ">
                                        <label for="value" class="control-label">
                                            <span id="valueLabel">
                                                {{ $newsLetter->type == 1 ? 'Email Address' : 'Mobile Number' }}
                                            </span>
                                            <span class="text-red">*</span></label>
                                        <a href="javascript:void(0);" title="@lang('admin/tooltip.edit_newsletter_email')"><i
                                                class="ik ik-help-circle text-muted ml-1"></i></a>
                                        <input class="form-control" name="value" id="value"
                                            value="{{ $newsLetter->value }}"required>
                                    </div>
                                </div>
                                <div class="col-md-6">

                                    <div class="form-group ">
                                        <label for="value" class="control-label">Type<span
                                                class="text-red">*</span></label>
                                        <a href="javascript:void(0);" title="@lang('admin/tooltip.edit_newsletter_type')"><i
                                                class="ik ik-help-circle text-muted ml-1"></i></a>
                                        <select required name="type" id="type" class="form-control select2">
                                            <option value="" readonly>Select Type</option>
                                            <option value="1" {{ $newsLetter->type == 1 ? 'selected' : '' }}>
                                                {{ 'Email' }}</option>
                                            <option value="2" {{ $newsLetter->type == 2 ? 'selected' : '' }}>
                                                {{ 'Number' }}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group m-2">
                                <button type="submit" class="btn btn-primary">Save & Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- push external js -->
    @push('script')
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
            })
        </script>
        {{-- START AJAX FORM INIT --}}

        {{-- START EXPORT BUTTON INIT --}}
        <script>
            $(document).on('click', '#export_button', function() {
                html_table_to_excel('xlsx');
            })
        </script>
        {{-- END EXPORT BUTTON INIT --}}

        {{-- START JS HELPERS INIT --}}
        <script>
            function slugFunction() {
                var type = "{{ $newsLetter->type }}";
                if (type == 0) {
                    $('#value').attr('type', 'email');
                } else if (type == 1) {
                    $('#value').attr('type', 'number');
                }
            }
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
        {{-- END JS HELPERS INIT --}}
    @endpush
@endsection
