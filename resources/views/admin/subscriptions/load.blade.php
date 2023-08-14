<div class="card-body">
    <div class="table-controller mb-2">
        <div>
            <label for="">Show
                <select name="length" style="width:60px;height:30px;border: 1px solid #eaeaea;" id="length">
                    <option value="10"{{ $subscriptions->perPage() == 10 ? 'selected' : ''}}>10</option>
                    <option value="25"{{ $subscriptions->perPage() == 25 ? 'selected' : ''}}>25</option>
                    <option value="50"{{ $subscriptions->perPage() == 50 ? 'selected' : ''}}>50</option>
                    <option value="100"{{ $subscriptions->perPage() == 100 ? 'selected' : ''}}>100</option>
                </select>
                entries
            </label>
        </div>
        <div>
            <button type="button" id="export_button" class="btn btn-success btn-sm">Excel</button>
           
                <a href="javascript:void(0);" id="print" data-url="{{ route('admin.subscriptions.print') }}" data-rows="{{json_encode($subscriptions) }}" class="btn btn-primary btn-sm">Print</a>              
        </div>
        <input type="text" name="search" class="form-control" placeholder="Search" id="search" value="{{request()->get('search') }}" style="width:unset;">
    </div>
    <div class="table-responsive">
        <table id="table" class="table">
            <thead>
                <tr>
                    <th class=" no-export">Actions</th> 
                    <th class=" text-center no-export">{{ __('#')}}</th>                          
                    <th class="col_1">Name </th>                                                 
                    <th class="col_2">Price </th>                                                 
                    <th class="col_3">Visibility </th>                                           
                    <th class="col_4">Created At </th>  
                </tr>                                        
            </thead>
            <tbody class="no-data">
                @if($subscriptions->count() > 0)                          
                @foreach($subscriptions as  $subscription)
                        <tr id="{{$subscription->id}}">
                            <td class="no-export">
                                <div class="dropdown d-flex">
                                    <button style="background: transparent;border:none;" class="dropdown-toggle p-0" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="ik ik-more-vertical pl-1"></i></button>
                                    <ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">

                                    @if(auth()->user()->isAbleTo('edit_subscription_plan'))
                                        <a href="{{ route('admin.subscriptions.edit', secureToken($subscription->id)) }}" title="Edit Subscription" class="dropdown-item "><li class="p-0">Edit</li></a>
                                    @endif
                                    @if(auth()->user()->isAbleTo('delete_subscription_plan'))
                                        <a href="{{ route('admin.subscriptions.destroy', $subscription->id) }}" title="Delete Subscription" class="dropdown-item  delete-item"><li class=" p-0 text-danger">Delete</li></a>
                                    @endif
                                    </ul>
                                </div> 
                            </td>
                            <td  class="text-center no-export"> {{  $subscription->getPrefix() }}</td>
                                                                
                            <td class="col_1">{{$subscription->name }}</td>                                     
                            <td class="col_2">@if($subscription->price == 0)<span class="badge badge-primary">Free</span>@else {{ format_price($subscription->price) }}@endif
                            </td>   
                            <td class="is_published-{{$subscription->id}} col_3" data-status="{{ $subscription->is_published }}"><span class="col_3 badge badge-{{ getPublishStatus($subscription->is_published)['color'] }}">{{getPublishStatus($subscription->is_published)['name']}}</span></td> 
                            <td class="col_4">{{$subscription->formatted_created_at}}</td>  
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
        {{ $subscriptions->appends(request()->except('page'))->links() }}
    </div>
    <div>
        @if($subscriptions->lastPage() > 1)
            <label class="d-flex justify-content-end" for="">
                <div class="mr-2 pt-2">
                    Jump To: 
                </div>
                <input type="number" class="w-50 form-control" id="jumpTo"  name="page" value="{{ $subscriptions->currentPage() ?? ''}}">
            </label>
        @endif
    </div>
</div>
