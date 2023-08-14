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
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between ">
                        <h3>{{ $label }}</h3>
                        <div class="d-flex justify-content-between">
                            @if (auth()->user()->isAbleTo('add_ticket'))
                                <a href="{{ route('admin.support-tickets.create') }}"
                                    class="btn btn-icon btn-sm btn-outline-primary" title="Add new lead"><i
                                        class="fa fa-plus mt-2" aria-hidden="true"></i>
                                </a>
                            @endif
                            <button type="button" class="off-canvas btn btn-outline-secondary btn-icon ml-2"><i
                                    class="fa fa-filter"></i></button>
                            <form action="{{ route('admin.support-tickets.bulk-delete') }}" method="POST" id="bulkAction">
                                @csrf
                                <input type="hidden" name="ids" id="bulk_ids">
                                <button style="background: transparent;border:none;" class="dropdown-toggle p-0 three-dots"
                                    type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false"><i class="ik ik-more-vertical pl-1"></i></button>
                                <ul class="dropdown-menu multi-level support-dropdown" role="menu"
                                    aria-labelledby="dropdownMenu">
                                    <button type="submit" class="dropdown-item bulk-action text-danger fw-700"
                                        data-value="" data-message="You want to delete these items?" data-action="delete"
                                        data-callback="bulkDeleteCallback"> Delete
                                    </button>
                                </ul>
                            </form>
                        </div>
                    </div>
                    <div id="ajax-container">
                        @include('admin.support-tickets.load')
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" id="RaiseTicketModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Raise a new Ticket</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.support-tickets.reply') }}" method="post">
                    @csrf
                    <input type="hidden" name="request_with" id="reply">
                    <input type="hidden" name="id" id="Id">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="fname">Your Reply:</label>
                            <textarea name="reply" class="form-control" id="reply" cols="30" rows="7"
                                placeholder="Please Enter Your Reply..."></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Send</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @include('admin.support-tickets.include.filter')
@endsection
<!-- push external js -->
@push('script')
    <script src="{{ asset('admin/js/ajaxForm.js') }}"></script>
    @include('admin.include.bulk-script')
    <script src="{{ asset('admin/js/index-page.js') }}"></script>
    {{-- START JS HELPERS INIT --}}
    <script>
        $('.reply').click(function() {
            $('#Id').val($(this).data('id'));
            $('#RaiseTicketModal').modal('show');
        })
    </script>
    {{-- END JS HELPERS INIT --}}

    {{-- START UPDATE STATUS INIT --}}
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
            XLSX.writeFile(file, 'supportTicketFile.' + type);
            $("#support-table").html(table_core.html());
        }
        $(document).on('click', '#export_button', function() {
            html_table_to_excel('xlsx');
        });
    </script>
    {{-- END UPDATE STATUS INIT --}}

    {{-- START RESET BUTTON INIT --}}
    <script>
        $('#reset').click(function() {
            fetchData("{{ route('admin.support-tickets.index') }}");
            window.history.pushState("", "", "{{ route('admin.support-tickets.index') }}");
            $('#TableForm').trigger("reset");
            $(document).find('.close.off-canvas').trigger('click');
            $('#status').select2('val', "");
            $('#status').trigger('change');
        });
    </script>
    {{-- END UPDATE STATUS INIT --}}
@endpush
