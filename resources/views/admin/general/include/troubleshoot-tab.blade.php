<div class="form-group row">
    @if (env('IS_DEV') == 1)
        <div class="col-md-12">
            <div class="card troubleshoot bg-light">
                <div class="row">
                    <div class="col-6">
                        <h5 class="ml-4 mt-2">Storage Link</h5>
                        <p class="ml-4">This will remove old storage and create a new storage link.
                        </p>
                    </div>
                    <div class="col-6">
                        <a href="{{ route('admin.general.storage-link') }}"
                        class="btn btn-outline-dark mt-4" style="width: 120px; height: 50px;"><h6 class="mt-2">{{ __('Storage Link') }}</h6>
                    </a>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <div class="col-md-12">
        <div class="card troubleshoot bg-light">
            <div class="row">
                <div class="col-6">
                    <h5 class="ml-4 mt-2">Optimize Clear</h5>
                    <p class="ml-4">This will clear your project cache and provides you high performance.
                    </p>
                </div>
                <div class="col-6">
                    <a href="{{ route('admin.general.optimize-clear') }}"
                    class="btn btn-outline-dark mt-4" style="width: 135px; height: 50px;"><h6 class="mt-2">{{ __('Optimize Clear') }}</h6>
                </a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="card troubleshoot bg-light">
            <div class="row">
                <div class="col-6">
                    <h5 class="ml-4 mt-2">Session Clear</h5>
                    <p class="ml-4">This will clear your session cache and provides you high performance.
                    </p>
                </div>
                <div class="col-6">
                    <a href="{{ route('admin.general.session-clear') }}"
                    class="btn btn-outline-dark mt-4" style="width: 135px; height: 50px;"><h6 class="mt-2">{{ __('Session Clear') }}</h6>
                </a>
                </div>
            </div>
        </div>
    </div>

</div>