<div class="modal fade editPayoutDetail" id="editPayoutDetailReq" role="dialog" aria-labelledby="editPayoutDetailCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <form action="{{ route('user.payout-detail.update') }}" method="post">
            <input type="hidden" name="id" value="" id="payoutdetailId">
            <input type="hidden" name="user_id" value="">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update Bank Details</h5>
                    <button type="button" class="btn close" data-bs-dismiss="modal" aria-label="Close"
                        style="padding: 0px 20px;font-size: 20px;">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-12">
                            <label for="singin-email">Bank <span class="text-danger">*</span></label>
                            <select name="bank_name" id="editbank" class="form-control mb-4">
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
                                        <input id="editcurrent" name="type" value="Current" type="radio" class="form-check-input pb-1"
                                        required="">
                                        <label class="form-check-label pl-2 mb-1 " for="editcurrent">Current</label>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-check">
                                        <input id="editsaving" name="type" value="Saving" type="radio" class="form-check-input pb-1"
                                        required="">
                                        <label class="form-check-label pl-2 mb-1 " for="editsaving">Saving</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="singin-email">Account Holder Name <span class="text-danger">*</span></label>
                                <input maxlength="60" type ="text"pattern="[a-zA-Z]+.*" name="account_holder_name" id="editaccount_holder_name" required type="text" class="form-control" placeholder="Enter Account Holder Name">
                            </div>
                        </div> 
                        <div class="col-6">
                            <div class="form-group">
                                <label for="singin-email">Account Number <span class="text-danger">*</span></label>
                                <input name="account_no" id="editaccount_no" required type="number" min="0" class="form-control " placeholder="Enter Account Number">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="singin-email">IFSC Code <span class="text-danger">*</span></label>
                                <input name="ifsc_code" id="editifsc_code"pattern="[a-zA-Z]+.*" required type="text" class="form-control" placeholder="Enter Ifsc Code">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="singin-email">Branch <span class="text-danger">*</span></label>
                                <input maxlength="60" name="branch"pattern="[a-zA-Z]+.*" id="editbranch" required type="text" class="form-control" placeholder="Enter Branch ">
                            </div>
                        </div>  
                        <div class="col-12 text-right mt-2">
                            {{-- @if(!isset($user_kyc))
                                <div class="form-group">
                                    <input type="checkbox" name="hereBy" required id="hereBy">
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
