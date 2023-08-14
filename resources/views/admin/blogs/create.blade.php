@extends('layouts.main')
@section('title', 'Add ' . $label)
@section('content')
    @php
        $breadcrumb_arr = [['name' => $label, 'url' => 'javascript:void(0);', 'class' => '']];
    @endphp
    <!-- push external head elements to head -->
    @push('head')
        <link rel="stylesheet" href="{{ asset('admin/plugins/mohithg-switchery/dist/switchery.min.css') }}">
        <!-- themekit admin template asstes -->
        <style>
            .bootstrap-tagsinput {
                width: 100%;
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
                            <h5>{{ __('Add ' . $label) }}</h5>
                            <span>{{ __('Add a new record for Blog') }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    @include('admin.include.breadcrumb')
                </div>
            </div>
        </div>
        <form action="{{ route('admin.blogs.store') }}" method="post" enctype="multipart/form-data" class="ajaxForm">
            @csrf
            <div class="row">
                <div class="col-md-7">
                    <div class="card">
                        <div class="card-header">
                            <h3>{{ __('Add ' . $label) }}</h3>
                        </div>
                        <div class="card-body p-3">
                            <input type="hidden" name="request_with" value="create">
                            <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                                        <label for="title" class="control-label">{{ 'Title' }} <span
                                                class="text-danger">*</span></label>
                                        <a href="javascript:void(0);" title="@lang('admin/tooltip.add_blog_title')"><i
                                                class="ik ik-help-circle text-muted ml-1"></i></a>
                                        <input class="form-control" name="title" type="text" pattern="[a-zA-Z]+.*"
                                            title="Please enter first letter alphabet and at least one alphabet character is required."
                                            pattern="[a-zA-Z]+.*"
                                            title="Please enter first letter alphabet and at least one alphabet character is required."
                                            pattern="[a-zA-Z]+.*"
                                            title="Please enter first letter alphabet and at least one alphabet character is required."
                                            pattern="[a-zA-Z]+.*"
                                            title="Please enter first letter alphabet and at least one alphabet character is required."
                                            id="title" value="" placeholder="Enter Title" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <label for="name">{{ __('Slug') }}<span class="text-red">*</span></label>
                                    <a href="javascript:void(0);" title="@lang('admin/tooltip.add_blog_slug')"><i
                                            class="ik ik-help-circle text-muted ml-1"></i></a>
                                    <div class="input-group d-block d-md-flex mb-0">
                                        <input type="hidden" class="form-control w-100 w-md-auto" id="slugInput"
                                            oninput="slugFunction()" placeholder="{{ 'Slug' }}" name="slug">
                                        <div class="input-group-prepend"><span class="input-group-text flex-grow-1"
                                                style="overflow: auto" id="slugOutput">{{ url('blog/') }}</span></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <label for="name">{{ __('Short Description') }}<span
                                            class="text-red">*</span></label>
                                    <a href="javascript:void(0);" title="@lang('admin/tooltip.add_blog_short_description')"><i
                                            class="ik ik-help-circle text-muted ml-1"></i></a>
                                    <textarea name="short_description" class="form-control" placeholder="Enter Short Description"></textarea>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h3>Contant</h3>
                        </div>
                        <div class="card-body">
                            <label for="description">{{ __('Description') }} <span class="text-red">*</span></label>
                            <div id="content-holder">

                                <div id="toolbar-container"></div>
                                <div id="txt_area">

                                </div>
                                {{-- <textarea  class="form-control" name="value" placeholder="Value"></textarea> --}}
                            </div>

                        </div>
                    </div>

                </div>
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h3>Blog Category </h3>
                            <button type="submit" class="btn btn-primary float-right">Create</button>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group {{ $errors->has('category_id') ? 'has-error' : '' }}">
                                        <label for="category_id">{{ __('Category') }} <span class="text-danger">*</span>
                                        </label>
                                        <a href="javascript:void(0);" title="@lang('admin/tooltip.add_blog_category')"><i
                                                class="ik ik-help-circle text-muted ml-1"></i></a>
                                        <select required name="category_id" id="category_id" class="form-control select2">
                                            @forelse ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @empty
                                            @endforelse
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group {{ $errors->has('is_publish') ? 'has-error' : '' }}">
                                        <label for="is_publish" class="control-label">Publish</label>
                                        <input checked name="is_publish" type="checkbox" id="is_publish"
                                            class="js-switch switch-input ml-8 mb-2" value="1">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h3>Banner Images</h3>
                        </div>
                        <div class="card-body">
                            <div class="col-sm-12 p-0">
                                <div class="form-group">
                                    <label for="description_banner">{{ __('Banner') }}<span
                                            class="text-danger">*</span></label>
                                    <a href="javascript:void(0);" title="@lang('admin/tooltip.add_blog_banner')"><i
                                            class="ik ik-help-circle text-muted ml-1"></i></a>
                                    <div class="input-images" data-input-name="description_banner" id="blog_image"
                                        data-label="Drag & Drop product images here or click to browse"></div> <small
                                        class="text-danger">Recommended Image in Dimension 1200*700</small>
                                    {{-- <input accept="image/png, image/gif, image/jpeg" type="file" name="description_banner" id="blog_image" class="form-control"> --}}
                                    <img id="show-image" class="d-none mt-2"
                                        style="object-fit:left; width: 320px; height: 120px" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h3>Meta Config</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group {{ $errors->has('seo_title') ? 'has-error' : '' }}">
                                        <label for="seo_title" class="control-label">{{ 'Meta Title' }}</label>
                                        <a href="javascript:void(0);" title="@lang('admin/tooltip.add_blog_meta_title')"><i
                                                class="ik ik-help-circle text-muted ml-1"></i></a>
                                        <input class="form-control" name="seo_title" type="text"
                                            pattern="[a-zA-Z]+.*"
                                            title="Please enter first letter alphabet and at least one alphabet character is required."
                                            id="seo_title" value="" placeholder="Enter Meta Title">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group {{ $errors->has('seo_keywords') ? 'has-error' : '' }}">
                                        <label for="seo_keywords">{{ __('Meta Keywords') }}</label>
                                        <a href="javascript:void(0);" title="@lang('admin/tooltip.add_blog_meta_keywords')"><i
                                                class="ik ik-help-circle text-muted ml-1"></i></a>
                                        <br>
                                        <input type="text" pattern="[a-zA-Z]+.*"
                                            title="Please enter first letter alphabet and at least one alphabet character is required."
                                            id="tags" name="seo_keywords" placeholder="Enter Meta Keywords"
                                            class="form-control" value="">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group {{ $errors->has('seo_description') ? 'has-error' : '' }}">
                                        <label for="seo_description">{{ __('Meta Description') }}</label>
                                        <a href="javascript:void(0);" title="@lang('admin/tooltip.add_blog_meta_description')"><i
                                                class="ik ik-help-circle text-muted ml-1"></i></a>
                                        <textarea class="form-control" name="seo_description" type="text" pattern="[a-zA-Z]+.*"
                                            title="Please enter first letter alphabet and at least one alphabet character is required." id="seo_description"
                                            value="" placeholder="Enter Meta Description"></textarea>
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
        <script src="{{ asset('admin/js/ajaxForm.js') }}"></script>
        <script src="{{ asset('admin/plugins/mohithg-switchery/dist/switchery.min.js') }}"></script>
        {{-- START DECOUPLEDEDITOR INIT --}}
        <script src="https://cdn.ckeditor.com/ckeditor5/37.1.0/decoupled-document/ckeditor.js"></script>
        <script>
            let editor;
            $(window).on('load', function() {
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

            });
        </script>

        {{-- END DECOUPLEDEDITOR INIT --}}


        {{-- START TAGINPUT INIT --}}
        <script src="{{ asset('admin/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js') }}"></script>
        <script>
            $('#tags').tagsinput('items');
            $('.input-images').imageUploader();
        </script>
        {{-- END TAGINPUT INIT --}}

        {{-- START AJAX FORM INIT --}}
        <script>
            // STORE DATA USING AJAX    
            $('.ajaxForm').on('submit', function(e) {
                e.preventDefault();
                var route = $(this).attr('action');
                var method = $(this).attr('method');
                var data = new FormData(this);
                if (editor != undefined) {
                    const description = editor.getData();
                    data.append('description', description);
                }
                var response = postData(method, route, 'json', data, null, null);
                var redirectUrl = "{{ url('admin/blogs') }}";
                if (typeof(response) != "undefined" && response !== null && response.status == "success") {
                    window.location.href = redirectUrl;
                }
            });
        </script>
        {{-- END AJAX FORM INIT --}}

        {{-- START JS HELPERS INIT --}}
        <script>
            function slugFunction() {
                var x = document.getElementById("slugInput").value;
                document.getElementById("slugOutput").innerHTML = "{{ url('/blog/') }}/" + x;
            }

            function convertToSlug(Text) {
                return Text
                    .toLowerCase()
                    .replace(/ /g, '-')
                    .replace(/[^\w-]+/g, '');
            }

            $('#title').on('keyup', function() {
                $('#slugInput').val(convertToSlug($('#title').val()));
                slugFunction();
            });

            document.getElementById('blog_image').onchange = function() {
                var src = URL.createObjectURL(this.files[0])
                $('#show-image').removeClass('d-none');
                document.getElementById('show-image').src = src
            }
        </script>
        {{-- END JS HELPERS INIT --}}
    @endpush
@endsection
