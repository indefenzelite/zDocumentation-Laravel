@extends('layouts.user')

@section('meta_data')
    @php
		$meta_title = 'Setting | '.getSetting('app_name');		
		$meta_description = '' ?? getSetting('seo_meta_description');
		$meta_keywords = '' ?? getSetting('seo_meta_keywords');
		$meta_motto = '' ?? getSetting('site_motto');		
		$meta_abstract = '' ?? getSetting('site_motto');		
		$meta_author_name = '' ?? 'Defenzelite';		
		$meta_author_email = '' ?? 'support@defenzelite.com';		
		$meta_reply_to = '' ?? getSetting('app_email');		
		$meta_img = ' ';		
		$customer = 1;		
	@endphp
@endsection
<style>
    .alert-danger{
        color: #892631 !important;
        background-color: #fad9dc !important;
        border-color: #f7c5cb !important;
    }
</style>

@section('content')
<!-- Profile Start -->
<section class="section mt-60">
    <div class="container mt-lg-3">
        <div class="row">
            @include('user.include.sidebar')
            <div class="col-lg-8 col-12">
                @if($errors->any())
                    @foreach($errors->all() as $error)
                        <div class="alert alert-danger alert-dismissible fade show my-1" role="alert">
                            {{ $error }}
                            <button type="button" class="close btn-close" data-bs-dismiss="alert" aria-label="Close">
                                <i class="uil uil-times"></i>
                            </button>
                        </div>
                    @endforeach
                @endif
                <div class="card border-0 rounded shadow bg-white">
                    <ul class="nav nav-pills custom-pills mb-0 wrapper_pills bg-white" id="pills-tab" role="tablist" style="border-bottom: 1px solid #ccc8c8;">
                        <li class="nav-item ">
                            <a data-active="my_info" class="mr-2 customer_tabs btn pills-btn active-swicher  @if(!request()->has('active') || request()->get('active') == "my_info") active @endif" href="#">{{ __('General')}}</a>
                        </li>
                        <li class="nav-item">
                            <a data-active="address_info" class="mr-2 customer_tabs active-swicher pills-btn btn  @if(request()->get('active') == "address_info") active @endif" >{{ __('My Address')}}</a>
                        </li>
                        @if(getSetting('ekyc_verification_activation') == 1)
                        <li class="nav-item">
                            <a data-active="ekyc_info" class="mr-2 customer_tabs active-swicher pills-btn btn  @if(request()->get('active') == "ekyc_info") active @endif" >{{ __('Account Verification')}}</a>
                        </li>
                        <li class="nav-item">
                            <a data-active="bank_info" class="mr-2 customer_tabs active-swicher pills-btn btn  @if(request()->get('active') == "bank_info") active @endif" >{{ __('Bank Detalis')}}</a>
                        </li>
                        @endif
                        <li class="nav-item">
                            <a data-active="password" class="mr-2 customer_tabs active-swicher pills-btn btn @if(request()->get('active') == "password") active @endif">{{ __('Security')}}</a>
                        </li>
                            {{-- <li class="nav-item">
                                <a data-active="notification" class="mr-2 customer_tabs active-swicher pills-btn btn @if(request()->get('active') == "notification") active @endif">{{ __('Preferences')}}</a>
                            </li> --}}
                    </ul>
                <div class="card-body">
                    <div class="customer_card card-my_info">
                        <h5 class="text-md-start text-center">Personal Detail :</h5>
                        <div class="mt-3 text-md-start text-center d-sm-flex">
                            <img src="{{ getAuthProfileImage(auth()->user()->avatar ) }}" class="avatar float-md-left avatar-medium rounded-circle shadow me-md-4" alt="">
                            <div class="mt-md-4 mt-3 mt-sm-0">
                                <a href="javascript:void(0)" id="changeProfileModal" class="btn btn-outline-warning btn-sm mt-2 " required >Change Picture</a>
                            </div>
                        </div>
                        <form class="row mt-4" action="{{ route('user.setting.store',auth()->id()) }}" method="post">
                            @csrf
                            <input type="hidden" name="request_with" value="create">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">First Name</label>
                                    <div class="form-icon position-relative">
                                        <i data-feather="user" class="fea icon-sm icons"></i>
                                        <input name="first_name" id="first" type="text" maxlength="20" required class="form-control ps-5" placeholder="First Name :" value="{{ auth()->user()->first_name }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Last Name</label>
                                    <div class="form-icon position-relative">
                                        <i data-feather="user" class="fea icon-sm icons"></i>
                                        <input name="last_name" id="last" type="text"maxlength="20" class="form-control ps-5" placeholder="Last Name :" value="{{ auth()->user()->last_name }}">
                                    </div>
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Contact Number</label>
                                    <div class="form-icon position-relative">
                                        <i data-feather="phone" class="fea icon-sm icons"></i>
                                        <input name="phone" id="phone" type="number" pattern="^[0-9]*$" min="0" class="form-control ps-5" placeholder="Phone :" value="{{ auth()->user()->phone}}">
                                    </div>
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Email Address</label>
                                    <div class="form-icon position-relative">
                                        <i data-feather="mail" class="fea icon-sm icons"></i>
                                        <input name="email" id="email" type="email"  required class="form-control ps-5" maxlength="30"value="{{ auth()->user()->email }}" placeholder="Your email :">
                                    </div>
                                </div> 
                            </div>
                            <!--end col-->

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Date Of Birth</label>
                                        <input required name="dob" id="dob" type="date" class="form-control" max="{{ now()->format('Y-m-d') }}" placeholder=""value="{{ auth()->user()->dob }}">
                                    </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" style="margin-right: 20px;">Your Gender</label>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <div class="form-check mb-0">
                                            <input class="form-check-input" @if($user->gender == 'Male') checked @endif type="radio" name="gender" id="gender1" value="Male">
                                            <label class="form-check-label" for="gender1">Male</label>
                                        </div>
                                    </div>
                                    
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <div class="form-check mb-0">
                                            <input class="form-check-input" type="radio" name="gender" id="gender2" @if($user->gender == 'Female') checked @endif value="Female">
                                            <label class="form-check-label" for="gender2">Female</label>
                                        </div>
                                    </div>

                                </div> 
                            </div>
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label class="form-label">About You</label>
                                    <div class="form-icon position-relative">
                                        <i data-feather="message-circle" class="fea icon-sm icons"></i>
                                        <textarea name="bio" id="comments" rows="4" class="form-control ps-5" placeholder="Bio :">{{ auth()->user()->bio }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <input type="submit" id="submit" class="btn btn-primary" value="Save Changes">
                            </div>
                            <!--end col-->
                        </form>
                        <!--end row-->
                    </div>
                    <div class="customer_card card-address_info">
                        <div class="d-flex justify-content-between">
                            <h5>Address :</h5>
                            <a href="javascript:void(0)" class="btn btn-sm btn-primary add-address">Add Address</a>
                        </div>
                        <div class="border-bottom pb-4">
                            <div class="row mt-2">
                                @forelse ($addresses as $address)
                                    @php
                                        $address_decoded = $address->details;
                                        if ($address_decoded != null){
                                            if(isset($address_decoded['country']) && $address_decoded['country']){
                                                $country = App\Models\Country::where('id',$address_decoded['country'])->first();
                                            }
                                            if(isset($address_decoded['state']) && $address_decoded['state']){
                                                $state = App\Models\State::where('id',$address_decoded['state'])->first();
                                            }
                                            if(isset($address_decoded['city']) && $address_decoded['city']){
                                                $city = App\Models\City::where('id',$address_decoded['city'])->first();
                                            }
                                        }
                                    @endphp
                                    <div class="col-lg-6">
                                        <div class="m-1 p-2 border rounded">
                                            <div class="mb-2">
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <h6 class="m-0 p-0">{{ $address_decoded['type'] == 0 ? 'Home' : 'Office' }} Address:</h6>
                                                    <div>
                                                        <a href="javascript:void(0)" class="text-primary editAddress h5 mb-0" title=""  data-id="{{$address}}"
                                                            data-original-title="Edit"><i class="uil uil-edit"></i></a>
                                                        <a href="{{ route('user.address.destroy',$address->id) }}"
                                                            class="text-primary delete-item h5 mb-0" title=""
                                                            data-original-title="delete"><i class="uil uil-trash"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="pt-4 border-top">
                                                <div class="">
                                                    <div>
                                                        <p class="text-muted mb-0">
                                                            <i class="uil uil-user"></i> 
                                                            {{@$address_decoded  ['name']}}<br>
                                                           <i class="uil uil-phone"></i> {{@$address_decoded[ 'phone']}}<br>
                                                           <i class="uil uil-home"></i> {{@$address_decoded['address_1'] }}.<br>
                                                            {{@$address_decoded['address_2'] }}.<br>
                                                            {{@$city->name ?? '' }}
                                                            {{@$state->name ?? '' }}-{{@$address_decoded['pincode_id']}} 
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty  
                                    <div class="col-lg-8 mx-auto text-center">
                                        @php
                                            $title = 'No Addresses yet!';
                                        @endphp
                                        @include('user.include.empty-record')
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div> 
                    @if(getSetting('ekyc_verification_activation') == 1)
                        @if (auth()->user()->ekyc_status == 2)
                        @php
                            $kyc_data = json_decode(auth()->user()->ekyc_info);
                        @endphp
                        @if(!is_null($kyc_data) && $kyc_data->admin_remark != null)
                            <div style="font-size: 16px;" class="alert alert-danger d-flex justify-content-between" role="alert">
                            <span class="m-0 p-0" style="line-height: 40px;">
                                {{ $kyc_data->admin_remark ?? '' }}
                            </span> 
                            </div>
                        @endif
                        @endif
                    <div class="customer_card card-ekyc_info ">
                        <div class="border-bottom">
                            <div class="d-flex justify-content-between mb-2">
                                <h5>Account Verification :</h5>
                                @if (!$user_kyc || $user_kyc->status == 2)
                                @elseif(isset($user_kyc) && $user_kyc->status == 1)  
                                <strong class="text-success">Verified</strong> 
                                
                                @elseif(isset($user_kyc) && $user_kyc->status == 2)  
                                <strong class="text-danger">Rejected</strong> 
                                @else
                                <strong class="text-danger">Under Approval</strong>
                                @endif
                            </div>
                           @if(isset($user_kyc) && $user_kyc->status == 3)
                            <div class="alert alert-light text-warning fade show my-1 mb-2" role="alert">
                                Your Kyc has been pending approval!
                            </div>
                           @elseif(isset($user_kyc) && $user_kyc->status == 2)
                            <div class="alert alert-light text-danger fade show my-1 mb-2" role="alert">
                                 Your Kyc has been rejected! Please resubmit with mentioned guidance.
                                    {{$user_kyc->admin_remark}}
                            </div>
                           @elseif(isset($user_kyc) && $user_kyc->status == 1 )
                            <div class="alert alert-light text-success fade show my-1 mb-2" role="alert">
                                 Your Kyc has been completed!
                            </div>
                           @endif
                        </div>
                            <form action="{{ route('user.setting.ekyc-verify') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" id="status" value="{{$user_kyc->status ?? 0}}">
                              <div class="row mt-2">
                                <div class="col-md-6 col-12"> 
                                    <div class="form-group">
                                        <label for="document_type">Document Type<span class="text-danger">*</span></label>
                                        <select class="form-control" name="document_type" required  @if(isset($user_kyc) && $user_kyc->status != 2) disabled @endif>
                                            <option value="" aria-readonly="true">Select Document Type</option>
                                            <option @if(isset($ekyc) && $ekyc['document_type'] == "Pan Card") selected @endif value="Pan Card" readonly>PAN CARD</option>
                                            <option @if(isset($ekyc) && $ekyc['document_type'] == "Aadhar Card") selected @endif value="Aadhar Card" readonly>AADHAR CARD</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12"> 
                                    <div class="form-group">
                                        <label for="document_number">Document Number<span class="text-danger">*</span></label>
                                        <input name="document_number" type="text" maxlength="15"class="form-control" value="{{ $ekyc['document_number'] ?? ' ' }}" placeholder="Enter Document Number">
                                    </div>
                                </div>
                                <div class="col-md-6 col-12"> 
                                    <div class="form-group">
                                        <label class="mt-2" for="document_front_attachment">Document Front Photo<span class="text-danger">*</span></label>
                                         <input class="form-control" name="document_front_attachment" accept=".jpg,.png,.jpeg,"size="" required type="file">
                                    </div>
                                </div>
                                <div class="col-md-6 col-12"> 
                                    <div class="form-group">
                                        <label class="mt-2" for="document_back_attachment">Document Back Photo<span class="text-danger">*</span></label>
                                         <input class="form-control" name="document_back_attachment" accept=".jpg,.png,.jpeg," required type="file">
                                    </div>
                                </div>
                                    <div class="col-md-6">  
                                        <div class="mb-3">
                                          
                                            <div class="form-icon position-relative">
                                                @if (isset($ekyc) && $ekyc['document_front'] != null)
                                                    <a href="{{ asset($ekyc['document_front']) ?? '' }}" target="_blank">
                                                        <span class="badge bg-info mt-2 p-2"><i class="uil uil-eye pr-2"></i> View Last Attachment</span>
                                                    </a>
                                                @else 
                                                    <span class="text-muted">Not uploaded yet!</span>    
                                                @endif 
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                           
                                            <div class="form-icon position-relative">
                                                @if (isset($ekyc) && $ekyc['document_back'] != null)
                                                    <a href="{{ asset($ekyc['document_back']) ?? '' }}" target="_blank">
                                                        <span class="badge bg-info mt-2 p-2"><i class="uil uil-eye pr-2"></i> View Last Attachment</span>
                                                    </a>
                                                @else 
                                                    <span class="text-muted">Not uploaded yet!</span>
                                                @endif

                                            </div>
                                        </div>
                                    </div>
                                <div class="col-12 text-right mt-2">
                                    @if(!isset($user_kyc))
                                        <div class="form-group">
                                            <input type="checkbox" name="hereBy" required id="hereBy">
                                            <label for="hereBy">I hereby certify that above attached documents are correct.</label>
                                        </div>
                                    @endif    

                                  <button type="submit" class="btn btn-outline-primary" id="submitButton">Submit</button>
                                </div>
                              </div>
                          </form>
                    </div>
                    @endif
                    <div class="customer_card card-bank_info">
                        <div class="d-flex justify-content-between">
                            <h5>Bank Details :</h5>
                            <a href="javascript:void(0)" class="btn btn-sm btn-primary addPayoutDetailBtn ">Add Bank Details</a>
                        </div>
                        <div class="border-bottom pb-4">
                            <div class="row mt-2">
                                @forelse ($payoutDetails as $payoutDetail)
                                    @php
                                        $paload_decodes = $payoutDetail->payload;
                                    @endphp
                                    <div class="col-lg-6">
                                        <div class="m-1 p-2 border rounded">
                                            <div class="mb-2">
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <h6 class="m-0 p-0"> {{$payoutDetail->type}} Account </h6>
                                                    <div>
                                                        <a href="javascript:void(0)" data-toggle="modal" data-target="#editPayoutDetail" class="text-primary editPayoutDetailBtn h5 mb-0" title="" data-payload="{{json_encode($payoutDetail->payload)}}" data-row="{{$payoutDetail}}" data-original-title="Edit"><i class="uil uil-edit"></i></a>
                                                        <a href="{{ route('user.payout-detail.destroy',$payoutDetail->id) }}" class="text-primary delete-item h5 mb-0" title="" data-original-title="delete">
                                                            <i class="uil uil-trash"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="pt-4 border-top">
                                                <div class="">
                                                    <div>
                                                        <p class="text-muted mb-0"> 
                                                            <i class="uil uil-university"></i>   
                                                            {{@$paload_decodes['bank_name']}}<br>
                                                            <i class="uil uil-user"></i>  
                                                            {{@$paload_decodes['account_holder_name']}}<br>
                                                           <i class="uil uil-book-alt"></i>   
                                                           {{@$paload_decodes['account_no'] }}<br>
                                                           <i class="uil uil-share-alt"></i>   
                                                            {{@$paload_decodes['ifsc_code'] }}<br>
                                                            <i class="uil uil-home"></i> 
                                                            {{@$paload_decodes['branch'] }}<br> 
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty  
                                    <div class="col-lg-8 mx-auto text-center">
                                        @php
                                            $title = 'No Bank Details yet!';
                                        @endphp
                                        @include('user.include.empty-record')
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>    
                    <div class="customer_card card-password"> 
                        <h5>Change password :</h5>
                        <form action="{{ route('user.setting.update-password') }}" method="post">
                            @csrf
                            <div class="row mt-4">
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label class="form-label">Old password :</label>
                                        <div class="form-icon position-relative">
                                            <i data-feather="key" class="fea icon-sm icons"></i>
                                            <input name="current_password" type="password"  class="form-control ps-5" placeholder="Old password" required="">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label class="form-label">New password :</label>
                                        <div class="form-icon position-relative">
                                            <i data-feather="key" class="fea icon-sm icons"></i>
                                            <input name="password" type="password"  class="form-control ps-5" placeholder="New password" required="">
                                        </div>
                                    </div>
                                </div><!--end col-->

                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label class="form-label">Confirm password :</label>
                                        <div class="form-icon position-relative">
                                            <i data-feather="key" class="fea icon-sm icons"></i>
                                            <input name="confirm_password" type="password" class="form-control ps-5" placeholder="Confirm password" required="">
                                        </div>
                                    </div>
                                </div><!--end col-->

                                <div class="col-lg-12 mt-2 mb-0">
                                    <button class="btn btn-primary">Save password</button>
                                </div><!--end col-->
                            </div><!--end row-->
                        </form>
                    </div>
                    <div class="rounded customer_card card-notification">
                        <h5 class="mb-0">Account Notifications :</h5>
                        <div class="p-4">
                            <div class="d-flex justify-content-between pb-4">
                                <h6 class="mb-0">When someone mentions me</h6>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="noti1">
                                    <label class="form-check-label" for="noti1"></label>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between py-4 border-top">
                                <h6 class="mb-0">When someone follows me</h6>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" checked id="noti2">
                                    <label class="form-check-label" for="noti2"></label>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between py-4 border-top">
                                <h6 class="mb-0">When shares my activity</h6>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="noti3">
                                    <label class="form-check-label" for="noti3"></label>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between py-4 border-top">
                                <h6 class="mb-0">When someone messages me</h6>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="noti4">
                                    <label class="form-check-label" for="noti4"></label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="rounded shadow customer_card">
                        <div class="p-4 border-bottom">
                            <h5 class="mb-0">Marketing Notifications :</h5>
                        </div>
                        <div class="p-4">
                            <div class="d-flex justify-content-between pb-4">
                                <h6 class="mb-0">There is a sale or promotion</h6>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="noti5">
                                    <label class="form-check-label" for="noti5"></label>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between py-4 border-top">
                                <h6 class="mb-0">Company news</h6>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="noti6">
                                    <label class="form-check-label" for="noti6"></label>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between py-4 border-top">
                                <h6 class="mb-0">Weekly jobs</h6>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" checked id="noti7">
                                    <label class="form-check-label" for="noti7"></label>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between py-4 border-top">
                                <h6 class="mb-0">Unsubscribe News</h6>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" checked id="noti8">
                                    <label class="form-check-label" for="noti8"></label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="rounded shadow customer_card">
                        <div class="p-4 border-bottom">
                            <h5 class="mb-0 text-danger">Delete Account :</h5>
                        </div>
                        <div class="p-4">
                            <h6 class="mb-0">Do you want to delete the account? Please press below "Delete" button</h6>
                            <div class="mt-4">
                                <button class="btn btn-danger">Delete Account</button>
                            </div><!--end col-->
                        </div>
                    </div>
                </div>

            </div>
        </div><!--end col-->
    </div>

</section><!--end section-->
<!-- Profile Setting End -->
    @include('user.modal.update-profile-picture')  
    @include('user.modal.add-address')
    @include('user.modal.edit-address')
    @include('user.modal.edit-details')
    @include('user.modal.add-details')
    @include('user.modal.ekyc')
@endsection

@push('script')
<script>
        $(document).ready(function(){
            var status = $('#status').val();
           if (status == 3 || status == 1) {
                $('#submitButton').prop("disabled", true);
            } else {
                $('#submitButton').prop("disabled", false);
            }
        });
        // edit bank Details
     
        document.getElementById('avatar').onchange = function () {
            var src = URL.createObjectURL(this.files[0])
            $('#avatar_file').removeClass('d-none');
            document.getElementById('avatar_file').src = src
        }
        $('.customer_card').hide();
        @if(request()->get('active') != '') 
            $('.card-'+"{{ request()->get('active') }}").show();
        @else
            $('.card-my_info').show();
        @endif
           $('.customer_tabs').on('click',function(){
            $('.customer_tabs').removeClass('active');
              $(this).addClass('active');
               var data = $(this).data('active');
               $('.customer_card').hide();
               $('.card-'+data).show();
           });
           $('#changeProfileModal').on('click',function(){
                $('#profilePicture').modal('show');
           });
           $('.ekyc-btn').on('click',function(){
                $('#ekycVerification').modal('show');
           });

        function getStates(countryId = 101) {
            $.ajax({
                url: "{{ route('world.get-states') }}",
                method: 'GET',
                data: {
                    country_id: countryId
                },
                success: function(res) {
                    $('#state').html(res).css('width', '100%');
                }
            })
        }
    function getCities(stateId = 101) {
        $.ajax({
            url: "{{ route('world.get-cities') }}",
            method: 'GET',
            data: {
                state_id: stateId
            },
            success: function(res) {
                $('#city').html(res).css('width', '100%');
            }
        })
    }
    function getEditStates(countryId = 101) {
        $.ajax({
            url: "{{ route('world.get-states') }}",
            method: 'GET',
            data: {
                country_id: countryId
            },
            success: function(res) {
                $('#stateEdit').html(res).css('width', '100%');
            }
        })
    }
    function getEditCities(stateId = 101) {
        $.ajax({
            url: "{{ route('world.get-cities') }}",
            method: 'GET',
            data: {
                state_id: stateId
            },
            success: function(res) {
                $('#cityEdit').html(res).css('width', '100%');
            }
        })
    }
    getStates();
    $(document).ready(function () {
        $('.add-address').on('click', function () {
            $('#addAddressModal').modal('show');
        });
        $('.addPayoutDetailBtn ').on('click', function () {
            $('#add-payout-modal').modal('show');
        });
        $(document).on('click','.addPayoutDetailBtn',function(){
            // alert('s');
            $('#addPayoutDetailReqModal').modal('show');
        });
        $(document).on('click','.editPayoutDetailBtn',function(){
            let record = $(this).data('row');
            let payload = $(this).data('payload');
            if(record.type == "Saving")
            $('#editsaving').prop('checked',true);
            else
            $('#editcurrent').prop('checked',true);
            
            $('#payoutdetailId').val(record.id);
            $('#editaccount_holder_name').val(payload.account_holder_name);
            $('#editaccount_no').val(payload.account_no);
            $('#editifsc_code').val(payload.ifsc_code);
            $('#editbranch').val(payload.branch);
            $('#editbank option[value="'+payload.bank_name+'"]').prop('selected',true);
            $('#editPayoutDetailReq').modal('show');
        });
       

        $('#country').on('change', function() {
            getStates($(this).val());
        });

        $('#state').on('change', function() {
            getCities($(this).val());
        });
        $('#countryEdit').on('change', function() {
            getEditStates($(this).val());
        });

        $('#stateEdit').on('change', function() {
            getEditCities($(this).val());
        });
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
        $('#type').val(address.type);
        $('#editPhone').val(details.phone); 
        $('#address_1').val(details.address_1);
        $('#address_2').val(details.address_2);
        console.log(details.pincode_id);
        $('#pincode_id').val(details.pincode_id);
        $('#countryEdit').val(details.country).change();
        
        setTimeout(() => {
            $('#stateEdit').val(details.state).change();
            setTimeout(() => {
                $('#cityEdit').val(details.city).change();
            }, 500);
        }, 500);
        $('#editAddressModal').modal('show');
    });

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
    function updateURL(key,val){
        var url = window.location.href;
        var reExp = new RegExp("[\?|\&]"+key + "=[0-9a-zA-Z\_\+\-\|\.\,\;]*");

        if(reExp.test(url)) {
            // update
            var reExp = new RegExp("[\?&]" + key + "=([^&#]*)");
            var delimiter = reExp.exec(url)[0].charAt(0);
            url = url.replace(reExp, delimiter + key + "=" + val);
        } else {
            // add
            var newParam = key + "=" + val;
            if(!url.indexOf('?')){url += '?';}

            if(url.indexOf('#') > -1){
                var urlparts = url.split('#');
                url = urlparts[0] +  "&" + newParam +  (urlparts[1] ?  "#" +urlparts[1] : '');
            } else {
                url += "?" + newParam;
            }
        }
        window.history.pushState(null, document.title, url);
    }

    $('.active-swicher').on('click', function() {
        var active = $(this).attr('data-active');
        updateURL('active',active);
    });

</script>

@endpush





