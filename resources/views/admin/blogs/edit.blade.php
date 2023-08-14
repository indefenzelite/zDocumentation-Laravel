@extends('layouts.main')
@section('title', $label)
@section('content')
    @php
        $breadcrumb_arr = [['name' => 'Edit' . $label, 'url' => 'javascript:void(0);', 'class' => '']];
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
        <form action="{{ route('admin.blogs.update', $blog->id) }}" method="post" enctype="multipart/form-data"
            class="ajaxForm">
            @csrf
            <div class="row">
                <!-- start message area-->
                <!-- end message area-->
                <div class="col-md-7">
                    <div class="card">
                        <div class="card-header">
                            <h3>{{ __(' Update ') }} {{ $label }}</h3>
                        </div>
                        {{-- @dd($blog) --}}
                        <div class="card-body">
                            <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                            <input type="hidden" name="request_with" value="update">
                            <div class="row">
                                <div class="col-md-12 mx-auto">
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12">
                                            <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                                                <label for="title" class="control-label">{{ 'Title' }}<span
                                                        class="text-danger">*</span></label>
                                                <a href="javascript:void(0);" title="@lang('admin/tooltip.edit_blog_title')"><i
                                                        class="ik ik-help-circle text-muted ml-1"></i></a>
                                                <input class="form-control" name="title" type="text"
                                                    pattern="[a-zA-Z]+.*"
                                                    title="Please enter first letter alphabet and at least one alphabet character is required."
                                                    id="title" value="{{ @$blog->title }}" placeholder="Enter Title"
                                                    required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 mb-3">
                                            <label for="name">{{ __('Slug') }} <span
                                                    class="text-red">*</span></label>
                                            <a href="javascript:void(0);" title="@lang('admin/tooltip.edit_blog_slug')"><i
                                                    class="ik ik-help-circle text-muted ml-1"></i></a>
                                            <input class="form-control w-100 w-md-auto" name="slug" type="text"
                                                pattern="[a-zA-Z]+.*"
                                                title="Please enter first letter alphabet and at least one alphabet character is required."
                                                id="title" value="{{ @$blog->slug }}" placeholder="Enter Slug">

                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <label for="name">{{ __('Short Description') }}<span
                                                    class="text-red">*</span></label>
                                            <a href="javascript:void(0);" title="@lang('admin/tooltip.edit_blog_short_description')"><i
                                                    class="ik ik-help-circle text-muted ml-1"></i></a>
                                            <textarea name="short_description" class="form-control" placeholder="Enter Short Description">{{ $blog->short_description }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h3>{{ __('Description') }} <span class="text-red">*</span></h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                                        <div id="content-holder">

                                            <div id="toolbar-container"></div>
                                            <div id="txt_area">
                                                {!! @$blog->description !!}
                                            </div>
                                            {{-- <textarea  class="form-control" name="value" placeholder="Value"></textarea> --}}
                                        </div>
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
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="description_banner">{{ __('Banner') }}<span
                                                class="text-danger">*</span></label>
                                        <a href="javascript:void(0);" title="@lang('admin/tooltip.edit_blog_banner')"><i
                                                class="ik ik-help-circle text-muted ml-1"></i></a>
                                        <div class="input-images" data-input-name="description_banner"
                                            data-label="Drag & Drop product images here or click to browse"></div><small
                                            class="text-danger">Recommended Image in Dimension 1200*700</small>
                                        {{-- <input accept="image/png, image/gif, image/jpeg" type="file" name="description_banner" class="form-control"> --}}
                                    </div>
                                    <div class="d-flex flex-wrap">
                                        @if ($blog->getMedia('description_banner')->count() > 0)
                                            @foreach ($blog->getMedia('description_banner') as $media)
                                                <div class=" ">
                                                    <img id="description_banner_img"
                                                        src="{{ $media->getUrl() }}"class="mt-3"
                                                        style="border-radius: 10px;width:100px;height:80px;" />
                                                    <br>
                                                    <a href="{{ route('admin.blogs.destroy-media', $blog->id) . '?media=description_banner&id=' . $media->id }}"
                                                        class="btn btn-sm mt-2 btn-danger">
                                                        <i class="fa fa-trash"></i> Remove
                                                    </a>
                                                </div>
                                            @endforeach
                                        @endif
                                        {{-- @if ($blog->getFirstMediaUrl('description_banner') != null)
                                            <img id="blog_image_img" src="{{ $blog->getFirstMediaUrl('description_banner') }}" class="" style="border-radius: 10px; width: 100px; height: 80px;"/>
                                            <a href="{{ route('admin.blogs.destroy-media',$blog->id).'?media=description_banner' }}"style="position: absolute;" class="btn btn-danger "><i class="fa fa-trash"></i></a>
                                        @endif     --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h3>Blog Category</h3>
                            <button type="submit" class="btn btn-primary float-right">Save & Update</button>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group {{ $errors->has('category_id') ? 'has-error' : '' }}">
                                        <label for="category_id">{{ __('Category') }}<span
                                                class="text-danger">*</span></label>
                                        <a href="javascript:void(0);" title="@lang('admin/tooltip.edit_blog_category')"><i
                                                class="ik ik-help-circle text-muted ml-1"></i></a>
                                        <select required name="category_id" id="category_id"
                                            class="form-control select2">
                                            <option value="" readonly required>{{ __('Select Category') }}</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}"
                                                    {{ $blog->category_id == $category['id'] ? 'selected' : '' }}>
                                                    {{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group {{ $errors->has('is_publish') ? 'has-error' : '' }}">
                                        <label for="is_publish" class="control-label">Publish
                                            <input @if ($blog->is_publish == 1) checked @endif name="is_publish"
                                                type="checkbox" id="is_publish" class="js-switch switch-input"
                                                value="1"></label>
                                    </div>
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
                                <div class="col-sm-6">
                                    <div class="form-group {{ $errors->has('seo_title') ? 'has-error' : '' }}">
                                        <label for="seo_title" class="control-label">{{ 'Meta Title' }}</label>
                                        <a href="javascript:void(0);" title="@lang('admin/tooltip.edit_blog_meta_title')"><i
                                                class="ik ik-help-circle text-muted ml-1"></i></a>
                                        <input class="form-control" name="seo_title" type="text"
                                            pattern="[a-zA-Z]+.*"
                                            title="Please enter first letter alphabet and at least one alphabet character is required."
                                            id="seo_title" value="{{ @$blog->meta['title'] }}"
                                            placeholder="Enter Meta Title">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group {{ $errors->has('seo_keywords') ? 'has-error' : '' }}">
                                        <label for="seo_keywords">{{ __('Meta Keywords') }}</label>
                                        <a href="javascript:void(0);" title="@lang('admin/tooltip.edit_blog_meta_keywords')"><i
                                                class="ik ik-help-circle text-muted ml-1"></i></a>
                                        <input type="text" pattern="[a-zA-Z]+.*"
                                            title="Please enter first letter alphabet and at least one alphabet character is required."
                                            id="tags" placeholder="Enter Meta Keywords" name="seo_keywords"
                                            class="form-control" value="{{ $blog->meta['keyword'] ?? '' }}">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group {{ $errors->has('seo_description') ? 'has-error' : '' }}">
                                        <label for="seo_description">{{ __('Meta Description') }}</label>
                                        <a href="javascript:void(0);" title="@lang('admin/tooltip.edit_blog_meta_description')"><i
                                                class="ik ik-help-circle text-muted ml-1"></i></a>
                                        <textarea class="form-control" name="seo_description" type="text" pattern="[a-zA-Z]+.*"
                                            title="Please enter first letter alphabet and at least one alphabet character is required." id="seo_description"
                                            value="" placeholder="Enter Meta Description">{{ @$blog->meta['description'] }}</textarea>
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
                const description = editor.getData();
                data.append('description', description);
                var response = postData(method, route, 'json', data, null, null);
                var redirectUrl = "{{ url('admin/blogs') }}";
                if (typeof(response) != "undefined" && response !== null && response.status == "success") {
                    window.location.href = redirectUrl;
                }
            })
        </script>
        {{-- END AJAX FORM INIT --}}

        {{-- START JS HELPERS INIT --}}
        <script>
            function slugFunction() {
                var x = document.getElementById("slugInput").value;
                document.getElementById("slugOutput").innerHTML = "{{ url('/article/') }}/" + x;
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
        </script>
        {{-- END JS HELPERS INIT --}}
    @endpush

@endsection
