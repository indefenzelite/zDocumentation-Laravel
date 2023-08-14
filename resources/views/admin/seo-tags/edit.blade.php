@extends('layouts.main')

@section('title', $label)
@section('content')
    @php
        $breadcrumb_arr = [['name' => 'Edit' . ' ' . $label, 'url' => 'javascript:void(0);', 'class' => '']];
    @endphp
    <!-- push external head elements to head -->
    @push('head')
        <link rel="stylesheet" href="{{ asset('backend/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}">
        <style>
            .bootstrap-tagsinput {
                width: 100%;
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
                            <h5>{{ __('Edit ') }} {{ $label }}</h5>
                            <span>{{ __('Update a record for') }} {{ $label }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    @include('admin.include.breadcrumb')
                </div>
            </div>
        </div>
        <!-- start message area-->
        @include('admin.include.message')
        <!-- end message area-->
        <form action="{{ route('admin.seo-tags.update', $seoTag->id) }}" method="post" class="ajaxForm">
            @csrf
            <div class="row">
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-header">
                            <h3>Seo Tag</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group ">
                                        <label for="value" class="control-label">Title</label>
                                        <a href="javascript:void(0);" title="@lang('admin/tooltip.edit_seo_tags_title')"><i
                                                class="ik ik-help-circle text-muted ml-1"></i></a>
                                        <input class="form-control" pattern="[a-zA-Z]+.*"
                                            title="Please enter fir pattern="[a-zA-Z]+.*"
                                            title="Please enter first letter alphabet and at least one alphabet character is required."
                                            at least one alphabet character is required." name="title"
                                            value="{{ $seoTag->title }}">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group ">
                                        <label for="value" class="control-label">Description</label>
                                        <a href="javascript:void(0);" title="@lang('admin/tooltip.edit_seo_tags_description')"><i
                                                class="ik ik-help-circle text-muted ml-1"></i></a>
                                        <textarea class="form-control"rows="8" name="description">{{ $seoTag->description }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-7">
                    <input type="hidden" name="request_with" value="update">
                    <div class="card ">
                        <div class="card-header d-flex justify-content-between">
                            <h3>Seo Tag Code</h3>
                            <div>
                                <button class="btn btn-primary" type="submit">Update</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group ">
                                        <label for="value" class="control-label">Code<span
                                                class="text-red">*</span></label>
                                        <a href="javascript:void(0);" title="@lang('admin/tooltip.edit_seo_tags_code')"><i
                                                class="ik ik-help-circle text-muted ml-1"></i></a>
                                        <input class="form-control" name="code" readonly
                                            value="{{ $seoTag->code }}"required>
                                    </div>
                                </div> pattern="[a-zA-Z]+.*"
                                title="Please enter first letter alphabet and at least one alphabet character is required."
                                <div class="col-md-12">
                                    <div class="form-group ">
                                        <label for="value" class="control-label">Keyword</label>
                                        <a href="javascript:void(0);" title="@lang('admin/tooltip.edit_seo_tags_keyword')"><i
                                                class="ik ik-help-circle text-muted ml-1"></i></a>
                                        <input type="text" pattern="[a-zA-Z]+.*"
                                            title="Please enter first letter alphabet and at least one alphabet character is required."
                                            id="tags" class="form-control" value="{{ $seoTag->keyword }}"
                                            name="keyword">

                                        {{-- <input class="form-control" name="keyword" value="{{ $seoTag->keyword }}">  --}}
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group ">
                                        <label for="value" class="control-label">Remark</label>
                                        <a href="javascript:void(0);" title="@lang('admin/tooltip.edit_seo_tags_remark')"><i
                                                class="ik ik-help-circle text-muted ml-1"></i></a>
                                        <textarea class="form-control" name="remark">{{ $seoTag->remark }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    @push('script')
        {{-- START TAGINPUT INIT --}}
        <script src="{{ asset('admin/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js') }}"></script>
        <script>
            $('#tags').tagsinput('items');
        </script>
        {{-- END TAGINPUT INIT --}}

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
                var redirectUrl = "{{ url('admin/seo-tags') }}";
                if (typeof(response) != "undefined" && response !== null && response.status == "success") {
                    window.location.href = redirectUrl;
                }
            })
        </script>
        {{-- END AJAX FORM INIT --}}
    @endpush
@endsection
