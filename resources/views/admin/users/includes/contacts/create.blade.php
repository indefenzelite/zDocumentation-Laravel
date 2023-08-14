<div class="modal fade" id="ContactModalCenter" tabindex="-1" role="dialog" aria-labelledby="contactModalCenterLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="contactModalCenterLabel">{{ __('Add Contact') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.contacts.store') }}" method="post">
                    @csrf
                    <input type="hidden" name="request_with" value="create">
                    <input type="hidden" name="type" value="{{ 'User' }}">
                    <input type="hidden" name="type_id" value="{{ $user->id }}">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="form-group col-md-6 {{ $errors->has('first_name') ? 'has-error' : '' }}">
                                    <label for="first_name" class="control-label">{{ 'First Name' }}<span
                                            class="text-danger">*</span></label>
                                    <input class="form-control" name="first_name" type="text" pattern="[a-zA-Z]+.*"
                                        title="Please enter first letter alphabet and at least one alphabet character is required."
                                        id="first_name" placeholder="Enter First Name" value="" required>
                                    {{-- <input class="form-control" name="first_name" type="text" pattern="[a-zA-Z]+.*" title="Please enter first letter alphabet and at least one alphabet character is required." id="first_name" placeholder="Enter First Name" value="{{ isset($user->name) ? $user->name : ''}}" required> --}}
                                </div>
                                <div class="form-group col-md-6 {{ $errors->has('last_name') ? 'has-error' : '' }}">
                                    <label for="last_name" class="control-label">{{ 'Last Name' }}<span
                                            class="text-danger">*</span></label>
                                    <input class="form-control" name="last_name" type="text" pattern="[a-zA-Z]+.*"
                                        title="Please enter first letter alphabet and at least one alphabet character is required."
                                        id="last_name" placeholder="Enter Last Name" value="" required>
                                    {{-- <input class="form-control" name="last_name" type="text" pattern="[a-zA-Z]+.*" title="Please enter first letter alphabet and at least one alphabet character is required." id="last_name" placeholder="Enter Last Name"  value="{{ isset($user->last_name) ? $user->last_name : ''}}" required> --}}
                                </div>

                                {{-- <div class="form-group col-md-6 {{ $errors->has('job_title') ? 'has-error' : ''}}">
                                    <label for="job_title" class="control-label">{{ 'Job Title' }}</label>
                                    <input class="form-control" name="job_title" type="text" id="job_title" placeholder="Enter Job Title" value="{{ isset($user->job_title) ? $user->job_title : ''}}" required>
                                </div> --}}
                                <div class="form-group col-md-6 {{ $errors->has('job_title') ? 'has-error' : '' }}">
                                    <label for="job_title" class="control-label">{{ 'Category' }}<span
                                            class="text-danger">*</span></label>
                                    <select class="form-control" name="job_title" required>
                                        <option value="" readonly>Select Category</option>
                                        @foreach ($jobTitleCategories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6 {{ $errors->has('email') ? 'has-error' : '' }}">
                                    <label for="email" class="control-label">{{ 'Email' }}<span
                                            class="text-red">*</span></label>
                                    <input class="form-control" name="email" type="email" pattern="[a-zA-Z]+.*"
                                        title="Please enter first letter alphabet and at least one alphabet character is required."
                                        id="email" placeholder="Enter Email" value="" required>
                                    {{-- <input class="form-control" name="email" type="email" id="email" placeholder="Enter Email" value="{{ isset($user->email) ? $user->email : ''}}" required> --}}
                                </div>
                                <div class="form-group col-md-6 {{ $errors->has('phone') ? 'has-error' : '' }}">
                                    <label for="phone" class="control-label">{{ 'Phone' }}<span
                                            class="text-red">*</span></label>
                                    <input class="form-control" min="0" pattern="^[0-9]*$" name="phone"
                                        type="number" id="phone" placeholder="Enter Phone" value="" required>
                                    {{-- <input class="form-control" name="phone" type="number" id="phone" placeholder="Enter Phone" value="{{ isset($user->phone) ? $user->phone : ''}}" required> --}}
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="gender">{{ __('Gender') }}<span class="text-red">*</span></label>
                                    <div class="form-radio form-group">
                                        <div class="radio radio-inline">
                                            <label>
                                                <input type="radio" name="gender" value="male" checked>
                                                <i class="helper"></i>{{ __('Male') }}
                                            </label>
                                        </div>
                                        <div class="radio radio-inline">
                                            <label>
                                                <input type="radio" name="gender" value="female">
                                                <i class="helper"></i>{{ __('Female') }}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-12 mx-auto">
                            <div class="form-group text-right">
                                <button type="submit" class="btn btn-primary">Create</button>
                                <button type="button" class="btn btn-secondary"
                                    data-dismiss="modal">{{ __('Close') }}</button>
                            </div>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
