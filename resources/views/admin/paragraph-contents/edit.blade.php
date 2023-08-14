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
                            <h5>Edit {{ $label }} </h5>
                            <span>Update a record for {{ $label }} </span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    @include('admin.include.breadcrumb')
                </div>
            </div>
        </div>
        <form action="{{ route('admin.paragraph-contents.update', $paragraphContent->id) }}" method="post"
            enctype="multipart/form-data" class="ajaxForm">
            @csrf
            <input type="hidden" name="type" value="{{ $paragraphContent->type }}" id="type">
            <div class="row">
                <div class="col-md-6 mx-auto">
                    <!-- start message area-->
                    @include('admin.include.message')
                    <!-- end message area-->
                    <div class="card ">
                        <div class="card-header d-flex justify-content-between">
                            <h3>Update {{ $label }}</h3>
                            <button type="submit" class="btn btn-primary">Save & Update</button>
                        </div>
                        <div class="card-body">
                            <input type="hidden" name="request_with" value="update">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group ">
                                        <label for="code" class="control-label">Code <span
                                                class="text-red">*</span></label>
                                        <a href="javascript:void(0);" title="@lang('admin/tooltip.edit_site_content_managements_code')"><i
                                                class="ik ik-help-circle text-muted ml-1"></i></a>
                                        <input required readonly class="form-control" name="code" pattern="[a-zA-Z]+.*"
                                            title="Please enter first letter alphabet and at least one alphabet character is required."
                                            type="text" id="name" value="{{ $paragraphContent->code }}">
                                    </div>
                                </div>
                                {{-- @dd($paragraphContent) --}}
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="value" class="control-label">Value</label>
                                        {!! getHelp('Publicly readable name') !!}
                                        <div id="toolbar-container"></div>
                                        @if ($paragraphContent->type == 2)
                                            <div id="txt_area">
                                                {!! $paragraphContent->value !!}
                                            </div>
                                        @else
                                            <div id="content">
                                                <textarea name="value" placeholder="Enter Value" class="form-control ck-editor description" rows="5">{{ $paragraphContent->value }}</textarea>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group ">
                                        <label for="group" class="control-label">Group<span
                                                class="text-red">*</span></label>
                                        <a href="javascript:void(0);" title="@lang('admin/tooltip.edit_site_content_managements_group')"><i
                                                class="ik ik-help-circle text-muted ml-1"></i></a>
                                        <select id="group" required name="group"
                                            class="select2 form-control course-filter">
                                            <option readonly value="">{{ __('Select Group') }}</option>
                                            @foreach (getCategoriesByCode('ParagraphContentGroup') as $item)
                                                <option value="{{ $item->id }}"
                                                    {{ $paragraphContent->group == $item->id ? 'selected' : '' }}>
                                                    {{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="remark" class="control-label">Remark</label>
                                        <a href="javascript:void(0);" title="@lang('admin/tooltip.edit_site_content_managements_remark')"><i
                                                class="ik ik-help-circle text-muted ml-1"></i></a>
                                        <textarea class="form-control" name="remark" placeholder="Enter Remark" id="">{{ $paragraphContent->remark }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!-- push external js -->
    @push('script')
        <script src="https://cdn.ckeditor.com/ckeditor5/37.1.0/decoupled-document/ckeditor.js"></script>
        <script>
            let editor;
            $(window).on('load', function() {
                var type = '{{ $paragraphContent->type }}';
                if (type == 2) {
                    $('#txt_area').addClass('ck-editor');
                    DecoupledEditor
                        .create(document.querySelector('.ck-editor'), {
                            ckfinder: {
                                uploadUrl: "{{ route('admin.media.ckeditor.upload') . '?_token=' . csrf_token() }}",
                            }
                        })
                        .then(newEditor => {
                            editor = newEditor;
                            const toolbarContainer = document.querySelector('#toolbar-container');

                            toolbarContainer.appendChild(editor.ui.view.toolbar.element);
                        })
                        .catch(error => {
                            console.error(error);
                        });
                } else {
                    var content = $('#description').val();
                    $('#content').html(
                        '<textarea name="value" class="form-control ck-editor description" rows="5">{{ $paragraphContent->value }}</textarea>'
                        );
                }
            });
        </script>

        {{-- START AJAX FORM INIT --}}
        <script src="{{ asset('admin/js/ajaxForm.js') }}"></script>
        <script>
            // UPDATE  DATA USING AJAX
            $('.ajaxForm').on('submit', function(e) {
                e.preventDefault();
                var route = $(this).attr('action');
                var method = $(this).attr('method');
                var data = new FormData(this);
                if (editor != undefined) {
                    const value = editor.getData();
                    data.append('value', value);
                }
                var response = postData(method, route, 'json', data, null, null);
                var redirectUrl = "{{ url('admin/paragraph-contents') }}";
                if (typeof(response) != "undefined" && response !== null && response.status == "success") {
                    window.location.href = redirectUrl;
                }
            });
        </script>
        {{-- END AJAX FORM INIT --}}
    @endpush
@endsection
