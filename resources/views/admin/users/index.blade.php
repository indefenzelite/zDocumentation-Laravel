@extends('layouts.main')
@section('title', $label)
@section('content')
    <!-- push external head elements to head -->
    @push('head')
        <link rel="stylesheet" href="{{ asset('admin/plugins/select2/dist/css/select2.min.css') }}">
        
    @endpush

    <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-grid bg-blue"></i>
                        <div class="d-inline">
                            <h5>{{ $label }}</h5>
                            <span>{{ __('List of ') }}{{ $label }}</span>

                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('admin.dashboard.index') }}"><i class="ik ik-home"></i></a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="#">{{ $label }}</a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h3>{{ $label }}</h3>
                        <div class="d-flex align-items-center">
                            <button type="button" class="off-canvas btn btn-outline-secondary btn-icon ml-2"><i
                                    class="fa fa-filter"></i></button>
                            @if ($bulk_activation == 1)
                                <form action="{{ route('admin.users.bulk-action') }}" method="POST" id="bulkAction"
                                    class="">
                                    @csrf
                                    <input type="hidden" name="ids" id="bulk_ids">
                                    <div>
                                        <button style="background: transparent;border:none;"
                                            class="dropdown-toggle p-0 custom-dopdown" type="button" id="dropdownMenu1"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                                                class="ik ik-more-vertical pl-1"></i></button>
                                        <ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">
                                            <button type="submit" class="dropdown-item bulk-action text-danger fw-700"
                                                data-value="" data-message="You want to delete these items?"
                                                data-action="delete" data-callback="bulkDeleteCallback"> Delete
                                            </button>

                                            <a href="javascript:void(0)" class="dropdown-item bulk-action" data-value="0"
                                                data-status="Inactive" data-column="status"
                                                data-message="You want to mark Inactive these items?"
                                                data-action="columnUpdate" data-callback="bulkColumnUpdateCallback">Mark as
                                                Inactive
                                            </a>

                                            <a href="javascript:void(0)" class="dropdown-item bulk-action" data-value="1"
                                                data-status="Active" data-column="status"
                                                data-message="You want to mark Active these items?"
                                                data-action="columnUpdate" data-callback="bulkColumnUpdateCallback">Mark as
                                                Active
                                            </a>
                                        </ul>
                                    </div>
                                </form>
                            @endif
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="ajax-container">
                            @include('admin.users.load')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('admin.users.includes.filter')
    @include('admin.modal.add-user-wallet')
    <!-- push external js -->
    @push('script')
        <script src="{{ asset('admin/js/index-page.js') }}"></script>
        {{-- START SELECT 2 BUTTON INIT --}}
        <script src="{{ asset('admin/plugins/select2/dist/js/select2.min.js') }}"></script>
        <script>
            $('.select2').select2();
        </script>
        {{-- END SELECT 2 BUTTON INIT --}}

        {{-- START UPDATE STATUS INIT --}}
        <script>
            // UPDATE USER STATUS USING AJAX  
            $(document).on('click', '.statusChanger', function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                var currentStatus = $('.status' + id).data('status');
                var currentBadgeClass = $('.status' + id).data('class');
                var status = $(this).data('status');
                var badgeClass = $(this).data('class');
                var value = $(this).data('value');
                var url = $(this).data('url');

                var response = postData("get", url + '/' + status, 'json', null, function(response) {
                    console.log(response);
                    // if(typeof(response) != "undefined" && response !== null && response.status == "success"){
                    //     $(document).find('.status'+id).html('<span class="badge '+badgeClass+' ">'+$(this).html()+'</span>');
                    //     $(this).data('status',$(document).find('.status'+id).data('status'));
                    //     ($(this).data('value',$(this).html()));
                    //     $(this).html(value);
                    //     ($(this).data('class',currentBadgeClass));
                    //     $('.status'+id).data('class',badgeClass);
                    //     $(document).find('.status'+id).data('status',currentStatus);
                    // }else{
                    //     pushNotification("Something went wrong","Failed to update status","error")
                    // }
                }, e);
            })
        </script>
        {{-- END UPDATE STATUS INIT --}}

        {{-- START AJAX FORM INIT --}}
        <script src="{{ asset('admin/js/ajaxForm.js') }}"></script>
        <script>
            $('.ajaxForm').on('submit', function(e) {
                e.preventDefault();
                var route = $(this).attr('action');
                var method = $(this).attr('method');
                var data = new FormData(this);
                var response = postData(method, route, 'json', data, null, null);
                if (typeof(response) != "undefined" && response !== null && response.status == "success") {
                    console.log(response);
                    $('#walletModal').modal('toggle');
                    $('.amount').val('');
                    $('.transationType').prop('checked', false);
                    let id = response.user_id;
                    let route = "{{ url('/admin/wallet-logs/user') }}";
                    window.location.href = route + '/' + id;
                }
            });
        </script>
        {{-- END AJAX FORM INIT --}}

        {{-- START WALLET LOG INIT --}}
        <script>
            $(document).on('click', '.walletLogButton', function() {
                var user_record = $(this).data('id');
                $('#uuid').val(user_record);
                $('#walletModal').modal('show');
            });
        </script>
        {{-- END WALLET LOG INIT --}}

        {{-- START HTML TO EXCEL INIT --}}
        <script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>
        <script>
            function html_table_to_excel(type) {
                var table_core = $("#user_table").clone();
                var clonedTable = $("#user_table").clone();
                clonedTable.find('[class*="no-export"]').remove();
                clonedTable.find('[class*="d-none"]').remove();
                $("#user_table").html(clonedTable.html());
                var data = document.getElementById('user_table');

                var file = XLSX.utils.table_to_book(data, {
                    sheet: "sheet1"
                });
                XLSX.write(file, {
                    bookType: type,
                    bookSST: true,
                    type: 'base64'
                });
                XLSX.writeFile(file, 'Users.' + type);
                $("#user_table").html(table_core.html());
            }

            $(document).on('click', '#export_button', function() {
                html_table_to_excel('xlsx');
            });
        </script>
        {{-- END HTML TO EXCEL INIT --}}

        {{-- START JS HELPERS INIT --}}
        <script>
            $('#getDataByRole').change(function() {
                if (checkUrlParameter('role')) {
                    url = updateURLParam('role', $(this).val());
                } else {
                    url = updateURLParam('role', $(this).val());
                }
                fetchData(url);
            });
        </script>
        {{-- END JS HELPERS INIT --}}

        {{-- START RESET BUTTON INIT --}}
        <script>
            $('#reset').click(function() {
                fetchData("{{ route('admin.users.index') }}");
                window.history.pushState("", "",
                "{{ route('admin.users.index') }}?role={{ request()->get('role') }}");
                $('#TableForm').trigger("reset");
                $(document).find('.close.off-canvas').trigger('click');
                $('#status').select2('val', "");
                $('#status').trigger('change');
            });
        </script>
        {{-- END RESET BUTTON INIT --}}
        @include('admin.include.bulk-script')
    @endpush
@endsection
