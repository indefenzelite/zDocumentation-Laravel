<div class="card-body">
        <div class="table-controller mb-2">
            <div>
                <label for="">Show
                    <select name="length" style="width:60px;height:30px;border: 1px solid #eaeaea;" id="length">
                        <option value="10"{{ $payouts->perPage() == 10 ? 'selected' : ''}}>10</option>
                        <option value="25"{{ $payouts->perPage() == 25 ? 'selected' : ''}}>25</option>
                        <option value="50"{{ $payouts->perPage() == 50 ? 'selected' : ''}}>50</option>
                        <option value="100"{{ $payouts->perPage() == 100 ? 'selected' : ''}}>100</option>
                    </select>
                    entries
                </label>
            </div>
            <div>
                <button type="button" id="export_button" class="btn btn-success btn-sm">Excel</button>
                
                <a href="javascript:void(0);" id="print" data-url="{{ route('admin.payouts.print') }}" data-rows="{{json_encode($payouts) }}" class="btn btn-primary btn-sm">Print</a>
            </div>
            <input type="text" name="search" class="form-control" placeholder="Search" id="search" value="{{request()->get('search') }}" style="width:unset;">
        </div>
        <div class="table-responsive">
            <table id="table" class="table">
                <thead>
                    <tr>
                        @if(Auth::user()->isAbleTo('manage_user') && ucfirst(auth()->user()->roles[0]->name) != 'Super Admin')
                        <th class="col_1 no-export"><input type="checkbox" class="allChecked mr-1" name="id" value="">Actions</th>
                        @endif 
                        <th class="col_2 no-export">{{ __('Action')}}</th>           
                        <th class="col_2 ">{{ __('#')}} <div class="table-div"><i class="ik ik-arrow-up  asc" data-val="id"></i><i class="ik ik ik-arrow-down desc" data-val="id"></i></div></th>           
                        <th class="col_1">User</th>
                        <th class="col_2">Amount</th>
                        <th class="col_3">Status</th>
                        <th class="col_4">Txn</th>
                        <th class="col_5">Requested At</th>
                        <th class="col_4">Approved By</th>
                        <th class="col_4">Approved At</th>
                    </tr>
                </thead>
                <tbody class="no-data">
                    @if($payouts->count() > 0)
                        @foreach($payouts as  $payout)
                            <tr id="{{$payout->id}}">
                                @if(Auth::user()->isAbleTo('manage_user') && ucfirst(auth()->user()->roles[0]->name) != 'Super Admin')
                                    <td class="col_1 no-export"> 
                                        <div class="dropdown d-flex">
                                            <input type="checkbox" class="mr-2 delete_Checkbox text-center" name="id" value="{{$payout->id}}">
                                            <button style="background: transparent;border:none;" class="dropdown-toggle p-0" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="ik ik-more-vertical pl-1"></i></button>
                                        </div>
                                    </td>
                                @endif
                                
                                <td class="no-export">
                                    <div class="dropdown">
                                        <button style="background: transparent;border:none;" class="dropdown-toggle p-0" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="ik ik-more-vertical pl-1"></i></button>
                                        <ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu" style="padding: 8px;">
                                            @if($payout->status == "0" || $payout->status == "2")
                                                <a href="{{route('admin.payouts.delete', $payout->id)}}" title="Delete payout" class="dropdown-payout  delete-payout text-danger fw-700"><li class=" p-0">Delete</li></a>
                                            @endif
                                        </ul>
                                    </div> 
                                </td>
                                {{-- <td class="no-export">
                                    <div class="dropdown">
                                        <ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">
                                            <a href="{{route('admin.payouts.delete', $payout->id)}}" title="Delete Payout" class="dropdown-payout  delete-item text-danger fw-700"><li class=" p-0">Delete</li></a>
                                            @if($payout->status == "0" || $payout->status == "2")
                                            @endif
                                        </ul>
                                    </div>
                                </td> --}}

                                @if(auth()->user()->isAbleTo('show_payout'))
                                    <td class="text-center pl-0"><a style="" class="text-primary" href="@if(auth()->user()->isAbleTo('control_payout')) {{ route('admin.payouts.show', secureToken($payout->id)) }} @endif">#POUT{{ $payout->id}}</a></td>
                                @endif   
                                <td class="col_1">{{$payout->user->full_name ?? '--'}}</td>
                                  <td class="col_2">{{format_price($payout->amount) ?? '--'}}</td>
                                  <td class="col_3 status-{{$payout->id}}" data-status="{{$payout->status}}"><span class="badge badge-{{ $payout->status_parsed->color}} m-1">{{ $payout->status_parsed->label}}</span></td>
                                  <td class="col_4">{{ ($payout->txn_no ?? '--') }}</td>
                                  <td class="col_5">{{ ($payout->formatted_created_at) }}</td>
                                  <td class="col_4">{{ ($payout->approver->full_name ?? '--') }}</td>
                                  <td class="col_4">{{ ($payout->approved_at ?? '--') }}</td>
                                    
                            </tr>
                        @endforeach
                    @else 
                        <tr>
                            <td class="text-center" colspan="8">No Data Found...</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer d-flex justify-content-between">
        <div class="pagination">
            {{ $payouts->appends(request()->except('page'))->links() }}
        </div>
        <div>
           @if($payouts->lastPage() > 1)
                <label class="d-flex justify-content-end" for="">
                    <div class="mr-2 pt-2">
                        Jump To: 
                    </div>
                    <input type="number" class="w-50 form-control" id="jumpTo"  name="page" value="{{ $payouts->currentPage() ?? ''}}">
                </label>
            @endif
        </div>
    </div>
