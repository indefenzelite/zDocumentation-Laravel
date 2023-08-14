@extends('layouts.main') 
@section('title', $user->full_name)
@section('content')
    <!-- push external head elements to head -->
    @push('head')
        <link rel="stylesheet" href="{{ asset('admin/plugins/select2/dist/css/select2.min.css') }}">
        <link rel="stylesheet" href="{{ asset('admin/plugins/tempusdominus-bootstrap-4/build/css/tempusdominus-bootstrap-4.min.css') }}">
        <link rel="stylesheet" href="{{ asset('admin/plugins/jquery-minicolors/jquery.minicolors.css') }}">
        <link rel="stylesheet" href="{{ asset('admin/plugins/datedropper/datedropper.min.css') }}">
        <link rel="stylesheet" href="{{ asset('admin/plugins/mohithg-switchery/dist/switchery.min.css') }}">
    @endpush

    
    <div class="container-fluid">
    	<div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-user-plus bg-blue"></i>
                        <div class="d-inline">
                            {{-- @dd(UserRole($user->id)) --}}
                            @if(UserRole($user->id)->name == 'admin')
                                <h5>{{$user->full_name}}</h5>
                                <span>{{ __('Edit admin')}}</span>
                            @else
                                <h5>{{ __('Edit User')}}</h5>
                                <span>{{ __('Edit user, assign roles & permissions')}}</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{url('/')}}"><i class="ik ik-home"></i></a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="#">{{ __('User')}}</a>
                            </li>
                            <li class="breadcrumb-item">
                                {{ Str::limit($user->full_name,20)}}
                            </li>

                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <form class="forms-sample ajaxForm" method="POST" action="{{ route('admin.users.update',$user->id) }}" >
        <div class="row">
            <!-- start message area-->
            @include('admin.include.message')
            <!-- end message area-->
            @csrf
                <input type="hidden" name="id" value="{{$user->id}}">
                <input type="hidden" name="request_with" value="update">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h3>{{ __('Personal Details')}}</h3>
                            <button type="submit" class="btn btn-primary">{{ __(' Save & Update')}}</button>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="first_name">{{ __('First Name')}}<span class="text-red">*</span></label>
                                        <a href="javascript:void(0);" title="@lang('admin/tooltip.edit_user_first_name')"><i class="ik ik-help-circle text-muted ml-1"></i></a>
                                        <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ $user->first_name }}" placeholder="Enter First Name" required>
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
                                        <a href="javascript:void(0);" title="@lang('admin/tooltip.edit_user_last_name')"><i class="ik ik-help-circle text-muted ml-1"></i></a>
                                        <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ $user->last_name }}" placeholder="Enter Last Name" required>
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
                                        <label for="email">{{ __('Email')}}<span class="text-red">*</span></label>
                                         <a href="javascript:void(0);" title="@lang('admin/tooltip.edit_user_email')"><i class="ik ik-help-circle text-muted ml-1"></i></a>
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" maxlength="30" max="30"  name="email"  required value="{{ $user->email}}" required>
                                        <div class="help-block with-errors"></div>
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div> 
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phone">{{ __('Contact Number')}}<span class="text-red">*</span></label>
                                        <a href="javascript:void(0);" title="@lang('admin/tooltip.edit_user_phone')"><i class="ik ik-help-circle text-muted ml-1"></i></a>
                                        <input id="phone" type="number" class="form-control" name="phone" pattern="^[0-9]*$" min="0"  placeholder="Enter Contact Number"  required value="{{ $user->phone }}" >
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                            
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="gender">{{ __('Gender')}}</label>
                                        <a href="javascript:void(0);" title="@lang('admin/tooltip.edit_user_gender')"><i class="ik ik-help-circle text-muted ml-1"></i></a>
                                        <div class="form-radio">
                                            <div class="radio radio-inline">
                                                <label>
                                                    <input type="radio" name="gender" value="Male"   {{ $user->gender == 'Male' ? 'checked' : '' }}>
                                                    <i class="helper"></i>{{ __('Male')}}
                                                </label>
                                            </div>
                                            <div class="radio radio-inline">
                                                <label>
                                                    <input type="radio" name="gender" value="Female"  {{ $user->gender == 'Female' ? 'checked' : '' }}>
                                                    <i class="helper"></i>{{ __('Female')}}
                                                </label>
                                            </div>
                                        </div>                                        
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="role" required >{{ __('Assign Role')}}<span class="text-red">*</span></label>
                                        <a href="javascript:void(0);" title="@lang('admin/tooltip.edit_user_role')"><i class="ik ik-help-circle text-muted ml-1"></i></a>
                                        <select name="role" id="role" class="form-control select2">
                                            <option value="" readonly>Select Role</option>
                                            @foreach ($roles as $role)
                                                <option value="{{ $role }}" @selected($user->role_name == $role)>{{ $role}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                {{-- @dd($user); --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="dob">{{ __('DOB')}}</label>
                                        <a href="javascript:void(0);" title="@lang('admin/tooltip.edit_user_dob')"><i class="ik ik-help-circle text-muted ml-1"></i></a>
                                        <input class="form-control" type="date" name="dob" placeholder="Select your date" max="{{ now()->format('Y-m-d') }}" value="{{ $user->dob }}" />
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group mt-35">
                                        <label for="send_mail">{{ __('Send Mail')}} </label>
                                        <input type="checkbox" name="send_mail" value="1" @if($user->send_mail == 1) checked @endif> 
                                        <a href="javascript:void(0);" title="@lang('admin/tooltip.edit_user_send_mail')"><i class="ik ik-help-circle text-muted ml-1"></i></a>                                      
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-6 d-none">
                                    <div class="form-group mt-30">
                                        <label for="status">{{ __('Status')}}  </label>
                                        <input class="js-switch switch-input" @if(old('status')) checked @endif
                                            name="status" type="checkbox" id="status" value="1"checked>
                                        {{-- <select required name="status" class="form-control select2">
                                            @foreach($statuses as $key => $status)
                                                <option value="{{ $key }}" @selected($user->status == $key)>{{$status['label']}}</option>
                                            @endforeach
                                        </select> --}}    
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h3>Verification</h3>
                        </div>
                        <div class="card-body">
                            {{-- <div class="fw-700 alert alert-info mb-2">This form does not need to be filled out if you do not wish to change your password.</div> --}}
                            {{-- <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="password">{{ __('Password')}}</label>
                                        <a href="javascript:void(0);" title="@lang('admin/tooltip.edit_user_password')"><i class="ik ik-help-circle text-muted ml-1"></i></a>
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Enter password">
                                        <div class="help-block with-errors"></div>
    
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="password-confirm">{{ __('Confirm Password')}}</label>
                                        <a href="javascript:void(0);" title="@lang('admin/tooltip.edit_user_password_confirmation')"><i class="ik ik-help-circle text-muted ml-1"></i></a>
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Retype password">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                            </div> --}}
                            <div class="">
                                @php
                                    $kyc_record = null;
                                    if($user_kyc && isset($user_kyc->details) && $user_kyc->details != null){
                                        $kyc_record = json_decode($user_kyc->details,true);
                                    }
                                @endphp
                                <div class="card-body">
                                    {{-- Status --}}
                                    @if(isset($user_kyc) && $user_kyc->status == 0)
                                       <div class="alert alert-info">
                                           <i class="ik ik-alert-triangle"></i> Verification request isn't submitted yet!
                                       </div>
                                   @elseif(isset($user_kyc) && $user_kyc->status == 1)
                                       <div class="alert alert-success">
                                           User Verification request has been verified!
                                       </div>
                                   @elseif(isset($user_kyc) && $user_kyc->status == 2)
                                       <div class="alert alert-danger">
                                           User Verification request has been rejected!
                                       </div>
                                   @elseif(isset($user_kyc) && $user_kyc->status == 3)
                                      <div class="alert alert-warning">
                                           User submited Verification request, Please validate and take appropriated action.
                                       </div>
                                   @else 
                                        <div class="alert alert-info p-2">
                                            User havn't submitted Verification Request yet!
                                        </div>    
                                   @endif
                            
                                    <form action="{{ route('admin.users.update-kyc-status') }}" method="POST" class="form-horizontal">
                                     @csrf
                                        <input id="status" type="hidden" name="status" value="">
                                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                                        <div class="row">
                                            <div class="col-md-6 col-6"> <label>{{ __('Document')}}</label>
                                                <br>
                                                <h5 class="strong text-muted">{{ $kyc_record['document_type'] ?? '--' }}</h5>
                                            </div>
                                            <div class="col-md-6 col-6"> <label>{{ __('Unique Identifier')}}</label>
                                                <br>
                                                <h5 class="strong text-muted">{{ Str::limit($kyc_record['document_number'] ?? '--',25)}}</h5>
                                            </div>
                                            <div class="col-md-6 col-6"> <label>{{ __('Front Side')}}</label>
                                                <br>
                                                    @if ($kyc_record != null && $kyc_record['document_front'] != null)
                                                        <a href="{{ asset($kyc_record['document_front']) }}" target="_blank" class="btn btn-outline-danger">View Attachment</a>
                                                    @else 
                                                        <button disabled class="btn btn-secondary">Not Submitted</button>    
                                                    @endif
                                            </div>
                                            <div class="col-md-6 col-6"> <label>{{ __('Back Side')}}</label>
                                                <br>
                                                @if ($kyc_record != null && $kyc_record['document_back'] != null)
                                                    @if ($kyc_record != null && $kyc_record['document_back'] != null)
                                                        <a href="{{ asset($kyc_record['document_back']) }}" target="_blank" class="btn btn-outline-danger">View Attachment</a>
                                                    @else 
                                                        <button disabled class="btn btn-secondary">Not Submitted</button>    
                                                    @endif
                                                @else 
                                                    <button disabled class="btn btn-secondary">Not Submitted</button>    
                                                @endif
                                            </div>
                            
                            
                                            <hr class="m-2">
                            
                                            @if(AuthRole() == 'Admin')
                                                @if(isset($user_kyc) && $user_kyc->status == 1)
                                                    <div class="col-md-12 col-12 mt-5"> 
                                                        <label>{{ __('Note')}}</label>
                                                        <textarea class="form-control" name="remark" type="text" >{{ $Verification['admin_remark'] ?? '' }}</textarea>
                                                        <button type="submit" class="btn btn-danger mt-2 btn-lg reject">Reject</button>
                                                    </div>
                                                @elseif(isset($user_kyc) && $user_kyc->status == 2)
                                                    <div class="col-md-12 col-12 mt-5"> 
                                                        <button type="submit" class="btn btn-warning mt-2 btn-lg reset">Reset</button>
                                                    </div>
                                                @elseif(isset($user_kyc) && $user_kyc->status == 3)
                                                    <div class="col-md-12 col-12 mt-5"> <label>{{ __('Rejection Reason (If Any)')}}</label>
                                                        <textarea class="form-control" name="remark" type="text" >{{ $kyc_record['admin_remark'] ?? '' }}</textarea>
                                                        <button  type="submit" class="btn btn-danger mt-2 btn-lg reject">Reject</button>
                                                        <button type="submit" class="btn btn-success accept ml-5 accept mt-2 btn-lg">Accept</button>
                                                    </div>
                                                @endif
                                            @endif    
                                        </div>
                                    </form>
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
       
        <!--get role wise permissiom ajax script-->
        <script src="{{ asset('admin/js/get-role.js') }}"></script>
        <script src="{{ asset('admin/plugins/moment/moment.js') }}"></script>
        <script src="{{ asset('admin/plugins/tempusdominus-bootstrap-4/build/js/tempusdominus-bootstrap-4.min.js') }}"></script>
        <script src="{{ asset('admin/plugins/jquery-minicolors/jquery.minicolors.min.js') }}"></script>
        <script src="{{ asset('admin/plugins/datedropper/datedropper.min.js') }}"></script>
        <script src="{{ asset('admin/js/form-picker.js') }}"></script>
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
                let route = $(this).attr('action');
                let method = $(this).attr('method');
                let data = new FormData(this);
                let response = postData(method,route,'json',data,null,null);
                console.log(response);
                if(typeof(response) != "undefined" && response !== null && response.status == "success"){
                    let redirectUrl = "{{url('admin/users')}}"+'?role='+response.role;
                    console.log(redirectUrl);
                    window.location.href = redirectUrl;
                }
            })
        </script>
        {{-- END AJAX FORM INIT --}}

        {{-- START JS HELPERS INIT --}}
        <script>
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
			
			$('#country').on('change', function(e) {
				getStates($(this).val());
			})
		
			$('#state').on('change', function(e) {
				getCities($(this).val());
			})

			 // this functionality work in edit page
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
        {{-- END JS HELPERS INIT --}}
    @endpush
@endsection
