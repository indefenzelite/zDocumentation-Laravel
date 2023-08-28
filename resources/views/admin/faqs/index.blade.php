@extends('layouts.main') 
@section('title', $label)
@section('content')
    @php
    $breadcrumb_arr = [
        ['name'=>$label, 'url'=> "javascript:void(0);", 'class' => 'active']
    ]
    @endphp
    <!-- push external head elements to head -->
    @push('head')
    <link rel="stylesheet" href="{{ asset('admin/plugins/mohithg-switchery/dist/switchery.min.css') }}">
    <style>
        .select2 select2-container select2-container--default select2-container--focus{
            width: auto !important;
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
                            <h5>{{$label}}</h5>
                            <span>List of {{$label}}</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    @include("admin.include.breadcrumb")
                </div>
            </div>
        </div>
        <div class="row">
            {{-- @if(env('DEV_MODE') == 1) col-12 @else col-7 @endif --}}
            @if(auth()->user()->isAbleTo('add_faq'))
                <div class="col-md-12 add-faqs-form d-none">
                    <form action="{{ route('admin.faqs.store') }}" method="post" class="ajaxForm" enctype="multipart/form-data">
                        @csrf
                        <div class="card">
                            <div class="card-header  justify-content-between">
                                <h5>Add {{$label}}</h5>
                                <div class="d-flex" >
                                    <a href="javascript:void(0);" id="showFaqs" class="btn btn-light ml-2 mr-2">Show List</a>
                                    <button type="submit" class="btn btn-primary mr-2">Create</button>
                                </div>
                            </div>
                            
                            <div class="card-body">
                                <input type="hidden" name="request_with" value="create">
                                <input type="hidden" name="created_by" value="{{auth()->id()}}">
                                <div class="row">
                                    <div class="col-md-6">   
                                        <div class="form-group ">
                                            <div class="form-group {{ $errors->has('category_id') ? 'has-error' : ''}}">
                                                <label for="category_id">{{ __('Category')}} <span class="text-danger">*</span> </label>
                                                <a href="javascript:void(0);" title="@lang('admin/tooltip.add_faq_category')"><i class="ik ik-help-circle text-muted ml-1"></i></a>
                                                <select required name="category_id" id="category_id" class="form-control select2">
                                                    <option value="" readonly>{{ __('Select Category')}}</option>
                                                    @foreach ($categories as $category)
                                                        <option value="{{ $category->id }}">{{ $category->name }}</option> 
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">   
                                        <div class="form-group ">
                                            <div class="form-group {{ $errors->has('sub_category_id') ? 'has-error' : ''}}">
                                                <label for="sub_category_id">{{ __('Sub Category')}} </label>
                                                <a href="javascript:void(0);" title="@lang('admin/tooltip.add_faq_category')"><i class="ik ik-help-circle text-muted ml-1"></i></a>
                                                <select name="sub_category_id" id="sub_category_id" class="form-control select2">
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- <div class="col-md-4">   
                                        <div class="form-group ">
                                            <div class="form-group {{ $errors->has('sub_sub_category_id') ? 'has-error' : ''}}">
                                                <label for="sub_sub_category_id">{{ __('Sub Sub Category')}} </label>
                                                <a href="javascript:void(0);" title="@lang('admin/tooltip.add_faq_category')"><i class="ik ik-help-circle text-muted ml-1"></i></a>
                                                <select name="sub_sub_category_id" id="sub_sub_category_id" class="form-control select2">
                                                </select>
                                            </div>
                                        </div>
                                    </div> --}}
                                    <div class="col-md-12">                                         
                                        <div class="form-group">
                                            <label for="title" class="control-label">Question <span class="text-danger">*</span></label>
                                            <a href="javascript:void(0);" title="@lang('admin/tooltip.add_faq_question')"><i class="ik ik-help-circle text-muted ml-1"></i></a>
                                            <input required  placeholder="Enter Question" class="form-control" name="title" pattern="[a-zA-Z]+.*" title="Please enter first letter alphabet and at least one alphabet character is required." title="Please enter first letter alphabet and at least one alphabet character is required." title="Please enter first letter alphabet and at least one alphabet character is required." type="text" id="name" value="{{old('title')}}">
                                        </div>
                                    </div>
                                    <div class="col-md-12">                              
                                        <div class="form-group ">
                                            <label for="description" class="control-label">Answer<span class="text-danger">*</span></label>
                                            <div id="content-holder">
                                                    
                                                <div id="toolbar-container"></div>
                                                <div id="txt_area">
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>    
                                          
                                    <div class="col-md-6 text-left mb-2">
                                        <div class="form-group d-flex {{ $errors->has('is_publish') ? 'has-error' : ''}}">
                                            <label for="is_publish" class="control-label mr-2">Publish</label><br>
                                            <input checked name="is_publish" type="checkbox" id="is_publish" class="js-switch switch-input mb-1" value="1">
                                        </div>
                                    </div>
                                </div>     
                            </div>
                        </div>
                    </form>
                </div>
            @endif
            <div class="col-md-12 show-faqs-form">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h3>{{$label}}</h3>
                        <div class="d-flex">
                            <form action="" method="get" class="TableForm d-flex">
                                <button type="button" class="off-canvas btn btn-outline-secondary btn-icon mr-2"><i class="fa fa-filter"></i></button>
                                <a href="{{route('admin.faqs.index')}}" class="btn btn-icon btn-sm btn-outline-danger mr-2" title="Reset"><i class="fa fa-redo" aria-hidden="true"></i></a>
                                <a href="javascript:void(0);" id="addFaqs" class="btn btn-icon btn-sm btn-outline-primary mr-2" title="Add New Faq"><i class="fa fa-plus" aria-hidden="true"></i></a>
                            </form>
                            <form action="{{route('admin.faqs.bulk-action')}}" method="POST" id="bulkAction"> 
                                @csrf
                                <input type="hidden" name="ids" id="bulk_ids">
                                <button style="background: transparent;border:none;" class="dropdown-toggle p-0 three-dots" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="ik ik-more-vertical pl-1"></i></button>
                                <ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">
                                    <button type="submit" 
                                    class="dropdown-item bulk-action text-danger fw-700"  
                                    data-value="" 
                                    data-message="You want to delete these items?" 
                                    data-action="delete" 
                                    data-callback="bulkDeleteCallback"> Bulk Delete
                                </button>

                                <a href="javascript:void(0)" 
                                    class="dropdown-item bulk-action"      
                                    data-value="0" 
                                    data-status="Unpublish" 
                                    data-column="is_publish" 
                                    data-message="You want to mark Unpublish these items?" data-action="columnUpdate" data-callback="bulkColumnUpdateCallback">Mark as Unpublish
                                </a>

                                <a href="javascript:void(0)" 
                                    class="dropdown-item bulk-action"
                                    data-value="1" 
                                    data-status="Publish" 
                                    data-column="is_publish" 
                                    data-message="You want to mark Publish these items?" data-action="columnUpdate" data-callback="bulkColumnUpdateCallback">Mark as Publish
                                </a>
                                </ul>
                            </form>
                        </div>
                    </div>
                    <form action="{{ route('admin.faqs.index') }}"  method="GET" id="TableForm">
                        <div id="ajax-container">
                            @include('admin.faqs.load')
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @include('admin.faqs.filter')
@endsection
    <!-- push external js -->
    @push('script')
    <script src="{{ asset('admin/plugins/mohithg-switchery/dist/switchery.min.js') }}"></script>

{{-- START DECOUPLEDEDITOR INIT --}}
  <script src="https://cdn.ckeditor.com/ckeditor5/37.1.0/decoupled-document/ckeditor.js"></script>
  @include('admin.include.bulk-script')
  <script src="{{ asset('admin/js/index-page.js') }}"></script>
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
    {{-- START HTML TO EXCEL INIT --}}
    <script>
        $('#addFaqs').click(function(){
            $('.add-faqs-form').removeClass('d-none');
            $('.show-faqs-form').addClass('d-none');
        })
        $('#showFaqs').click(function(){
            $('.add-faqs-form').addClass('d-none');
            $('.show-faqs-form').removeClass('d-none');
        })
    </script>
       <script>
            function html_table_to_excel(type)
            {
                var table_core = $("#faqTable").clone();
                var clonedTable = $("#faqTable").clone();
                clonedTable.find('[class*="no-export"]').remove();
                clonedTable.find('[class*="d-none"]').remove();
                $("#faqTable").html(clonedTable.html());
                var data = document.getElementById('faqTable');

                var file = XLSX.utils.table_to_book(data, {sheet: "sheet1"});
                XLSX.write(file, { bookType: type, bookSST: true, type: 'base64' });
                XLSX.writeFile(file, 'leadFile.' + type);
                $("#faqTable").html(table_core.html());
            }

            $(document).on('click','#export_button',function(){
                html_table_to_excel('xlsx');
            });
        </script>
    {{-- END HTML TO EXCEL INIT --}}

    <script src="{{ asset('admin/js/ajaxForm.js') }}"></script>
    <script>
         // STORE DATA USING AJAX
        $('.ajaxForm').on('submit',function(e){
            e.preventDefault();
            var route = $(this).attr('action');
            var method = $(this).attr('method');
            var data = new FormData(this);
            const description = editor.getData();
            if(description == ''){
                    $.toast({
                    heading: 'ERROR',
                    text: "description is required",
                    showHideTransition: 'slide',
                    icon: 'error',
                    loaderBg: '#f2a654',
                    position: 'top-right'
                    });
                return false;
            }
            data.append('description',description);
            let response = postData(method,route,'json',data,null,null);
            let redirectUrl = "{{url('admin/faqs')}}";
            if(typeof(response) != "undefined" && response !== null && response.status == "success"){
                window.location.href = redirectUrl;
            }
        })
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


    </script>
    @endpush
