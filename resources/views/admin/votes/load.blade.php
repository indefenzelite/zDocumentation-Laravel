<div class="card-body">
        <div class="d-flex justify-content-between mb-2">
            <div>
                <label for="">Show
                    <select name="length" style="width:60px;height:30px;border: 1px solid #eaeaea;" id="length">
                        <option value="10"{{ $votes->perPage() == 10 ? 'selected' : ''}}>10</option>
                        <option value="25"{{ $votes->perPage() == 25 ? 'selected' : ''}}>25</option>
                        <option value="50"{{ $votes->perPage() == 50 ? 'selected' : ''}}>50</option>
                        <option value="100"{{ $votes->perPage() == 100 ? 'selected' : ''}}>100</option>
                    </select>
                    entries
                </label>
            </div>
            <div>
                 {{--
                    <button type="button" id="export_button" class="btn btn-success btn-sm">Excel</button>
                        --}} 
                     {{--
                    <ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">                          
                        <li class="dropdown-item p-0 col-btn" data-val="col_1"><a href="javascript:void(0);"  class="btn btn-sm">Status</a></li>                           
                        <li class="dropdown-item p-0 col-btn" data-val="col_2"><a href="javascript:void(0);"  class="btn btn-sm">User  </a></li>                           
                        <li class="dropdown-item p-0 col-btn" data-val="col_3"><a href="javascript:void(0);"  class="btn btn-sm">Ip Address</a></li>                      
                    </ul>
                    --}}  
                    {{--
                <a href="javascript:void(0);" id="print" data-url="{{ route('admin.votes.print') }}"  data-rows="{{json_encode($votes) }}" class="btn btn-primary btn-sm">Print</a>
                    --}}                
            </div>
            <input type="text" name="search" class="form-control" placeholder="Search" id="search" value="{{request()->get('search') }}" style="width:unset;">
        </div>
        <div class="table-responsive">
            <table id="table" class="table">
                <thead>
                    <tr>
                        
                        <th class="no-export">
                            @if($bulkActivation == 1)
                            <input type="checkbox" class="mr-2 " id="selectall"  value="">
                            @endif
                            Actions
                        </th> 
                        <th  class="text-center no-export"># <div class="table-div"><i class="ik ik-arrow-up  asc" data-val="id"></i><i class="ik ik ik-arrow-down desc" data-val="id"></i></div></th>                           
                        <th class="col_1">  Status </th>                                                 
                        <th class="col_2">  User    </th>                                                 
                        <th class="col_3">  Ip Address </th>                         
                    </tr>
                </thead>
                <tbody>
                    @if($votes->count() > 0)                          
                    @foreach($votes as  $vote)
                            <tr>
                                <td class="no-export">
                                    <div class="dropdown d-flex">  
                                        @if($bulkActivation == 1)
                                        <input type="checkbox" class="mr-2 text-center" name="id" onclick="countSelected()" value="{{  $vote->id}}">
                                        @endif
                                        @if(auth()->user()->isAbleTo('edit_vote') || auth()->user()->isAbleTo('delete_vote'))
                                            <button style="background: transparent;border:none;" class="dropdown-toggle p-0" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="ik ik-more-vertical pl-1"></i></button>
                                            <ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">
                                                @if(request()->get('trash') == 1)
                                                    <a href="{{ route('admin.votes.restore', $vote->id) }}" title="Delete Vote" class="dropdown-item"><li class=" p-0">Restore</li></a>
                                                @else
                                                    @if(auth()->user()->isAbleTo('edit_vote'))
                                                        <a href="{{ route('admin.votes.edit', $vote->id) }}" title="Edit Vote" class="dropdown-item "><li class="p-0">Edit</li></a>
                                                    @endif
                                                    @if(auth()->user()->isAbleTo('delete_vote'))
                                                        <a href="{{ route('admin.votes.destroy', $vote->id) }}" title="Delete Vote" class="dropdown-item  delete-record"><li class=" p-0">Delete</li></a>
                                                    @endif 
                                                @endif
                                            </ul>
                                        @endif
                                    </div>
                                </td>
                                <td  class="text-center no-export"> {{  $vote->getPrefix() }}</td>                                   
                                <td class="col_1">{{$vote->status }}</td>                                     
                                <td class="col_2">{{ @$vote->user->name??'N/A'}}</td>                                    
                                <td class="col_3">{{$vote->ip_address }}</td>   
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
            {{ $votes->appends(request()->except('page'))->links() }}
        </div>
        <div>
           @if($votes->lastPage() > 1)
                <label class="d-flex justify-content-end" for="">
                    <div class="mr-2 pt-2">
                        Jump To: 
                    </div>
                    <input type="number" class="w-50 form-control" id="jumpTo"  name="page" value="{{ $votes->currentPage() ?? ''}}">
                </label>
           @endif
        </div>
    </div>
