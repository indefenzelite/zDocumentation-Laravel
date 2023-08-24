@extends('layouts.main')
@section('title', 'Show User')
@section('content')
    @push('head')
        <link rel="stylesheet" href="{{ asset('admin/plugins/select2/dist/css/select2.min.css') }}">
        <link rel="stylesheet" href="{{ asset('admin/plugins/mohithg-switchery/dist/switchery.min.css') }}">
        <style>
            .dt-button.dropdown-item.buttons-columnVisibility.active{
                background: #322d2d !important;
            }
        </style>
    @endpush

    <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-user bg-blue"></i>
                        <div class="d-inline">
                            <h5>{{ Str::limit($user->full_name,20) }}</h5>
                            <span>User Profile</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('admin.dashboard.index') }}"><i class="ik ik-home"></i></a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="#">{{ __('Customer') }}</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">{{ __('Profile') }}</li>
                        </ol>
                    </nav>

                </div>
            </div>
        </div>

        @include('admin.include.message')

        <div class="row">
            <div class="col-lg-4 col-md-5">
                <div class="card">
                    <div class="card-body">
                        <div class="text-center">
                            <div class="d-flex">
                                <div class="" style="position: relative">
                                    <a href="{{route('admin.users.login-as',$user->id)}}" class="text-danger">
                                        <span title="Login As User">
                                            <i class="fa fa-right-to-bracket "></i> 
                                        </span>
                                    </a>
                                </div>
                                <div style="width: 150px; height: 150px; position: relative" class="mx-auto">
                                    <img src="{{ ($user && $user->avatar) ? $user->avatar : asset('admin/default/default-avatar.png') }}" class="rounded-circle" width="150" style="object-fit: cover; width: 150px; height: 150px" />
                                    <button class="btn btn-dark rounded-circle position-absolute" style="width: 30px; height: 30px; padding: 8px; line-height: 1; top: 0; right: 0"  data-toggle="modal" data-target="#updateProfileImageModal"><i class="ik ik-camera"></i></button>
                                </div>
                                <div class="dropdown d-flex" style="margin-bottom: 130px;">
                                    <button style="background: transparent;border:none;" class="dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="ik ik-more-vertical"></i></button>
                                    <ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">
                                        @if(env('DEV_MODE') == 1)
                                            <a><li class="dropdown-item text-dark fw-700">Send User Credentials</li></a>
                                        @endif
                                    </ul>
                                </div>
                                
                                
                            </div>
                            <h5 class="mb-0 mt-3">
                                {{ Str::limit($user->full_name,20) }} 
                                @if($user->is_verified == 1)<strong class="mr-1"><i class="ik ik-check-circle"></i></strong>@endif
                            </h5>
                            <span class="text-muted fw-600">Role: {{ UserRole($user->id)->display_name }} 
                            </span>
                            @if(getSetting('wallet_activation') == 1)
                                <div class=" mt-2">
                                    <a class="btn btn-outline-light text-dark border" href="{{ route('admin.wallet-logs.index',$user->id) }}">
                                        <i class="fa fa-wallet pr-1"></i>Wallet Balance:
                                        {{format_price($user->wallet)}}
                                    </a>
                                </div>
                            @endif


                            <a href="{{route('admin.users.edit',secureToken($user->id))}}" class="btn btn-link" >
                                <span title="Edit User"><i class="fa fa-edit"></i></span> Edit
                            </a>
                        </div>
                    </div>
                    <hr class="mb-0">
                    <div class="card-body">
                        <small class="text-muted d-block">{{ __('Email address') }}</small>
                        <div class="d-flex justify-content-between"> 
                            <h6 style="overflow-wrap: anywhere;"><span><i class="ik ik-mail mr-1"></i><a href="mailto:{{ $user->email ?? '' }}" id="copyemail">{{ $user->email ?? '' }}</a></span></h6>
                            <span class="text-copy"title="Copy" data-clipboard-target="#copyemail">
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
                        @if(UserRole($user->id)->name != 'admin')
                            <li class="nav-item">
                                <a data-active="account-verfication" class="nav-link active-swicher @if(request()->has('active') && request()->get('active') == "account-verfication" || !request()->has('active')) active @endif" id="pills-note-tab" data-toggle="pill" href="#kyc-tab" role="tab" aria-controls="pills-note" aria-selected="false">{{ __('Account Verification')}}</a>
                            </li>
                        @endif
                        <li class="nav-item">
                            <a data-active="password-tab" class="nav-link active-swicher @if(UserRole($user->id)->name == 'admin' || request()->has('active') && request()->get('active') == "password-tab" ) active @endif" id="pills-password-tab" data-toggle="pill" href="#password-tab" role="tab" aria-controls="pills-password" aria-selected="false">{{ __('Change Password')}}</a>
                        </li>
                      
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                        @if(UserRole($user->id)->name != 'admin')
                            <div class="tab-pane fade  @if(request()->has('active') && request()->get('active') == "account-verfication" || !request()->has('active')) show active @endif" id="kyc-tab" role="tabadmin" aria-labelledby="pills-note-tab">
                                @include('admin.users.includes.kyc')
                            </div>
                        @endif
                        <div class="tab-pane fade @if(UserRole($user->id)->name == 'admin' || request()->has('active') && request()->get('active') == "password-tab") show active @endif" id="password-tab" role="tabadmin" aria-labelledby="pills-setting-tab">
                            @include('admin.users.includes.change-password')
                        </div>   
                    </div>
                </div>
                {{-- tab end --}}
                {{-- Modals Start--}}

                <div class="modal fade" id="updateProfileImageModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="updateProfileImageModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <form action="{{ route('admin.profile.update.profile-img', $user->id) }}" method="POST" enctype="multipart/form-data" onsubmit="return checkCoords();">
                            @csrf
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="updateProfileImageModalLabel">Update profile image</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body text-center py-">
                                  
                                    <img  src="{{ ($user && $user->avatar) ? asset($user->avatar) : asset('admin/default/default-avatar.png') }}"
                                     class="mx-auto d-block" alt="" id="avatar_file">

                                    <div class="form-group mt-5">
                                        <label for="avatar" class="form-label">Select profile image</label> <br>
                                        <input type="file" name="avatar" id="avatar" accept="image/jpg,image/png,image/jpeg" class="form-control">
                                    </div>
                                    <div class="">
                                        <button type="submit" class="btn btn-success" id="w" >Update</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                {{-- Modals End--}}

            </div>
            
        </div>
    </div>
    @include('admin.users.includes.contacts.create')
    @include('admin.users.includes.contacts.edit')
    @include('admin.users.includes.notes.create')
    @include('admin.users.includes.notes.edit')
    @include('admin.users.includes.addresses.create')
    @include('admin.users.includes.addresses.edit')
    @include('admin.users.includes.bank-details.create')
    @include('admin.users.includes.bank-details.edit')
   @push('script') 
    
    <script src="{{ asset('admin/plugins/mohithg-switchery/dist/switchery.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/select2/dist/js/select2.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/clipboard.js/1.5.12/clipboard.min.js"></script>

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
                if(typeof(response) != "undefined" && response !== null && response.status == "success"){
                }
            });
        </script>
    {{-- END AJAX FORM INIT --}}

    {{-- START JS HELPERS INIT --}}
        <script>
            $(document).ready(function() {
                var table = $('.data_table').DataTable({
                    responsive: true,
                    fixedColumns: true,
                    fixedHeader: true,
                    scrollX: false,
                    'aoColumnDefs': [{
                        'bSortable': false,
                        'aTargets': ['nosort']
                    }],
                    dom: "<'row'<'col-sm-2'l><'col-sm-7 text-center'B><'col-sm-3'f>>tipr",
                    buttons: [{
                            extend: 'excel',
                            className: 'btn-sm btn-success',
                            header: true,
                            footer: true,
                            exportOptions: {
                                columns: ':visible',
                            }
                        },
                    ]

                });
            });
    
            document.getElementById('avatar').onchange = function () {
                var src = URL.createObjectURL(this.files[0])
                $('#avatar_file').removeClass('d-none');
                document.getElementById('avatar_file').src = src              
            }
            function updateCoords(im,obj){
                $('#x').val(obj.x1);
                $('#y').val(obj.y1);
                $('#w').val(obj.width);
                $('#h').val(obj.height);
            }
            
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
                        $('#stateEdit').html(data);
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
                                $('#cityEdit').html(data);
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
                $('.accept').on('click',function(){
                    $('#status').val(1)
                });
                $('.reject').on('click',function(){
                    $('#status').val(2)
                });
                $('.reset').on('click',function(){
                    $('#status').val(0)
                });
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
            $(function(){
                new Clipboard('.text-copy');
            });
            $('.edit-note').each(function() {
                $(this).click(function() {
                    var data = $(this).data('item');
                    $('#note-type_id').val(data.type_id);
                    $('#note-title').val(data.title);
                    $('#note-description').val(data.description);
                    var url = "{{ url('/admin/user-notes/update') }}" + '/' + data.id;
                    $('#editNoteForm').attr('action', url);
                    $('#editModalCenter').modal('show');
                })
            });
            $('.edit-contact').each(function() {
                $(this).click(function() {
                    var contact = $(this).data('contact');
                    $('#edit_type_id').val(contact.type_id);
                    $('#edit_first_name').val(contact.first_name);
                    $('#edit_last_name').val(contact.last_name);
                    $('#edit_job_title').val(contact.job_title);
                    $('#edit_job_title').val(contact.job_title);
                    $('#edit_email').val(contact.email);
                    $('#edit_job_title').val(contact.job_title);
                    $('#edit_phone').val(contact.phone);
                    if (contact.gender == 'male') {
                        $('.male-radio').attr('checked',true)
                    } else {
                        $('.female-radio').attr('checked',true)
                    }
                    var url = "{{ url('/admin/contacts/update') }}" + '/' + contact.id;
                    $('#editContactForm').attr('action', url);
                    $('#editContact').modal('show');
                })
            });
            $('.editAddress').click(function(){
                var  address = $(this).data('id');
                var details = address.details;
                if(details.type == 0){
                    $('.homeInput').attr("checked", "checked");
                }else{
                    $('.officeInput').attr("checked", "checked");
                }
                
                $('#editName').val(details.name);
                $('#id').val(address.id);
                $('#addressId').val(address.id);
                $('#user_id').val(address.user_id);
                $('#type').val(address.type);
                $('#editPhone').val(details.phone); 
                $('#editAddress').val(details.address_1);
                $('#editAddress_2').val(details.address_2);
                $('#pincode_id').val(details.pincode_id);
                $('#countryEdit').val(details.country_id).change();
                getStateAsync(details.country_id).then(function(data){
                    $('#stateEdit').val(details.state_id).change();
                    $('#stateEdit').trigger('change');
                });
                getCityAsync(details.state_id).then(function(data){
                    $('#cityEdit').val(details.city).change();
                    $('#cityEdit').trigger('change');
                });
                $('#editAddressModal').modal('show');
            });

            $(document).on('click','.addPayoutDetailBtn',function(){
                $('#bankDetailsModalCenter').modal('show');
            });
            $(document).on('click','.editPayoutDetailBtn',function(){
                let record = $(this).data('row');
                console.log(record);
                let payload = $(this).data('payload');
                console.log(payload);
                if(record.type == "Saving")
                    $('#editsaving').prop('checked',true);
                else
                    $('#editcurrent').prop('checked',true);
                
                $('#payoutdetailId').val(record.id);
                $('#editAcountHolderName').val(payload.account_holder_name);
                $('#editAccountNo').val(payload.account_no);
                $('#editIfscCode').val(payload.ifsc_code);
                $('#editBranch').val(payload.branch);
                $('#editbank option[value="'+payload.bank_name+'"]').prop('selected',true);
                $('#editBankDetailsModal').modal('show');
            });
            $('.active-swicher').on('click', function() {
                var active = $(this).attr('data-active');
                updateURL('active',active);
            });
        </script>
    {{-- END JS HELPERS INIT --}}
    @endpush
@endsection
