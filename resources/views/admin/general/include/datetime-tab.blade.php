<form class="forms-sample ajaxForm" action="{{ route('admin.setting.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="group_name" value="{{ 'general_setting_date_time' }}">
    <div class="form-group d-flex">
        <label for="" class="col-sm-3">{{ __('Date Format') }}<span class="text-red">*</span>
            <a href="javascript:void(0);" title="@lang('admin/tooltip.general_date_format')"><i class="ik ik-help-circle text-muted ml-1"></i></a>
        </label>
        <select required name="date_format" class="form-control select2 col-sm-9">
            <option value="" readonly>{{ __('Select Date Format') }}</option>
            @foreach(\App\Models\Setting::DATE_FORMATS as $dt_formats)
                <option {{ $dt_formats['format'] == getSetting('date_format') ? 'selected' : '' }} value="{{$dt_formats['format']}}">
                    {{$dt_formats['label']}} ({{$dt_formats['format']}})
                </option>
            @endforeach
        </select>
    </div>

    <div class="card-footer text-right">
        <button type="submit" class="btn btn-primary mr-2">{{ __('Update') }}</button>
    </div>
</form>