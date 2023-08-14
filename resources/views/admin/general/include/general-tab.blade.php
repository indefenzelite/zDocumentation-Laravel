<form class="forms-sample ajaxForm" action="{{ route('admin.setting.store') }}"method="post" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="group_name" value="{{ 'general_setting' }}">
    <div class="form-group row">
        <label for="exampleInputUsername2" class="col-sm-3 col-form-label">{{ __('App Name') }}<span
                class="text-red">*</span>
            <a href="javascript:void(0);" title="@lang('admin/tooltip.general_app_name')"><i
                    class="ik ik-help-circle text-muted ml-1"></i></a>
        </label>
        <div class="col-sm-9">  pattern="[a-zA-Z]+.*" title="Please enter first letter alphabet and at least one alphabet character is required."title="Please enter first letter alphabet and at least one alphabet character is required."
            <input type="text" pattern="[a-zA-Z]+.*"
                title="Please enter first letter alphabet and at least one alphabet character is required."
                title="Please enter first letter alphabet and at least one alphabet character is required."
                name="app_name" class="form-control" placeholder="App Name" required
                value="{{ getSetting('app_name') }}" />
        </div>
    </div>
    <div class="form-group row">
        <label for="exampleInputEmail2" class="col-sm-3 col-form-label">{{ __('App Url') }}<span
                class="text-danger">*</span>
            <a href="javascript:void(0);" title="@lang('admin/tooltip.general_app_url')"><i
                    class="ik ik-help-circle text-muted ml-1"></i></a>
        </label>
        <div class="col-sm-9">
            <input type="url" name="app_url" class="form-control" required value="{{ getSetting('app_url') }}"
                placeholder="App Url">
        </div>
    </div>
    <div class="form-group row">
        <label for="logo" class="col-sm-3 col-form-label">{{ __('App Logo') }}
            <a href="javascript:void(0);" title="@lang('admin/tooltip.general_app_logo')"><i
                    class="ik ik-help-circle text-muted ml-1"></i></a>
        </label>
        <div class="col-sm-9">
            <input type="file" name="app_logo" class="file-upload-default">
            <div class="input-group col-xs-12">
                <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Logo">
                <span class="input-group-append">
                    <button class="file-upload-browse btn btn-success" type="button">{{ __('Upload') }}</button>
                </span>
            </div>
        </div>
        <div class="col-sm-3"> </div>
        <div class="col-sm-9">
            <div class="card m-0 p-2">
                <div class="mx-auto">
                    <img src="{{ asset(getSetting('app_logo')) }}" alt="App Logo" width="120px">
                </div>
            </div>
        </div>
    </div>
    <div class="form-group row">
        <label for="logo" class="col-sm-3 col-form-label">{{ __('App Favicon') }}
            <a href="javascript:void(0);" title="@lang('admin/tooltip.general_app_favicon')"><i
                    class="ik ik-help-circle text-muted ml-1"></i></a>
        </label>
        <div class="col-sm-9">
            <input type="file" name="app_favicon" class="file-upload-default">
            <div class="input-group col-xs-12">
                <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Favicon">
                <span class="input-group-append">
                    <button class="file-upload-browse btn btn-success" type="button">{{ __('Upload') }}</button>
                </span>
            </div>
        </div>
        <div class="col-sm-3"></div>
        <div class="col-sm-9">
            <div class="card m-0 p-2">
                <div class="mx-auto">
                    <img src="{{ asset(getSetting('app_favicon')) }}" alt="Favicon" width="40px">
                </div>
            </div>
        </div>
    </div>
    <div class="form-group row">
        <label for="exampleInputUsername2" class="col-sm-3 col-form-label">{{ __('Language') }}
            <a href="javascript:void(0);" title="@lang('admin/tooltip.general_app_language')"><i
                    class="ik ik-help-circle text-muted ml-1"></i></a>
        </label>
        <div class="col-sm-9">
            <select name="app_language" class="form-control select2" id="lang" required>
                <option value="en">English</option>
            </select>
        </div>
    </div>
    <div class="form-group row">
        <label for="exampleInputUsername2" class="col-sm-3 col-form-label">{{ __('Maintainance Mode') }}</label>
        <div class="col-sm-9">
            <input class="js-switch switch-input" @if (getSetting('maintainance_mode') == '1') checked @endif
                name="maintainance_mode" type="checkbox" id="maintainance_mode" value="1">
        </div>
    </div>
    @if (env('IS_DEV') == 1)
        <div class="form-group row">
            <label for="exampleInputUsername2" class="col-sm-3 col-form-label">{{ __('ReCaptcha') }}</label>
            <div class="col-sm-9">
                <input class="js-switch switch-input" @if (getSetting('recaptcha') == '1') checked @endif
                    name="recaptcha" type="checkbox" id="recaptcha" value="1">
            </div>
        </div>
        <div class="form-group row">
            <label for="exampleInputUsername2" class="col-sm-3 col-form-label">{{ __('Voice Input') }}</label>
            <div class="col-sm-9">
                <input class="js-switch switch-input" @if (getSetting('voice_input') == '1') checked @endif
                    name="voice_input" type="checkbox" id="voice_input" value="1">
            </div>
        </div>
        <div class="form-group row">
            <label for="exampleInputUsername2" class="col-sm-3 col-form-label">{{ __('Authentication Mode') }}
                <a href="javascript:void(0);" title="@lang('admin/tooltip.general_authentication_mode')"><i
                        class="ik ik-help-circle text-muted ml-1"></i></a>
            </label>
            <div class="col-sm-9">
                <select name="authentication_mode" class="form-control select2" required>
                    <option value="" aria-readonly="true">Select</option>
                    @foreach (getAuthenticationMode() as $mode)
                        <option {{ getSetting('authentication_mode') == $mode['id'] ? 'selected' : '' }}
                            value="{{ $mode['id'] }}">{{ $mode['name'] }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="exampleInputUsername2"
                class="col-sm-3 col-form-label">{{ __('Password Reset Expired (in minutes)') }}
                <a href="javascript:void(0);" title="@lang('admin/tooltip.password_reset_expiry')"><i
                        class="ik ik-help-circle text-muted ml-1"></i></a>
            </label>
            <div class="col-sm-9">
                <input type="number" name="password_reset_expiry" class="form-control" id=""
                    value="{{ getSetting('password_reset_expiry') ?? 60 }}">
            </div>
        </div>
    @endif
    <div class="card-footer text-right">
        <button type="submit" class="btn btn-primary mr-2">{{ __('Update') }}</button>
    </div>
</form>
