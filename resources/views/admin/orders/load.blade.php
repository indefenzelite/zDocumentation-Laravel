<div class="card-body">
        <div class="table-controller mb-2">
            <div>
                <label for="">Show
                    <select name="length" style="width:60px;height:30px;border: 1px solid #eaeaea;" id="length">
                        <option value="10"{{ $orders->perPage() == 10 ? 'selected' : ''}}>10</option>
                        <option value="25"{{ $orders->perPage() == 25 ? 'selected' : ''}}>25</option>
                        <option value="50"{{ $orders->perPage() == 50 ? 'selected' : ''}}>50</option>
                        <option value="100"{{ $orders->perPage() == 100 ? 'selected' : ''}}>100</option>
                    </select>
                    entries
                </label>
            </div>
            <div>
                <button type="button" id="export_button" class="btn btn-success btn-sm">Excel</button>
                
                <a href="javascript:void(0);" id="print" data-url="{{ route('admin.orders.print') }}" data-rows="{{ json_encode($orders) }}"class="btn btn-primary btn-sm">Print</a>
            </div>
            <input type="text" name="search" class="form-control" placeholder="Search" id="search" value="{{request()->get('search') }}" style="width:unset;">
        </div>
        <div class="table-responsive">
            <table id="table" class="table">
                <thead>
                    <tr>
                        {{-- <th class="col_1 no-export"><input type="checkbox" class="allChecked mr-1" name="id" value="">{{__('#')}}</th>  --}}
                        <th class=" col_1">{{ __('#')}} <div class="table-div"><i class="ik ik-arrow-up  asc" data-val="id"></i><i class="ik ik ik-arrow-down desc" data-val="id"></i></div></th>
                        <th class="col_2">User Name </th>                       
                        <th class="col_3">Txn No</th>
                        <th class="col_4">Items</th>
                        {{-- <th class="col_5">Discount</th> --}}
                        <th class="col_6">Amount</th> 
                        <th class="col_7">Status</th>
                        <th class="col_8">Payment Status</th>
                        <th class="col_9">Created At</th>
                    </tr>
                </thead>
                <tbody class="no-data">
                    @if($orders->count() > 0)
                         @foreach($orders as  $order)
                            <tr id="{{$order->id}}">
                                {{-- <td class="no-export">
                                    <div class="dropdown d-flex">
                                        <button style="background: transparent;border:none;" class="dropdown-toggle p-0" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="ik ik-more-vertical pl-1"></i></button>
                                        <ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">
                                            <li class="dropdown-item p-0"><a href="{{ route('admin.orders.show', $order->id) }}" title="Show Order" class="btn btn-sm">Show</a></li>
                                            <li class="dropdown-item p-0"><a href="{{ route('admin.orders.invoice', $order->id) }}" title="Invoice" target="_blank" class="btn btn-sm">Invoice</a></li>
                                        </ul>
                                    </div> 
                                </td> --}}
                                @if(auth()->user()->isAbleTo('show_order'))
                                    <td class="col_1" style="padding: 0rem;"><input type="checkbox" class="mr-2 delete_Checkbox text-center" name="id" value="{{$order->id}}">
                                        <a class="btn-link" href="@if(auth()->user()->isAbleTo('control_order')){{ route('admin.orders.show', secureToken($order->id)) }} @endif">
                                            {{ ($order->getPrefix()) }}
                                        </a>
                                    </td>
                                @endif
                                <td class="col_2">
                                    @if($order->user)
                                    <a href="{{ route('admin.users.show', secureToken($order->user->id)) }}" class="btn btn-link pl-0 pt-1">
                                        {{$order->user->full_name ?? 'Not Available' }}
                                    </a>
                                    @else
                                    User Deleted
                                    @endif
                                </td>
                                <td class="col_3">
                                    {{$order->txn_no }}
                                </td>
                                <td class="col_4">
                                    
                                    @if (!empty($order->has('orderItems')))
                                        @foreach($order->orderItems as $orderItem)
                                            {{Str::ucfirst(@$orderItem->item->name??'N/A') }}
                                        @endforeach
                                    @endif
                                </td>
                                {{-- <td class="col_5">
                                    {{ format_price($order->discount) ?? '--'}}
                                </td> --}}
                                <td class="col_5">
                                    {{format_price($order->total) }}
                                </td>
                                <td class="col_6 status-{{$order->id}}"data-status="{{$order->status}}">
                                    <span class="badge badge-{{ $order->status_parsed->color}} m-1">{{ $order->status_parsed->label}}</span>
                                </td>
                                <td class="col_7"><span class="badge badge-{{ @\App\Models\Order::PAYMENT_STATUS[$order->payment_status]['color']}} m-1">{{ @\App\Models\Order::PAYMENT_STATUS[$order->payment_status]['label']}}</span></td>
                                <td class="col_8">{{ ($order->formatted_created_at) }}</td>
                            </tr>
                        @endforeach
                    @else 
                        <tr>
                            <td class="text-center" colspan="15">No Data Found...</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer d-flex justify-content-between">
        <div class="pagination">
            {{ $orders->appends(request()->except('page'))->links() }}
        </div>
        <div> 
           @if($orders->lastPage() > 1)
                <label class="d-flex justify-content-end" for="">
                    <div class="mr-2 pt-2">
                        Jump To: 
                    </div>
                    <input type="number" class="w-50 form-control" id="jumpTo"  name="page" value="{{ $orders->currentPage() ?? ''}}">
                </label>
            @endif
        </div>
    </div>
