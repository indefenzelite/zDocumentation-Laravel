{{ $data['atsign'] }}extends('layouts.main') 
{{ $data['atsign'] }}section('title', '{{ $heading }}')
{{ $data['atsign'] }}section('content')
{{ $data['atsign'] }}php
/**
* {{ $heading }} 
*
* @category zStarter
*
* @ref zCURD
* @author  Defenzelite <hq@defenzelite.com>
* @license https://www.defenzelite.com Defenzelite Private Limited
* @version <zStarter: 1.1.0>
* @link    https://www.defenzelite.com
*/
$breadcrumb_arr = [
    ['name'=>'{{ $heading }}', 'url'=>  route('{{ $data['dotroutepath'].$data['view_name']}}.index')  , 'class' => ''],
    ['name'=>'Edit '.{{ $variable }}->getPrefix(), 'url'=> "javascript:void(0);", 'class' => 'Active']
]
{{ $data['atsign'] }}endphp
    <!-- push external head elements to head -->
    {{ $data['atsign'] }}push('head')
    <link rel="stylesheet" href="{{ $data['curlstart'] }} asset('admin/plugins/mohithg-switchery/dist/switchery.min.css') }}">
    <style>
        .error{
            color:red;
        }
    </style>
    {{ $data['atsign'] }}endpush

    <div class="container-fluid">
    	<div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-grid bg-blue"></i>
                        <div class="d-inline">
                            <h5>{{ __('Edit')}} {{ $heading }}</h5>
                            <span>{{ __('Update a record for')}} {{ $heading }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    {{$data['atsign']}}include('admin.include.breadcrumb')
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 mx-auto">
                <!-- start message area-->
               {{$data['atsign']}}include('admin.include.message')
                <!-- end message area-->
                <div class="card ">
                    <div class="card-header">
                        <h3>{{ __('Update')}} {{ $heading }}</h3>
                    </div>
                    <div class="card-body">
                        <form class="ajaxForm" action="{{ $data['curlstart'] }} route('{{ $data['dotroutepath'].$data['view_name']}}.update',{{ $variable }}->id) }}" method="post" enctype="multipart/form-data" id="{{ $data['model'] }}Form">
                            {{$data['atsign']}}csrf
                            <input type="hidden" name="request_with" value="update">
                            <div class="row">
                            @foreach($data['fields']['name'] as $index => $item)
                                @if($data['fields']['input'][$index] == 'select')

                                <div class="{{ $data['fields']['column']['column_'.$index] }} col-12"> {{-- Select --}}
                                    <div class="form-group">
                                        <label for="{{ $item }}">{{ucwords(str_replace('_',' ',$item))}}{!! array_key_exists('required_'.$index,$data['fields']['options']) ? '<span class="text-danger">*</span>' : '' !!}</label>
                                        <select {{ array_key_exists('required_'.$index,$data['fields']['options']) ? 'required' : '' }} {{ array_key_exists('multiple_'.$index,$data['fields']['options']) ? 'multiple' : '' }}  name="{{ $item }}" id="{{ $item }}" class="form-control select2">
                                            <option value="" readonly>Select {{ucwords(str_replace('_',' ',$item))}}</option>@if($data['fields']['comment'][$index] != null)
                                                
                                            {{$data['atsign']}}php
                                            $arr = [{!! (string)$data['fields']['comment'][$index] !!}];
                                            {{$data['atsign']}}endphp
                                            {{ $data['atsign'] }}foreach(getSelectValues($arr) as $key => $option) 
                                                    <option value=" {{ $data['curlstart'] }}  $option }}" {{ $data['curlstart'] }}   {{ $variable }}->{{ $item }}  ==  $option  ? 'selected' : ''}}>{{ $data['curlstart'] }} $option}}</option> 
                                                {{ $data['atsign'] }}endforeach @endif
                                        
                                        </select>
                                    </div>
                                </div>
                                @elseif($data['fields']['input'][$index] == 'select_via_table')

                                <div class="{{ $data['fields']['column']['column_'.$index] }} col-12"> {{-- Select --}}
                                    <div class="form-group">
                                        <label for="{{ $item }}">{{str_replace('Id','',ucwords(str_replace('_',' ',$item)))}}{!! array_key_exists('required_'.$index,$data['fields']['options']) ? '<span class="text-danger">*</span>' : '' !!}</label>
                                        <select {{ array_key_exists('required_'.$index,$data['fields']['options']) ? 'required' : '' }} {{ array_key_exists('multiple_'.$index,$data['fields']['options']) ? 'multiple' : '' }} name="{{ $item }}" id="{{ $item }}" class="form-control select2">
                                            <option value="" readonly>Select {{str_replace('Id','',ucwords(str_replace('_',' ',$item)))}}</option>@if($data['fields']['table'][$index] == "Category")
                                            
                                            {{$data['atsign']}}foreach(getCategories('{{ $data['fields']['comment'][$index] }}')  as $option)@else

                                            {{$data['atsign']}}foreach(App\Models\{{ $data['fields']['table'][$index] }}::all()  as $option)@endif

                                                <option value="{{ $data['curlstart'] }} $option->id }}" {{ $data['curlstart'] }} {{ $variable }}->{{ $item }}  ==  $option->id ? 'selected' : ''}}>{{ $data['curlstart'] }}  $option->name ?? ''}}</option> 
                                            {{ $data['atsign'] }}endforeach
                                        </select>
                                    </div>
                                </div>
                                @elseif($data['fields']['input'][$index] == 'textarea')

                                <div class="{{ $data['fields']['column']['column_'.$index] }} col-12"> {{-- Textarea --}}
                                    <div class="form-group">
                                        <label for="{{ $item }}" class="control-label">{{ucwords(str_replace('_',' ',$item)) }}{!! array_key_exists('required_'.$index,$data['fields']['options']) ? '<span class="text-danger">*</span>' : '' !!}</label>
                                        <textarea {{ array_key_exists('required_'.$index,$data['fields']['options']) ? 'required' : '' }} class="form-control" name="{{ $item }}" id="{{ $item }}" placeholder="Enter {{ ucwords(str_replace('_',' ',$item))  }}">{{ $data['curlstart'] }}{{ $variable }}->{{ $item }} }}</textarea>
                                    </div>
                                </div>
                                @elseif($data['fields']['input'][$index] == 'decimal')

                                <div class="{{ $data['fields']['column']['column_'.$index] }} col-12">
                                    <div class="form-group {{ $data['curlstart'] }} $errors->has('{{ $item}}') ? 'has-error' : ''}}">
                                        <label for="{{ $item }}" class="control-label">{{ucwords(str_replace('_',' ',$item)) }}{!! array_key_exists('required_'.$index,$data['fields']['options']) ? '<span class="text-danger">*</span>' : '' !!}</label>
                                        <input {{ array_key_exists('required_'.$index,$data['fields']['options']) ? 'required' : '' }}  class="form-control" name="{{ $item }}" type="number" step="any" id="{{ $item }}" value="{{ $data['curlstart'] }}{{ $variable }}->{{ $item }} }}">
                                    </div>
                                </div>
                                @elseif($data['fields']['input'][$index] == 'datetime-local')

                                <div class="{{ $data['fields']['column']['column_'.$index] }} col-12">
                                    <div class="form-group {{ $data['curlstart'] }} $errors->has('{{ $item}}') ? 'has-error' : ''}}">
                                        <label for="{{ $item }}" class="control-label">{{ucwords(str_replace('_',' ',$item)) }}{!! array_key_exists('required_'.$index,$data['fields']['options']) ? '<span class="text-danger">*</span>' : '' !!}</label>
                                        <input {{ array_key_exists('required_'.$index,$data['fields']['options']) ? 'required' : '' }}  class="form-control" name="{{ $item }}" type="datetime-local" id="{{ $item }}" value="{{ $data['curlstart'] }}\Carbon\Carbon::parse({{ $variable }}->{{ $item }})->format('Y-m-d\TH:i') }}">
                                    </div>
                                </div>
                                @elseif($data['fields']['input'][$index] == "checkbox" ||$data['fields']['input'][$index] == "radio") 

                                <div class="{{ $data['fields']['column']['column_'.$index] }} col-12"> {{-- checkbox radio --}}
                                    <div class="form-group {{ $data['curlstart'] }} $errors->has('{{ $item}}') ? 'has-error' : ''}}"><br>
                                        <label for="{{ $item }}" class="control-label">
                                        <input {{ array_key_exists('required_'.$index,$data['fields']['options']) ? 'required' : '' }} class="js-single switch-input" {{$data['atsign']}}if({{ $variable }}->{{ $item }}) checked {{$data['atsign']}}endif name="{{ $item }}" type="{{ $data['fields']['input'][$index] }}" id="{{ $item }}" value="1"> {{ucwords(str_replace('_',' ',$item)) }}{!! array_key_exists('required_'.$index,$data['fields']['options']) ? '<span class="text-danger">*</span>' : '' !!}</label>
                                    </div>
                                </div>
                                @elseif($data['fields']['input'][$index] == 'file')

                                <div class="{{ $data['fields']['column']['column_'.$index] }} col-12"> {{-- file/img --}}
                                    <div class="form-group {{ $data['curlstart'] }} $errors->has('{{ $item}}') ? 'has-error' : ''}}">
                                        <label for="{{ $item }}" class="control-label">{{ucwords(str_replace('_',' ',$item)) }}{!! array_key_exists('required_'.$index,$data['fields']['options']) ? '<span class="text-danger">*</span>' : '' !!}</label>
                                        <input class="form-control" name="{{ $item }}_file" {{ array_key_exists('required_'.$index,$data['fields']['options']) ? 'required' : '' }} {{ array_key_exists('multiple_'.$index,$data['fields']['options']) ? 'multiple' : '' }} type="{{ $data['fields']['input'][$index] }}" id="{{ $item }}">
                                        <img id="{{ $item }}_file" src="{{ $data['curlstart'] }} asset({{ $variable}}->{{ $item }}) }}" class="mt-2" style="border-radius: 10px;width:100px;height:80px;"/>
                                    </div>
                                </div>
                                @elseif($data['fields']['input'][$index] == 'hidden')

                                <input {{ array_key_exists('required_'.$index,$data['fields']['options']) ? 'required' : '' }} class="form-control" name="{{ $item }}" type="{{ $data['fields']['input'][$index] }}" id="{{ $item }}" value="{{ $data['curlstart'] }}{{ $variable }}->{{ $item }} }}" placeholder="Enter {{ ucwords(str_replace('_',' ',$item))  }}" >
                                @else
                                
                                <div class="{{ $data['fields']['column']['column_'.$index] }} col-12"> {{-- Input --}}
                                    <div class="form-group {{ $data['curlstart'] }} $errors->has('{{ $item}}') ? 'has-error' : ''}}">
                                        <label for="{{ $item }}" class="control-label">{{ucwords(str_replace('_',' ',$item)) }}{!! array_key_exists('required_'.$index,$data['fields']['options']) ? '<span class="text-danger">*</span>' : '' !!}</label>
                                        <input {{ array_key_exists('required_'.$index,$data['fields']['options']) ? 'required' : '' }} @if($data['fields']['input'][$index] == "checkbox")@if( $data['fields']['default'][$index] == 1)checked @endif @endif class="form-control" name="{{ $item }}" type="{{ $data['fields']['input'][$index] }}" id="{{ $item }}" value="{{ $data['curlstart'] }}{{ $variable }}->{{ $item }} }}">
                                    </div>
                                </div>
                                @endif
                            @endforeach
                            
                             @if(array_key_exists('media',$data)) @foreach($data['media']['name'] as $index => $item)

                            <div class="col-md{{ $data['media']['col'][$index] ? '-'.$data['media']['col'][$index] : '' }} col-12"> {{-- file/img --}}
                                <div class="form-group {{ $data['curlstart'] }} $errors->has('{{ $item}}') ? 'has-error' : ''}}">
                                    <label for="{{ $item }}" class="control-label">{{ ucwords(str_replace('_',' ',$item)) }}{!! array_key_exists('required_'.$index,$data['media']['options']) ? '<span class="text-danger">*</span>' : '' !!}</label>
                                    <input  {{ array_key_exists('required_'.$index,$data['media']['options']) ? 'required' : '' }} {{ array_key_exists('multiple_'.$index,$data['media']['options']) ? 'multiple' : '' }} class="form-control" name="{{ $item }}" type="file" id="{{ $item }}" value="{{ $data['curlstart'] }}old('{{ $item }}')}}" >
                                    {{$data['atsign']}}if({{ $variable}}->getMedia('{{ $item }}')->count() > 0)
                                    <div class="media-div">
                                        <img id="{{ $item }}_img" src="{{ $data['curlstart'] }} {{ $variable}}->getFirstMediaUrl('{{ $item }}') }}" class=" mt-2" style="border-radius: 10px;width:100px;height:80px;"/>
                                       <a href="{{ $data['curlstart'] }} route('admin.media.destroy').'?model_type={{ $data['model'] }}&model_id='.{{ $variable }}->id.'&media={{ $item }}' }}" style="position: absolute;" class="btn btn-danger delete-media"><i class="fa fa-trash"></i></a>
                                    </div>
                                    {{$data['atsign']}}endif
                                </div>
                            </div>
                            @endforeach @endif

                                <div class="col-md-12 mx-auto">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Update</button>
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
    {{$data['atsign']}}push('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
    <script src="{{ $data['curlstart'] }}asset('admin/plugins/mohithg-switchery/dist/switchery.min.js') }}"></script>
    <script src="{{ $data['curlstart'] }}asset('admin/js/form-advanced.js') }}"></script>
    <{{ $data['script'] }}>
        $('#{{ $data['model'] }}Form').validate();
        $('.ajaxForm').on('submit',function(e){
            e.preventDefault();
            let route = $(this).attr('action');
            let method = $(this).attr('method');
            let data = new FormData(this);
            let response = postData(method,route,'json',data,null,null);
            let redirectUrl = "{{ $data['curlstart'] }} url('{{$data['slashviewpath'].$data['view_name'] }}') }}";
            if(typeof(response) != "undefined" && response !== null && response.status == "success")
                window.location.href = redirectUrl;
            else
                window.location.href = redirectUrl;
            
        })

        @foreach($data['fields']['name'] as $index => $item)
            @if($data['fields']['input'][$index] == 'file')
              
            document.getElementById('{{ $item }}').onchange = function () {
                let src = URL.createObjectURL(this.files[0])
                $('#{{ $item }}_file').removeClass('d-none');
                document.getElementById('{{ $item }}_file').src = src
            }
            @endif
        @endforeach

        @if(array_key_exists('media',$data)) @foreach($data['media']['name'] as $index => $item)

            document.getElementById('{{ $item }}').onchange = function () {
                let src = URL.createObjectURL(this.files[0])
                $('#{{ $item }}').removeClass('d-none');
                document.getElementById('{{ $item }}_img').src = src
            }
        @endforeach @endif
    </{{ $data['script'] }}>
    {{$data['atsign']}}endpush
{{$data['atsign']}}endsection
