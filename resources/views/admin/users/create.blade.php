@extends('layouts.main') 
@section('title', 'Add '.$label)
@section('content')
    <!-- push external head elements to head -->
    @push('head')
        <link rel="stylesheet" href="{{ asset('admin/plugins/select2/dist/css/select2.min.css') }}">
        <link rel="stylesheet" href="{{ asset('admin/plugins/mohithg-switchery/dist/switchery.min.css') }}">
    @endpush

    
    <div class="container-fluid">
    	<div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-grid bg-blue"></i>
                        <div class="d-inline">
                            <h5>{{ __('Add '.$label)}}</h5>
                            <span>{{ __('Create new user, assign roles & permissions')}}</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{route('admin.dashboard.index')}}"><i class="ik ik-home"></i></a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{route('admin.users.index')}}">{{$label}}s</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="#">{{ __('Add '.$label)}}</a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <form class="ajaxForm" method="POST" action="{{ route('admin.users.store') }}" autocomplete="off">
            @csrf
            <input type="hidden" name="request_with" value="create">
            <div class="row">
            <!-- start message area-->
            <!-- end message area-->

                <div class="col-md-7 mx-auto">
                    @include('admin.include.message')
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h3>{{ __('Personal Info')}}</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="first_name">{{ __('First Name')}}<span class="text-red">*</span></label>
                                        <a href="javascript:void(0);" title="@lang('admin/tooltip.add_user_first_name')"><i class="ik ik-help-circle text-muted ml-1"></i></a>
                                        <input id="first_name" type="text" pattern="[a-zA-Z]+.*" title="Please enter first letter alphabet and at least one alphabet character is required." title="Please enter first letter alphabet and at least one alphabet character is required." title="Please enter first letter alphabet and at least one alphabet character is required." title="Please enter first letter alphabet and at least one alphabet character is required." class="form-control @error('first_name') is-invalid @enderror" pattern="[A-Za-z]{1,20}"name="first_name" value="{{ old('first_name') }}" placeholder="Enter First Name" required>
                                        <div class="help-block with-errors"></div>
                                        @error('first_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>    
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="last_name">{{ __('Last Name')}}<span class="text-red">*</span></label>
                                        <a href="javascript:void(0);" title="@lang('admin/tooltip.add_user_last_name')"><i class="ik ik-help-circle text-muted ml-1"></i></a>
                                        <input id="last_name" type="text" pattern="[a-zA-Z]+.*" title="Please enter first letter alphabet and at least one alphabet character is required." title="Please enter first letter alphabet and at least one alphabet character is required." title="Please enter first letter alphabet and at least one alphabet character is required." title="Please enter first letter alphabet and at least one alphabet character is required."class="form-control @error('last_name') is-invalid @enderror" pattern="[A-Za-z]{1,20}" name="last_name" value="{{ old('last_name') }}" placeholder="Enter Last Name" required>
                                        <div class="help-block with-errors"></div>
                                        @error('last_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>    
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="gender">{{ __('Gender')}}</label>
                                        <a href="javascript:void(0);" title="@lang('admin/tooltip.add_user_gender')"><i class="ik ik-help-circle text-muted ml-1"></i></a>
                                        <div class="form-radio">
                                            <div class="radio radio-inline">
                                                <label>
                                                    <input type="radio" name="gender" value="Male">
                                                    <i class="helper"></i>{{ __('Male')}}
                                                </label>
                                            </div>
                                            <div class="radio radio-inline">
                                                <label>
                                                    <input type="radio" name="gender" value="Female">
                                                    <i class="helper"></i>{{ __('Female')}}
                                                </label>
                                            </div>
                                        </div>                                        
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="dob">{{ __('Date of Birth')}}</label>
                                         <a href="javascript:void(0);" title="@lang('admin/tooltip.add_user_dob')"><i class="ik ik-help-circle text-muted ml-1"></i></a>
                                        <input class="form-control" max="{{ now()->format('Y-m-d') }}" type="date" id="dob" name="dob" placeholder="Select your date" />
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">{{ __('Email Address')}}<span class="text-red">*</span></label>
                                        <a href="javascript:void(0);" title="@lang('admin/tooltip.add_user_email')"><i class="ik ik-help-circle text-muted ml-1"></i></a>
                                        <input id="email" type="email" pattern="[a-zA-Z]+.*" title="Please enter first letter alphabet and at least one alphabet character is required." title="Please enter first letter alphabet and at least one alphabet character is required." title="Please enter first letter alphabet and at least one alphabet character is required." title="Please enter first letter alphabet and at least one alphabet character is required." maxlength="30" max="30" autocomplete="off"  class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Enter Email Address" required>
                                        <div class="help-block with-errors" ></div>
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phone">{{ __('Contact Number')}}</label>
                                        <a href="javascript:void(0);" title="@lang('admin/tooltip.add_user_phone')"><i class="ik ik-help-circle text-muted ml-1"></i></a>
                                        <input id="phone" type="number" placeholder="Enter Phone Number" pattern="^[0-9]*$" min="0"  class="form-control" name="phone" value="{{ old('phone') }}">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                
                                <div class="col-md-6  d-flex align-items-center">
                                    <div class="form-group d-none">
                                        <label for="">{{ __('Status')}}<span class="text-red">*</span> </label>
                                        <a href="javascript:void(0);" title="@lang('admin/tooltip.add_user_status')"><i class="ik ik-help-circle text-muted ml-1"></i></a>
                                        <input class="js-switch switch-input" @if(old('status')) checked @endif
                                        name="status" type="checkbox" id="status" value="1"checked>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5 mx-auto">
                    @include('admin.include.message')
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h3>{{ __('Roles & Security')}}</h3>
                            <div>
                                {{-- <a href="javascript"  class="btn btn-icon btn-outline-primary" title="upload user bulk " data-toggle="modal" data-target="#UserBulkUpload"><i class="ik ik-upload"></i></a> --}}
                                <x-button>
                                    Create User
                                </x-button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                              
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class=" d-flex justify-content-between">
                                            <div>
                                                <label for="password">{{ __('Set Password')}}<span class="text-red">*</span></label>
                                                <a href="javascript:void(0);" title="@lang('admin/tooltip.add_user_password')"><i class="ik ik-help-circle text-muted ml-1"></i></a>
                                            </div>
                                            <button type="button" class="btn btn-link p-0 m-0 generate_pass">Generate Password</button>
                                        </div>
                                        <div class="input-group mb-3">
                                            <input id="password" type="password" autocomplete="off" class="form-control @error('password') is-invalid @enderror" minlength="4" name="password" value="{{old('password')}}" placeholder="Enter Password" required>
                                            <div class="input-group-append">
                                              <span class="input-group-text"><i class="ik ik-eye" id="togglePassword"></i></span>
                                            </div>
                                          </div>
                                        
                                        
                                        <div class="help-block with-errors"></div>
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="role">{{ __('Assign Role')}}<span class="text-red">*</span></label>
                                        <a href="javascript:void(0);" title="@lang('admin/tooltip.add_user_role')"><i class="ik ik-help-circle text-muted ml-1"></i></a>
                                        <select name="role" required id="" class="form-control select2">
                                            <option value="" readonly>Specify Role</option>
                                            @foreach ($roles as $role)
                                                <option value="{{ $role->display_name }}" @selected(old('role') == $role->display_name)>{{ $role->display_name}} @empty (!$role->description)| {{ $role->description}} @endempty</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="send_mail">{{ __('Send Mail')}} </label>
                                        <a href="javascript:void(0);" title="@lang('admin/tooltip.add_user_send_mail')"><i class="ik ik-help-circle text-muted ml-1"></i></a> 
                                        <div>
                                            <input type="checkbox" name="send_mail" value="1">
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    @include('admin.users.includes.modal.bulk-upload')
    <!-- push external js -->
    @push('script') 
         <!--get role wise permissiom ajax script-->
        <script src="{{ asset('admin/plugins/mohithg-switchery/dist/switchery.min.js') }}"></script>

        {{-- START SELECT 2 BUTTON INIT --}}
        <script src="{{ asset('admin/plugins/select2/dist/js/select2.min.js') }}"></script>
        <script>
             $('select.select2').select2();
        </script>
        {{-- END SELECT 2 BUTTON INIT --}}

        {{-- START AJAX FORM INIT --}}
        <script src="{{ asset('admin/js/ajaxForm.js') }}"></script> 
        <script>
             $('.ajaxForm').on('submit',function(e){
                e.preventDefault();
                var route = $(this).attr('action');
                var method = $(this).attr('method');
                var data = new FormData(this);
                var response = postData(method,route,'json',data,null,null);
                var redirectUrl = "{{url('admin/users')}}"+'?role='+response.role;
                if(typeof(response) != "undefined" && response !== null && response.status == "success"){
                    window.location.href = redirectUrl;
                }
            })
        </script>
        {{-- END AJAX FORM INIT --}}

        {{-- START JS HELPERS INIT --}}
        <script>
            $(document).ready(function(){
                $('#togglePassword').click(function() {
                    var input = $('#password');
                    var icon = $(this);

                    if (input.attr('type') === 'password') {
                        input.attr('type', 'text');
                        icon.removeClass('ik-eye').addClass('ik-eye-off');
                    } else {
                        input.attr('type', 'password');
                        icon.removeClass('ik-eye-off').addClass('ik-eye');
                    }
                });
                $('#state, #country, #city').css('width','100%').select2();
    
                function getStates(countryId =  101) {
                    $.ajax({
                    url: '{{ route("world.get-states") }}',
                    method: 'GET',
                    data: {
                        country_id: countryId
                    },
                    success: function(res){
                        $('#state').html(res).css('width','100%').select2();
                    }
                    })
                }
                getStates(101);

                function getCities(stateId =  101) {
                    $.ajax({
                    url: '{{ route("world.get-cities") }}',
                    method: 'GET',
                    data: {
                        state_id: stateId
                    },
                    success: function(res){
                        $('#city').html(res).css('width','100%').select2();
                    }
                    })
                }
                $('#country').on('change', function(e){
                    getStates($(this).val());
                })

                $('#state').on('change', function(e){
                    getCities($(this).val());
                })

            });

            $('.generate_pass').on('click',function(){
                var length = 6;
                var chars = "abcdefghijklmnopqrstuvwxyz!@#$%^&*ABCDEFGHIJKLMNOP1234567890";
                    var pass = "";
                    for (var x = 0; x < length; x++) {
                        var i = Math.floor(Math.random() * chars.length);
                        pass += chars.charAt(i);
                    }
                $('#password').val(pass);
            });
        </script>
        {{-- START JS HELPERS INIT --}}
    @endpush
@endsection
