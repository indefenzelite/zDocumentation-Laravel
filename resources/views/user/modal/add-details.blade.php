<div class="modal fade" id="addPayoutDetailReqModal" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="documnet">
        <form action="{{ route('user.payout-detail.store') }}" method="post" id="ajaxform">
            <input type="hidden" name="user_id" value="{{auth()->id()}}">
            <input type="hidden" name="request_with" value="create">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Bank Details</h5>
                    <button type="button" class="btn close" data-bs-dismiss="modal" aria-label="Close"
                        style="padding: 0px 20px;font-size: 20px;">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-12">
                            <label for="singin-email">Bank <span class="text-danger">*</span></label>
                            <select name="bank_name" class="form-control mb-4">
                                <option value="" readonly>Select Bank</option>
                                @foreach (getBankName() as $option)
                                <option value="{{ $option['name'] }}" @if ($option['name'] == 1) selected @endif>{{ $option['name'] }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="row">
                                <div class="col-12">
                                    <label for="">Add Account Type <span class="text-danger">*</span></label> 
                                </div>
                                <div class="col-6">
                                    <div class="form-check">
                                        <input name="type" value="Current" type="radio" id="current" class="form-check-input pb-1"
                                        required="">
                                        <label class="form-check-label pl-2 mb-1 " for="current">Current</label>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-check">
                                        <input name="type" value="Saving" type="radio" id="saving" class="form-check-input pb-1"
                                        required="">
                                        <label class="form-check-label pl-2 mb-1 " for="saving">Saving</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="singin-email">Account Holder Name <span class="text-danger">*</span></label>
                                <input name="account_holder_name" required type="text" pattern="[a-zA-Z]+.*" title="Please enter first letter alphabet and at least one alphabet character is required." title="Please enter first letter alphabet and at least one alphabet character is required."maxlength="60" class="form-control" placeholder="Enter Account Holder Name">
                            </div>
                        </div> 
                        <div class="col-6">
                            <div class="form-group">
                                <label for="singin-email">Account Number <span class="text-danger">*</span></label>
                                <input name="account_no" required type="Number" min="0" class="form-control " placeholder="Enter Account Number">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="singin-email">IFSC Code <span class="text-danger">*</span></label>
                                <input name="ifsc_code" required type="text" pattern="[a-zA-Z]+.*" title="Please enter first letter alphabet and at least one alphabet character is required." title="Please enter first letter alphabet and at least one alphabet character is required."class="form-control" placeholder="Enter Ifsc Code">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="singin-email">Branch <span class="text-danger">*</span></label>
                                <input name="branch" maxlength="60" required type="text"pattern="[a-zA-Z]+.*" class="form-control" placeholder="Enter Branch ">
                            </div>
                        </div>  
                        <div class="col-12 text-right mt-2">
                            {{-- @if(!isset($user_kyc))
                                <div class="form-group">
                                    <input type="checkbox" name="hereBy" required>
                                    <label for="hereBy">I hereby certify that above details are correct.</label>
                                </div>
                            @endif     --}}   
                         </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-outline-primary">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>

