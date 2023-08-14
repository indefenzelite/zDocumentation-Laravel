@extends('layouts.main')
@section('title', 'Permission')
@section('content')
    @php
        $breadcrumb_arr = [['name' => 'Permissions', 'url' => 'javascript:void(0);', 'class' => 'active']];
    @endphp
    <!-- push external head elements to head -->
    <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-grid bg-blue"></i>
                        <div class="d-inline">
                            <h5>{{ __('Permissions') }}</h5>
                            <span>{{ __('Define permissions of user') }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    @include('admin.include.breadcrumb')
                </div>
            </div>
        </div>
        <div class="row clearfix">
            <!-- start message area-->
            @include('admin.include.message')
            <!-- end message area-->
            <!-- only those have manage_permission permission will get access -->
            @if (env('DEV_MODE') == 1)
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h3>{{ __('Add Permission') }}</h3>
                        </div>
                        <div class="card-body">
                            <form class="forms-sample" method="POST" action="{{ route('admin.permissions.store') }}">
                                @csrf
                                <input type="hidden" name="create" value="request_with">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="permission">{{ __('Permission') }}<span
                                                    class="text-red">*</span></label>
                                            <a href="javascript:void(0);" title="@lang('admin/tooltip.add_permission_name')"><i
                                                    class="ik ik-help-circle text-muted ml-1"></i></a>
                                            <input type="text" pattern="[a-zA-Z]+.*"
                                                title="Please enter first letter alphabet and at least one alphabet character is required."
                                                class="form-control" id="permission" name="permission"
                                                placeholder="Permission Name" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail3">{{ __('Assigned to Role') }} </label>
                                            <a href="javascript:void(0);" title="@lang('admin/tooltip.add_permission_roles')"><i
                                                    class="ik ik-help-circle text-muted ml-1"></i></a>
                                            <select name="roles[]" id="roles" class="form-control select2" multiple>
                                                <option value="">Select Role</option>
                                                @foreach ($roles as $role)
                                                    <option value="{{ $role->id }}">{{ $role->display_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail3">{{ __('Group Name') }} </label>
                                            <a href="javascript:void(0);" title="@lang('admin/tooltip.add_permission_group')"><i
                                                    class="ik ik-help-circle text-muted ml-1"></i></a>
                                            <input type="text" pattern="[a-zA-Z]+.*"
                                                title="Please enter first letter alphabet and at least one alphabet character is required."
                                                class="form-control" name="group" value=""
                                                placeholder="Enter the permission group name">

                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <button type="submit"
                                                class="btn btn-primary btn-rounded">{{ __('Create Permission & Sync Roles') }}</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endif
            <div @if (env('DEV_MODE') != 1) class="col-md-12" @else class="col-md-8" @endif>
                <div class="card">
                    <div id="ajax-container">
                        @include('admin.permissions.load')
                    </div>
                </div>
            </div>
            {{-- @endif --}}
        </div>
        <div class="row">

        </div>
    </div>
    <!-- push external js -->
    @push('script')
        <script src="{{ asset('admin/js/index-page.js') }}"></script>
        {{-- START HTML TO EXCEL BUTTON INIT --}}
        <script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>
        <script>
            function html_table_to_excel(type) {
                var table_core = $("#permissions_table").clone();
                var clonedTable = $("#permissions_table").clone();
                clonedTable.find('[class*="no-export"]').remove();
                clonedTable.find('[class*="d-none"]').remove();
                $("#permissions_table").html(clonedTable.html());
                // console.log(clonedTable.html());
                var data = document.getElementById('permissions_table');

                var file = XLSX.utils.table_to_book(data, {
                    sheet: "sheet1"
                });
                XLSX.write(file, {
                    bookType: type,
                    bookSST: true,
                    type: 'base64'
                });
                XLSX.writeFile(file, 'PermissionFile.' + type);
                $("#permissions_table").html(table_core.html());
            }
        </script>
        {{-- END HTML TO EXCEL BUTTON INIT --}}

        {{-- START JS HELPERS INIT --}}
        <script>
            $(document).ready(function() {
                $(document).find('#roles').select2();
            })

            $(document).on('click', '#export_button', function() {
                html_table_to_excel('xlsx');
            });

            $(document).on('click', '.confirm-btn', function(e) {
                e.preventDefault();
                var url = $(this).attr('href');
                var msg = $(this).data('msg') ?? "You won't be able to revert back!";
                $.confirm({
                    draggable: true,
                    title: 'Are You Sure!',
                    content: msg,
                    type: 'blue',
                    typeAnimated: true,
                    buttons: {
                        tryAgain: {
                            text: 'Confirm',
                            btnClass: 'btn-blue',
                            action: function() {
                                window.location.href = url;
                            }
                        },
                        close: function() {}
                    }
                });
            });
        </script>
        {{-- END JS HELPERS INIT --}}
    @endpush
@endsection
