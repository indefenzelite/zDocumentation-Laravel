@extends('layouts.main') 
@section('title', $label)
@section('content')

    <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-grid bg-blue"></i>
                        <div class="d-inline">
                            <h5>{{ __($label)}}</h5>
                            <span>{{ __('This setting will be automatically updated in your website.')}}</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div>

                      
                        <nav class="breadcrumb-container" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{route('admin.dashboard.index')}}"><i class="ik ik-home"></i></a>
                                </li>
                                <li class="breadcrumb-item"><a href="#">{{ __('Setting')}}</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{ __($label)}}</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                @include('admin.setting.sitemodal',['title'=>"How to use",'content'=>"You need to create a unique code and call the unique code with paragraph content helper."])
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card card-484">
                    <div role="tabpanel">
                        <div class="card-header" style="border:none;" >
                            <ul class="nav nav-pills custom-pills" id="pills-tab" role="tablist">
                                @if(auth()->user()->isAbleTo('access_email_setting'))
                                    <li class="nav-item">
                                        <a href="{{route('admin.mail-sms-configuration.index')}}" class="nav-link @if(!request()->has('name')|| (request()->has('name') && request()->get('name') == 'mail_config')) active @endif" aria-controls="mail" role="tab">Mail Config</a>
                                    </li>
                                @endif
                                @if(auth()->user()->isAbleTo('access_sms_setting'))
                                    <li class="nav-item">
                                        <a href="{{route('admin.mail-sms-configuration.index',['name' => 'sms_config'])}}" class="nav-link  @if(request()->has('name') && request()->get('name') == 'sms_config') active @endif" aria-controls="sms" role="tab">SMS Config</a>
                                    </li>
                                @endif
                                @if(auth()->user()->isAbleTo('access_fcm_setting'))
                                    <li class="nav-item">
                                        <a href="{{route('admin.mail-sms-configuration.index',['name' => 'fcm_config'])}}" class="nav-link @if(request()->has('name') && request()->get('name') == 'fcm_config') active @endif" aria-controls="notification" role="tab">FCM Config</a>
                                    </li>
                                @endif
                            </ul>
                        </div>
                        <div class="card-body pt-0">
                            {{-- @dd($request->name) --}}
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade show pt-3  @if(@$request->name == null || @$request->name == "mail_config" && @$request->name != "sms_config" && @$request->name != "mail_config") active @endif" id="mail" aria-labelledby="mail-tab">
                                    <div class="card-header p-0 justify-content-between">
                                        <h3>{{ __('Mail Configuration')}}</h3>
                                        <a href="javascript:void(0);" class="btn btn-outline-danger openModal mb-2" data-type="Mail"><i class="ik ik-mail"></i> Test Mail Config</a>
                                    </div>
                                    <form class="forms-sample ajaxForm" action="{{ route('admin.mail-sms-configuration.mail.store')}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="group_name" value="mail_setting">
                                        <div class="card-body">
                                            <div class="form-group row">
                                                <label for="exampleInputUsername2" class="col-sm-2 col-form-label">{{ __('Admin Email')}}<span class="text-red">*</span>
                                                <a href="javascript:void(0);" title="@lang('admin/tooltip.mail_sms_configuration_admin_email')"><i class="ik ik-help-circle text-muted ml-1"></i></a>
                                                </label>
                                                <div class="col-sm-5">
                                                    <input type="text" pattern="[a-zA-Z]+.*" title="Please enter first letter alphabet and at least one alphabet character is required." title="Please enter first letter alphabet and at least one alphabet character is required." name="admin_email" class="form-control"  required value="{{ getSetting('admin_email') }}" placeholder="Admin Email">
                                                </div>
                                                <div class="col-sm-5">
                                                    <span class="text-warning">This email used for sending important updates to system admin.</span>
                                                </div>
                                            </div>
                                
                                            <hr>
                                            
                                            <div class="form-group row">
                                                <label for="exampleInputUsername2" class="col-sm-2 col-form-label">{{ __('Mail From Name')}}<span class="text-red">*</span>
                                                 <a href="javascript:void(0);" title="@lang('admin/tooltip.mail_sms_configuration_admin_email')"><i class="ik ik-help-circle text-muted ml-1"></i></a>
                                                </label>
                                                <div class="col-sm-5">
                                                    <input type="text"  pattern="[a-zA-Z]+.*" title="Please enter first letter alphabet and at least one alphabet character is required." title="Please enter first letter alphabet and at least one alphabet character is required."name="mail_from_name" class="form-control"  required value="{{ getSetting('mail_from_name') }}" placeholder="Mail From Name">
                                                </div>
                                                <div class="col-sm-5">
                                                    <span class="text-warning">This will be display name for your sent email.</span>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="exampleInputEmail2" class="col-sm-2 col-form-label">{{ __('Mail From Address')}}<span class="text-red">*</span>
                                                 <a href="javascript:void(0);" title="@lang('admin/tooltip.mail_sms_configuration_admin_email')"><i class="ik ik-help-circle text-muted ml-1"></i></a>
                                                </label>
                                                <div class="col-sm-5">
                                                    <input type="text" pattern="[a-zA-Z]+.*" title="Please enter first letter alphabet and at least one alphabet character is required." title="Please enter first letter alphabet and at least one alphabet character is required." name="mail_from_address" class="form-control" required value="{{ getSetting('mail_from_address') }}" placeholder="Mail From Address">
                                                </div>
                                                <div class="col-sm-5">
                                                    <span class="text-warning">This email will be used for "Contact Form" correspondence.</span>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="exampleInputUsername2" class="col-sm-2 col-form-label">{{ __('Mail Driver')}}<span class="text-red">*</span>
                                                 <a href="javascript:void(0);" title="@lang('admin/tooltip.mail_sms_configuration_admin_email')"><i class="ik ik-help-circle text-muted ml-1"></i></a>
                                                </label>
                                                
                                                <div class="col-sm-5">
                                                    {{-- <input type="text" name="mail_mailer" class="form-control" value="{{ getSetting('mail_mailer') }}" placeholder="Mail Driver"> --}}
                                                    <select name="mail_mailer" id="" required class="form-control select2">
                                                        <option value="" aria-readonly="true">Select mail driver</option>
                                                        <option @if(getSetting('mail_mailer') == "smtp") selected @endif value="smtp">SMTP</option>
                                                        <option @if(getSetting('mail_mailer') == "sendmail") selected @endif value="sendmail">Sendmail</option>
                                                        <option @if(getSetting('mail_mailer') == "mailgun") selected @endif value="mailgun">Mailgun</option>
                                                        <option @if(getSetting('mail_mailer') == "sparkpost") selected @endif value="sparkpost">SparkPost</option>
                                                        <option @if(getSetting('mail_mailer') == "ses") selected @endif value="ses">Amazon SES</option>
                                                    </select>
                                                </div>
                                                <div class="col-sm-5">
                                                    <span class="text-warning">You can select any driver you want for your Mail setup. Ex. SMTP, Mailgun, Mandrill, SparkPost, Amazon SES etc.
                                                        Add single driver only.</span>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="exampleInputUsername2" class="col-sm-2 col-form-label">{{ __('Mail Host')}}<span class="text-red">*</span>
                                                 <a href="javascript:void(0);" title="@lang('admin/tooltip.mail_sms_configuration_mail_host')"><i class="ik ik-help-circle text-muted ml-1"></i></a>
                                                </label>
                                                <div class="col-sm-5">
                                                    <input type="text"  pattern="[a-zA-Z]+.*" title="Please enter first letter alphabet and at least one alphabet character is required." title="Please enter first letter alphabet and at least one alphabet character is required."name="mail_host" class="form-control" value="{{ getSetting('mail_host') }}" placeholder="Mail Host" required>
                                                </div>
                                                <div class="col-sm-5">
                                                    <span class="text-warning">Standard configuration samples: Gmail: smtp.gmail.com, </span>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="exampleInputUsername2" class="col-sm-2 col-form-label">{{ __('Mail Port')}}<span class="text-red">*</span>
                                                 <a href="javascript:void(0);" title="@lang('admin/tooltip.mail_sms_configuration_mail_port')"><i class="ik ik-help-circle text-muted ml-1"></i></a>
                                                </label>
                                                <div class="col-sm-5">
                                                    {{-- <input type="text" name="mail_port" class="form-control" value="{{ getSetting('mail_port') }}" placeholder=" "> --}}
                                                    <select required name="mail_port" id="" class="form-control select2">
                                                        <option value="" readonly>Select mail port</option>
                                                        <option @if(getSetting('mail_port') == "587") selected @endif value="587">587</option>
                                                         <option @if(getSetting('mail_port') == "465") selected @endif value="465">465</option>
                                                    </select>
                                                </div>
                                                <div class="col-sm-5">
                                
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="exampleInputUsername2" class="col-sm-2 col-form-label">{{ __('Mail Username')}}<span class="text-red">*</span>
                                                 <a href="javascript:void(0);" title="@lang('admin/tooltip.mail_sms_configuration_mail_username')"><i class="ik ik-help-circle text-muted ml-1"></i></a>
                                                </label>
                                                <div class="col-sm-5">
                                                    <input type="text" pattern="[a-zA-Z]+.*" title="Please enter first letter alphabet and at least one alphabet character is required." title="Please enter first letter alphabet and at least one alphabet character is required." name="mail_username" class="form-control" value="{{ getSetting('mail_username') }}" placeholder="Ex. myemail@email.com" required>
                                                </div>
                                                <div class="col-sm-5">
                                                    <span class="text-warning">Add your email id you want to configure for sending emails</span>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="exampleInputUsername2" class="col-sm-2 col-form-label">{{ __('Mail Password')}}<span class="text-red">*</span>
                                                 <a href="javascript:void(0);" title="@lang('admin/tooltip.mail_sms_configuration_mail_password')"><i class="ik ik-help-circle text-muted ml-1"></i></a>
                                                </label>
                                                <div class="col-sm-5">
                                                    <input type="password" name="mail_password" class="form-control" value="{{ getSetting('mail_password') }}" placeholder="Mail Password" required>
                                                </div>
                                                <div class="col-sm-5">
                                                    <span class="text-warning">Add your email password you want to configure for sending emails</span>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="exampleInputUsername2" class="col-sm-2 col-form-label">{{ __('Mail Encryption')}}<span class="text-red">*</span>
                                                 <a href="javascript:void(0);" title="@lang('admin/tooltip.mail_sms_configuration_mail_encryption')"><i class="ik ik-help-circle text-muted ml-1"></i></a>
                                                </label>
                                                <div class="col-sm-5">
                                                    {{-- <input type="text" name="mail_encryption" class="form-control" value="{{ getSetting('mail_encryption') }}" placeholder="Mail Encryption"> --}}
                                                    <select required name="mail_encryption" id="" class="form-control select2">
                                                        <option value="" aria-readonly="true">Mail encryption</option>
                                                        <option @if(getSetting('mail_encryption') == "tls") selected @endif value="tls">TLS
                                                        </option>
                                                         <option @if(getSetting('mail_encryption') == "ssl") selected @endif value="ssl">SSL
                                                        </option>
                                                       
                                                     </select>
                                
                                                </div>
                                                <div class="col-sm-5">
                                                    <span class="text-warning">Use tls if your site uses HTTP protocol and ssl if you site uses HTTPS protocol</span>
                                                </div>
                                            </div>
                                            <hr>
                                            <p class="help-text mb-0"><b>Important Note</b> : IF you are using <b>GMAIL</b> for Mail configuration, make sure you have completed following process before updating:
                                            </p>
                                            <ul>
                                                <li>Go to <a target="_blank" href="https://myaccount.google.com/security">My Account</a> from your Google Account you want to configure and Login</li>
                                                <li>Scroll down to <b>Less secure app access</b> and set it <b>ON</b></li>
                                                </ul>
                                     
                                            
                                        </div>
                                        <div class="card-footer text-right">
                                            <button type="submit" class="btn btn-primary mr-2">{{ __('Save & Update')}}</button>
                                        </div>
                                    </form>
                                
                                </div><!--tab panel profile-->

                                <div role="tabpanel" class="tab-pane fade show pt-3 @if(@$request->name == "sms_config" && @$request->name != "mail_config" && @$request->name != "fcm_config") active @endif" id="sms" aria-labelledby="sms-tab">
                                    <div class="card-header p-0 justify-content-between">
                                        <h3>{{ __('SMS Configuration')}}</h3>
                                        <a href="javascript:void(0);" class="btn btn-outline-danger openModal mb-2" data-type="Mail"><i class="ik ik-mail"></i> Test SMS Config</a>
                                    </div>

                                    <form class="forms-sample ajaxForm" action="{{ route('admin.mail-sms-configuration.sms.store')}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="group_name" value="sms_endpoint_setting">
                                       
                                        <div class="card-body">
                                            <div class="row">
                                                <label for="exampleInputUsername2" class="col-sm-2 col-form-label">{{ __('SMS Endpoint')}}<span class="text-red">*</span>
                                                 <a href="javascript:void(0);" title="@lang('admin/tooltip.mail_sms_configuration_sms_endpoint')"><i class="ik ik-help-circle text-muted ml-1"></i></a>
                                                </label>
                                                <div class="col-sm-5">
                                                    <textarea type="text" name="sms_endpoint" class="form-control" cols="2"placeholder=" Enter SMS Endpoint" required>{{ getSetting('sms_endpoint') }}</textarea>
                                                </div>
                                                <div class="col-sm-5">
                                                    <span class="text-warning">You can purchase api from any sms provider and set endpoint url here. 
                                                    <br> Note: Url should contain valid api key, without any parameter.     
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer text-right">
                                            <button type="submit" class="btn btn-primary mr-2">{{ __('Save & Update')}}</button>
                                        </div>
                                    </form>
                                </div><!--tab panel profile-->

                                <div role="tabpanel" class="tab-pane fade show pt-3 @if(@$request->name == "fcm_config" && @$request->name != "mail_config" && @$request->name != "sms_config") active @endif" id="notification" aria-labelledby="notification-tab">
                                    <div class="card-header p-0 justify-content-between">
                                        <h3>{{ __('FCM Configuration')}}</h3>
                                        <a href="javascript:void(0);" class="btn btn-outline-danger openFCMModal mb-2" data-type="Mail"><i class="ik ik-mail"></i> Test FCM Config</a>
                                    </div>


                                    <form class="forms-sample ajaxForm" action="{{ route('admin.mail-sms-configuration.notification.store')}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="group_name" value="fcm_api_setting">
                                        <div class="card-body">
                                            <div class="form-group row">
                                                <label for="fcm_sender_id" class="col-sm-2 col-form-label">{{ __('Sender ID')}}<span class="text-red">*</span>
                                                <a href="javascript:void(0);" title="@lang('admin/tooltip.mail_sms_configuration_fcm_sender_id')"><i class="ik ik-help-circle text-muted ml-1"></i></a>
                                                </label>
                                                <div class="col-sm-5">
                                                    <input type="text" name="fcm_sender_id" class="form-control" value="{{ getSetting('fcm_sender_id') }}" placeholder="Sender ID" required> 
                                                </div>
                                                <div class="col-sm-5">
                                                    <span class="text-warning">
                                                        Create Firebase Account. <br>
                                                        Create Project <br>
                                                        Click the Cloud Messaging tab next to the General tab.
                                                        Copy Sender ID, and the Server key.
                                                    </span>
                                                </div>
                                                <label for="fcm_server_key" class="col-sm-2 col-form-label" style="margin-top: -25px;">{{ __('Server Key')}}<span class="text-red">*</span>
                                                <a href="javascript:void(0);" title="@lang('admin/tooltip.mail_sms_configuration_fcm_server_key')"><i class="ik ik-help-circle text-muted ml-1"></i></a>
                                                </label>
                                                <div class="col-sm-5">
                                                    <input type="text" name="fcm_server_key" class="form-control" value="{{ getSetting('fcm_server_key') }}" style="margin-top: -25px;" placeholder="Server Key" required> 
                                                </div>
                                                
                                            </div>
                                            
                                        </div>
                                        <div class="card-footer text-right">
                                            <button type="submit" class="btn btn-primary mr-2">{{ __('Save & Update')}}</button>
                                        </div>
                                    </form>
                                </div><!--tab panel profile-->

                            </div><!--tab content-->
                        </div>
                    </div><!--tab panel-->
                    
                </div>
            </div>
        </div>
    </div>
    
    <div class="modal fade" id="OpenSendModal" tabindex="-1" role="dialog" aria-labelledby="demoModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="demoModalLabel">{{ __('Modal title')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <form action="{{ route('admin.mail-sms-configuration.test.send') }}" method="post" class="ajaxForm">
                    @csrf
                    <input type="hidden" name="type" id="type">
                    <div class="modal-body">
                        <div class="form-group mail">
                            <input type="email" name="email" id="" class="form-control" placeholder="Enter your valid Email">
                        </div>
                        <div class="form-group sms">
                            <input type="number" name="phone" pattern="^[0-9]*$" min="0"  id="" class="form-control" placeholder="Enter your valid Contact Number">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" class="close" aria-label="Close" data-dismiss="modal">{{ __('Close')}}</button>
                        <button type="submit" class="btn btn-primary">{{ __('Send')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @include('admin.include.modal.broadcast')
@endsection
    <!-- push external js -->
    @push('script')
    {{-- START JS HELPERS INIT --}}
        <script>
            $('.openModal').click(function(){
                var type = $(this).data('type');
                if(type == 'Mail'){
                    $('.sms').hide();
                    $('.mail').show();
                }else{
                    $('.sms').show();
                    $('.mail').hide();
                }
                $('#type').val(type);
                $('#demoModalLabel').html('Send '+type);
                $('#OpenSendModal').modal('show');
            });
            $('.openFCMModal').click(function(){
                $('#addBrodcast').modal('show');
            });
        </script>
    {{-- END JS HELPERS INIT --}}

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
            })
        </script>
    {{-- END AJAX FORM INIT --}}

    @endpush