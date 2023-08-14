<div class="modal fade" id="editAddressModal" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <form action="{{ route('user.address.update') }}" method="post">
            <input type="hidden" name="id" value="" id="addressId">
            <input type="hidden" name="user_id" value="" id="user_id">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update Address</h5>
                    <button type="button" class="btn close" data-bs-dismiss="modal" aria-label="Close"
                        style="padding: 0px 20px;font-size: 20px;">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="name"> Name <span class="text-danger">*</span></label>
                                <input name="name" required type="text" pattern="[a-zA-Z]+.*"
                                    title="Please enter first letter alphabet and at least one alphabet character is required."name="name"
                                    class="form-control" id="editName" placeholder="Enter Name" value="">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="phone">Contact No <span class="text-danger">*</span></label>
                                <input name="phone" required type="number" pattern="^[0-9]*$" min="0"
                                    id="editPhone" class="form-control " placeholder="Enter Number" value="">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="pincode_id">Pincode<span class="text-danger">*</span></label>
                                <input required type="number" name="pincode_id" min="0" class="form-control"
                                    id="pincode_id" placeholder="Enter pincode" value="">
                            </div>
                        </div>
                        <div class="col-12">
                            <label for="address" class="form-label">Address Type</label>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-check">
                                        <input id="homeEdit" name="type" value="0" type="radio"
                                            class="form-check-input homeInput" required="">
                                        <label class="form-check-label" for="homeEdit">Home</label>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-check">
                                        <input id="officeEdit" name="type" value="1" type="radio"
                                            class="form-check-input officeInput" required="">
                                        <label class="form-check-label" for="officeEdit">Office</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <label for="address" class="form-label">Address <span class="text-danger">*</span></label>
                            <input type="text" pattern="[a-zA-Z]+.*"
                                title="Please enter first letter alphabet and at least one alphabet character is required."class="form-control"
                                id="address_1" placeholder="1234 Main St" required name="address_1">
                            <div class="invalid-feedback">
                                Please enter your shipping address.
                            </div>
                        </div>

                        <div class="col-12">
                            <label for="address2" class="form-label">Address 2 <span
                                    class="text-muted">(Optional)</span></label>
                            <input type="text" class="form-control" id="address_2"
                                placeholder="Apartment or suite" name="address_2">
                        </div>

                        <div class="col-md-4">
                            <label for="country" class="form-label">Country</label>
                            <select class="form-select form-control select2 insidemodaledit" id="countryEdit" required
                                name="country_id">
                                @foreach ($countries as $country)
                                    <option value="{{ $country->id }}"
                                        @if (isset($address_decoded) && $address_decoded != null) @if ($user->country != null) 
                                                {{ isset($address_decoded['country']) && $country->id == $address_decoded['country'] ? 'selected' : '' }} @elseif ($country->name == 'India') selected @endif
                                        @endif>
                                        {{ $country->name }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">
                                Please select a valid country.
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label for="state" class="form-label">State</label>
                            <select class="form-select form-control select2insidemodaledit" id="stateEdit"
                                name="state_id">
                                {{-- <option value="">MP</option> --}}
                            </select>
                            <div class="invalid-feedback">
                                Please provide a valid state.
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="state" class="form-label">City</label>
                            <select class="form-select form-control select2insidemodaledit" id="cityEdit"
                                name="city_id">
                                {{-- <option value="">Seoni</option> --}}
                            </select>
                            <div class="invalid-feedback">
                                Please provide a valid state.
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </div>
        </form>
    </div>
</div>
