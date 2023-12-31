@extends('layouts.main')
@section('title', $label)
@section('content')
    @php
        $breadcrumb_arr = [['name' => 'Edit' . ' ' . $label, 'url' => 'javascript:void(0);', 'class' => '']];
    @endphp
    <!-- push external head elements to head -->
    @push('head')
        <link rel="stylesheet" href="{{ asset('admin/plugins/mohithg-switchery/dist/switchery.min.css') }}">
    @endpush

    <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-grid bg-blue"></i>
                        <div class="d-inline">
                            <h5>Edit {{ $label }}</h5>
                            <span>Update a record for {{ $label }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    @include('admin.include.breadcrumb')
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 mx-auto">
                <!-- start message area-->
                @include('admin.include.message')
                <!-- end message area-->
                <div class="card ">
                    <div class="card-header d-flex justify-content-between">
                        <h3>Update {{ $label }}</h3>
                        <button type="submit" class="btn btn-primary">Save & Update</button>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.faqs.update', $faq->id) }}" method="post"
                            enctype="multipart/form-data"class="ajaxForm">
                            @csrf
                            <input type="hidden" name="request_with" value="update">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group {{ $errors->has('category_id') ? 'has-error' : '' }}">
                                        <label for="category_id">{{ __('Category') }} <span class="text-danger">*</span>
                                        </label>
                                        <a href="javascript:void(0);" title="@lang('admin/tooltip.edit_faq_category')"><i
                                                class="ik ik-help-circle text-muted ml-1"></i></a>
                                        <select required name="category_id" id="category_id" class="form-control select2">
                                            <option value="" readonly>{{ __('Select Category') }}</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}"
                                                    {{ $faq->category_id == $category->id ? 'Selected' : '' }}>
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group {{ $errors->has('sub_category_id') ? 'has-error' : '' }}">
                                        <label for="sub_category_id">{{ __('Sub Category') }} </label>
                                        <a href="javascript:void(0);" title="@lang('admin/tooltip.edit_faq_category')"><i
                                                class="ik ik-help-circle text-muted ml-1"></i></a>
                                        <select name="sub_category_id" id="sub_category_id" class="form-control select2">
                                        </select>
                                    </div>
                                </div>
                                {{-- <div class="col-md-6">   
                                    <div class="form-group ">
                                        <div class="form-group {{ $errors->has('sub_sub_category_id') ? 'has-error' : ''}}">
                                            <label for="sub_sub_category_id">{{ __('Sub Sub Category')}} </label>
                                            <a href="javascript:void(0);" title="@lang('admin/tooltip.add_faq_category')"><i class="ik ik-help-circle text-muted ml-1"></i></a>
                                            <select name="sub_sub_category_id" id="admin/faqs" class="form-control select2">
                                            </select>
                                        </div>
                                    </div>
                                </div> --}}
                                <div class="col-md-12">
                                    <div class="form-group ">
                                        <label for="title" class="control-label">Question<span
                                                class="text-danger">*</span></label>
                                        <a href="javascript:void(0);" title="@lang('admin/tooltip.edit_faq_title')"><i
                                                class="ik ik-help-circle text-muted ml-1"></i></a>
                                        <input required class="form-control" name="title" type="text"
                                            pattern="[a-zA-Z]+.*"
                                            title="Please enter first letter alphabet and at least one alphabet character is required."
                                            id="name" value="{{ $faq->title }}">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group ">
                                        <label for="description" class="control-label">Answer<span
                                                class="text-danger">*</span></label>
                                        <div id="content-holder">

                                            <div id="toolbar-container"></div>
                                            <div id="txt_area">
                                                {!! @$faq->description !!}
                                            </div>
                                            {{-- <textarea  class="form-control" name="value" placeholder="Value"></textarea> --}}
                                        </div>
                                        {{-- <textarea class="form-control ck-editor" rows="5" name="description" type="textarea" id="name" placeholder="Enter remark here..." >{{$faq->description }}</textarea> --}}
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="form-group d-flex {{ $errors->has('is_publish') ? 'has-error' : '' }}">
                                        <label for="is_publish" class="control-label mr-1">Publish
                                            <input @if ($faq->is_publish == 1) checked @endif name="is_publish"
                                                type="checkbox" id="is_publish" class="js-switch switch-input mb-1"
                                                value="1"></label>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- push external js -->
    @push('script')
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


        {{-- START AJAX FORM INIT --}}
        <script src="{{ asset('admin/js/ajaxForm.js') }}"></script>
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
                var redirectUrl = "{{ url('admin/faqs') }}";
                if (typeof(response) != "undefined" && response !== null && response.status == "success") {
                    window.location.href = redirectUrl;
                }
            });
            $(document).on('change','#category_id',function(){
                let category_id = $(this).val();
                let route = "{{route('admin.faqs.get.sub-categories')}}";
                let method = 'GET';
                let data = {category_id:category_id};
                let response = getData(method,route,'json',data,'subCategoryCallback',null,0); 
            })
            function subCategoryCallback(response){
                if(typeof(response) != "undefined" && response !== null && response.status == "success"){
                    $('#sub_category_id').html(response.html);
                }
                $('#sub_category_id').change();
            }
            
            $(document).on('change','#sub_category_id',function(){
                let sub_category_id = $(this).val();
                let route = "{{route('admin.faqs.get.sub-sub-categories')}}";
                let method = 'GET';
                let data = {sub_category_id:sub_category_id};
                let res = getData(method,route,'json',data,'subSubCategoryCallback',null,0); 
            })
            function subSubCategoryCallback(res){
                if(typeof(res) != "undefined" && res !== null && res.status == "success"){
                    $('#sub_sub_category_id').html(res.html);
                }
                $('#sub_sub_category_id').change();
            }
            var category_id = "{{$faq->category_id}}";
            var sub_category_id = "{{$faq->sub_category_id}}";
            var sub_sub_category_id = "{{$faq->sub_sub_category_id}}";
            $('#category_id').val(category_id).change();
            setTimeout(() => {
                $('#sub_category_id').val(sub_category_id).change();
                setTimeout(() => {
                    $('#sub_sub_category_id').val(sub_sub_category_id).change();
                }, 1000);
            }, 500);
        </script>
        {{-- END AJAX FORM INIT --}}
    @endpush
@endsection
