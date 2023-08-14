@extends('layouts.main')
@section('title', ' Settings')
    @push('head')
    <link rel="stylesheet" href="{{ asset('admin/plugins/mohithg-switchery/dist/switchery.min.css') }}">
    @endpush
@section('content')
    @php
    $breadcrumb_arr = [['name' => 'Setting', 'url' => 'javascript:void(0);', 'class' => ''], ['name' => 'Features Activation', 'url' => 'javascript:void(0);', 'class' => 'active']];
    @endphp
<div class="container-fluid">
    <div class="page-header">
        <div class="row align-items-end">
          <div class="col-lg-8">
              <div class="page-header-title">
                  <i class="ik ik-grid bg-blue"></i>
                  <div class="d-inline">
                      <h5>{{ __('Features Activation') }}</h5>
                      <span>{{ __('This setting will be automatically updated in your website.') }}</span>
                  </div>
              </div>
          </div>
            <div class="col-lg-4">
                <div>
                  @include('admin.include.breadcrumb')
                </div>
              @include('admin.setting.sitemodal',['title'=>"How to use",'content'=>"You able to add or remove some functionality from this settings."])
            </div>
        </div>
    </div>
    <div class="row">
    @foreach ($groups as $key => $group)
            <div class="col-md-12">
                <h5>
                    {{$key}}
                </h5>
            </div>
            @foreach ($group['options'] as $option)
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="text-center p-1 " >{{$option['name']}} <i class="ik ik-help-circle text-muted" title="{{$option['tooltip']}}"></i></h5>
                            <div class="text-center">
                                <input type="checkbox" class="js-switch save" data-key="{{$option['key']}}" value="1" @if(getSetting($option['key']) == 1) checked @endif data-switchery="true"/>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endforeach
    </div>
</div>                   
@endsection
    <!-- push external js -->
@push('script')
{{-- START JS HELPERS INIT --}}
    <script src="{{ asset('admin/plugins/mohithg-switchery/dist/switchery.min.js') }}"></script>
    <script>
        $('.save').change(function(){
           var key = $(this).data('key');
           var val = 0;
           if($(this).prop('checked')){
            val = 1;
           }
            $.ajax( {
                url: "{{ route('admin.setting.features-activation.store') }}",
                dataType: "json",
                method: "post",
                data:{
                    key:  key,
                    val:  val,
                },
                success: function (json) {
                    callback( json );
                }
            } );
        })
    </script>
{{-- END JS HELPERS INIT --}}
@endpush