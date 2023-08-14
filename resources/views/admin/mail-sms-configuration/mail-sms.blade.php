<div role="tabpanel" class="tab-pane fade show active pt-3" id="mail" aria-labelledby="mail-tab">
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
                    <input type="text"  pattern="[a-zA-Z]+.*" title="Please enter first letter alphabet and at least one alphabet character is required." title="Please enter first letter alphabet and at least one alphabet character is required." title="Please enter first letter alphabet and at least one alphabet character is required."name="admin_email" class="form-control"  required value="{{ getSetting('admin_email') }}" placeholder="Admin Email">
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
                    <input type="text" pattern="[a-zA-Z]+.*" title="Please enter first letter alphabet and at least one alphabet character is required." title="Please enter first letter alphabet and at least one alphabet character is required." title="Please enter first letter alphabet and at least one alphabet character is required." name="mail_from_name" class="form-control"  required value="{{ getSetting('mail_from_name') }}" placeholder="Mail From Name">
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
                    <input type="text"  pattern="[a-zA-Z]+.*" title="Please enter first letter alphabet and at least one alphabet character is required." title="Please enter first letter alphabet and at least one alphabet character is required." title="Please enter first letter alphabet and at least one alphabet character is required."name="mail_from_address" class="form-control" required value="{{ getSetting('mail_from_address') }}" placeholder="Mail From Address">
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
                    <input type="text"  pattern="[a-zA-Z]+.*" title="Please enter first letter alphabet and at least one alphabet character is required." title="Please enter first letter alphabet and at least one alphabet character is required." title="Please enter first letter alphabet and at least one alphabet character is required."name="mail_host" class="form-control" value="{{ getSetting('mail_host') }}" placeholder="Mail Host" required>
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
                    <input type="text" name="mail_username" class="form-control" value="{{ getSetting('mail_username') }}" placeholder="Ex. myemail@email.com" required>
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