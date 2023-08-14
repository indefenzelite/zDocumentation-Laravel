@extends('layouts.main')
@section('title', 'Item')
@section('content')
@php
/**
* Item
*
* @category zStarter
*
* @ref zCURD
* @author Defenzelite <hq@defenzelite.com>
    * @license https://www.defenzelite.com Defenzelite Private Limited
    * @version <zStarter: 1.1.0>
        * @link https://www.defenzelite.com
        */
        $breadcrumb_arr = [
        ['name'=>'Edit Item', 'url'=> "javascript:void(0);", 'class' => '']
        ]
        @endphp
        <!-- push external head elements to head -->
        @push('head')
        <link rel="stylesheet" href="{{ asset('admin/plugins/mohithg-switchery/dist/switchery.min.css') }}">
        <!-- themekit admin template asstes -->
        
        <style>
            .error {
                color: red;
            }
            .bootstrap-tagsinput{
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
                                <h5>Edit Item</h5>
                                <span>Update a record for Item</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        @include('admin.include.breadcrumb')
                    </div>
                </div>
            </div>
            <div class="row">
                <form class="row ajaxForm"action="{{ route('admin.items.update',$item->id) }}" method="post"
                    enctype="multipart/form-data" id="ItemForm">
                    @csrf
                    <div class="col-md-12">
                        <!-- start message area-->
                        @include('admin.include.message')
                        <!-- end message area-->
                    </div>
                    <div class="col-md-7">
                        <div class="card">
                            <div class="card-header">
                                <h3>Item Details</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                                            <label for="name" class="control-label">Name<span class="text-danger">*</span></label>
                                            <a href="javascript:void(0);" title="@lang('admin/tooltip.edit_item_name')"><i class="ik ik-help-circle text-muted ml-1"></i></a>
                                            <input required class="form-control" name="name" pattern="[a-zA-Z]+.*" title="Please enter first letter alphabet and at least one alphabet character is required." title="Please enter first letter alphabet and at least one alphabet character is required." type="text"maxlength="100" id="name" value="{{$item->name}}" placeholder="Enter Name" >
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group {{ $errors->has('slug') ? 'has-error' : ''}}">
                                            <label for="slug" class="control-label">Slug<span class="text-danger">*</span></label>
                                             <a href="javascript:void(0);" title="@lang('admin/tooltip.edit_item_slug')"><i class="ik ik-help-circle text-muted ml-1"></i></a>
                                            {{-- <div class="input-group d-block d-md-flex">
                                                <input type="hidden" class="form-control w-100 w-md-auto" id="slugInput" value="{{$item->slug}}" oninput="slugFunction()" placeholder="{{ ('Slug') }}" name="slug" >
                                                <div class="input-group-prepend"><span class="input-group-text flex-grow-1" style="overflow: auto" id="slugOutput">{{ url('item/').'/'.@$item->slug }}</span><span id="slugOutput"></span></div>
                                            </div> --}}
                                            <input class="form-control w-100 w-md-auto" name="slug" pattern="[a-zA-Z]+.*" title="Please enter first letter alphabet and at least one alphabet character is required." title="Please enter first letter alphabet and at least one alphabet character is required." type="text" id="title" value="{{ @$item->slug }}" placeholder="Enter Slug">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="short_description" class="control-label">Short Description </label>
                                     <a href="javascript:void(0);" title="@lang('admin/tooltip.edit_item_short_description')"><i class="ik ik-help-circle text-muted ml-1"></i></a>
                                    <textarea  class="form-control" name="short_description" id="short_description" placeholder="Enter Short Description">{{$item->short_description }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="description" class="control-label">Description </label>
                                    <div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
                                        <div id="content-holder">
                                            <div id="toolbar-container"></div>
                                            <div id="txt_area">
                                                {!! @$item->description !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group {{ $errors->has('sku') ? 'has-error' : ''}}">
                                    <label for="sku" class="control-label">SKU</label>
                                     <a href="javascript:void(0);" title="@lang('admin/tooltip.edit_item_sku')"><i class="ik ik-help-circle text-muted ml-1"></i></a>
                                    <input class="form-control" name="sku" pattern="[a-zA-Z]+.*" title="Please enter first letter alphabet and at least one alphabet character is required." title="Please enter first letter alphabet and at least one alphabet character is required." type="text" id="sku"
                                    value="{{$item->sku }}">
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h3>Meta Config</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="description" class="control-label">Meta Title</label>
                                             <a href="javascript:void(0);" title="@lang('admin/tooltip.edit_item_meta_title')"><i class="ik ik-help-circle text-muted ml-1"></i></a>
                                            <input  class="form-control" name="meta[meta_title]" id="meta_title" placeholder="Enter Meta Title" value="{{ $item->meta['meta_title'] }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="form-group">
                                                <label for="description" class="control-label">Meta Keyword</label>
                                                 <a href="javascript:void(0);" title="@lang('admin/tooltip.edit_item_meta_keyword')"><i class="ik ik-help-circle text-muted ml-1"></i></a>
                                                <input  class="form-control" name="meta[meta_keyword]" id="tags" placeholder="Enter Meta Keyword" value="{{ $item->meta['meta_keyword'] }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="description" class="control-label">Meta Description</label>
                                     <a href="javascript:void(0);" title="@lang('admin/tooltip.edit_item_meta_description')"><i class="ik ik-help-circle text-muted ml-1"></i></a>
                                    <textarea  class="form-control" name="meta[meta_description]" id="meta_description" placeholder="Enter Meta description">{{ $item->meta['meta_description'] }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="card">
                            <div class="card-header justify-content-between">
                                <h3>Organise Item</h3>
                                <button type="submit" class="btn btn-primary">Save & Update</button>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="category_id">Category <span class="text-danger">*</span></label>
                                     <a href="javascript:void(0);" title="@lang('admin/tooltip.edit_item_category')"><i class="ik ik-help-circle text-muted ml-1"></i></a>
                                    <select required   name="category_id" id="category_id" class="form-control select2">
                                        <option value="" readonly>Select Category </option>
                                        @foreach($item_categories  as $category)
                                        <option value="{{ $category->id }}"{{ $item->category_id == $category->id ? 'selected' : ''}}>{{  $category->name ?? ''}}</option> 
                                    @endforeach
                                    </select>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 pr-1">
                                        <div class="form-group {{ $errors->has('sell_price') ? 'has-error' : ''}}">
                                            <label for="sell_price" class="control-label">Sell Price<span class="text-danger">*</span></label>
                                            <a href="javascript:void(0);" title="@lang('admin/tooltip.edit_item_sell_price')"><i class="ik ik-help-circle text-muted ml-1"></i></a>
                                            <input required  class="form-control" name="sell_price" type="number" step="any" id="sell_price" min="0"maxlength="9" value="{{$item->sell_price}}" placeholder=" Sell Price">
                                        </div>
                                    </div>
                                    <div class="col-md-6 px-1">
                                        <div class="form-group {{ $errors->has('mrp_price') ? 'has-error' : ''}}">
                                            <label for="mrp_price" class="control-label">MRP Price<span class="text-danger">*</span></label>
                                            <a href="javascript:void(0);" title="@lang('admin/tooltip.edit_item_mrp_price')"><i class="ik ik-help-circle text-muted ml-1"></i></a>
                                            <input required min="0"maxlength="9" class="form-control" name="mrp_price" type="number"step="any" id="mrp_price" value="{{$item->mrp_price}}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group {{ $errors->has('by_price') ? 'has-error' : ''}}">
                                            <label for="mrp_price" class="control-label">By Price<span class="text-danger">*</span></label>
                                            <a href="javascript:void(0);" title="@lang('admin/tooltip.add_item_by_price')"><i class="ik ik-help-circle text-muted ml-1"></i></a>
                                            <input required  class="form-control" name="by_price" type="number" step="any" id="by_price" min="0" maxlength="9" value="{{$item->by_price}}" placeholder="By Price">
    
                                        </div>
                                    </div>
                                    <div class="col-md-6 pl-1">
                                        <div class="form-group {{ $errors->has('tax_percent') ? 'has-error' : ''}}">
                                            <label for="tax_percent" class="control-label">Tax Percent</label>
                                            <a href="javascript:void(0);" title="@lang('admin/tooltip.edit_item_tax_percent')"><i class="ik ik-help-circle text-muted ml-1"></i></a>
                                            <input  class="form-control" name="tax_percent" min="0" max="100" type="number" id="tax_percent" value="{{$item->tax_percent }}" placeholder="Tax Percent">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group {{ $errors->has('identifier') ? 'has-error' : ''}}">
                                            <label for="tax_percent" class="control-label">HSN/SAC Code</label>
                                            {!! getHelp('Publicly readable name') !!}
                                            <input  class="form-control" name="identifier" type="number" id="identifier" value="{{$item->identifier }}" min="0" placeholder="Enter HSN/SAC Code" >
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h3>Quick Options</h3>
                            </div>
                            <div class="card-body">
                                <div class="row justify-content-center">
                                    <div class="col-md-4 col-12">
                                        <div class="form-group {{ $errors->has('is_featured') ? 'has-error' : ''}}">
                                            <label for="is_featured" class="control-label">
                                                <input class="js-switch switch-input" @if($item->is_featured == 1) checked @endif
                                                    name="is_featured" type="checkbox" id="is_featured" value="1"> 
                                                Featured</label>
                                        </div>
                                    </div>
    
                                    <div class="col-md-4 col-12">
                                        <div class="form-group {{ $errors->has('status') ? 'has-error' : ''}}">
                                            <label for="status" class="control-label">
                                                <input class="js-switch switch-input"name="status" type="checkbox" id="status" value="1"@if($item->status == 'Available') checked @endif> Available
                                            </label>
                                        </div>
                                    </div>
    
                                    <div class="col-md-4 col-12">
                                        <div class="form-group {{ $errors->has('is_published') ? 'has-error' : ''}}">
                                            <label for="is_published" class="control-label">
                                            <input required class="js-switch switch-input" @if($item->is_published == 1)checked @endif name="is_published" type="checkbox" id="is_published"value="1"> Publish</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h3>Item Images</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group {{ $errors->has('item_image') ? 'has-error' : ''}}">
                                    <label for="item_image" class="control-label">Banner Image</label>
                                    <a href="javascript:void(0);" title="@lang('admin/tooltip.edit_item_banner')"><i class="ik ik-help-circle text-muted ml-1"></i></a>
                                    <div class="input-images" data-input-name="item_image" data-label="Drag & Drop product images here or click to browse"></div>
                                    <small class="text-danger">Recommended Image in Dimension 458*458</small>
                                    {{-- <input accept=".png, .jpg, .jpeg" class="form-control" name="item_image"
                                        type="file" id="item_image" value="{{old('item_image')}}"> --}}
                                    @if($item->getMedia('item_image')->count() > 0)
                                    <img id="item_image_img" src="{{ $item->getFirstMediaUrl('item_image') }}"class="mt-3" style="border-radius: 10px;width:100px;height:80px;"/>
                                    <br>
                                    <a href="{{ route('admin.items.destroy-media',$item->id).'?media=item_image' }}" class="btn btn-sm mt-2 btn-danger">
                                        <i class="fa fa-trash"></i> Remove
                                    </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        
        <div class="modal fade" id="addCategoryModal" data-bs-backdrop="static" data-bs-keyboard="false" 
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Add New Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" id="category-form">
                    <div class="modal-body">
                        <input type="hidden" name="category_type_code" value="ItemCategories">
                        <input type="hidden" name="category_type_id" value="6">
                        <input type="hidden" name="level" value="1">
                        <div class="row">
                            <div class="col-md-12 mt-2">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text"  pattern="[a-zA-Z]+.*" title="Please enter first letter alphabet and at least one alphabet character is required." title="Please enter first letter alphabet and at least one alphabet character is required." name="name" class="form-control" placeholder="Name" value="">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mt-2">
                                <div class="form-group">
                                    <label>Icon</label>
                                    <input type="file" name="icon" class="form-control" placeholder="Name" value="">
                                </div>
                            </div>
                        </div>
                        <div class="ajax-message mb-2"></div>
                    </div>
                    <div class="modal-footer">
                        <button  type="submit" class="btn btn-primary btn-sm float-end">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
        <!-- push external js -->
        @push('script')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.js"></script>
        <script src="{{ asset('admin/plugins/mohithg-switchery/dist/switchery.min.js') }}"></script>
        
{{-- START DECOUPLEDEDITOR INIT --}}
    <script src="https://cdn.ckeditor.com/ckeditor5/37.1.0/decoupled-document/ckeditor.js"></script>
    <script>
        let editor;
        $(window).on('load', function (){
            $('#txt_area').addClass('ck-editor');
            DecoupledEditor
            .create( document.querySelector('.ck-editor'),{
                ckfinder: {
                    uploadUrl: "{{route('admin.media.ckeditor.upload').'?_token='.csrf_token()}}",
                }
            })
            .then( newEditor => {
                editor = newEditor;
                const toolbarContainer = document.querySelector( '#toolbar-container' );
    
                toolbarContainer.appendChild( editor.ui.view.toolbar.element );
            } )
            .catch( error => {
                console.error( error );
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
        <script src="{{ asset('admin/js/ajaxForm.js') }}"></script> 
        <script>
            // STORE DATA USING AJAX
            $('.ajaxForm').on('submit',function(e){
                e.preventDefault();
                var route = $(this).attr('action');
                var method = $(this).attr('method');
                var data = new FormData(this);
                const description = editor.getData();
                data.append('description',description);
                var response = postData(method,route,'json',data,null,null);
                var redirectUrl = "{{url('admin/items')}}";
                if(typeof(response) != "undefined" && response !== null && response.status == "success"){
                    window.location.href = redirectUrl;
                }
            })
        </script>
        {{-- END AJAX FORM INIT --}}

        {{-- START JS HELPERS INIT --}}
        <script>
            var flg = 0;
            var ajaxMessage = '.ajax-message';
            $('#category_id').on("select2:open", function () {
                flg++;
                if (flg == 1) 
                    $(".select2-results").append(`<div class='select2-results__option'> <a href="#" id="addCategory" class="font-weight-300" data-target="#addCategoryModal" data-toggle="modal">+ Add New Category</a> </div>`);
            });
            $("#category-form").validate({
                rules: {
                    name: {
                        required: true,
                    },
                },
                messages: {
                    name: "Please enter name",
                },
                submitHandler: function(form) {
                    $(this).find('[type=submit]').attr('disabled', '');
                    let formdata = new FormData(form);
                    formdata.append("request_with", 'create');
                    $.ajax({
                        url: "{{ route('admin.categories.store') }}",
                        type: 'POST',
                        data: formdata,
                        contentType: false,
                        processData: false,
                        beforeSend: function() {
                            $(ajaxMessage).html(
                                '<div class="alert alert-info"><i class="fa fa-refresh fa-spin"></i> Please wait... </div>'
                            );
                        },
                        success: function(res) {
                            $(form)[0].reset();
                            $('#addCategoryModal').modal('hide');
                            $(ajaxMessage).html('<div class="alert alert-success">' + res.message +
                                '</div>');
                                if(res.data)
                                $('#category_id').append('<option value="'+res.data.id+'">'+res.data.name+'</option>');
                                $('#category_id').select2();
                                flg=0;
                        },
                        complete: function() {
                            $(this).find('[type=submit]').removeAttr('disabled');
                            setTimeout(function() {
                                $(ajaxMessage).html('');
                            }, 2000);
                        },
                        error: function(data) {
                            var response = JSON.parse(data.responseText);
                            if (data.status === 422) {
                                var errorString = '<ul class="ps-3 m-0">';
                                $.each(response.errors, function(key, value) {
                                    errorString += '<li>' + value + '</li>';
                                });
                                errorString += '</ul>';
                                response = errorString;
                            } else {
                                response = response.error;
                            }

                            $(ajaxMessage).html('<div class="alert alert-danger">' + response +
                                '</div>');
                        }
                    });
                    
                }
            });
            $('#ItemForm').validate();
                document.getElementById('item_image').onchange = function () {
                var src = URL.createObjectURL(this.files[0])
                $('#item_image').removeClass('d-none');
                document.getElementById('item_image_img').src = src
            }

            function slugFunction() {
                    var x = document.getElementById("slugInput").value;
                    document.getElementById("slugOutput").innerHTML = "{{ url('/item/') }}/" + x;
                }
             function convertToSlug(Text)
             {
                 return Text
                     .toLowerCase()
                     .replace(/ /g,'-')
                     .replace(/[^\w-]+/g,'')
                     ;
             }
         
            $('#name').on('keyup', function (){
                $('#slugInput').val(convertToSlug($('#name').val()));
                slugFunction();
            });  
        </script>
        {{-- END JS HELPERS INIT --}}
        @endpush
        @endsection