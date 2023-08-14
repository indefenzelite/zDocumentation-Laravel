@extends('layouts.main') 
@section('title', 'Item')
@section('content')
@php
/**
 * Item 
 *
 * @category ZStarter
 *
 * @ref zCURD
 * @author  Defenzelite <hq@defenzelite.com>
 * @license https://www.defenzelite.com Defenzelite Private Limited
 * @version <zStarter: 1.1.0>
 * @link    https://www.defenzelite.com
 */
$breadcrumb_arr = [
    ['name'=>'Add Item', 'url'=> "javascript:void(0);", 'class' => '']
]
@endphp
    <!-- push external head elements to head -->
    @push('head')
    <link rel="stylesheet" href="{{ asset('admin/plugins/mohithg-switchery/dist/switchery.min.css') }}">

    <style>
        .error{
            color:red;
        }
        .card{
            margin-bottom: 15px
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
                            <h5>Add Item</h5>
                            <span>Create a record for Item</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    @include('admin.include.breadcrumb')
                </div>
            </div>
        </div>
        <form class="row ajaxForm" action="{{ route('admin.items.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="request_with" value="create">
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
                                        <label for="name" class="control-label ">Name<span class="text-danger">*</span></label>
                                        <a href="javascript:void(0);" title="@lang('admin/tooltip.add_item_name')"><i class="ik ik-help-circle text-muted ml-1"></i></a>
                                        <input required class="form-control " name="name" type="text" pattern="[a-zA-Z]+.*" title="Please enter first letter alphabet and at least one alphabet character is required." title="Please enter first letter alphabet and at least one alphabet character is required." title="Please enter first letter alphabet and at least one alphabet character is required." id="name" value="{{old('name','')}}" placeholder="Enter Name" >

                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group {{ $errors->has('slug') ? 'has-error' : ''}}">

                                        <label for="slug" class="control-label">Slug<span class="text-danger">*</span></label>
                                          <a href="javascript:void(0);" title="@lang('admin/tooltip.add_item_slug')"><i class="ik ik-help-circle text-muted ml-1"></i></a>
                                        <div class="input-group d-block d-md-flex">
                                            <input type="hidden" class="form-control w-100 w-md-auto" id="slugInput" oninput="slugFunction()" placeholder="{{ ('Slug') }}" name="slug" >
                                            <div class="input-group-prepend"><span class="input-group-text flex-grow-1" style="overflow: auto" id="slugOutput">{{ url('item/') }}</span><span id="slugOutput"></span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="short_description" class="control-label">Short Description </label>
                                  <a href="javascript:void(0);" title="@lang('admin/tooltip.add_item_short_description')"><i class="ik ik-help-circle text-muted ml-1"></i></a>
                                <textarea class="form-control" name="short_description" id="short_description" placeholder="Enter Short Description">{{ old('short_description')}}</textarea>
                            </div>
                            <div class="form-group">
                                <div class="form-group">
                                    <label for="description" class="control-label">Description </label>
                                    <div id="content-holder">
                                        <div id="toolbar-container"></div>
                                        <div id="txt_area">
                                        </div>
                                    </div>

                                    {{-- <a href="javascript:void(0);" title="@lang('admin/tooltip.add_item_description')"><i class="ik ik-help-circle text-muted ml-1"></i></a>
                                    <textarea class="form-control ck-editor" name="description" id="description" value="" placeholder="Enter Description"></textarea> --}}
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('sku') ? 'has-error' : ''}}">
                                <label for="sku" class="control-label">SKU</label>
                                 <a href="javascript:void(0);" title="@lang('admin/tooltip.add_item_sku')"><i class="ik ik-help-circle text-muted ml-1"></i></a>
                                <input  class="form-control" name="sku" type="text" id="sku"  pattern="[a-zA-Z]+.*" title="Please enter first letter alphabet and at least one alphabet character is required." title="Please enter first letter alphabet and at least one alphabet character is required." title="Please enter first letter alphabet and at least one alphabet character is required." value="{{old('sku','')}}" placeholder="Enter SKU" >
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h3>Meta Config</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="description" class="control-label">Meta Title</label>
                                        <a href="javascript:void(0);" title="@lang('admin/tooltip.add_item_meta_title')"><i class="ik ik-help-circle text-muted ml-1"></i></a>
                                        <input  class="form-control" name="meta[meta_title]" id="meta_title" placeholder="Enter Meta Title" value="{{ old('meta_title') }}">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label for="description" class="control-label">Meta Keyword</label>
                                            <a href="javascript:void(0);" title="@lang('admin/tooltip.add_item_meta_keyword')"><i class="ik ik-help-circle text-muted ml-1"></i></a>
                                            <input  class="form-control" name="meta[meta_keyword]" id="tags" placeholder="Enter Meta Keyword" value="{{ old('meta_keyword') }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="description" class="control-label">Meta Description</label>
                                <a href="javascript:void(0);" title="@lang('admin/tooltip.add_item_meta_description')"><i class="ik ik-help-circle text-muted ml-1"></i></a>
                                <textarea  class="form-control" name="meta[meta_description]" id="meta_description" placeholder="Enter Meta description">{{ old('meta_description')}}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <div>
                                <h3>Organise Item</h3>
                            </div>
                            <button id="submit" type="submit" class="btn btn-primary">Create</button>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="category_id">Category <span class="text-danger">*</span></label>
                                  <a href="javascript:void(0);" title="@lang('admin/tooltip.add_item_category')"><i class="ik ik-help-circle text-muted ml-1"></i></a>
                                <select required   name="category_id" id="category_id" data-flag="0" class="form-control select2 category_id">
                                    <option value="" readonly>Select Category </option>
                                    @foreach($item_categories  as $category)
                                        <option value="{{ $category->id }}" {{  old('category_id') == $category->id ? 'Selected' : '' }}>{{  $category->name ?? ''}}</option> 
                                    @endforeach
                                </select>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group {{ $errors->has('sell_price') ? 'has-error' : ''}}">
                                        <label for="sell_price" class="control-label">Sell Price<span class="text-danger">*</span></label>
                                        <a href="javascript:void(0);" title="@lang('admin/tooltip.add_item_sell_price')"><i class="ik ik-help-circle text-muted ml-1"></i></a>
                                        <input required  class="form-control" name="sell_price" type="number" step="any" min="0" maxlength="9"  id="sell_price" value="{{old('sell_price')}}" placeholder=" Sell Price">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group {{ $errors->has('mrp_price') ? 'has-error' : ''}}">
                                        <label for="mrp_price" class="control-label">MRP Price<span class="text-danger">*</span></label>
                                        <a href="javascript:void(0);" title="@lang('admin/tooltip.add_item_mrp_price')"><i class="ik ik-help-circle text-muted ml-1"></i></a>
                                        <input required  class="form-control" name="mrp_price" type="number" step="any" id="mrp_price"min="0" maxlength="9"value="0" placeholder="MRP Price">

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group {{ $errors->has('by_price') ? 'has-error' : ''}}">
                                        <label for="mrp_price" class="control-label">By Price<span class="text-danger">*</span></label>
                                        <a href="javascript:void(0);" title="@lang('admin/tooltip.add_item_by_price')"><i class="ik ik-help-circle text-muted ml-1"></i></a>
                                        <input required  class="form-control" name="by_price" type="number" step="any" id="by_price" min="0" maxlength="9" value="0" placeholder="By Price">

                                    </div>
                                </div>
                                <div class="col-md-6 pl-1">
                                    <div class="form-group {{ $errors->has('tax_percent') ? 'has-error' : ''}}">
                                        <label for="tax_percent" class="control-label">Tax Percent</label>
                                        <a href="javascript:void(0);" title="@lang('admin/tooltip.add_item_tax_percent')"><i class="ik ik-help-circle text-muted ml-1"></i></a>
                                        <input  class="form-control" name="tax_percent" type="number" id="tax_percent" min="0" max="100" value="18" placeholder=" Tax Percent" >
                                    </div>
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('identifier') ? 'has-error' : ''}}">
                                <label for="tax_percent" class="control-label">HSN/SAC Code</label>
                                  {!! getHelp('Publicly readable name') !!}
                                  <input  class="form-control" name="identifier" type="number" min="0" id="identifier" value="{{old('identifier','')}}" placeholder="Enter HSN/SAC Code" >
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
                                            <input class="js-switch switch-input" @if(old('is_featured')) checked @endif
                                                name="is_featured" type="checkbox" id="is_featured" value="1"> 
                                            Featured</label>
                                    </div>
                                </div>
                              
                                <div class="col-md-4 col-12">
                                    <div class="form-group {{ $errors->has('status') ? 'has-error' : ''}}">
                                        <label for="status" class="control-label">
                                            <input class="js-switch switch-input" @if(old('status')) checked @endif name="status"type="checkbox" id="status" value="Available"> Available
                                        </label>
                                    </div>
                                </div>

                                <div class="col-md-4 col-12">
                                    <div class="form-group {{ $errors->has('is_published') ? 'has-error' : ''}}">
                                        <label for="is_published" class="control-label">
                                        <input required class="js-switch switch-input" @if(old('is_published'))checked @endif name="is_published" type="checkbox" id="is_published"value="1"checked> Publish</label>
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
                               
                                <a href="javascript:void(0);" title="@lang('admin/tooltip.add_item_banner')"><i class="ik ik-help-circle text-muted ml-1"></i></a>
                                <div class="input-images" data-input-name="item_image" data-label="Drag & Drop product images here or click to browse"></div>
                                <small class="text-danger">Recommended Image in Dimension 458*458</small>
                                {{-- <input class="form-control" name="item_image" type="file" id="item_image" value="{{old('item_image')}}" accept=".png, .jpg, .jpeg,.gif">
                                <img id="show-image" class="d-none mt-2" style="border-radius: 10px;width:100px;height:80px;"/> --}}
                            </div>
                        </div>
                    </div>
                </div>
        </form>
    </div>
    @include('admin.include.add-category',['level' =>1,'category_type_code' => 'ItemCategories'])
    <!-- push external js -->
    @push('script')
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
                } );

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
        });
    </script>
    {{-- END AJAX FORM INIT --}}

    {{-- START JS HELPERS INIT --}}
    <script>
        function slugFunction() {
            var x = document.getElementById("slugInput").value;
            document.getElementById("slugOutput").innerHTML = "{{ url('/product/') }}/" + x;
        }

        function convertToSlug(Text){
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
        $('#item_image').on('change',function(){
            var src = URL.createObjectURL(this.files[0])
            $('#show-image').removeClass('d-none');
            document.getElementById('show-image').src = src
        })
        
    </script>
    {{-- END JS HELPERS INIT --}}
    @endpush
@endsection
