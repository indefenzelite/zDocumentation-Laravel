<!-- Modal -->
<div class="modal fade" id="walletModal" tabindex="-1"  role="dialog" aria-labelledby="walletModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Place Transaction</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
     <form class="ajaxForm" action="{{route('admin.wallet-logs.update')}}" method="POST" >
        @csrf
        <input type="hidden" value="" name="user_id" id="uuid">
        <input type="hidden" value="{{request()->get('role')}}" name="role">
          <div class="modal-body">
            <div class="row">
                <div class="col-12">
                    <div class="alert alert-info">
                        <p class="mb-0 pb-0">The user balance is virtual money that they can withdraw by using the payout feature.</p>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-radio">
                        <div class="radio radiofill radio-success radio-inline">
                            <label class="fw-700">
                                <input type="radio"  name="type" value="credit" class="transationType">
                                <i class="helper"></i>{{ __('Credit Balance')}}
                            </label>
                        </div>
                    </div>  
                </div>
                <div class="col-6">
                    <div class="form-radio">
                        <div class="radio radiofill radio-danger radio-inline">
                            <label class="fw-700">
                                <input type="radio"  name="type" value="debit" class="transationType"required>
                                <i class="helper"></i>{{ __('Debit Balance')}}
                            </label>
                        </div>  
                    </div>  
                </div>
                <div class="col-lg-12">
                    <input min="1" type="number" class="form-control amount" placeholder="Please Enter Amount*" name="amount"required>
                </div>
            </div>
            <div class="text-danger mt-2">
                <i class="ik ik-info"></i> 
                This action cannot be rollbacked.
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Confirm & Proceed Transaction</button>
        </div>
     </form>
    </div>
  </div>
</div>
