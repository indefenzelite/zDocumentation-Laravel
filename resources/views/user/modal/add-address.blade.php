<div class="modal fade" id="addAddressModal" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <form action="{{ route('user.address.store') }}" method="post">
            <input type="hidden" name="user_id" value="{{ auth()->id() }}">
            <input type="hidden" name="request_with" value="create">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Add Address</h5>
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
                                    title="Please enter first letter alphabet and at least one alphabet character is required."name="user_name"
                                    class="form-control" id="name" placeholder="Enter  Name">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="phone">Contact No <span class="text-danger">*</span></label>
                                <input name="phone" required type="number" pattern="^[0-9]*$" min="0"
                                    id="address_phone" class="form-control " placeholder="Enter Number">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="pincode_id">Pincode<span class="text-danger">*</span></label>
                                <input name="pincode_id" required type="number" min="0" name="pincode_id"
                                    class="form-control" id="pincode" placeholder="Enter pincode">
                            </div>
                        </div>
                        <div class="col-12">
                            <label for="address" class="form-label">Address Type</label>
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
                        <div class="col-12">
                            <label for="address" class="form-label">Address <span class="text-danger">*</span></label>
                            <input type="text" pattern="[a-zA-Z]+.*"
                                title="Please enter first letter alphabet and at least one alphabet character is required."class="form-control"
                                id="address" placeholder="Enter Address" name="address_1"required>
                            <div class="invalid-feedback">
                                Please enter your shipping address.
                            </div>
                        </div>

                        <div class="col-12">
                            <label for="address2" class="form-label">Address 2 <span
                                    class="text-muted">(Optional)</span></label>
                            <input type="text" class="form-control" id="address2" placeholder="Enter Address"
                                name="address_2">
                        </div>

                        <div class="col-md-4">
                            <label for="country" class="form-label">Country</label>
                            <select class="form-select form-control select2insidemodal" id="country" required
                                name="country_id">
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

                        <div class="col-md-4">
                            <label for="state" class="form-label">State</label>
                            <select class="form-select form-control select2insidemodal" required id="state"
                                name="state_id">
                            </select>
                            <div class="invalid-feedback">
                                Please provide a valid state.
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="state" class="form-label">City</label>
                            <select class="form-select form-control select2insidemodal" id="city"
                                name="city_id">
                            </select>
                            <div class="invalid-feedback">
                                Please provide a valid state.
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </form>
    </div>
</div>
