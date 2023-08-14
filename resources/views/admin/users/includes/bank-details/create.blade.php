<div class="modal fade" id="bankDetailsModalCenter" tabindex="-1" role="dialog"
    aria-labelledby="bankDetailsModalCenterLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="bankDetailsModalCenterLabel">{{ __('Add Bank Detail') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.payout-details.store') }}" method="post">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                    <input type="hidden" name="request_with" value="create">
                    <div class="row">
                        <div class="col-md-12 mx-auto">
                            <div class="form-group {{ $errors->has('bank') ? 'has-error' : '' }}">
                                <label for="name" class="control-label">{{ 'Bank' }}
                                    <span class="text-danger">*</span>
                                </label>
                                <select name="bank_name" class="form-control mb-4" required>
                                    <option value="" readonly>Select Bank</option>
                                    @foreach (getBankName() as $option)
                                        <option value="{{ $option['name'] }}"
                                            @if ($option['name'] == 1) selected @endif>{{ $option['name'] }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <label for="">Add Account Type <span class="text-danger">*</span></label>
                            <div class="form-check">
                                <input name="type" value="Current" type="radio" class="form-check-input pb-1"
                                    required="">
                                <label class="form-check-label pl-2 mb-1 " for="current">Current</label>
                            </div>
                            <div class="form-check mb-2">
                                <input name="type" value="Saving" type="radio" class="form-check-input pb-1"
                                    required="">
                                <label class="form-check-label pl-2 mb-1 " for="saving">Saving</label>
                            </div>
                            <div class="form-group {{ $errors->has('type') ? 'has-error' : '' }}">
                                <label for="phone" class="control-label">{{ 'Account Holder Name' }}<span
                                        class="text-danger">*</span></label>
                                <input name="account_holder_name" required type="text" pattern="[a-zA-Z]+.*"
                                    title="Please enter first letter alphabet and at least one alphabet character is required."class="form-control"
                                    placeholder="Enter Account Holder Name">
                            </div>
                            <div class="form-group {{ $errors->has('account_no') ? 'has-error' : '' }}">
                                <label for="account_no" class="control-label">{{ 'Account Number' }}<span
                                        class="text-danger">*</span></label>
                                <input name="account_no" required type="number" min="0" id="numberInput"
                                    class="form-control " placeholder="Enter Account Number">
                            </div>
                            <div class="form-group {{ $errors->has('ifsc_code') ? 'has-error' : '' }}">
                                <label for="ifsc_code" class="control-label">
                                    {{ 'IFSC Code' }}<span class="text-danger">*</span>
                                </label>
                                <input name="ifsc_code" required type="text" pattern="[a-zA-Z]+.*"
                                    title="Please enter first letter alphabet and at least one alphabet character is required."
                                    name="ifsc_code" id="ifsc_code" class="form-control " placeholder="Enter Ifsc Code">
                            </div>
                            <div class="form-group {{ $errors->has('branch') ? 'has-error' : '' }}">
                                <label for="singin-email">Branch <span class="text-danger">*</span></label>
                                <input name="branch" required type="text" pattern="[a-zA-Z]+.*"
                                    title="Please enter first letter alphabet and at least one alphabet character is required."class="form-control"
                                    placeholder="Enter Branch ">
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
<script>
    // Get the input element
    const numberInput = document.getElementById('numberInput');

    // Set the maximum allowed length (e.g., 12 characters)
    const maxLength = 12;
    // Attach an event listener to the input event
    numberInput.addEventListener('input', function() {
        // Trim the input value to the maximum allowed length
        if (numberInput.value.length > maxLength) {
            numberInput.value = numberInput.value.slice(0, maxLength);
        }
    });
</script>
