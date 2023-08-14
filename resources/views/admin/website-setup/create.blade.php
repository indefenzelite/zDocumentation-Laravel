@extends('layouts.main') 
@section('title', $label)
@section('content')
@push('head')
	<link rel="stylesheet" href="{{ asset('admin/plugins/mohithg-switchery/dist/switchery.min.css') }}">
	<link rel="stylesheet" href="{{ asset('admin/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}">

	<style>
		.bootstrap-tagsinput{
			width: 100%;
		}
	</style>
@endpush
    @php
       $breadcrumb_arr = [
            ['name'=>$label, 'url'=> "javascript:void(0);", 'class' => ''],
        ]
    @endphp
    <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-edit bg-blue"></i>
                        <div class="d-inline">
                            <h5>{{ __('Create')}} {{$label}}</h5>
                            <span>{{ __('This setting will be automatically updated in your website.')}}</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    @include('admin.include.breadcrumb')
                </div>
            </div>
        </div>  
		<form action="{{ route('admin.website-pages.store') }}" method="POST" enctype="multipart/form-data" class="ajaxForm">
		@csrf
		<input type="hidden" name="request_with" value="create">
			<div class="row">
				<div class="col-md-7">
					<div class="">
						<div class="card">
							<div class="card-header">
								<h6 class="fw-600 mb-0">{{ ('Page Content') }}</h6>
							</div>
							<div class="card-body">
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label class="control-label" for="name">{{('Title')}} <span class="text-danger">*</span></label>
											<a href="javascript:void(0);" title="@lang('admin/tooltip.add_website_page_title')"><i class="ik ik-help-circle text-muted ml-1"></i></a>
											<input type="text"  pattern="[a-zA-Z]+.*" title="Please enter first letter alphabet and at least one alphabet character is required." title="Please enter first letter alphabet and at least one alphabet character is required."class="form-control" id="title"placeholder="Title" name="title" required>
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group {{ $errors->has('slug') ? 'has-error' : ''}}">
											<label for="slug" class="control-label">Slug<span class="text-danger">*</span></label>
											<a href="javascript:void(0);" title="@lang('admin/tooltip.add_website_page_slug')"><i class="ik ik-help-circle text-muted ml-1"></i></a>
											<div class="input-group d-block d-md-flex">
												<input type="hidden" class="form-control w-100 w-md-auto" id="slugInput" oninput="slugFunction()" placeholder="{{ ('Slug') }}" name="slug" >
												<div class="input-group-prepend"><span class="input-group-text flex-grow-1" style="overflow: auto" id="slugOutput">{{ url('page/') }}</span></div>
											</div>
										</div>
									</div>
									
									<div class="col-md-12">
										<div class="form-group">
											<label class="control-label" for="name">{{('Page Content')}} <span class="text-danger">*</span></label>
											<div id="content-holder">
															
												<div id="toolbar-container"></div>
												<div id="txt_area">
													
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
								<h6 class="fw-600 mb-0">{{ ('Seo Fields') }}</h6>
							</div>
							<div class="card-body">
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label" for="page_meta_title">{{('Meta Title')}}</label>
											<a href="javascript:void(0);" title="@lang('admin/tooltip.add_website_page_meta_title')"><i class="ik ik-help-circle text-muted ml-1"></i></a>
											<input type="text"  pattern="[a-zA-Z]+.*" title="Please enter first letter alphabet and at least one alphabet character is required." title="Please enter first letter alphabet and at least one alphabet character is required."class="form-control" placeholder="Title" val name="page_meta_title">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label" for="page_keywords">{{('Keywords')}}</label>
											<a href="javascript:void(0);" title="@lang('admin/tooltip.add_website_page_keywords')"><i class="ik ik-help-circle text-muted ml-1"></i></a>
											<input type="text"  pattern="[a-zA-Z]+.*" title="Please enter first letter alphabet and at least one alphabet character is required." title="Please enter first letter alphabet and at least one alphabet character is required."id="tags" name="page_keywords" class="form-control" value="">
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group">
											<label class="control-label" for="name">{{('Meta Description')}}</label>
											<a href="javascript:void(0);" title="@lang('admin/tooltip.add_website_page_meta_description')"><i class="ik ik-help-circle text-muted ml-1"></i></a>
											<textarea class="form-control" placeholder="Description" name="page_meta_description"></textarea>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-5">
					<div class="card">
						<div class="card-header d-flex justify-content-between">
							<h6 class="fw-600 mb-0">{{ (' Visibility') }}</h6>
							<button type="submit" class="btn btn-primary">{{ ('Create Page') }}</button>
						</div>
						<div class="card-body">
							<div class="row">

								<div class="col-md-12">
									<div class="form-group">
										<label class="control-label">{{('Publish')}}</label>
										<label class="aiz-switch aiz-switch-success mb-0">
										<input type="checkbox" class="js-switch" value="1" name="status" checked>
										<span></span>
										</label>
									</div>
								</div>

								<div class="col-md-12">
									<div class="form-group">
										<label for="website_page_image" class="control-label">Banner Image</label>
										<a href="javascript:void(0);" title="@lang('admin/tooltip.add_website_page_banner')"><i class="ik ik-help-circle text-muted ml-1"></i></a>
										<div class="input-images" data-input-name="page_meta_image" id="website_page_image" data-label="Drag & Drop product images here or click to browse"></div>
										{{-- <input class="form-control" name="page_meta_image" type="file" id="website_page_image" value="{{old('page_meta_image')}}" accept=".png, .jpg, .jpeg,.gif"> --}}
										{{-- <img id="show-image" class="d-none mt-2" style="border-radius: 10px;width:100%;height:80px;"/> --}}
									</div>
								</div>
								
							</div>
						</div>
					</div>
				</div>
			</div>
		</form>
    </div>
    
	@push('script')
	<script src="{{ asset('admin/plugins/mohithg-switchery/dist/switchery.min.js') }}"></script>
	 
    {{-- START TAGINPUT INIT --}}
	<script src="{{ asset('admin/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js') }}"></script>
	<script>
		$('#tags').tagsinput('items');
		$('.input-images').imageUploader();
	</script>
	{{-- END TAGINPUT INIT --}}
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
	

	{{-- START AJAX FORM INIT --}}
	<script src="{{ asset('admin/js/ajaxForm.js') }}"></script>
	<script>
		// STORE DATA USING AJAX
		$('.ajaxForm').on('submit',function(e){
			e.preventDefault();
			var route = $(this).attr('action');
			var method = $(this).attr('method');
			var data = new FormData(this);
			if(editor != undefined){
				const content = editor.getData();
				data.append('content',content);
			}
			var response = postData(method,route,'json',data,null,null);
			var redirectUrl = "{{url('admin/website-pages')}}";
			if(typeof(response) != "undefined" && response !== null && response.status == "success"){
				window.location.href = redirectUrl;
			}
		});
	</script>
	{{-- END AJAX FORM INIT --}}

	{{-- START JS HELPERS INIT --}}
		<script>
			document.getElementById('website_page_image').onchange = function () {
				var src = URL.createObjectURL(this.files[0])
				$('#show-image').removeClass('d-none');
				document.getElementById('show-image').src = src
			}

			
				function slugFunction() {
					var x = document.getElementById("slugInput").value;
					document.getElementById("slugOutput").innerHTML = "{{ url('/page/') }}/" + x;
				}
				function convertToSlug(Text)
				{
					return Text
						.toLowerCase()
						.replace(/ /g,'-')
						.replace(/[^\w-]+/g,'')
						;
				}
				
				$('#title').on('keyup', function (){
					$('#slugInput').val(convertToSlug($('#title').val()));
					slugFunction();
				});
			
		</script>
	{{-- END JS HELPERS INIT --}}
   
@endpush
@endsection


