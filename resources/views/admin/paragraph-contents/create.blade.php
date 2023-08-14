@extends('layouts.main')
@section('title', $label)
@section('content')
    @php
        $breadcrumb_arr = [['name' => 'Add' . ' ' . $label, 'url' => 'javascript:void(0);', 'class' => '']];
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
                            <h5>Add {{ $label }} </h5>
                            <span>Create a recor d for {{ $label }} </span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    @include('admin.include.breadcrumb')
                </div>
            </div>
        </div>
        <form action="{{ route('admin.paragraph-contents.store') }}" method="post" enctype="multipart/form-data"
            class="ajaxForm">
            @csrf
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header justify-content-between">
                            <h3>Paragraph Details</h3>
                            <button type="submit" class="btn btn-primary">Create</button>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group ">
                                        <label for="code" class="control-label">Code <span class="text-red">*</span>
                                        </label>
                                        <a href="javascript:void(0);" title="@lang('admin/tooltip.add_site_content_managements_code')"><i
                                                class="ik ik-help-circle text-muted ml-1"></i></a>
                                        <input class="form-control" name="code" pattern="[a-zA-Z]+.*"
                                            title="Please enter first letter alphabet and at least one alphabet character is required."
                                            type="text" id="name" placeholder="Enter Code" value="" required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="value" class="control-label">Type <span
                                                class="text-red">*</span></label>
                                        <a href="javascript:void(0);" title="@lang('admin/tooltip.add_site_content_managements_type')"><i
                                                class="ik ik-help-circle text-muted ml-1"></i></a>
                                        <select name="type" id="remarkType" class="form-control select2" required>
                                            @foreach (\App\Models\ParagraphContent::TYPES as $key => $type)
                                                <option value="{{ $key }}">{{ $type['label'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group ">
                                        <label for="group" class="control-label">Group <span class="text-red">*</span>
                                        </label>
                                        <a href="javascript:void(0);" title="@lang('admin/tooltip.add_site_content_managements_group')"><i
                                                class="ik ik-help-circle text-muted ml-1"></i></a>
                                        <select id="group" required name="group"
                                            class="select2 form-control course-filter">
                                            <option readonly value="">{{ __('Select Group') }}</option>
                                            @foreach (getCategoriesByCode('ParagraphContentGroup') as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-2"></div>
            </div>
        </form>
    </div>
@endsection
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
            if (editor != undefined) {
                const description = editor.getData();
                data.append('value', description);
            }
            var response = postData(method, route, 'json', data, null, null);
            var redirectUrl = "{{ url('admin/paragraph-contents') }}" + "/" + response.paragraphContent - > id;
            if (typeof(response) != "undefined" && response !== null && response.status == "success") {
                window.location.href = redirectUrl;
            }
        })
    </script>
    {{-- END AJAX FORM INIT --}}
@endpush
