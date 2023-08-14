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
            <!-- start message area-->
            <!-- end message area-->
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h3>{{ $label }}</h3>
                        <div class="d-flex">
                            @if (env('IS_DEV') == 1)
                                <a class="btn btn-icon btn-sm btn-outline-success mr-2" href="#" data-toggle="modal"
                                    data-target="#siteModal"><i class="fa fa-info"></i></a>
                            @endif
                            @if (auth()->user()->isAbleTo('add_slider'))
                                <a href="{{ route('admin.slider-types.create') }}"
                                    class="btn btn-icon btn-sm btn-outline-primary mr-2" title="Add New Slider Type"><i
                                        class="fa fa-plus" aria-hidden="true"></i></a>
                            @endif
                            <form action="{{ route('admin.slider-types.bulk-action') }}" method="POST" id="bulkAction">
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
                        @include('admin.slider-types.load')
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
    <script src="{{ asset('admin/js/ajaxForm.js') }}"></script>
    @include('admin.include.bulk-script')
    <script src="{{ asset('admin/js/index-page.js') }}"></script>
    {{-- START HTML TO EXCEL INIT --}}
    <script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>
    <script>
        function html_table_to_excel(type) {
            var table_core = $("#sliderType").clone();
            var clonedTable = $("#sliderType").clone();
            clonedTable.find('[class*="no-export"]').remove();
            clonedTable.find('[class*="d-none"]').remove();
            $("#sliderType").html(clonedTable.html());
            var data = document.getElementById('sliderType');

            var file = XLSX.utils.table_to_book(data, {
                sheet: "sheet1"
            });
            XLSX.write(file, {
                bookType: type,
                bookSST: true,
                type: 'base64'
            });
            XLSX.writeFile(file, 'leadFile.' + type);
            $("#sliderType").html(table_core.html());
        }

        $(document).on('click', '#export_button', function() {
            html_table_to_excel('xlsx');
        });
        $('#reset').click(function() {
            fetchData("{{ route('admin.slider-types.index') }}");
            window.history.pushState("", "", "{{ route('admin.slider-types.index') }}");
            $('#TableForm').trigger("reset");
            $(document).find('.close.off-canvas').trigger('click');
        });
    </script>
    {{-- END HTML TO EXCEL INIT --}}
@endpush
