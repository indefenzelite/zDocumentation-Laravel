    @extends('layouts.main')
    @section('title', $label)
    @section('content')
        <!-- push external head elements to head -->
        @push('head')
            <style>
                .li-position {
                    min-width: 7rem;
                    width: 8rem;
                    transform: translate3d(-48px, 19px, 0px) !important;
                }

                .role-scrollable {
                    height: 300px;
                    overflow: scroll;
                    overflow-x: hidden;

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
                                <h5>{{ __($label) }}</h5>
                                <span>{{ __('Define roles of user') }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <nav class="breadcrumb-container" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ url('/') }}"><i class="ik ik-home"></i></a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="#">{{ __($label) }}</a>
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="row clearfix">
                <!-- start message area-->
                @include('admin.include.message')
                <!-- end message area-->
                <!-- only those have manage_role permission will get access -->

                @if (auth()->user()->isAbleTo('add_role'))
                    <div class="col-md-12">
                        <div class="card mb-2">
                            <form class="forms-sample" method="POST" action="{{ route('admin.roles.store') }}">
                                <div class="card-header d-flex justify-content-between">
                                    <h3 class="p-0 m-0">{{ __('Add ' . $label) }}</h3>
                                    <div class="form-group text-right p-0 m-0">
                                        <x-button>
                                            Create & Assign Permissions
                                        </x-button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    @csrf
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="role">{{ __('Role Name') }}<span
                                                        class="text-red">*</span></label>
                                                <a href="javascript:void(0);" title="@lang('admin/tooltip.add_role_name')"><i
                                                        class="ik ik-help-circle text-muted ml-1"></i></a>
                                                <input type="text" pattern="[a-zA-Z]+.*"
                                                    title="Please enter first letter alphabet and at least one alphabet character is required."class="form-control"
                                                    id="role" name="role"maxlength="20" placeholder="Role Name"
                                                    required>
                                            </div>
                                            <div class="form-group">
                                                <label for="display_name">{{ __('Display Name') }}<span
                                                        class="text-red">*</span></label>
                                                <a href="javascript:void(0);" title="@lang('admin/tooltip.add_role_display_name')"><i
                                                        class="ik ik-help-circle text-muted ml-1"></i></a>
                                                <input required type="text" pattern="[a-zA-Z]+.*"
                                                    title="Please enter first letter alphabet and at least one alphabet character is required."
                                                    class="form-control" id="display_name" name="display_name"
                                                    maxlength="20" placeholder="Display Name">
                                            </div>
                                            <div class="form-group">
                                                <label for="description">{{ __('Description') }}</label>
                                                <a href="javascript:void(0);" title="@lang('admin/tooltip.add_role_description')"><i
                                                        class="ik ik-help-circle text-muted ml-1"></i></a>
                                                <textarea type="text" class="form-control" id="description" name="description" maxlength="40"
                                                    placeholder="Description"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-sm-8">
                                            <h6>{{ __('Assign Permissions') }}</h6>
                                            <hr class="mb-0">
                                            <div class="row mb-3 role-scrollable">
                                                @foreach ($permissions as $permission)
                                                    <div class="col-sm-4">
                                                        <div class="mt-3 mb-0">
                                                            <label for=""
                                                                class="fw-600 m-0">{{ __($permission->group) }}</label>
                                                        </div>
                                                        @foreach (explode(',', $permission->permission_names) as $key => $permission_name)
                                                            <label class="custom-control mb-0 custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input"
                                                                    id="item_checkbox" name="permissions[]"
                                                                    value="{{ $permission_name }}">
                                                                <span class="custom-control-label">
                                                                    <!-- clean unescaped data is to avoid potential XSS risk -->
                                                                    {{ $permission_name }}
                                                                </span>
                                                            </label>
                                                        @endforeach
                                                    </div>
                                                @endforeach
                                            </div>

                                            {{-- <div class="row">
                                            <div class="col-sm-4">   
                                                <div>   
                                                    <label for="">{{__('Paragraph Content')}}</label>
                                                </div> 
                                                @foreach ($permissions as $key => $permission)
                                                    @if ($permission->group == 'Paragraph Content')
                                                        <label class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input" id="item_checkbox" name="permissions[]" value="{{$key}}">
                                                            <span class="custom-control-label fw-700">
                                                                <!-- clean unescaped data is to avoid potential XSS risk -->
                                                                {{ $permission->name }}
                                                            </span>
                                                        </label>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div> --}}

                                            {{-- <div class="form-group text-right mt-4">
                                            <x-button>
                                                Create & Assign Permissions
                                            </x-button>
                                        </div> --}}
                                        </div>
                                    </div>
                                </div>
                        </div>
                        </form>
                    </div>
                @endif
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card p-3">
                        <div class="card-header">
                            <h3>{{ __($label) }}</h3>
                        </div>
                        <div class="card-body">
                            @foreach ($roles as $role)
                                <div class="d-flex">
                                    @if ($role->name != 'Super Admin')
                                        <div class="dropdown">
                                            <button style="background: transparent;border:none;" class="dropdown-toggle p-0"
                                                type="button" id="dropdownMenu1" data-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false"><i
                                                    class="ik ik-more-vertical pl-1"></i></button>
                                            <ul class="dropdown-menu multi-level li-position" role="menu"
                                                aria-labelledby="dropdownMenu">
                                                @if (auth()->user()->isAbleTo('edit_role'))
                                                    <li class="dropdown-item p-0"><a
                                                            href="{{ route('admin.roles.edit', secureToken($role->id)) }}"
                                                            title="Edit Role" class="btn btn-sm">Edit</a></li>
                                                @endif
                                                @if (env('DEV_MODE') == 1)
                                                    <li class="dropdown-item p-0"><a
                                                            href="{{ route('admin.roles.destroy', $role->id) }}"
                                                            title="Delete Role"
                                                            class="btn btn-sm text-danger delete-item text-danger fw-700">Delete</a>
                                                    </li>
                                                @endif
                                            </ul>
                                        </div>
                                    @endif
                                    <h6 class="ml-2 mr-1">
                                        {{ $role->display_name }} |
                                    </h6>
                                    <p class="text-muted">{{ $role->description }}</p>
                                </div>
                                @if ($role->display_name == 'Super Admin')
                                    <span class="badge badge-success m-1">All permissions</span>
                                @else
                                    @foreach ($role->permissions()->get() as $item)
                                        <span class="badge badge-dark m-1">{{ $item->name }}</span>
                                    @endforeach
                                @endif
                                <hr>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- push external js -->
        @push('script')
            {{-- START JS HELPERS INIT --}}
            <script src="{{ asset('backend/plugins/select2/dist/js/select2.min.js') }}"></script>
            <!--server side roles table script-->
            <script>
                $(document).ready(function() {
                    var searchable = [];
                    var selectable = [];
                });
            </script>
            {{-- END JS HELPERS INIT --}}
        @endpush
    @endsection
