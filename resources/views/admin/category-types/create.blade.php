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
                            <h5>{{ __('Create New') }} {{ $label }}</h5>
                            <span>{{ __('Add a new record for ') }}{{ $label }}</span>
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
            @include('admin.include.message')
            <!-- end message area-->
            <div class="col-md-6 mx-auto">
                <div class="card ">
                    <div class="card-header">
                        <h3>{{ __('Add') }} {{ $label }}</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.category-types.store') }}" method="post" class="ajaxForm">
                            @csrf
                            <input type="hidden" name="request_with" value="create">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                                        <label for="name" class="control-label">{{ ' Display Name' }}<span
                                                class="text-red">*</span></label>
                                        <a href="javascript:void(0);" title="@lang('admin/tooltip.add_category_types_name')"><i
                                                class="ik ik-help-circle text-muted ml-1"></i></a>
                                        <input class="form-control" name="name"type="text" pattern="[a-zA-Z]+.*"
                                            title="Please enter first letter alphabet and at least one alphabet character is required."
                                            id="name" placeholder="Display Name" value="" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group {{ $errors->has('code') ? 'has-error' : '' }}">
                                        <label for="code" class="control-label">{{ 'Code' }}<span
                                                class="text-red">*</span></label>
                                        <a href="javascript:void(0);" title="@lang('admin/tooltip.add_category_types_code')"><i
                                                class="ik ik-help-circle text-muted ml-1"></i></a>
                                        <input class="form-control" name="code"type="text" pattern="[a-zA-Z]+.*"
                                            title="Please enter first letter alphabet and at least one alphabet character is required."
                                            id="code" placeholder="Code" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group {{ $errors->has('allowed_level') ? 'has-error' : '' }}">
                                        <label for="allowed_level">{{ __('Allowed Level') }}<span
                                                class="text-red">*</span></label>
                                        <a href="javascript:void(0);" title="@lang('admin/tooltip.add_category_types_allowed_level')"><i
                                                class="ik ik-help-circle text-muted ml-1"></i></a>
                                        <select required name="allowed_level" id="allowed_level"
                                            class="form-control select2">
                                            <option value="" readonly>{{ __('Select Allowed Level') }}</option>
                                            <option value="1" selected>{{ __('1 - One Level') }}</option>
                                            <option value="2">{{ __('2 - Two Level') }}</option>
                                            <option value="3">{{ __('3 - Three Level') }}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group {{ $errors->has('remark') ? 'has-error' : '' }}">
                                        <label for="remark" class="control-label">{{ 'Remark' }} <span
                                                class="text-danger">(private)</span></label>
                                        <a href="javascript:void(0);" title="@lang('admin/tooltip.add_category_types_remark')"><i
                                                class="ik ik-help-circle text-muted ml-1"></i></a>
                                        <textarea class="form-control" rows="5" name="remark" type="textarea" id="remark"
                                            placeholder="Enter remark here..."></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group text-right">
                                <button type="submit" class="btn btn-primary">Create</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- push external js -->
    @push('script')
        {{-- START JS HELPERS INIT --}}
        <script>
            $('#name').on('keyup', function() {
                const input = $(this).val();
                const output = input
                    .split(' ')
                    .map((word, i) => {
                        if (i === 0) return word.toLowerCase().replace(/\b\w/g, s => s.toUpperCase());
                        return word.charAt(0).toUpperCase() + word.slice(1).toLowerCase();
                    })
                    .join('');
                $('#code').val(output);
            });
        </script>
        {{-- END JS HELPERS INIT --}}

        {{-- START AJAX FORM INIT --}}
        <script src="{{ asset('admin/js/ajaxForm.js') }}"></script>
        <script>
            // STORE DATA USING AJAX
            $('.ajaxForm').on('submit', function(e) {
                e.preventDefault();
                var route = $(this).attr('action');
                var method = $(this).attr('method');
                var data = new FormData(this);
                var response = postData(method, route, 'json', data, null, null);
                var redirectUrl = "{{ url('admin/category-types') }}";
                if (typeof(response) != "undefined" && response !== null && response.status == "success") {
                    window.location.href = redirectUrl;
                }
            })
        </script>
        {{-- END AJAX FORM INIT --}}
    @endpush
@endsection
