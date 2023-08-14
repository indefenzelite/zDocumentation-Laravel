<div class="modal fade" id="add-order-modal" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <form action="{{ route('user.order.store') }}" method="post">
            <input type="hidden" name="user_id" value="{{auth()->id()}}">
            <input type="hidden" name="request_with" value="web">
            <input type="hidden" name="qty" value="1">
            <input  class="form-control" name="tax" type="hidden" value="0" id="tax_" min="0" max="100" placeholder=" Tax"  >
            <input type="hidden" value="COD" class="form-control" id="payment_gateway " placeholder="Enter"
            name="payment_gateway">
            <input type="hidden"  value="0" class="form-control" id="status" placeholder="Enter"
             name="status">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Add Order</h5>
                    <button type="button" class="btn close" data-bs-dismiss="modal" aria-label="Close"
                        style="padding: 0px 20px;font-size: 20px;">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="item"> Items <span class="text-danger">*</span></label>
                                <select required onchange="getval(this);" data-url={{ route('user.order.store') }} name="items[]" id="user_id"  class="form-control select2">
                                    <option value="" readonly>Select Item </option>
                                    @foreach($items as $item)
                                        <option value="{{ $item->id }}" {{  old('item_id') == $item->id ? 'Selected' : '' }}>{{ Str::words($item->name  ,'20','...') ?? '' }}</option> 
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="item"> Address <span class="text-danger">*</span></label>
                                <select required name="to" id="user_id" class="form-control select2">
                                    <option value="" readonly>Select Address</option>
                                    @foreach($address as $item)
                                        <option value="{{ $item->id }}" {{ old('item_id') == $item->id ? 'Selected' : '' }}>
                                            {{ Str::limit($item['details']['name'] ?? '', 70, '...') }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        
                        <div class="col-12">
                            <div class="form-group">
                                <label for="item">Amount<span class="text-danger">*</span></label>
                                <input name="total" readonly required type="number"  name="total " id="total" class="form-control " placeholder="Enter Amount ">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="discount">Discount<span class="text-danger">*</span></label>
                                <input name="discount" required type="number"  name="discount" class="form-control" id="discount"  placeholder="Enter Discount">
                            </div>
                        </div>   
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>
