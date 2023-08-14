<div class="modal fade" id="add-payout-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded shadow border-0">
            <div class="modal-header border-bottom">
                <h5 class="modal-title">Request Refund</h5>
                <button type="button" class="btn btn-icon btn-close" data-bs-dismiss="modal" id="close-modal">
                    <i class="uil uil-times fs-4 text-dark" style="display: inline !important;"></i>
                </button>
            </div>
            <div class="modal-body">
                <form  method="post" action="{{ route('user.payout.store') }}">
                    @csrf   
                    <input type="hidden" name="type" value="0">
                    <input type="hidden" name="request_with" value="create">
                    <label class="form-label" style="font-size:large; color:#161c2dd1;">Amount <span class="text-danger mb-4">*</span></label>
                    <div class="form-icon position-relative">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user fea icon-sm icons"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                        <input max="{{auth()->user()->wallet}}" name="amount" required min="1" type="number" class="form-control ps-5" placeholder="Enter Amount">
                    </div>

                    <label for="form-label" > Select Payout Account <span class="text-danger mb-4">*</span></label>
                    <a href="javascript:void(0);" id="addBankBtn" style="margin-left: 180px;">
                        Add Bank
                    </a>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus icon-sm icons">
                        <line x1="12" y1="5" x2="12" y2="19"></line>
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                    </svg>
                    <div class="form-icon position-relative">
                        <select name="bank_name" class="form-control mb-4" required >
                        <option value="" readonly>Select Bank</option>  
                        @if(auth()->user()->payoutDetails()->count() > 0)
                        @foreach (auth()->user()->payoutDetails as $item)
                        <option value="{{ @$item->payload['bank_name'] }}" @if (@$item->payload['bank_name'] == 1) selected @endif>{{ @$item->payload['bank_name'].' | '.@$item->payload['account_no'].' | '.@$item->payload['branch'] }}
                        </option>
                        @endforeach
                        @endif
                    </select>
                </div>
                

                    <hr>
                    <div class="d-flex justify-content-between">
                        <h6 class="mb-0">Your current wallet amount </h6>
                        <span class="badge bg-info p-2">{{ format_price(auth()->user()->wallet ?? 0) }}</span>
                    </div>
                   
                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary btn-sm">Request</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>