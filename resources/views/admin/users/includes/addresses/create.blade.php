<div class="modal fade" id="addressModalCenter" tabindex="-1" role="dialog" aria-labelledby="addressModalCenterLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addressModalCenterLabel">{{ __('Add Address') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.addresses.store') }}" method="post">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                    <input type="hidden" name="request_with" value="create">
                    <div class="row">
                        <div class="col-md-12 mx-auto">
                            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                                <label for="name" class="control-label">{{ 'Name' }}<span
                                        class="text-danger">*</span></label>
                                <input class="form-control" name="name" type="text" pattern="[a-zA-Z]+.*"
                                    title="Please enter first letter alphabet and at least one alphabet character is required."
                                    id="name" placeholder="Enter Name" value="" required>
                            </div>
                            <div class="form-group {{ $errors->has('phone') ? 'has-error' : '' }}">
                                <label for="phone" class="control-label">{{ 'Contact No' }}<span
                                        class="text-danger">*</span></label>
                                <input name="phone" min="0" required type="number"
                                    name="phone"pattern="^[0-9]*$" id="address_phone" class="form-control "
                                    placeholder="Enter Number">
                            </div>
                            <div class="form-group {{ $errors->has('pincode') ? 'has-error' : '' }}">
                                <label for="Pincode" class="control-label">{{ 'Pincode' }}<span
                                        class="text-danger">*</span></label>
                                <input name="Pincode" required type="number" name="pincode" id="pincode"
                                    class="form-control " placeholder="Enter Pincode">
                            </div>
                            <div class="form-group {{ $errors->has('type') ? 'has-error' : '' }}">
                                <label for="phone" class="control-label">{{ 'Address Type' }}<span
                                        class="text-danger">*</span></label>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-check">
                                            <input id="home" name="type" value="0" type="radio"
                                                class="form-check-input" required="">
                                            <label class="form-check-label" for="home">Home</label>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-check">
                                            <input id="office" name="type" value="1" type="radio"
                                                class="form-check-input" required="">
                                            <label class="form-check-label" for="office">Office</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('address_1') ? 'has-error' : '' }}">
                                <label for="address_1" class="control-label">{{ 'Address' }}<span
                                        class="text-danger">*</span></label>
                                <input name="address_1" required type="text" pattern="[a-zA-Z]+.*"
                                    title="Please enter first letter alphabet and at least one alphabet character is required."name="address_1"
                                    id="address_1" class="form-control " placeholder="Enter Number">
                            </div>
                            <div class="form-group {{ $errors->has('address_2') ? 'has-error' : '' }}">
                                <label for="address_2" class="control-label">{{ 'Address 2' }}</label>
                                <input name="address_2" type="text" pattern="[a-zA-Z]+.*"
                                    title="Please enter first letter alphabet and at least one alphabet character is required."
                                    name="address_2" id="address_2" class="form-control "
                                    placeholder="Enter Number">
                            </div>
                            <div class="form-group {{ $errors->has('country_id') ? 'has-error' : '' }}">
                                <label for="country" class="form-label">Country<span
                                        class="text-danger">*</span></label>
                                <select required class="form-select form-control select2insidemodal" id="country"
                                    required name="country_id">
                                    @foreach ($countries as $country)
                                        <option value="{{ $country->id }}">
                                            {{ $country->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">
                                    Please select a valid country.
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('state_id') ? 'has-error' : '' }}">
                                <label for="state" class="form-label">State<span
                                        class="text-danger">*</span></label>
                                <select required class="form-select form-control select2insidemodal" required
                                    id="state" name="state_id">
                                </select>
                                <div class="invalid-feedback">
                                    Please provide a valid state.
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('city_id') ? 'has-error' : '' }}">
                                <label for="city" class="form-label">City<span
                                        class="text-danger">*</span></label>
                                <select required class="form-select form-control select2insidemodal" id="city"
                                    name="city_id">
                                </select>
                                <div class="invalid-feedback">
                                    Please provide a valid state.
                                </div>
                            </div>
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
