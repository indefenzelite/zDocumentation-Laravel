<div class="card-body">
        <div class="table-controller mb-2">
            <div>
                <label for="">Show
                    <select name="length" style="width:60px;height:30px;border: 1px solid #eaeaea;" id="length">
                        <option value="10"{{ $user_subscriptions->perPage() == 10 ? 'selected' : ''}}>10</option>
                        <option value="25"{{ $user_subscriptions->perPage() == 25 ? 'selected' : ''}}>25</option>
                        <option value="50"{{ $user_subscriptions->perPage() == 50 ? 'selected' : ''}}>50</option>
                        <option value="100"{{ $user_subscriptions->perPage() == 100 ? 'selected' : ''}}>100</option>
                    </select>
                    entries
                </label>
            </div>
            <div>
                <button type="button" id="export_button" class="btn btn-success btn-sm">Excel</button>
                <a href="javascript:void(0);" id="print" data-url="{{ route('admin.user-subscriptions.print') }}"  data-rows="{{json_encode($user_subscriptions) }}" class="btn btn-primary btn-sm">Print</a>
            </div>
            <input type="text" name="search" class="form-control" placeholder="Search" id="search" value="{{request()->get('search') }}" style="width:unset;">
        </div>
        <div class="table-responsive">
            <table id="table" class="table">
                <thead>
                    <tr>
                        <th class="no-export">Actions</th> 
                        <th  class="text-center no-export"># <div class="table-div"><i class="ik ik-arrow-up  asc" data-val="id"></i><i class="ik ik ik-arrow-down desc" data-val="id"></i></div></th>                           
                        <th class="col_1">User  </th>                                                 
                        <th class="col_2">Subscription </th>                                                 
                        <th class="col_3">  From Date </th>                                                 
                        <th class="col_4">  To Date </th>                                             
                        <th class="col_4">  Created At </th>                                             
                    </tr>
                </thead>
                <tbody>
                    @if($user_subscriptions->count() > 0)                          
                    @foreach($user_subscriptions as  $user_subscription)
                            <tr id="{{ $user_subscription->id}}" >
                                <td class="no-export">
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action<i class="ik ik-chevron-right"></i></button>
                                        <ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">
                                            <a href="{{ route('admin.user-subscriptions.edit', $user_subscription->id) }}" title="Edit User Subscription" class="dropdown-item "><li class="p-0">Edit</li></a>
                                            <a href="{{ route('admin.user-subscriptions.destroy', $user_subscription->id) }}" title="Delete User Subscription" class="dropdown-item  delete-item text-danger fw-700"><li class="p-0">Delete</li></a>
                                        </ul>
                                    </div> 
                                </td>
                                <td  class="text-center no-export"> {{  $user_subscription->getPrefix() }}</td>
                                                                  
                                <td class="col_1"> <a class="btn btn-link p-1" href="{{ route('admin.users.show', [$user_subscription->user_id,'active' => 'password-tab' ] ) }}">{{ @$user_subscription->user->name??'N/A'}}</td>   

                                <td class="col_2">{{ @$user_subscription->subscription->name??'N/A'}}</td>                                    
                                <td class="col_3">{{$user_subscription->from_date }}</td>                                     
                                <td class="col_4">{{$user_subscription->to_date }}</td>   
                                <td class="col_4">{{$user_subscription->created_at }}</td>   
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
            {{ $user_subscriptions->appends(request()->except('page'))->links() }}
        </div>
        <div>
           {{-- @if($user_subscriptions->lastPage() > 1)
                <label for="">Jump To: 
                    <select name="page" style="width:60px;height:30px;border: 1px solid #eaeaea;"  id="jumpTo">
                        @for ($i = 1; $i <= $user_subscriptions->lastPage(); $i++)
                            <option value="{{ $i }}" {{ $user_subscriptions->currentPage() == $i ? 'selected' : '' }}>{{ $i }}</option>
                        @endfor
                    </select>
                </label>
           @endif --}}
           @if($user_subscriptions->lastPage() > 1)
                <label class="d-flex justify-content-end" for="">
                    <div class="mr-2 pt-2">
                        Jump To: 
                    </div>
                    <input type="number" class="w-50 form-control" id="jumpTo"  name="page" value="{{ $user_subscriptions->currentPage() ?? ''}}">
                </label>
            @endif
        </div>
    </div>
