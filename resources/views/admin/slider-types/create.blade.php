@extends('layouts.main')
@section('title', $label)
@section('content')
    @php
        $breadcrumb_arr = [['name' => 'Add Slider Group', 'url' => 'javascript:void(0);', 'class' => '']];
    @endphp
    <!-- push external head elements to head -->
    @push('head')
        <link rel="stylesheet" href="{{ asset('admin/plugins/mohithg-switchery/dist/switchery.min.css') }}">
    @endpush

    <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-grid bg-blue"></i>
                        <div class="d-inline">
                            <h5>Add {{ $label }}</h5>
                            <span>Create a record for {{ $label }}</span>
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
                        <h3>Create {{ $label }}</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.slider-types.store') }}" method="post" enctype="multipart/form-data"
                            class="ajaxForm">
                            @csrf
                            <input type="hidden" name="request_with" value="create">
                            <div class="row">
                                <div class="col-md-6 col-6">
                                    <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                                        <label for="code" class="control-label">Code<span class="text-danger">*</span>
                                        </label>
                                        <a href="javascript:void(0);" title="@lang('admin/tooltip.add_slider_types_code')"><i
                                                class="ik ik-help-circle text-muted ml-1"></i></a>
                                        <input required class="form-control" name="code" type="text"
                                            pattern="[a-zA-Z]+.*"
                                            title="Please enter first letter alphabet and at least one alphabet character is required."id="code"
                                            value="{{ old('code') }}" placeholder="Enter Code">
                                    </div>
                                </div>
                                <div class="col-md-6 col-6">
                                    <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                                        <label for="title" class="control-label">Headline<span
                                                class="text-danger">*</span> </label>
                                        <a href="javascript:void(0);" title="@lang('admin/tooltip.add_slider_types_headline')"><i
                                                class="ik ik-help-circle text-muted ml-1"></i></a>
                                        <input required class="form-control" name="title" type="text"
                                            pattern="[a-zA-Z]+.*"
                                            title="Please enter first letter alphabet and at least one alphabet character is required."id="title"
                                            value="{{ old('title') }}" placeholder="Enter Headline">
                                    </div>
                                </div>
                                <div class="col-md-12 col-12">
                                    <div class="form-group">
                                        <label for="short_text" class="control-label">Sub Headline </label>
                                        <a href="javascript:void(0);" title="@lang('admin/tooltip.add_slider_types_sub_headline')"><i
                                                class="ik ik-help-circle text-muted ml-1"></i></a>
                                        <textarea class="form-control" name="short_text" id="short_text" placeholder="Enter Sub Headline"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 col-12">
                                    <div class="form-group">
                                        <label for="remark" class="control-label">Remark <span
                                                class="text-danger">(private)</span> </label>
                                        <a href="javascript:void(0);" title="@lang('admin/tooltip.add_slider_types_remark')"><i
                                                class="ik ik-help-circle text-muted ml-1"></i></a>
                                        <textarea class="form-control" name="remark" id="remark" placeholder="Enter Remark"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 col-12">
                                    <div class="form-group {{ $errors->has('is_published') ? 'has-error' : '' }}">
                                        <label for="is_published" class="control-label">
                                            <input class="js-switch switch-input"
                                                @if (old('is_published')) checked @endif
                                                name="is_published"type="checkbox" id="is_published" value="1"> Publish
                                        </label>
                                    </div>
                                </div>

                                <div class="col-md-12 ml-auto">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Create</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- push external js -->
    @push('script')
        <script src="{{ asset('admin/plugins/mohithg-switchery/dist/switchery.min.js') }}"></script>
        {{-- START CKEDITOR INIT --}}
        <script src="https://cdn.ckeditor.com/ckeditor5/34.2.0/classic/ckeditor.js"></script>
        <script>
            let editor;
            $(window).on('load', function() {
                $('#remarkType').on('change', function() {
                    var type = $(this).val();
                    if (type == 2) {
                        $('#txt_area').addClass('ck-editor');
                        ClassicEditor
                            .create(document.querySelector('.ck-editor'), {
                                ckfinder: {
                                    uploadUrl: "{{ route('admin.media.ckeditor.upload') . '?_token=' . csrf_token() }}",
                                }
                            })
                            .then(newEditor => {
                                editor = newEditor;
                            })
                            .catch(error => {

                            });

                    } else {
                        $('#content-holder').html('');
                        $('#content-holder').html(
                            ' <textarea  class="form-control" name="description" id="txt_area" placeholder="Enter Description"></textarea>'
                            );
                    }
                });
            });
        </script>
        {{-- END CKEDITOR INIT --}}

        {{-- START AJAX FORM INIT --}}
        <script src="{{ asset('admin/js/ajaxForm.js') }}"></script>
        <script>
            // STORE DATA USING AJAX
            $('.ajaxForm').on('submit', function(e) {
                e.preventDefault();
                var route = $(this).attr('action');
                var method = $(this).attr('method');
                var data = new FormData(this);
                if (editor != undefined) {
                    const description = editor.getData();
                    data.append('value', description);
                }
                var response = postData(method, route, 'json', data, null, null);
                var redirectUrl = "{{ url('admin/slider-types') }}";
                if (typeof(response) != "undefined" && response !== null && response.status == "success") {
                    window.location.href = redirectUrl;
                }
            })
        </script>
        {{-- END AJAX FORM INIT --}}
    @endpush
@endsection
