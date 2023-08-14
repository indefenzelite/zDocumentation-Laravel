@extends('layouts.main') 
@section('title', $label)
@section('content')
@php
$breadcrumb_arr = [
    ['name'=>'Add'.' '.$label, 'url'=> "javascript:void(0);", 'class' => '']
]
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
                            <h5>{{ __('Create New')}} {{$label}}</h5>
                            <span>{{ __('Add a new record for')}} {{$label}}</span>
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
                @include('admin.include.message')
                <div class="card ">
                    <div class="card-header">
                        <h3>{{ __('Add')}} {{$label}}</h3>
                    </div>
                    <div class="card-body p-3">
                        <form action="{{ route('admin.locations.country.store') }}" class="ajaxForm" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="request_with" value="country-create">
                            <div class="row">
                                <div class="col-md-12 mx-auto">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group {{ $errors->has('Name') ? 'has-error' : ''}}">
                                                <label for="Name" class="control-label">{{ 'Country Name' }} <span class="text-danger">*</span></label>
                                                <a href="javascript:void(0);" title="@lang('admin/tooltip.add_country_name')"><i class="ik ik-help-circle text-muted ml-1"></i></a>
                                                <input class="form-control" name="name" type="text"  pattern="[a-zA-Z]+.*" title="Please enter first letter alphabet and at least one alphabet character is required." title="Please enter first letter alphabet and at least one alphabet character is required." id="Name" value="{{ old('name') }}" placeholder="Enter Name" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group {{ $errors->has('Name') ? 'has-error' : ''}}">
                                                <label for="Name" class="control-label">{{ 'Capital' }} <span class="text-danger">*</span></label>
                                                <a href="javascript:void(0);" title="@lang('admin/tooltip.add_country_capital')"><i class="ik ik-help-circle text-muted ml-1"></i></a>
                                                <input class="form-control" name="capital" type="text"  pattern="[a-zA-Z]+.*" title="Please enter first letter alphabet and at least one alphabet character is required." title="Please enter first letter alphabet and at least one alphabet character is required." id="capital" value="{{ old('capital') }}" placeholder="Enter capital" required>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6">
                                            <div class="form-group {{ $errors->has('Code') ? 'has-error' : ''}}">
                                                <label for="Code" class="control-label">{{ 'Country Code' }} <span class="text-danger">*</span></label>
                                                <a href="javascript:void(0);" title="@lang('admin/tooltip.add_country_code')"><i class="ik ik-help-circle text-muted ml-1"></i></a>
                                                <input class="form-control" name="iso3" type="text"  pattern="[a-zA-Z]+.*" title="Please enter first letter alphabet and at least one alphabet character is required." title="Please enter first letter alphabet and at least one alphabet character is required." id="code" value="{{ old('iso3') }}" maxlength="2" placeholder="Enter Code" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group {{ $errors->has('Currency') ? 'has-error' : ''}}">
                                                <label for="Currency" class="control-label">{{ 'Country Currency' }} <span class="text-danger">*</span></label>
                                                <a href="javascript:void(0);" title="@lang('admin/tooltip.add_country_currency')"><i class="ik ik-help-circle text-muted ml-1"></i></a>
                                                <input class="form-control" name="currency" type="text" id="Currency" value="{{ old('currency') }}" placeholder="Enter Currency" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group {{ $errors->has('region') ? 'has-error' : ''}}">
                                                <label for="region" class="control-label">{{ 'Region' }} <span class="text-danger">*</span></label>
                                                <a href="javascript:void(0);" title="@lang('admin/tooltip.add_country_region')"><i class="ik ik-help-circle text-muted ml-1"></i></a>
                                                <input class="form-control" name="region" type="text" id="region" value="{{ old('region') }}" placeholder="Enter Region" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group {{ $errors->has('Emoji') ? 'has-error' : ''}}">
                                                <label for="Emoji" class="control-label">{{ 'Emoji Code' }} <span class="text-danger">*</span></label>
                                                 <a href="javascript:void(0);" title="@lang('admin/tooltip.add_country_emoji')"><i class="ik ik-help-circle text-muted ml-1"></i></a>
                                                <input class="form-control" name="emoji" type="text" id="Emoji" value="{{ old('emoji') }}" placeholder="Enter Emoji Code" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group {{ $errors->has('phonecode') ? 'has-error' : ''}}">
                                                <label for="phonecode" class="control-label">{{ 'Phone Code' }} <span class="text-danger">*</span></label>
                                                <a href="javascript:void(0);" title="@lang('admin/tooltip.add_country_phonecode')"><i class="ik ik-help-circle text-muted ml-1"></i></a>
                                                <input class="form-control" name="phonecode" type="number" id="phonecode" min="1"  value="{{ old('phonecode') }}" placeholder="Enter Phone Code" required>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group text-right">
                                        <button type="submit" class="btn btn-primary float-right">Create</button>
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
      {{-- normal editor js --}}
    <script src="https://cdn.ckeditor.com/4.14.1/full/ckeditor.js"></script>

      <script>
        
          var options = {
                  filebrowserImageBrowseUrl: "{{ url('/laravel-filemanager?type=Images') }}",
                  filebrowserImageUploadUrl: "{{ url('/laravel-filemanager/upload?type=Images&_token='.csrf_token()) }}",
                  filebrowserBrowseUrl: "{{ url('/laravel-filemanager?type=Files') }}",
                  filebrowserUploadUrl: "{{ url('/laravel-filemanager/upload?type=Files&_token='.csrf_token()) }}"
              };
              $(window).on('load', function (){
                  CKEDITOR.replace('description', options);
              });
      </script>
    @endpush
    @push('script')
		<script src="{{ asset('backend/plugins/mohithg-switchery/dist/switchery.min.js') }}"></script>
		<script src="{{ asset('admin/js/form-advanced.js') }}"></script>
		<script src="https://cdn.ckeditor.com/4.14.1/full/ckeditor.js"></script>
        {{-- START AJAX FORM INIT --}}
        <script src="{{ asset('admin/js/ajaxForm.js') }}"></script>
        <script>
             // STORE DATA USING AJAX
             $('.ajaxForm').on('submit',function(e){
                    e.preventDefault();
                    var route = $(this).attr('action');
                    var method = $(this).attr('method');
                    var data = new FormData(this);
                    var response = postData(method,route,'json',data,null,null);
                    var redirectUrl = "{{url('admin/locations/country')}}";
                    if(typeof(response) != "undefined" && response !== null && response.status == "success"){
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
				function convertToSlug(Text)
				{
					return Text
						.toLowerCase()
						.replace(/ /g,'-')
						.replace(/[^\w-]+/g,'')
						;
				}
			$(window).on('load', function (){
				CKEDITOR.replace('content', options);
			});
			$('#title').on('keyup', function (){
                $('#slugInput').val(convertToSlug($('#title').val()));
				slugFunction();
			});
		</script>
        {{-- END JS HELPERS INIT --}}
	@endpush
@endsection
 

