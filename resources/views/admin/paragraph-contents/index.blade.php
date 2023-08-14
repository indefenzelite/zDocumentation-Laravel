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
                            <h5>{{ $label }}</h5>
                            <span>List of {{ $label }} </span>
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
                    <div class="card-header d-flex justify-content-between">
                        <h3>{{ $label }}</h3>
                        <div class="d-flex">

                            @if (env('IS_DEV') == 1)
                                <a class="btn btn-icon btn-sm btn-outline-success mr-2" href="#" data-toggle="modal"
                                    data-target="#siteModal"><i class="fa fa-info mt-2"></i></a>
                            @endif
                            @if (auth()->user()->isAbleTo('add_paragraph_content'))
                                <a href="{{ route('admin.paragraph-contents.create') }}"
                                    class="btn btn-icon btn-sm btn-outline-primary mr-2"
                                    title="Add New Site Content Management"><i class="fa fa-plus mt-2"
                                        aria-hidden="true"></i></a>
                            @endif
                            <button type="button" class="off-canvas btn btn-outline-secondary btn-icon"><i
                                    class="fa fa-filter"></i></button>
                            <form action="{{ route('admin.paragraph-contents.bulk-action') }}" method="POST"
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
                        @include('admin.paragraph-contents.load')
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
    @include('admin.paragraph-contents.include.filter')
    @include('admin.paragraph-contents.include.update')
@endsection
<!-- push external js -->
@push('script')
    <script src="{{ asset('admin/js/ajaxForm.js') }}"></script>
    @include('admin.include.bulk-script')
    <script src="{{ asset('admin/js/index-page.js') }}"></script>
    {{-- START HTML TO EXCEL INIT --}}
    <script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/37.1.0/decoupled-document/ckeditor.js"></script>
    <script>
        function html_table_to_excel(type) {
            var table_core = $("#siteTable").clone();
            var clonedTable = $("#siteTable").clone();
            clonedTable.find('[class*="no-export"]').remove();
            clonedTable.find('[class*="d-none"]').remove();
            $("#siteTable").html(clonedTable.html());
            var data = document.getElementById('siteTable');

            var file = XLSX.utils.table_to_book(data, {
                sheet: "sheet1"
            });
            XLSX.write(file, {
                bookType: type,
                bookSST: true,
                type: 'base64'
            });
            XLSX.writeFile(file, 'leadFile.' + type);
            $("#siteTable").html(table_core.html());
        }

        $(document).on('click', '#export_button', function() {
            html_table_to_excel('xlsx');
        });
        $('#reset').click(function() {
            fetchData("{{ route('admin.paragraph-contents.index') }}");
            window.history.pushState("", "", "{{ route('admin.paragraph-contents.index') }}");
            $('#TableForm').trigger("reset");
            $(document).find('.close.off-canvas').trigger('click');
        });
    </script>
    <script src="{{ asset('admin/js/ajaxForm.js') }}"></script>
    <script>
        var editor;
        $(ajaxContainer).on('click', '.edit-content', function(e) {
            let rec = $(this).data('rec');
            $('#Id').val(rec.id);
            $('.content').html('');
            if (rec.type == 1) {
                $('.content').html(
                    ` <textarea name="value" id="" class="form-control" cols="30" rows="10">${rec.value}</textarea>`
                );
            } else if (rec.type == 2) {
                $('.content').html(`  <div id="content-holder">
                                        <div id="toolbar-container"></div>
                                        <div id="txt_area">
                                            ${rec.value}
                                        </div>
                                    </div>`);
                $(document).find('#txt_area').addClass('ck-editor');
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
                $('.content').html(
                    `<input type="text"  pattern="[a-zA-Z]+.*" title="Please enter first letter alphabet and at least one alphabet character is required." name="value" class="form-control" value="${rec.value}" id="">`
                );
            }
            $('#updateParagraphModal').modal('show');
        });
        $('#update-ajax-form').on('submit', function(e) {
            e.preventDefault();
            var route = $(this).attr('action');
            var method = $(this).attr('method');
            var data = new FormData(this);
            if (data.get('value') == undefined || data.get('value') == '') {
                const value = editor.getData();
                data.append('value', value);
            }
            postData(method, route, 'json', data, null, null);
            $('#updateParagraphModal').modal('hide');
            fetchData("{{ route('admin.paragraph-contents.index') }}");
        });
    </script>
@endpush
