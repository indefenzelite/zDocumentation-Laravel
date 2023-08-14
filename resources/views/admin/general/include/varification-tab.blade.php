<form class="forms-sample ajaxForm" action="{{ route('admin.setting.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="group_name" value="{{ 'general_setting_verification' }}">
    <div class="form-group row">
        <label for="exampleInputUsername2"
            class="col-sm-9 col-form-label">
            {{ __('Email Notification') }}
            <br>
            <span class="text-warning">This Message used to sending for Email Notification updates..</span>
        </label>
        <div class="col-sm-3">
            <input class="js-switch switch-input" @if(getSetting('email_notify') == '1') checked @endif name="email_notify" type="checkbox" id="email_notify" value="1">
        </div>
        
    </div>
    <div class="form-group row">
        <label for="exampleInputUsername2"
            class="col-sm-9 col-form-label">{{ __('SMS Notification') }}
            <br>
            <span class="text-warning">This Message used to sending for SMS Notification updates..</span>
        </label>
        <div class="col-sm-3">
            <input class="js-switch switch-input" @if(getSetting('sms_notify') == '1') checked @endif name="sms_notify" type="checkbox" id="sms_notify" value="1">
        </div>
    </div>
    <div class="form-group row">
        <label for="exampleInputUsername2"
            class="col-sm-9 col-form-label">{{ __('On Site Notifications') }}
        <br>
            <span class="text-warning">This Message used to sending for site Notification updates..</span>
        </label>
        <div class="col-sm-3">
            <input class="js-switch switch-input" @if(getSetting('notification') == '1') checked @endif name="notification" type="checkbox" id="notification" value="1">
        </div>
    </div>

    <hr>

    <div class="form-group row">
       <label for="exampleInputUsername2"
           class="col-sm-9 col-form-label">{{ __('Email Verification') }}
        <br>
            <span class="text-warning">This Email Verification used for sending the verify message  ....</span>
        </label>
        <div class="col-sm-3">
            <input class="js-switch switch-input" @if(getSetting('email_verify') == '1') checked @endif name="email_verify" type="checkbox" id="email_verify" value="1">
        </div>
    </div>
    <div class="form-group row">
        <label for="exampleInputUsername2"
            class="col-sm-9 col-form-label">{{ __('SMS Verification') }}
        <br>
            <span class="text-warning">This SMS Verification used for sending the verify message  ..</span>
        </label>
        <div class="col-sm-3">
            <input class="js-switch switch-input" @if(getSetting('sms_verify') == '1') checked @endif name="sms_verify" type="checkbox" id="sms_verify" value="1">
        </div>
  </div>   

    <div class="card-footer text-right">
        <button type="submit" class="btn btn-primary mr-2">{{ __('Update') }}</button>
    </div>
</form>