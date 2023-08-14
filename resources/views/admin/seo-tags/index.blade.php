@extends('layouts.main')
@section('title', $label)

@php
    $breadcrumb_arr = [['name' => $label, 'url' => 'javascript:void(0);', 'class' => 'active']];
@endphp

@section('content')
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
            <div class="col-md-12 mx-auto">
                <div class="card">
                    <ul class="nav nav-pills custom-pills" id="pills-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="seo_tags_tab" data-toggle="pill" href="#last-month"
                                role="tab" aria-controls="pills-profile" aria-selected="false">{{ __('Seo Tags') }}</a>
                        </li>
                        <li class="nav-item">
                            <a data-active="setting"
                                class="nav-link active-swicher @if (request()->has('active') && request()->get('active') == 'setting') active @endif"
                                id="pills-setting-tab" data-toggle="pill" href="#previous-month" role="tab"
                                aria-controls="pills-setting" aria-selected="false">{{ __('Global SEO') }}</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="last-month" role="tabpanel"
                            aria-labelledby="seo_tags_tab">
                            <div class="card-body">
                                <div class="row gutters-10">
                                    <div class="col-lg-12">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="card-header d-flex justify-content-between">
                                                    <h3>{{ $label }}</h3>
                                                    <div class="d-flex justify-content-between">
                                                        <button type="button"
                                                            class="off-canvas btn btn-outline-secondary btn-icon ml-2"><i
                                                                class="fa fa-filter"></i></button>
                                                        <form action="{{ route('admin.seo-tags.bulk-delete') }}"
                                                            method="POST">
                                                            @csrf
                                                            <input type="hidden" name="ids" id="bulk_ids">
                                                            <button style="background: transparent;border:none;"
                                                                class="dropdown-toggle p-0 three-dots" type="button"
                                                                id="dropdownMenu1" data-toggle="dropdown"
                                                                aria-haspopup="true" aria-expanded="false"><i
                                                                    class="ik ik-more-vertical pl-1"></i></button>
                                                            <ul class="dropdown-menu multi-level" role="menu"
                                                                aria-labelledby="dropdownMenu">
                                                                <button type="submit"
                                                                    class="dropdown-item bulk-action text-danger fw-700"
                                                                    data-value=""
                                                                    data-message="You want to delete these items?"
                                                                    data-action="delete" data-callback="bulkDeleteCallback">
                                                                    Bulk Delete
                                                                </button>
                                                            </ul>
                                                        </form>
                                                    </div>
                                                </div>
                                                <div id="ajax-container">
                                                    @include('admin.seo-tags.load')
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade @if (request()->has('active') && request()->get('active') == 'setting') show active @endif" id="previous-month"
                            role="tabpanel" aria-labelledby="pills-setting-tab">
                            <div class="card-body">
                                <form action="{{ route('admin.setting.store') }}" method="POST"
                                    enctype="multipart/form-data" class="ajaxForm">
                                    @csrf
                                    <input type="hidden" name="group_name" value="{{ 'appearance_global_seo' }}">
                                    <input type="hidden" name="active" value="{{ 'setting' }}">
                                    <input type="hidden" name="appearance_seo_group" value="{{ 'seo_group' }}">
                                    <div class="form-group row">
                                        <label class="col-md-3 col-from-label">{{ 'Meta Title' }}
                                            <a href="javascript:void(0);" title="@lang('admin/tooltip.global_seo_meta_title')"><i
                                                    class="ik ik-help-circle text-muted ml-1"></i></a>
                                        </label>
                                        <div class="col-md-8">
                                            <input type="text" pattern="[a-zA-Z]+.*"
                                                title="Please enter first letter alphabet and at least one alphabet character is required."class="form-control"
                                                placeholder="Title" name="seo_meta_title"
                                                value="{{ getSetting('seo_meta_title') }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 col-from-label">{{ 'Meta Description' }}
                                            <a href="javascript:void(0);" title="@lang('admin/tooltip.global_seo_meta_description')"><i
                                                    class="ik ik-help-circle text-muted ml-1"></i></a>
                                        </label>
                                        <div class="col-md-8">
                                            <textarea class="resize-off form-control" placeholder="Description" name="seo_meta_description">{{ getSetting('seo_meta_description') }}</textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 col-from-label">{{ 'Keywords' }}
                                            <a href="javascript:void(0);" title="@lang('admin/tooltip.global_seo_meta_keywords')"><i
                                                    class="ik ik-help-circle text-muted ml-1"></i></a>
                                        </label>
                                        <div class="col-md-8">
                                            <textarea class="resize-off form-control" placeholder="Keyword, Keyword" name="seo_meta_keywords">{{ getSetting('seo_meta_keywords') }}</textarea>
                                            <small class="text-muted">{{ 'Separate with coma' }}</small>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="logo" class="col-sm-3 col-form-label">{{ __('Meta Image') }}
                                            <a href="javascript:void(0);" title="@lang('admin/tooltip.global_seo_meta_image')"><i
                                                    class="ik ik-help-circle text-muted ml-1"></i></a>
                                        </label>
                                        <div class="col-sm-8">
                                            <input type="file" name="seo_meta_image" class="file-upload-default">
                                            <div class="input-group col-xs-12">
                                                <input type="text" class="form-control file-upload-info" disabled
                                                    placeholder="Upload Logo">
                                                <span class="input-group-append">
                                                    <button class="file-upload-browse btn btn-success"
                                                        type="button">{{ __('Upload') }}</button>
                                                </span>
                                            </div>
                                            <div class="file-preview box"></div>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <button type="submit" class="btn btn-primary">{{ 'Update' }}</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('admin.seo-tags.include.filter')
@endsection
<!-- push external js -->
@push('script')
    <script src="{{ asset('admin/js/ajaxForm.js') }}"></script>
    @include('admin.include.bulk-script')
    <script src="{{ asset('admin/js/index-page.js') }}"></script>
    {{-- START HTML TO EXCEL INIT --}}
    <script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>
    <script>
        function html_table_to_excel(type) {
            var table_core = $("#support-table").clone();
            var clonedTable = $("#support-table").clone();
            clonedTable.find('[class*="no-export"]').remove();
            clonedTable.find('[class*="d-none"]').remove();
            $("#support-table").html(clonedTable.html());
            var data = document.getElementById('support-table');

            var file = XLSX.utils.table_to_book(data, {
                sheet: "sheet1"
            });
            XLSX.write(file, {
                bookType: type,
                bookSST: true,
                type: 'base64'
            });
            XLSX.writeFile(file, 'SeoTagFile.' + type);
            $("#support-table").html(table_core.html());
        }

        $(document).on('click', '#export_button', function() {
            html_table_to_excel('xlsx');
        });
    </script>
    {{-- END HTML TO EXCEL INIT --}}

    {{-- START RESET BUTTON INIT --}}
    <script>
        $('#reset').click(function() {
            fetchData("{{ route('admin.seo-tags.index') }}");
            window.history.pushState("", "", "{{ route('admin.seo-tags.index') }}");
            $('#TableForm').trigger("reset");
            $(document).find('.close.off-canvas').trigger('click');
            $('#status').select2('val', "");
            $('#status').trigger('change');
        });
    </script>
    {{-- END RESET BUTTONINIT --}}
@endpush
