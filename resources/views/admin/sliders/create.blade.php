@extends('layouts.main') 
@section('title', $label)
@section('content')
@php
$breadcrumb_arr = [
    ['name'=>'Add'.$label, 'url'=> "javascript:void(0);", 'class' => '']
]
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
                            <h5>Add {{$label}}</h5>
                            <span>List of {{$sliderType->title ?? ''}} {{$label}} @if(request()->get('slidertype'))of  {{ fetchFirst('App\Models\SliderType',request()->get('slidertype'),'title','') }}@endif</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    @include('admin.include.breadcrumb')
                </div>
            </div>
        </div>
        <form action="{{ route('admin.sliders.store') }}" method="post" enctype="multipart/form-data" class="ajaxForm"> 
            @csrf
            <div class="row">
                <div class="col-2"></div>
                <div class="col-md-8">
                    <!-- start message area-->
                    @include('admin.include.message')
                    <!-- end message area-->
                    <div class="card ">
                        <div class="card-header justify-content-between">
                            <h3>{{$sliderType->title ?? ''}} {{$label}}</h3>
                            <button type="submit" class="btn btn-primary">Create</button>
                        </div>
                        <div class="card-body">
                            <input type="hidden" name="request_with" value="create">
                            <div class="row">
                                <div class="col-md-8 col-12">
                                    <div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
                                        <label for="title" class="control-label">Title<span class="text-danger">*</span> </label>
                                        {!! getHelp('Publicly readable name') !!}
                                        <input required  class="form-control" name="title" pattern="[a-zA-Z]+.*" title="Please enter first letter alphabet and at least one alphabet character is required." title="Please enter first letter alphabet and at least one alphabet character is required." type="text" id="title" value="{{old('title')}}" placeholder="Enter Title">
                                    </div>
                                    <div class="alert alert-danger"> {!! getHelp('Content and image upload options appear after creation.') !!}  Content and image upload options appear after creation.</div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="form-group {{ $errors->has('Type') ? 'has-error' : ''}}">
                                        <label for="Type" class="control-label">Type<span class="text-danger">*</span> </label>
                                        {!! getHelp('Publicly readable name') !!}
                                        <select name="type" id="remarkType" class="form-control select2" required>
                                            @foreach (\App\Models\Slider::TYPES as $key => $type)
                                                <option value="{{ $key }}">{{ $type['label'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12 d-none">
                                    <div class="form-group {{ $errors->has('image') ? 'has-error' : ''}}">
                                        <label for="image" class="control-label">Image</label>
                                        <input class="form-control" name="image" type="file" id="image" value="{{old('image')}}"><small class="text-danger">Recommended Image in Dimension 1800*600</small>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12 d-none">
                                    <div class="form-group d-flex mt-4 align-items-center {{ $errors->has('status') ? 'has-error' : ''}}">
                                        <label for="status" class="control-label mr-2">Publish</label><br>
                                        <input type="checkbox" id="status" checked   value="2" name="status" class="js-switch switch-input"/>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        @if(request()->get('sliderTypeId'))
                                        <input type="hidden" name="slider_type_id" value="{{request()->get('sliderTypeId')}}">
                                        @else
                                        <div class="col-md-12 col-12">
                                            <div class="form-group">
                                                <label for="slider_type_id">Slider Type <span class="text-danger">*</span></label>
                                                {!! getHelp('Publicly readable name') !!}
                                                <select required name="slider_type_id" id="slider_type_id" class="form-control select2">
                                                    <option value="" readonly>Select Slider Type </option>
                                                    @foreach(App\Models\SliderType::all()  as $option)
                                                        <option value="{{ $option->id }}">{{  $option->title ?? ''}}</option> 
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-2"></div>
            </div>
        </form>
    </div>
    <!-- push external js -->
    @push('script')
    <script src="{{ asset('admin/plugins/mohithg-switchery/dist/switchery.min.js') }}"></script>

     
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
                var redirectUrl = "{{url('admin/sliders/edit')}}"+"/"+response.sliderId;
                if(typeof(response) != "undefined" && response !== null && response.status == "success"){
                window.location.href = redirectUrl;
            }
            });
    </script>
    {{-- END AJAX FORM INIT --}}
    @endpush
@endsection
