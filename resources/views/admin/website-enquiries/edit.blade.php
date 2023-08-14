@extends('layouts.main')
@section('title', $label)
@section('content')
    @php
        $breadcrumb_arr = [['name' => 'Edit' . '' . $label, 'url' => 'javascript:void(0);', 'class' => '']];
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
                            <h5>{{ __('Edit') }} {{ $label }}</h5>
                            <span>{{ __('Update a record for') }} {{ $label }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    @include('admin.include.breadcrumb')
                </div>
            </div>
        </div>
        <form action="{{ route('admin.website-enquiries.update', $websiteEnquiry->id) }}" method="post" class="ajaxForm">
            @csrf
            <div class="row">
                <!-- start message area-->
                <!-- end message area-->
                <div class="col-md-8">
                    <div class="card ">
                        <div class="card-header">
                            <h3>{{ __('Update ') }} {{ $label }}</h3>
                        </div>
                        <div class="card-body">
                            <input type="hidden" name="request_with" value="update">
                            <div class="row">
                                <div class="col-md-12 mx-auto">
                                    <div class="row">

                                        <div class="col-md-12">
                                            <div class="form-group {{ $errors->has('subject') ? 'has-error' : '' }}">
                                                <label for="subject">{{ __('Subject') }}<span
                                                        class="text-red">*</span></label>
                                                <a href="javascript:void(0);" title="@lang('admin/tooltip.edit_enquiry_subject')"><i
                                                        class="ik ik-help-circle text-muted ml-1"></i></a>
                                                <input class="form-control" name="subject" type="text"
                                                    pattern="[a-zA-Z]+.*"
                                                    title="Please enter first letter alphabet and at least one alphabet character is required."id="subject"
                                                    value="{{ @$websiteEnquiry->subject }}" placeholder="Enter Your subject"
                                                    required>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                                                <label for="description">{{ __('Description') }}
                                                    <span class="text-red">*</span>
                                                </label>
                                                <a href="javascript:void(0);" title="@lang('admin/tooltip.edit_enquiry_description')"><i
                                                        class="ik ik-help-circle text-muted ml-1"></i></a>
                                                <textarea class="form-control" name="description" type="text"rows="9" id="description" value=""
                                                    placeholder="Enter Description" required>{{ @$websiteEnquiry->description }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h3>Customer Info</h3>
                            <button type="submit" class="btn btn-primary">Save & Update</button>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12 col-md-12">
                                    <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                                        <label for="name" class="control-label">{{ 'Full Name' }}<span
                                                class="text-red">*</span></label>
                                        <a href="javascript:void(0);" title="@lang('admin/tooltip.edit_enquiry_name')"><i
                                                class="ik ik-help-circle text-muted ml-1"></i></a>
                                        <input class="form-control" name="name" type="text" id="name"
                                            value="{{ @$websiteEnquiry->name }}" placeholder="Enter Your Name" required>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-12">
                                    <div class="form-group {{ $errors->has('phone') ? 'has-error' : '' }}">
                                        <label for="phone" class="control-label">{{ 'Phone' }}</label>
                                        <a href="javascript:void(0);" title="@lang('admin/tooltip.edit_enquiry_phone')"><i
                                                class="ik ik-help-circle text-muted ml-1"></i></a>
                                        <input class="form-control" name="phone" pattern="^[0-9]*$" min="0"
                                            type="number" id="phone" value="{{ @$websiteEnquiry->phone }}"
                                            placeholder="Enter Your Phone">
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-12">
                                    <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                                        <label for="email" class="control-label">{{ 'Email' }}</label>
                                        <a href="javascript:void(0);" title="@lang('admin/tooltip.edit_enquiry_email')"><i
                                                class="ik ik-help-circle text-muted ml-1"></i></a>
                                        <input class="form-control" name="email" type="text" id="email"
                                            value="{{ @$websiteEnquiry->email }}" placeholder="Enter Your Email">
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
        {{-- START CKEDITOR INIT --}}
        <script src="https://cdn.ckeditor.com/ckeditor5/34.2.0/classic/ckeditor.js"></script>
        <script>
            let editor;
            $(window).on('load', function() {
                $('#remarkType').on('change', function() {
                    var type = $(this).val();
                    if (type == 2) {
                        $('#txt_area').addClass('ck-editor');
                        ClassicEditor
                            .create(document.querySelector('.ck-editor'), {
                                ckfinder: {
                                    uploadUrl: "{{ route('admin.media.ckeditor.upload') . '?_token=' . csrf_token() }}",
                                }
                            })
                            .then(newEditor => {
                                editor = newEditor;
                            })
                            .catch(error => {

                            });
                    } else {
                        $('#content-holder').html('');
                        $('#content-holder').html(
                            ' <textarea  class="form-control"rows="10" name="description" id="txt_area" placeholder="Enter Description"></textarea>'
                            );
                    }
                });
            });
        </script>
        {{-- END CKEDITOR INIT --}}

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
                var redirectUrl = "{{ url('admin/website-enquiries') }}";
                if (typeof(response) != "undefined" && response !== null && response.status == "success") {
                    window.location.href = redirectUrl;
                }
            })
        </script>
        {{-- END AJAX FORM INIT --}}
    @endpush
@endsection
