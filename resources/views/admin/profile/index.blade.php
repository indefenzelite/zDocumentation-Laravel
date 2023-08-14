@extends('layouts.main') 
@section('title', 'Profile')
@section('content')
@push('head')
    <link rel="stylesheet" href="{{ asset('admin/plugins/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/plugins/datedropper/datedropper.min.css') }}">
@endpush

    <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-file-text bg-blue"></i>
                        <div class="d-inline">
                            <h5>{{ __('Profile')}}</h5>
                            <span>{{ __('Update Profile')}}</span>
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
                                <a href="#">{{ __('Pages')}}</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">{{ __('Profile')}}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <div class="row">
            @include('admin.include.message')
            <div class="col-lg-4 col-md-5">
                <div class="card">
                    <div class="card-body">
                        <div class="text-center">
                            <div style="width: 150px; height: 150px; position: relative" class="mx-auto">
                                <img src="{{ ($user && $user->avatar) ? $user->avatar : asset('admin/default/default-avatar.png') }}" class="rounded-circle" width="150" style="object-fit: cover; width: 150px; height: 150px" />
                                <button class="btn btn-dark rounded-circle position-absolute" style="width: 30px; height: 30px; padding: 8px; line-height: 1; top: 0; right: 0"  data-toggle="modal" data-target="#updateProfileImageModal"><i class="ik ik-camera"></i></button>
                            </div>
                            <h5 class="mb-0 mt-3">
                                {{ Str::limit($user->full_name,20) }} 
                                @if($user->is_verified == 1)<strong class="mr-1"><i class="ik ik-check-circle"></i></strong>@endif
                            </h5>
                            <span class="text-muted" title="Role Name">{{ UserRole($user->id)->display_name }}</span>
                                @if(getSetting('wallet_activation') == 1)
                                    <div class=" mt-2">
                                        <a class="btn btn-outline-light text-dark border" href="@if(auth()->user()->isAbleTo('control_wallet')){{ route('admin.wallet-logs.index',$user->id) }} @endif">
                                            <i class="fa fa-wallet pr-1"></i>Wallet Balance:
                                            {{$user->wallet ?? '0.0'}}
                                        </a>    
                                    </div>
                                @endif
                        </div>
                    </div>
                    <hr class="mb-0">
                    <div class="card-body">
                        <small class="text-muted d-block">{{ __('Email address') }}</small>
                        <div class="d-flex justify-content-between"> 
                            <h6 style="overflow-wrap: anywhere;"><span><i class="ik ik-mail mr-1"></i><a href="mailto:{{ $user->email ?? '' }}"id="copyemail">{{ $user->email ?? '' }}</a></span></h6>
                            <span class="text-copy"title="Copy"data-clipboard-target="#copyemail">
                                <i class="ik ik-copy"></i>
                            </span>
                        </div>
                        <small class="text-muted d-block pt-10">{{ __('Phone Number') }}</small>
                        <div class="d-flex justify-content-between">
                            <h6><span><a href="tel:{{ $user->phone ?? '' }}"id="copyphone"><i class="ik ik-phone mr-1"></i>{{ $user->phone ?? '' }}</a></span>
                            </h6>
                            <span class="text-copy" title="Copy"data-clipboard-target="#copyphone"tile>
                                <i class="ik ik-copy"></i>
                            </span>
                        </div>
                        <small class="text-muted d-block pt-10">{{ __('Member Since') }}</small>
                        <h6>{{ $user->formatted_created_at ?? '' }}</h6>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-md-7">
                <div class="card">
                    <ul class="nav nav-pills custom-pills" id="pills-tab" role="tablist">
                        <li class="nav-item">
                            <a data-active="setting" class="nav-link active-swicher @if(request()->has('active') && request()->get('active') == "setting" || !request()->has('active')) active @endif" data-type="setting" id="pills-setting-tab" data-toggle="pill" href="#previous-month" role="tab" aria-controls="pills-setting" aria-selected="false">{{ __('Setting')}}</a>
                        </li>
                        <li class="nav-item">
                            <a data-active="account" class="nav-link active-swicher @if(request()->has('active') && request()->get('active') == "account") active @endif" data-type="account" id="pills-timeline-tab" data-toggle="pill" href="#current-month" role="tab" aria-controls="pills-timeline" aria-selected="true">{{ __('Change Password')}}</a>
                        </li>
                        {{-- @if(auth()->user()->isAbleTo('control_mfa_user'))
                            <li class="nav-item">
                                <a data-active="security" class="nav-link active-swicher @if(request()->has('active') && request()->get('active') == "security") active @endif" data-type="security" id="pills-timeline-tab" data-toggle="pill" href="#security" role="tab" aria-controls="pills-timeline" aria-selected="true">{{ __('MFA')}}</a>
                            </li>
                        @endif --}}
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade @if(request()->has('active') && request()->get('active') == "setting" || !request()->has('active')) show active  @endif" id="previous-month" role="tabpanel" aria-labelledby="pills-setting-tab">
                            <div class="card-body">
                                <form action="{{route('admin.profile.update',$user->id)}}" method="POST" class="form-horizontal">
                                    @csrf
                                    <input type="hidden" name="request_with" value="profile">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="first_name">{{ __('First Name')}}<span class="text-red">*</span></label>
                                                <input type="text"  pattern="[a-zA-Z]+.*" title="Please enter first letter alphabet and at least one alphabet character is required." title="Please enter first letter alphabet and at least one alphabet character is required." required placeholder="Enter your First Name" class="form-control" name="first_name" id="first_name" value="{{ $user->first_name }}">
                                            </div>  
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="last_name">{{ __('Last Name')}}</label>
                                                <input type="text"  pattern="[a-zA-Z]+.*" title="Please enter first letter alphabet and at least one alphabet character is required." title="Please enter first letter alphabet and at least one alphabet character is required." placeholder="Enter your Last Name" class="form-control" name="last_name" id="last_name" value="{{ $user->last_name }}">
                                            </div>  
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="email">{{ __('Email')}}<span class="text-red">*</span></label>
                                                <input  type="email" pattern="[a-zA-Z]+.*" title="Please enter first letter alphabet and at least one alphabet character is required." title="Please enter first letter alphabet and at least one alphabet character is required." placeholder="Enter your Email" class="form-control" name="email" id="email" value="{{ $user->email }}">
                                            </div>  
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="phone">{{ __('Phone No')}}</label>
                                                <input type="text" placeholder="123 456 7890" id="phone" pattern="^[0-9]*$" min="0"  name="phone" class="form-control" value="{{ $user->phone }}">
                                            </div>  
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="gender">{{ __('Gender')}}</label>
                                                <div class="form-radio">
                                                    <div class="radio radio-inline">
                                                        <label>
                                                            <input type="radio" name="gender" value="Male" @checked(old('gender',$user->gender == 'Male'))>
                                                            <i class="helper"></i>{{ __('Male')}}
                                                        </label>
                                                    </div>
                                                    <div class="radio radio-inline">
                                                        <label>
                                                            <input type="radio" name="gender" value="Female" @checked(old('gender',$user->gender == 'Female'))>
                                                            <i class="helper"></i>{{ __('Female')}}
                                                        </label>
                                                    </div>
                                                </div>                                        
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="dob">{{ __('DOB')}}</label>
                                                <input class="form-control" type="date" name="dob" max="{{ now()->format('Y-m-d') }}" placeholder="Select your date" value="{{ $user->dob }}" />
                                                <div class="help-block with-errors"></div>
                                            </div>  
                                        </div> 
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="pincode">{{ __('Timezone')}}</label>
                                                <select name="timezone" class="form-control select2" id="timezone">
                                                    @foreach ($timezones as  $timezone)
                                                        <option value="{{ $timezone}}" @selected($timezone == $user->timezone) >{{ $timezone }}</option>
                                                    @endforeach
                                                </select>
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="pincode">{{ __('Bio')}}</label>
                                                <textarea class="form-control" name="bio" id="" placeholder="Enter your bio.." cols="30" rows="2">{{ $user->bio }}</textarea>
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>                                  
                                    </div>
                                    <button type="submit" class="btn btn-success">Update</button>
                                </form>
                            </div>
                        </div>
                        <div class="tab-pane fade @if(request()->has('active') && request()->get('active') == "account") show active @endif" id="current-month" role="tabpanel" aria-labelledby="pills-timeline-tab">
                            <div class="card-body">
                                <form class="row" action="{{route('admin.profile.update.password',$user->id)}}" method="POST">
                                    @csrf
                                    <input type="hidden" name="request_with" value="password">
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label for="password">New Password</label>
                                                <input type="password"   pattern="[a-zA-Z]+.*" title="Please enter first letter alphabet and at least one alphabet character is required." title="Please enter first letter alphabet and at least one alphabet character is required."class="form-control" name="password" placeholder="New Password" id="password">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="confirm-password">Confirm Password</label>
                                        <input type="password"  pattern="[a-zA-Z]+.*" title="Please enter first letter alphabet and at least one alphabet character is required." title="Please enter first letter alphabet and at least one alphabet character is required." class="form-control" name="confirm_password" placeholder="Confirm Password" id="confirm-password">
                                    </div>
                                    <div class="col-md-12">
                                        <button class="btn btn-success" type="submit">Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="tab-pane fade @if(request()->has('active') && request()->get('active') == "security") show active @endif" id="security" role="tabpanel" aria-labelledby="pills-security-tab">
                            <form action="{{ route('mfa-store') }}" method="post">
                                @csrf
                                <input type="hidden" name="secret_key" value="{{ $secret }}">
                                @if (auth()->user()->google2fa_secret == null)
                                    <div class="card-body text-center">
                                        <h6 class="fw-700 mb-0">Setup MFA</h6>
                                        <div>
                                            {!! $QR_Image !!}
                                            <hr>
                                            {{-- Use Secret Key: {{ $secret }} --}}
                                        </div>
                                        <div class="text-center text-muted w-75 mx-auto mb-4">
                                            Set up your two factor authentication by scanning the barcode below. <br> Use <b><a href="https://safety.google/authentication/">Google Authenticator</a></b> app for continuing.
                                        </div>
        
                                        <button class="btn btn-success">I've Scanned QR</button>
                                        </div>
                                    </div>
                                @else
                                    <div class="card-body text-center">
                                        <h6 class="fw-700 mb-0">Two-Factor Authentication</h6>
                                        <p class="text-muted mb-4">Two-factor authentication is currently enabled.</p>
                                        <a href="{{route('mfa-enabled')}}" class="btn btn-danger">Scan again</a>
                                    </div>
                                @endif
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal --}}
    <div class="modal fade" id="updateProfileImageModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="updateProfileImageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <form action="{{route('admin.profile.update.profile-img',$user->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="request_with" value="profile_img">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="updateProfileImageModalLabel">Update profile image</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body text-center">
                        @csrf
                        <img src="{{ ($user && $user->avatar) ? $user->avatar : asset('admin/default/default-avatar.png') }}" class="img-fluid w-50 mx-auto d-block" alt="" id="profile-image">
                        <div class="form-group mt-5">
                            <label for="avatar" class="form-label">Select profile image</label> <br>
                            <input type="file" name="avatar" id="avatar" accept="image/jpg,image/png,image/jpeg">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @push('script') 
        <script src="{{ asset('admin/plugins/datedropper/datedropper.min.js') }}"></script>
        <script src="{{ asset('admin/js/form-picker.js') }}"></script>
        <script src="{{ asset('admin/plugins/select2/dist/js/select2.min.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/clipboard.js/1.5.12/clipboard.min.js"></script>
        <script>
            $('.active-swicher').on('click', function() {
                var active = $(this).attr('data-active');
                updateURL('active',active);
            });
            function getStates(countryId = 101) {
				$.ajax({
					url: '{{ route("world.get-states") }}',
					method: 'GET',
					data: {
						country_id: countryId
					},
					success: function(res) {
						$('#state').html(res).css('width', '100%').select2();
					}
				})
			}
			
			function getCities(stateId = 101) {
				$.ajax({
					url: '{{ route("world.get-cities") }}',
					method: 'GET',
					data: {
						state_id: stateId
					},
					success: function(res) {
						$('#city').html(res).css('width', '100%').select2();
					}
				})
			}
    
        	// Country, City, State Code
			$('#state, #country, #city').css('width', '100%').select2();
			
            getStates(101);
			$('#country').on('change', function(e) {
				getStates($(this).val());
			})
		
			$('#state').on('change', function(e) {
				getCities($(this).val());
			})
			function getStateAsync(countryId) {
				return new Promise((resolve, reject) => {
					$.ajax({
						url: '{{ route("world.get-states") }}',
						method: 'GET',
					data: {
						country_id: countryId
					},
					success: function (data) {
						$('#state').html(data);
						$('.state').html(data);
					resolve(data)
					},
					error: function (error) {
					reject(error)
					},
				})
				})
			}
			function getCityAsync(stateId) {
				if(stateId != ""){
					return new Promise((resolve, reject) => {
						$.ajax({
							url: '{{ route("world.get-cities") }}',
							method: 'GET',
							data: {
								state_id: stateId
							},
							success: function (data) {
								$('#city').html(data);
								$('.city').html(data);
							resolve(data)
							},
							error: function (error) {
							reject(error)
							},
						})
					})
				}
			}
            $(document).ready(function(){
                var country = "{{ $user->country_id }}";
                var state = "{{ $user->state_id }}";
                var city = "{{ $user->city_id }}";
                if(state){
                    getStateAsync(country).then(function(data){
                        $('#state').val(state).change();
                        $('#state').trigger('change');
                    });
                }
                if(city){
                    $('#state').on('change', function(){
                        if(state == $(this).val()){
                            getCityAsync(state).then(function(data){
                                $('#city').val(city).change();
                                $('#city').trigger('change');
                            });
                        }
                    });
                }
            });
        </script>
    @endpush
@endsection

