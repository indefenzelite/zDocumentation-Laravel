@extends('layouts.main') 
@section('title', 'Slider')
@section('content')
@php
$breadcrumb_arr = [
    ['name'=>'Edit Slider', 'url'=> "javascript:void(0);", 'class' => '']
]
@endphp
    <!-- push external head elements to head -->
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
                            <h5>Edit {{$slider->getPrefix()}}</h5>
                            <span>Update a record for {{ $sliderType->title }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    @include('admin.include.breadcrumb')
                </div>
            </div>
        </div>
        <form action="{{ route('admin.sliders.update',$slider->id) }}" method="post" enctype="multipart/form-data" class="ajaxForm">
            @csrf
        <div class="row">
            <div class="col-md-8">
                <!-- start message area-->
               @include('admin.include.message')
                <!-- end message area-->
                <div class="card ">
                    <div class="card-header">
                        <h3>Update Slider</h3>
                    </div>
                    <div class="card-body">
                        <input type="hidden" name="request_with" value="update">
                        <input type="hidden" class="remarkType" name="type" value="{{$slider->type}}">
                        <div class="row">
                            <div class="col-md-12 col-12">
                                <div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
                                    <label for="title" class="control-label">Title<span class="text-danger">*</span> </label>
                                    {!! getHelp('Publicly readable name') !!}
                                    <input required   class="form-control" name="title" type="text"  pattern="[a-zA-Z]+.*" title="Please enter first letter alphabet and at least one alphabet character is required." title="Please enter first letter alphabet and at least one alphabet character is required."id="title" value="{{$slider->title }}">
                                </div>
                            </div>
                            {{-- @dd($slider->type) --}}
                            <div class="col-md-12 col-12">
                                    <div class="form-group">
                                        <label for="description" class="control-label">Description</label>
                                        {!! getHelp('Publicly readable name') !!}
                                        <div id="toolbar-container"></div>
                                            @if($slider->type == 2)
                                                <div id="txt_area">
                                                    {!! $slider->description !!}
                                                </div>
                                            @else
                                                <div id="content">
                                                    <textarea name="description" class="form-control ck-editor description" rows="5">{{ $slider->description }}</textarea>
                                                </div>
                                            @endif
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header d-flex justify-content-between pb-1">
                        <h3> Image</h3>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @if(request()->get('sliderTypeId'))
                                <input type="hidden" name="slider_type_id" value="{{request()->get('sliderTypeId')}}">
                                @else
                                    <div class="col-md-12 col-12">
                                        <div class="form-group d-none">
                                            <label for="slider_type_id">Slider Type <span class="text-danger">*</span></label>
                                            {!! getHelp('Publicly readable name') !!}
                                            <select required name="slider_type_id" id="slider_type_id" class="form-control select2">
                                                <option value="" readonly>Select Slider Type </option>
                                                @foreach(App\Models\SliderType::all()  as $option)
                                                    <option value="{{ $option->id }}" @if ($option->id == $slider->slider_type_id) selected @endif>{{  $option->title ?? ''}}</option> 
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                @endif

                                <div class="col-md-12 col-12">                
                                    <div class="form-group {{ $errors->has('image') ? 'has-error' : ''}}">
                                        <label for="image" class="control-label">Image</label>
                                        <input class="form-control" name="image" type="file" id="image"><small class="text-danger">Recommended Image in Dimension 1800*600</small>
                                        @if($slider->getMedia('image')->count() > 0)
                                            <div class="mt-2">
                                                <img id="image_img" src="{{ $slider->getFirstMediaUrl('image') }}" class="mt-2" style="border-radius: 10px;width:100px;height:80px;"/>
                                                <a href="{{ route('admin.sliders.destroy-media',$slider->id).'?media=image' }}" style="position: absolute;" class="btn btn-danger "><i class="fa fa-trash"></i></a>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-12 col-12">
                                    <div class="form-group d-flex  mt-4 align-items-center {{ $errors->has('status') ? 'has-error' : ''}}">
                                        <label for="status" class="control-label mr-2">Publish</label> <br>
                                        <input  @if($slider->status == 1) checked @endif name="status" type="checkbox" class="js-switch switch-input mb-1" id="status" value="1">
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
    $(window).on('load', function (){
        var type = '{{$slider->type}}';
        if(type == 2){
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
        }else{
            var content = $('#description').val();
                $('#content').html('<textarea name="description" class="form-control ck-editor description" rows="5">{{ $slider->description }}</textarea>');
            }
    }); 
</script>

{{-- END DECOUPLEDEDITOR INIT --}}  
    {{-- START AJAX FORM INIT --}}
    <script src="{{ asset('admin/js/ajaxForm.js ') }}"></script>
    <script>
        // STORE DATA USING AJAX
            $('.ajaxForm').on('submit',function(e){
                e.preventDefault();
                var route = $(this).attr('action');
                var method = $(this).attr('method');
                var data = new FormData(this);
                if(editor != undefined){
                    const description = editor.getData();
                    data.append('description',description);
                }
                var response = postData(method,route,'json',data,null,null);
                var redirectUrl = "{{url('admin/sliders')}}"+'?sliderTypeId='+response.sliderTypeId;
                if(typeof(response) != "undefined" && response !== null && response.status == "success"){
                window.location.href = redirectUrl;
            }
            });
    </script>
    {{-- END AJAX FORM INIT --}}

    {{-- START JS HELPERS INIT --}}
    <script>
        document.getElementById('image_img').onchange = function () {
            var src = URL.createObjectURL(this.files[0])
            $('#image_img').removeClass('d-none');
            document.getElementById('image_img').src = src
        }
    </script>
    {{-- END JS HELPERS INIT --}}
    @endpush
@endsection
