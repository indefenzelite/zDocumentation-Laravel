<table  class="table data_table">
    <thead>
        <tr>
            <th>Action</th>
            <th>Bank Name</th>
            {{-- <th>Account Type</th> --}}
            <th>Account Holder Name</th>
            <th>Account No</th>
            <th>IFSC Code</th>
            <th>branch</th>
        </tr>
    </thead>
    <tbody>
        @foreach($user->payoutDetails as $payoutDetail)
        @php
            $paload_decodes = $payoutDetail->payload;
        @endphp
            <tr>
                <td>
                    <div class="dropdown d-flex">
                        <button style="background: transparent;border:none;" class="dropdown-toggle p-0" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="ik ik-more-vertical pl-1"></i></button>
                        <ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">
                        <li class="dropdown-item p-0"><a href="javascript:void(0)" data-toggle="modal" data-target="#editPayoutDetail" class="btn btn-sm edit-btn editPayoutDetailBtn" title=""  data-payload="{{json_encode($payoutDetail->payload)}}" data-row="{{$payoutDetail}}"
                            data-original-title="Edit">Edit</a>
                        </li>
                        
                        <li class="dropdown-item p-0"><a href="{{ route('user.payout-detail.destroy',$payoutDetail->id) }}"
                            class="btn btn-sm delete-item text-danger fw-700" title=""
                            data-original-title="delete" title="" data-original-title="delete">Delate</a>
                        </li>
                        </ul>
                    </div>   
                </td>
                <td>
                    {{@$paload_decodes['bank_name']}}
                </td>
                {{-- <td>{{@$paload_decodes['account_type']}}</td> --}}
                <td>{{Str::limit(@$paload_decodes['account_holder_name'], 12)}}</td>
                <td>{{@$paload_decodes['account_no'] }}</td>
                <td>{{@$paload_decodes['ifsc_code'] }}</td>
                <td>{{@$paload_decodes['branch'] }}</td>
            </tr>
        @endforeach
    </tbody>
</table> 
{{-- <div class="customer_card card-address_info">
    <div class="border-bottom pb-4">
        <div class="row mt-2">
            @forelse ($user->payoutDetails as $payoutDetail)
                @php
                    $paload_decodes = $payoutDetail->payload;
                @endphp
                <div class="col-lg-6">
                    <div class="m-1 p-2 border rounded">
                        <div class="mb-2">
                            <div class="d-flex align-items-center justify-content-between">
                                <h6 class="m-0 p-0"> {{$payoutDetail->type}} Account </h6>
                                <div>
                                    @if(auth()->user()->isAbleTo('edit_bank'))
                                        <a href="javascript:void(0)" data-toggle="modal" data-target="#editPayoutDetail" class="text-primary editPayoutDetailBtn h5 mb-0" title="" data-payload="{{json_encode($payoutDetail->payload)}}" data-row="{{$payoutDetail}}" data-original-title="Edit"><i class="ik ik-edit"></i></a>
                                    @endif
                                    @if(auth()->user()->isAbleTo('delete_bank'))
                                        <a href="{{ route('user.payout-detail.destroy',$payoutDetail->id) }}" class="text-primary delete-item h5 mb-0" title="" data-original-title="delete">
                                            <i class="ik ik-trash"></i></a>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="pt-4 border-top">
                            <div class="">
                                <div>
                                    <p class="text-muted mb-0"> 
                                        <i class="fa fa-university"></i>   
                                        {{@$paload_decodes['bank_name']}}<br>
                                        <i class="ik ik-user"></i>  
                                        {{@$paload_decodes['account_holder_name']}}<br>
                                       <i class="ik ik-book-alt"></i>   
                                       {{@$paload_decodes['account_no'] }}<br>
                                       <i class="ik ik-share-alt"></i>   
                                        {{@$paload_decodes['ifsc_code'] }}<br>
                                        <i class="ik ik-home"></i> 
                                        {{@$paload_decodes['branch'] }}<br> 
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty  
                <div class="col-lg-8 mx-auto text-center">
                    @php
                        $title = 'No Bank Details yet!';
                    @endphp
                    @include('user.include.empty-record')
                </div>
            @endforelse
        </div>
    </div>
</div>    --}}