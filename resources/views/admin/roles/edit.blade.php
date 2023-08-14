@extends('layouts.main')
@section('title', $role->display_name . ' - Edit Role')
@section('content')

    <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-award bg-blue"></i>
                        <div class="d-inline">
                            <h5>{{ __('Edit ' . $label) }}</h5>
                            <span>{{ __('Edit role & associate permissions') }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ url('dashboard') }}"><i class="ik ik-home"></i></a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="#">{{ __($label) }}</a>
                            </li>
                            <li class="breadcrumb-item">
                                {{ $role->display_name }}
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
            <div class="col-md-12">
                <div class="card">
                    <form class="forms-sample" method="POST" action="{{ route('admin.roles.update', $role->id) }}">
                        <div class="card-header d-flex justify-content-between">
                            <h3>{{ __('Edit ' . $label) }}</h3>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-rounded">{{ __('Update') }}</button>
                            </div>
                        </div>
                        <div class="card-body">
                            @csrf
                            <input type="hidden" name="request_with" value="update">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="role">{{ __($label) }}<span class="text-red">*</span></label>
                                        <input type="text" pattern="[a-zA-Z]+.*"
                                            title="Please enter first letter alphabet and at least one alphabet character is required."
                                            class="form-control" id="role" name="role" value="{{ $role->name }}"
                                            placeholder="Insert Role">
                                        <input type="hidden" name="id" value="{{ $role->id }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="display_name">{{ __('Display Name') }}</label>
                                        {!! getHelp('Publicly readable name') !!}
                                        <input type="text" pattern="[a-zA-Z]+.*"
                                            title="Please enter first letter alphabet and at least one alphabet character is required."
                                            class="form-control" id="display_name" name="display_name" maxlength="20"
                                            placeholder="Display Name" value="{{ $role->display_name }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="description">{{ __('Description') }}</label>
                                        {!! getHelp('Publicly readable name') !!}
                                        <textarea type="text" class="form-control" id="description" name="description" placeholder="Description"
                                            maxlength="40">{{ $role->description }}</textarea>
                                    </div>
                                </div>
                                <div class="col-sm-8">
                                    <h6>{{ __('Assign Permissions') }} </h6>
                                    <hr class="mb-0">
                                    <div class="row mb-3">
                                        @foreach ($permissions as $permission)
                                            <div class="col-sm-4">
                                                <div class="mt-3 mb-0">
                                                    <label for=""
                                                        class="fw-700 m-0">{{ __($permission->group) }}</label>
                                                </div>
                                                @foreach (explode(',', $permission->permission_ids) as $key => $permission_id)
                                                    {{-- @dd($$permission->permission_names) --}}
                                                    <label class="custom-control custom-checkbox mb-0">
                                                        <!-- check permission exist -->
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="item_checkbox" name="permissions[]"
                                                            value="{{ $permission_id }}"
                                                            @if (in_array($permission_id, $role_permission)) checked @endif>
                                                        <span class="custom-control-label">
                                                            <!-- clean unescaped data is to avoid potential XSS risk -->
                                                            {{ getPermissionName($permission_id) }}
                                                        </span>
                                                    </label>
                                                @endforeach
                                            </div>
                                        @endforeach
                                    </div>


                                </div>
                            </div>
                        </div>
                </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@push('script')
    {{-- START AJAX FORM INIT --}}
    <script src="{{ asset('admin/js/ajaxForm.js') }}"></script>
    <script>
        $('.ajaxForm').on('submit', function(e) {
            e.preventDefault();
            var route = $(this).attr('action');
            var method = $(this).attr('method');
            var data = new FormData(this);
            var response = postData(method, route, 'json', data, null, null);
            var redirectUrl = "{{ url('admin/users') }}" + '?role=' + response.role;
            if (typeof(response) != "undefined" && response !== null && response.status == "success") {
                window.location.href = redirectUrl;
            }
        })
    </script>
    {{-- END AJAX FORM INIT --}}
@endpush
