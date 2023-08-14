<div class="modal fade" id="add-wallet-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header border-bottom">
                <h6 class="modal-title modal-title-standard" id="LoginForm-title">Recharge Wallet</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="icon-close"></i></span>
                </button>
            </div>
            <div class="modal-body p-1">
                <div class="form-box pt-0">
                    <div class="form-tab">        
                        <div class="tab-content" id="tab-content-5">
                            <div class="tab-pane fade show active mt-0" id="signin" role="tabpanel" aria-labelledby="signin-tab">
                                <form  method="post" action="{{ route('user.wallet.store') }}">
                                        @csrf   
                                        <input type="hidden" name="type" value="credit">
                                        <input type="hidden" name="request_with" value="create">
                                        
                                    <div class="form-group">
                                        <label for="singin-email">Amount <span class="text-danger">*</span></label>
                                        <input name="amount" required type="number" min="100" class="form-control ps-5" placeholder="Enter Amount">
                                    </div><!-- End .form-group -->

                                    <div class="mt-3 d-flex justify-content-center">
                                        <button type="submit" class="btn btn-outline-dark btn-round">Request <i class="icon-long-arrow-right"></i></button>
                                    </div>
                                </form>
                               
                            </div><!-- .End .tab-pane -->
                        </div><!-- End .tab-content -->
                    </div><!-- End .form-tab -->
                </div><!-- End .form-box -->
            </div><!-- End .modal-body -->
        </div><!-- End .modal-content -->
    </div><!-- End .modal-dialog -->
</div>
